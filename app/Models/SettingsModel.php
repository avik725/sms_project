<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingsModel extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'settings';

    protected $primaryKey = 'settings_id';

    protected $fillable = ['settings_id','short_name','project_name','project_logo','login_bg'];

    protected $dates = 'deleted_at';
}
