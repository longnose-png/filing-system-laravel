<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'user_id', 
        'folder_id', 
        'name', 
        'path', 
        'type', 
        'size'
    ];

    public function folder() {
        return $this->belongsTo(Folder::class);
    }
}