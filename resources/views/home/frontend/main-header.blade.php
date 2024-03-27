<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Rehlatiuae</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
                <form action="{{route('searchTripWeb')}}" method="GET">
                    @csrf
                    <div class="row g-3">
                        <div class="col-10">
                            <input type="search" name="name" class="form-control form-control-lg" placeholder="Search by activities and destinations...">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>

                </form>
{{--            </div>--}}
{{--        </div>--}}

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">

{{--                class="nav-item active"--}}
                <li @yield('home')>
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li @yield('Shop')><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                <li @yield('aboutUs')><a class="nav-link" href="{{ route('aboutUs') }}">About us</a></li>
                <li @yield('blog')><a class="nav-link" href="{{route('blog')}}">Blog</a></li>
{{--                <li @yield('Services')><a class="nav-link" href="{{ URL::asset('admin/home/services.html') }}">Services</a></li>--}}
                <li @yield('Contact us')><a class="nav-link" href="{{route('contactNewUs') }}">Contact us</a></li>
{{--                @if (Route::has('login'))--}}
{{--                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">--}}
{{--                        @auth('web')--}}
{{--                            <li><a class="nav-link" href="{{ url('/admin/dashboard') }}">Dashboard</a></li>--}}
{{--                        @else--}}
{{--                            <li><a class="nav-link" href="{{ route('login') }}">Log In</a></li>--}}
{{--                            --}}{{--                            @if (Route::has('register'))--}}
{{--                            --}}{{--                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>--}}
{{--                            --}}{{--                            @endif--}}
{{--                        @endauth--}}
{{--                    </div>--}}
{{--                @endif--}}


{{--                @if (Route::has('login.client'))--}}
{{--                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">--}}
{{--                        @auth('client')--}}
{{--                            <li><a class="nav-link" href="{{ url('/client/dashboard') }}">Client Dashboard</a></li>--}}
{{--                        @else--}}
{{--                            <li><a class="nav-link" href="{{ route('login.client') }}">Client Log In</a></li>--}}
{{--                            --}}{{--                            @if (Route::has('register'))--}}
{{--                            --}}{{--                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>--}}
{{--                            --}}{{--                            @endif--}}
{{--                        @endauth--}}
{{--                    </div>--}}
{{--                @endif--}}
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                @if (Route::has('login.client'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth('client')
                            <li><a class="nav-link" href="{{ url('/client/dashboard') }}"><img src="{{ URL::asset('admin/home/images/user.svg') }}"></a></li>
                        @else
                            <li><a class="nav-link" href="{{ route('login.client') }}"><img src="{{ URL::asset('admin/home/images/user.svg') }}"></a></li>
                            {{--                            @if (Route::has('register'))--}}
                            {{--                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>--}}
                            {{--                            @endif--}}
                        @endauth
                    </div>
                @endif

{{--                <li><a class="nav-link" href="#"><img src="{{ URL::asset('admin/home/images/user.svg') }}"></a></li>--}}
                <li><a class="nav-link" href="{{ route('cart') }}"><img src="{{ URL::asset('admin/home/images/cart.svg') }}"></a></li>
            </ul>



        </div>
    </div>

</nav>
<!-- End Header/Navigation -->
