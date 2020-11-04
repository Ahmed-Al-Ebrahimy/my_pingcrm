<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Models\Address;

class AddressController extends Controller
{


    public function index()
    {
        return Inertia::render('Addresses/Index', [
            'filters' => Request::all('search'),
            'addresses' => Address::orderBy('name')
                ->filter(Request::only('search'))
                ->paginate(10)
                ->only('id', 'name', 'deleted_at', 'created_at'),
        ]);
    }
    public function create()
    {
        return Inertia::render('Addresses/Create', [
        ]);
    }

    public function store(Request $request)
    {

        Auth::user()->addresses()->create(
            Request::validate([
                'name' => ['required', 'max:100', 'unique:addresses',],
            ])
        );

        return Redirect::back()->with('success', 'Contact created.');
    }

    public function edit(Address $address)
    {
        return Inertia::render('Addresses/Edit', [
            'address' => [
                'id' => $address->id,
                'name' => $address->name,
                'patients' => $address->patients()->orderByName()->get()->map->only('id', 'name', 'created_at'),
            ],
            // 'address' => $address
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
