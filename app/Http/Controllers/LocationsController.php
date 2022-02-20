<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index()
    {

        $locations= Location::query()
            ->with(['parentLocation'])
            ->paginate();

        return view ('locations.index', [
            'locations'=>$locations,
        ]);
    }

    public function create()
    {
        return view('locations.create', [
            'locations' => Location::get(),
        ]);        
    }

    public function store(StoreLocationRequest $request)
    {
        $location=Location::create($request->validated());
        

        return redirect()->route('locations.index')->with('alert', [
            'type' => 'success',
            'message' => 'La Ubicación se agrego correctamente',
        ]);
    }

    public function destroy(Location $location)
    {
        Location::destroy($location->id);

        return redirect()->route('locations.index')->with('alert', [
            'type' => 'success',
            'message' => 'La Ubicación ha sido eliminada',
        ]);
    }

    public function edit(Location $location)
    {
        return view('locations.edit', [
            'location' => $location,
            'locations' => Location::get(),
        ]);
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->validated());

        return redirect()->route('locations.index')->with('alert', [
            'type' => 'success',
            'message' => 'La Ubicación ha sido actualizada',
        ]);
    }
}
