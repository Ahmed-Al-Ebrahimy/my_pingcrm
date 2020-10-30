<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Educationlevel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EducationlevelController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Educationlevels/Index', [
            'educationlevels' =>  Educationlevel::when( $request->term, function($query, $term){

                $query->where('name', 'like', '%' . $term . '%');

            }) ->paginate(10)
        ]);
    }



    public function create()
    {
        return Inertia::render('Educationlevels/Create', [
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'       => ['required', 'unique:educationlevels'],
        ]);


        Educationlevel::create([
            'name' => $request->input('name'),
        ]);

        return Redirect::route('educationlevels')->with('message', 'Educationlevel created.');
    }

    public function edit(Educationlevel $educationlevel)
    {
        return Inertia::render('Educationlevels/Edit', [
            'educationlevel' => $educationlevel
        ]);
    }

    public function update(Educationlevel $educationlevel, Request $request)
    {
            $request->validate([
                'name'       => ['required', Rule::unique('educationlevels')->ignore($educationlevel->id)],
            ]);

            Educationlevel::where('id', $educationlevel->id)->update([
                'name'       => $request->input('name'),
            ]);

            return Redirect::route('educationlevels')->with('message', 'Educationlevel updated.');
    }

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
