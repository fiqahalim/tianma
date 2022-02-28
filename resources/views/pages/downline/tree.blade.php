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
                    @if(count($user))
                    <i id="menu-item" class="fas fa-plus-circle" onclick="myFunction()"></i>
                        <ul>
                            @foreach($user as $key => $childUser)
                                <li class="sub-menu">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/'.$childUser->avatar ?? 'avatar.png') }}" width="80">
                                    <div class="mt-2">
                                        <span>{{ $childUser->agent_code ?? 'Not Available' }}</span>
                                    </div>
                                    {{-- @if(count($childUser->childUsers))
                                    <ul>
                                        @foreach($childUser->childUsers as $childs)
                                            <li class="sub-menu">
                                                <img class="rounded-circle mt-2" src="https://bootdey.com/img/Content/avatar/avatar7.png" width="80">
                                                <div class="mt-2">
                                                    <span>{{ $childs->agent_code }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @endif --}}
                                </li>
                            @endforeach
                        </ul>
                    @endif
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
    <script type="text/javascript" src="{{ mix('/js/pages/hierarchy.js') }}"></script>
@endsection
