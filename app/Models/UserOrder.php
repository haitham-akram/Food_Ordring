<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserOrder extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='userorders';
    protected $fillable =[
        'id','user_id','resturant_id','order_number','total_price','order_price','delivery_price',
        'payment_method','latitude','longitude','status','delivered_at','created_at','updated_at','deleted_at'
    ];
}
