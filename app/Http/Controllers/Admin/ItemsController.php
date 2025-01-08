<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\ItemsModel;
use App\Models\SubcategoriesModel;
use App\Models\Unit;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Log;

class ItemsController extends Controller
{
    public function index(Request $request)
    {
        $categories = CategoriesModel::all();
        $subcategories = SubcategoriesModel::all();
        $units = Unit::all();

        if ($request->ajax()) {
            $data = ItemsModel::with(['category', 'subcategory', 'unit'])->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category', fn($row) => $row->category ? $row->category->category : '<-- No Category Found -->')
                ->addColumn('subcategory', fn($row) => $row->subcategory ? $row->subcategory->subcategory : '<-- No Sub-Category Found -->')
                ->addColumn('unit', fn($row) => $row->unit ? $row->unit->name : '<-- No Unit Found -->')
                ->addColumn('measurement_value', function ($row) {
                    return $row->measurement_value; // Leave as is for other categories
                })
                ->addColumn('buying_price', function ($row) {
                    return $row->buying_price == (int) $row->buying_price ? '₹ ' . (int) $row->buying_price : '₹ ' . $row->buying_price;
                })
                ->addColumn('selling_price', function ($row) {
                    return $row->selling_price == (int) $row->selling_price ? '₹ ' . (int) $row->selling_price : '₹ ' . $row->selling_price;
                })
                ->addColumn('action', fn($row) =>
                    '<div class="text-center">
                    <a href="javascript:void(0);" id="editBtn" class="edit m-2 btn btn-success btn-sm" data-items_id="' . $row->items_id . '" data-fancybox data-src="#edit-form">Edit</a>
                <a href="' . route('admin/destroy-items', $row->items_id) . '" class="delete btn btn-danger btn-sm Delete-button">Delete</a>
                </div>')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin/items/items', compact('categories', 'subcategories', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'subcategory_id' => 'required|exists:subcategories,subcategory_id',
            'measurement_category' => 'required|in:Weight,Volume,Count',
            'units_id' => 'required|exists:units,units_id',
            'measurement_value' => 'required|numeric|min:0.01',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);

        ItemsModel::create($request->all());

        return redirect()->route('admin/items')->with('success', 'Item Added Successfully!');
    }

    public function update(Request $request, $items_id)
    {
        $request->validate([
            'item' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'subcategory_id' => 'required|exists:subcategories,subcategory_id',
            'measurement_category' => 'required|in:Weight,Volume,Count',
            'units_id' => 'required|exists:units,units_id',
            'measurement_value' => 'required|numeric|min:0.01',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);

        $item = ItemsModel::findOrFail($items_id);
        $item->update($request->all());

        return redirect()->route('admin/items')->with('success', 'Item Updated Successfully!');
    }

    public function destroy($items_id)
    {
        $item = ItemsModel::findOrFail($items_id);
        $item->delete();

        return redirect()->route('admin/items')->with('success', 'Item Deleted Successfully!');
    }

    public function getSubcategories(Request $request)
    {
        if ($request->ajax()) {
            $subcategories = SubcategoriesModel::where('category_id', $request->category_id)->get();
            return response()->json($subcategories);
        }
    }

    public function getItem($items_id)
    {
        $item = ItemsModel::find($items_id);

        if (!$item) {
            Log::error('Item not found for ID: ' . $items_id);  // Log the missing item ID
            return response()->json(['error' => 'Item not found'], 404);
        }

        Log::info('Item data fetched for ID: ' . $items_id, ['item' => $item]);  // Log the fetched item data
        return response()->json($item);
    }

    public function getUnits(Request $request)
    {
        if ($request->ajax()) {
            $units = Unit::where('type', $request->measurement_category)->get();
            return response()->json($units);
        }
    }

    public function getEditUnits(Request $request)
    {
        if ($request->ajax()) {
            $units = Unit::where('units_id', $request->units_id)->get();
            return response()->json($units);
        }
    }
}
