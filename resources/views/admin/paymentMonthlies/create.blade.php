@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.paymentMonthly.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payment-monthlies.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="month">{{ trans('cruds.paymentMonthly.fields.month') }}</label>
                <input class="form-control date {{ $errors->has('month') ? 'is-invalid' : '' }}" type="text" name="month" id="month" value="{{ old('month') }}">
                @if($errors->has('month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMonthly.fields.month_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="paid_amount">{{ trans('cruds.paymentMonthly.fields.paid_amount') }}</label>
                <input class="form-control {{ $errors->has('paid_amount') ? 'is-invalid' : '' }}" type="number" name="paid_amount" id="paid_amount" value="{{ old('paid_amount', '') }}" step="0.01">
                @if($errors->has('paid_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('paid_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMonthly.fields.paid_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.paymentMonthly.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PaymentMonthly::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'Unpaid') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMonthly.fields.status_helper') }}</span>
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