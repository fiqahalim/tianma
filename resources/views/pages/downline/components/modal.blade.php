<div aria-hidden="true" aria-labelledby="exampleModalCenterTitle" class="modal fade" id="exampleModalCenter" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    User Details
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <img class="rounded-circle" src="{{ asset('/storage/images/'.Auth::user()->avatar) ?? 'https://bootdey.com/img/Content/avatar/avatar7.png' }}" width="80"> {{ $user->name ?? '' }}
                    <hr>
                        <h5>
                            Tooltips in a modal
                        </h5>
                        <div class="row">
                            <div class="row">
                                <div class="col-4 col-sm-4">
                                    Level 2: .col-8 .col-sm-6
                                </div>
                                <div class="col-4 col-sm-4">
                                    Level 2: .col-4 .col-sm-6
                                </div>
                                <div class="col-4 col-sm-4">
                                    Level 2: .col-4 .col-sm-6
                                </div>
                            </div>
                        </div>
                    </hr>
                </img>
            </div>
        </div>
    </div>
</div>