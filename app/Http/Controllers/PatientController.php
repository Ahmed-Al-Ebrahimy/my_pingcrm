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
use App\Http\Requests\StorePatientData;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
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
                        'id' => $patient->id,
                        'name' => $patient->name,
                        'deleted_at' => $patient->deleted_at,
                        'address' => $patient->address ? $patient->address->only('name') : null,
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
                'user_id'      => Auth::user()->id,
            ]);

    });

        return Redirect::route('patients')->with('success', 'Patient created.');
    }

    // public function edit(Patient $patient)
    // {
    //     return Inertia::render('Patients/Edit', [
    //         'patient' => $patient
    //     ]);
    // }

    public function edit(Patient $patient)
    {

        $today = (date('Y-m-d').' 00:00:00');
        return Inertia::render('Patients/Edit', [
            $today = (date('Y-m-d').' 00:00:00'),
            'addresses'         => Address::orderBy('name')->get()->map->only('id', 'name'),
            'educationlevels'   => Educationlevel::orderBy('name')->get()->map->only('id', 'name'),
            'occupations'       => Occupation::orderBy('name')->get()->map->only('id', 'name'),
            'types'             => Type::orderBy('name')->get()->map->only('id', 'name'),
            'todaysVisit'       => Visit::where('patient_id', '=', $patient->id)->where( 'created_at', '>=', $today)
            ->get()->map->only('id', 'systolic_bp', 'diastolic_bp', 'height', 'weight', 'created_at'),

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
                'visits' => $patient->visits()->orderBy('created_at', 'desc')->get()->map->only('id', 'systolic_bp', 'diastolic_bp', 'height', 'weight', 'created_at'),
            ],
        ]);
    }

    public function update(Patient $patient, StorePatientData $request)
    {
            $request->validate([
                'name'       => ['required', Rule::unique('patients')->ignore($patient->id)],
                'birth_date' => ['required'],
                'gender'     => ['required'],
            ]);

            Patient::where('id', $patient->id)->update([
                'name'       => $request->input('name'),
                'birth_date' => $request->input('birth_date'),
                'gender'     => $request->input('gender'),
            ]);

            return Redirect::route('patients')->with('message', 'Patient updated.');
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
