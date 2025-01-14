<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sales;
use App\Models\ItemsModel;
use App\Models\BatchesModel;
use App\Models\InventoryTracking;
use App\Models\SalesModel;
use Illuminate\Http\Request;
use DataTables;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $items = ItemsModel::get();

        if ($request->ajax()) {
            $data = SalesModel::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('batch_ids', function ($row) {
                    $batchInfo = '';
                    $batchData = json_decode($row->batch_ids, true);

                    if (is_array($batchData)) {
                        foreach ($batchData as $batch) {
                            $batchInfo .= "{$batch['batch_id']}<br>";
                        }
                    } else {
                        $batchInfo = 'No Batch Data';
                    }

                    return $batchInfo;
                })
                ->addColumn('item', fn($row) => $row->item->item ?? 'Unknown Item')
                ->addColumn('quantity', fn($row) => $row->quantity)
                ->addColumn('status', function ($row) {
                    // Format the status column
                    $column = '';
                    if ($row->status === 'pending') {
                        $column .= '<div class="bg-warning rounded-1 text-white p-1">' . ucfirst($row->status) . '</div>';
                    } else if ($row->status === 'confirmed') {
                        $column .= '<div class="bg-success rounded-1 text-white p-1">' . ucfirst($row->status) . '</div>';
                    }
                    return $column;
                })
                ->addColumn('change_status', function ($row) {
                    $actions = '<div class="text-center">';
                    if ($row->status === 'pending') {
                        $actions .= '<a href="' . route('admin/confirm-sale', $row->sale_id) . '" class="btn btn-primary btn-sm">Confirm</a>';
                    } else if ($row->status === 'confirmed') {
                        $actions .= 'Not Allowed';
                    }
                    $actions .= '</div>';
                    return $actions;
                })
                ->addColumn('action', function ($row) {
                    $actions = '<div class="text-center">';
                    if ($row->status === 'pending') {
                        $actions .= '<a href="javascript:void(0);" id="editBtn" class="edit m-2 btn btn-success btn-sm" data-sale_id="' . $row->sale_id . '" data-fancybox data-src="#edit-form">Edit</a>';

                        $actions .= '<a href="' . route('admin/destroy-sale', $row->sale_id) . '" class="btn m-2 btn-danger btn-sm">Delete</a>';
                    } else if ($row->status === 'confirmed') {
                        $actions .= 'Not Allowed';
                    }
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['batch_ids', 'change_status', 'status', 'action'])
                ->make(true);
        }

        return view('admin/sales/sales', compact('items'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,items_id',
            'quantity' => 'required|numeric|min:1',
            'sale_price' => 'required|numeric|min:1',
        ]);

        $remainingStock = InventoryTracking::getRemainingStock($request->item_id);
        if ($request->quantity > $remainingStock) {
            return redirect()->back()->with('error', 'Insufficient stock for this item.');
        }

        $batches = BatchesModel::where('item_id', $request->item_id)
            ->where('expiry_date', '>', now())
            ->where('quantity', '>', 0)
            ->orderBy('expiry_date', 'asc')
            ->get();

        if ($batches->isEmpty()) {
            return redirect()->back()->with('error', 'No valid batch found for this item.');
        }

        $batchData = [];
        $remainingQuantity = $request->quantity;

        foreach ($batches as $batch) {
            if ($remainingQuantity <= 0) {
                break;
            }

            $usedQuantity = min($batch->quantity, $remainingQuantity);
            $batchData[] = [
                'batch_id' => $batch->batch_id,
                'quantity' => $usedQuantity,
            ];
            $remainingQuantity -= $usedQuantity;
        }

        if ($remainingQuantity > 0) {
            return redirect()->back()->with('error', 'Insufficient stock across all available batches.');
        }

        SalesModel::create([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'sale_price' => $request->sale_price,
            'batch_ids' => json_encode($batchData),
            'status' => 'pending',
        ]);

        return redirect()->route('admin/sales')->with('success', 'Sale Order created successfully.');
    }

    public function update(Request $request, $sale_id)
    {
        $request->validate([
            'item_id' => 'required|exists:items,items_id',
            'quantity' => 'required|numeric|min:1',
            'sale_price' => 'required|numeric|min:1',
        ]);

        // Fetch the sale to be updated
        $sale = SalesModel::findOrFail($sale_id);

        // Check if the item has changed
        if ($sale->item_id != $request->item_id) {
            // Check stock availability for the new item
            $remainingStock = InventoryTracking::getRemainingStock($request->item_id);
            if ($request->quantity > $remainingStock) {
                return redirect()->back()->with('error', 'Insufficient stock for this item.');
            }
        } else {
            // Check if the quantity has been updated, and check stock accordingly
            if ($request->quantity != $sale->quantity) {
                $remainingStock = InventoryTracking::getRemainingStock($request->item_id);
                if ($request->quantity > $remainingStock) {
                    return redirect()->back()->with('error', 'Insufficient stock for this item.');
                }
            }
        }

        // Fetch batches in FIFO order (oldest expiry first) and filter out expired/empty batches
        $batches = BatchesModel::where('item_id', $request->item_id)
            ->where('expiry_date', '>', now())
            ->where('quantity', '>', 0)
            ->orderBy('expiry_date', 'asc')
            ->get();

        if ($batches->isEmpty()) {
            return redirect()->back()->with('error', 'No valid batch found for this item.');
        }

        $batchData = []; // To hold batch usage data
        $remainingQuantity = $request->quantity;

        foreach ($batches as $batch) {
            if ($remainingQuantity <= 0) {
                break;
            }

            $usedQuantity = min($batch->quantity, $remainingQuantity);
            $batchData[] = [
                'batch_id' => $batch->batch_id,
                'quantity' => $usedQuantity,
            ];
            $remainingQuantity -= $usedQuantity;
        }

        // If some quantity is still left, it means insufficient batches
        if ($remainingQuantity > 0) {
            return redirect()->back()->with('error', 'Insufficient stock across all available batches.');
        }

        // Update sale with new batch data and other details
        $sale->item_id = $request->item_id;
        $sale->quantity = $request->quantity;
        $sale->sale_price = $request->sale_price;
        $sale->batch_ids = json_encode($batchData); // Update batch data
        $sale->status = 'pending'; // Ensure the status remains pending for confirmation
        $sale->save();

        return redirect()->route('admin/sales')->with('success', 'Sale Order updated successfully.');
    }

    public function confirm($sale_id)
    {
        $sale = SalesModel::findOrFail($sale_id);

        if ($sale->status !== 'pending') {
            return redirect()->back()->with('error', 'Sale already confirmed or invalid.');
        }

        $batchData = json_decode($sale->batch_ids, true);
        if (!$batchData || !is_array($batchData)) {
            return redirect()->back()->with('error', 'Invalid batch data for this sale.');
        }

        foreach ($batchData as $batchInfo) {
            $batch = BatchesModel::find($batchInfo['batch_id']);
            if ($batch) {
                $batch->quantity -= $batchInfo['quantity'];
                $batch->save();

                InventoryTracking::create([
                    'item_id' => $sale->item_id,
                    'change_type' => 'sale',
                    'change_quantity' => $batchInfo['quantity'],
                    'remaining_stock' => InventoryTracking::calculateRemainingStock($sale->item_id, $batchInfo['quantity'], 'sale'),
                    'batch_id' => $batch->batch_id,
                ]);
            }
        }

        $sale->status = 'confirmed';
        $sale->save();

        return redirect()->route('admin/sales')->with('success', 'Sale confirmed successfully.');
    }

    public function destroy($sale_id)
    {
        $sale = SalesModel::findOrFail($sale_id);

        if ($sale->status === 'confirmed') {
            return redirect()->back()->with('error', 'Confirmed sales cannot be deleted.');
        }

        $sale->delete();

        return redirect()->route('admin/sales')->with('success', 'Sale deleted successfully.');
    }

    public function getItemDetails(Request $request)
    {
        $itemId = $request->item_id;

        $item = ItemsModel::find($itemId);
        $unit = $item->unit->name;

        if ($item) {
            $availableStock = InventoryTracking::getRemainingStock($request->item_id);

            return response()->json([
                'status' => 'success',
                'selling_price' => $item->selling_price,
                'available_stock' => $availableStock,
                'unit' => $unit
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Item not found']);
    }

    public function getSaleDetails($sale_id)
    {
        $sale = SalesModel::find($sale_id);
        $item_id = $sale->item_id;
        $quantity = $sale->quantity;
        $sale_price = $sale->sale_price;

        if ($sale) {
            return response()->json([
                'status' => 'success',
                'item_id' => $item_id,
                'quantity' => $quantity,
                'sale_price' => $sale_price
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Sale not found']);
    }

}
