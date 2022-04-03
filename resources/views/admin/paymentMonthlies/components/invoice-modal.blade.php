<div aria-hidden="true" aria-labelledby="invoiceDetails" class="modal fade" id="invoiceDetailsModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceDetails">
                    Invoice Settings Details
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('admin.transaction.store', [$order->id]) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        {{-- <div class="form-group col-md-4">
                            <label for="transaction_date" class="col-form-label">Transaction Date:</label>
                            <input class="form-control date {{ $errors->has('transaction_date') ? 'is-invalid' : '' }}" type="text" name="transaction_date" id="transaction_date" value="{{ old('transaction_date') }}">
                            @if($errors->has('transaction_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transaction_date') }}
                                </div>
                            @endif
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label for="amount" class="col-form-label">Paid Amount:</label>
                            <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01">
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status" class="col-form-label">Status:</label>
                            <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Transaction::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', 'Unpaid') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                @lang('global.close')
                            </button>
                            <button type="submit" class="btn btn-primary">
                                @lang('global.save')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
