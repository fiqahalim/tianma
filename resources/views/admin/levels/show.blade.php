@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.level.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.levels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.level.fields.id') }}
                        </th>
                        <td>
                            {{ $level->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.level.fields.level_name') }}
                        </th>
                        <td>
                            {{ $level->level_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.level.fields.building_type') }}
                        </th>
                        <td>
                            @foreach($level->building_types as $key => $building_type)
                                <span class="label label-info">{{ $building_type->building_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.levels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection