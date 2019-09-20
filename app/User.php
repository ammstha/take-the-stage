<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable 
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','studioX', 'approved_at','ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function performers()
    {
        return $this->hasMany('App\Performer', 'studio_id', 'id');
    }

    public function studio()
    {
        return $this->hasOne('App\Studio');
    }

    public function performerEntries(){
        return $this->hasMany(PerformerEntry::class);
    }
}

