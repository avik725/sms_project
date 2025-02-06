<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BatchesModel;
use App\Models\InventoryTracking;
use App\Models\ItemsModel;
use App\Models\PurchasesModel;
use App\Models\SuppliersModel;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class PurchasesController extends Controller
{
    public function index(Request $request)
    {
        $items = ItemsModel::get();
        $suppliers = SuppliersModel::get();

        if ($request->ajax()) {

            $data = PurchasesModel::with(['item', 'supplier', 'batch'])->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('batch_id', fn($row) => $row->batch ? $row->batch->batch_id : 'Not Fulfilled')
                ->addColumn('item', fn($row) => $row->item->item ?? 'Unknown Item')
                ->addColumn('supplier', fn($row) => $row->supplier->name ?? 'Unknown Supplier')
                ->addColumn('quantity', fn($row) => $row->quantity)
                ->addColumn('expiry_date', fn($row) => $row->expiry_date)
                ->addColumn('status', function($row){
                    $column = '';
                    if ($row->status === 'order placed') {
                        $column .= '<div class="bg-warning rounded-1 text-white p-1">'.ucfirst($row->status).'</div>';
                    }
                    else if($row->status === 'fulfilled'){
                        $column .= '<div class="bg-success rounded-1 text-white p-1">'.ucfirst($row->status).'</div>';
                    }
                    return $column;
                })
                ->addColumn('change_status',function ($row){
                    $column = '<div>';
                    if ($row->status === 'order placed') {
                        $column .= '<a href="' . route('fulfill-purchase', $row->purchase_id) . '" class="btn btn-info py-2 px-3 btn-sm">Fulfill</a>';
                    }
                    else if($row->status === 'fulfilled'){
                        $column .= 'Not Allowed';
                    }
                    $column .= '</div>';
                    return $column;
                })
                ->addColumn('action', function ($row) {
                    $actions = '<div>';
                    if ($row->status === 'order placed') {
                        $actions .= '<a href="javascript:void(0);" id="editBtn" class="edit m-2 btn btn-success btn-sm" data-purchase_id="' . $row->purchase_id . '" data-fancybox data-src="#edit-form">Edit</a>';
                        
                        $actions .= '<a href="' . route('destroy-purchase', $row->purchase_id) . '" class="btn btn-danger m-2 btn-sm">Delete</a>';
                    }
                    else if($row->status === 'fulfilled'){
                        $actions .= 'Not Allowed';
                    }
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['status','change_status','action'])
                ->make(true);

        }

        return view('admin/purchase/purchase',compact('items','suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,items_id',
            'supplier_id' => 'required|exists:suppliers,suppliers_id',
            'quantity' => 'required|numeric|min:1',
            'expiry_date' => 'nullable|date',
        ]);

        PurchasesModel::create([
            'item_id' => $request->item_id,
            'supplier_id' => $request->supplier_id,
            'quantity' => $request->quantity,
            'expiry_date' => $request->expiry_date,
            'status' => 'order placed',
        ]);

        return redirect()->route('purchases')->with('success', 'Purchase Order Created Successfully...!');
    }

    public function update(Request $request,$purchase_id)
    {
        $request->validate([
            'item_id' => 'required|exists:items,items_id',
            'supplier_id' => 'required|exists:suppliers,suppliers_id',
            'quantity' => 'required|numeric|min:1',
            'expiry_date' => 'nullable|date',
        ]);

        $purchase = PurchasesModel::findOrFail($purchase_id);
        $purchase->update($request->all());

        return redirect()->route('purchases')->with('success', 'Purchase Order Updated Successfully...!');
    }
    public function fulfill($purchase_id)
    {
        $purchase = PurchasesModel::findOrFail($purchase_id);

        if ($purchase->status !== 'order placed') {
            return redirect()->route('purchases')->with('error', 'Order already fulfilled.');
        }

        // Create a new batch
        $batch = BatchesModel::create([
            'item_id' => $purchase->item_id,
            'supplier_id' => $purchase->supplier_id,
            'quantity' => $purchase->quantity,
            'expiry_date' => $purchase->expiry_date,
        ]);

        // Update purchase with batch ID and status
        $purchase->update([
            'batch_id' => $batch->batch_id,
            'status' => 'fulfilled',
        ]);

        // Insert into inventory tracking
        InventoryTracking::create([
            'item_id' => $purchase->item_id,
            'batch_id' => $batch->batch_id,
            'change_type' => 'restock',
            'change_quantity' => $purchase->quantity,
            'remaining_stock' => InventoryTracking::calculateRemainingStock($purchase->item_id, $purchase->quantity, 'restock'),
        ]);

        return redirect()->route('purchases')->with('success', 'Purchase Order Fulfilled Successfully.');
    }

    public function destroy($purchase_id)
    {
        $purchase = PurchasesModel::findOrFail($purchase_id);
        $purchase->delete();

        return redirect()->route('purchases')->with('success', 'Purchase Order Deleted Successfully.');
    }

    public function getPurchaseDetails($purchase_id){
        $purchase = PurchasesModel::findOrFail($purchase_id);

        return response()->json($purchase);
    }
}
