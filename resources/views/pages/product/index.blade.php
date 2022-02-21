@extends('layouts.admin')

@section('content')
    @can('admin_only')
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ trans('cruds.order.title') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ trans('cruds.order.fields.createOrder') }}</li>
          </ol>
        </nav>
    @else
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{ trans('global.products.title') }}</li>
          </ol>
        </nav>
    @endcan
    
    <div class="container-fluid mt-5 mb-5">
        <div class="row g-2">
            <div class="col-md-3">
                <div class="list-group">
                    {{-- Display all product list menu item --}}
                    @include('pages.product.list')
                </div>
            </div>
            {{-- product list --}}
            <div class="col-md-9">
                <div class="row g-2">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <!-- Product image-->
                                <a href="{{ route('user.product', [$product->categories->first()->parentCategory->parentCategory->slug, $product->categories->first()->parentCategory->slug, $product->categories->first()->slug, $product->slug, $product]) }}">
                                    <img class="card-img-top" src="{{ $product->photo->url ?? '/images/home-urns.png' }}" style="height: 200px;">
                                </a>
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="fw-bolder">
                                            <a href="{{ route('user.product', [$product->categories->first()->parentCategory->parentCategory->slug, $product->categories->first()->parentCategory->slug, $product->categories->first()->slug, $product->slug, $product]) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h5>
                                        <!-- Product price-->
                                        RM{{ $product->price }}
                                        <p class="card-text">{{ Str::limit($product->description, 75) }}</p>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <form action="{{ route('user.products.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <a class="btn btn-outline-primary mt-2" href="{{ route('user.product', [$product->categories->first()->parentCategory->parentCategory->slug,
                                                $product->categories->first()->parentCategory->slug, $product->categories->first()->slug, $product->slug, $product]) }}">
                                                {{ trans('global.products.product_select') }}
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if(get_class($products) == 'Illuminate\Pagination\LengthAwarePaginator')
                <div class="row">
                    {{ $products->links() ?? '' }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
@parent
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script>
    $(function () {
      $('#categories li').click(function () {
        var $this = $(this);
        var id = $this.data('id');

        // Collapse siblings
        $this.siblings('li[data-id!="' + id + '"]').children('i').addClass('fa-arrow-right').removeClass('fa-arrow-down');
        $this.siblings('div[data-id!="' + id + '"]').hide();

        $this.children('i').toggleClass('fa-arrow-right').toggleClass('fa-arrow-down');
        $this.siblings('div[data-id="' + id + '"]').toggle();
      });

      @if(isset($selectedCategories))
        @foreach($selectedCategories as $selected)
          @if($loop->index < 2)
            $('#categories .list-group-item[data-id="{{ $selected }}"]').click();
          @endif
          @if($loop->last)
            $('#categories .list-group-item[data-id="{{ $selected }}"]').toggleClass('active');
          @endif
        @endforeach
      @endif
    });
  </script>
@endsection
