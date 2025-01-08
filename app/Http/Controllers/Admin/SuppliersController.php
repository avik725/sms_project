<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuppliersModel;
use Illuminate\Http\Request;
use DataTables;

class SuppliersController extends Controller
{
    public function Suppliers(Request $request)
    {
        if ($request->ajax()) {
            // Handle DataTables logic
            $data = SuppliersModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // $editUrl = route('admin/supplier-data', ['suppliers_id' => $row->suppliers_id]);
                    $deleteUrl = route('admin/delete-suppliers', ['suppliers_id' => $row->suppliers_id]);
                    $csrfToken = csrf_token();

                    return '
                <a href="javascript:void(0);" id="editBtn" class="edit btn btn-success m-2 btn-sm" data-suppliers_id="'.$row->suppliers_id.'" data-fancybox data-src="#edit-form" data-width="1024"">Edit</a>
                <form action="' . $deleteUrl . '" method="GET" style="display:inline-block;">
                    ' . method_field('DELETE') . '
                    <input type="hidden" name="_token" value="' . $csrfToken . '">
                    <a href="' . $deleteUrl . '" class="delete btn btn-danger m-2 btn-sm Delete-button">Delete</a>
                </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/suppliers/suppliers');
    }

    public function getSupplierData($suppliers_id)
    {
        // Fetch the supplier data by ID
        $supplier_data = SuppliersModel::find($suppliers_id);

        // If supplier data doesn't exist, return an error
        if (!$supplier_data) {
            return response()->json(['error' => 'Supplier not found.'], 404);
        }

        // Return the supplier data as JSON
        return response()->json($supplier_data);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'category' => 'nullable|string|max:255',
            'gst_number' => 'nullable|string|max:20',
            'address' => 'required|string',
            'account_no' => 'nullable|string|max:20',
            'bank_name' => 'nullable|string|max:255',
            'ifsc_code' => 'nullable|string|max:20',
        ]);

        $supplier = new SuppliersModel();
        $supplier->name = $request->name;
        $supplier->contact_person = $request->contact_person;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->category = $request->category;
        $supplier->gst_number = $request->gst_number;
        $supplier->address = $request->address;
        $supplier->account_no = $request->account_no;
        $supplier->bank_name = $request->bank_name;
        $supplier->ifsc_code = $request->ifsc_code;
        $supplier->save();

        return redirect()->route('admin/suppliers')->with('success', 'Data Added successfully!');
    }


    public function update(Request $request, $suppliers_id)
    {
        $data = SuppliersModel::findOrFail($suppliers_id);

        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|digits:10|unique:suppliers,phone,'.$suppliers_id.',suppliers_id',
            'email' => 'nullable|email|unique:suppliers,email,'.$suppliers_id.',suppliers_id',
            'category' => 'nullable|string',
            'address' => 'nullable|string',
            'gst_number' => 'nullable|string|size:15',
            'account_no' => 'nullable|numeric|digits_between:10,20',
            'bank_name' => 'nullable|string|max:255',
            'ifsc_code' => 'nullable|string|size:11',
        ]);

        // Update only the fields that are provided in the request
        foreach ($validatedData as $key => $value) {
            if (!is_null($value)) {
                $data->$key = $value;
            }
        }

        $data->save();
        return redirect()->route('admin/suppliers')->with('success', 'Data Updated successfully!');
    }

    public function destroy($suppliers_id)
    {
        $data = SuppliersModel::findOrFail($suppliers_id);
        $data->forceDelete();

        return redirect()->route('admin/suppliers')->with('success', 'Data Deleted Successfully');
    }

}
