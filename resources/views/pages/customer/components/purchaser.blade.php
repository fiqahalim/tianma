<div class="form-row">
    <div class="form-group col-md-5">
        <label class="required" for="full_name">{{ trans('cruds.customer.fields.full_name') }} As in NRIC/Passport
        </label>
        <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
        @if($errors->has('full_name'))
        <div class="invalid-feedback">
            {{ $errors->first('full_name') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.customer.fields.full_name_helper') }}</span>
    </div>

    <div class="form-group col-md-3">
        <label>{{ trans('cruds.customer.fields.id_type') }}</label>
        <select class="form-control {{ $errors->has('id_type') ? 'is-invalid' : '' }}" name="id_type" id="id_type">
            <option value disabled {{ old('id_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
            @foreach(App\Models\Customer::ID_TYPE_SELECT as $key => $label)
            <option value="{{ $key }}" {{ old('id_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if($errors->has('id_type'))
        <div class="invalid-feedback">
            {{ $errors->first('id_type') }}
        </div>
        @endif
        <span class="help-block">
            {{ trans('cruds.customer.fields.id_type_helper') }}
        </span>
    </div>

    <div class="form-group col-md-4">
        <label class="required" for="id_number">{{ trans('cruds.customer.fields.id_number') }}</label>
        <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="{{ trans('cruds.customer.fields.id_number_helper') }}">
        </i>
        <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', '') }}" required>
        @if($errors->has('id_number'))
        <div class="invalid-feedback">
            {{ $errors->first('id_number') }}
        </div>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="gender" class="required">
            Gender
        </label>
        <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
            <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
            @foreach(App\Models\Customer::GENDER_SELECT as $key => $label)
            <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if($errors->has('gender'))
        <div class="invalid-feedback">
            {{ $errors->first('gender') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.customer.fields.contact_person_no_helper') }}</span>
    </div>

    <div class="form-group col-md-4">
        <label for="mobile" class="required">
            Mobile
        </label>
        <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
        @if($errors->has('mobile'))
        <div class="invalid-feedback">
            {{ $errors->first('mobile') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.customer.fields.contact_person_no_helper') }}</span>
    </div>

    <div class="form-group col-md-4">
        <label for="email">Email</label>
        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
        @if($errors->has('email'))
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.customer.fields.email_helper') }}</span>
    </div>
</div>
