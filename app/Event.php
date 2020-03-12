<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    protected $fillable = [
        'title', 'description', 'start_date','end_date','start_time','end_time','user_owner_id','client_id'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_owner_id');
    }
    public function client()
    {
        return $this->belongsTo('App\Event');
    }
    public function guest()
    {
        return $this->hasMany('App\Guest');
    }

}
