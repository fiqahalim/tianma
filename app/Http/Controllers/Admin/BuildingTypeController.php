<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBuildingTypeRequest;
use App\Http\Requests\StoreBuildingTypeRequest;
use App\Http\Requests\UpdateBuildingTypeRequest;
use App\Models\BuildingType;
use Gate;
use Alert;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BuildingTypeController extends Controller
{
    public function index()
    {
        $buildingTypes = BuildingType::all();

        return view('admin.buildingTypes.index', compact('buildingTypes'));
    }

    public function create()
    {
        return view('admin.buildingTypes.create');
    }

    public function store(StoreBuildingTypeRequest $request)
    {
        $buildingType = BuildingType::create($request->all());

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.building-types.index');
    }

    public function edit(BuildingType $buildingType)
    {
        return view('admin.buildingTypes.edit', compact('buildingType'));
    }

    public function update(UpdateBuildingTypeRequest $request, BuildingType $buildingType)
    {
        $buildingType->update($request->all());

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.building-types.index');
    }

    public function show(BuildingType $buildingType)
    {
        return view('admin.buildingTypes.show', compact('buildingType'));
    }

    public function destroy(BuildingType $buildingType)
    {
        $buildingType->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyBuildingTypeRequest $request)
    {
        BuildingType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
