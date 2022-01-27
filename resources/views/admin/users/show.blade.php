@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.userManagement.title') }}</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ trans('cruds.user.title') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.user.fields.hierarchy') }}</li>
    </ol>
</nav>

<div class="container-fluid">
    <div class="text-center">
        <div class="tree">
            <ul>
                <li>
                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .Auth::user()->avatar) ?? '/images/avatar.png' }}" width="80" data-toggle="modal" data-target="#userDetailsModal">
                    <div class="mt-2">
                        <span><strong>{{ $user->agent_code }}</strong></span>
                    </div>
                    <i id="menu-item" class="fas fa-plus-circle"></i>
                    @if(count($user->childUsers))
                        <ul>
                            @foreach($user->childUsers as $childUser)
                                <li class="sub-menu">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                    <i id="menu-item" class="fas fa-plus-circle"></i>
                                    @if(count($childUser->childUsers))
                                    <ul>
                                        @foreach($user->childUsers as $childs)
                                            <li class="sub-menu">
                                                <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childs->avatar) ?? '/images/avatar.png' }}" width="80">
                                                <div class="mt-2">
                                                    <span>{{ $childs->agent_code }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            </ul>
        </div>
    </div>

    <!-- Modal -->
    @include('admin.users.modal')
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
</script>
@endsection