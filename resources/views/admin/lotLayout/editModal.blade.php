<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">
          {{ trans('global.edit') }} {{ trans('cruds.lotLayout.title_singular') }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form action="" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="layout" class="col-form-label required">
              {{ trans('cruds.lotLayout.fields.name') }}
            </label>
            <input type="text" class="form-control" placeholder="@lang('2 x 3')" name="layout" required>
            <small class="text-primary">@lang('Just type left and right value, a seperator (x) will be added automatically')</small>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
        </div>
      </form>
    </div>
  </div>
</div>
