<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'password',
        'phone',
        'address',
        'role_id',
        'photo',
        'status'
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }
}
