<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantMealAddOnElements extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='restaurantaddonelements';
    protected $fillable = ['id','restaurant_add_on_list_id','name_ar','name_en','created_at','updated_at','deleted_at'];
}
