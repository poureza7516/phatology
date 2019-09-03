<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{

    public function Reception()
    {
        return $this->belongsTo(Reception::class);
    }
}
