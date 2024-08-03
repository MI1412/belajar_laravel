<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['user_id', 'path', 'title', 'description'];


    // relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
