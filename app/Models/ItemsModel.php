<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemsModel extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'items';
    protected $primaryKey = 'items_id';

    protected $fillable = [
        'item',
        'subcategory_id',
        'category_id',
        'measurement_category',
        'units_id',
        'measurement_value',
        'buying_price',
        'selling_price'
    ];

    protected $dates = 'deleted_at';

    public function category()
    {
        return $this->belongsTo(CategoriesModel::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubcategoriesModel::class, 'subcategory_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'units_id');
    }

    public function batches()
    {
        return $this->hasMany(BatchesModel::class, 'item_id', 'items_id');
    }

    public function inventoryTrackings()
    {
        return $this->hasMany(InventoryTracking::class, 'item_id','items_id');
    }

}