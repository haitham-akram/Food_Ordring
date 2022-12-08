<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'countries';
    protected $fillable = [
        'id','country_code','country_name_ar','country_name_en',
        'country_flag','selected','created_at','updated_at','deleted_at'
    ];
}
