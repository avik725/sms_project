<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BatchesModel extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'batches';

    protected $primaryKey = 'batch_id';

    protected $fillable = [
        'item_id',
        'supplier_id',
        'quantity',
        'expiry_date',
    ];
    protected $dates = 'deleted_at';

    // Relationships
    public function item()
    {
        return $this->belongsTo(ItemsModel::class, 'item_id', 'items_id');
    }

    public function supplier()
    {
        return $this->belongsTo(SuppliersModel::class, 'supplier_id', 'suppliers_id');
    }

    public function getBuyingPrice()
    {
        return $this->item->buying_price; // Assume 'price' in the items table is the buying price
    }

    public function inventoryTrackings()
    {
        return $this->hasMany(InventoryTracking::class, 'batch_id');
    }

}
