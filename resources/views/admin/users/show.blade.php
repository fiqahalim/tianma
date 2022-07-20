@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.userManagement.title') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ trans('cruds.user.title') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.user.fields.hierarchy') }}</li>
        </ol>
    </nav>

    <div class="container-fluid scroll">
        <div class="text-center">
            <div class="">
                <ol class="tree">
                    <li>
                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $user->name }}, Agency Code: {{ $user->agency_code ? $user->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $user->rankings->category }}">
                            <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .Auth::user()->avatar) ?? '/images/avatar.png' }}" width="32" height="32">
                        </span>

                        <div>
                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $user->name }}, Agency Code: {{ $user->agency_code ? $user->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $user->rankings->category }}">
                                <strong>{{ $user->agent_code }}</strong>
                            </span>
                        </div>
                        {{-- <i id="menu-item" class="fas fa-plus-circle"></i> --}}
                        @include('components.hierarchy')
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ mix('/css/pages/tree.css') }}" media="screen,projection" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/hierarchy.js') }}"></script>
@endsection
