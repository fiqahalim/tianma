@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.productManagement.title') }}</li>
            <li class="breadcrumb-item">{{ trans('cruds.addOnProduct.title_singular') }}</li>
            <li class="breadcrumb-item active" aria-current="page">
                View {{ trans('cruds.addOnProduct.title_singular') }}
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.show') }} {{ trans('cruds.addOns.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.addOnProduct.fields.id') }}
                            </th>
                            <td>
                                {{ $addOnProduct->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.addOnProduct.fields.name') }}
                            </th>
                            <td>
                                {{ $addOnProduct->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.addOnProduct.fields.price') }}
                            </th>
                            <td>
                                {{ $addOnProduct->price }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.addOnProduct.fields.description') }}
                            </th>
                            <td>
                                {{ $addOnProduct->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.addOnProduct.fields.image') }}
                            </th>
                            <td>
                                @if($addOnProduct->image)
                                    <a href="{{ $addOnProduct->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $addOnProduct->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.add-on-products.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
