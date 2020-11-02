<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['id', 'name',  'birth_date',  'gender', 'marital_status_id', 'address_id', 'smoking_id', 'user_id'];



    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }

    public function scopeFilter($query, array $filters)
    {

            $query->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('id', '=', $search)
                    ->orWhere('name', 'like', '%'.$search)
                    ->orWhereHas('address', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    });
                });
            })->when($filters['trashed'] ?? null, function ($query, $trashed) {
                if ($trashed === 'with') {
                    $query->withTrashed();
                } elseif ($trashed === 'only') {
                    $query->onlyTrashed();
                }
            });
    }

    // public function scopeFilter($query, array $filters)
    // {
    //     $query->when($filters['search'] ?? null, function ($query, $search) {
    //         $query->where(function ($query) use ($search) {
    //             $query->where('first_name', 'like', '%'.$search.'%')
    //                 ->orWhere('last_name', 'like', '%'.$search.'%')
    //                 ->orWhere('email', 'like', '%'.$search.'%')
    //                 ->orWhereHas('organization', function ($query) use ($search) {
    //                     $query->where('name', 'like', '%'.$search.'%');
    //                 });
    //         });
    //     })->when($filters['trashed'] ?? null, function ($query, $trashed) {
    //         if ($trashed === 'with') {
    //             $query->withTrashed();
    //         } elseif ($trashed === 'only') {
    //             $query->onlyTrashed();
    //         }
    //     });
    // }













    // public function visits()
    // {
    //     return $this->hasMany('App\Visit');
    // }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    // public function address()
    // {
    //     return $this->belongsTo('App\Models\Address');
    // }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    // public function education()
    // {
    //     return $this->belongsTo('App\Education');
    // }

    // public function destination()
    // {
    //     return $this->belongsTo('App\Destination');
    // }

    // public function clinic()
    // {
    //     return $this->belongsTo('App\Clinic');
    // }

    // public function occupation()
    // {
    //     return $this->belongsTo('App\Occupation');
    // }

    // public function patientType()
    // {
    //     return $this->belongsTo('App\PatientType');
    // }
}
