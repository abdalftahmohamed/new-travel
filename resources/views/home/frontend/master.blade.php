<!doctype html>
<html lang="en">
<head>
@include('home.frontend.head')
</head>

<body>
@include('home.frontend.main-header')



<!-- Start Hero Section -->
<div class="hero">

    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>@yield('title1')<span clsas="d-block">@yield('title2')</span></h1>
                    <p class="mb-4">@yield('description')</p>
                    <p><a href="{{route('home')}}" class="btn btn-secondary me-2">Top Destinations</a><a href="{{route('home')}}" class="btn btn-white-outline">Explore</a></p>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('shop')}}">
                                <div class="row g-3">
                                    <div class="col-auto">
                                        <input type="search" class="form-control form-control-lg" placeholder="Search by activities and destinations...">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-lg btn-default">
                                            <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </div>

{{--                                    <div class="col-auto">--}}
{{--                                        <button class="btn btn-primary">--}}
{{--                                            <span class="fa fa-paper-plane"></span>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                    <img src="{{ URL::asset('admin/home/images/Rehlatiuae-header.png') }}" class="img-fluid">
                </div>
            </div>

        </div>

    </div>

</div>
<!-- End Hero Section -->



<!-- Main content -->
@yield('content')
<!-- /.content -->




<!-- Start Footer Section -->
@include('home.frontend.footer')
<!-- End Footer Section -->

@include('home.frontend.footer-scripts')

</body>

</html>
