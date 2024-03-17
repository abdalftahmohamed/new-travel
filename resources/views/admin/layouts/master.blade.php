<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.layouts.head')
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ URL::asset('admin/dist/img/rehlatiuae.png') }}" alt="AdminLTELogo" height="130" width="120">
    </div>


    @include('admin.layouts.main-header')

    @include('admin.layouts.main-sidebar')


{{--    @yield('page-header')--}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('PageTitle')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">@yield('PageTitle')</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        @yield('content')
        <!-- /.content -->




    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    @include('admin.layouts.footer')


</div>

@include('admin.layouts.footer-scripts')

</body>

</html>
















{{--    <div class="wrapper" style="font-family: 'Cairo', sans-serif" >--}}

{{--        <!--=================================--}}
{{-- preloader -->--}}
{{--        <div id="pre-loader">--}}
{{--            <img src="{{URL::asset('assets/images/pre-loader/loader-0122.svg')}}" alt="">--}}
{{--        </div>--}}

{{--        <!--=================================--}}
{{-- preloader -->--}}

{{--        @include('admin.layouts.main-header')--}}
{{--        @include('admin.layouts.main-sidebar')--}}

{{--        <!--=================================--}}
{{-- Main content -->--}}
{{--        <!-- main-content -->--}}
{{--        <div class="content-wrapper">--}}

{{--          @yield('page-header')--}}
{{--<div class="page-title">--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-6">--}}
{{--            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">@yield('PageTitle')</h4>--}}
{{--        </div>--}}
{{--        <div class="col-sm-6">--}}
{{--            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">--}}
{{--                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}" class="default-color">{{trans('main_trans.Dashboard')}}</a></li>--}}
{{--                <li class="breadcrumb-item active">@yield('PageTitle')</li>--}}
{{--            </ol>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--            @yield('content')--}}

{{--            <!--=================================--}}
{{-- wrapper -->--}}

{{--            <!--=================================--}}
{{-- footer -->--}}

{{--            @include('admin.layouts.footer')--}}
{{--        </div><!-- main content wrapper end-->--}}
{{--    </div>--}}
{{--    </div>--}}
{{--    </div>--}}

{{--    <!--=================================--}}
{{-- footer -->--}}

{{--    @include('admin.layouts.footer-scripts')--}}

{{--</body>--}}

{{--</html>--}}
