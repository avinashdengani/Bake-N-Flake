@extends('layouts.app')

@section('title', $product->name . ' | Bake N Flake')

@section('content')

    <div class="container">
        <div class="section">
            <div class="d-flex flex-row justify-content-between section-divider">
                <div class="image d-flex flex-row justify-content-between m-2">
                    <div class="img-slider d-flex flex-column border" style="overflow-y: auto; height:500px;">
                        @foreach ($product->images as $image)
                            <img src="{{asset($image->image_path)}}" alt="product-img" width="110px" height="100px" class="m-1 main-img-disabled @if ($image == $product->images()->first()) border border-dark @endif ">
                        @endforeach
                    </div>
                    <div class="img" id="img-container">
                        <img
                            src="{{asset($product->images()->first()->image_path)}}"
                            alt="product-image"
                            height="500px"
                            width="500px"
                            class="main-img rounded"
                            id="main-img">
                    </div>
                </div>

                <div class="content m-2">
                    <h4 class="text-purple">{{$product->name}}</h4>
                    <p class="text-muted font-italic">{{$product->description}}</p>
                    <h2 class="d-inline">{{$product->selling_cost}}</h2>
                    @if ($product->discount > 0)
                        <h6 class="text-muted d-inline">
                            <strike>{{ $product->mrp_cost }}</strike>
                        </h6>
                    @endif
                    <h5 class="text-purple">Avaliable in:
                        @foreach ($product->cities as $city)
                            <p class="text-muted font-italic font-weight-bold d-inline">{{$city->city_name}}({{$city->pincode}})@if (! $loop->last),@endif
                            </p>
                        @endforeach
                    </h5>
                    <div class="add-to-cart">
                        @if ($product->product_cart_status)
                            <a
                                href="{{route('cart.index')}}"
                                class="btn btn-danger">
                                    Already in Cart <i class="fa fa-shopping-cart"></i>
                            </a>
                        @else
                            <button
                                onclick="displayModalToQuantity('{{$category->id}}' ,'{{ $product->id}}')"
                                data-toggle="modal"
                                data-target="#quantityModalForm"
                                class="btn btn-warning">
                                    Add to Cart <i class="fa fa-cart-plus"></i>
                            </button>
                        @endif
                        @include('categories.Product.quantity-modal')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/js-image-zoom@0.7.0/js-image-zoom.js" type="application/javascript"></script>
    <script>

        let mainImagesDisabled = $(".main-img-disabled");
        let mainImg = $(".main-img");
        let imgContainer = document.getElementById("img-container");
        var options = {
            width: 500,
            height: 500,
            zoomWidth: 500,
            zoomLens: 'width:100px; height:100px;',
            zoomLensStyle: 'opacity: 0.4;background-color: #333;',
            offset: {vertical: 0, horizontal: 10}
        };
        let imgZoomContainer = new ImageZoom(imgContainer, options);
        for(let i=0; i<mainImagesDisabled.length; i++) {
            mainImagesDisabled.hover(function() {
                mainImagesDisabled.removeClass("main-img-active border border-dark");
                $(this).addClass("main-img-active");
                $(this).addClass("border border-dark");
                changeActiveImage();
            });
        }

        function changeActiveImage() {
            let mainImgActive  = $(".main-img-active");
            let mainImgActiveSrc = $(".main-img-active").attr('src');
            mainImg.attr('src', mainImgActiveSrc);
            imgZoomContainer.setup();
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
