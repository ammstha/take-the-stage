<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table='files';
    protected $fillable = [
        'file', 'fileable_id','fileable_type','path','meta'
    ];

    protected $appends = ['url'];

    public function fileable() {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return 'storage/'.$this->path;
    }
}
