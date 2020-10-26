<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Addresses/Index', [
            'addresses' =>  Address::when( $request->term, function($query, $term){

                $query->where('name', 'like', '%' . $term . '%');

            }) ->paginate(10)
        ]);
    }



    public function create()
    {
        return Inertia::render('Addresses/Create', [
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'       => ['required', 'unique:addresses'],
        ]);


        Address::create([
            'name' => $request->input('name'),
        ]);

        return Redirect::route('addresses')->with('message', 'Address created.');
    }

    public function edit(Address $address)
    {
        return Inertia::render('Addresses/Edit', [
            'address' => $address
        ]);
    }

    public function update(Address $address, Request $request)
    {
            $request->validate([
                'name'       => ['required', Rule::unique('addresses')->ignore($address->id)],
            ]);

            Address::where('id', $address->id)->update([
                'name'       => $request->input('name'),
            ]);

            return Redirect::route('addresses')->with('message', 'Address updated.');
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return Redirect::route('addresses')->with('message', 'Patient deleted.');
    }

    // public function restore(Address $address)
    // {
    //     $address->restore();

    //     return Redirect::back()->with('message', 'Address restored.');
    // }
}
