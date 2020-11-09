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




    // public function edit(Address $address)
    // {
    //     return Inertia::render('laboratory/Edit', [
    //         'address' => [
    //             'id' => $address->id,
    //             'name' => $address->name,
    //             'patients' => $address->patients()->orderByName()->get()->map->only('id', 'name', 'created_at'),
    //         ],
    //         // 'address' => $address
    //     ]);
    // }


    public function edit(Patient $patient)
    {

        $today = (date('Y-m-d').' 00:00:00');
        $todays_visit = Visit::where('patient_id', '=', $patient->id)->where( 'created_at', '>=', $today)->first();

        if($todays_visit != null){
            $todays_visit_tests = $todays_visit;

        }else{
            $todays_visit_tests = 'there is no visit todat, plese instruct the patient to go back to secretary to register todays visit';
        }



        return Inertia::render('Laboratory/Edit', [
            'tests'               => Test::orderBy('id', 'asc')->get()->map->only('id', 'name'),
            'todays_visit_tests'  => $todays_visit_tests,
            'patient' => [
                'id'              => $patient->id,
                'name'            => $patient->name,
                'visits'          => $patient->visits() ? $patient->visits()->orderBy('created_at', 'desc')->get() : null,
            ],
        ]);
    }

    public function update(UpdatePatientData $request, Patient $patient)
    {
        $today = (date('Y-m-d').' 00:00:00');
        $visit = Visit::where('patient_id', '=', $patient->id)->where( 'created_at', '>=', $today)->first();

        foreach($request->all() as $key => $value){

            //Please note that $key represent test id as we send it from vue form

            if($value && $key != '_method' ){

                $visit->tests()->attach([$key  => ['value' =>  $value]]);


                // echo ' test_id => ' . $key . '  ' . ' test_value => ' . $value;
            }



        }


    }

}