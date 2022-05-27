@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.masterSetting.title') }}</li>
            <li class="breadcrumb-item">
                Manage {{ trans('cruds.bookingSection.title') }}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Create {{ trans('cruds.bookingSection.title_singular') }}
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.create') }} {{ trans('cruds.bookingSection.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.sections.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="section">{{ trans('cruds.bookingSection.fields.section') }}</label>
                    <input class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" type="text" name="section" id="section" value="{{ old('section', '') }}" required>
                    @if($errors->has('section'))
                        <div class="invalid-feedback">
                            {{ $errors->first('section') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.bookingSection.fields.section_helper') }}</span>
                </div>
                {{-- <div class="form-group">
                    <label for="lot_layout_id">{{ trans('cruds.bookingSection.fields.lot_layout') }}</label>
                    <select class="form-control select2 {{ $errors->has('lot_layout') ? 'is-invalid' : '' }}" name="lot_layout_id" id="lot_layout_id">
                        @foreach($lot_layouts as $id => $entry)
                            <option value="{{ $id }}" {{ old('lot_layout_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('lot_layout'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lot_layout') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.bookingSection.fields.lot_layout_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="deck">{{ trans('cruds.bookingSection.fields.level_no') }}</label>
                    <input class="form-control {{ $errors->has('deck') ? 'is-invalid' : '' }}" type="text" name="deck" id="deck" value="{{ old('deck', '') }}" required>
                    @if($errors->has('deck'))
                        <div class="invalid-feedback">
                            {{ $errors->first('deck') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.bookingSection.fields.level_no_helper') }}</span>
                </div> --}}
                {{-- <div class="form-group">
                    <div class="showSeat"></div>
                </div> --}}
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.sections.index') }}">
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

@section('scripts')
<script>
    $('input[name=deck]').on('input', function(){
        $('.showSeat').empty();
        for(var deck=1; deck<= $(this).val(); deck++){
            $('.showSeat').append(`
                <div class="form-group">
                    <label class="form-control-label font-weight-bold"> Total Lots of Level - ${deck} </label>
                    <input type="text" class="form-control" placeholder="@lang('Enter Number of Lots')" name="deck_seats[]" required>
                </div>
            `);
        }
    })
</script>
@endsection
