<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdatePatientData;

use Inertia\Inertia;

use App\Models\Patient;
use App\Models\Address;
use App\Models\Educationlevel;
use App\Models\Occupation;
use App\Models\Type;

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

}
