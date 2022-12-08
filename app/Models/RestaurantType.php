<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantType extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='restauranttypes';
    protected $fillable = ['id','resturant_id','type_id','created_at','updated_at','deleted_at'];
}
