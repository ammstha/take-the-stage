<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Performer extends Model
{
    protected $table='performers';
    protected $fillable = [
        'first_name', 'last_name','DOB','sex','performance_levels_id','studio_id',
    ];

    public function studio()
    {
        return $this->belongsTo(User::class,'studio_id');
    }

    public function performanceLevel(){
        return $this->belongsTo(PerformanceLevel::class,'performance_levels_id');
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['DOB'])->age;
    }

    public function performerEntries()
    {
        return $this->belongsToMany(PerformerEntry::class);
    }
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

}
