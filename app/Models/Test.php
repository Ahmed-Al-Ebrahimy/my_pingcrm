<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['id', 'name', 'testFullName',  'testNormalValue'];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {

            $query->where('name', 'like', '%'.$search.'%')
            ->orWhere('testFullName', 'like', '%'.$search);
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visits()
    {
        return $this->belongsToMany(Visit::Class);


        //how to insert to pivot table?
        //in the visits or (patient) controller
       // visits->tests()->attch($tests)

       //echo it in the blade
       //@foreach(visit->tests as test){
    //        <tr>
    //         <td>test->name</td>
    //         <td>test->value</td>
    //        </tr>
    //    }
    }
}
