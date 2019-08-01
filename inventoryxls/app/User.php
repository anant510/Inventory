<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function buy(){
        return $this->belongsTo('App\Buy', 'buy_id', 'id');
    }
    public function sell(){
        return $this->belongsTo('App\Buy', 'sell_id', 'id');
    }

    public function sellPrice(){
    return $this->belongsTo('App\Sell', 'sid', 'id');
    }
}
