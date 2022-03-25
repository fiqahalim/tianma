@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.masterSetting.title') }}</li>
            <li class="breadcrumb-item">
                Manage {{ trans('cruds.masterSetting.fields.building') }}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Create {{ trans('cruds.masterSetting.fields.building') }}
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.create') }} {{ trans('cruds.masterSetting.fields.building') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.building-types.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="building_name">
                        Building Name
                    </label>
                    <input class="form-control {{ $errors->has('building_name') ? 'is-invalid' : '' }}" type="text" name="building_name" id="building_name" value="{{ old('building_name', '') }}" required>
                    @if($errors->has('building_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('building_name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.building-types.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
