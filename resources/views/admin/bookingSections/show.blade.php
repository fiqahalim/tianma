@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.masterSetting.title') }}</li>
            <li class="breadcrumb-item">
                Manage {{ trans('cruds.bookingSection.title') }}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Create {{ trans('cruds.bookingSection.title_singular') }}
            </li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.show') }} {{ trans('cruds.bookingSection.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.bookingSection.fields.id') }}
                            </th>
                            <td>
                                {{ $bookingSection->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.bookingSection.fields.section') }}
                            </th>
                            <td>
                                {{ $bookingSection->section }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.bookingSection.fields.seat_layout') }}
                            </th>
                            <td>
                                {{ $bookingSection->seat_layout }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.bookingSection.fields.lot_layout') }}
                            </th>
                            <td>
                                {{ $bookingSection->lot_layout->layout ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.sections.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
