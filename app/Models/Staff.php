<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use Notifiable;

    protected $guard = 'staff'; // Define the guard

    protected $fillable = ['name', 'email', 'password', 'dob'];

    protected $hidden = ['password', 'remember_token'];
}
