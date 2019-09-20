<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $table = 'studios';
    protected $fillable = [
        'user_id', 'title', 'director_name', 'address', 'city', 'state', 'zip', 'studio_phone', 'cell_phone','faculty'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
