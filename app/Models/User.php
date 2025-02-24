<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Additional fields or methods specific to your User model
    protected $fillable = [
        'name', 'email', 'password', 'role', // Include 'role' as fillable
    ];

    // Add a method to check if the user is an admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
