@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.userManagement.title') }}</li>
        <li class="breadcrumb-item">{{ trans('cruds.user.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">Edit {{ trans('cruds.user.title') }}</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label>{{ trans('cruds.user.fields.id_type') }}</label>
                    <select class="form-control {{ $errors->has('id_type') ? 'is-invalid' : '' }}" name="id_type" id="id_type">
                        <option value disabled {{ old('id_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\User::ID_TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('id_type', $user->id_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('id_type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.id_type_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="id_number">{{ trans('cruds.user.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', $user->id_number) }}" required>
                    @if($errors->has('id_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.id_number_helper') }}</span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="username">{{ trans('cruds.user.fields.username') }}</label>
                    <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required>
                    @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.username_helper') }}</span>
                </div>
                {{-- <div class="form-group col-md-2">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div> --}}
                <div class="form-group col-md-3">
                    <label class="required" for="contact_no">{{ trans('cruds.user.fields.contact_no') }}</label>
                    <input class="form-control {{ $errors->has('contact_no') ? 'is-invalid' : '' }}" type="text" name="contact_no" id="contact_no" value="{{ old('contact_no', $user->contact_no) }}" required>
                    @if($errors->has('contact_no'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contact_no') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.contact_no_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="agent_code">{{ trans('cruds.user.fields.agent_code') }}</label>
                    <input class="form-control {{ $errors->has('agent_code') ? 'is-invalid' : '' }}" type="text" name="agent_code" id="agent_code" value="{{ old('agent_code', $user->agent_code) }}">
                    @if($errors->has('agent_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('agent_code') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.agent_code_helper') }}</span>
                </div>
            </div>
            <hr>

            {{-- Address Details --}}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="address_1">{{ trans('cruds.user.fields.address_1') }}</label>
                    <input class="form-control {{ $errors->has('address_1') ? 'is-invalid' : '' }}" type="text" name="address_1" id="address_1" value="{{ old('address_1', $user->address_1) }}">
                    @if($errors->has('address_1'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_1') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.address_1_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="address_2">{{ trans('cruds.user.fields.address_2') }}</label>
                    <input class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" type="text" name="address_2" id="address_2" value="{{ old('address_2', $user->address_2) }}">
                    @if($errors->has('address_2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_2') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.address_2_helper') }}</span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="postcode">{{ trans('cruds.user.fields.postcode') }}</label>
                    <input class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" type="number" name="postcode" id="postcode" value="{{ old('postcode', $user->postcode) }}" step="1">
                    @if($errors->has('postcode'))
                        <div class="invalid-feedback">
                            {{ $errors->first('postcode') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.postcode_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="state">{{ trans('cruds.user.fields.state') }}</label>
                    <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', $user->state) }}">
                    @if($errors->has('state'))
                        <div class="invalid-feedback">
                            {{ $errors->first('state') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.state_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="city">{{ trans('cruds.user.fields.city') }}</label>
                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $user->city) }}">
                    @if($errors->has('city'))
                        <div class="invalid-feedback">
                            {{ $errors->first('city') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
                </div>
            </div>
            <hr>

            {{-- Team Details --}}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="team_id">{{ trans('cruds.user.fields.team') }}</label>
                    <select class="form-control form-select {{ $errors->has('team') ? 'is-invalid' : '' }}" name="team_id" id="team_id">
                        @foreach($teams as $id => $entry)
                            <option value="{{ $id }}" {{ (old('team_id') ? old('team_id') : $user->team->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('team'))
                        <div class="invalid-feedback">
                            {{ $errors->first('team') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.team_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label>{{ trans('cruds.user.fields.ref_name') }}</label>
                    <input class="form-control" type="text" value="{{ $user->parent ? $user->parent->agent_code : '' }}" readonly>
                </div>
                {{-- Commissions --}}
                <div class="form-group col-md-4">
                    <label>{{ trans('cruds.ranking.currentRank') }}</label>
                    <select class="form-control form-select {{ $errors->has('rankings') ? 'is-invalid' : '' }}" name="ranking_id" id="rankings_id" disabled>
                        @foreach($rankings as $id => $data)
                            <option value="{{ $id }}" {{ (old('rankings_id') ? old('rankings_id') : $user->rankings->id ?? '') == $id ? 'selected' : '' }}>{{ $data }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>{{ trans('cruds.commission.fields.comm_monthly') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control" type="text" value="{{ $user->parent ? $user->parent->agent_code : '' }}" readonly>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>{{ trans('cruds.ranking.remoteDemote') }}</label>
                    <select class="form-control form-select {{ $errors->has('rankings') ? 'is-invalid' : '' }}" name="ranking_id" id="rankings_id">
                        @foreach($rankings as $id => $data)
                            <option value="{{ $id }}" {{ (old('rankings_id') ? old('rankings_id') : $user->rankings->id ?? '') == $id ? 'selected' : '' }}>{{ $data }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr>

            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>

            <div class="form-group pl-2">
                <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="approved" value="0">
                    <input class="form-check-input" type="checkbox" name="approved" id="approved" value="1" {{ $user->approved || old('approved', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label ml-2" for="approved">{{ trans('cruds.user.fields.approved') }}</label>
                </div>
                @if($errors->has('approved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.approved_helper') }}</span>
            </div>


            {{-- <div class="form-group">
                <label for="passport_issue_date">{{ trans('cruds.user.fields.passport_issue_date') }}</label>
                <input class="form-control date {{ $errors->has('passport_issue_date') ? 'is-invalid' : '' }}" type="text" name="passport_issue_date" id="passport_issue_date" value="{{ old('passport_issue_date', $user->passport_issue_date) }}">
                @if($errors->has('passport_issue_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('passport_issue_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.passport_issue_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="passport_expiry_date">{{ trans('cruds.user.fields.passport_expiry_date') }}</label>
                <input class="form-control date {{ $errors->has('passport_expiry_date') ? 'is-invalid' : '' }}" type="text" name="passport_expiry_date" id="passport_expiry_date" value="{{ old('passport_expiry_date', $user->passport_expiry_date) }}">
                @if($errors->has('passport_expiry_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('passport_expiry_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.passport_expiry_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country">{{ trans('cruds.user.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', $user->country) }}">
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nationality">{{ trans('cruds.user.fields.nationality') }}</label>
                <input class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" type="text" name="nationality" id="nationality" value="{{ old('nationality', $user->nationality) }}">
                @if($errors->has('nationality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nationality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.nationality_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
