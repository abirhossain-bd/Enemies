<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BlogComment extends Model
{
    use HasFactory;

    protected $guarded = [""];

    // Relationship with User model
    public function oneuser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // Replies relationship to get child comments
    public function replies(){
        return $this->hasMany(BlogComment::class, 'parent_id');
    }
}
