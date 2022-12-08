<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='banners';
//    protected $keyType = 'int';
    protected $fillable=[
        'id','banner_url','order','created_at', 'updated_at', 'delete_at'
    ];
}
