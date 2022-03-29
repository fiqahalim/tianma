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
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="col-form-label">Month:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label">Status:</label>
                            <input type="text" class="form-control" id="recipient-name">
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

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Generate All Invoices</button>
            </div>
        </div>
    </div>
</div>
