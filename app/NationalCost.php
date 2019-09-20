<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NationalCost extends Model
{
    protected $table='national_costs';

    protected $fillable = [
        'title','price','slug'
    ];
}
