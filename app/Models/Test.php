<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use SoftDeletes;
    protected $fillable = ['id', 'testShortName', 'testFullName',  'testNormalValue'];


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
