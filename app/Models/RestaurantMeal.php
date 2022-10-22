<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantMeal extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'restaurantmeals';
    protected $fillable = ['id','resturant_category_id','name_ar','name_en','description_ar','description_en','price','image','created_at','updated_at','deleted_at'];
}
