@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.masterSetting.title') }}</li>
            <li class="breadcrumb-item">
                Manage {{ trans('cruds.masterSetting.fields.location') }}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                View {{ trans('cruds.masterSetting.fields.location') }}
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.show') }} {{ trans('cruds.masterSetting.fields.location') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.location.fields.id') }}
                            </th>
                            <td>
                                {{ $location->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.location.fields.location_name') }}
                            </th>
                            <td>
                                {{ $location->location_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.location.fields.state') }}
                            </th>
                            <td>
                                {{ $location->state }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.location.fields.postcode') }}
                            </th>
                            <td>
                                {{ $location->postcode }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.location.fields.city') }}
                            </th>
                            <td>
                                {{ $location->city }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.location.fields.address_1') }}
                            </th>
                            <td>
                                {{ $location->address_1 }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.location.fields.address_2') }}
                            </th>
                            <td>
                                {{ $location->address_2 }}
                            </td>
                        </tr>
                        {{-- <tr>
                            <th>
                                {{ trans('cruds.location.fields.status') }}
                            </th>
                            <td>
                                {{ $location->status }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.location.fields.property_name') }}
                            </th>
                            <td>
                                @foreach($location->property_names as $key => $property_name)
                                    <span class="label label-info">{{ $property_name->property_name }}</span>
                                @endforeach
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.locations.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
