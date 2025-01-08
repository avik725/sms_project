<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoriesModel;
use App\Models\SubcategoriesModel;
use DataTables;

class CategoriesController extends Controller
{
    // Display all categories with their subcategories
    public function index(Request $request)
    {
        $categories = CategoriesModel::with('subcategories')->get();
        $countOfCategories = CategoriesModel::count();
        if ($request->ajax()) {
            $data = CategoriesModel::with('subcategories')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('subcategories', function ($row) {
                    if (count($row->subcategories) > 0) {
                        return $row->subcategories->pluck('subcategory')->implode(', ');
                    } else {
                        return "<-- No Sub-Categories Found -->";
                    }
                })
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('admin/destroy-categories', ['category_id' => $row->category_id]);
                    $csrfToken = csrf_token();
                    return '
                    <form action="' . $deleteUrl . '" method="GET" style="display:inline-block;">
                        ' . method_field('DELETE') . '
                        <input type="hidden" name="_token" value="' . $csrfToken . '">
                        <a href="' . $deleteUrl . '" class="delete btn btn-danger btn-sm Delete-button">Delete</a>
                    </form>';

                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/categories/categories', compact('categories', 'countOfCategories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255'
        ]);

        $data = ['category' => $request->category];
        CategoriesModel::create($data);

        return redirect()->route('admin/categories')->with('success', 'Category Created successfully!');
    }

    public function storeSubcategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,category_id', // Validate that the category exists
            'subcategory' => 'required|string|max:255',
        ]);

        // Create the subcategory with the associated category ID
        $data = [
            'category_id' => $request->category_id,
            'subcategory' => $request->subcategory,
        ];

        SubcategoriesModel::create($data);

        return redirect()->route('admin/categories')->with('success', 'Sub-Category Created successfully!');
    }


    public function destroyCategory($category_id)
    {
        $category = CategoriesModel::findOrFail($category_id);
        $category->subcategories()->forceDelete();
        $category->forceDelete();

        return redirect()->route('admin/categories')->with('success', 'Category Deleted successfully!');
    }
}
