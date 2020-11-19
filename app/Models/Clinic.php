<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = ['id', 'name'];

    public function visits()
    {
        return $this->hasMany('App\Visit');
    }
}
