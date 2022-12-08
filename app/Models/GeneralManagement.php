<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralManagement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'generalmanagements';
    protected $fillable = [
        'id','show_resturant_distance','show_closed_restaurants'
        ,'show_restaurant_working_hours','maximum_range_users_see'
        ,'price_per_kilometer','delivery_price_from','available_payment'
        ,'created_at','updated_at','deleted_at'
    ];
}
