@extends('admin.layouts.master')
@section('css')
    @section('title')
        client Edit
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        client Edit
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
                                <a href="{{route('admin.client.index')}}"
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
                            <form class="custom-validation" action="{{route('admin.client.update')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{$client->id}}">

                                <div class="row">
                                    <div class="col-6">
                                        <label>client name</label>
                                        <input type="text" name="name" value="{{$client->name,old('name')}}"
                                               class="form-control"  placeholder="enter client name here..."/>
                                        @error('name')
                                        <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label>client email</label>
                                        <input type="email" name="email" value="{{$client->email,old('email')}}"
                                               class="form-control"  placeholder="enter client email here..."/>
                                        @error('email')
                                        <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label>client phone</label>
                                        <input type="tel" name="phone" value="{{$client->phone,old('phone')}}"
                                               class="form-control"  placeholder="enter client phone here..."/>
                                        @error('phone')
                                        <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="*******" />
                                        @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="*******" />
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label>client address</label>
                                        <input type="text" name="address" value="{{$client->address,old('address')}}"
                                               class="form-control"  placeholder="enter client address here..."/>
                                        @error('address')
                                        <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label>client status</label>
                                        <select name="status" class="form-control" >
                                            @if($client->status == 1)
                                                <option selected disabled value="">{{"Active" ?? "Choose..."}}</option>
                                            @else
                                                <option selected disabled value="">{{"InActive" ?? "Choose..."}}</option>
                                            @endif
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
                                <div class="row">
                                    <div class="col-md-auto">
                                        <div class="DocumentSection_section__3WaJL">
                                            <div class="DocumentSection_sectionTitle__1rl5y">Company Photo
                                                <svg fill="none" viewBox="0 0 64 20"
                                                     class="DocumentEditForm_icon__3iujO">
                                                    <title>pro_icon</title>
                                                    <path fill="#484ADF" fill-rule="evenodd"
                                                          d="M16.052 6.777h-1.607v2.871h1.57c1.027 0 1.6-.5 1.6-1.408-.01-.972-.645-1.463-1.563-1.463zM8.92 6.787H7.33v3.07h1.1c1.263 0 2.017-.309 2.017-1.536 0-.97-.573-1.534-1.526-1.534zM23.683 6.66c-1.171 0-2.053.871-2.053 2.58v1.144c0 1.717.882 2.526 2.053 2.526 1.173 0 2.044-.809 2.044-2.526V9.24c0-1.709-.871-2.58-2.044-2.58z"
                                                          clip-rule="evenodd"></path>
                                                    <path fill="#484ADF" fill-rule="evenodd"
                                                          d="M27.117 10.384c0 2.335-1.335 3.697-3.443 3.697-2.107 0-3.434-1.353-3.434-3.697V9.248c0-2.343 1.336-3.76 3.443-3.76 2.108 0 3.434 1.426 3.434 3.76v1.136zm-9.493 3.534l-1.472-3.18h-1.717v3.18h-1.363V5.65h3.162c1.898 0 2.789 1.163 2.789 2.545 0 1.38-.845 2.062-1.517 2.316l1.663 3.407h-1.545zM9.12 10.983l-.01-.008H7.322v2.933H5.96V5.642h3.16c1.69 0 2.717 1.126 2.717 2.67 0 1.545-1.036 2.671-2.716 2.671zM31.25 0H1.789C.8 0 0 .8 0 1.79v16.316c0 .99.8 1.79 1.79 1.79h29.452c.99 0 1.79-.8 1.79-1.79V1.799C33.032.81 32.24.01 31.25 0z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div class="DocumentEditScreen_titleDescription__2abbu">Add photo directly
                                                in your document and give your clients a clearer picture of your
                                                work(maximum 20).<span
                                                    class="DocumentEditScreen_titleDescriptionConstraints__2GG_t">(maximum 10).<svg
                                                        viewBox="0 0 24 24" class="DocumentAttachments_icon__38lKa"><path
                                                            fill-rule="evenodd"
                                                            d="M15.07 11.25l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25zM11 19h2v-2h-2v2zm1-17C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"
                                                            clip-rule="evenodd"></path></svg></span></div>
                                            <div class="DocumentAttachments_documentAttachments__3FW5s"></div>
                                        </div>
                                        <label for="image">
                                            <svg width="170" height="100" viewBox="0 0 71 25" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M55.5279 5.52925C55.7883 5.2689 56.2104 5.2689 56.4708 5.52925L59.1374 8.19591C59.3978 8.45626 59.3978 8.87837 59.1374 9.13872C58.8771 9.39907 58.455 9.39907 58.1946 9.13872L55.9993 6.94346L53.8041 9.13872C53.5437 9.39907 53.1216 9.39907 52.8613 9.13872C52.6009 8.87837 52.6009 8.45626 52.8613 8.19591L55.5279 5.52925Z"
                                                      fill="#7DB00E"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M56.0007 5.33398C56.3688 5.33398 56.6673 5.63246 56.6673 6.00065V14.0007C56.6673 14.3688 56.3688 14.6673 56.0007 14.6673C55.6325 14.6673 55.334 14.3688 55.334 14.0007V6.00065C55.334 5.63246 55.6325 5.33398 56.0007 5.33398Z"
                                                      fill="#7DB00E"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M51.3327 12C51.7009 12 51.9993 12.2985 51.9993 12.6667V16C51.9993 16.7364 52.5963 17.3333 53.3327 17.3333H58.666C59.4024 17.3333 59.9993 16.7364 59.9993 16V12.6667C59.9993 12.2985 60.2978 12 60.666 12C61.0342 12 61.3327 12.2985 61.3327 12.6667V16C61.3327 17.4728 60.1388 18.6667 58.666 18.6667H53.3327C51.8599 18.6667 50.666 17.4728 50.666 16V12.6667C50.666 12.2985 50.9645 12 51.3327 12Z"
                                                      fill="#7DB00E"/>
                                                <path
                                                    d="M0.5 10C0.5 4.75329 4.75329 0.5 10 0.5H61C66.2467 0.5 70.5 4.7533 70.5 10V15C70.5 20.2467 66.2467 24.5 61 24.5H10C4.75329 24.5 0.5 20.2467 0.5 15V10Z"
                                                    stroke="#7DB00E"/>
                                                <path
                                                    d="M14.356 13.892C14.356 15.908 13.108 17.144 11.104 17.144C9.088 17.144 7.84 15.908 7.84 13.892V8.84H8.956V13.892C8.956 15.368 9.76 16.256 11.104 16.256C12.448 16.256 13.252 15.356 13.252 13.892V8.84H14.356V13.892ZM17.0994 19.64H16.0434V10.628H17.0994V11.42C17.5194 10.82 18.1314 10.472 18.8874 10.472C20.5794 10.472 21.5994 11.72 21.5994 13.796C21.5994 15.956 20.5554 17.144 18.8874 17.144C18.1314 17.144 17.5194 16.832 17.0994 16.244V19.64ZM18.8154 11.384C17.6994 11.384 17.0994 12.236 17.0994 13.796C17.0994 15.344 17.7234 16.232 18.8154 16.232C19.9194 16.232 20.5194 15.368 20.5194 13.796C20.5194 12.26 19.8954 11.384 18.8154 11.384ZM22.9572 17V8.36H24.0132V17H22.9572ZM28.2797 17.144C26.4557 17.144 25.3637 15.896 25.3637 13.82C25.3637 11.66 26.4917 10.472 28.2797 10.472C30.1037 10.472 31.1957 11.744 31.1957 13.82C31.1957 15.968 30.0677 17.144 28.2797 17.144ZM28.2797 16.232C29.4677 16.232 30.1157 15.38 30.1157 13.82C30.1157 12.272 29.4557 11.384 28.2797 11.384C27.0917 11.384 26.4437 12.248 26.4437 13.82C26.4437 15.356 27.1037 16.232 28.2797 16.232ZM33.5268 12.704H32.4708C32.6748 11.3 33.5988 10.472 35.1588 10.472C36.8628 10.472 37.6908 11.468 37.6908 12.956V15.464C37.6908 16.196 37.7508 16.652 37.9188 17H36.8028C36.6828 16.748 36.6468 16.376 36.6348 15.992C36.0948 16.796 35.2308 17.144 34.4628 17.144C33.1428 17.144 32.2548 16.532 32.2548 15.32C32.2548 14.444 32.7348 13.808 33.6708 13.496C34.5348 13.208 35.4108 13.136 36.6348 13.124V12.98C36.6348 11.948 36.1548 11.384 35.0628 11.384C34.1508 11.384 33.6588 11.888 33.5268 12.704ZM33.3348 15.296C33.3348 15.884 33.8268 16.232 34.5708 16.232C35.7468 16.232 36.6348 15.308 36.6348 14.216V13.916C33.9228 13.94 33.3348 14.516 33.3348 15.296ZM41.81 17.144C40.118 17.144 39.098 15.896 39.098 13.82C39.098 11.66 40.142 10.472 41.81 10.472C42.566 10.472 43.178 10.784 43.598 11.372V8.36H44.654V17H43.598V16.196C43.178 16.796 42.566 17.144 41.81 17.144ZM41.882 16.232C42.998 16.232 43.598 15.38 43.598 13.82C43.598 12.272 42.974 11.384 41.882 11.384C40.778 11.384 40.178 12.248 40.178 13.82C40.178 15.356 40.802 16.232 41.882 16.232Z"
                                                    fill="#7DB00E"/>
                                            </svg>
                                            <input style="display: none" type="file" name="image_path" accept="image/*"
                                                   id="image">
                                            @error('image_path')
                                            <span class="text-danger" role="alert">
                                                                                <strong>{{$message}}</strong>
                                                                            </span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="col-md-auto">
                                        <img id="showImage" class="rounded avatar-lg"
                                             src="{{(! empty($client->image_path)) ? asset('attachments/clients/'.$client->id.'/'.$client->image_path ) : asset('admin/dist/img/no_image.jpg') }}"
                                             style="max-width: 100%; max-height: 300px; margin-left: 70px;"
                                             alt="No Image">
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
