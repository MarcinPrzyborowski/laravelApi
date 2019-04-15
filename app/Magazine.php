<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    public function magazine()
    {
        $this->belongsTo('App\Publisher');
    }
}
