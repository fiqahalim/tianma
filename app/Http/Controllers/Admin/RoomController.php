<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\MassDestroyRoomRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Level;
use App\Models\Room;
use Alert;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with(['levels'])->get();

        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $levels = Level::pluck('level_name', 'id');

        return view('admin.rooms.create', compact('levels'));
    }

    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->all());
        $room->levels()->sync($request->input('levels', []));

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.rooms.index');
    }

    public function edit(Room $room)
    {
        $levels = Level::pluck('level_name', 'id');

        $room->load('levels');

        return view('admin.rooms.edit', compact('levels', 'room'));
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->all());
        $room->levels()->sync($request->input('levels', []));

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.rooms.index');
    }

    public function show(Room $room)
    {
        $room->load('levels');

        return view('admin.rooms.show', compact('room'));
    }

    public function destroy(Room $room)
    {
        $room->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyRoomRequest $request)
    {
        Room::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
