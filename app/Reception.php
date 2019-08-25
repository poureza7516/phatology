<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
protected $fillable=[
    'reception_date','answer_date','user_id','status','payment',
];

    public function User()
    {
        return $this->belongsTo(User::class) ;
    }


    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
