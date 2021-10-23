@extends('layouts.app')

@section('title', 'Bake N Flake')

@section('content')
    <div class="container">
        <div class="section">
            <div class="d-flex justify-content-between section-divider align-items-center">
                <div class="content d-flex flex-column justify-content-center col-md-5">
                    <h1 class="">
                        <strong
                            class="font-weight-bolder text-purple">
                                Baked
                        </strong>
                        with
                    </h1>
                    <h1 class="">
                        <strong
                            class="font-weight-bolder text-dark">
                                Love <span class="text-purple">&</span> Cream
                        </strong>
                    </h1>
                    <p class="font-italic">
                        Mouthwatering taste, exceptional service. Experience the best of baking with <span class=" font-weight-bolder" style="color: #57453a;">BAKE N FLAKE.</span>
                    </p>
                    <div class="button">
                        <a
                            href="@auth #category @else {{ route('login') }} @endauth"
                            class="btn rounded btn-outline-dark"
                            style="text-decoration:none"
                            id="scroll-to-products">
                            <span class="styled-button-text">Explore</span>
                        </a>
                    </div>
                </div>
                <div class="image col-md-6 mt-2">
                    <img src="{{asset('images/landing-page/landing_page_1.png')}}" alt="" width="100%" class="mt-2">
                </div>
            </div>
        </div>

        <div class="section reveal" id="category">
            <div class="d-flex flex-column ">
                <div class="section d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Categories</h2>
                </div>
                <div class="owl-carousel">
                    @foreach ($categories as $category)
                    <div class="col-md-14 ">
                        <div class="position-absolute" style="top: 50%; left: 20%;">
                            <h2 class="text-capitalize text-white" style=" font-size:70px;">{{ $category->name}}</h2>
                            <div class="d-flex justify-content-center">
                                <a href="{{route('categories.products.index', [$category->id])}}" class="btn btn-see-more" style="font-size: 20px" >Buy now</a>
                            </div>
                        </div>
                        <div class="image">
                            <button class="owl_prev position-absolute btn btn-light bg-transparent text-white pl-3 pr-3" style="top: 50%;border:none;"><i class="fa fa-chevron-left fa-2x"></i></button>

                            <img src="{{asset($category->image_path)}}" alt="{{$category->name}}" width="100%" height="550px">

                            <button class="owl_next position-absolute btn btn-light bg-transparent text-white pl-3 pr-3" style="top: 50%;border:none;right:0;"><i class="fa fa-chevron-right fa-2x"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="section reveal">
            <div class="d-flex flex-column ">
                @foreach ($categories as $category)
                    <div class="section d-flex flex-column align-items-center category">
                        <span class="my-underline-2"></span>
                        <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">{{$category->name}}</h2>
                    </div>
                    <div class="d-flex row col-md-16">
                        @foreach ($category->products()->productsAvailable()->get() as $product)
                            <div class="my-admin-column user-select-none">
                                <div class="card m-2 my-admin-card p-2">
                                    <div class="carousel carousel-{{ $loop->parent->iteration }}{{ $loop->iteration }}">
                                        @foreach ($product->images as $image)
                                            <div class="my-admin-card-img child-{{ $loop->iteration }} ">
                                                <img class="card-img-top" src="{{ asset($image->image_path) }}" alt="Card image">
                                                <div class="overlay d-flex flex-column justify-content-center align-items-center">
                                                    <h6 class="text-center text-white">{{$product->name}}</h6>
                                                    <p class="text-center text-white">
                                                        <strong class="text-white">
                                                            @if ($product->discount > 0) <strike>{{ $product->mrp_cost }}</strike> @endif {{ $product->selling_cost }}
                                                        </strong>
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if ($loop->iteration == 3)
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="d-flex flex-column align-items-center section">
                        <a href="{{route('categories.products.index', [$category->id])}}" class="btn btn-see-more">Show More</a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="section testimonials reveal">
            <div class="d-flex flex-column">
                <div class="section d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-dark font-weight-bold text-capitalize mt-3 sub-heading">Testimonials</h2>
                </div>
                <div class="d-flex justify-content-between section-divider">
                    <div class="content d-flex flex-column justify-content-center col-md-4">
                        <h1 class="">
                            <strong
                                class="font-weight-bolder text-purple">
                                    See What Our
                            </strong>
                        </h1>
                        <h1 class="">
                            <strong
                                class="font-weight-bolder text-dark">
                                    Customers are
                            </strong>
                        </h1>
                        <h1 class="">
                            <strong
                                class="font-weight-bolder text-dark">
                                    Saying About Us
                            </strong>
                        </h1>
                        <p><strong></strong></p>
                    </div>

                    <div class="col-md-8 d-flex flex-row align-content-center justify-content-center align-items-center">
                        <div class="mr-2">
                            <button class=" owl_prev btn rounded-circle carousel-btn-prev " ><i class="fa fa-chevron-left  fa-lg"></i></button>
                        </div>
                        <div class="owl-carousel mt-3" >
                            @foreach($testimonials as $testimonial)
                                    <div
                                        class="card col-md-10 rounded shadow-sm bg-light p-4
                                                d-flex justify-content-center flex-column align-items-center align-content-center my-card-border-top my-card-border-radius ">
                                        <div class="image ">
                                            <img src="{{$testimonial->owner->image_path}}" class="rounded-circle" width="100px" height="100px">
                                        </div>
                                        <q class="text-center font-italic text-dark font-weight-bold testimonial-description">{{$testimonial->description}}</q>
                                        <strong class="float-right text-purple testimonial-description">~{{$testimonial->owner->name}}</strong>
                                    </div>
                            @endforeach
                        </div>
                        <div>
                            <button class=" owl_next btn rounded-circle carousel-btn-next " >
                            <i class="fa fa-chevron-right fa-lg "></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

      <script src="{{ asset('js/automateSlider.js') }}"></script>
      <script>
        let carouselElement = document.getElementsByClassName("carousel");
        let category = document.getElementsByClassName("category");
        carouselElementLength = carouselElement.length;
        categoryLength = category.length;
        for(let j=1; j<=categoryLength ; j++) {
            for(let i=1; i<=3; i++) {
                new AutomateSlider("carousel-"+j+i , "my-admin-card-img-active" );
            }
        }
    </script>

<script>
    $(document).ready(function(){
        let owl = $(".owl-carousel");
        owl.owlCarousel({
                loop: true,
                nav: false,
                dots: false,
                autoplay: true,
                smartSpeed: 1000,
                margin: 50,
                rewindNav : false,
                pagination : false,
                responsive:{
                    0:{
                        items:1,
                        nav:true,
                    },
                    600:{
                        items:1,
                        nav:false
                    },
                    1000:{
                        items:1,
                        nav:false
                    },
                }
            });

            $('.owl_next').click(function() {
                owl.trigger('next.owl.carousel');
            });
            $('.owl_prev').click(function() {
                owl.trigger('prev.owl.carousel', [1000]);
            });
        });
    </script>

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
  <script>
    new MySmoothScroll("#scroll-to-products");
  </script>
@endsection
