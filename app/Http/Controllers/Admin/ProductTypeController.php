<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductTypeRequest;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Models\BuildingType;
use App\Models\ProductType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductTypeController extends Controller
{
    public function index()
    {
        $productTypes = ProductType::with(['building_types'])->get();

        return view('admin.productTypes.index', compact('productTypes'));
    }

    public function create()
    {
        $building_types = BuildingType::pluck('building_name', 'id');

        return view('admin.productTypes.create', compact('building_types'));
    }

    public function store(StoreProductTypeRequest $request)
    {
        $productType = ProductType::create($request->all());
        $productType->building_types()->sync($request->input('building_types', []));

        return redirect()->route('admin.product-types.index');
    }

    public function edit(ProductType $productType)
    {
        $building_types = BuildingType::pluck('building_name', 'id');

        $productType->load('building_types');

        return view('admin.productTypes.edit', compact('building_types', 'productType'));
    }

    public function update(UpdateProductTypeRequest $request, ProductType $productType)
    {
        $productType->update($request->all());
        $productType->building_types()->sync($request->input('building_types', []));

        return redirect()->route('admin.product-types.index');
    }

    public function show(ProductType $productType)
    {
        $productType->load('building_types');

        return view('admin.productTypes.show', compact('productType'));
    }

    public function destroy(ProductType $productType)
    {
        $productType->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductTypeRequest $request)
    {
        ProductType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
