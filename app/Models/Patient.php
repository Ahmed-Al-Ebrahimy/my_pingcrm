<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['id', 'name',  'birth_date',  'gender', 'marital','smoking', 'address_id',
      'user_id',  'educationlevel_id', 'occupation_id', 'type_id', 'fh_of_dm', 'systolic_bp', 'diastolic_bp', 'height', 'weight'];

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


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function educationlevel()
    {
        return $this->belongsTo(Educationlevel::class);
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // public function destination()
    // {
    //     return $this->belongsTo(Destination::class);
    // }

    // public function clinic()
    // {
    //     return $this->belongsTo(Clinic::class);
    // }
}
