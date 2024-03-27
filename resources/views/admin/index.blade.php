@extends('admin.layouts.master')
@section('css')

    @section('title')
        Dashboard
    @stop
@endsection
{{--@section('page-header')--}}
    <!-- breadcrumb -->
    @section('PageTitle')
        Dashboard
    @stop
    <!-- breadcrumb -->
{{--@endsection--}}
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Recently Total</span>
                            <span class="info-box-number">
                  {{\App\Models\Cart::where([['status',1]])->get()->sum('total')}}
                                           <small>$</small>

                </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Recently Total Pending</span>
                            <span class="info-box-number">
                                {{\App\Models\Cart::where([['status',0]])->get()->sum('total')}}
                             <small>$</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Booking</span>
                            <span class="info-box-number">
                       {{\App\Models\Cart::where([['status',0]])->get()->count()}}

                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Trips</span>
                            <span class="info-box-number">{{\App\Models\Trip::whereStatus(1)->get()->count()}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">All Subscriptions</span>
                            <span class="info-box-number">
                  {{\App\Models\Client::get()->count()}}

                </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Active Users</span>
                            <span class="info-box-number">
                                {{\App\Models\Client::where([['status',1]])->get()->count()}}

                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">All Coupons</span>
                            <span class="info-box-number">
                       {{\App\Models\Coupon::where([['status',1]])->get()->count()}}

                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Review Trips</span>
                            <span class="info-box-number">{{\App\Models\Review::where('trip_id','!=',null)->get()->count()}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>

            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">All Favourite</span>
                            <span class="info-box-number">
                  {{\App\Models\trips_clients_favorite::get()->count()}}

                </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">All Affiliate Company</span>
                            <span class="info-box-number">
                                {{\App\Models\Company::get()->count()}}

                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">All Affiliate Marketing</span>
                            <span class="info-box-number">
                       {{\App\Models\Coupon::where([['status',1]])->get()->count()}}

                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">All Payment Affiliate Marketing</span>
                            <span class="info-box-number">{{\App\Models\Review::where('blog_id','!=',null)->get()->count()}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">

                    <!-- /.card -->
                    <div class="row">

                        <div class="col-md-12">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Latest Members</h3>

                                    <div class="card-tools">
                                        <span class="badge badge-danger">8 New Members</span>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="users-list clearfix">
                                        <div class="row">
                                            @foreach($clients->slice(-12) as $client)
                                                <div class="col-2" style="padding-left: 30px">
                                                    <li>
                                                        <img
                                                            style="width: 100px; height: 100px; border-radius: 100px"
                                                            src="{{(! empty($client->image_path)) ? asset('attachments/clients/'.$client->id.'/'.$client->image_path ) : asset('admin/dist/img/no_image.jpg') }}"
                                                            alt="User Image">
                                                        <br>
                                                        @if($client->status === 1)
                                                            <span class="badge badge-success">active</span>
                                                        @else
                                                            <span class="badge badge-danger">inActive</span>
                                                        @endif
                                                        <strong><a class="users-list-name" href="#">{{$client->name}}</a></strong>
                                                        <a class="users-list-name" href="#">{{$client->email}}</a>
                                                        <span class="users-list-date">{{$client->created_at}}</span>
                                                    </li>
                                                </div>
                                            @endforeach

                                        </div>

                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="{{route('admin.client.index')}}">View All Clients</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!--/.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- TABLE: LATEST Trips -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Latest Booking Trips</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Client name</th>
                                        <th>Client Email</th>
                                        <th>Trip Name</th>
                                        <th>Trip Image</th>
                                        <th>Status</th>
                                        <th>Trip Price</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $cart)
                                        <tr>
                                            <td><a href="admin/pages/examples/invoice.html">OR9842</a></td>
                                            <td>{{$cart->client->name ?? 'name'}}</td>
                                            <td>{{$cart->client->email ?? 'email'}}</td>
                                            <td>{{$cart->trip->name}}</td>
                                            <td>
                                                <img class="img-fluid mb-2 rounded-circle" style="width: 100px; height: 100px;" src="{{(! empty($cart->trip->image_path)) ? asset('attachments/trips/'.$cart->trip->id.'/'.$cart->trip->image_path ) : asset('admin/dist/img/no_image.jpg') }}" alt="client image">

                                            </td>

                                            @if($cart->status === 1)
                                                <td><span class="badge badge-success">Shipped</span></td>
                                            @else
                                                <td><span class="badge badge-warning">pending</span></td>
                                            @endif
                                            <td>{{$cart->total}}</td>
                                            <td>{{$cart->date}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Trips</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-12">
                    <!-- Small Box (Stat card) -->
                    <h5 class="mb-2 mt-4">Small Box</h5>
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{\App\Models\Country::get()->count()}}</h3>

                                    <p>All Country</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <a href="{{route('admin.country.index')}}" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{\App\Models\City::get()->count()}}<sup style="font-size: 20px"></sup></h3>

                                    <p>All City</p>
                                </div>
                                <div class="icon">
{{--                                    <i class="ion ion-stats-bars"></i>--}}
                                    <i class="fas fa-user-plus"></i>

                                </div>
                                <a href="{{route('admin.city.index')}}" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{\App\Models\Company::get()->count()}}</h3>

                                    <p>All Affiliate Co.</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <a href="{{route('admin.company.index')}}" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{\App\Models\Department::get()->count()}}</h3>

                                    <p>All Category</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <a href="{{route('admin.department.index')}}" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box mb-3 bg-warning">
                        <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><strong>All Trip</strong></span>
                            <span class="info-box-number">{{\App\Models\Trip::get()->count()}}</span>
                            <a href="{{route('admin.trip.index')}}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="far fa-heart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><strong>All Trip Offer</strong></span>
                            <span class="info-box-number">{{\App\Models\Offer::get()->count()}}</span>
                            <a href="{{route('admin.offer.index')}}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><strong>All Blog</strong></span>
                            <span class="info-box-number">{{\App\Models\Blog::get()->count()}}</span>
                            <a href="{{route('admin.blog.index')}}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="far fa-comment"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><strong>All User</strong></span>
                            <span class="info-box-number">{{\App\Models\Client::get()->count()}}</span>
                            <a href="{{route('admin.client.index')}}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-md-3">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box mb-3 bg-warning">
                        <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><strong>All Trip</strong></span>
                            <span class="info-box-number">{{\App\Models\Trip::get()->count()}}</span>
                            <a href="{{route('admin.trip.index')}}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="far fa-heart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><strong>All Trip Offer</strong></span>
                            <span class="info-box-number">{{\App\Models\Offer::get()->count()}}</span>
                            <a href="{{route('admin.offer.index')}}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><strong>All Blog</strong></span>
                            <span class="info-box-number">{{\App\Models\Blog::get()->count()}}</span>
                            <a href="{{route('admin.blog.index')}}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="far fa-comment"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><strong>All User</strong></span>
                            <span class="info-box-number">{{\App\Models\Client::get()->count()}}</span>
                            <a href="{{route('admin.client.index')}}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('js')

    <!-- ChartJS -->
    <script src="{{URL::asset('admin/plugins/chart.js/Chart.min.js')}}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{URL::asset('admin/dist/js/pages/dashboard2.js')}}"></script>
@endsection
