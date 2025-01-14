<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesModel extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'sales';

    protected $primaryKey = 'sale_id';

    protected $fillable = [
        'item_id',
        'quantity',
        'sale_price',
        'batch_ids',
    ];

    protected $dates = 'deleted_at';

    public function item()
    {
        return $this->belongsTo(ItemsModel::class, 'item_id', 'items_id');
    }

    public function batch()
    {
        return $this->belongsTo(BatchesModel::class, 'batch_id', 'batch_id');
    }
}
