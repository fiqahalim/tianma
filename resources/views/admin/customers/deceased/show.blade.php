@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.customer.title') }} Management</li>
        <li class="breadcrumb-item">{{ trans('cruds.customer.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">View Deceased Person</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} Deceased Person Information
    </div>

    <div class="card-body">
    </div>
</div>
@endsection

@section('styles')
@endsection

@section('scripts')
@parent
@endsection
