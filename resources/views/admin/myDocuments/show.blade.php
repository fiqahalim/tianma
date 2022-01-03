@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.documentManagement.title') }}</li>
        <li class="breadcrumb-item">{{ trans('cruds.myDocument.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">View {{ trans('cruds.myDocument.title') }}</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.myDocument.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.myDocument.fields.id') }}
                        </th>
                        <td>
                            {{ $myDocument->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myDocument.fields.document_name') }}
                        </th>
                        <td>
                            {{ $myDocument->document_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myDocument.fields.description') }}
                        </th>
                        <td>
                            {{ $myDocument->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myDocument.fields.document_file') }}
                        </th>
                        <td>
                            @foreach($myDocument->document_file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.myDocument.fields.agents') }}
                        </th>
                        <td>
                            {{ $myDocument->agents->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.my-documents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection