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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('admin.new-order.index') }}" id="locationForm">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="location_name" class="form-label">
                                    <strong>Please select location:</strong>
                                </label>
                                @if(isset($locations))
                                    <select class="form-control {{ $errors->has('location_name') ? 'is-invalid' : '' }}" id="location_name" name="location_name" required>
                                        @forelse($locations as $key => $location)
                                            <option value="{{ $key }}" {{ old('location_name', '') === (string) $key ? 'selected' : '' }}>
                                                {{ $location }}
                                            </option>
                                        @empty
                                            <option>No location founds</option>
                                        @endforelse
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="property_name" class="form-label">
                                    <strong>Please select product type:</strong>
                                </label>
                                @if(isset($properties))
                                    <select class="form-control {{ $errors->has('property_name') ? 'is-invalid' : '' }}" id="property_name" name="property_name" onchange="displayDivDemo('building_name', this)" required>
                                        @forelse($properties as $keys => $property)
                                            <option value="{{ $keys }}" {{ old('property_name', '') === (string) $keys ? 'selected' : '' }}>
                                                {{ $property }}
                                            </option>
                                        @empty
                                            <option>No product type founds</option>
                                        @endforelse
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="form-row" id="building_name">
                            <div class="form-group col-md-12">
                                <label for="building_name" class="form-label">
                                    <strong>Please select building type:</strong>
                                </label>
                                <select class="form-control {{ $errors->has('building_name') ? 'is-invalid' : '' }}" name="building_name">
                                    @forelse($buildings as $k => $building)
                                        <option value="{{ $k }}" {{ old('building_name', '') === (string) $k ? 'selected' : '' }}>
                                            {{ $building }}
                                        </option>
                                    @empty
                                        <option>No product type founds</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary float-right mb-3 mr-3" type="submit" id="proceed">
                        {{ trans('global.proceed') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
   #building_name {
      display: none;
   }
</style>
@endsection

@section('scripts')
@parent
<script>
   function displayDivDemo(id, elementValue) {
      document.getElementById(id).style.display = elementValue.value == 2 ? 'block' : 'none';
   }
</script>
@endsection
