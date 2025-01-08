<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $inventory->delete();

        return redirect()->route('transactions')->with('success','Transaction Deleted Successfully...!');
    }
}
