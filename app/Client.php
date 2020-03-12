<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
         'name', 'email','phone'
    ];

    public function event()
    {
        return $this->hasMany('App\Event');
    }
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
