<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'cities';
    protected $primaryKey = 'city_id';
    protected $keyType = 'string';
    protected $fillable = ['city_id', 'province_id', 'province', 'type', 'city_name', 'postal_code'];
}
