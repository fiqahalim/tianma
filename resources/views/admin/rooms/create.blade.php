@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.masterSetting.title') }}</li>
            <li class="breadcrumb-item">
                Manage {{ trans('cruds.room.title_singular') }}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Create {{ trans('cruds.room.title_singular') }}
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.create') }} {{ trans('cruds.room.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.rooms.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.room.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.room.fields.name_helper') }}</span>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="levels">{{ trans('cruds.room.fields.levels') }}</label>
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
                        <span class="help-block">{{ trans('cruds.room.fields.levels_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sections">{{ trans('cruds.room.fields.section') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('sections') ? 'is-invalid' : '' }}" name="sections[]" id="sections" multiple>
                            @foreach($sections as $id => $section)
                                <option value="{{ $id }}" {{ in_array($id, old('sections', [])) ? 'selected' : '' }}>{{ $section }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('sections'))
                            <div class="invalid-feedback">
                                {{ $errors->first('sections') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.room.fields.section_helper') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.rooms.index') }}">
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
