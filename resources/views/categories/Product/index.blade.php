@extends('layouts.app')

@section('title', $category->name .' | Bake N Flake')

@section('content')
    <div class="container">
        <div class="section reveal">
            <div class="d-flex flex-column ">
                <div class="section d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">{{$category->name}}</h2>
                </div>
                <div class="d-flex row col-md-16">
                    @foreach ($products as $product )
                        <div class="my-admin-column">
                            <div class="card m-2 my-admin-card ">
                                <div class="carousel carousel-{{ $loop->iteration }}">
                                    @foreach ($product->images as $image)
                                        <div class="my-admin-card-img child-{{ $loop->iteration }} ">
                                            <img class="card-img-top" src="{{ asset($image->image_path) }}" alt="Card image">
                                            <a
                                                class="my-admin-card-img-carousel-prev my-admin-card-img-carousel-prev-{{$loop->parent->iteration}} bi-chevron-left fa-2x {{ $product->images->count() <=1  ? 'not-allowed' : '' }}"
                                                title="{{ $product->images->count() <=1  ? '' : 'view previous image' }}">
                                            </a>
                                            <a
                                                class="my-admin-card-img-carousel-next my-admin-card-img-carousel-next-{{$loop->parent->iteration}} bi-chevron-right fa-2x {{ $product->images->count() <=1  ? 'not-allowed' : '' }}"
                                                title="{{ $product->images->count() <=1  ? '' : 'view next image' }}">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title my-admin-card-title"><strong>{{ $product->name }}</strong></h5>
                                    <h5
                                        class="card-title my-admin-card-title">
                                        <strong>
                                            @if ($product->discount > 0) <strike>{{ $product->mrp_cost }}</strike> @endif {{ $product->selling_cost }}</strong>
                                    </h5>
                                    <div class="action-buttons d-flex justify-content-between flex-row">
                                        <a
                                            href="{{ route('categories.products.show', [$category->id, $product->id]) }}"
                                            class="btn btn-primary btn-sm "
                                            title="View product">
                                        View <i class=" bi bi-eye"></i>
                                        </a>
                                        @if ($product->product_cart_status)
                                                <a
                                                    href="{{route('cart.index')}}"
                                                    class="btn btn-danger btn-sm">
                                                        Already in Cart <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            @else
                                                <button
                                                    onclick="displayModalToQuantity('{{$category->id}}' ,'{{ $product->id}}')"
                                                    data-toggle="modal"
                                                    data-target="#quantityModalForm"
                                                    class="btn btn-warning btn-sm">
                                                        Add to Cart <i class="fa fa-cart-plus"></i>
                                                </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @include('categories.Product.quantity-modal')
            </div>
        </div>
    </div>
@endsection


@section('scripts')

    <script>
        function mediaWatcherFunction(mediaWatcher) {
            if (mediaWatcher.matches) {
                $(".my-admin-column").removeClass("col-md-4");
                $(".my-admin-column").addClass("col-md-6");
            } else {
                $(".my-admin-column").removeClass("col-md-6");
                $(".my-admin-column").addClass("col-md-4");
            }
        }
        var mediaWatcher = window.matchMedia("(max-width: 992px) and (min-width: 768px)");
        mediaWatcherFunction(mediaWatcher);
        mediaWatcher.addListener(mediaWatcherFunction);
    </script>

  <script src="{{ asset('js/manualSlider.js') }}"></script>
  <script>
        let carouselElement = document.getElementsByClassName("carousel");
        carouselElementLength = carouselElement.length;
        for(let i=1; i<=carouselElementLength; i++) {
            new ManualSlider("carousel-"+i , "my-admin-card-img-active" , "my-admin-card-img-carousel-next-"+i ,"my-admin-card-img-carousel-prev-"+i );
        }
    </script>

    <script>
        function displayModalToQuantity(categoryId, productId) {
            url = '/cart/categories/'+ categoryId + '/products/' + productId;
            $("#quantityForm").attr('action', url);
        }
    </script>
    <script>
        $("#quantityForm").validate({
            rules: {
                quantity: {
                    required: true,
                    digits: true,
                    min: 1,
                    max: 10
                }
            },
            errorElement: 'p',
            errorPlacement: function(error, element) {
                if (error) {
                    error.insertAfter(element);
                    error.addClass('text-danger');
                }
            }
        });
    </script>
@endsection
