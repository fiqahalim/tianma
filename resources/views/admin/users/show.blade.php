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
        <div class="row">
            <div class="col"></div>
            <div class="col justify-content-end">
                <form class="example" action="{{ route('admin.users.show', [$user->id]) }}" method="GET" style="margin:auto; max-width:300px">
                    <input type="text" placeholder="Search..." name="search" id="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="text-center">
            <div class="">
                <ol class="tree">
                    <li>
                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $user->name }}, Agency Code: {{ $user->agency_code ? $user->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $user->rankings->category }}">
                            <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .Auth::user()->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
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
                {{-- {!! $getUsers !!} --}}
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ mix('/css/pages/tree.css') }}" media="screen,projection" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        form.example input[type=text] {
          padding: 5px;
          font-size: 14px;
          border: 1px solid grey;
          float: left;
          width: 80%;
          background: #f1f1f1;
        }

        form.example button {
          float: left;
          width: 20%;
          padding: 5px;
          background: #2196F3;
          color: white;
          font-size: 14px;
          border: 1px solid grey;
          border-left: none;
          cursor: pointer;
        }

        form.example button:hover {
          background: #0b7dda;
        }

        form.example::after {
          content: "";
          clear: both;
          display: table;
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('/js/pages/hierarchy.js') }}"></script>
@endsection
