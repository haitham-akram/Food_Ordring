<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'restaurantcategories';
    protected $fillable = ['id','resturant_id','name_ar','name_en','created_at','updated_at','deleted_at'];
}
