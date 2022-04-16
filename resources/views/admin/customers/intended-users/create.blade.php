@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.customer.title') }} Management</li>
            <li class="breadcrumb-item">Intended Users</li>
            <li class="breadcrumb-item active" aria-current="page">Create Intended Users</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('global.create') }} Intended Users
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.contact-people.store") }}" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th>Name</th>
                            <th>{{ trans('cruds.customer.fields.id_number') }}</th>
                            <th>Relationships</th>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control {{ $errors->has('cperson_name') ? 'is-invalid' : '' }}" type="text" name="addMoreInputFields[0][cperson_name]" id="cperson_name" value="{{ old('cperson_name', '') }}">
                                @if($errors->has('cperson_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cperson_name') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.customer.fields.contact_person_name_helper') }}</span>
                            </td>
                            <td>
                                <input class="form-control {{ $errors->has('cid_number') ? 'is-invalid' : '' }}" type="text" name="addMoreInputFields[0][cid_number]" id="cid_number" value="{{ old('cid_number', '') }}">
                                @if($errors->has('cid_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cid_number') }}
                                </div>
                                @endif
                            </td>
                            <td>
                                <input class="form-control {{ $errors->has('relationships') ? 'is-invalid' : '' }}" type="text" name="addMoreInputFields[0][relationships]" id="relationships" value="{{ old('relationships', '') }}">
                                @if($errors->has('relationships'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('relationships') }}
                                    </div>
                                @endif
                            </td>
                            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add More</button></td>
                        </tr>
                    </table>
                </div>

                <div class="form-row mt-2">
                    <div class="form-group col-md-12">
                        <label class="required">{{ trans('cruds.user.fields.ref_name') }}</label>
                        <select class="form-control select2 {{ $errors->has('customers') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id">
                            @foreach($customers as $id => $data)
                                <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $data }}</option>
                            @endforeach
                        </select>
                    </div>
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
            '][cid_number]" class="form-control" /></td><td><input type="text" name="addMoreInputFields[' + i +
            '][relationships]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
