@extends('home.frontend.master')
@section('css')
    <style>
        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .badge-success {
            color: #fff;
            background-color: #3dad1e;
        }
    </style>

@endsection
{{--@section('page-header')--}}
<!-- breadcrumb -->
@section('home')
    class="nav-item active"
@stop
@section('title1')
    Discover Incredible
@stop
@section('title2')
    Experiences Worldwide
@stop
@section('description')
    The world's best experiences curated just for you.
@stop
<!-- breadcrumb -->
{{--@endsection--}}
@section('content')
    <!-- Main content -->
    <!-- Start Product Section -->
{{--    /*<link href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@3.2.0/css/mdb.min.css" rel="stylesheet">*/--}}


    <!-- Start Hero Section -->
    <div class="hero">

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>@yield('title1')<span clsas="d-block">@yield('title2')</span></h1>
                        <p class="mb-4">@yield('description')</p>
                        <p><a href="{{route('home')}}" class="btn btn-secondary me-2">Top Destinations</a><a href="{{route('home')}}" class="btn btn-white-outline">Explore</a></p>

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







    <div class="product-section">
        <h1>Explore World's Top Destinations</h1>
        <hr>
        <br>
        <div class="row">

            <!-- Start Column 2 -->
            @foreach($TopDestinationtrips->slice(-6) as $city)
                <div class="col-16 col-md-4 col-lg-2 mb-5 mb-md-0">
                    <a class="product-item" href="{{route('showTravelCity',$city->id)}}">
                        <img style="width: 250px; height: 250px; border-radius: 8px"
                             src="{{(! empty($city->image_path)) ? asset('attachments/citys/'.$city->id.'/'.$city->image_path) : asset('admin/dist/img/no_image.jpg') }}"
                             class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{$city->name}}</h3>
{{--                        <strong class="product-price">{{$city->description}}</strong>--}}

                        <span class="icon-cross">
								<img
                                    src="{{ URL::asset('admin/home/images/Eye (1).svg') }}" class="img-fluid">
							</span>
                    </a>
                </div>
            @endforeach
            <!-- End Column 2 -->
        </div>
    </div>
    <!-- End Product Section -->


    <!-- Start Product Section -->
    <div class="product-section">
        <h1>Rehlatyuae Best Offer's</h1>
        <hr>
        <br>
        <div class="row">
            <!-- Start Column 2 -->
            @foreach($BestOfferstrips->slice(-3) as $trip)
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="{{ route('trip.show', $trip->id) }}">
                        <img style="width: 300px; height: 300px; border-radius: 8px"
                             src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path) : asset('admin/dist/img/no_image.jpg') }}"
                             class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{$trip->name}}</h3>
                        <strong class="mb-4" >USD<del><strong style="color: #8F93A2;">{{$trip->old_new_price ?? "0"}}</strong> </del></strong>
                        <strong class="mb-4"> <span class="right badge badge-success">save{{$trip->saving ?? "0"}}<small>%</small></span></strong>
                        <p class="mb-4"><strong>USD   {{$trip->old_price ?? "Older"}} </strong>/person<small></small></p>
        {{--
{{--<strong class="product-price">${{$trip->old_price}}</strong>--}}

                        <span class="icon-cross">
								<img src="{{ URL::asset('admin/home/images/cross.svg') }}" class="img-fluid">
							</span>
                    </a>
                </div>
            @endforeach

            <!-- End Column 2 -->
            <!-- Start Column 1 -->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. </p>
                <p><a href="{{ URL::asset('admin/home/shop.html') }}" class="btn">Explore</a></p>
            </div>
            <!-- End Column 1 -->
        </div>
{{--        <div class="container">--}}
{{--          --}}
{{--        </div>--}}
    </div>
    <!-- End Product Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <h1>Rehlatyuae Best Trips</h1>
        <hr>
        <br>
        <div class="row">
            <!-- Start Column 2 -->
            @foreach($BestTripstrips->slice(-3) as $trip)
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="{{ route('trip.show', $trip->id) }}">
                        <img style="width: 300px; height: 300px; border-radius: 8px"
                             src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path) : asset('admin/dist/img/no_image.jpg') }}"
                             class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{$trip->name}}</h3>
                                <strong class="mb-4" >USD<del><strong style="color: #8F93A2;">{{$trip->old_new_price ?? "0"}}</strong> </del></strong>
                        <strong class="mb-4"> <span class="right badge badge-success">save{{$trip->saving ?? "0"}}<small>%</small></span></strong>
                        <p class="mb-4"><strong>USD   {{$trip->old_price ?? "Older"}} </strong>/person<small></small></p>
{{--                        <strong class="product-price">${{$trip->old_price}}</strong>--}}

                        <span class="icon-cross">
								<img src="{{ URL::asset('admin/home/images/cross.svg') }}" class="img-fluid">
							</span>
                    </a>
                </div>
            @endforeach

            <!-- End Column 2 -->
            <!-- Start Column 1 -->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. </p>
                <p><a href="{{ URL::asset('admin/home/shop.html') }}" class="btn">Explore</a></p>
            </div>
            <!-- End Column 1 -->
        </div>
    </div>
    <!-- End Product Section -->




    <!-- Start Product Section -->
    <div class="product-section">
        <h1>Rehlatyuae Popular Experiences</h1>
        <hr>
        <br>
        <div class="row">
            <!-- Start Column 2 -->
            @foreach($PopularExperiencetrips->slice(-3) as $trip)
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="{{ route('trip.show', $trip->id) }}">
                        <img style="width: 300px; height: 300px; border-radius: 8px"
                             src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path) : asset('admin/dist/img/no_image.jpg') }}"
                             class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{$trip->name}}</h3>
                                <strong class="mb-4" >USD<del><strong style="color: #8F93A2;">{{$trip->old_new_price ?? "0"}}</strong> </del></strong>
                        <strong class="mb-4"> <span class="right badge badge-success">save{{$trip->saving ?? "0"}}<small>%</small></span></strong>
                        <p class="mb-4"><strong>USD   {{$trip->old_price ?? "Older"}} </strong>/person<small></small></p>
{{--                        <strong class="product-price">${{$trip->old_price}}</strong>--}}

                        <span class="icon-cross">
								<img src="{{ URL::asset('admin/home/images/cross.svg') }}" class="img-fluid">
							</span>
                    </a>
                </div>
            @endforeach
            <!-- End Column 2 -->
            <!-- Start Column 1 -->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. </p>
                <p><a href="{{ URL::asset('admin/home/shop.html') }}" class="btn">Explore</a></p>
            </div>
            <!-- End Column 1 -->
        </div>

    </div>
    <!-- End Product Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <h1>Rehlatyuae Categories</h1>
        <hr>
        <br>
        <div class="row">
            <!-- Start Column 2 -->
            @foreach($departments->slice(-6) as $department)
                <div class="col-12 col-md-4 col-lg-2 mb-5 mb-md-0">
                    <a class="product-item" href="{{route('showTravelDepartment',$department->id)}}">
                        <img
                            style="width: 150px; height: 150px; border-radius: 8px"
                            src="{{(! empty($department->image_path)) ? asset('attachments/departments/'.$department->id.'/'.$department->image_path) : asset('admin/dist/img/no_image.jpg') }}"
                            class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{$department->name}}</h3>
{{--                        <strong class="product-price">{{$department->description}}</strong>--}}

                        <span class="icon-cross">
								<img src="{{ URL::asset('admin/home/images/Eye (1).svg') }}" class="img-fluid">
							</span>
                    </a>
                </div>
            @endforeach

            <!-- End Column 2 -->

        </div>
    </div>
    <!-- End Product Section -->


    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">Why Choose Us</h2>
                    <p>Why choose us? We will confidently explain it to you with complete confidence and excellence!</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/truck.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Only the finest</h3>
                                <p>At Rehlatyuae, you only find the best. We do the hard work so you don’t have to.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/bag.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Greed is good</h3>
                                <p>With quality, you also get lowest prices, last-minute availability and 24x7 support.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/support.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Experience every flavour</h3>
                                <p>Offbeat or mainstream, a tour or a show, a game or a museum - we have ‘em all.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/return.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>No pain, only gain</h3>
                                <p>Didn't love it? We'll save you your money. Not cocky, just confident.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{ URL::asset('admin/home/images/Rehlatiuae-foter-1.jpg') }}" alt="Image" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start We Help Section -->
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="imgs-grid">
                        <div class="grid grid-1"><img src="{{ URL::asset('admin/home/images/Rehlatiuae-foter-4.jpg') }}" alt="Untree.co"></div>
                        <div class="grid grid-2"><img src="{{ URL::asset('admin/home/images/Rehlatiuae-foter-3.jpg') }}" alt="Untree.co"></div>
                        <div class="grid grid-3"><img src="{{ URL::asset('admin/home/images/Rehlatiuae-foter-2.jpg') }}" alt="Untree.co"></div>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4">We Help You Make Best Trip</h2>
                    <p>When we say that all the events that we choose are very exciting events because we have a specialized team that lives the experience and evaluates all the events with the utmost precision, as we at Rehlatyuae select the best and most exciting events so that they serve as a unique souvenir value.</p>



                    <ul class="list-unstyled custom-list my-4">
                        <li>Trust: We visit places periodically and make sure that all places are as we describe them in our descriptions.</li>
                        <li>Safety: We at Rehlatyuae do regular follow-up and conduct some experiments to ensure that all areas are safe for you and your family. We have plans to ensure the best places for you and your family.</li>
                        <li>Quick booking: In just a few steps you will be able to book all the exciting events for you and your family and you can also share the fun with them.</li>
                        <li>Save money: We at Rahlatyuae offer many discounts and many events at the most reasonable prices at very competitive prices.</li>
                    </ul>
                    <p><a href="{{route('shop')}}" class="btn">Explore</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End We Help Section -->

    <!-- Start Popular Product -->
    <div class="popular-product">
        <div class="container">
            <div class="row">

                @foreach($BestOfferstrips->slice(-3) as $trip)
                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="product-item-sm d-flex">
                        <div class="thumbnail">
                            <img
                                style="width: 150px; height: 150px; border-radius: 8px;"
                                src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path) : asset('admin/dist/img/no_image.jpg') }}"
                                alt="Image" class="img-fluid">
                        </div>
                        <div class="pt-3">
                            <h3>{{$trip->name}}</h3>
                            <strong class="mb-4" >USD<del><strong style="color: #8F93A2;">{{$trip->old_new_price ?? "0"}}</strong> </del></strong>
                            <strong class="mb-4"> <span class="right badge badge-success">save{{$trip->saving ?? "0"}}<small>%</small></span></strong>
                            <br>
                            <label class="mb-4"><strong>USD   {{$trip->old_price ?? "Older"}} </strong>/person<small></small></label>
{{--                            <p>{{mb_substr($trip->trip_description,0,100). '...'}}</p>--}}
                            <p><a href="{{route('trip.book',$trip->id)}}">Book Now</a></p>
                        </div>
                    </div>
                </div>
                @endforeach

{{--                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">--}}
{{--                    <div class="product-item-sm d-flex">--}}
{{--                        <div class="thumbnail">--}}
{{--                            <img src="{{ URL::asset('admin/home/images/product-2.png') }}" alt="Image" class="img-fluid">--}}
{{--                        </div>--}}
{{--                        <div class="pt-3">--}}
{{--                            <h3>Kruzo Aero Chair</h3>--}}
{{--                            <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio </p>--}}
{{--                            <p><a href="#">Read More</a></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">--}}
{{--                    <div class="product-item-sm d-flex">--}}
{{--                        <div class="thumbnail">--}}
{{--                            <img src="{{ URL::asset('admin/home/images/product-3.png') }}" alt="Image" class="img-fluid">--}}
{{--                        </div>--}}
{{--                        <div class="pt-3">--}}
{{--                            <h3>Ergonomic Chair</h3>--}}
{{--                            <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio </p>--}}
{{--                            <p><a href="#">Read More</a></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
        </div>
    </div>
    <!-- End Popular Product -->


    <!-- Start Testimonial Slider -->
    <div class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">Reviews</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">

                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>

                        <div class="testimonial-slider">


                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ URL::asset('admin/home/images/person-1.png') }}" alt="Maria Jones" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Maria Jones</h3>
                                                <span class="position d-block mb-3">Rating 5/5</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->
                            @foreach($reviews as $review)
                                <div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 mx-auto">

                                            <div class="testimonial-block text-center">
                                                <blockquote class="mb-5">
                                                    <p>&rdquo;{{$review->description}}&rdquo;</p>
                                                </blockquote>

                                                <div class="author-info">
                                                    <div class="author-pic">
                                                        <img
                                                            style="width: 80px; height: 80px; border-radius: 8px"
                                                            src="{{(! empty($review->client->image_path)) ? asset('attachments/clients/'.$review->client->id.'/'.$review->client->image_path ) : asset('admin/dist/img/no_image.jpg') }}"
                                                            alt="Maria Jones" class="img-fluid">
                                                    </div>
                                                    <h3 class="font-weight-bold">{{$review->client->name}}</h3>
                                                    <span class="position d-block mb-3">Rating {{$review->stars_numbers}}/5</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->


    <!-- Start Blog Section -->
{{--    <div class="blog-section">--}}
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6">
                    <h2 class="section-title">Recent Blog</h2>
                </div>
                <div class="col-md-6 text-start text-md-end">
                    <a href="{{route('blog')}}" class="more">View All</a>
                </div>
            </div>

            <div class="row">
                @foreach($blogs->slice(-4) as $blog)
                <div class="col-12 col-sm-6 col-md-3 mb-4 mb-md-0">
                    <div class="post-entry">
                        <a href="{{route('blog.show',$blog->id)}}" class="post-thumbnail"><img style="width: 600px; height: 300px; border-radius: 8px"
                                src="{{(! empty($blog->image_path)) ? asset('attachments/blogs/'.$blog->id.'/'.$blog->image_path) : asset('admin/dist/img/no_image.jpg') }}"                                alt="Image" class="img-fluid"></a>
                        <div class="post-content-entry">
                            <h5><a href="#">{{$blog->name}}</a></h5>
                            <p>{{mb_substr($blog->description,0,80). '...'}}<a href="#">Read More</a></p>
{{--                            <div class="meta">--}}
{{--                                <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

{{--    </div>--}}
    <!-- End Blog Section -->

    <!-- Carousel wrapper -->
    <div class="blog-section">
        <div class="container">
            <div id="carouselExampleCaptions" class="carousel slide" data-mdb-ride="carousel" data-mdb-carousel-init>
                <div class="carousel-indicators">
                    <button
                        type="button"
                        data-mdb-target="#carouselExampleCaptions"
                        data-mdb-slide-to="0"
                        class="active"
                        aria-current="true"
                        aria-label="Slide 1"
                    ></button>
                    <button
                        type="button"
                        data-mdb-target="#carouselExampleCaptions"
                        data-mdb-slide-to="1"
                        aria-label="Slide 2"
                    ></button>
                    <button
                        type="button"
                        data-mdb-target="#carouselExampleCaptions"
                        data-mdb-slide-to="2"
                        aria-label="Slide 3"
                    ></button>
                </div>
                <div class="row mb-5">
                    <div class="col-md-6">
                        <h2 class="section-title">Our Partners</h2>
                    </div>
                    <div class="col-md-6 text-start text-md-end">
                        <a href="#" class="more">View All</a>
                    </div>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-mdb-interval="2000">
                        <img
                            style="border-radius: 8px"
                            src="https://mdbcdn.b-cdn.net/img/new/slides/041.webp" class="d-block w-100" alt="Wild Landscape"/>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        </div>
                    </div>
                    @foreach($ourPartners->slice(-6) as $ourPartner)
                    <div class="carousel-item" data-mdb-interval="2000">
                        <img
                            style="width: 1280px; aspect-ratio: auto 1280 / 564; height: 564px; border-radius: 8px"
                            src="{{(! empty($ourPartner->image_path)) ? asset('attachments/ourPartners/'.$ourPartner->id.'/'.$ourPartner->image_path) : asset('admin/dist/img/no_image.jpg') }}"
                            class="d-block " alt="Camera"/>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{$ourPartner->name}}</h5>
                            <p>{{$ourPartner->description}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <!-- ChartJS -->
    <script src="{{URL::asset('admin/plugins/chart.js/Chart.min.js')}}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{URL::asset('admin/dist/js/pages/dashboard2.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@3.2.0/js/mdb.min.js"></script>
    <script>
        // Initialize MDB Carousel
        const { Carousel, initMDB } = mdbUiKit;
        initMDB({ Carousel });
    </script>


@endsection
