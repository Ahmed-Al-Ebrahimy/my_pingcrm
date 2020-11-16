<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdatePatientData;

use Inertia\Inertia;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\Test;

class LaboratoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Laboratory/Index', [
            'filters' => Request::all('search'),
            'patients' => Patient::orderBy('name')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->only('id', 'name', 'deleted_at', 'created_at'),
        ]);
    }

    public function edit(Patient $patient)
    {
        return Inertia::render('Laboratory/Edit', [
            'tests'               => Test::orderBy('id', 'asc')->get()->map->only('id', 'name'),
            'patient' => [
                'id'              => $patient->id,
                'name'            => $patient->name,
                'visits'          => $patient->visits() ? $patient->visits()->with('tests')->orderBy('created_at', 'desc')->get() : null,
            ],
        ]);
    }


   // $count_of_visits_with_clinic_id_1_and_created_today_and_queue_true('queue true deprecate and replace with setting
        // clinic_id to null from doctor page after few seconds')
    public function update(UpdatePatientData $request, Patient $patient)
    {

        $today = date('Y-m-d');
        $rows = Patient::where('id', '=', $patient->id)->select('type_id')->get();
        foreach ($rows as $row ) {
            $type_id  =  $row['type_id'];
          }

        $c1 = Visit::where('patient_id', '=', $patient->id)->where('clinic_id', '=', 1)->where('created_at', 'LIKE', $today .'%')->count();
        $c2 = Visit::where('patient_id', '=', $patient->id)->where('clinic_id', '=', 2)->where('created_at', 'LIKE', $today .'%')->count();
        $c3 = Visit::where('patient_id', '=', $patient->id)->where('clinic_id', '=', 3)->where('created_at', 'LIKE', $today .'%')->count();


        if($type_id == 2 ){
          $clinic = 4;

        }elseif($type_id == 3){

           $clinic = 1;

        }elseif($c1 == $c2 && $c1 == $c3){

           $clinic = rand(1, 3);

        }elseif($c1 < $c2 && $c1 < $c3 ){

           $clinic = 1;

        }elseif($c2 < $c1 && $c2 < $c3 ){

           $clinic = 2;

        }elseif($c3 < $c1 && $c3 < $c2 ){

           $clinic = 3;

        }elseif($c1 == $c2 && $c1 < $c3 ){

            $clinic =  rand(1, 2);

        }elseif($c1 == $c3 && $c1 < $c2 ){

            $arrX = array(1 , 3);
            $randIndex = array_rand($arrX);
            $clinic = $arrX[$randIndex];

        }elseif($c2 == $c3 && $c2 < $c1 ){

            $clinic =  rand(2, 3);

        }else{

            $clinic =  rand(1, 3);
        }

        Visit::where('id', '=', $request->visit_id)->update([
                'clinic_id'  => $clinic,
        ]);
        $visit = Visit::where('id', '=', $request->visit_id)->first();

            foreach($request->all() as $key => $value){
                if($value && $key != '_method' && $key != 'visit_id' ){
                    $visit->tests()->syncWithoutDetaching([$key  => ['value' =>  $value]]);
                }
            }

            foreach($visit->tests as $test){
                foreach ($request->all() as $key => $value){
                    if (!$value && $test->pivot->test_id == $key) {
                        $visit->tests()->detach($key);
                        break;
                    }
                }
            }

        return Redirect::route('laboratory')->with('success', 'tests inserted successfully');
    }

}
