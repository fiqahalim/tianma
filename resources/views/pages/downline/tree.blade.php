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

<div class="container center">
    <div class="text-center">
        <div class="tree">
            <ul>
                @foreach($users as $user) 
                <li>
                    <img class="rounded-circle mt-2" src="https://bootdey.com/img/Content/avatar/avatar7.png" width="80" data-toggle="modal" data-target="#exampleModalCenter">
                        <div class="mt-3">
                            <p class="text-muted font-size-sm">
                                {{ $user->name ?? '' }}
                            </p>
                        </div>
                    </img>
                    {{-- Child Users --}}
                    <ul>
                        @foreach($user->childUsers as $childUser)
                        <li>
                            <img class="rounded-circle mt-2" src="https://bootdey.com/img/Content/avatar/avatar7.png" width="80">
                                <div class="mt-3">
                                    <p class="text-muted font-size-sm">
                                        {{ $childUser->name ?? '' }}
                                    </p>
                                </div>
                            </img>
                            {{-- Another Child Users --}}
                            <ul>
                                @foreach($childUser->childUsers as $childUser)
                                <li>
                                    <img class="rounded-circle mt-2" src="https://bootdey.com/img/Content/avatar/avatar7.png" width="80">
                                    <div class="mt-3">
                                        <p class="text-muted font-size-sm">
                                            {{ $childUser->name ?? '' }}
                                        </p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
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
@parent
{{--
<script src="{{ mix('/js/pages/tree.js') }}" type="text/javascript">
</script>
--}}
@endsection
