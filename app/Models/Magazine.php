<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use Cachable;

    public function magazine()
    {
        $this->belongsTo('App\Publisher');
    }
}
