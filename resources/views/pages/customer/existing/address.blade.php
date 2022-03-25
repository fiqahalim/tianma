{{-- Permanent Address --}}
<h6 class="mb-3">Permanent Address</h6>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="address_1" class="required">{{ trans('cruds.customer.fields.address_1') }}</label>
        <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text" name="address_1" id="address_1" value="{{ old('address_1', $customer->address_1) }}">
        @if($errors->has('address_1'))
            <div class="invalid-feedback">
                {{ $errors->first('address_1') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.customer.fields.address_1_helper') }}</span>
    </div>
    <div class="form-group col-md-6">
        <label for="address_2">{{ trans('cruds.customer.fields.address_2') }}</label>
        <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', $customer->address_2) }}">
        @if($errors->has('address_2'))
        <div class="invalid-feedback">
            {{ $errors->first('address_2') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.customer.fields.address_2_helper') }}</span>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-2">
        <label for="postcode">{{ trans('cruds.customer.fields.postcode') }}</label>
        <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="text" name="postcode" id="postcode" value="{{ old('postcode', $customer->postcode) }}" step="1">
        @if($errors->has('postcode'))
        <div class="invalid-feedback">
            {{ $errors->first('postcode') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.customer.fields.postcode_helper') }}</span>
    </div>
    <div class="form-group col-md-2">
        <label for="state">{{ trans('cruds.customer.fields.state') }}</label>
        <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', $customer->state) }}">
        @if($errors->has('state'))
        <div class="invalid-feedback">
            {{ $errors->first('state') }}
        </div>
        @endif
        <span class="help-block">
            {{ trans('cruds.customer.fields.state_helper') }}
        </span>
    </div>
    <div class="form-group col-md-2">
        <label for="city">{{ trans('cruds.customer.fields.city') }}</label>
        <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $customer->city) }}">
        @if($errors->has('city'))
        <div class="invalid-feedback">
            {{ $errors->first('city') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.customer.fields.city_helper') }}</span>
    </div>
    <div class="form-group col-md-3">
        <label for="nationality">{{ trans('cruds.customer.fields.nationality') }}</label>
        <input class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" type="text" name="nationality" id="nationality" value="{{ old('nationality', $customer->nationality) }}">
        @if($errors->has('nationality'))
        <div class="invalid-feedback">
            {{ $errors->first('nationality') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.customer.fields.nationality_helper') }}</span>
    </div>
    <div class="form-group col-md-3">
        <label for="country">{{ trans('cruds.customer.fields.country') }}</label>
        <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', $customer->country) }}">
        @if($errors->has('country'))
        <div class="invalid-feedback">
            {{ $errors->first('country') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.customer.fields.country_helper') }}</span>
    </div>
</div>
<hr>

{{-- Corresspondence Address --}}
<h6 class="mb-3">Correspondence Address</h6>
@foreach($corAddr as $v => $addr)
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="curaddress_1" class="required">{{ trans('cruds.customer.fields.address_1') }}</label>
            <input class="form-control {{ $errors->has('curaddress_1') ? 'is-invalid' : '' }}" type="text" name="curaddress_1" id="curaddress_1" value="{{ old('curaddress_1', $addr->correspondenceAddress->curaddress_1) }}">
        </div>
        <div class="form-group col-md-6">
            <label for="curaddress_2">{{ trans('cruds.customer.fields.address_2') }}</label>
            <input class="form-control {{ $errors->has('curaddress_2') ? 'is-invalid' : '' }}" type="text" name="curaddress_2" id="curaddress_2" value="{{ old('curaddress_2', $addr->correspondenceAddress->curaddress_2) }}">
            @if($errors->has('curaddress_2'))
            <div class="invalid-feedback">
                {{ $errors->first('curaddress_2') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.customer.fields.address_2_helper') }}</span>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="curpostcode">{{ trans('cruds.customer.fields.postcode') }}</label>
            <input class="form-control {{ $errors->has('curpostcode') ? 'is-invalid' : '' }}" type="text" name="curpostcode" id="curpostcode" value="{{ old('curpostcode', $addr->correspondenceAddress->curpostcode) }}" step="1">
            @if($errors->has('curpostcode'))
            <div class="invalid-feedback">
                {{ $errors->first('curpostcode') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.customer.fields.postcode_helper') }}</span>
        </div>
        <div class="form-group col-md-2">
            <label for="curstate">{{ trans('cruds.customer.fields.state') }}</label>
            <input class="form-control {{ $errors->has('curstate') ? 'is-invalid' : '' }}" type="text" name="curstate" id="curstate" value="{{ old('curstate', $addr->correspondenceAddress->curstate) }}">
            @if($errors->has('curstate'))
            <div class="invalid-feedback">
                {{ $errors->first('curstate') }}
            </div>
            @endif
            <span class="help-block">
                {{ trans('cruds.customer.fields.state_helper') }}
            </span>
        </div>
        <div class="form-group col-md-2">
            <label for="curcity">{{ trans('cruds.customer.fields.city') }}</label>
            <input class="form-control {{ $errors->has('curcity') ? 'is-invalid' : '' }}" type="text" name="curcity" id="curcity" value="{{ old('curcity', $addr->correspondenceAddress->curcity) }}">
            @if($errors->has('curcity'))
            <div class="invalid-feedback">
                {{ $errors->first('curcity') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.customer.fields.city_helper') }}</span>
        </div>
        <div class="form-group col-md-3">
            <label for="curnationality">{{ trans('cruds.customer.fields.nationality') }}</label>
            <input class="form-control {{ $errors->has('curnationality') ? 'is-invalid' : '' }}" type="text" name="curnationality" id="curnationality" value="{{ old('curnationality', $addr->correspondenceAddress->curnationality) }}">
            @if($errors->has('curnationality'))
            <div class="invalid-feedback">
                {{ $errors->first('curnationality') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.customer.fields.nationality_helper') }}</span>
        </div>
        <div class="form-group col-md-3">
            <label for="curcountry">{{ trans('cruds.customer.fields.country') }}</label>
            <input class="form-control {{ $errors->has('curcountry') ? 'is-invalid' : '' }}" type="text" name="curcountry" id="curcountry" value="{{ old('curcountry', $addr->correspondenceAddress->curcountry) }}">
            @if($errors->has('curcountry'))
            <div class="invalid-feedback">
                {{ $errors->first('curcountry') }}
            </div>
            @endif
            <span class="help-block">{{ trans('cruds.customer.fields.country_helper') }}</span>
        </div>
    </div>
@endforeach
