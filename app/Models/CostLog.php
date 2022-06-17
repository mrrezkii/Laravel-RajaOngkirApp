<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostLog extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'cost_logs';
    protected $primaryKey = 'cost_log_id';
    protected $keyType = 'string';
    protected $fillable = ['cost_log_id', 'cost_id', 'courier', 'service', 'description', 'price', 'etd_day'];

    public function costs()
    {
        return $this->belongsTo(Cost::class, 'cost_id');
    }
}
