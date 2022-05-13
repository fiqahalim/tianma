<div class="card" id="card2">
    <div class="card-header" id="headingTwo" data-target="#collapseTwo" data-toggle="collapse">
        <h2 class="mb-0">
            <button aria-controls="collapseTwo" aria-expanded="false" class="btn collapsed" data-target="#collapseTwo" data-toggle="collapse" type="button">
                <strong>PARTICULARS OF EMERGENCY CONTACT</strong>
            </button>
            <i class="fas fa-chevron-down fa-xs float-right mt-2"></i>
        </h2>
    </div>
    <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionExample" id="collapseTwo">
        <div class="card-body">
            <div class="form-row">
                <table class="table table-bordered" id="dynamicAddRemove">
                    <tr>
                        <th>Name</th>
                        <th>{{ trans('cruds.customer.fields.id_number') }}</th>
                        <th>Relationships</th>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-control {{ $errors->has('cperson_name') ? 'is-invalid' : '' }}" type="text" name="addMoreInputFields[0][cperson_name]" id="cperson_name" value="{{ old('cperson_name', '') }}">
                            @if($errors->has('cperson_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('cperson_name') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.customer.fields.contact_person_name_helper') }}</span>
                        </td>
                        <td>
                            <input class="form-control {{ $errors->has('cid_number') ? 'is-invalid' : '' }}" type="text" name="addMoreInputFields[0][cid_number]" id="cid_number" value="{{ old('cid_number', '') }}">
                            @if($errors->has('cid_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('cid_number') }}
                            </div>
                            @endif
                        </td>
                        <td>
                            <input class="form-control {{ $errors->has('relationships') ? 'is-invalid' : '' }}" type="text" name="addMoreInputFields[0][relationships]" id="relationships" value="{{ old('relationships', '') }}">
                            @if($errors->has('relationships'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('relationships') }}
                                </div>
                            @endif
                        </td>
                        <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add More</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
