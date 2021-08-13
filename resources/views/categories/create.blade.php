@extends('layouts.app')
@section('title', 'Add Category | Bake N Flake')


@section('sidebar')
    @include('layouts.partials._sidebar')
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2>Add Category</h2>
            </div>
            <div class="card-body">
                <form action="{{route('categories.store')}}" method="POST" id="create-category-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group ">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            value="{{old('name')}}"
                            placeholder="Enter Category Name"
                            name="name">
                            @error('name')
                            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group ">
                        <label for="name">Image</label>
                        <div class="custom-file">
                            <input type="file"
                                   class="custom-file-input @error('image') is-invalid @enderror"
                                   id="customFile"
                                   name="image">
                            <label class="custom-file-label" for="customFile">Choose Image</label>
                        </div>
                        @error('image')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class=" ">
                        <button type="submit" class=" btn btn-success mt-2">Submit</button>
                    </div>
                  </form>
            </div>
          </div>

    </div>
@endsection
@section('scripts')
    <script>
        $("#create-category-form").validate({
            rules: {
                name: {
                    required: true,
                },
                image: {
                    required: true,
                },
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
        $(".custom-file-input").on("change", function() {
            var imageName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(imageName);
        });
    </script>
    <script>
        function mediaWatcherFunction(mediaWatcher) {
            if (mediaWatcher.matches) {
                $(".form-group").addClass("col-6");
            } else {
                $(".form-group").removeClass("col-6");
            }
        }
        var mediaWatcher = window.matchMedia("(min-width: 1200px)");
        mediaWatcherFunction(mediaWatcher);
        mediaWatcher.addListener(mediaWatcherFunction);
    </script>
@endsection
