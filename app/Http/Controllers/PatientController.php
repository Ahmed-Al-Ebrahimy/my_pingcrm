<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Patient;
use App\Models\Address;
use App\Models\Educationlevel;
use App\Models\Occupation;
use App\Models\Type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function index(Request $request)
    {

        return Inertia::render('Patients/Index', [
            'patients' =>  Patient::when( $request->term, function($query, $term){

                $query->where('name', 'like', '%' . $term . '%');

            }) ->paginate(10)
        ]);
    }
    public function create()
    {
        return Inertia::render('Patients/Create', [
            'addresses'         => Address::orderBy('name')->get()->map->only('id', 'name'),
            'educationlevels'   => Educationlevel::orderBy('name')->get()->map->only('id', 'name'),
            'occupations'       => Occupation::orderBy('name')->get()->map->only('id', 'name'),
            'types'      => Type::orderBy('name')->get()->map->only('id', 'name'),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'       => ['required', 'unique:patients'],
            'birth_date' => ['required'],
            'gender'     => ['required'],

            'marital' => ['required'],
            'smoking'     => ['required'],

            'occupation_id' => ['required'],
            'educationlevel_id'     => ['required'],

            'address_id' => ['required'],
            'type_id'     => ['required'],
            'fh_of_dm'     => ['required'],
        ]);


        Patient::create([
            'name'              => $request->input('name'),
            'birth_date'        => $request->input('birth_date'),
            'gender'            => $request->input('gender'),
            'marital'           => $request->input('marital'),
            'smoking'           => $request->input('smoking'),
            'fh_of_dm'          => $request->input('fh_of_dm'),
            'occupation_id'     => $request->input('occupation_id'),
            'educationlevel_id' => $request->input('educationlevel_id'),
            'address_id'        => $request->input('address_id'),
            'type_id'           => $request->input('type_id'),
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
