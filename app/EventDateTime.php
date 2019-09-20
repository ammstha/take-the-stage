<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventDateTime extends Model
{
    protected $table='event_date_times';
    protected $fillable = [
       'date','time','remainingTime','competition_details_id'
    ];

    public function competitionDetails()
    {
        return $this->belongsTo(CompetitionDetail::class,'competition_details_id','id');
    }

    public function performerEntries(){
        return $this->hasMany(PerformerEntry::class);
    }

}
