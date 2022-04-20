<h5 class="my-3 mt-4">RESERVATION INFORMATION</h5>
<div class="form-row">
    <div class="form-group col-md-3">
        <label for="product_name">Location</label>
        <input class="form-control" id="product_name" type="text" value="{{ $order->bookLocations[0]->location }}" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="product_code">Product Type</label>
        <input class="form-control" id="product_code" type="text" value="{{ $order->bookLocations[0]->product_type }}" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="product_code">Building Type</label>
        <input class="form-control" id="product_code" type="text" value="{{ $order->bookLocations[0]->build_type }}" readonly>
    </div>
    <div class="form-group col-md-3">
        <label for="product_code">Level</label>
        <input class="form-control" id="product_code" type="text" value="{{ $order->bookLocations[0]->level }}" readonly>
    </div>
</div>
<hr>
