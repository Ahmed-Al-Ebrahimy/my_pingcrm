<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Educationlevel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['id', 'name'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {

            $query->where('name', 'like', '%'.$search.'%')
            ->orWhere('id', '=', $search);
        });
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
