@extends('layouts.app')

@section('title', 'Edit Image | Bake N Flake')

@section('sidebar')
    @include('layouts.partials._sidebar')
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2>Update Image</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('products.images.update',[ $product->id, $image->id]) }}" method="POST" id="edit-image-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-6">
                        <label for="name">Image</label>
                        <div class="d-flex">
                            <div class="img">
                                <img src="{{asset($image->image_path)}}" alt="product-image" width="150px" id="image-preview">
                            </div>
                            <div class="custom-file ml-1">
                                <input type="file"
                                       class="custom-file-input @error('image') is-invalid @enderror"
                                       id="customFile"
                                       name="image">
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                                @error('image')
                                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                <div>
                                    <button type="submit" class="btn btn-warning m-0 mt-2">Edit image</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @endsection
@section('scripts')
    <script>
        $("#edit-image-form").validate({
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFile").change(function(){
            readURL(this);
        });
    </script>
@endsection
