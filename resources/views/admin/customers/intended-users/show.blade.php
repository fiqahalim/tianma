@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.customer.title') }} Management</li>
            <li class="breadcrumb-item">Intended Users</li>
            <li class="breadcrumb-item active" aria-current="page">View Intended Users</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.show') }} {{ trans('cruds.contactPerson.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.contactPerson.fields.id') }}
                            </th>
                            <td>
                                {{ $contactPerson->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.contactPerson.fields.name') }}
                            </th>
                            <td>
                                {{ $contactPerson->cperson_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Contact Number
                            </th>
                            <td>
                                {{ $contactPerson->cperson_no }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.contactPerson.fields.relationship') }}
                            </th>
                            <td>
                                {{ $contactPerson->relationships }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.contactPerson.fields.customer') }}
                            </th>
                            <td>
                                {{ $contactPerson->customers->full_name ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.contact-people.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
