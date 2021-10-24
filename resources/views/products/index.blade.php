@extends('layouts.app')

@section('title', 'Products | Bake N Flake')

@section('sidebar')
    @include('layouts.partials._sidebar')
@endsection
@section('content')
    @if ($products->count() > 0)
    <div class="col-md-8">
        <div class="card-group">
            <div class="my-admin-column">
                <div class="card m-2 my-admin-card">
                    <a href="{{ route('products.create') }}"
                        class="nav-link p-0">
                        <div class="card-body d-flex justify-content-center flex-column my-admin-card-body text-center ">
                            <p class=" text-center my-admin-card-body-icon text-muted"><i class="fa fa-plus-circle fa-3x" ></i></p>
                            <p class="my-admin-card-body-text text-muted">Add Product</p>
                        </div>
                    </a>
                </div>
            </div>
            @foreach ($products as $product )
            <div class="my-admin-column">
                <div class="card m-2 my-admin-card ">
                    <div class="carousel carousel-{{ $loop->iteration }}">
                        @foreach ($product->images as $image)
                        <div class="my-admin-card-img child-{{ $loop->iteration }} ">
                            <img class="card-img-top" src="{{ asset($image->image_path) }}" alt="Card image">
                            <a
                                href="{{ route('products.images.edit',[ $product->id, $image->id]) }}"
                                class="btn btn-warning btn-sm bi bi-pencil-square my-admin-card-img-action-btn"
                                title="Edit image">
                            </a>
                            <button
                                type="button"
                                class="btn btn-danger btn-sm bi bi-trash-fill my-admin-card-img-action-btn ml-5"
                                onclick="displayModalToDeleteImage({{$product->id}}, {{ $image->id }})"
                                data-toggle="modal"
                                data-target="#deleteModalForImage"
                                title="Delete Image">
                            </button>
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
                        <h5 class="card-title my-admin-card-title"><strong>{{ $product->name }}<i class="{{ $product->status_css }}">({{ $product->get_status }})</i></strong></h5>
                        <h5
                            class="card-title my-admin-card-title m-0">
                            <strong>
                                @if ($product->discount > 0) <strike>{{ $product->mrp_cost }}</strike> @endif {{ $product->selling_cost }}
                            </strong>
                        </h5>
                        @foreach ($product->cities as $city)
                            <h5 class="d-inline ">{{$city->city_name}}@if (!$loop->last),@endif</h5>
                        @endforeach
                        <div class="action-buttons">
                            <a
                                href="{{ route('products.show', $product->id) }}"
                                class="btn btn-primary btn-sm bi bi-eye"
                                title="View product">
                            </a>
                            <a
                                href="{{ route('products.edit', $product->id) }}"
                                class="btn btn-warning btn-sm bi bi-pencil-square"
                                title="Edit product">
                            </a>
                            <button
                                class="btn btn-outline-danger btn-sm bi bi-trash-fill"
                                onclick="displayModal({{$product->id}})"
                                data-toggle="modal"
                                data-target="#deleteModal"
                                title="Delete product">
                            </button>
                        </div>
                        <p class="card-text my-admin-card-text">Created {{ $product->created_date }}</p>
                        @if ($product->edited_date != null)
                            <p class="card-text my-admin-card-text">
                                <small class="text-muted">
                                    Edited {{ $product->edited_date }}
                                </small>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            @endforeach
        </div>
        <!--Delete Modal-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" id="deleteProductForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <h5 class="text-danger" >Are you sure, you want to delete product?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-danger">Delete product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Delete Modal For Image-->
        <div class="modal fade" id="deleteModalForImage" tabindex="-1" role="dialog" aria-labelledby="deleteModalForImageLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalForImageLabel">Delete Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" id="deleteImageForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <h5 class="text-danger" >Are you sure, you want to delete this image?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-danger">Delete image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center m-3">
            {{$products->links()}}
        </div>
    </div>

    @else
    <div class="jumbotron">
        <h1 class="display-4 text-center">Hello, Admin!</h1>
        <p class="lead text-center">No products found :(</p>
        <hr class="my-4">
        <p class="text-center">Click the button below to add a product.</p>
        <p class="lead text-center">
            <a href="{{route('products.create')}}" class="btn btn-outline-primary" >Add new product</a>
        </p>
        </div>
    @endif
@endsection

@section('scripts')
  <script>
      function displayModal(productId) {
        var url = "/products/" + productId;
        $("#deleteProductForm").attr('action', url);
      }
      function displayModalToDeleteImage(productId, imageId) {
        var url = "/products/" + productId + "/images/" + imageId;
        $("#deleteImageForm").attr('action', url);
      }
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

      <script src="{{ asset('js/manualSlider.js') }}"></script>
      <script>
        let carouselElement = document.getElementsByClassName("carousel");
        carouselElementLength = carouselElement.length;
        for(let i=1; i<=carouselElementLength; i++) {
            new ManualSlider("carousel-"+i , "my-admin-card-img-active" , "my-admin-card-img-carousel-next-"+i ,"my-admin-card-img-carousel-prev-"+i );
        }
    </script>
@endsection
