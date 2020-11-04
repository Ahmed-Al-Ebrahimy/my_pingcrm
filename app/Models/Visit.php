<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id', 'patient_id', 'user_id', 'mph', 'height', 'weight', 'bmi', 'systolic_bp', 'diastolic_bp', 'clinical_notes', 'treatment'];




    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class)->withTimestamps()->withPivot('value');
    }
}
