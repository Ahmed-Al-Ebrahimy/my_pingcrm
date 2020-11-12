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

    public function update(UpdatePatientData $request, Patient $patient)
    {
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

        return Redirect::back()->with('success', 'tests inserted successfully');
    }

}
