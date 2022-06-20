<h5 class="my-3 mt-4">PURCHASER INFORMATION</h5>
<div class="form-row">
    <div class="form-group col-md-3">
        <label for="full_name">{{ trans('cruds.customer.fields.full_name') }} as in NRIC/Passport</label>
        <input class="form-control" id="full_name" type="name" value="{{ old('full_name', $customer->full_name) }}" readonly>
    </div>
    <div class="form-group col-md-2">
        <label for="id_number">{{ trans('cruds.customer.fields.id_number') }}</label>
        <input class="form-control" id="id_number" type="text" value="{{ old('id_number', $customer->id_number ) }}" readonly>
    </div>
    <div class="form-group col-md-2">
        <label for="gender">Gender</label>
        <input class="form-control" id="gender" type="text" value="{{ old('gender', $customer->gender) }}" readonly>
    </div>
    <div class="form-group col-md-2">
        <label for="contact_person_no">Mobile</label>
        <input class="form-control" id="contact_person_no" type="text" value="{{ old('contact_person_no', $customer->contact_person_no) }}" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="email">Email</label>
        <input class="form-control" id="email" type="text" value="{{ old('email', $customer->email) }}" readonly>
    </div>
</div>
@if(isset($cust_details))
<div class="form-row row-cols-2">
    <div class="col">
        <label><strong>Permanent Address</strong></label>
        <textarea class="form-control bg-white" readonly>{{Str::upper($cust_details['per_address']) ?? 'Not Available'}}</textarea>
    </div>
    <div class="col">
        <label><strong>Correspondence Address</strong></label>
        <textarea class="form-control bg-white" readonly>{{Str::upper($cust_details['cor_address']) ?? 'Not Available'}}</textarea>
    </div>
</div>
@endif
<hr>
