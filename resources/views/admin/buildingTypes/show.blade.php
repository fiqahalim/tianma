@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.masterSetting.title') }}</li>
            <li class="breadcrumb-item">
                Manage {{ trans('cruds.masterSetting.fields.building') }}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                View {{ trans('cruds.masterSetting.fields.building') }}
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.show') }} {{ trans('cruds.masterSetting.fields.building') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.buildingType.fields.id') }}
                            </th>
                            <td>
                                {{ $buildingType->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.buildingType.fields.building_name') }}
                            </th>
                            <td>
                                {{ $buildingType->building_name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.building-types.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#building_type_levels" role="tab" data-toggle="tab">
                    {{ trans('cruds.level.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="building_type_levels">
                @includeIf('admin.buildingTypes.relationships.buildingTypeLevels', ['levels' => $buildingType->buildingTypeLevels])
            </div>
        </div>
    </div>
@endsection
