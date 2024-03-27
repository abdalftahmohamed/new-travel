@extends('admin.layouts.master')
@section('css')
    {{--/*<!-- DataTables -->*/--}}
{{--    <link rel="stylesheet" href="{{URL::asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">--}}
{{--    <link rel="stylesheet"--}}
{{--          href="{{URL::asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">--}}
    <link rel="stylesheet" href="{{URL::asset('admin/plugins/summernote/summernote-bs4.min.css')}}">



    @section('title')
        Invatation
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        Invatation
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
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
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <form method="POST" action="{{route('admin.invitation.send')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Compose New Message</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                               <div class="row">
                                   <div class="col-6">
                                       <div class="form-group">
                                           <input class="form-control"  type="email"  name="email" placeholder="To:">
                                       </div>
                                   </div>
                                   <div class="col-6">
                                       <div class="form-group">
                                           <input class="form-control"  type="text"  name="name" placeholder="Name:">
                                       </div>
                                   </div>
                               </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="subject" placeholder="Subject:">
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control" rows="8" type="text" name="description" placeholder="Object:"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="btn btn-default btn-file">
                                        <i class="fas fa-paperclip"></i> Attachment
                                        <input type="file" multiple name="attachment[]">
                                    </div>
                                    <p class="help-block">Max. 32MB</p>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                                    <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                                </div>
                                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                    </form>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- row closed -->
@endsection
@section('js')

    <!-- Summernote -->
    <script src="{{URL::asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            //Add text editor
            $('#compose-textarea').summernote()
        })
    </script>



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
