@extends('layouts.app')

@section('title', 'Categories | Bake N Flake')
@section('favico', asset('images/favico.ico'))
@section('logo-img', asset('images/logo/logo.jpg'))

@section('sidebar')
    @include('layouts.partials._sidebar')
@endsection
@section('content')
    @if ($categories->count() > 0)
    <div class="col-md-8">
        <div class="card-group">
            <div class="my-category-column">
                <div class="card m-2 my-category-card">
                    <a href="{{ route('categories.create') }}"
                        class="nav-link p-0">
                        <div class="card-body d-flex justify-content-center flex-column my-category-card-body text-center ">
                            <p class=" text-center my-category-card-body-icon text-muted"><i class="fa fa-plus-circle fa-3x" ></i></p>
                            <p class="my-category-card-body-text text-muted">Add Category</p>
                        </div>
                    </a>
                </div>
            </div>
            @foreach ($categories as $category )
            <div class="my-category-column">
                <div class="card m-2 my-category-card">
                    <img class="card-img-top my-category-card-img" src="{{ asset($category->image_path) }}" alt="Card image">
                    <div class="card-body">
                        <h5 class="card-title my-category-card-title"><strong>{{ $category->name }}</strong></h5>
                        <div class="action-buttons">
                            <a
                                href="{{ route('categories.edit', $category->id) }}"
                                class="btn btn-warning btn-sm bi bi-pencil-square"
                                title="Edit category">
                            </a>
                            <button
                                type="button"
                                class="btn btn-outline-danger btn-sm bi bi-trash-fill"
                                onclick="displayModal({{$category->id}})"
                                data-toggle="modal"
                                data-target="#deleteModal"
                                title="Delete Category">
                            </button>
                        </div>
                        <p class="card-text my-category-card-text">Created {{ $category->created_date }}</p>
                        @if ($category->edited_date != null)
                            <p class="card-text my-category-card-text">
                                <small class="text-muted">
                                    Edited {{ $category->edited_date }}
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
                        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <h5 class="text-danger" >Are you sure, you want to delete category?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-danger">Delete Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center m-3">
            {{$categories->links()}}
        </div>
    </div>

    @else
    <div class="jumbotron">
        <h1 class="display-4 text-center">Hello, Admin!</h1>
        <p class="lead text-center">No categories found :(</p>
        <hr class="my-4">
        <p class="text-center">Click the button below to create a category.</p>
        <p class="lead text-center">
            <a href="{{route('categories.create')}}" class="btn btn-outline-primary" >Create new category</a>
        </p>
        </div>
    @endif
@endsection

@section('scripts')
  <script>
      function displayModal(categoryId) {
        var url = "/categories/" + categoryId;
        $("#deleteCategoryForm").attr('action', url);
      }
  </script>
  <script>
        function mediaWatcherFunction(mediaWatcher) {
            if (mediaWatcher.matches) {
                $(".my-category-column").removeClass("col-md-4");
                $(".my-category-column").addClass("col-md-6");
            } else {
                $(".my-category-column").removeClass("col-md-6");
                $(".my-category-column").addClass("col-md-4");
            }
        }
        var mediaWatcher = window.matchMedia("(max-width: 992px) and (min-width: 768px)");
        mediaWatcherFunction(mediaWatcher);
        mediaWatcher.addListener(mediaWatcherFunction);
  </script>
@endsection
