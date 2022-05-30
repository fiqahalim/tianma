<div aria-hidden="true" aria-labelledby="paymentOption" class="modal fade" id="paymentOptionModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100">Choose Payment Method</h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>

            <div class="modal-body">
                <p class="text-center" style="font-size:14pt;">Select payment method for Upfront/Deposit Payment</p>
                <div class="col-md-12">
                    <a href="{{ route('admin.installment.index') }}" class="btn btn-outline-primary btn-lg btn-block">Pay Now</a>
                </div>
                <div class="col-md-12 mt-3 mb-3">
                    <a href="{{ route('admin.order.payLater') }}" class="btn btn-outline-warning btn-lg btn-block">Pay Later</a>
                </div>
            </div>
        </div>
    </div>
</div>
