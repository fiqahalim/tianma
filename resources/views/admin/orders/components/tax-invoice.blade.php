<div class="page-content container" style="background: white;">
    <div class="row">
        <div class="col-4 text-center">
            <figure class="figure">
                <img src="{{ '/images/tianma_logo_op-01a.png' }}" class="figure-img img-fluid rounded mt-2" style="height: 125px; width: 13rem;">
            </figure>
        </div>
        <div class="col-8 mt-4">
            <p style="font-size: 12pt; font-family: Arial, Helvetica, sans-serif;">
                <strong>TIANMA MEMORIAL HOLDINGS BERHAD</strong>
                <small><b>202101043182 (1443482 A)</b></small><br>
                Corporate Tower, Level 5, Jalan Pahat L 15/L, Section 15,<br>
                40200 Shah Alam , Selangor<br>
                Tel : 010-951 3688 &nbsp;&nbsp; Website : www.tianma.my
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col-6 text-center">
            <h4><strong><u>TAX INVOICE</u></strong></h4>
        </div>
        <div class="col"></div>
    </div>

    <div class="container">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-8">
                        <div class="text-dark">
                            <div class="my-1">
                                <p style="font-size: 12pt; font-family: Arial, Helvetica, sans-serif;">
                                    {{ Str::upper($order->customer->full_name) }} <br>
                                    {{ $order->customer->id_number }} <br>
                                    {{ Str::upper($order->customer->address_1) }} <br>
                                    @if(isset($order->customer->address_2) && !empty($order->customer->address_2))
                                        {{ Str::upper($order->customer->address_2) }} <br>
                                    @endif
                                    {{ Str::upper($order->customer->postcode) }}
                                    {{ Str::upper($order->customer->city) }}
                                    {{ Str::upper($order->customer->state) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 justify-content-end">
                        <div class="text-dark">
                            <div>
                                <p style="font-size: 12pt; font-family: Arial, Helvetica, sans-serif;" class="alignMe">
                                    <b>RECEIPT NO</b><br>
                                    <b>ORDER ID</b> #{{ $order->ref_no ?? '' }} <br>
                                    <b>INVOICE NO</b> <br>
                                    <b>UNIT NUMBER</b> <br>
                                    <b>DATE</b> {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="table-responsive">
                        <table class="table table-bordered border-0 border-b-2 brc-default-l1">
                            <thead class="bg-none bgc-default-tp1">
                                <tr class="text-white">
                                    <th>Item</th>
                                    <th>Description 1</th>
                                    <th>Description 2</th>
                                    <th>Payment Mode</th>
                                    <th>Payment Ref Number</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            @php
                                $payments = isset($order->customer) ? $order->customer->payments[0] : '';
                            @endphp
                            <tbody class="text-95 text-secondary-d3">
                                <tr>
                                    <td>1</td>
                                    <td>
                                        {{ Str::upper($order->products->product_name) }}
                                    </td>
                                    <td>
                                        {{ Str::upper($order->customer->mode) }}
                                    </td>
                                    <td>
                                        {{ Str::upper($cc[0]->payment_name ?? '') }}
                                    </td>
                                    <td>
                                        Ref No
                                    </td>
                                    <td>
                                        {{ $order->installments->amount ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        RINGGIT MALAYSIA {{ Str::upper($amountFormat) }} ONLY
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">
                        <p>
                            This Official Receipt is valid upon clearance of the cheque/credit card/debit card/MPOS payment.<br>This is a system generated document. No signature is required.
                        </p>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
