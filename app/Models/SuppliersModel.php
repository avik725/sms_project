<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuppliersModel extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'suppliers';
    protected $primaryKey = 'suppliers_id';
    protected $fillable = [
        'name',
        'contact_person',
        'phone',
        'email',
        'category',
        'address',
        'gst_number',
        'account_no',
        'bank_name',
        'ifsc_code',
    ];
    protected $dates = 'deleted_at';

}
