<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Patient;
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
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'       => ['required', 'unique:patients'],
            'birth_date' => ['required'],
            'gender'     => ['required'],
            // 'photo'      => [ 'image'],
        ]);


        Patient::create([
            'name'       => $request->input('name'),
            'birth_date' => $request->input('birth_date'),
            'gender'     => $request->input('gender'),
            // 'photo'      => $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null
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
