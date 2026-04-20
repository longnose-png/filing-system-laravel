<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    // Ensure user_id is in the fillable array
    protected $fillable = ['user_id', 'ip_address', 'user_agent'];
}
