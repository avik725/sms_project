<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryTracking;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display inventory tracking data.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = InventoryTracking::with(['item', 'batch'])->latest()->get();

            return datatables($data)
                ->addIndexColumn()
                ->addColumn('batch_id', fn($row) => $row->batch->batch_id ?? 'No Batch')
                ->addColumn('item', fn($row) => $row->item->item ?? 'Unknown Item')
                ->addColumn('change_type', fn($row) => ucfirst($row->change_type))
                ->addColumn('change_quantity',fn($row)=> $row->change_quantity)
                ->addcolumn('remaining_stock',fn($row)=> $row->remaining_stock)
                ->addColumn('action', function ($row) {
                    return '
                        <div>
                            <a href="' . route('admin/destroy-transactions', $row->inventory_tracking_id) . '" class="delete btn btn-danger btn-sm Delete-button">Delete</a>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin/inventory_tracking/transactions');
    }

    /**
     * Delete inventory tracking data.
     */
    public function destroy($inventory_tracking_id)
    {
        $inventory = InventoryTracking::findOrFail($inventory_tracking_id);
        $inventory_batch = InventoryTracking::with(['batch'])->where('inventory_tracking_id',$inventory_tracking_id)->first();

        if($inventory_batch->change_type === 'restock'){
            $inventory_batch->batch->quantity -= $inventory_batch->change_quantity;
            $inventory_batch->batch->save();
        }
        else if($inventory_batch->change_type === 'sale'){
            $inventory_batch->batch->quantity += $inventory_batch->change_quantity;
            $inventory_batch->batch->save();
        }
        
        $inventory->delete();

        return redirect()->route('admin/transactions')->with('success','Transaction Deleted Successfully...!');
    }
}
