<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Address;
use App\Models\Educationlevel;
use App\Models\Occupation;
use App\Models\Type;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePatientData;
use App\Http\Requests\UpdatePatientData;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index()
    {
        return Inertia::render('Patients/Index', [
            'filters' => Request::all('search', 'trashed'),
            'patients' => Patient::with('address')
                ->orderBy('id', 'desc')
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->transform(function ($patient) {
                    return [
                        'id'            => $patient->id,
                        'name'          => $patient->name,
                        'deleted_at'    => $patient->deleted_at,
                        'created_at'    => $patient->created_at,
                        'updated_at'    => $patient->updated_at,
                        'last_visit'    => $patient->visits ? $patient->visits->map->only('created_at', 'next_visit')->last(): null,
                    ];
                }),
        ]);
    }
    public function create()
    {
        return Inertia::render('Patients/Create', [
            'addresses'         => Address::orderBy('name')->get()->map->only('id', 'name'),
            'educationlevels'   => Educationlevel::orderBy('name')->get()->map->only('id', 'name'),
            'occupations'       => Occupation::orderBy('name')->get()->map->only('id', 'name'),
            'types'             => Type::orderBy('name')->get()->map->only('id', 'name'),
        ]);
    }




    public function store(StorePatientData $request)
    {
       $request->validated();



       \DB::transaction(function () use ($request) {

        $today2 = (date('Y-m-d'));
            $patient = Patient::create([
                'name'              => $request->name,
                'birth_date'        => $request->birth_date,
                'gender'            => $request->gender,
                'marital'           => $request->marital,
                'smoking'           => $request->smoking,
                'occupation_id'     => $request->occupation_id,
                'educationlevel_id' => $request->educationlevel_id,
                'address_id'        => $request->address_id,
                'type_id'           => $request->type_id,
                'fh_of_dm'          => $request->fh_of_dm,

                'systolic_bp'       => $request->systolic_bp,
                'diastolic_bp'      => $request->diastolic_bp,
                'height'            => $request->height,
                'weight'            => $request->weight,

                'user_id'           => Auth::user()->id,
            ]);

            Visit::create([
                'systolic_bp'  => $request->systolic_bp,
                'diastolic_bp' => $request->diastolic_bp,
                'height'       => $request->height,
                'weight'       => $request->weight,
                'patient_id'   => $patient->id,
                'next_visit'   => Carbon::today()->addMonths(3)->toDateString(),
                'user_id'      => Auth::user()->id,
            ]);

    });

        return Redirect::route('patients')->with('success', 'Patient created.');
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


        return Inertia::render('Patients/Edit', [
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
                'visits'            => $patient->visits() ? $patient->visits()->orderBy('created_at', 'desc')->get()->map
                ->only('id', 'systolic_bp', 'diastolic_bp', 'height', 'weight', 'created_at') : null,
            ],
        ]);
    }

    public function update(Patient $patient)
    {
        \DB::transaction(function () use ($patient) {
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
                    'type_id'               => ['required'],
                    'fh_of_dm'              => ['required'],

                    'systolic_bp'           => ['required',  'digits_between:2,3'],
                    'diastolic_bp'          => ['required',  'digits_between:2,3'],
                    'height'                => ['required',  'digits_between:2,3'],
                    'weight'                => ['required',  'digits_between:2,3'],
                ])
            );

            $today = (date('Y-m-d').' 00:00:00');
            //$today2 = Carbon::today()->toDateString();
            $visit = Visit::where('patient_id', '=', $patient->id)->where( 'created_at', '>=', $today)->first();
            if ($visit === null) {
                Visit::create([
                    'systolic_bp'   => $patient->systolic_bp,
                    'diastolic_bp'  => $patient->diastolic_bp,
                    'height'        => $patient->height,
                    'weight'        => $patient->weight,
                    'patient_id'    => $patient->id,
                    'next_visit'    => Carbon::today()->addMonths(3)->toDateString(),
                    'user_id'       => Auth::user()->id,
                ]);
            }else{
                Visit::where('id', $visit->id)->update([
                    'patient_id'    => $patient->id,
                    'systolic_bp'   => $patient->systolic_bp,
                    'diastolic_bp'  => $patient->diastolic_bp,
                    'height'        => $patient->height,
                    'weight'        => $patient->weight,
                    'user_id'       => Auth::user()->id,
                ]);
            }
        });
        return Redirect::route('patients')->with('success', 'Patient updated.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return Redirect::route('patients')->with('message', 'Patient deleted.');
    }

    // public function restore(Patient $patient)
    // {
    //     $patient->restore();

    //     return Redirect::back()->with('message', 'Patient restored.');
    // }
}
