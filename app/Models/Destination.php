<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = ['id', 'destinationName'];

    public function patients()
    {
        return $this->hasMany('App\Patient');
    }
}
