<div class="sidebar col-md-3 m-2">
    <div class="card my-navbar">
        <div class="card-body">
            <ul class="list-group">
                <!-- Default dropright button -->
                <div class="dropright">
                    <a
                        class="dropdown-toggle list-group-item"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        Categories
                    </a>
                    <div class="dropdown-menu">
                    <!-- Dropdown menu links -->
                    <li class="m-2 list-group-item  ">
                        <a class="" href="{{ route('categories.index') }}">View Categories</a>
                    </li>
                    <li class="m-2 list-group-item">
                        <a class="" href="{{ route('categories.create') }}">Add Category</a>
                    </li>
                    </div>
                </div>
                <li class="list-group-item  ">
                    <a class="" href="{{ url('/') }}">Visit to home Page <i class="fa fa-home" ></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
