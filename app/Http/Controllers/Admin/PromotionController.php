<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyPromotionRequest;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;

use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $promotions = Promotion::pluck('promo_type', 'id');

        return view('admin.promotions.create', compact('promotions'));
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function store(StorePromotionRequest $request)
    {
        $promotions = Promotion::create($request->all());

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.promotions.index');
    }

    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $promotion->update($request->all());

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.promotions.index');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyPromotionRequest $request)
    {
        Promotion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
