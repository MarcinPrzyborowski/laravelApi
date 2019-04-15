<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    public function publishers()
    {
        return $this->hasMany('App\Magazine');
    }
}
