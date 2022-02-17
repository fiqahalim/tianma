@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.commission.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">View {{ trans('cruds.commission.title') }}</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.commission.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.commission.fields.id') }}
                        </th>
                        <td>
                            {{ $commission->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commission.fields.commission') }}
                        </th>
                        <td>
                            {{ $commission->mo_overriding_comm }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commission.fields.increased_commission') }}
                        </th>
                        <td>
                            {{ $commission->mo_spin_off ?? 'Not eligible yet' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commission.fields.user') }}
                        </th>
                        <td>
                            {{ $commission->user->agent_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.commission.fields.order') }}
                        </th>
                        <td>
                            #{{ $commission->orders->ref_no ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.commissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
