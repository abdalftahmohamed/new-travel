@extends('admin.layouts.master')
@section('css')
    @section('title')
        trip Edit
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        trip Edit
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
                                <a href="{{route('trip.index')}}"
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
                            <form class="custom-validation" action="{{route('trip.update')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{$trip->id}}">

                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name"
                                           value="{{$trip->name,old('name')}}"
                                           class="form-control" required placeholder="enter trip name here..."/>
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label>Description</label>
                                    <div>
                                        <textarea name="trip_description" class="form-control" rows="5"
                                                  placeholder="enter the description here ...">{{$trip->trip_description,old('trip_description')}}</textarea>
                                    </div>
                                    @error('trip_description')
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


@endsection
