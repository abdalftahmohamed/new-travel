@extends('client.layouts.master')
@section('css')
    {{--/*<!-- DataTables -->*/--}}
    <link rel="stylesheet" href="{{URL::asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{URL::asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">



    @section('title')
         Trips
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
         Trips
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
{{--                        <div class="card-header">--}}
{{--                            @if(session('message'))--}}
{{--                                <div class="alert alert-success">--}}
{{--                                    {{session('message')}}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            @if ($errors->any())--}}
{{--                                <div class="alert alert-danger">--}}
{{--                                    <ul>--}}
{{--                                        @foreach ($errors->all() as $error)--}}
{{--                                            <li>{{ $error }}</li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}


                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>trip name</th>
{{--                                    <th>trip date</th>--}}
                                    <th>adult</th>
{{--                                    <th>children</th>--}}
                                    <th>trip description</th>
                                    <th>city</th>
                                    <th>image</th>
                                    <th>Booking</th>
                                    <th>Rating</th>
                                    <th>Show</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trips as $trip)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$trip->name}}</td>
{{--                                        <td>{{$trip->trip_date}}</td>--}}
                                        <td>USD {{$trip->old_price}}</td>
{{--                                        <td>{{$trip->young_price}}</td>--}}
                                        <td>{{mb_substr($trip->trip_description,0,40). '...'}}</td>
                                        <td>{{$trip->city->name}}</td>
                                        <td>
                                            <img class="img-fluid mb-2 " style="width: 100px; height: 100px; border-radius: 8px" src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path ) : asset('admin/dist/img/no_image.jpg') }}" alt="client image">
                                        </td>

                                        <td>
                                            <div class="margin">
                                                <div class="btn-group">
                                                    <form action="{{route('trip.book', $trip->id)}}">
                                                        @csrf
                                                        <button type="submit" value="Book Now" class="btn btn-lg btn-outline-success">Book Now</button>
                                                    </form >
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="margin">
                                                <div class="btn-group">
                                                    <form action="{{route('client.trip.rate', $trip->id)}}">
                                                        @csrf
                                                        <button type="submit" value="Book Now" class="btn btn-lg btn-outline-primary">Rate Now</button>
                                                    </form >
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <a class="dropdown-item" href="{{ route('trip.show', $trip->id) }}" style="display: flex;padding-top: 20px; justify-content: center; align-items: center;">
                                                <svg width="35"  height="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="show-icon">
                                                        <path id="eye" d="M12 2C6.485 2 2 6.485 2 12s4.485 10 10 10 10-4.485 10-10S17.515 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#7DB00E"/>
                                                        <path id="pupil" d="M12 4c1.74 0 3.41.56 4.79 1.59c.24.22.24.58 0 .8C15.41 7.44 13.75 8 12 8s-3.41-.56-4.79-1.61c-.24-.22-.24-.58 0-.8C8.59 4.56 10.25 4 12 4zm0 10c-1.66 0-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3s-1.34 3-3 3z" fill="#7DB00E"/>
                                                    </g>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->



    <!-- row closed -->
@endsection
@section('js')

    <!-- DataTables  & Plugins -->
    <script src="{{URL::asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
