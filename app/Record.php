<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public function patient()
    {
        return $this->belongsTo(User::class);
    }


    public function tests()
    {
        return  $this->hasMany(Test::class);
    }
}
