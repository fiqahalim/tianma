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
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="payment_name[]" value="Cheque">
                        <label class="ml-2">Cheque No.</label>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="payment_name[]" value="Cash">
                        <label class="ml-2">Cash</label>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="payment_name[]" value="Credit Card">
                        <label class="ml-2">Credit Card</label>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="payment_name[]" value="Others">
                        <label class="ml-2">Others</label>
                    </div>
                </div>
            </div>

            {{-- Payment Option --}}
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Promotion Code</label>
                    <select class="form-control select2 {{ $errors->has('promo') ? 'is-invalid' : '' }}" name="promo" id="promo" required form="myForm">
                        <option value disabled {{ old('promo', null) === null ? 'selected' : '' }}>No Promotion Code</option>
                        @foreach($promos as $key => $promo)
                            <option value="{{ $key }}" {{ old('promo', '') === (string) $key ? 'selected' : '' }}>
                                {{ $promo }}
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
                <div class="form-group col-md-4">
                    <label class="required">{{ trans('cruds.customer.fields.mode') }}</label>
                    <select class="form-control select2 {{ $errors->has('mode') ? 'is-invalid' : '' }}" name="mode" id="mode" required form="myForm">
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

                <div class="form-group col-md-4">
                    <label class="font-weight-bold required" for="agent_code">
                        Referral {{ trans('global.register.agent_code') }}
                    </label>
                    <select class="form-control select2 {{ $errors->has('created_by') ? 'is-invalid' : '' }}" name="created_by" id="created_by" required form="myForm">
                        @include('components.parent-child')
                    </select>
                    @if($errors->has('created_by'))
                        <div class="invalid-feedback">
                            {{ $errors->first('created_by') }}
                        </div>
                    @endif
                    <span class="help-block">
                        {{ trans('cruds.customer.fields.id_type_helper') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
