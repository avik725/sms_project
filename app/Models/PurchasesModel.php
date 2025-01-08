<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasesModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchases';
    protected $primaryKey = 'purchase_id';
    protected $fillable = [
        'item_id',
        'supplier_id',
        'quantity',
        'expiry_date',
        'status',
        'batch_id', // Added to track the related batch
    ];
    protected $dates = 'deleted_at';

    /**
     * Get the item associated with the purchase.
     */
    public function item()
    {
        return $this->belongsTo(ItemsModel::class, 'item_id', 'items_id');
    }

    public function supplier()
    {
        return $this->belongsTo(SuppliersModel::class, 'supplier_id', 'suppliers_id');
    }

    public function batch()
    {
        return $this->belongsTo(BatchesModel::class, 'batch_id', 'batch_id');
    }

}
