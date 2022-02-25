@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('global.downline.title') }}</li>
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('global.downline.my_tree') }}
        </li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="text-center">
        <div class="tree">
            <ul>
                <li>
                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/'.Auth::user()->avatar ?? 'avatar.png') }}" width="80" data-toggle="modal" data-target="#userDetailsModal">
                    <div class="mt-2">
                        <span><strong>{{ Auth::user()->agent_code ?? 'Not Available' }}</strong></span>
                    </div>
                    @include('components.hierarchy')
                </li>
            </ul>
        </div>
    </div>

    <!-- Modal -->
    @include('pages.downline.components.modal')
</div>
@endsection

@section('styles')
<link href="{{ mix('/css/pages/tree.css') }}" media="screen,projection" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
<script>
    $("#menu-item").click(function(){
        $(".sub-menu").toggle();
    });
    $("#child-item").click(function(){
        $(".child-menu").toggle();
    });
    $("#child-child").click(function(){
        $(".child-child-menu").toggle();
    });
    $("#child-cc").click(function(){
        $(".child-cc-menu").toggle();
    });
    $("#child-ccc").click(function(){
        $(".child-ccc-menu").toggle();
    });
    $("#child-dd").click(function(){
        $(".child-dd-menu").toggle();
    });
</script>
@endsection
