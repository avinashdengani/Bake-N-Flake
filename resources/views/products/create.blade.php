@extends('layouts.app')
@section('title', 'Add Product | Bake N Flake'))

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        trix-editor {
            height: 250px !important;
            max-height: 250px !important;
              overflow-y: auto !important;
        }
        .trix-button-group--file-tools { display: none !important; }
    </style>

@endsection
@section('sidebar')
    @include('layouts.partials._sidebar')
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2>Add Product</h2>
            </div>
            <div class="card-body">
                <form action="{{route('products.store')}}" method="POST" id="create-product-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            value="{{old('name')}}"
                            placeholder="Enter Product Name"
                            name="name">
                            @error('name')
                            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="hidden" id="description" name="description" value="{{ old('description') }}">
                        <trix-editor input="description" class="form-control  @error('description') is-invalid @enderror " ></trix-editor>
                        @error('description')
                            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mrp">MRP (in Rs)</label>
                        <input
                            type="number"
                            class="form-control @error('mrp') is-invalid @enderror"
                            id="mrp"
                            value="{{old('mrp')}}"
                            placeholder="Enter MRP in Rupees"
                            name="mrp">
                            @error('mrp')
                            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount (in Percentage)</label>
                        <input
                            type="number"
                            class="form-control @error('discount') is-invalid @enderror"
                            id="discount"
                            value="{{old('discount', 0)}}"
                            placeholder="Enter discount in percentage"
                            name="discount">
                            @error('discount')
                            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="Category">Category</label>
                        <select name="category_id" id="category_id" class="form-control select2" style="width: 100%">
                            <option></option>
                            @foreach ($categories as $category)
                                @if($category->id == old('category_id'))
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('category_id')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" style="width: 100%">
                            <option></option>
                            <option value="1" >Available</option>
                            <option value="0" >Unavailable</option>
                        </select>
                            @error('price')
                            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Image(s)</label>
                        <div class="custom-file">
                            <input type="file"
                                   class="custom-file-input @error('image.*') is-invalid @enderror"
                                   id="image"
                                   name="image[]"
                                   multiple>
                            <label class="custom-file-label" for="customFile">Choose Image(s)</label>
                        </div>
                        @error('image.*')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="">
                        <button type="submit" class="col-6 btn btn-success mt-2">Submit</button>
                    </div>
                  </form>
            </div>
          </div>

    </div>
@endsection
@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.addEventListener("trix-file-accept", function(event) {
        event.preventDefault()
        alert("File attachment not supported!")
    })
    </script>
    <script>
        $("#create-product-form").validate({
            rules: {
                name: {
                    required: true,
                },
                description: {
                    required: true,
                    maxlength:255
                },
                price: {
                    required: true,
                },
                discount: {
                    required:true,
                    number: true,
                    range: [0, 100]
                },
                category_id: {
                    required:true,
                },
                status: {
                    required:true,
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.select2').select2({
            placeholder: 'Select an option',
            allowClear: true
        });
        $("#status").select2({
            placeholder: 'Select an option',
            allowClear: true,
            minimumResultsForSearch: Infinity,
            width: 'resolve'
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
