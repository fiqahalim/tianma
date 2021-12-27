@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('global.downline.title') }}</li>
        <li aria-current="page" class="breadcrumb-item active">
            My commission
        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-header">
        My Commission
    </div>
    <div class="card-body">
        <p>
            RM {{ $total }}
        </p>
    </div>
</div>
@endsection
