<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgeClass extends Model
{
    protected $table='age_classes';
    protected $fillable = [
         'classes','age'
    ];
}
