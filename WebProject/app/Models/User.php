<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    // Use HasFactory for model factory and Notifiable for notifications
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * These are the attributes that can be set using mass-assignment.
     * @var array<int, string>
     */
    protected $fillable = [
        'name',         // User's name
        'email',        // User's email address
        'password',     // User's password (hashed)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * These attributes are not visible when the model is converted to an array or JSON.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',     // Hide password for security
        'remember_token', // Hide remember_token
    ];

    /**
     * Get the attributes that should be cast.
     *
     * This allows attributes to be automatically cast to a specific data type.
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Cast the email_verified_at attribute to a datetime
            'password' => 'hashed',            // Ensure password is hashed for storage
        ];
    }
}
