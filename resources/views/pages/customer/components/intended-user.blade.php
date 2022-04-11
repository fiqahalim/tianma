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
                <div class="form-group col-md-4">
                    <label for="cperson_name">
                        Name
                    </label>
                    <input class="form-control {{ $errors->has('cperson_name') ? 'is-invalid' : '' }}" type="text" name="moreFields[0][cperson_name]" id="cperson_name" value="{{ old('cperson_name', '') }}">
                    @if($errors->has('cperson_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cperson_name') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.customer.fields.contact_person_name_helper') }}</span>
                </div>

                <div class="form-group col-md-3">
                    <label for="cid_number">{{ trans('cruds.customer.fields.id_number') }}</label>
                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="{{ trans('cruds.customer.fields.id_number_helper') }}">
                    </i>
                    <input class="form-control {{ $errors->has('cid_number') ? 'is-invalid' : '' }}" type="text" name="cid_number" id="cid_number" value="{{ old('cid_number', '') }}">
                    @if($errors->has('cid_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cid_number') }}
                    </div>
                    @endif
                </div>

                <div class="form-group col-md-3">
                    <label for="relationships">
                        Relationships
                    </label>
                    <input class="form-control {{ $errors->has('relationships') ? 'is-invalid' : '' }}" type="text" name="relationships" id="relationships" value="{{ old('relationships', '') }}">
                    @if($errors->has('relationships'))
                        <div class="invalid-feedback">
                            {{ $errors->first('relationships') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-2 mt-4">
                    <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">
                        Add More
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
