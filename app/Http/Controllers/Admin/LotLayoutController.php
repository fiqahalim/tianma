<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingLot;
use App\Models\BookingSection;
use App\Models\Product;
use Alert;

class LotLayoutController extends Controller
{
    public function lotLayouts()
    {
        $pageTitle = 'Lot Layouts';
        $emptyMessage = 'No layouts found';
        $layouts = BookingLot::orderBy('id','desc');

        return view('admin.lotLayout.index', compact('pageTitle', 'emptyMessage', 'layouts'));
    }

    public function lotLayoutStore(Request $request)
    {
        $request->validate([
            'layout' => 'required|unique:booking_lots'
        ]);

        $lotLayout = new BookingLot();
        $lotLayout->layout = $request->layout;
        $lotLayout->save();

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.lot.layouts');
    }

    public function lotLayoutUpdate(Request $request, $id)
    {
        $request->validate([
            'layout' => 'required|unique:booking_lots,layout,'.$id
        ]);

        $lot = BookingLot::find($request->id);
        $lot->layout = $request->layout;
        $lot->save();

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.lot.layouts');
    }

    public function lotLayoutDelete(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        BookingLot::find($request->id)->delete();

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.lot.layouts');
    }
}
