<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserOrderMealAddsOn extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='userordermealaddson';
    protected $fillable =[
        'id','order_meal_id','restaurant_add_on_element','created_at','updated_at','deleted_at'
    ];
}
