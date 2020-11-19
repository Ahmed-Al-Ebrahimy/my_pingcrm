<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Educationlevel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EducationlevelController extends Controller
{

    public function index()
    {
        return Inertia::render('Educationlevels/Index', [
            'filters' => Request::all('search'),
            'educationlevels' => Educationlevel::orderBy('id')
                ->filter(Request::only('search'))
                ->paginate(10)->only('id', 'name', 'deleted_at', 'created_at'),
        ]);
    }



    public function create()
    {
        return Inertia::render('Educationlevels/Create', [
        ]);
    }


    public function store(Request $request)
    {

        Auth::user()->educationlevels()->create(
            Request::validate([
                'name' => ['required', 'max:100', 'min:5', 'unique:educationlevels'],
            ])
        );

        return Redirect::back()->with('success', 'Educationlevel created.');
    }



    public function edit(Educationlevel $educationlevel)
    {
        return Inertia::render('Educationlevels/Edit', [
            'educationlevel' => $educationlevel
        ]);
    }
    public function update(Educationlevel $educationlevel)
    {

        $educationlevel->update(
            Request::validate([
                'name'    => ['required','min:6', Rule::unique('educationlevels')->ignore($educationlevel->id)],
            ])
        );
        return Redirect::route('educationlevels')->with('message', 'Test Updated');
    }

    // public function update(Educationlevel $educationlevel, Request $request)
    // {
    //         $request->validate([
    //             'name'       => ['required', Rule::unique('educationlevels')->ignore($educationlevel->id)],
    //         ]);

    //         Educationlevel::where('id', $educationlevel->id)->update([
    //             'name'       => $request->input('name'),
    //         ]);

    //         return Redirect::route('educationlevels')->with('message', 'Educationlevel updated.');
    // }

    public function destroy(Educationlevel $educationlevel)
    {
        $educationlevel->delete();

        return Redirect::route('educationlevels')->with('message', 'Patient deleted.');
    }

    // public function restore(Educationlevel $educationlevel)
    // {
    //     $educationlevel->restore();

    //     return Redirect::back()->with('message', 'Educationlevel restored.');
    // }
}
