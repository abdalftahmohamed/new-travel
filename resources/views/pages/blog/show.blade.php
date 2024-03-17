@extends('admin.layouts.master')
@section('css')
    @section('title')
        Show blog
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        blog Show
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
                                <a href="{{route('blog.index')}}"
                                   class="btn btn-primary waves-effect waves-light float-end mb-4">Back</a>
                            </h4>
                            {{--                            <br>--}}
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


                        <div class="callout callout-info">
                            <strong><i class="fas fa-info"></i> Note:</strong>This page has been enhanced for printing. Click the print button at the bottom of the blog to test.
                        </div>


                        <!-- Main content -->
                        <div class="blog p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> Constructor
                                        <small class="float-right">Date: {{ date('d:m:Y', strtotime($blog->created_at)) }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row blog-info">
                                <div class="col-sm-4 blog-col">
                                   <h2>*blog details: </h2>
                                    <address>
                                        <img class="img-fluid mb-2 rounded-circle" style="width: 150px; height: 150px;" src="{{(! empty($blog->Company->logo)) ? asset('attachments/blog/'.$blog->Company->id.'/'.$blog->Company->logo ) : asset('admin/dist/img/no_image.jpg') }}" alt="blog image">

                                        <br>
                                        <strong>{{$blog->Company->name ?? "Company name"}}, {{$blog->Company->specialization ?? "specialization Here"}} .</strong><br>
                                        Email: <strong>{{$blog->Company->email ?? "Email.com"}}</strong><br>
                                        <strong>{{$blog->Company->country ?? "country"}}, {{$blog->Company->governorate?? "governorate"}}</strong><br>
                                        <strong>{{$blog->Company->city ?? "city"}}, {{$blog->Company->zip_code ?? "C550"}}</strong><br>
                                        Phone: <strong>{{$blog->Company->phone ?? "phone"}}</strong>
                                    </address>
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->

                            </div>
                            <!-- /.row -->

                            <div class="col-sm-auto blog-col">
                                <h2>*blog details: </h2>
                                <address>
                                    {{--                                        <img class="img-fluid mb-2 rounded-circle" style="width: 150px; height: 150px;" src="{{(! empty($blog->image)) ? asset('attachments/blog/'.$blog->id.'/'.$blog->image ) : asset('admin/dist/img/no_image.jpg') }}" alt="blog image">--}}
                                    name:  <strong>{{$blog->blog_name ?? "name"}}</strong><br>
                                    description: <strong>{{$blog->blog_description ?? "blog description..."}}</strong><br>
                                </address>
                            </div>

                            <br>
                            <h2>#Attachements</h2>
                            <hr>
                            {{--                            #attachement--}}
                            <div class="row expandable-body" >
                                @foreach($blog->attachments()->get() as $blogs_attachements)
                                    @foreach($blogs_attachements->Images()->get() as $images)
                                        <img class="img-fluid mb-2 " style=" padding: 5px;margin-left: 10px; width: 150px; height: 150px;" src="{{(! empty($images->image_path)) ? asset('attachments/images/blog/'.$blog->id.'/'.$images->attachment_id.'/'.$images->image_path ) : asset('admin/dist/img/no_image.jpg') }}" alt="image">
                                    @endforeach
                                @endforeach
                            </div>

                            {{--                            <div class="row " >--}}
                            {{--                                <hr>--}}
                            {{--                                @foreach($blog->attachments()->get() as $blogs_attachements)--}}
                            {{--                                    @foreach($blogs_attachements->Documents()->get() as $documents)--}}
                            {{--                                        <div style="position: relative; display: inline-block;">--}}
                            {{--                                            <embed src="{{ (!empty($documents->document)) ? asset('attachments/documents/blog/'.$blog->id.'/'.$documents->attachment_id.'/'.$documents->document) : asset('admin/dist/img/no_image.jpg') }}" type="application/pdf" style="padding: 5px; margin-left: 10px; width: 180px; height: 150px;" />--}}
                            {{--                                            <a href="{{ (!empty($documents->document)) ? asset('attachments/documents/blog/'.$blog->id.'/'.$documents->attachment_id.'/'.$documents->document) : '#' }}" download="document.pdf" style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); margin-top: 5px;">Download</a>--}}
                            {{--                                        </div>--}}
                            {{--                                    @endforeach--}}
                            {{--                                @endforeach--}}
                            {{--                            </div>--}}


                            <br>
                            <hr>

                            {{--                            project--}}

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>projects</h2>

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
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>budget</th>
                                                    <th>total_price</th>
                                                    <th>profit</th>
                                                    <th>status</th>
                                                    <th>start time</th>
                                                    <th>end time</th>
                                                    <th>Company</th>
                                                    <th>Image</th>
                                                    <th>Show</th>
{{--                                                    <th>Actions</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($projects as $project)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$project->name}}</td>
                                                        <td>{{mb_substr($project->describe,0,100). '...'}}</td>
                                                        <td>{{$project->budget}}</td>
                                                        <td>{{$project->total_price}}</td>
                                                        <td>{{$project->profit}}</td>
                                                        <td>
                                                            @if($project->status === 'in_progress')
                                                                <span class="badge badge-primary">{{$project->status}}</span>
                                                            @elseif($project->status === 'Finished')
                                                                <span class="badge badge-success">{{$project->status}}</span>
                                                            @else
                                                                <span class="badge badge-danger">{{$project->status}}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$project->start_time}}</td>
                                                        <td>{{$project->end_time}}</td>
                                                        <td>{{$project->blog->name}}</td>
                                                        <td>
                                                            <img class="img-fluid mb-2 rounded-circle" style="width: 100px; height: 100px;" src="{{(! empty($project->image)) ? asset('attachments/projects/'.$project->id.'/'.$project->image ) : asset('admin/dist/img/no_image.jpg') }}" alt="project image">
                                                        </td>
                                                        <td>
                                                            <a class="dropdown-item" href="{{ route('project.show', $project->id) }}" style="display: flex;padding-top: 20px; justify-content: center; align-items: center;">
                                                                <svg width="40"  height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g id="show-icon">
                                                                        <path id="eye" d="M12 2C6.485 2 2 6.485 2 12s4.485 10 10 10 10-4.485 10-10S17.515 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#7DB00E"/>
                                                                        <path id="pupil" d="M12 4c1.74 0 3.41.56 4.79 1.59c.24.22.24.58 0 .8C15.41 7.44 13.75 8 12 8s-3.41-.56-4.79-1.61c-.24-.22-.24-.58 0-.8C8.59 4.56 10.25 4 12 4zm0 10c-1.66 0-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3s-1.34 3-3 3z" fill="#7DB00E"/>
                                                                    </g>
                                                                </svg>
                                                            </a>


                                                        </td>

{{--                                                        <td>--}}
{{--                                                            <div class="margin">--}}
{{--                                                                <div class="btn-group">--}}
{{--                                                                    <button type="button" class="btn btn-primary " data-toggle="dropdown">Action</button>--}}
{{--                                                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">--}}
{{--                                                                        <span class="sr-only">Toggle Dropdown</span>--}}
{{--                                                                    </button>--}}
{{--                                                                    <div class="dropdown-menu" role="menu">--}}
{{--                                                                        <a class="dropdown-item" href="{{route('project.edit', $project->id)}}">Edit</a>--}}
{{--                                                                        <div class="dropdown-divider"></div>--}}
{{--                                                                        --}}{{--                                                <a class="dropdown-item" href="{{route('project.show', $project->id)}}">Show</a>--}}
{{--                                                                        <div class="dropdown-divider"></div>--}}
{{--                                                                        <form action="{{route('project.destroy')}}" method="POST" style="display: inline-block;">--}}
{{--                                                                            @csrf--}}
{{--                                                                            @method('DELETE')--}}
{{--                                                                            <input type="hidden" name="id" value="{{$project->id}}">--}}
{{--                                                                            <button type="submit" onclick="return confirm('Are You Sure')" class="dropdown-item">Delete</button>--}}
{{--                                                                        </form>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}

{{--                                                        </td>--}}
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                {{--                                <tfoot>--}}
                                                {{--                                <tr>--}}
                                                {{--                                    <th>Rendering engine</th>--}}
                                                {{--                                    <th>Browser</th>--}}
                                                {{--                                    <th>Platform(s)</th>--}}
                                                {{--                                    <th>Engine version</th>--}}
                                                {{--                                    <th>CSS grade</th>--}}
                                                {{--                                </tr>--}}
                                                {{--                                </tfoot>--}}
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>



                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>
                                                invoices
                                            </h2>


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
                                                    <th>title</th>
                                                    <th>issued_date</th>
                                                    <th>due_date</th>
{{--                                                    <th>payment</th>--}}
                                                    <th>message</th>
                                                    {{--                                    <th>payment_due</th>--}}
                                                    <th>status</th>
                                                    <th>tax</th>
{{--                                                    <th>blog</th>--}}
                                                    {{--                                    <th>payment_type</th>--}}
                                                    <th>Image</th>
                                                    <th>Show</th>
{{--                                                    <th>Actions</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($invoices as $invoice)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$invoice->title}}</td>
                                                        <td>{{$invoice->issued_date}}</td>
                                                        <td>{{$invoice->due_date}}</td>
{{--                                                        <td>{{$invoice->payment}}</td>--}}
                                                        <td>{{mb_substr($invoice->message,0,60). '...'}}</td>
                                                        {{--                                    <td>{{$invoice->payment_due}}</td>--}}
                                                        <td>
                                                            @if($invoice->status === 'In Progress')
                                                                <span class="badge badge-primary">{{$invoice->status}}</span>
                                                            @elseif($invoice->status === 'Finished')
                                                                <span class="badge badge-success">{{$invoice->status}}</span>
                                                            @else
                                                                <span class="badge badge-danger">{{$invoice->status}}</span>
                                                            @endif
                                                        </td>

                                                        <td>{{$invoice->tax->ratio}}</td>
{{--                                                        <td>{{$invoice->blog->first_name}}</td>--}}
                                                        {{--                                    <td>{{$invoice->payment_type}}</td>--}}
                                                        <td>
                                                            <img class="img-fluid mb-2 rounded-circle" style="width: 100px; height: 100px;" src="{{(! empty($invoice->image)) ? asset('attachments/invoices/'.$invoice->id.'/'.$invoice->image ) : asset('admin/dist/img/no_image.jpg') }}" alt="invoice image">
                                                        </td>
                                                        <td>
                                                            <a class="dropdown-item" href="{{ route('invoice.show', $invoice->id) }}" style="display: flex;padding-top: 20px; justify-content: center; align-items: center;">
                                                                <svg width="40"  height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g id="show-icon">
                                                                        <path id="eye" d="M12 2C6.485 2 2 6.485 2 12s4.485 10 10 10 10-4.485 10-10S17.515 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#7DB00E"/>
                                                                        <path id="pupil" d="M12 4c1.74 0 3.41.56 4.79 1.59c.24.22.24.58 0 .8C15.41 7.44 13.75 8 12 8s-3.41-.56-4.79-1.61c-.24-.22-.24-.58 0-.8C8.59 4.56 10.25 4 12 4zm0 10c-1.66 0-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3s-1.34 3-3 3z" fill="#7DB00E"/>
                                                                    </g>
                                                                </svg>
                                                            </a>


                                                        </td>
{{--                                                        <td>--}}
{{--                                                            <div class="margin">--}}
{{--                                                                <div class="btn-group">--}}
{{--                                                                    <button type="button" class="btn btn-primary " data-toggle="dropdown">Action</button>--}}
{{--                                                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">--}}
{{--                                                                        <span class="sr-only">Toggle Dropdown</span>--}}
{{--                                                                    </button>--}}
{{--                                                                    <div class="dropdown-menu" role="menu">--}}
{{--                                                                        <a class="dropdown-item" href="{{route('invoice.edit', $invoice->id)}}">Edit</a>--}}
{{--                                                                        <div class="dropdown-divider"></div>--}}
{{--                                                                        <form action="{{route('paypal.payment')}}" method="POST" style="display: inline-block;">--}}
{{--                                                                            @csrf--}}
{{--                                                                            <input type="hidden" name="invoice_id" value="{{$invoice->id}}">--}}
{{--                                                                            <button type="submit" onclick="return confirm('Are You Sure to Payment Now ...?')" class="dropdown-item">Payment Paypal</button>--}}
{{--                                                                        </form>--}}
{{--                                                                        <div class="dropdown-divider"></div>--}}
{{--                                                                        <a class="dropdown-item" href="{{route('invoice.showImages', $invoice->id)}}">Show Images</a>--}}
{{--                                                                        <div class="dropdown-divider"></div>--}}
{{--                                                                        <a class="dropdown-item" href="{{route('invoice.showVideos', $invoice->id)}}">Show Videos</a>--}}
{{--                                                                        <div class="dropdown-divider"></div>--}}
{{--                                                                        <a class="dropdown-item" href="{{route('invoice.showDocuments', $invoice->id)}}">Show Documents</a>--}}
{{--                                                                        <div class="dropdown-divider"></div>--}}
{{--                                                                        --}}{{--                                                <a class="dropdown-item" href="{{route('invoice.show', $invoice->id)}}">Show</a>--}}
{{--                                                                        --}}{{--                                                <div class="dropdown-divider"></div>--}}
{{--                                                                        <form action="{{route('invoice.destroy')}}" method="POST" style="display: inline-block;">--}}
{{--                                                                            @csrf--}}
{{--                                                                            @method('DELETE')--}}
{{--                                                                            <input type="hidden" name="id" value="{{$invoice->id}}">--}}
{{--                                                                            <button type="submit" onclick="return confirm('Are You Sure')" class="dropdown-item">Delete</button>--}}
{{--                                                                        </form>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}

{{--                                                        </td>--}}
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                {{--                                <tfoot>--}}
                                                {{--                                <tr>--}}
                                                {{--                                    <th>Rendering engine</th>--}}
                                                {{--                                    <th>Browser</th>--}}
                                                {{--                                    <th>Platform(s)</th>--}}
                                                {{--                                    <th>Engine version</th>--}}
                                                {{--                                    <th>CSS grade</th>--}}
                                                {{--                                </tr>--}}
                                                {{--                                </tfoot>--}}
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>
                                                quotes
                                            </h2>


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
                                                    <th>title</th>
                                                    <th>Note</th>
                                                    <th>offer_price_massage</th>
                                                    <th>subtotal</th>
{{--                                                    <th>payment_due</th>--}}
                                                    {{--                                    <th>payment_type</th>--}}
                                                    <th>total</th>
                                                    <th>date</th>
                                                    <th>status</th>
{{--                                                    <th>blog</th>--}}
                                                    <th>blog</th>
                                                    <th>Image</th>
                                                    <th>Show</th>
{{--                                                    <th>Actions</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($quotes as $quote)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$quote->title}}</td>
                                                        <td>{{mb_substr($quote->note,0,30). '...'}}</td>
                                                        <td>{{$quote->offer_price_massage}}</td>
                                                        <td>{{$quote->subtotal}}</td>
{{--                                                        <td>{{$quote->payment_due}}</td>--}}
                                                        {{--                                    <td>{{$quote->payment_type}}</td>--}}
                                                        <td>{{$quote->total}}</td>
                                                        <td>{{$quote->date}}</td>
                                                        <td>
                                                            @if($quote->status === 'In Progress')
                                                                <span class="badge badge-primary">{{$quote->status}}</span>
                                                            @elseif($quote->status === 'Finished')
                                                                <span class="badge badge-success">{{$quote->status}}</span>
                                                            @else
                                                                <span class="badge badge-danger">{{$quote->status}}</span>
                                                            @endif
                                                        </td>
{{--                                                        <td>{{$quote->blog->first_name}}</td>--}}
                                                        <td>{{mb_substr($quote->blog->blog_name,0,30). '...'}}</td>
                                                        <td>
                                                            <img class="img-fluid mb-2 rounded-circle" style="width: 100px; height: 100px;" src="{{(! empty($quote->image)) ? asset('attachments/quotes/'.$quote->id.'/'.$quote->image ) : asset('admin/dist/img/no_image.jpg') }}" alt="quote image">
                                                        </td>
                                                        <td>
                                                            <a class="dropdown-item" href="{{ route('quote.show', $quote->id) }}" style="display: flex;padding-top: 20px; justify-content: center; align-items: center;">
                                                                <svg width="40"  height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g id="show-icon">
                                                                        <path id="eye" d="M12 2C6.485 2 2 6.485 2 12s4.485 10 10 10 10-4.485 10-10S17.515 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#7DB00E"/>
                                                                        <path id="pupil" d="M12 4c1.74 0 3.41.56 4.79 1.59c.24.22.24.58 0 .8C15.41 7.44 13.75 8 12 8s-3.41-.56-4.79-1.61c-.24-.22-.24-.58 0-.8C8.59 4.56 10.25 4 12 4zm0 10c-1.66 0-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3s-1.34 3-3 3z" fill="#7DB00E"/>
                                                                    </g>
                                                                </svg>
                                                            </a>
                                                        </td>

{{--                                                        <td>--}}
{{--                                                            <div class="margin">--}}
{{--                                                                <div class="btn-group">--}}
{{--                                                                    <button type="button" class="btn btn-primary " data-toggle="dropdown">Action</button>--}}
{{--                                                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">--}}
{{--                                                                        <span class="sr-only">Toggle Dropdown</span>--}}
{{--                                                                    </button>--}}
{{--                                                                    <div class="dropdown-menu" role="menu">--}}
{{--                                                                        <a class="dropdown-item" href="{{route('quote.edit', $quote->id)}}">Edit</a>--}}
{{--                                                                        <div class="dropdown-divider"></div>--}}
{{--                                                                        <a class="dropdown-item" href="{{route('quote.showImages', $quote->id)}}">Show Images</a>--}}
{{--                                                                        <div class="dropdown-divider"></div>--}}
{{--                                                                        <a class="dropdown-item" href="{{route('quote.showVideos', $quote->id)}}">Show Videos</a>--}}
{{--                                                                        <div class="dropdown-divider"></div>--}}
{{--                                                                        <a class="dropdown-item" href="{{route('quote.showDocuments', $quote->id)}}">Show Documents</a>--}}
{{--                                                                        <div class="dropdown-divider"></div>--}}
{{--                                                                        <form action="{{route('quote.destroy')}}" method="POST" style="display: inline-block;">--}}
{{--                                                                            @csrf--}}
{{--                                                                            @method('DELETE')--}}
{{--                                                                            <input type="hidden" name="id" value="{{$quote->id}}">--}}
{{--                                                                            <button type="submit" onclick="return confirm('Are You Sure')" class="dropdown-item">Delete</button>--}}
{{--                                                                        </form>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}

{{--                                                        </td>--}}
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                {{--                                <tfoot>--}}
                                                {{--                                <tr>--}}
                                                {{--                                    <th>Rendering engine</th>--}}
                                                {{--                                    <th>Browser</th>--}}
                                                {{--                                    <th>Platform(s)</th>--}}
                                                {{--                                    <th>Engine version</th>--}}
                                                {{--                                    <th>CSS grade</th>--}}
                                                {{--                                </tr>--}}
                                                {{--                                </tfoot>--}}
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>










                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">
                                    <p class="lead">Payment Methods:</p>
                                    <img src="{{URL::asset('admin/dist/img/credit/visa.png')}}" alt="Visa">
                                    <img src="{{URL::asset('admin/dist/img/credit/mastercard.png')}}" alt="Mastercard">
                                    <img src="{{URL::asset('admin/dist/img/credit/american-express.png')}}" alt="American Express">
                                    <img src="{{URL::asset('admin/dist/img/credit/paypal2.png')}}" alt="Paypal">

                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                                        plugg
                                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                    </p>
                                </div>
                                <!-- /.col -->
                                {{--                                <div class="col-6">--}}
                                {{--                                    <p class="lead">Amount Due {{$blog->issued_date}}</p>--}}

                                {{--                                    <div class="table-responsive">--}}
                                {{--                                        <table class="table">--}}
                                {{--                                            <tr>--}}
                                {{--                                                <th style="width:50%">Subtotal:</th>--}}
                                {{--                                                <td>${{$blog->subtotal}}</td>--}}
                                {{--                                            </tr>--}}
                                {{--                                            <tr>--}}
                                {{--                                                <th>Tax ({{$blog->tax->ratio}}%)</th>--}}
                                {{--                                                <td>${{$tax}}</td>--}}
                                {{--                                            </tr>--}}
                                {{--                                            <tr>--}}
                                {{--                                                <th>Discount:</th>--}}
                                {{--                                                <td>${{$blog->discount->value}}</td>--}}
                                {{--                                            </tr>--}}
                                {{--                                            <tr>--}}
                                {{--                                                <th>Total:</th>--}}
                                {{--                                                <td>${{$blog->total}}</td>--}}
                                {{--                                            </tr>--}}
                                {{--                                        </table>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <!-- /.col -->
                            </div>

                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    {{--                                    <a href="blog-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>--}}
                                    <button type="button" rel="noopener"  class="btn btn-default" style="margin-right: 5px;" onclick="generatePrint()">
                                        <i class="fas fa-download"></i>  Print
                                    </button>
                                    {{--                                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit--}}
                                    {{--                                        Payment--}}
                                    {{--                                    </button>--}}
                                    {{--                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" onclick="generatePDF()">--}}
                                    {{--                                        <i class="fas fa-download"></i>Generate PDF--}}
                                    {{--                                    </button>--}}
                                </div>
                            </div>
                        </div>
                        <!-- /.blog -->
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        // jQuery script to handle change event on the select element
        $(document).ready(function () {
            $('#validationCustom033').on('change', function () {
                // Hide all quantity divs
                $('.quantity-div').hide();

                // Show the quantity divs for the selected items
                var selectedItems = $(this).val();
                if (selectedItems) {
                    for (var i = 0; i < selectedItems.length; i++) {
                        $('#quantityDiv_' + selectedItems[i]).show();
                    }
                }
            });
        });
    </script>
    <script>
        function generatePrint() {
            window.addEventListener("load", window.print());
        }
    </script>
@endsection
