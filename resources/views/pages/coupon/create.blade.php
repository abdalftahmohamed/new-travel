@extends('admin.layouts.master')
@section('css')
    {{--/*<!-- DataTables -->*/--}}
    @section('title')
        Create coupon
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        Create coupon
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
{{--                            <h4>--}}
{{--                                <a href="{{route('admin.coupon.index')}}"--}}
{{--                                   class="btn btn-primary waves-effect waves-light float-end mb-4">Back</a>--}}
{{--                            </h4>--}}
{{--                            --}}{{--                            <br>--}}
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


                        <!-- /.card-header-form-create -->
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="custom-validation" action="{{route('admin.coupon.store')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <!-- trip -->
                                    <div class="col-12">
                                        <label for="trip_id">trip</label>
                                        <select id="trip_id" name="trip_id" class="form-control" required>
                                            <option value="" disabled selected>Select Here</option>
                                            @foreach($trips as $trip)
                                                <option value="{{ $trip->id }}" {{ old('trip') == $trip ? 'selected' : '' }}>{{ $trip->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('trip_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label>coupon name</label>
                                        <input type="text" name="coupon_name" value="{{old('coupon_name')}}"
                                               class="form-control" required placeholder="enter coupon coupon_name here..."/>
                                        @error('coupon_name')
                                        <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
{{--                                <div class="row">--}}
{{--                                    <div class="col-12">--}}
{{--                                        <label>coupon amount</label>--}}
{{--                                        <input type="number" name="coupon_amount" value="{{old('coupon_amount')}}"--}}
{{--                                               class="form-control" required placeholder="enter coupon coupon amount here..."/>--}}
{{--                                        @error('coupon_amount')--}}
{{--                                        <span class="text-danger" role="alert">--}}
{{--                                        <strong>{{$message}}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                                <div class="row">
                                    <div class="col-12">
                                        <label>coupon amount</label>
                                        <select name="coupon_amount" class="form-control" required>
                                            <option value="" selected disabled>Select coupon amount...</option>
                                            @for ($i = 1; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ old('coupon_amount') == $i ? 'selected' : '' }}>{{ $i }} %</option>
                                            @endfor
                                        </select>
                                        @error('coupon_amount')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label>coupon start</label>
                                        <input type="date" name="coupon_start" value="{{old('coupon_start')}}"
                                               class="form-control" required placeholder="enter coupon coupon start here..."/>
                                        @error('coupon_start')
                                        <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label>coupon end</label>
                                        <input type="date" name="coupon_end" value="{{old('coupon_end')}}"
                                               class="form-control" required placeholder="enter coupon coupon end here..."/>
                                        @error('coupon_end')
                                        <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label>coupon status</label>
                                        <select name="status" class="form-control" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option
                                                value="1" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                active
                                            </option>
                                            <option
                                                value="0" {{ old('status') == 'inActive' ? 'selected' : '' }}>
                                                inActive
                                            </option>
                                        </select>
                                        @error('status')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <hr>

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

    <!-- DataTables  & Plugins -->

@endsection
