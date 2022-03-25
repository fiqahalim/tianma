@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.level.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.levels.update", [$level->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="level_name">{{ trans('cruds.level.fields.level_name') }}</label>
                <input class="form-control {{ $errors->has('level_name') ? 'is-invalid' : '' }}" type="text" name="level_name" id="level_name" value="{{ old('level_name', $level->level_name) }}" required>
                @if($errors->has('level_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('level_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.level.fields.level_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="building_types">{{ trans('cruds.level.fields.building_type') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('building_types') ? 'is-invalid' : '' }}" name="building_types[]" id="building_types" multiple>
                    @foreach($building_types as $id => $building_type)
                        <option value="{{ $id }}" {{ (in_array($id, old('building_types', [])) || $level->building_types->contains($id)) ? 'selected' : '' }}>{{ $building_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('building_types'))
                    <div class="invalid-feedback">
                        {{ $errors->first('building_types') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.level.fields.building_type_helper') }}</span>
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