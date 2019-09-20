<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $table='costs';

    protected $fillable = [
        'title','price','slug'
    ];
}
