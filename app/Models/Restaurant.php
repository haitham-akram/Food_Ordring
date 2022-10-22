<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='restaurants';
    protected $fillable = [
        'id','name_ar', 'name_en', 'description_ar', 'description_en',
        'latitude', 'longitude','logo','cover_image',
        'monday_open_at','monday_close_at','tuesday_open_at','tuesday_close_at',
        'wednesday_open_at','wednesday_close_at','thursday_open_at','thursday_close_at',
        'friday_open_at','friday_close_at','saturday_open_at','saturday_close_at',
        'sunday_open_at','sunday_close_at','status','created_at','updated_at','deleted_at'
    ];
}
