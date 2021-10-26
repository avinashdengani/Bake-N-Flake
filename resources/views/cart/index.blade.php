@extends('layouts.app')

@section('title',  'Cart | Bake N Flake')

@section('content')
    <div class="container">
        <div class="section">
            <div class="section d-flex flex-column align-items-center">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Cart</h2>
            </div>
            @if (count($products) > 0)
                <div class="card my-card">
                    @foreach ($products as $product)
                        <div class="d-flex flex-row justify-content-between section-divider m-2 {{$loop->last ? '' : 'border-bottom'}}">
                            <div class="image m-2">
                                <div class="carousel carousel-{{ $loop->iteration }}">
                                    @foreach ($product[0][0]->images as $image)
                                        <div class="my-admin-card-img child-{{ $loop->iteration }} ">
                                            <img class="card-img-top" src="{{ asset($image->image_path) }}" alt="Card image" style="width: 300px; height:100%">
                                            <a
                                                class="my-admin-card-img-carousel-prev my-admin-card-img-carousel-prev-{{$loop->parent->iteration}} bi-chevron-left fa-2x {{ $product[0][0]->images()->count() <=1  ? 'not-allowed' : '' }}"
                                                title="{{ $product[0][0]->images()->count() <=1  ? '' : 'view previous image' }}">
                                            </a>
                                            <a
                                                class="my-admin-card-img-carousel-next my-admin-card-img-carousel-next-{{$loop->parent->iteration}} bi-chevron-right fa-2x {{ $product[0][0]->images()->count() <=1  ? 'not-allowed' : '' }}"
                                                title="{{ $product[0][0]->images()->count() <=1  ? '' : 'view next image' }}">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="content m-2">
                                <div class="d-flex justify-content-between flex-row">
                                    <a href="{{route('categories.products.show', [$product[0][0]->category_id, $product[0][0]->id])}}" class="nav-link p-0 m-0">
                                        <h4 class="ml-2 text-purple">{{$product[0][0]->name}}</h4>
                                    </a>
                                    <button
                                        class="text-dark btn bi bi-x-lg "
                                        onclick="displayModalToRemoveProductFromCart('{{$product[0][0]->category_id}}' ,'{{ $product[0][0]->id}}')"
                                        data-toggle="modal"
                                        data-target="#removeProductFromCartModal"
                                        title="Remove product from cart">
                                    </button>
                                </div>
                                <p class="m-2 text-muted">{{$product[0][0]->description}}</p>
                                <h5 class="m-2">Price:
                                    @if ($product[0][0]->discount > 0)
                                        <strike>{{ $product[0][0]->mrp_cost }}</strike>
                                    @endif
                                    {{ $product[0][0]->selling_cost }}
                                </h5>
                                <h5 class="m-2">Quantity: {{$product[1]}}
                                    <button
                                        onclick="displayModalToQuantity('{{$product[0][0]->category_id}}' ,'{{ $product[0][0]->id}}')"
                                        data-toggle="modal"
                                        data-target="#quantityModalForm"
                                        class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                </h5>
                                <h5 class="m-2">
                                    Amount: ₹{{$product[1] * $product[0][0]->selling_price}}
                                </h5>
                                <h5 class="text-purple d-inline ml-2 mt-2 mb-2">Avaliable in: </h5>
                                @foreach ($product[0][0]->cities as $city)
                                    <p class="text-muted font-italic font-weight-bold d-inline">{{$city->city_name}}({{$city->pincode}})@if (! $loop->last),@endif</p>
                                @endforeach
                            </div>
                        </div>
                        @include('cart.quantity-edit-modal')
                        @include('cart.remove-product')
                    @endforeach
                    <div class="card-footer">
                        <div class="d-flex flex-row section-divider justify-content-between align-items-center">
                            <div class="col-md-4 mt-4">
                                <h5 class="text-purple">Your Details:</h5>
                                    <p class="text-purple p-0 m-0">Address: <span class="text-muted">{{auth()->user()->address}}</span></p>
                                    <p class="text-purple p-0 m-0">Contact no.: <span class="text-muted">{{auth()->user()->mobile_no}}</span></p>
                                    <p class="text-purple p-0 m-0">Email: <span class="text-muted">{{auth()->user()->email}}</span></p>

                            </div>
                            <div class="content col-md-4 mt-4">
                                <div class="mrp d-flex justify-content-between flex-row">
                                    <h6 class="text-muted">
                                        Total MRP
                                    </h6>
                                    <h6 class="text-muted">
                                        ₹{{$totalMrp}}
                                    </h6>
                                </div>
                                <div class="mrp d-flex justify-content-between flex-row">
                                    <h6 class="text-muted">
                                        Discount on MRP
                                    </h6>
                                    <h6 class="text-muted">
                                        <i class="fa fa-minus fa-sm"></i> ₹{{$totalDiscount}}
                                    </h6>
                                </div>
                                <div class="mrp d-flex justify-content-between flex-row border-bottom">
                                    <h6 class="text-muted">
                                        Delivery Charges
                                    </h6>
                                    <h6 class="text-muted">
                                       <i class="fa fa-plus fa-sm"></i> ₹{{$deliveryCharge}}
                                    </h6>
                                </div>
                                <div class="mrp d-flex justify-content-between flex-row mt-2">
                                    <h6 class="text-muted">
                                        Total Amount
                                    </h6>
                                    <h6 class="text-muted">
                                        ₹{{$totalAmount + $deliveryCharge}}
                                    </h6>
                                </div>
                                <div class="confirm-order">
                                    <button
                                        onclick="redirectToPayment('{{$totalAmount + $deliveryCharge}}' ,'{{auth()->user()->name }}', '{{auth()->user()->email }}', {{auth()->user()->mobile_no}})"
                                        class="btn btn-purple"
                                        id="procees-to-pay"
                                        style="width: 100%">Pay and Confirm Order</button>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="image d-flex justify-content-center flex-column align-items-center">
                    <img src="{{asset('images/cart/empty_cart.png')}}" alt="empty-cart" width="300px">
                    <h3 class="text-purple mt-4 font-weight-bolder">Hey, it feels so light</h3>
                    <p class="text-muted">There is nothing in your cart. Let's add some items.</p>
                    <a href="{{route('home')}}" class="btn btn-purple">Explore items</a>
                </div>
            @endif
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
            url = 'cart/categories/'+ categoryId + '/products/' + productId;
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

    <script>
        function displayModalToConfirmOrder() {
            url = 'cart/transactions';
            $("#confirmOrderForm").attr('action', url);
        }
    </script>
    <script>
        function displayModalToRemoveProductFromCart(categoryId, productId) {
            url = 'cart/categories/'+ categoryId + '/products/' + productId;
            $("#removeProductFromCartProductForm").attr('action', url);
        }
    </script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function redirectToPayment(totalAmount, username, email, mobileNo) {
            let logo = $("#logo-img").attr('src');
            form = createFormToCreateTransaction();
            var options = {
                "key": "rzp_test_RfLIp3FKPPdp1J",
                "amount": totalAmount * 100,
                "currency": "INR",
                "name": "Bake N Flake",
                "image": logo,
                "id": "order_9A33XWu170gUtm",
                "handler": function (response){
                    form.submit();
                },
                "prefill": {
                    "name": username,
                    "email": email,
                    "contact": mobileNo
                },
                "notes": {
                    "address": "Razorpay Corporate Office"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                    alert(response.error.code);
                    alert(response.error.description);
                    alert(response.error.source);
                    alert(response.error.step);
                    alert(response.error.reason);
                    alert(response.error.metadata.order_id);
                    alert(response.error.metadata.payment_id);
            });
            rzp1.open();
            rzp1.preventDefault();
        }
        function createFormToCreateTransaction() {
            const form = document.createElement('form');
            let url = 'cart/transactions';
            form.method = "POST";
            form.action = url;

            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';


            form.appendChild(hiddenField);
            form.innerHTML = '@csrf';

            document.body.appendChild(form);
            return form;
        }
    </script>
@endsection
