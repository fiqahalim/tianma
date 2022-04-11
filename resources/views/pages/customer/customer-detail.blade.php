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
        <form method="POST" action="{{ route("admin.customer-details.store", [$product->categories->first()->parentCategory->name, $product->categories->first()->parentCategory->name, $product->categories->first()->name, $product]) }}" enctype="multipart/form-data">
                @csrf

            <div class="accordion" id="accordionExample">
                {{-- Purchaser Details --}}
                <div class="card" id="card1">
                    <div class="card-header" id="headingOne" data-target="#collapseOne" data-toggle="collapse">
                        <h2 class="mb-0">
                            <button aria-controls="collapseOne" aria-expanded="true" class="btn" data-target="#collapseOne" data-toggle="collapse" type="button">
                                <strong>PARTICULARS OF PURCHASER</strong>
                            </button>
                            <i class="fas fa-chevron-down fa-xs float-right mt-2"></i>
                        </h2>
                    </div>
                    <div aria-labelledby="headingOne" class="collapse show" data-parent="#accordionExample" id="collapseOne">
                        <div class="card-body">
                            @include('pages.customer.components.purchaser')
                            <hr>
                            {{-- Address Details --}}
                            @include('pages.customer.components.address')
                        </div>
                    </div>
                </div>

                {{-- Intended User Details --}}
                @include('pages.customer.components.intended-user')

                {{-- Payment Mode --}}
                @include('pages.customer.components.payment-mode')

                {{-- Certificate Collection --}}
                @include('pages.customer.components.collection')
            </div>

            <div class="form-group float-right">
                <a class="btn btn-default" href="{{ route('admin.new-order.index') }}">
                    {{ trans('global.back') }}
                </a>
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.proceed') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('/js/pages/customer-details.js') }}"></script>
<script>
    function FillAddressInput() {
        let flexCheckChecked= document.getElementById('flexCheckChecked');
        let address_1 = document.getElementById("address_1");
        let address_2 = document.getElementById("address_2");
        let nationality = document.getElementById("nationality");
        let postcode = document.getElementById("postcode");
        let city = document.getElementById("city");
        let state = document.getElementById("state");
        let country = document.getElementById("country");

        let curaddress_1 = document.getElementById("curaddress_1");
        let curaddress_2 = document.getElementById("curaddress_2");
        let curnationality = document.getElementById("curnationality");
        let curpostcode = document.getElementById("curpostcode");
        let curcity = document.getElementById("curcity");
        let curstate = document.getElementById("curstate");
        let curcountry = document.getElementById("curcountry");

        if (flexCheckChecked.checked == true) {
            let address_1Value = address_1.value;
            let address_2Value = address_2.value;
            let nationalityValue     = nationality.value;
            let postcodeValue      = postcode.value;
            let cityValue         = city.value;
            let stateValue        = state.value;
            let countryValue      = country.value;

            curaddress_1.value = address_1Value;
            curaddress_2.value = address_2Value;
            curnationality.value     = nationalityValue;
            curpostcode.value      = postcodeValue;
            curcity.value         = cityValue;
            curstate.value        = stateValue;
            curcountry.value      = countryValue;
        } else {
            curaddress_1.value = "";
            curaddress_2.value = "";
            curnationality.value     = "";
            curpostcode.value      = "";
            curcity.value         = "";
            curstate.value        = "";
            curcountry.value      = "";
        }
    }

    function getPurchaser() {
        let purchaser = document.getElementById('purchaser');
        let purchaserName = document.getElementById('full_name');
        let purchaserIDNumber = document.getElementById("id_number");
        let purchaserMobile = document.getElementById("mobile");

        let contact_person_name = document.getElementById('contact_person_name');
        let cperson_id_number = document.getElementById("cperson_id_number");
        let contact_person_no = document.getElementById("contact_person_no");

        if(purchaser.checked == true) {
            let full_nameValue = full_name.value;
            let id_numberValue = id_number.value;
            let mobileValue = mobile.value;

            contact_person_name.value = full_nameValue;
            cperson_id_number.value = id_numberValue;
            contact_person_no.value = mobileValue;
        } else {
            contact_person_name.value = "";
            cperson_id_number = "";
            contact_person_no = "";
        }
    }
</script>
<script>
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<div class="form-row"><div class="form-group col-md-4"><input type="text" name="moreFields[' + i +
            '][cperson_name]" placeholder="Intended Name" class="form-control" /></div><div><button type="button" class="btn btn-outline-danger remove-input-field">Remove</button></div></div>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('div').remove();
    });
</script>
@endsection
