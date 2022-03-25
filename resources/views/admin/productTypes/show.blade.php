@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.masterSetting.title') }}</li>
            <li class="breadcrumb-item">
                Manage {{ trans('cruds.productType.title_singular') }}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                View {{ trans('cruds.productType.title_singular') }}
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.show') }} {{ trans('cruds.productType.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.productType.fields.id') }}
                            </th>
                            <td>
                                {{ $productType->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.productType.fields.property_name') }}
                            </th>
                            <td>
                                {{ $productType->property_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.productType.fields.building_type') }}
                            </th>
                            <td>
                                @foreach($productType->building_types as $key => $building_type)
                                    <span class="label label-info">{{ $building_type->building_name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.product-types.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
