@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.documentManagement.title') }}</li>
        <li class="breadcrumb-item">{{ trans('cruds.myDocument.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">Create {{ trans('cruds.myDocument.title') }}</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.create') }} {{ trans('cruds.myDocument.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("user.my-documents.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="document_name">{{ trans('cruds.myDocument.fields.document_name') }}</label>
                <input class="form-control {{ $errors->has('document_name') ? 'is-invalid' : '' }}" type="text" name="document_name" id="document_name" value="{{ old('document_name', '') }}">
                @if($errors->has('document_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.myDocument.fields.document_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.myDocument.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.myDocument.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="document_file">{{ trans('cruds.myDocument.fields.document_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('document_file') ? 'is-invalid' : '' }}" id="document_file-dropzone">
                </div>
                @if($errors->has('document_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.myDocument.fields.document_file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agents_id">{{ trans('cruds.myDocument.fields.agents') }}</label>
                <select class="form-control select2 {{ $errors->has('agents') ? 'is-invalid' : '' }}" name="agents_id" id="agents_id">
                    @foreach($agents as $id => $entry)
                        <option value="{{ $id }}" {{ old('agents_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('agents'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agents') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.myDocument.fields.agents_helper') }}</span>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('user.my-documents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var uploadedDocumentFileMap = {}
Dropzone.options.documentFileDropzone = {
    url: '{{ route('user.my-documents.storeMedia') }}',
    maxFilesize: 15, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 15
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="document_file[]" value="' + response.name + '">')
      uploadedDocumentFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentFileMap[file.name]
      }
      $('form').find('input[name="document_file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($myDocument) && $myDocument->document_file)
          var files =
            {!! json_encode($myDocument->document_file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="document_file[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
