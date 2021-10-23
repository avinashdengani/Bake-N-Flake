<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', City::class);
        $cities = City::paginate(10);
        return view('cities.index', compact(['cities']));
    }

    public function create()
    {
        $this->authorize('create', City::class);
        return view('cities.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', City::class);

        $rules = [
            'city_name' => 'required',
            'pincode' => 'required|numeric|digits:6|unique:cities',
        ];

        $this->validate($request, $rules);

        $city = City::create([
            'city_name' => $request->city_name,
            'pincode' => $request->pincode
        ]);

        session()->flash('success', 'CIty Added Succesfully');

        return redirect(route('cities.index'));
    }

    public function show(City $city)
    {
        $this->authorize('view', $city);
    }

    public function edit(City $city)
    {
        $this->authorize('update', $city);
        return view('cities.edit', compact(['city']));
    }

    public function update(Request $request, City $city)
    {
        $this->authorize('update', $city);

        $rules = [
            'city_name' => 'required',
            'pincode' => 'required|numeric|digits:6|unique:cities,pincode,'.$city->id,
        ];

        $this->validate($request, $rules);

        $city->update([
            'city_name' => $request->city_name,
            'pincode' => $request->pincode
        ]);

        session()->flash('success', 'City Updated Succesfully.');

        return redirect(route('cities.index'));
    }

    public function destroy(City $city)
    {
        $this->authorize('delete', $city);

        if($city->count() > 0) {
            session()->flash('error', 'City cannot be deleted as it is linked with many products.');
            return redirect(route('cities.index'));
        }
        $city->delete();
        session()->flash('success', 'City deleted sucessfully!');
        return redirect(route('cities.index'));
    }
}
