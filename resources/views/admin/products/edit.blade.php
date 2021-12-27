@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.productManagement.title') }}</li>
        <li class="breadcrumb-item">{{ trans('cruds.product.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">Edit Products</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="required" for="product_name">{{ trans('cruds.product.fields.product_name') }}</label>
                    <input class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}" type="text" name="product_name" id="product_name" value="{{ old('product_name', $product->product_name) }}" required>
                    @if($errors->has('product_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('product_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.product_name_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="product_id_number">{{ trans('cruds.product.fields.product_id_number') }}</label>
                    <input class="form-control {{ $errors->has('product_id_number') ? 'is-invalid' : '' }}" type="text" name="product_id_number" id="product_id_number" value="{{ old('product_id_number', $product->product_id_number) }}">
                    @if($errors->has('product_id_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('product_id_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.product_id_number_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="product_code">{{ trans('cruds.product.fields.product_code') }}</label>
                    <span class="help-block">{{ trans('cruds.product.fields.product_code_helper') }}</span>
                    <input class="form-control {{ $errors->has('product_code') ? 'is-invalid' : '' }}" type="text" name="product_code" id="product_code" value="{{ old('product_code', $product->product_code) }}" required>
                    @if($errors->has('product_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('product_code') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" required>
                        @if($errors->has('price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="selling_price">{{ trans('cruds.product.fields.selling_price') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control {{ $errors->has('selling_price') ? 'is-invalid' : '' }}" type="number" name="selling_price" id="selling_price" value="{{ old('selling_price', $product->selling_price) }}" step="0.01" required>
                        @if($errors->has('selling_price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('selling_price') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.selling_price_helper') }}</span>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="maintenance_price">{{ trans('cruds.product.fields.maintenance_price') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control {{ $errors->has('maintenance_price') ? 'is-invalid' : '' }}" type="number" name="maintenance_price" id="maintenance_price" value="{{ old('maintenance_price', $product->maintenance_price) }}" step="0.01" required>
                        @if($errors->has('maintenance_price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('maintenance_price') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.maintenance_price_helper') }}</span>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="list_price">{{ trans('cruds.product.fields.list_price') }}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i>RM</i>
                            </span>
                        </div>
                        <input class="form-control {{ $errors->has('list_price') ? 'is-invalid' : '' }}" type="number" name="list_price" id="list_price" value="{{ old('list_price', $product->list_price) }}" step="0.01" required>
                        @if($errors->has('list_price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('list_price') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.list_price_helper') }}</span>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="required" for="point_value">{{ trans('cruds.product.fields.point_value') }}</label>
                    <input class="form-control {{ $errors->has('point_value') ? 'is-invalid' : '' }}" type="number" name="point_value" id="point_value" value="{{ old('point_value', $product->point_value) }}" step="0.01" required>
                    @if($errors->has('point_value'))
                        <div class="invalid-feedback">
                            {{ $errors->first('point_value') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.point_value_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="quantity_per_unit">{{ trans('cruds.product.fields.quantity_per_unit') }}</label>
                    <input class="form-control {{ $errors->has('quantity_per_unit') ? 'is-invalid' : '' }}" type="number" name="quantity_per_unit" id="quantity_per_unit" value="{{ old('quantity_per_unit', $product->quantity_per_unit) }}" step="1">
                    @if($errors->has('quantity_per_unit'))
                        <div class="invalid-feedback">
                            {{ $errors->first('quantity_per_unit') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.quantity_per_unit_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="total_cost">{{ trans('cruds.product.fields.total_cost') }}</label>
                    <input class="form-control {{ $errors->has('total_cost') ? 'is-invalid' : '' }}" type="number" name="total_cost" id="total_cost" value="{{ old('total_cost', $product->total_cost) }}" step="0.01" required>
                    @if($errors->has('total_cost'))
                        <div class="invalid-feedback">
                            {{ $errors->first('total_cost') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.total_cost_helper') }}</span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="categories">{{ trans('cruds.product.fields.category') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                        @foreach($categories as $id => $category)
                            <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $product->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('categories'))
                        <div class="invalid-feedback">
                            {{ $errors->first('categories') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="tags">{{ trans('cruds.product.fields.tag') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                        @foreach($tags as $id => $tag)
                            <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $product->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('tags'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tags') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.product.fields.tag_helper') }}</span>
                </div>
            </div>

            {{-- Description --}}
            <div class="form-group">
                <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $product->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="photo">{{ trans('cruds.product.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.photo_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="slug">{{ trans('cruds.product.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}" required>
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.slug_helper') }}</span>
            </div>

            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
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
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->photo)
      var file = {!! json_encode($product->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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