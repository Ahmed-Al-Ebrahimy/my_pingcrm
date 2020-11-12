<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Models\Test;
use Illuminate\Validation\Rule;

class testController extends Controller
{


    public function index()
    {
        return Inertia::render('Tests/Index', [
            'filters' => Request::all('search'),
            'tests' => Test::orderBy('id')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->only('id', 'name', 'testFullName', 'testNormalValue', 'deleted_at', 'created_at'),
        ]);
    }


    public function create()
    {
        return Inertia::render('Tests/Create', [
        ]);
    }

    public function store(Request $request)
    {

        Auth::user()->tests()->create(
            Request::validate([
                'name' => ['required', 'max:100', 'unique:tests',],
                'testFullName' => ['required', 'max:100','unique:tests'],
                'testNormalValue' => ['max:100'],
            ])
        );

        return Redirect::back()->with('success', 'Test Created.');
    }

    public function edit(Test $test)
    {
        return Inertia::render('Tests/Edit', [
            'test' => [
                'id'              => $test->id,
                'name'            => $test->name,
                'testFullName'    => $test->testFullName,
                'testNormalValue' => $test->testNormalValue,
            ],
        ]);
    }

    public function update(Test $test)
    {

        $test->update(
            Request::validate([
                'name'              => ['required','max:9', Rule::unique('tests')->ignore($test->id)],
                'testFullName'      => ['required', 'max:22', Rule::unique('tests')->ignore($test->id)],
                'testNormalValue'   => ['required','max:9'],
            ])
        );
        return Redirect::route('tests')->with('message', 'Test Updated');
    }

    public function destroy(test $test)
    {
        $test->delete();

        return Redirect::route('tests')->with('message', 'Patient deleted.');
    }

    // public function restore(test $test)
    // {
    //     $test->restore();

    //     return Redirect::back()->with('message', 'test restored.');
    // }
}
