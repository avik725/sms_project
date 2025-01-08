<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubcategoriesModel extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'subcategories';
    protected $primaryKey = 'subcategory_id';
    protected $fillable = ['category_id', 'subcategory'];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(CategoriesModel::class, 'category_id');
    }
}