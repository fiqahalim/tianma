@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('global.downline.title') }}</li>
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('global.downline.my_referral') }}
        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-header">
        {{ trans('global.downline.my_referral') }}
    </div>
    <div class="card-body">
        <p>
            RM {{ $total }}
        </p>
    </div>
</div>
@endsection
