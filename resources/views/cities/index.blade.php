@extends('layouts.app')

@section('title', 'Cities | Bake N Flake')


@section('sidebar')
    @include('layouts.partials._sidebar')
@endsection
@section('content')
    @if ($cities->count() > 0)
    <div class="col-md-8">
        <div class="section d-flex flex-column align-items-center">
            <span class="my-underline-2"></span>
            <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Cities</h2>
        </div>
        <div class="card-group">
            <div class="my-admin-column">
                <div class="card m-2 my-admin-card">
                    <a href="{{ route('cities.create') }}"
                        class="nav-link p-0">
                        <div class="card-body d-flex justify-content-center flex-column text-center ">
                            <p class=" text-center my-admin-card-body-icon text-muted"><i class="fa fa-plus-circle fa-3x" ></i></p>
                            <p class="my-admin-card-body-text text-muted m-3">Add City</p>
                        </div>
                    </a>
                </div>
            </div>
            @foreach ($cities as $city )
            <div class="my-admin-column">
                <div class="card m-2 my-admin-card">
                    <div class="card-body">
                        <h5 class="card-title my-admin-card-title text-purple">City Name: <strong class="text-dark"> {{ $city->city_name }}</strong></h5>
                        <h5 class="card-title my-admin-card-title text-purple">Pincode: <strong class="text-dark"> {{ $city->pincode }}</strong></h5>
                        <div class="action-buttons">
                            <a
                                href="{{ route('cities.edit', $city->id) }}"
                                class="btn btn-warning btn-sm bi bi-pencil-square"
                                title="Edit city">
                            </a>
                            <button
                                type="button"
                                class="btn btn-outline-danger btn-sm bi bi-trash-fill"
                                onclick="displayModal({{$city->id}})"
                                data-toggle="modal"
                                data-target="#deleteModal"
                                title="Delete city">
                            </button>
                        </div>
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
                        <h5 class="modal-title" id="deleteModalLabel">Delete city</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" id="deletecityForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <h5 class="text-danger" >Are you sure, you want to delete city?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-danger">Delete city</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center m-3">
            {{$cities->links()}}
        </div>
    </div>

    @else
    <div class="jumbotron">
        <h1 class="display-4 text-center">Hello, Admin!</h1>
        <p class="lead text-center">No cities found :(</p>
        <hr class="my-4">
        <p class="text-center">Click the button below to create a city.</p>
        <p class="lead text-center">
            <a href="{{route('cities.create')}}" class="btn btn-outline-primary" >Create new city</a>
        </p>
        </div>
    @endif
@endsection

@section('scripts')
  <script>
      function displayModal(cityId) {
        var url = "/cities/" + cityId;
        $("#deletecityForm").attr('action', url);
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
@endsection
