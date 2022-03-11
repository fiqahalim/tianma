@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.masterSetting.title') }}</li>
            <li class="breadcrumb-item">
                Manage {{ trans('cruds.productType.title_singular') }}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Create {{ trans('cruds.productType.title_singular') }}
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.create') }} {{ trans('cruds.productType.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.product-types.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="property_name">{{ trans('cruds.productType.fields.property_name') }}</label>
                    <input class="form-control {{ $errors->has('property_name') ? 'is-invalid' : '' }}" type="text" name="property_name" id="property_name" value="{{ old('property_name', '') }}" required>
                    @if($errors->has('property_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('property_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productType.fields.property_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="building_types">{{ trans('cruds.productType.fields.building_type') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('building_types') ? 'is-invalid' : '' }}" name="building_types[]" id="building_types" multiple>
                        @foreach($building_types as $id => $building_type)
                            <option value="{{ $id }}" {{ in_array($id, old('building_types', [])) ? 'selected' : '' }}>{{ $building_type }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('building_types'))
                        <div class="invalid-feedback">
                            {{ $errors->first('building_types') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.productType.fields.building_type_helper') }}</span>
                </div>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.product-types.index') }}">
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
