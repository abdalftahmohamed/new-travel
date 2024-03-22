@extends('admin.layouts.master')
@section('css')
    @section('title')
        coupon Edit
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        coupon Edit
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
                                <a href="{{route('admin.coupon.index')}}"
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
                            <form class="custom-validation" action="{{route('admin.coupon.update')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{$coupon->id}}">

{{--                                <div class="row">--}}
{{--                                    <!-- trip -->--}}
{{--                                    <div class="col-12">--}}
{{--                                        <label for="trip_id">trip</label>--}}
{{--                                        <select id="trip_id" name="trip_id" class="form-control" >--}}
{{--                                            <option value="" disabled selected>{{$coupon->trip->name ?? "Select Here"}}</option>--}}
{{--                                            @foreach($trips as $trip)--}}
{{--                                                <option value="{{ $trip->id }}" {{ old('trip') == $trip ? 'selected' : '' }}>{{ $trip->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        @error('trip_id')--}}
{{--                                        <span class="text-danger" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label>coupon name</label>
                                        <input type="text" name="coupon_name" value="{{$coupon->coupon_name,old('coupon_name')}}"
                                               class="form-control"  placeholder="enter coupon coupon_name here..."/>
                                        @error('coupon_name')
                                        <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label>coupon amount</label>
                                        <select name="coupon_amount" class="form-control">
                                            <option value="" selected disabled>{{$coupon->coupon_amount ."%"?? "Select coupon amount..."}}</option>
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
                                        <input type="datetime-local" name="coupon_start" value="{{$coupon->coupon_start,old('coupon_start')}}"
                                               class="form-control"  placeholder="enter coupon coupon start here..."/>
                                        @error('coupon_start')
                                        <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label>coupon end</label>
                                        <input type="datetime-local" name="coupon_end" value="{{$coupon->coupon_end,old('coupon_end')}}"
                                               class="form-control"  placeholder="enter coupon coupon end here..."/>
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
                                        <select name="status" class="form-control" >
                                            @if($coupon->status == 1)
                                                <option selected disabled value="">{{"Active" ?? "Choose..."}}</option>
                                            @else
                                                <option selected disabled value="">{{"InActive" ?? "Choose..."}}</option>
                                            @endif                                            <option
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
@endsection
