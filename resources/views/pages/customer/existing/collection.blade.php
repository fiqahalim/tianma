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
                        <label class="form-check-label" for="flexCheckDefault">
                            Authorized Representative
                        </label>
                        <input class="form-check-input ml-3" type="checkbox" value="" id="flexCheckDefault">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="form-check">
                        <label class="form-check-label" for="flexCheckDefault">
                            Purchaser
                        </label>
                        <input class="form-check-input ml-3" type="checkbox" value="" id="flexCheckDefault">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <div class="form-check">
                        <label class="form-check-label" for="flexCheckDefault">
                            Mail
                        </label>
                        <input class="form-check-input ml-3" type="checkbox" value="" id="flexCheckDefault">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="required" for="cperson_name">
                        Representative Name
                    </label>
                    <input class="form-control {{ $errors->has('cperson_name') ? 'is-invalid' : '' }}" type="text" name="cperson_name" id="cperson_name" value="{{ old('cperson_name', '') }}" required>
                    @if($errors->has('cperson_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cperson_name') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label class="required" for="cid_number">
                        NRIC No.
                    </label>
                    <input class="form-control {{ $errors->has('cid_number') ? 'is-invalid' : '' }}" type="text" name="cid_number" id="cid_number" value="{{ old('cid_number', '') }}" required>
                    @if($errors->has('cid_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cid_number') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-4">
                    <label class="required" for="cperson_no">
                        Contact No.
                    </label>
                    <input class="form-control {{ $errors->has('cperson_no') ? 'is-invalid' : '' }}" type="text" name="cperson_no" id="cperson_no" value="{{ old('cperson_no', '') }}" required>
                    @if($errors->has('cperson_no'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cperson_no') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
