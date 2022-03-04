@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.order.title') }}</li>
            <li class="breadcrumb-item">{{ trans('cruds.order.fields.createOrder') }}</li>
            <li aria-current="page" class="breadcrumb-item active">
                {{ trans('global.customerDetails') }}
            </li>
        </ol>
    </nav>

    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.customer-details.update', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product, $searchCust[0]->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            @if(isset($searchCust))
                @foreach($searchCust as $customer)
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne" data-target="#collapseOne" data-toggle="collapse">
                                <h2 class="mb-0">
                                    <button aria-controls="collapseOne" aria-expanded="true" class="btn" data-target="#collapseOne" data-toggle="collapse" type="button">
                                        <strong>{{ trans('global.customerDetails') }}</strong>
                                    </button>
                                    <i class="fas fa-chevron-down fa-xs float-right mt-2"></i>
                                </h2>
                            </div>
                            <div aria-labelledby="headingOne" class="collapse show" data-parent="#accordionExample" id="collapseOne">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label class="required" for="full_name">{{ trans('cruds.customer.fields.full_name') }}</label>
                                            <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', $customer->full_name) }}" required>
                                            @if($errors->has('full_name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('full_name') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.customer.fields.full_name_helper') }}</span>
                                        </div>
                                        <div class="form-group col-md-3">
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
                                            <label for="contact_person_name" class="required">{{ trans('cruds.customer.fields.contact_person_name') }}</label>
                                            <input class="form-control {{ $errors->has('contact_person_name') ? 'is-invalid' : '' }}" type="text" name="contact_person_name" id="contact_person_name" value="{{ old('contact_person_name', $customer->contact_person_name) }}">
                                            @if($errors->has('contact_person_name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('contact_person_name') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.customer.fields.contact_person_name_helper') }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="contact_person_no" class="required">{{ trans('cruds.customer.fields.contact_person_no') }}</label>
                                            <input class="form-control {{ $errors->has('contact_person_no') ? 'is-invalid' : '' }}" type="text" name="contact_person_no" id="contact_person_no" value="{{ old('contact_person_no', $customer->contact_person_no) }}">
                                            @if($errors->has('contact_person_no'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('contact_person_no') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.customer.fields.contact_person_no_helper') }}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email">{{ trans('cruds.customer.fields.email') }}</label>
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
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingTwo" data-target="#collapseTwo" data-toggle="collapse">
                                <h2 class="mb-0">
                                    <button aria-controls="collapseTwo" aria-expanded="false" class="btn collapsed" data-target="#collapseTwo" data-toggle="collapse" type="button">
                                        <strong>{{ trans('global.billing.billingDetails') }}</strong>
                                    </button>
                                    <i class="fas fa-chevron-down fa-xs float-right mt-2"></i>
                                </h2>
                            </div>
                            <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionExample" id="collapseTwo">
                                <div class="card-body">
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

                                    {{-- Payment Option --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="required">{{ trans('cruds.customer.fields.mode') }}</label>
                                            <select class="form-control select2 {{ $errors->has('mode') ? 'is-invalid' : '' }}" name="mode" id="mode">
                                                <option value disabled {{ old('mode', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                @foreach(App\Models\Customer::MODE_SELECT as $key => $mode)
                                                    <option value="{{ $key }}" {{ old('mode', '') === (string) $key ? 'selected' : '' }}>{{ $mode }}</option>
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
                    </div>
                @endforeach
            @endif

            <div class="form-group float-right">
                <a class="btn btn-default" href="{{ route('admin.search', [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]) }}">
                    {{ trans('global.back') }}
                </a>
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.proceed') }}
                </button>
            </div>
        </form>
    </div>
@endsection
