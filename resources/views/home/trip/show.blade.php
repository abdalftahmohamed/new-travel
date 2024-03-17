@extends('home.frontend.master')
@section('css')

@endsection
{{--@section('page-header')--}}
<!-- breadcrumb -->
@section('trip')
    class="nav-item active"
@stop
@section('title1')
    Trip
@stop
@section('title2')
    Show
@stop
@section('description')
    Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.
@stop
<!-- breadcrumb -->
{{--@endsection--}}
@section('content')
    <!-- Main content -->

    <!-- Start Trip Section -->
    <div class="blog-section">
        <div class="container">
            <div class="row">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <!-- info row -->
            <div class="row trip-info">
                <!-- /.col -->
                <div class="col-sm-9 trip-col">
                        <img class="img-fluid mb-2 " style="width: 100%; height: 93%;"
                             src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path ) : asset('admin/dist/img/no_image.jpg') }}" alt="trip image">
                </div>
                <!-- /.col -->
                <div class="col-md-2 col-lg-3 mb-5 mb-lg-0">
                        <div class="row mb-5">
                        <div class="col-md-12">
                            <div class="border p-4 rounded" role="alert">
                                <h2 class="mb-4 section-title">{{$trip->name ?? "name"}}</h2>
                                <hr>
                                <p class="mb-4">USD   {{$trip->old_price ?? "Older"}}</p>
                                <p><a href="{{route('trip.book',$trip->id)}}" class="btn">Book Now</a></p>
                            </div>
                        </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="border p-4 rounded" role="alert">
                                    <h2 class="mb-4 section-title">Insiders' Tips</h2>
                                    <hr>
                                    <p class="mb-4">If you want to maximize your time on the rides and minimize waiting in lines, consider upgrading to an Express Pass. It's a bit extra, but it can make a big difference during peak hours, ensuring you get to experience all your favorite attractions without the long waits!</p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <br>
            <br>

                    <h2 class="section-title">Why Choose this trip</h2>
                    <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/truck.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <strong>Instant Confirmation</strong>
                            </div>
                        </div>


                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/bag.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <strong>E-Tickets Accepted</strong>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/support.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <strong>Skip The Line Access</strong>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 col-lg-3 mb-4">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/return.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <strong>Flexible Tickets</strong>
                            </div>
                        </div>

                    </div>




            <hr>
            <p><strong>{{$trip->trip_description ?? "trip description..."}}</strong></p>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">More  Trips Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                            <div id="accordion">
                            @foreach($addresses as $address)
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                                    {{$address->name}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                {{$address->description}}
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">More pictures of trips</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">

                                    <div class="carousel-item active">
                                        <img class="d-block w-100" style="width: 500px;height: 550px;"
                                             src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path ) : asset('admin/dist/img/no_image.jpg') }}"                                             alt="First slide">
                                    </div>
                                    @foreach($images as $image)
                                        <div class="carousel-item">
                                            <img class="d-block w-100" style="width: 500px;height: 550px;"
                                                 src="{{(! empty($image->image_path)) ? asset('attachments/images/trips/'.$trip->id.'/'.$image->image_path) : asset('admin/dist/img/no_image.jpg') }}"                                             alt="First slide">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-left"></i>
                    </span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-right"></i>
                    </span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

            <hr>
{{--            <div class="row">--}}
{{--                <div class="col-2">--}}
{{--                    <form action="{{route('client.trip.cartOlder')}}" method="GET">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="trip_id" value="{{$trip->id}}">--}}
{{--                        <input type="hidden" name="old_price" value="{{$trip->old_price}}">--}}
{{--                        <button type="submit" onclick="return confirm('Are You Sure to Add To Cart For Older Price Now ...?')"  class="btn btn-success waves-effect waves-light float-end mb-4">Add To Cart For Older</button>--}}
{{--                    </form>--}}
{{--                </div>--}}

{{--                <div class="col-2">--}}
{{--                    <form action="{{route('client.trip.cartYounger')}}" method="GET">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="trip_id" value="{{$trip->id}}">--}}
{{--                        <input type="hidden" name="young_price" value="{{$trip->young_price}}">--}}
{{--                        <button type="submit" onclick="return confirm('Are You Sure to Add To Cart For Younger Price Now ...?')"  class="btn btn-success waves-effect waves-light float-end mb-4">Add To Cart For Younger</button>--}}
{{--                    </form>--}}
{{--                </div>--}}

{{--            </div>--}}

        </div>
    </div>

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
                                                <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

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
                                                <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

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
                                                <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->

    <hr>
<h2>Location</h2>
{{--    <div id="googleMap" style="width:100%;height:400px;"></div>--}}
    <p>You May Also Like
        Best offer</p>
    <hr>
    <h2>{{$trip->name}}</h2>
    <!-- Start Product Section -->
    <div class="product-section">
        <h1>You May Also Like</h1>
        <hr>
        <br>
        <div class="row">
            <!-- Start Column 2 -->
            @foreach($BestOfferstrips->slice(-3) as $trip)
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="{{ route('trip.show', $trip->id) }}">
                        <img style="width: 300px; height: 300px"
                             src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path) : asset('admin/dist/img/no_image.jpg') }}"
                             class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{$trip->name}}</h3>
                        <strong class="product-price">${{$trip->old_price}}</strong>

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

@endsection
@section('js')
{{--   <script>--}}
{{--        function myMap() {--}}
{{--            var mapProp= {--}}
{{--                center:new google.maps.LatLng(51.508742,-0.120850),--}}
{{--                zoom:5,--}}
{{--            };--}}
{{--            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);--}}
{{--        }--}}
{{--    </script>--}}
{{--    <script--}}
{{--        src="https://maps.app.goo.gl/MCqpGy8dtxa5StdJ6"--}}
{{--        src="https://maps.googleapis.com/maps/api/js?key=MCqpGy8dtxa5StdJ6&callback=myMap"--}}
{{--    ></script>--}}

    <script src="{{URL::asset('admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{URL::asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{URL::asset('admin/plugins/chart.js/Chart.min.js')}}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{URL::asset('admin/dist/js/pages/dashboard2.js')}}"></script>
@endsection
