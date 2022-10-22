<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantMealAddOns extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='restaurantmealaddons';
    protected $fillable = ['id','meal_id','add_on','created_at','updated_at','deleted_at'];
}
