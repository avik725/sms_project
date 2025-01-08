<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriesModel extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $fillable = ['category'];
    protected $dates = ['deleted_at'];

    public function subcategories()
    {
        return $this->hasMany(SubcategoriesModel::class, 'category_id');
    }
}
