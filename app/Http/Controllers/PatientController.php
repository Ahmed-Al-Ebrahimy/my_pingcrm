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
// use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index()
    {
        return Inertia::render('Patients/Index', [
            'filters' => Request::all('search', 'trashed'),
            'patients' => Patient::with('address')
                ->orderByName()
                ->filter(Request::only('search', 'trashed'))
                ->paginate(4)
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

    public function store()
    {


    $patient = Auth::user()->patients()->create(
            Request::validate([
                'name'                  => ['required', 'unique:patients', 'max:22', 'min:10'],
                'birth_date'            => ['required'],
                'gender'                => ['required'],
                'marital'               => ['required'],
                'smoking'               => ['required'],
                'occupation_id'         => ['required'],
                'educationlevel_id'     => ['required'],
                'address_id'            => ['required'],
                'type_id'               => ['required'],
                'fh_of_dm'              => ['required'],

                'systolic_bp'           => ['required'],
                'diastolic_bp'          => ['required'],
                'height'                => ['required'],
                'weight'                => ['required'],
            ])
        );

        Visit::create([
            'systolic_bp'       => Request::only('systolic_bp'),
            'diastolic_bp'       => Request::only('diastolic_bp'),
            'height'       => Request::only('height'),
            'weight'       => Request::only('weight'),
            'patient_id'        => $patient->id,
            'user_id'           => Auth::user()->id,
        ]);


        return Redirect::route('patients')->with('message', 'Patient created.');
    }

    public function edit(Patient $patient)
    {
        return Inertia::render('Patients/Edit', [
            'patient' => $patient
        ]);
    }

    public function update(Patient $patient, Request $request)
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
