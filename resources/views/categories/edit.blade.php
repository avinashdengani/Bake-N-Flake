@extends('layouts.app')

@section('title', 'Edit Category | Bake N Flake')
@section('favico', asset('images/favico.ico'))
@section('logo-img', asset('images/logo/logo.jpg'))

@section('sidebar')
    @include('layouts.partials._sidebar')
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2>Update Category</h2>
            </div>
            <div class="card-body">
                <form action="{{route('categories.update', $category->id)}}" method="POST" id="edit-category-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-6">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            value="{{old('name', $category->name)}}"
                            placeholder="Enter Categroy Name"
                            name="name">
                            @error('name')
                            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group col-6">
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
                    <div class=" col-6">
                        <button type="submit" class="btn btn-warning mt-2">Edit Category</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @endsection
@section('scripts')
    <script>
        $("#edit-category-form").validate({
            rules: {
                name: {
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
@endsection
