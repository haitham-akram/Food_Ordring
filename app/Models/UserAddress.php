<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'useraddresses';
    protected $fillable = [
        'id', 'user_id', 'name', 'latitude', 'longitude',
        'details', 'created_at', 'updated_at', 'delete_at'
    ];
}
