<div class="sidebar col-md-3 m-2">
    <div class="card my-navbar">
        <div class="card-body">

            <!-- Search ========
                ============================= -->

                <div class="pr25 pl25 clearfix">
                <form action="#">
                    <div class="my-search">
                        <form class="form-inline " action="{{ url('/') }}">
                            <input
                                    class="form-control mr-sm-2"
                                    name="search"
                                    type="search"
                                    placeholder="e.g. Pineapple Cake"
                                    aria-label="Search"
                                    value="{{request('search')}}"
                                    >
                            <button
                                    class="btn btn-outline-success "
                                    type="submit">
                                        <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </form>
            </div>

            <ul class="list-group">
                @auth
                    @if(auth()->user()->isAdmin())
                        <!-- Default dropright button -->
                        <div class="dropright my-nav-link">
                            <a
                                class="dropdown-toggle list-group-item list-group-item-action @if(request()->is('categories') || request()->is('categories/create')) active @else text-primary @endif"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                Categories
                            </a>
                            <div class="dropdown-menu">
                                <!-- Dropdown menu links -->
                                <li class="m-2 list-group-item @if(request()->is('categories/create')) active @else text-primary @endif">
                                    <a
                                        class="p-0 m-0 @if(request()->is('categories/create')) text-white @else nav-link @endif"
                                        href="{{ route('categories.create') }}">
                                        Add Category
                                    </a>
                                </li>
                                <li class="m-2 list-group-item @if(request()->is('categories')) active @else text-primary @endif">
                                    <a
                                        class="p-0 m-0 @if(request()->is('categories')) text-white @else nav-link @endif"
                                        href="{{ route('categories.index') }}">
                                        View all categories
                                    </a>
                                </li>
                            </div>
                        </div>
                        <!-- Default dropright button -->
                        <div class="dropright my-nav-link">
                            <a
                                class="dropdown-toggle list-group-item list-group-item-action @if(request()->is('products') || request()->is('products/create') || request()->is('products/available') || request()->is('products/unavailable')) active @else text-primary @endif"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                Products
                            </a>
                            <div class="dropdown-menu m-0 p-0">
                            <!-- Dropdown menu links -->
                            <li class="m-2 list-group-item @if(request()->is('products/create')) active @else text-primary @endif">
                                <a
                                    class="p-0 m-0 @if(request()->is('products/create')) text-white @else nav-link @endif"
                                    href="{{ route('products.create') }}">
                                    Add product
                                </a>
                            </li>
                            <li class="m-2 list-group-item @if(request()->is('products')) active @else text-primary @endif">
                                <a
                                    class="p-0 m-0 @if(request()->is('products')) text-white @else nav-link @endif"
                                    href="{{ route('products.index') }}">
                                    View all products
                                </a>
                            </li>
                            <li class="m-2 list-group-item @if(request()->is('products/available')) active @else text-primary @endif">
                                <a
                                    class="p-0 m-0 @if(request()->is('products/available')) text-white @else nav-link @endif"
                                    href="{{ route('products.available') }}">
                                    View available products
                                </a>
                            </li>
                            <li class="m-2 list-group-item @if(request()->is('products/unavailable')) active @else text-primary @endif">
                                <a
                                    class="p-0 m-0 @if(request()->is('products/unavailable')) text-white @else nav-link @endif"
                                    href="{{ route('products.unavailable') }}">
                                    View unavailable products
                                </a>
                            </li>
                            </div>
                        </div>

                        <div class="dropright my-nav-link">
                            <a
                                class="dropdown-toggle list-group-item list-group-item-action @if(request()->is('cities') || request()->is('cities/create')) active @else text-primary @endif"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                Cities
                            </a>
                            <div class="dropdown-menu">
                                <!-- Dropdown menu links -->
                                <li class="m-2 list-group-item @if(request()->is('cities/create')) active @else text-primary @endif">
                                    <a
                                        class="p-0 m-0 @if(request()->is('cities/create')) text-white @else nav-link @endif"
                                        href="{{ route('cities.create') }}">
                                        Add City
                                    </a>
                                </li>
                                <li class="m-2 list-group-item @if(request()->is('cities')) active @else text-primary @endif">
                                    <a
                                        class="p-0 m-0 @if(request()->is('cities')) text-white @else nav-link @endif"
                                        href="{{ route('cities.index') }}">
                                        View all cities
                                    </a>
                                </li>
                            </div>
                        </div>
                        <li class="list-group-item list-group-item-action my-nav-link @if(request()->is('orders')) active @else text-primary @endif">
                            <a
                                class="nav-link p-0 m-0"
                                href="{{ route('orders.index') }}">
                                Orders ({{auth()->user()->unreadNotifications()->count()}})
                            </a>
                        </li>
                    @endif
                @endauth
                @if(! request()->is('/'))
                    <li class="list-group-item list-group-item-action my-nav-link @if(request()->is('/')) active @else text-primary @endif">
                        <a
                            class="nav-link p-0 m-0"
                            href="{{ url('/') }}">
                            Visit to home Page
                            <i class="fa fa-home" ></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
