<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use Cachable;

    public function publishers()
    {
        return $this->hasMany('App\Magazine');
    }
}
