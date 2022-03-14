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
                        <input class="form-check-input" type="checkbox" name="payment_name[]" value="cheque">
                        <label class="ml-2">Cheque No.</label>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="payment_name[]" value="cash">
                        <label class="ml-2">Cash</label>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="payment_name[]" value="card">
                        <label class="ml-2">Credit Card</label>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="payment_name[]" value="others">
                        <label class="ml-2">Others</label>
                    </div>
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
