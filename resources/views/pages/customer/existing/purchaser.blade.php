<div aria-labelledby="headingOne" class="collapse show" data-parent="#accordionExample" id="collapseOne">
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="required" for="full_name">{{ trans('cruds.customer.fields.full_name') }} as in NRIC/Passport</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', $customer->full_name) }}" required>
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label>{{ trans('cruds.customer.fields.id_type') }}</label>
                <input class="form-control {{ $errors->has('id_type') ? 'is-invalid' : '' }}" type="text" name="id_type" id="id_type" value="{{ old('id_type', $customer->id_type) }}" required>
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
                <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', $customer->id_number) }}" required>
                @if($errors->has('id_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.id_number_helper') }}</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="gender" class="required">Gender</label>
                <input class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" type="text" name="gender" id="gender" value="{{ old('gender', $customer->gender) }}">
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.contact_person_name_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="contact_person_no" class="required">Mobile</label>
                <input class="form-control {{ $errors->has('contact_person_no') ? 'is-invalid' : '' }}" type="text" name="contact_person_no" id="contact_person_no" value="{{ old('contact_person_no', $customer->contact_person_no) }}">
                @if($errors->has('contact_person_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_person_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.contact_person_no_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $customer->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.customer.fields.email_helper') }}</span>
            </div>
        </div>
    </div>
</div>