<!doctype html>
<html lang="en">
<head>
@include('home.frontend.head')
</head>

<body>
@include('home.frontend.main-header')




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

<!-- Main content -->
@yield('content')
<!-- /.content -->




<!-- Start Footer Section -->
@include('home.frontend.footer')
<!-- End Footer Section -->

@include('home.frontend.footer-scripts')

</body>

</html>
