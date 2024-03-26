@extends('client.layouts.master')
@section('css')
    {{--/*<!-- DataTables -->*/--}}
    <link rel="stylesheet" href="{{URL::asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{URL::asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">



    @section('title')
        blogs
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        blogs
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
                            <table id="example1" class="table table-bordered table-sbloged">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>blog name</th>
                                    <th>blog description</th>
                                    <th>image</th>
                                    <th>Show</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$blog->name}}</td>
                                        <td>{{mb_substr($blog->description,0,40). '...'}}</td>
{{--                                        <td>{{$blog->cus_rating}}</td>--}}
                                        <td>
                                            <img class="img-fluid mb-2 rounded-circle " style="width: 70px; height: 70px;" src="{{(! empty($blog->image_path)) ? asset('attachments/blogs/'.$blog->id.'/'.$blog->image_path ) : asset('admin/dist/img/no_image.jpg') }}" alt="client image">
                                        </td>
                                        <td>
                                            <a class="dropdown-item" href="{{ route('blog.show', $blog->id) }}" style="display: flex;padding-top: 20px; justify-content: center; align-items: center;">
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
                                                           href="{{route('client.blog.rate', $blog->id)}}">Rating Now</a>                                                        <div class="dropdown-divider"></div>
                                                        <form action="#" method="POST"
                                                              style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{$blog->id}}">
                                                            <button type="submit"
                                                                    onclick="return confirm('Are You Sure')"
                                                                    class="dropdown-item">#####
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
