<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\MassDestroySectionRequest;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;

use App\Models\BookingSection;
use App\Models\BookingLot;
use Alert;

class BookingSectionController extends Controller
{
    public function index()
    {
        $bookingSections = BookingSection::with(['bookingLots'])->get();

        return view('admin.bookingSections.index', compact('bookingSections'));
    }

    public function create()
    {
        $lot_layouts = BookingLot::pluck('layout', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookingSections.create', compact('lot_layouts'));
    }

    public function store(StoreSectionRequest $request)
    {
        $bookingSection = BookingSection::create($request->all());

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.sections.index');
    }

    public function edit(BookingSection $bookingSection)
    {
        $lot_layouts = BookingLot::pluck('layout', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bookingSection->load('bookingLots');

        return view('admin.bookingSections.edit', compact('bookingSection', 'lot_layouts'));
    }

    public function update(UpdateSectionRequest $request, BookingSection $bookingSection)
    {
        $bookingSection->update($request->all());

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.sections.index');
    }

    public function show(BookingSection $bookingSection)
    {
        $bookingSection->load('bookingLots');

        return view('admin.bookingSections.show', compact('bookingSection'));
    }

    public function destroy(BookingSection $bookingSection)
    {
        $bookingSection->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroySectionRequest $request)
    {
        BookingSection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
