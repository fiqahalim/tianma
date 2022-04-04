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
