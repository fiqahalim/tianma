<div class="card" id="card2">
    <div class="card-header" id="headingTwo" data-target="#collapseTwo" data-toggle="collapse">
        <h2 class="mb-0">
            <button aria-controls="collapseTwo" aria-expanded="false" class="btn collapsed" data-target="#collapseTwo" data-toggle="collapse" type="button">
                <strong>PARTICULARS OF INTENDED USER</strong>
            </button>
            <i class="fas fa-chevron-down fa-xs float-right mt-2"></i>
        </h2>
    </div>
    <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionExample" id="collapseTwo">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="cperson_name" class="required">
                        Name
                    </label>
                    <input class="form-control {{ $errors->has('cperson_name') ? 'is-invalid' : '' }}" type="text" name="cperson_name" id="cperson_name" value="{{ old('cperson_name', '') }}">
                    @if($errors->has('cperson_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cperson_name') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.contact_person_name_helper') }}</span>
                </div>

                <div class="form-group col-md-3">
                    <label>{{ trans('cruds.customer.fields.id_type') }}</label>
                    <select class="form-control {{ $errors->has('cid_type') ? 'is-invalid' : '' }}" name="cid_type" id="cid_type">
                        <option value disabled {{ old('cid_type', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                            @foreach(App\Models\Customer::ID_TYPE_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('cid_type', '') === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                    </select>
                    @if($errors->has('cid_type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cid_type') }}
                        </div>
                    @endif
                    <span class="help-block">
                        {{ trans('cruds.customer.fields.id_type_helper') }}
                    </span>
                </div>

                <div class="form-group col-md-3">
                    <label class="required" for="cid_number">{{ trans('cruds.customer.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('cid_number') ? 'is-invalid' : '' }}" type="text" name="cid_number" id="cid_number" value="{{ old('cid_number', '') }}" required>
                    @if($errors->has('cid_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cid_number') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.id_number_helper') }}</span>
                </div>

                <div class="form-group col-md-3">
                    <label class="required" for="relationships">
                        Relationships
                    </label>
                    <input class="form-control {{ $errors->has('relationships') ? 'is-invalid' : '' }}" type="text" name="relationships" id="relationships" value="{{ old('relationships', '') }}" required>
                    @if($errors->has('relationships'))
                        <div class="invalid-feedback">
                            {{ $errors->first('relationships') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.id_number_helper') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
