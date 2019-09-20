<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceLevel extends Model
{
    protected $table='performance_levels';
    protected $fillable = [
        'name',
    ];
}
