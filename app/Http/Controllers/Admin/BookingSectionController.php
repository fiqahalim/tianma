<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\MassDestroySectionRequest;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;

use App\Models\Level;
use App\Models\Product;
use App\Models\Room;
use App\Models\BookingSection;
use Alert;

class BookingSectionController extends Controller
{
    public function index()
    {
        $sections = BookingSection::with(['rooms', 'levels', 'products'])->get();

        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        $rooms = Room::pluck('name', 'id');

        $levels = Level::pluck('level_name', 'id');

        $products = Product::pluck('product_name', 'id');

        return view('admin.sections.create', compact('levels', 'products', 'rooms'));
    }

    public function store(StoreSectionRequest $request)
    {
        $section = BookingSection::create($request->all());
        $section->rooms()->sync($request->input('rooms', []));
        $section->levels()->sync($request->input('levels', []));
        $section->products()->sync($request->input('products', []));

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.sections.index');
    }

    public function edit(BookingSection $section)
    {
        $rooms = Room::pluck('name', 'id');

        $levels = Level::pluck('level_name', 'id');

        $products = Product::pluck('product_name', 'id');

        $section->load('rooms', 'levels', 'products');

        return view('admin.sections.edit', compact('levels', 'products', 'rooms', 'section'));
    }

    public function update(UpdateSectionRequest $request, BookingSection $section)
    {
        $section->update($request->all());
        $section->rooms()->sync($request->input('rooms', []));
        $section->levels()->sync($request->input('levels', []));
        $section->products()->sync($request->input('products', []));

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.sections.index');
    }

    public function show(BookingSection $section)
    {
        $section->load('rooms', 'levels', 'products');

        return view('admin.sections.show', compact('section'));
    }

    public function destroy(BookingSection $section)
    {
        $section->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroySectionRequest $request)
    {
        BookingSection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
