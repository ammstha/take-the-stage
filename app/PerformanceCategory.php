<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceCategory extends Model
{
    protected $table='performance_categories';
    protected $fillable = [
        'name',
    ];

    public function performerEntries()
    {
        return $this->belongsToMany(PerformerEntry::class);
    }
}
