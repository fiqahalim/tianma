<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLevelRequest;
use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Models\BuildingType;
use App\Models\Level;
use Gate;
use Alert;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::with(['building_types'])->get();

        return view('admin.levels.index', compact('levels'));
    }

    public function create()
    {
        $building_types = BuildingType::pluck('building_name', 'id');

        return view('admin.levels.create', compact('building_types'));
    }

    public function store(StoreLevelRequest $request)
    {
        $level = Level::create($request->all());
        $level->building_types()->sync($request->input('building_types', []));

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.levels.index');
    }

    public function edit(Level $level)
    {
        $building_types = BuildingType::pluck('building_name', 'id');

        $level->load('building_types');

        return view('admin.levels.edit', compact('building_types', 'level'));
    }

    public function update(UpdateLevelRequest $request, Level $level)
    {
        $level->update($request->all());
        $level->building_types()->sync($request->input('building_types', []));

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.levels.index');
    }

    public function show(Level $level)
    {
        $level->load('building_types');

        return view('admin.levels.show', compact('level'));
    }

    public function destroy(Level $level)
    {
        $level->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyLevelRequest $request)
    {
        Level::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
