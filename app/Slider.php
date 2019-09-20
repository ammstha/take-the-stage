<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $fillable = [
       'title','description'
    ];

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
