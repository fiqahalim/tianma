<div aria-hidden="true" aria-labelledby="paymentOption" class="modal fade" id="paymentOptionModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        @if(isset($order->commissions) && !empty($order->commissions->point_value))
                            <div class="form-group col-md-3">
                                <label for="amount" class="col-form-label">Paid Amount:</label>
                                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01">
                                @if($errors->has('amount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('amount') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                <label for="status" class="col-form-label">Status:</label>
                                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Models\Transaction::STATUS_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('status', 'Unpaid') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="point_value" class="col-form-label">Point Value</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" name="point_value" id="point_value" value="{{ old('point_value', isset($order->commissions) ? $order->commissions->point_value : '')}}" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i>PV</i>
                                        </span>
                                    </div>
                                    @if($errors->has('point_value'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('point_value') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="installment_year" class="col-form-label">Monthly Installment</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" name="installment_year" id="installment_year" value="{{ old('installment_year', $order->installments->installment_year) }}" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i>months</i>
                                        </span>
                                    </div>
                                    @if($errors->has('installment_year'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('installment_year') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.order.fields.amount_helper') }}</span>
                                </div>
                            </div>
                        @else
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
                        @endif
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
