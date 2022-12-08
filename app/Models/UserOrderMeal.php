<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserOrderMeal extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='userordermeals';
    protected $fillable =[
        'id','order_id','meal_id','meal_price','quantity','created_at','updated_at','deleted_at'
    ];
}
