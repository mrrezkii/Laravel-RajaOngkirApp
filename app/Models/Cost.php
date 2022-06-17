<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'costs';
    protected $primaryKey = 'cost_id';
    protected $keyType = 'string';
    protected $fillable = ['cost_id', 'courier', 'service', 'description', 'price', 'etd_day'];
}
