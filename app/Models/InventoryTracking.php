<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryTracking extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'inventory_tracking';
    protected $primaryKey = 'inventory_tracking_id';
    protected $fillable = [
        'item_id',
        'batch_id',
        'change_type',
        'change_quantity',
        'remaining_stock'
    ];
    protected $dates = 'deleted_at';

    public function item()
    {
        return $this->belongsTo(ItemsModel::class, 'item_id','items_id');
    }

    public function batch()
    {
        return $this->belongsTo(BatchesModel::class, 'batch_id','batch_id');
    }

    public static function calculateRemainingStock($itemId, $changeQuantity, $changeType)
    {
        // Calculate current stock level
        $totalRestocked = self::where('item_id', $itemId)
            ->where('change_type', 'restock')
            ->sum('change_quantity');

        $totalSold = self::where('item_id', $itemId)
            ->where('change_type', 'sale')
            ->sum('change_quantity');

        $currentStock = $totalRestocked - $totalSold;

        // Adjust stock based on the current operation
        if ($changeType === 'restock') {
            return $currentStock + $changeQuantity;
        } elseif ($changeType === 'sale') {
            return $currentStock - $changeQuantity;
        }

        // If the type is unknown, return the current stock as-is
        return $currentStock;
    }
}
