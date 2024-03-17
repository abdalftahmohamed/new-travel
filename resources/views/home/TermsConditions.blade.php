@extends('home.frontend.master')
@section('css')

@endsection
{{--@section('page-header')--}}
<!-- breadcrumb -->
@section('aboutUs')
    class="nav-item active"
@stop
@section('title1')
    Terms
@stop
@section('title2')
    & Conditions
@stop
@section('description')
    Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.
@stop
<!-- breadcrumb -->
{{--@endsection--}}
@section('content')
    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title">Why Choose Us</h2>
                    <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/truck.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Fast &amp; Free Shipping</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/bag.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Easy to Shop</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/support.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>24/7 Support</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{ URL::asset('admin/home/images/return.svg') }}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Hassle Free Returns</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{ URL::asset('admin/home/images/why-choose-us-img.jpg') }}" alt="Image" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start Team Section -->
    <div class="untree_co-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-lg-5 mx-auto text-center">
                    <h2 class="section-title">Our Team</h2>
                </div>
            </div>

            <div class="row">

                <!-- Start Column 1 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="{{ URL::asset('admin/home/images/person_1.jpg') }}" class="img-fluid mb-5">
                    <h3 clas><a href="#"><span class="">Lawson</span> Arnold</a></h3>
                    <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
                </div>
                <!-- End Column 1 -->

                <!-- Start Column 2 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="{{ URL::asset('admin/home/images/person_2.jpg') }}" class="img-fluid mb-5">

                    <h3 clas><a href="#"><span class="">Jeremy</span> Walker</a></h3>
                    <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>

                </div>
                <!-- End Column 2 -->

                <!-- Start Column 3 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="{{ URL::asset('admin/home/images/person_3.jpg') }}" class="img-fluid mb-5">
                    <h3 clas><a href="#"><span class="">Patrik</span> White</a></h3>
                    <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
                </div>
                <!-- End Column 3 -->

                <!-- Start Column 4 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="{{ URL::asset('admin/home/images/person_4.jpg') }}" class="img-fluid mb-5">

                    <h3 clas><a href="#"><span class="">Kathryn</span> Ryan</a></h3>
                    <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>


                </div>
                <!-- End Column 4 -->



            </div>
        </div>
    </div>
    <!-- End Team Section -->

@endsection
@section('js')

    <!-- ChartJS -->
    <script src="{{URL::asset('admin/plugins/chart.js/Chart.min.js')}}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{URL::asset('admin/dist/js/pages/dashboard2.js')}}"></script>
@endsection
