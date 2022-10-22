<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantMealAddOnLists extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'restaurantaddonlists';
    protected $fillable = [
        'id','resturant_id','name_ar','type','created_at','updated_at','deleted_at'
    ];

}
