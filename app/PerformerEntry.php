<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformerEntry extends Model
{
    protected $table='performer_entries';
    protected $fillable = [
        'title', 'music','division','average_age','age_class','performance_level','user_id','competitionDetail_id','exceed','donate','prop','status','orderBy'
    ];

    public function file()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function performers()
    {
        return $this->belongsToMany(Performer::class);
    }

    public function performanceCategories()
    {
        return $this->belongsToMany(PerformanceCategory::class,'performance_category_performer_entry','performer_entry_id','P_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function competitionDetail()
    {
        return $this->belongsTo(CompetitionDetail::class,'competitionDetail_id','id');
    }

    public function eventDateTime()
    {
        return $this->belongsTo(EventDateTime::class,'eventDateTime_id','id');
    }
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getAverageAgeAttribute($value)
    {
        return number_format($value,0);
    }

    public static  function getPerformerEntriesByDivisionNLevel($id){

//        $performerEntries=self::select('performer_entries.*')
//            ->orderByRaw("FIELD(division , 'Solo', 'Duo/Trio', 'Small Group', 'Large Group') ASC")
//            ->where('status','=',1)
//            ->get();


        $performerEntries=PerformerEntry::where('competitionDetail_id',$id)
        ->orderByRaw("FIELD(division , 'Solo', 'Duo/Trio', 'Small Group', 'Large Group') ASC")
            ->where('status','=',1)
            ->get();

//        dd($performerEntries);

//        $performerEntries=self::orderByRaw("FIELD(performance_level , 'Amature', 'Competitive','Elite','Pro-Am') ASC")
////        orderByRaw("FIELD(division , 'Solo', 'Duo/Trio', 'Small Group', 'Large Group') ASC")
//            ->where('status','=',1)
//            ->get();

        return $performerEntries;
    }

}
