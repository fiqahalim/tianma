<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLocationRequest;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Models\ProductType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::with(['property_names'])->get();

        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        $property_names = ProductType::pluck('property_name', 'id');

        return view('admin.locations.create', compact('property_names'));
    }

    public function store(StoreLocationRequest $request)
    {
        $location = Location::create($request->all());
        $location->property_names()->sync($request->input('property_names', []));

        return redirect()->route('admin.locations.index');
    }

    public function edit(Location $location)
    {
        $property_names = ProductType::pluck('property_name', 'id');

        $location->load('property_names');

        return view('admin.locations.edit', compact('location', 'property_names'));
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->all());
        $location->property_names()->sync($request->input('property_names', []));

        return redirect()->route('admin.locations.index');
    }

    public function show(Location $location)
    {
        $location->load('property_names');

        return view('admin.locations.show', compact('location'));
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return back();
    }

    public function massDestroy(MassDestroyLocationRequest $request)
    {
        Location::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
