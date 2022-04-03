@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paymentMonthly.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-monthlies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMonthly.fields.id') }}
                        </th>
                        <td>
                            {{ $paymentMonthly->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMonthly.fields.month') }}
                        </th>
                        <td>
                            {{ $paymentMonthly->month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMonthly.fields.paid_amount') }}
                        </th>
                        <td>
                            {{ $paymentMonthly->paid_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentMonthly.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Transaction::STATUS_SELECT[$paymentMonthly->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-monthlies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
