<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use SoftDeletes;
    protected $fillable = ['id', 'patient_id', 'user_id', 'mph', 'height', 'weight', 'bmi', 'systolic_bp', 'diastolic_bp', 'clinical_notes', 'treatment'];




    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function tests()
    {
        return $this->belongsToMany('App\Test')->withTimestamps()->withPivot('value');
    }
}
