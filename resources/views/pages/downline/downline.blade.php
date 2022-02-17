@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            {{ trans('global.downline.title') }}
        </li>
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('global.downline.my_downline') }}
        </li>
    </ol>
</nav>

<div class="container-lg">
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('user.my-downline.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header font-weight-bold">
                    {{ trans('global.downline.my_downline') }}
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-info">
                                <th scope="col">
                                    #
                                </th>
                                <th scope="col">
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <th scope="col">
                                    {{ trans('cruds.user.fields.agent_code') }}
                                </th>
                                <th scope="col">
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>
                                        {{ ++$key }}
                                    </td>
                                    <td>
                                        {{ $user->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->agent_code ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->email ?? '' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
