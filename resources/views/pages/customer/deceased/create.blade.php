@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.customer.title') }} Management</li>
        <li class="breadcrumb-item">All Deceased Person</li>
        <li class="breadcrumb-item active" aria-current="page">Create Deceased Person</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.create') }} Deceased Person Information
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("user.decease-people.store") }}" enctype="multipart/form-data">
            @csrf

            {{-- Deceased Info --}}
            <h5 class="mb-4">Deceased Information</h5>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="required" for="decease_name">Deceased Name</label>
                    <input class="form-control {{ $errors->has('decease_name') ? 'is-invalid' : '' }}" type="text" name="decease_name" id="decease_name" value="{{ old('decease_name', '') }}" required>
                    @if($errors->has('decease_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('decease_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.full_name_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="decease_id_number">Deceased {{ trans('cruds.customer.fields.id_number') }}</label>
                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="{{ trans('cruds.customer.fields.id_number_helper') }}"></i>
                    <input class="form-control {{ $errors->has('decease_id_number') ? 'is-invalid' : '' }}" type="text" name="decease_id_number" id="decease_id_number" value="{{ old('decease_id_number', '') }}" required>
                    @if($errors->has('decease_id_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('decease_id_number') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-2">
                    <label>Deceased Gender</label>
                    <select class="form-control {{ $errors->has('decease_gender') ? 'is-invalid' : '' }}" name="decease_gender" id="decease_gender">
                        <option value disabled {{ old('decease_gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Decease::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('decease_gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('decease_gender'))
                        <div class="invalid-feedback">
                            {{ $errors->first('decease_gender') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.id_type_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="birth_date">Born Date</label>
                    <input class="form-control date {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}">
                    @if($errors->has('birth_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('birth_date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.birth_date_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="full_name">Deceased Religion</label>
                    <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}">
                    @if($errors->has('full_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('full_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.full_name_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="decease_maritial">Deceased Marital Status</label>
                    <select class="form-control {{ $errors->has('decease_maritial') ? 'is-invalid' : '' }}" name="decease_maritial" id="decease_maritial">
                        <option value disabled {{ old('decease_maritial', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Decease::MARITAL_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('decease_maritial', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('decease_gender'))
                        <div class="invalid-feedback">
                            {{ $errors->first('decease_gender') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.id_type_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="decease_dialect">Deceased Dialect</label>
                    <input class="form-control {{ $errors->has('decease_dialect') ? 'is-invalid' : '' }}" type="text" name="decease_dialect" id="decease_dialect" value="{{ old('decease_dialect', '') }}">
                    @if($errors->has('decease_dialect'))
                        <div class="invalid-feedback">
                            {{ $errors->first('decease_dialect') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.full_name_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label class="required" for="decease_national">Deceased National</label>
                    <input class="form-control {{ $errors->has('decease_national') ? 'is-invalid' : '' }}" type="text" name="decease_national" id="decease_national" value="{{ old('decease_national', '') }}">
                    @if($errors->has('decease_national'))
                        <div class="invalid-feedback">
                            {{ $errors->first('decease_national') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.full_name_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="decease_income">Deceased Income</label>
                    <input class="form-control {{ $errors->has('decease_income') ? 'is-invalid' : '' }}" type="text" name="decease_income" id="decease_income" value="{{ old('decease_income', '') }}">
                    @if($errors->has('decease_income'))
                        <div class="invalid-feedback">
                            {{ $errors->first('decease_income') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.full_name_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="decease_occupation">Deceased Occupation</label>
                    <input class="form-control {{ $errors->has('decease_occupation') ? 'is-invalid' : '' }}" type="text" name="decease_occupation" id="decease_occupation" value="{{ old('decease_occupation', '') }}">
                    @if($errors->has('decease_occupation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('decease_occupation') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.full_name_helper') }}</span>
                </div>
            </div>
            <hr>

            {{-- certificate info --}}
            <h5 class="mb-4">Cremation Information</h5>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="ref_no">Ref No</label>
                    <input class="form-control {{ $errors->has('ref_no') ? 'is-invalid' : '' }}" type="text" name="ref_no" id="ref_no" value="{{ old('ref_no') }}">
                    @if($errors->has('ref_no'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ref_no') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.email_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="bury_cert">Bury Cert</label>
                    <input class="form-control {{ $errors->has('bury_cert') ? 'is-invalid' : '' }}" type="text" name="bury_cert" id="bury_cert" value="{{ old('bury_cert', '') }}">
                    @if($errors->has('bury_cert'))
                        <div class="invalid-feedback">
                            {{ $errors->first('bury_cert') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.contact_person_no_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="cremation_cert">Cremation Cert</label>
                    <input class="form-control {{ $errors->has('cremation_cert') ? 'is-invalid' : '' }}" type="text" name="cremation_cert" id="cremation_cert" value="{{ old('cremation_cert', '') }}">
                    @if($errors->has('cremation_cert'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cremation_cert') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.contact_person_name_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="casket">Casket</label>
                    <input class="form-control {{ $errors->has('casket') ? 'is-invalid' : '' }}" type="text" name="casket" id="casket" value="{{ old('casket') }}">
                    @if($errors->has('casket'))
                        <div class="invalid-feedback">
                            {{ $errors->first('casket') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.email_helper') }}</span>
                </div>
            </div>
            {{-- Bury details --}}
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="undertaker">Undertaker</label>
                    <input class="form-control {{ $errors->has('undertaker') ? 'is-invalid' : '' }}" type="text" name="undertaker" id="undertaker" value="{{ old('undertaker') }}">
                    @if($errors->has('undertaker'))
                        <div class="invalid-feedback">
                            {{ $errors->first('undertaker') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.email_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="open_niche">Open Niche</label>
                    <input class="form-control {{ $errors->has('open_niche') ? 'is-invalid' : '' }}" type="text" name="open_niche" id="open_niche" value="{{ old('open_niche') }}">
                    @if($errors->has('open_niche'))
                        <div class="invalid-feedback">
                            {{ $errors->first('open_niche') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.email_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="miling_flag">Mailing Flag</label>
                    <select class="form-control {{ $errors->has('miling_flag') ? 'is-invalid' : '' }}" name="miling_flag" id="miling_flag">
                        <option value disabled {{ old('miling_flag', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Decease::MAILING_FLAG as $key => $label)
                            <option value="{{ $key }}" {{ old('miling_flag', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('decease_gender'))
                        <div class="invalid-feedback">
                            {{ $errors->first('decease_gender') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.id_type_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="death_date">Death Date</label>
                    <input class="form-control datetime {{ $errors->has('death_date') ? 'is-invalid' : '' }}" name="death_date" id="death_date" value="{{ old('death_date') }}">
                    @if($errors->has('death_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('death_date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.birth_date_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="grain_date">Grain Date</label>
                    <input class="form-control datetime {{ $errors->has('grain_date') ? 'is-invalid' : '' }}" name="grain_date" id="grain_date" value="{{ old('grain_date', '') }}">
                    @if($errors->has('grain_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('grain_date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_1_helper') }}</span>
                </div>
                <div class="form-group col-md-2">
                    <label for="bury_date">Bury Date</label>
                    <input class="form-control datetime {{ $errors->has('bury_date') ? 'is-invalid' : '' }}" name="bury_date" id="bury_date" value="{{ old('bury_date', '') }}">
                    @if($errors->has('bury_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('bury_date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_1_helper') }}</span>
                </div>
            </div>
            <hr>

            {{-- Issue Address --}}
            <h5 class="mb-4">Issued Address</h5>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="issue_address_1">{{ trans('cruds.customer.fields.address_1') }}</label>
                    <input class="form-control {{ $errors->has('issue_address_1') ? 'is-invalid' : '' }}" type="text" name="issue_address_1" id="issue_address_1" value="{{ old('issue_address_1', '') }}">
                    @if($errors->has('issue_address_1'))
                        <div class="invalid-feedback">
                            {{ $errors->first('issue_address_1') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_1_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="issue_address_2">{{ trans('cruds.customer.fields.address_2') }}</label>
                    <input class="form-control {{ $errors->has('issue_address_2') ? 'is-invalid' : '' }}" type="text" name="issue_address_2" id="issue_address_2" value="{{ old('issue_address_2', '') }}">
                    @if($errors->has('issue_address_2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('issue_address_2') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_2_helper') }}</span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="issue_postcode">{{ trans('cruds.customer.fields.postcode') }}</label>
                    <input class="form-control {{ $errors->has('issue_postcode') ? 'is-invalid' : '' }}" type="number" name="issue_postcode" id="issue_postcode" value="{{ old('issue_postcode', '') }}" step="1">
                    @if($errors->has('issue_postcode'))
                        <div class="invalid-feedback">
                            {{ $errors->first('issue_postcode') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.postcode_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="issue_state">{{ trans('cruds.customer.fields.state') }}</label>
                    <input class="form-control {{ $errors->has('issue_state') ? 'is-invalid' : '' }}" type="text" name="issue_state" id="issue_state" value="{{ old('issue_state', '') }}">
                    @if($errors->has('issue_state'))
                        <div class="invalid-feedback">
                            {{ $errors->first('issue_state') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.state_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="issue_city">{{ trans('cruds.customer.fields.city') }}</label>
                    <input class="form-control {{ $errors->has('issue_city') ? 'is-invalid' : '' }}" type="text" name="issue_city" id="issue_city" value="{{ old('issue_city', '') }}">
                    @if($errors->has('issue_city'))
                        <div class="invalid-feedback">
                            {{ $errors->first('issue_city') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.city_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="issue_country">{{ trans('cruds.customer.fields.country') }}</label>
                    <input class="form-control {{ $errors->has('issue_country') ? 'is-invalid' : '' }}" type="text" name="issue_country" id="issue_country" value="{{ old('issue_country', '') }}">
                    @if($errors->has('issue_country'))
                        <div class="invalid-feedback">
                            {{ $errors->first('issue_country') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.country_helper') }}</span>
                </div>
            </div>
            <hr>

            {{-- Funeral Address --}}
            <h5 class="mb-4">Funeral Address</h5>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="funeral_address_1">{{ trans('cruds.customer.fields.address_1') }}</label>
                    <input class="form-control {{ $errors->has('funeral_address_1') ? 'is-invalid' : '' }}" type="text" name="funeral_address_1" id="funeral_address_1" value="{{ old('funeral_address_1', '') }}">
                    @if($errors->has('funeral_address_1'))
                        <div class="invalid-feedback">
                            {{ $errors->first('funeral_address_1') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_1_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="funeral_address_2">{{ trans('cruds.customer.fields.address_2') }}</label>
                    <input class="form-control {{ $errors->has('funeral_address_2') ? 'is-invalid' : '' }}" type="text" name="funeral_address_2" id="funeral_address_2" value="{{ old('funeral_address_2', '') }}">
                    @if($errors->has('funeral_address_2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('funeral_address_2') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_2_helper') }}</span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="funeral_postcode">{{ trans('cruds.customer.fields.postcode') }}</label>
                    <input class="form-control {{ $errors->has('funeral_postcode') ? 'is-invalid' : '' }}" type="number" name="funeral_postcode" id="funeral_postcode" value="{{ old('funeral_postcode', '') }}" step="1">
                    @if($errors->has('funeral_postcode'))
                        <div class="invalid-feedback">
                            {{ $errors->first('funeral_postcode') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.postcode_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="funeral_state">{{ trans('cruds.customer.fields.state') }}</label>
                    <input class="form-control {{ $errors->has('funeral_state') ? 'is-invalid' : '' }}" type="text" name="funeral_state" id="funeral_state" value="{{ old('funeral_state', '') }}">
                    @if($errors->has('funeral_state'))
                        <div class="invalid-feedback">
                            {{ $errors->first('funeral_state') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.state_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="funeral_city">{{ trans('cruds.customer.fields.city') }}</label>
                    <input class="form-control {{ $errors->has('funeral_city') ? 'is-invalid' : '' }}" type="text" name="funeral_city" id="funeral_city" value="{{ old('funeral_city', '') }}">
                    @if($errors->has('funeral_city'))
                        <div class="invalid-feedback">
                            {{ $errors->first('funeral_city') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.city_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="funeral_country">{{ trans('cruds.customer.fields.country') }}</label>
                    <input class="form-control {{ $errors->has('funeral_country') ? 'is-invalid' : '' }}" type="text" name="funeral_country" id="funeral_country" value="{{ old('funeral_country', '') }}">
                    @if($errors->has('funeral_country'))
                        <div class="invalid-feedback">
                            {{ $errors->first('funeral_country') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.country_helper') }}</span>
                </div>
            </div>
            <hr>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="remark">Remarks</label>
                    <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark') }}</textarea>
                    @if($errors->has('remark'))
                        <div class="invalid-feedback">
                            {{ $errors->first('remark') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_1_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="item_elements">Item Elements</label>
                    <select class="form-control select2 {{ $errors->has('item_elements') ? 'is-invalid' : '' }}" name="item_elements" id="item_elements">
                        @foreach($addOns as $id => $data)
                            <option value="{{ $id }}" {{ old('item_elements') == $id ? 'selected' : '' }}>{{ $data }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('item_elements'))
                        <div class="invalid-feedback">
                            {{ $errors->first('item_elements') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.address_2_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required">Lot ID Number</label>
                    <select class="form-control select2 {{ $errors->has('parent') ? 'is-invalid' : '' }}" name="lot_id" id="lot_id">
                        @foreach($lotIDs as $id => $data)
                        @php
                            $lot = json_encode($data->lotID->seats, true);
                            $items = str_replace('"','', $lot);
                            $createdBy = $data->createdBy->agent_code;
                        @endphp
                            <option value="{{ $id }}" {{ old('lot_id') == $id ? 'selected' : '' }}>{{ $items }} - {{ $createdBy }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="required" for="document_file">{{ trans('cruds.myDocument.fields.document_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('document_file') ? 'is-invalid' : '' }}" id="document_file-dropzone">
                </div>
                @if($errors->has('document_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.myDocument.fields.document_file_helper') }}</span>
            </div>

            {{-- save --}}
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('user.decease-people.index') }}">
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
    var uploadedDocumentFileMap = {}
    Dropzone.options.documentFileDropzone = {
        url: '{{ route('user.decease-people.storeMedia') }}',
        maxFilesize: 15, // MB
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 15
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="document_file[]" value="' + response.name + '">')
            uploadedDocumentFileMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentFileMap[file.name]
            }
            $('form').find('input[name="document_file[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($decease) && $decease->document_file)
                var files = {!! json_encode($decease->document_file) !!}
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="document_file[]" value="' + file.file_name + '">')
                }
            @endif
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')_ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }
            return _results
        }
    }
</script>
@endsection
