<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetitionDetail extends Model
{
    protected $table='competition_details';
    protected $fillable = [
       'name','eGroup','location', 'rebate_date','last_date_to_register'
    ];

    protected $casts = [
        'events' => 'array',
    ];
    
    public function performerEntries(){
        return $this->hasMany(PerformerEntry::class);
    }


    public function eventDateTimes(){
        return $this->hasMany(EventDateTime::class,'competition_details_id','id');
    }

}
