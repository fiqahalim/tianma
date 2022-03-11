@extends('layouts.admin')

@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">{{ trans('cruds.order.title') }}</li>
      <li class="breadcrumb-item">{{ trans('cruds.order.fields.createOrder') }}</li>
      <li class="breadcrumb-item active" aria-current="page">Location</li>
    </ol>
  </nav>

  <div class="container-fluid">
    <form>
      <div class="form-row">
        <div class="form-group">
          <label for="exampleDataList" class="form-label">Datalist example</label>
          <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
          <datalist id="datalistOptions">
            <option value="San Francisco">
            <option value="New York">
            <option value="Seattle">
            <option value="Los Angeles">
            <option value="Chicago">
          </datalist>
        </div>
      </div>
    </form>
  </div>
@endsection
