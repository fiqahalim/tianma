@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.masterSetting.title') }}</li>
            <li class="breadcrumb-item">
                Manage {{ trans('cruds.masterSetting.fields.location') }}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Create {{ trans('cruds.masterSetting.fields.location') }}
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.create') }} {{ trans('cruds.masterSetting.fields.location') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.locations.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="required" for="location_name">{{ trans('cruds.location.fields.location_name') }}</label>
                        <input class="form-control {{ $errors->has('location_name') ? 'is-invalid' : '' }}" type="text" name="location_name" id="location_name" value="{{ old('location_name', '') }}" required>
                        @if($errors->has('location_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('location_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.location.fields.location_name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="state">{{ trans('cruds.location.fields.state') }}</label>
                        <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}">
                        @if($errors->has('state'))
                            <div class="invalid-feedback">
                                {{ $errors->first('state') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.location.fields.state_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="postcode">{{ trans('cruds.location.fields.postcode') }}</label>
                        <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="number" name="postcode" id="postcode" value="{{ old('postcode', '') }}" step="1">
                        @if($errors->has('postcode'))
                            <div class="invalid-feedback">
                                {{ $errors->first('postcode') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.location.fields.postcode_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="city">{{ trans('cruds.location.fields.city') }}</label>
                        <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                        @if($errors->has('city'))
                            <div class="invalid-feedback">
                                {{ $errors->first('city') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.location.fields.city_helper') }}</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address_1">{{ trans('cruds.location.fields.address_1') }}</label>
                        <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text" name="address_1" id="address_1" value="{{ old('address_1', '') }}">
                        @if($errors->has('address_1'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address_1') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.location.fields.address_1_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address_2">{{ trans('cruds.location.fields.address_2') }}</label>
                        <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                        @if($errors->has('address_2'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address_2') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.location.fields.address_2_helper') }}</span>
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="status">{{ trans('cruds.location.fields.status') }}</label>
                        <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="number" name="status" id="status" value="{{ old('status', '0') }}" step="1">
                        @if($errors->has('status'))
                            <div class="invalid-feedback">
                                {{ $errors->first('status') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.location.fields.status_helper') }}</span>
                    </div> --}}
                </div>
                <div class="form-group">
                    <label for="property_names">{{ trans('cruds.location.fields.property_name') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('property_names') ? 'is-invalid' : '' }}" name="property_names[]" id="property_names" multiple>
                        @foreach($property_names as $id => $property_name)
                            <option value="{{ $id }}" {{ in_array($id, old('property_names', [])) ? 'selected' : '' }}>{{ $property_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('property_names'))
                        <div class="invalid-feedback">
                            {{ $errors->first('property_names') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.location.fields.property_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.locations.index') }}">
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
