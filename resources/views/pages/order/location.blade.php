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
                <form method="POST" action="{{ route('user.my-orders.store') }}" id="locationForm" enctype="multipart/form-data">
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
                                            <option value="{{ $location }}" {{ old('location_name', '') === (string) $location ? 'selected' : '' }}>
                                                {{ $location }}
                                            </option>
                                        @empty
                                            <option>No location founds</option>
                                        @endforelse
                                    </select>
                                @endif
                            </div>
                        </div>

                        {{-- Product Type --}}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="property_name" class="form-label">
                                    <strong>Please select product type:</strong>
                                </label>
                                @if(isset($properties))
                                    <select class="form-control {{ $errors->has('property_name') ? 'is-invalid' : '' }}" id="property_name" name="property_name" onchange="displayDivDemo('building_name', this)" required>
                                        @forelse($properties as $keys => $property)
                                            <option value="{{ $property }}" {{ old('property_name', '') === (string) $property ? 'selected' : '' }}>
                                                {{ $property }}
                                            </option>
                                        @empty
                                            <option>No product type founds</option>
                                        @endforelse
                                    </select>
                                @endif
                            </div>
                        </div>

                        {{-- Building and Level --}}
                        <div class="form-row" id="building_name">
                            <div class="form-group col-md-12">
                                <label for="building_name" class="form-label">
                                    <strong>Please select building type:</strong>
                                </label>
                                <select class="form-control {{ $errors->has('building_name') ? 'is-invalid' : '' }}" name="building_name">
                                    @forelse($buildings as $k => $building)
                                        <option value="{{ $building }}" {{ old('building_name', '') === (string) $building ? 'selected' : '' }}>
                                            {{ $building }}
                                        </option>
                                    @empty
                                        <option>No building type founds</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="level_name" class="form-label">
                                    <strong>Please select level:</strong>
                                </label>
                                <select class="form-control {{ $errors->has('level_name') ? 'is-invalid' : '' }}" name="level_name">
                                    @forelse($levels as $l => $level)
                                        <option value="{{ $level }}" {{ old('level_name', '') === (string) $level ? 'selected' : '' }}>
                                            {{ $level }}
                                        </option>
                                    @empty
                                        <option>No levels founds</option>
                                    @endforelse
                                </select>
                            </div>
                            {{-- Categories --}}
                            <div class="form-group col-md-12">
                                <label for="category" class="form-label">
                                    <strong>Please select category:</strong>
                                </label>
                                @if(isset($category))
                                    <select class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" required>
                                        @forelse($category as $keys => $cate)
                                            <option value="{{ $cate }}" {{ old('name', '') === (string) $cate ? 'selected' : '' }}>
                                                {{ $cate }}
                                            </option>
                                        @empty
                                            <option>No category founds</option>
                                        @endforelse
                                    </select>
                                @endif
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
   #building_name, #level_name {
      display: none;
   }
</style>
@endsection

@section('scripts')
@parent
<script>
    function displayDivDemo(id, elementValue) {
        document.getElementById(id).style.display = elementValue.value === 'Niche' ? 'block' : 'none';
    }
</script>
@endsection
