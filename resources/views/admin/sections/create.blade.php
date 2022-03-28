@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.masterSetting.title') }}</li>
            <li class="breadcrumb-item">
                Manage {{ trans('cruds.section.title') }}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Create {{ trans('cruds.section.title_singular') }}
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.create') }} {{ trans('cruds.section.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.sections.store") }}" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="required" for="section">{{ trans('cruds.section.fields.section') }}</label>
                        <input class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" type="text" name="section" id="section" value="{{ old('section', '') }}" required>
                        @if($errors->has('section'))
                            <div class="invalid-feedback">
                                {{ $errors->first('section') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.section.fields.section_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="seat_layout">{{ trans('cruds.section.fields.seat_layout') }}</label>
                        <input class="form-control {{ $errors->has('seat_layout') ? 'is-invalid' : '' }}" type="text" name="seat_layout" id="seat_layout" value="{{ old('seat_layout', '') }}">
                        @if($errors->has('seat_layout'))
                            <div class="invalid-feedback">
                                {{ $errors->first('seat_layout') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.section.fields.seat_layout_helper') }}</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="rooms">{{ trans('cruds.section.fields.room') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('rooms') ? 'is-invalid' : '' }}" name="rooms[]" id="rooms" multiple>
                            @foreach($rooms as $id => $room)
                                <option value="{{ $id }}" {{ in_array($id, old('rooms', [])) ? 'selected' : '' }}>{{ $room }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('rooms'))
                            <div class="invalid-feedback">
                                {{ $errors->first('rooms') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.section.fields.room_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="levels">{{ trans('cruds.section.fields.level') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('levels') ? 'is-invalid' : '' }}" name="levels[]" id="levels" multiple>
                            @foreach($levels as $id => $level)
                                <option value="{{ $id }}" {{ in_array($id, old('levels', [])) ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('levels'))
                            <div class="invalid-feedback">
                                {{ $errors->first('levels') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.section.fields.level_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="products">{{ trans('cruds.section.fields.product') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('products') ? 'is-invalid' : '' }}" name="products[]" id="products" multiple>
                            @foreach($products as $id => $product)
                                <option value="{{ $id }}" {{ in_array($id, old('products', [])) ? 'selected' : '' }}>{{ $product }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('products'))
                            <div class="invalid-feedback">
                                {{ $errors->first('products') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.section.fields.product_helper') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
