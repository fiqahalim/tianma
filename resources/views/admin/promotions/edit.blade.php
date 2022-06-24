@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.productManagement.title') }}</li>
            <li class="breadcrumb-item">Promotions</li>
            <li class="breadcrumb-item active" aria-current="page">
                Edit Promotion
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.edit') }} Promotion
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.promotions.update", [$promotion->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="required" for="promo_code">
                            Promotion Code
                        </label>
                        <input class="form-control {{ $errors->has('promo_code') ? 'is-invalid' : '' }}" type="text" name="promo_code" id="promo_code" value="{{ old('promo_code', $promotion->promo_code) }}" required>
                        @if($errors->has('promo_code'))
                            <div class="invalid-feedback">
                                {{ $errors->first('promo_code') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="promo_type">
                            Promotion Type
                        </label>
                        <select class="form-control {{ $errors->has('promo_type') ? 'is-invalid' : '' }}" name="promo_type" id="promo_type">
                            <option value disabled {{ old('promo_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\Promotion::PROMO_TYPE_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('promo_type', $promotion->promo_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="promo_value">
                            Promotion Value
                        </label>
                        <input class="form-control {{ $errors->has('promo_value') ? 'is-invalid' : '' }}" type="text" name="promo_value" id="promo_value" value="{{ old('promo_value', $promotion->promo_value) }}" required>
                        @if($errors->has('promo_value'))
                            <div class="invalid-feedback">
                                {{ $errors->first('promo_value') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.promotions.index') }}">
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
