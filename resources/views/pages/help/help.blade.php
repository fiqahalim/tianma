@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('global.helps') }}
        </li>
    </ol>
</nav>

<div class="content">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne" data-target="#collapseOne" data-toggle="collapse">
                <h2 class="mb-0">
                    <button aria-controls="collapseOne" aria-expanded="true" class="btn btn-link" data-target="#collapseOne" data-toggle="collapse" type="button">
                        Collapsible Group Item #1
                    </button>
                </h2>
            </div>
            <div aria-labelledby="headingOne" class="collapse show" data-parent="#accordionExample" id="collapseOne">
                <div class="card-body">
                    Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo. Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo" data-target="#collapseTwo" data-toggle="collapse">
                <h2 class="mb-0">
                    <button aria-controls="collapseTwo" aria-expanded="false" class="btn btn-link collapsed" data-target="#collapseTwo" data-toggle="collapse" type="button">
                        Collapsible Group Item #2
                    </button>
                </h2>
            </div>
            <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionExample" id="collapseTwo">
                <div class="card-body">
                    Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo. Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree" data-target="#collapseThree" data-toggle="collapse">
                <h2 class="mb-0">
                    <button aria-controls="collapseThree" aria-expanded="false" class="btn btn-link collapsed" data-target="#collapseThree" data-toggle="collapse" type="button">
                        Collapsible Group Item #3
                    </button>
                </h2>
            </div>
            <div aria-labelledby="headingThree" class="collapse" data-parent="#accordionExample" id="collapseThree">
                <div class="card-body">
                    Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo. Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
@endsection
