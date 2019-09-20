<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';
    protected $fillable = [
        'title','description'
    ];

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
