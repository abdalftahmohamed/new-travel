@extends('client.layouts.master')
@section('css')
    @section('title')
        Show trip
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        trip Show
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
                            <div class="row">
                                <div class="col-1">
                                    <a href="{{route('client.trip.index')}}"
                                       class="btn btn-primary waves-effect waves-light float-end mb-4">Back</a>
                                </div>

                                <div class="col-2">
                                    <form action="{{route('client.trip.cartOlder')}}" method="GET">
                                        @csrf
                                        <input type="hidden" name="trip_id" value="{{$trip->id}}">
                                        <input type="hidden" name="old_price" value="{{$trip->old_price}}">
                                        <button type="submit" onclick="return confirm('Are You Sure to Add To Cart For Older Price Now ...?')"  class="btn btn-success waves-effect waves-light float-end mb-4">Add To Cart For Older</button>
                                    </form>
                                </div>

                                <div class="col-2">
                                    <form action="{{route('client.trip.cartYounger')}}" method="GET">
                                        @csrf
                                        <input type="hidden" name="trip_id" value="{{$trip->id}}">
                                        <input type="hidden" name="young_price" value="{{$trip->young_price}}">
                                        <button type="submit" onclick="return confirm('Are You Sure to Add To Cart For Younger Price Now ...?')"  class="btn btn-success waves-effect waves-light float-end mb-4">Add To Cart For Younger</button>
                                    </form>
                                </div>
                            </div>
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

                            {{--                            <br>--}}
                        </div>


                        <div class="callout callout-info">
                            <strong><i class="fas fa-info"></i> Note:</strong>This page has been enhanced for printing. Click the print button at the bottom of the trip to test.
                        </div>


                        <!-- Main content -->
                        <div class="trip p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> Rehlatyuai
                                        <small class="float-right">Date: {{ date('d:m:Y', strtotime($trip->created_at)) }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row trip-info">
                                <div class="col-sm-6 trip-col">
                                   <h2>*Company Details: </h2>
                                    <address>
                                        <img class="img-fluid mb-2 " style="width: 150px; height: 150px;" src="{{(! empty($trip->company->image_path)) ? asset('attachments/companys/'.$trip->company->id.'/'.$trip->company->image_path ) : asset('admin/dist/img/no_image.jpg') }}" alt="trip image">
                                        <br>
                                        Name: <strong>{{$trip->company->name ?? "company name"}},</strong><br>
                                        Email: <strong>{{$trip->company->email ?? "Email.com"}},</strong><br>
                                        Country: <strong>{{$trip->company->country->name ?? "country"}},</strong><br>
                                        City: <strong>{{$trip->company->city->name ?? "city"}}</strong><br>
                                        Address: <strong>{{$trip->company->address ?? "address"}}</strong><br>
                                        Website: <strong>{{$trip->company->url ?? "www.url.com"}}</strong><br>
                                        Phone: <strong>{{$trip->company->phone ?? "phone"}}</strong>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 trip-col">
                                    <h2>*Trip Details: </h2>
                                    <address>
                                        <img class="img-fluid mb-2 " style="width: 150px; height: 150px;" src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path ) : asset('admin/dist/img/no_image.jpg') }}" alt="trip image">
                                        <br>
                                        Name:  <strong>{{$trip->name ?? "name"}}</strong><br>
                                        Type:  <strong>{{$trip->type ?? "type"}}</strong><br>
                                        Department Name:  <strong>{{$trip->department->name ?? "department name"}}</strong><br>
                                        priceOlder:  <strong>{{$trip->old_price ?? "Older"}}</strong><br>
                                        priceYounger:  <strong>{{$trip->young_price ?? "younger"}}</strong><br>
                                        Description: <strong>{{$trip->trip_description ?? "trip description..."}}</strong><br>

                                    </address>
                                </div>
                                <!-- /.col -->

                            </div>
                            <!-- /.row -->



                            <br>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Address Table</h3>
                                        </div>

                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>address</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table table-striped">
                                            @foreach($addresses as $address)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$address->name}}</td>
                                                </tr>
                                                <tr class="expandable-body">
                                                    <td colspan="2">
                                                        <p>
                                                            {{$address->description}}
                                                        </p>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <hr>



                            <h2>#Images</h2>
                            <hr>
                            {{--                            #Images--}}
                            <div class="row expandable-body" >
                                @foreach($images as $image)
                                        <img class="img-fluid mb-2 " style=" padding: 5px;margin-left: 10px; width: 150px; height: 150px;" src="{{(! empty($image->image_path)) ? asset('attachments/images/trips/'.$trip->id.'/'.$image->image_path ) : asset('admin/dist/img/no_image.jpg') }}" alt="image">
                                @endforeach
                            </div>
                            <br>
                            <hr>


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
                            </div>

                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    {{--                                    <a href="trip-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>--}}
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
                        <!-- /.trip -->
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
