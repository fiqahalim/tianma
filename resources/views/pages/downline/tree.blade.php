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
            <ol class="organizational-chart">
                <li>
                    <div>
                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ Auth::user()->name }}, Agency Code: {{ Auth::user()->agency_code ? Auth::user()->agency_code : 'Not Available Yet' }}">
                            <img class="rounded-circle mt-2" src="{{ asset('/images/profile/'.Auth::user()->avatar ?? 'avatar.png') }}" width="80" data-toggle="modal" data-target="#userDetailsModal">
                        </span>
                        <div class="mt-2">
                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ Auth::user()->name }}, Agency Code: {{ Auth::user()->agency_code ? Auth::user()->agency_code : 'Not Available Yet' }}">
                                <strong>{{ Auth::user()->agent_code ?? 'Not Available' }}</strong>
                            </span>
                        </div>
                        <i id="menu-item" class="fas fa-plus-circle" onclick="myFunction()"></i>
                    </div>
                    @if(count($user))
                        <ol>
                            @foreach($user as $key => $childUser)
                                <li class="sub-menu">
                                    <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}">
                                        <img class="rounded-circle mt-2" src="{{ asset('/images/profile/'.$childUser->avatar ?? 'avatar.png') }}" width="80">
                                    </span>
                                    <div class="mt-2">
                                        <span>{{ $childUser->agent_code ?? 'Not Available' }}</span>
                                    </div>
                                    {{-- @if(count($childUser->childUsers))
                                    <ol>
                                        @foreach($childUser->childUsers as $childs)
                                            <li class="sub-menu">
                                                <img class="rounded-circle mt-2" src="https://bootdey.com/img/Content/avatar/avatar7.png" width="80">
                                                <div class="mt-2">
                                                    <span>{{ $childs->agent_code }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                    @endif --}}
                                </li>
                            @endforeach
                        </ol>
                    @endif
                </li>
            </ol>
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
    <script type="text/javascript" src="{{ mix('/js/pages/hierarchy.js') }}"></script>
@endsection
