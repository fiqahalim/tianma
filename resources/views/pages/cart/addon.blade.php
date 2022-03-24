@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.new-order.index') }}">{{ trans('global.products.title') }}</a></li>
            <li class="breadcrumb-item">Add-ons product</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h3 class="text-2xl font-medium text-gray-700">Add-on Product</h3>
    </div>
@endsection
