<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;

    // Guarded attributes
    protected $guarded = []; // Use an empty array to allow all attributes to be mass assignable

    // Relationship with Category
    public function oneCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id'); // Use belongsTo for category relation
    }

    // Relationship with User
    public function oneUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Use belongsTo for user relation
    }
}
