<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = ['id', 'clinicName'];

    public function patients()
    {
        return $this->hasMany('App\Patient');
    }
}
