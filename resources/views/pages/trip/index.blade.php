@extends('admin.layouts.master')
@section('css')
    {{--/*<!-- DataTables -->*/--}}
    <link rel="stylesheet" href="{{URL::asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{URL::asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">



    @section('title')
        Create trip
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        Create trip
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
                        <div class="card-header">
                            <h4>
                                <a href="{{route('admin.trip.create')}}"
                                   class="btn btn-primary waves-effect waves-light float-end mb-4">Create trip</a>
                            </h4>

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


                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>status</th>
                                    <th>name</th>
{{--                                    <th>trip date</th>--}}
                                    <th>price1</th>
                                    <th>price2</th>
                                    <th>trip description</th>
{{--                                    <th>customer rating</th>--}}
                                    <th>Image</th>
                                    <th>Show</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trips as $trip)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if($trip->status === 1)
                                                <span class="badge badge-success">active</span>
                                            @else
                                                <span class="badge badge-danger">inActive</span>
                                            @endif
                                        </td>
                                        <td>{{$trip->name}}</td>
{{--                                        <td>{{$trip->trip_date}}</td>--}}
                                        <td>{{$trip->old_price}}</td>
                                        <td>{{$trip->young_price}}</td>
                                        <td>{{mb_substr($trip->trip_description,0,40). '...'}}</td>
{{--                                        <td>{{$trip->cus_rating}}</td>--}}
                                        <td>{{$trip->company->name}}</td>
                                        <td>
                                            <img class="img-fluid mb-2 " style="width: 150px; height: 150px;" src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path ) : asset('admin/dist/img/no_image.jpg') }}" alt="client image">
                                        </td>
                                        <td>
                                            <a class="dropdown-item" href="{{ route('admin.trip.show', $trip->id) }}" style="display: flex;padding-top: 20px; justify-content: center; align-items: center;">
                                                <svg width="35"  height="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="show-icon">
                                                        <path id="eye" d="M12 2C6.485 2 2 6.485 2 12s4.485 10 10 10 10-4.485 10-10S17.515 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#7DB00E"/>
                                                        <path id="pupil" d="M12 4c1.74 0 3.41.56 4.79 1.59c.24.22.24.58 0 .8C15.41 7.44 13.75 8 12 8s-3.41-.56-4.79-1.61c-.24-.22-.24-.58 0-.8C8.59 4.56 10.25 4 12 4zm0 10c-1.66 0-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3s-1.34 3-3 3z" fill="#7DB00E"/>
                                                    </g>
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="margin">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary "
                                                            data-toggle="dropdown">Action
                                                    </button>
                                                    <button type="button" class="btn btn-success dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item"
                                                           href="{{route('admin.trip.edit', $trip->id)}}">Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <form action="{{route('admin.trip.destroy')}}" method="POST"
                                                              style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{$trip->id}}">
                                                            <button type="submit"
                                                                    onclick="return confirm('Are You Sure')"
                                                                    class="dropdown-item">Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

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
