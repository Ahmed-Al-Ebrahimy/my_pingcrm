<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdatePatientData;

use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Models\Patient;
use App\Models\Address;
use App\Models\Educationlevel;
use App\Models\Occupation;
use App\Models\Type;
use App\Models\Test;
use App\Models\Visit;

class PhysicianController extends Controller
{
    public function index()
    {
        return Inertia::render('Physician/Index', [
            'filters' => Request::all('search'),
            'patients' => Patient::orderBy('name')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->only('id', 'name', 'deleted_at', 'created_at'),
        ]);
    }

    public function edit(Patient $patient)
    {

        $today = (date('Y-m-d').' 00:00:00');
        $get_todays_visit = Visit::where('patient_id', '=', $patient->id)->where( 'created_at', '>=', $today)->first();
        $todays_visit = (object) array(
                                        'systolic_bp'   => $get_todays_visit->systolic_bp ?? null,
                                        'diastolic_bp'  => $get_todays_visit->diastolic_bp ?? null,
                                        'height'        => $get_todays_visit->height ?? null,
                                        'weight'        => $get_todays_visit->weight ?? null,
                                        );


        return Inertia::render('Physician/Edit', [
            'tests'               => Test::orderBy('id', 'asc')->get()->map->only('id', 'name'),
            'addresses'         => Address::orderBy('name')->get()->map->only('id', 'name'),
            'educationlevels'   => Educationlevel::orderBy('name')->get()->map->only('id', 'name'),
            'occupations'       => Occupation::orderBy('name')->get()->map->only('id', 'name'),
            'types'             => Type::orderBy('name')->get()->map->only('id', 'name'),
            'todays_visit'      => $todays_visit,
            'patient' => [
                'id'                => $patient->id,
                'name'              => $patient->name,
                'birth_date'        => $patient->birth_date,
                'gender'            => $patient->gender,
                'marital'           => $patient->marital,
                'smoking'           => $patient->smoking,
                'occupation_id'     => $patient->occupation_id,
                'educationlevel_id' => $patient->educationlevel_id,
                'address_id'        => $patient->address_id,
                'type_id'           => $patient->type_id,
                'fh_of_dm'          => $patient->fh_of_dm,

                'systolic_bp'       => $patient->systolic_bp,
                'diastolic_bp'      => $patient->diastolic_bp,
                'height'            => $patient->height,
                'weight'            => $patient->weight,
                'visits'            => $patient->visits() ? $patient->visits()->with('tests')->orderBy('created_at', 'desc')->get() : null,

                // 'visits'            => $patient->visits() ? $patient->visits()->orderBy('created_at', 'desc')->get()->map
                // ->only('id', 'systolic_bp', 'diastolic_bp', 'height', 'weight', 'created_at') : null,
            ],
        ]);
    }




    public function updateTests(UpdatePatientData $request, Patient $patient)
    {
            $success = '';
            $visit = Visit::where('id', '=', $request->visit_id)->first();

            foreach($request->all() as $key => $value){
                if($value && $key != '_method' && $key != 'visit_id' ){
                    $visit->tests()->syncWithoutDetaching([$key  => ['value' =>  $value]]);
                    $success = 'test inserted successfully';
                }
            }

            foreach($visit->tests as $test){
                foreach ($request->all() as $key => $value){
                    if (!$value && $test->pivot->test_id == $key) {
                        $visit->tests()->detach($key);
                        $success = 'test deleted successfully';
                        break;
                    }
                }
            }

        return Redirect::back()->with('success', $success);
    }



    public function updateProfile(Patient $patient)
    {
            $patient->update(
                Request::validate([
                    'name'                 => ['required', Rule::unique('patients')->ignore($patient->id)],
                    'birth_date'            => ['required'],
                    'gender'                => ['required'],
                    'marital'               => ['required'],
                    'smoking'               => ['required'],
                    'occupation_id'         => ['required'],
                    'educationlevel_id'     => ['required'],
                    'address_id'            => ['required'],
                    'fh_of_dm'              => ['required'],

                    'systolic_bp'           => ['required',  'digits_between:2,3'],
                    'diastolic_bp'          => ['required',  'digits_between:2,3'],
                    'height'                => ['required',  'digits_between:2,3'],
                    'weight'                => ['required',  'digits_between:2,3'],
                ])
            );
        return Redirect::back()->with('success', 'Patient updated.');
    }

}
