@extends('admin.layouts.master')
@section('css')
    {{--/*<!-- DataTables -->*/--}}
    <link rel="stylesheet" href="{{URL::asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{URL::asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">



    @section('title')
        Show contact
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        Show contact
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
                            <table id="example1" class="table table-bordered table-scontacted">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>contact name</th>
                                    <th>contact email</th>
                                    <th>contact description</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{mb_substr($contact->description,0,60). '...'}}</td>
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
                                                        <form action="{{route('admin.contact.destroy')}}" method="POST"
                                                              style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{$contact->id}}">
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
