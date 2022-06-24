<div class="card" id="card4">
    <div class="card-header" id="headingFour" data-target="#collapseFour" data-toggle="collapse">
        <h2 class="mb-0">
            <button aria-controls="collapseFour" aria-expanded="false" class="btn collapsed" data-target="#collapseFour" data-toggle="collapse" type="button">
                <strong>MODE OF CERTIFICATE COLLECTION</strong>
            </button>
            <i class="fas fa-chevron-down fa-xs float-right mt-2"></i>
        </h2>
    </div>
    <div aria-labelledby="headingFour" class="collapse" data-parent="#accordionExample" id="collapseFour">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <div class="form-check">
                        <label class="form-check-label" for="representative">
                            Authorized Representative
                        </label>
                        <input class="form-check-input ml-3" type="checkbox" value="representative" id="representative">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="form-check">
                        <label class="form-check-label" for="purchaser">
                            Purchaser
                        </label>
                        <input class="form-check-input ml-3" type="checkbox" value="purchaser" id="purchaser" onclick="getPurchaser()">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="form-check">
                        <label class="form-check-label" for="Mail">
                            Mail
                        </label>
                        <input class="form-check-input ml-3" type="checkbox" value="mail" id="mail">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="contact_person_name">
                        Representative Name
                    </label>
                    <input class="form-control {{ $errors->has('contact_person_name') ? 'is-invalid' : '' }}" type="text" name="contact_person_name" id="contact_person_name" value="{{ old('contact_person_name', '') }}">
                    @if($errors->has('contact_person_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contact_person_name') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="cperson_id_number">
                        NRIC No.
                    </label>
                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="{{ trans('cruds.customer.fields.id_number_helper') }}">
                    </i>
                    <input class="form-control {{ $errors->has('cperson_id_number') ? 'is-invalid' : '' }}" type="text" name="cperson_id_number" id="cperson_id_number" value="{{ old('cperson_id_number', '') }}" >
                    @if($errors->has('cperson_id_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cperson_id_number') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label for="contact_person_no">
                        Contact No.
                    </label>
                    <input class="form-control {{ $errors->has('contact_person_no') ? 'is-invalid' : '' }}" type="text" name="contact_person_no" id="contact_person_no" value="{{ old('contact_person_no', '') }}">
                    @if($errors->has('contact_person_no'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contact_person_no') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
