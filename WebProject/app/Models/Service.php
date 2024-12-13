<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory; // Use the factory for model instances

    // Define the fillable attributes for mass assignment
    protected $fillable = ['name', 'description', 'category', 'price', 'contact', 'user_id']; // Attributes that can be mass-assigned

    public function user()
    {
        return $this->belongsTo(User::class); // A service "belongs to" a user
    }
}
