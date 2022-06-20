@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.customer.title') }} Management</li>
            <li class="breadcrumb-item">Intended Users</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Intended Users</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.edit') }} {{ trans('cruds.contactPerson.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.contact-people.update", [$contactPerson->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-row">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Name</th>
                            <th>Contact Number</th>
                            <th>Relationships</th>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control {{ $errors->has('cperson_name') ? 'is-invalid' : '' }}" type="text" name="addMoreInputFields[0][cperson_name]" id="cperson_name" value="{{ old('cperson_name', $contactPerson->cperson_name) }}">
                                @if($errors->has('cperson_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('cperson_name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.customer.fields.contact_person_name_helper') }}</span>
                            </td>
                            <td>
                                <input class="form-control {{ $errors->has('cperson_no') ? 'is-invalid' : '' }}" type="text" name="addMoreInputFields[0][cperson_no]" id="cperson_no" value="{{ old('cperson_no', $contactPerson->cperson_no) }}">
                                @if($errors->has('cperson_no'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('cperson_no') }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <input class="form-control {{ $errors->has('relationships') ? 'is-invalid' : '' }}" type="text" name="addMoreInputFields[0][relationships]" id="relationships" value="{{ old('relationships', $contactPerson->relationships) }}">
                                @if($errors->has('relationships'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('relationships') }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <label for="customer_id">{{ trans('cruds.contactPerson.fields.customer') }}</label>
                    <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id">
                        @foreach($customers as $id => $entry)
                            <option value="{{ $id }}" {{ (old('customer_id') ? old('customer_id') : $contactPerson->customer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('customer'))
                        <div class="invalid-feedback">
                            {{ $errors->first('customer') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.contactPerson.fields.customer_helper') }}</span>
                </div>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.contact-people.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][cperson_name]" class="form-control" /></td><td><input type="text" name="addMoreInputFields[' + i +
            '][cperson_no]" class="form-control" /></td><td><input type="text" name="addMoreInputFields[' + i +
            '][relationships]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
