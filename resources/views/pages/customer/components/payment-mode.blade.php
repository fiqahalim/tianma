<div class="card" id="card3">
    <div class="card-header" id="headingThree" data-target="#collapseThree" data-toggle="collapse">
        <h2 class="mb-0">
            <button aria-controls="collapseThree" aria-expanded="false" class="btn collapsed" data-target="#collapseThree" data-toggle="collapse" type="button">
                <strong>PAYMENT MODE</strong>
            </button>
            <i class="fas fa-chevron-down fa-xs float-right mt-2"></i>
        </h2>
    </div>

    <div aria-labelledby="headingThree" class="collapse" data-parent="#accordionExample" id="collapseThree">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="address_1" class="required">{{ trans('cruds.customer.fields.address_1') }}</label>
                    <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text" name="address_1" id="address_1" value="{{ old('address_1', '') }}">
                    @if($errors->has('address_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_1') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_1_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="address_2">{{ trans('cruds.customer.fields.address_2') }}</label>
                    <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                    @if($errors->has('address_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_2') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_2_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="address_2">{{ trans('cruds.customer.fields.address_2') }}</label>
                    <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                    @if($errors->has('address_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_2') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_2_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="address_2">{{ trans('cruds.customer.fields.address_2') }}</label>
                    <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', '') }}">
                    @if($errors->has('address_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_2') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_2_helper') }}</span>
                </div>
            </div>

            {{-- Payment Option --}}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required">{{ trans('cruds.customer.fields.mode') }}</label>
                    <select class="form-control select2 {{ $errors->has('mode') ? 'is-invalid' : '' }}" name="mode" id="mode">
                        <option value disabled {{ old('mode', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Customer::MODE_SELECT as $key => $mode)
                            <option value="{{ $key }}" {{ old('mode', '') === (string) $key ? 'selected' : '' }}>
                                {{ $mode }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('mode'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mode') }}
                        </div>
                    @endif
                    <span class="help-block">
                        {{ trans('cruds.customer.fields.id_type_helper') }}
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold required" for="agent_code">
                        Referral {{ trans('global.register.agent_code') }}
                    </label>
                    <select class="form-control select2 {{ $errors->has('created_by') ? 'is-invalid' : '' }}" name="created_by" id="created_by">
                        @include('components.parent-child')
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
