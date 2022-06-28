<div class="row">
    <div class="col">
        <h5 class="my-3">PAYMENT INFORMATION</h5>
    </div>
    <div class="col">
        <h5 class="my-3">CERTIFICATE COLLECTION INFORMATION</h5>
    </div>
    <div class="w-100"></div>
    <div class="col">
        <div class="form-row">
            @if(isset($corAddr))
            @foreach($corAddr as $items)
            @foreach($items->payments as $payment)
            <div class="form-group col-md-4">
                <label for="mode">Payment Mode Type</label>
                <input class="form-control" id="mode" type="text" value="{{ old('payment_name', $payment->payment_name['0']) }}" readonly>
            </div>
            @endforeach
            @endforeach
            @endif
            <div class="form-group col-md-4">
                <label for="mode">{{ trans('cruds.customer.fields.mode') }}</label>
                <input class="form-control" id="mode" type="text" value="{{ old('mode', $customer->mode) }}" readonly>
            </div>
            <div class="form-group col-md-4">
                @if(isset($promo))
                @foreach($promo as $code)
                    <label for="promo">Promotion Code</label>
                    <input class="form-control" id="promo" type="text" value="{{ old('promo', isset($code->promotions->promo_code) ? $code->promotions->promo_code : '') }}" readonly>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="contact_person_name">Representative Name</label>
                <input class="form-control" id="contact_person_name" type="text" value="{{ old('contact_person_name', $customer->contact_person_name) }}" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="cperson_id_number">NRIC/Passport No.</label>
                <input class="form-control" id="cperson_id_number" type="text" value="{{ old('cperson_id_number', $customer->cperson_id_number) }}" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="mode">Contact No.</label>
                <input class="form-control" id="mode" type="text" value="{{ old('mode', $customer->contact_person_no) }}" readonly>
            </div>
        </div>
    </div>
</div>
