@extends('admin.layouts.master')
@section('css')
    @section('title')
        department Edit
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        department Edit
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
                                <a href="{{route('department.index')}}"
                                   class="btn btn-primary waves-effect waves-light float-end mb-4">Back</a>
                            </h4>
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
                            <form class="custom-validation" action="{{route('department.update')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{$department->id}}">

                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="department_name"
                                           value="{{$department->department_name,old('department_name')}}"
                                           class="form-control" required placeholder="enter department name here..."/>
                                    @error('department_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label>Description</label>
                                    <div>
                                        <textarea name="department_description" class="form-control" rows="5"
                                                  placeholder="enter the description here ...">{{$department->department_description,old('department_description')}}</textarea>
                                    </div>
                                    @error('department_description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Save
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            function previewFile(input, target) {
                input.change(function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(target).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files[0]);
                });
            }
            // Call the function for each file input
            previewFile($('#image'), '#showImage');
            previewFile($('#images'), '#showImages');
            previewFile($('#documents'), '#showDocuments');
            previewFile($('#videos'), '#showVideos');
        });
    </script>

@endsection
