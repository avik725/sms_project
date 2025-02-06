<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BatchesModel;
use App\Models\CategoriesModel;
use App\Models\InventoryTracking;
use App\Models\ItemsModel;
use App\Models\SubcategoriesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function Dashboard()
    {

        $transaction = InventoryTracking::latest()->limit(5)->get();

        $batches = BatchesModel::where('expiry_date', '>', now())
            ->where('quantity', '>', 0)
            ->orderBy('expiry_date', 'asc')
            ->limit('5')
            ->get();

        $items = ItemsModel::get();
        $categories = CategoriesModel::get();

        return view('admin/dashboard', compact('transaction', 'batches', 'items','categories'));
    }

    public function getStockLevels($item_id)
    {
        $stock_level = InventoryTracking::getRemainingStock($item_id);
        $item = ItemsModel::with(['unit'])->find($item_id);

        $unit = $item->unit->name;
        $category_name = $item->category->category;
        $category_name = $item->category->category;
        $subcategory_name = $item->subcategory->subcategory;

        if ($stock_level !== null) {
            return response()->json([
                'status' => 'success',
                'stock_level' => $stock_level,
                'unit' => $unit,
                'category_name' => $category_name,
                'subcategory_name' => $subcategory_name,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Stock level could not be fetched',
                'stock_level' => 0,
                'unit' => '',
                'category_name' => 'NA',
                'subcategory_name' => '',
            ]);
        }
    }

    public function getNoOfItems($category_id){
        $No_of_items = ItemsModel::where('category_id',$category_id)->count();
        $subcategories = SubcategoriesModel::where('category_id',$category_id)->get('subcategory');

        if($category_id !== null){
            return response()->json([
                'status' => 'success',
                'no_of_items' => $No_of_items,
                'subcategories' => $subcategories,
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'no_of_items' => 'Error Occured',
                'subcategories' => 'NA',
            ]);
        }
    }
}
