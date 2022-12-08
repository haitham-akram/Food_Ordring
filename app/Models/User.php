<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users';
    protected $fillable = [
        'id', 'country_code', 'phone_number', 'name', 'email', 'otp',
        'preferred_language', 'session', 'firebase', 'status',
        'created_at', 'updated_at', 'delete_at'
    ];

}
