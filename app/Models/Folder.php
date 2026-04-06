<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
     // These are the columns Laravel is allowed to "mass assign"
    protected $fillable = [
        'user_id', 
        'name', 
        'password'
    ];

    // Optional: Define relationship to User
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    // Optional: Define relationship to Files
    public function files() {
        return $this->hasMany(File::class);
    }
    
    public function sharedWith()
    {
        return $this->belongsToMany(User::class, 'folder_user');
    }

}
