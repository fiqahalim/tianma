<h5 class="my-3">RESERVATION INFORMATION</h5>
<div class="form-row">
    <div class="form-group col-md-3">
        <label for="product_name">Location</label>
        <input class="form-control" id="product_name" type="text" value="{{ $locations->location }}" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="product_code">Product Type</label>
        <input class="form-control" id="product_code" type="text" value="{{ $locations->product_type }}" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="product_code">Building Type</label>
        <input class="form-control" id="product_code" type="text" value="{{ $locations->build_type }}" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="product_code">Level</label>
        <input class="form-control" id="product_code" type="text" value="{{ $locations->level }}" readonly>
    </div>
</div>
<hr>
