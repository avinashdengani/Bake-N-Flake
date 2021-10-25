@extends('layouts.app')

@section('title',  'All Orders | Bake N Flake')

@section('content')
    <div class="container">
        <div class="section">
            <div class="section d-flex flex-column align-items-center">
                <span class="my-underline-2"></span>
                <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">All Orders</h2>
            </div>
            @if (count($orders) > 0)
            <div class="card my-card">
                @foreach ($orders as $order)
                    <div class="d-flex flex-column justify-content-between section-divider  {{$loop->last ? '' : 'border-bottom'}} orders">
                        <div class="card-header d-flex flex-row justify-content-between">
                            <div class="order-id">
                                <h5 class="text-purple">Order: {{$order}}</h5>
                            </div>
                            <div class="date">
                                <h5 class="">{{$dates[$loop->index]}}</h5>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <div class="customer m-2 p-2 border-bottom">
                                <h4 class="text-purple">Customer Details:</h4>
                                <h5 class="">Name: {{ $users[$loop->index]->name}}</h5>
                                <h5 class="">Address: {{ $users[$loop->index]->address}}</h5>
                                <h5 class="">Mobile No: {{ $users[$loop->index]->mobile_no}}</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="text-purple">Order Details:</h4>
                            @foreach ($finalOrders[$order] as $product)
                                <div class="{{$loop->last ? '' : 'border-bottom'}} m-2 d-flex flex-row justify-content-between section-divider">
                                    <div class="content">
                                        <h5 class="">{{$product['product'][0]->name}}({{$product['product'][0]->units}})</h5>
                                        <h5 class="">Price: {{$amounts[$order][$loop->index]}}</h5>
                                        <h5 class="">Quantity: {{$quantities[$order][$loop->index]}}</h5>
                                        <h5 class="">Total Amount: {{$quantities[$order][$loop->index] * $amounts[$order][$loop->index]}}</h5>
                                    </div>
                                    <div class="image m-2">
                                        <div class="carousel carousel{{ $loop->parent->iteration }} carousel-{{ $loop->parent->iteration }}{{ $loop->iteration }}">
                                            @foreach ($product['product'][0]->images as $image)
                                                <div class="my-admin-card-img child-{{ $loop->iteration }} ">
                                                    <img class="card-img-top" src="{{ asset($image->image_path) }}" alt="Card image" style="width: 300px; height:100%">
                                                    <a
                                                        class="my-admin-card-img-carousel-prev my-admin-card-img-carousel-prev-{{$loop->parent->iteration}} bi-chevron-left fa-2x {{ $product['product'][0]->images()->count() <=1  ? 'not-allowed' : '' }}"
                                                        title="{{ $product['product'][0]->images()->count() <=1  ? '' : 'view previous image' }}">
                                                    </a>
                                                    <a
                                                        class="my-admin-card-img-carousel-next my-admin-card-img-carousel-next-{{$loop->parent->iteration}} bi-chevron-right fa-2x {{ $product['product'][0]->images()->count() <=1  ? 'not-allowed' : '' }}"
                                                        title="{{ $product['product'][0]->images()->count() <=1  ? '' : 'view next image' }}">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            @else
                <div class="image d-flex justify-content-center flex-column align-items-center">
                    <img src="{{asset('images/cart/empty_cart.png')}}" alt="empty-cart" width="300px">
                    <h3 class="text-purple mt-4 font-weight-bolder">Hey, it feels so light</h3>
                    <p class="text-muted">You haven't ordered any item yet. Let's order delicious cakes and other bakery items.</p>
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
        let orders = document.getElementsByClassName("orders");
        ordersLength = orders.length;
        for(let j=1; j<=ordersLength; j++) {
            let carouselElement = document.getElementsByClassName("carousel"+j);
            carouselElementLength = carouselElement.length;

            for(let i=1; i<=carouselElementLength; i++) {
                console.log(carouselElement[i]);
                new ManualSlider("carousel-"+j+i , "my-admin-card-img-active" , "my-admin-card-img-carousel-next-"+i ,"my-admin-card-img-carousel-prev-"+i );
            }
        }
    </script>
@endsection
