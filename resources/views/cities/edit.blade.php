@extends('layouts.app')
@section('title', 'Edit City | Bake N Flake')

@section('sidebar')
    @include('layouts.partials._sidebar')
@endsection

@section('content')
    <div class="col-md-8">
        <div class="section d-flex flex-column align-items-center">
            <span class="my-underline-2"></span>
            <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Edit City</h2>
        </div>
        <div class="card">

            <div class="card-body">
                <form action="{{route('cities.update', $city->id)}}" method="POST" id="create-city-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="city_name">City Name</label>
                        <input
                            type="text"
                            class="form-control @error('city_name') is-invalid @enderror"
                            id="city_name"
                            value="{{old('city_name', $city->city_name)}}"
                            placeholder="Enter City Name"
                            name="city_name">
                            @error('city_name')
                            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="pincode">Pincode</label>
                        <input
                            type="number"
                            class="form-control @error('pincode') is-invalid @enderror"
                            id="pincode"
                            value="{{old('pincode', $city->pincode)}}"
                            placeholder="Enter pincode"
                            name="pincode">
                            @error('pincode')
                            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                    </div>

                    <div class="">
                        <button type="submit" class="col-6 btn btn-success mt-2">Edit Changes</button>
                    </div>
                  </form>
            </div>
          </div>

    </div>
@endsection
@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#create-city-form").validate({
            rules: {
                pincode: {
                    required: true,
                    digits:true,
                    minlength:6,
                    maxlength:6
                },
                city_name: {
                    required: true
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
