<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BatchesModel;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;


class BatchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = BatchesModel::with(['item', 'supplier'])->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('batch_id', fn($row) => $row->batch_id)
                ->addColumn('item', fn($row) => $row->item->item ?? 'Unknown Item')
                ->addColumn('supplier', fn($row) => $row->supplier->name ?? 'Unknown Supplier')
                ->addColumn('quantity', fn($row) => $row->quantity)
                ->addColumn('expiry_date', fn($row) => $row->expiry_date)
                ->addColumn('status', function ($row) {
                    if (!$row->expiry_date) {
                        return '<div class="badge badge-secondary">No Expiry Date</div>';
                    }
            
                    return $row->expiry_date > now()
                        ? '<div class="badge fw-semibold text-bg-success">Usable</div>'
                        : '<div class="badge fw-semibold text-bg-danger">Expired</div>';
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('admin/batch/batch');
    }
}
