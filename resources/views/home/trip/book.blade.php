@extends('home.frontend.master')
@section('css')
    <style>
        .borderless-input {
            border: none;
            outline: none;
            background-color: transparent;
            font-weight: bold;
            text-align: center;
            width: 100%;
            height: 100%;
            /* Add any additional styling you need */
        }

        .borderless-textarea {
            border: none;
            outline: none;
            background-color: transparent;
            font-weight: bold;
            width: 100%;
            height: 100%;
            /* Add any additional styling you need */
        }


        .contract-textarea {
            border: none;
            outline: none;
            background-color: transparent;
            font-weight: bold;
            width: 100%;
            height: 300px;
            overflow: hidden;
        }

        .sum {
            display: flex;
            flex-direction: row;
            margin-top: 30px;
            /*float: right;*/
            padding-left: 65%;

        }

        .DocumentSection_section__0mkOr {
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            font-size: 14px;
            line-height: 1.42857143;
            color: #333;
            -webkit-font-smoothing: antialiased;
            box-sizing: border-box;
            font-family: inherit;
            font-stretch: inherit;
            font-style: inherit;
            font-weight: inherit;
            background-color: #fff;
            border-radius: 4px;
            padding: 30px 50px;
            width: 100%;
            margin-bottom: 20px;

        }



    </style>

@endsection
{{--@section('page-header')--}}
<!-- breadcrumb -->
@section('trip')
    class="nav-item active"
@stop
@section('title1')
    Trip
@stop
@section('title2')
    Show
@stop
@section('description')
    Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.
@stop
<!-- breadcrumb -->
{{--@endsection--}}
@section('content')


    <div class="untree_co-section before-footer-section">
        <div class="container">

            <form class="col-md-12" action="{{route('trip.storeCart')}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
            <div class="row mb-5">

                    <div>
                        <div class="row mb-5">
                            <h2>Select A Date</h2>
                            <input type="datetime-local" name="date" value="{{old('date')}}"
                                   class="form-control" required placeholder="enter date  here..."/>
                            @error('date')
                            <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <h2>Select Number off ticket</h2>
                    <input type="hidden" name="trip_id" value="{{$trip->id}}">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Type</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
{{--                                <th class="product-remove">Remove</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="product-thumbnail">
                                    <img
                                        style="width: 100px; height: 100px;"
                                        src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path) : asset('admin/dist/img/no_image.jpg') }}"
                                        alt="Image" class="img-fluid">
                                </td>

                                <td class="product-name">
                                    <h2 class="h5 text-black">Adult</h2>
                                </td>
                                <td>${{$trip->old_price}}</td>
                                <td>
                                    <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-black decrease-old" type="button">&minus;</button>
                                        </div>
                                        <input type="text"  id="quantity_old" name="quantity_old" class="form-control text-center quantity-amount" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-black increase-old" type="button">&plus;</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" id="old_subtotal"  disabled name="old_subtotal" placeholder="${{$trip->old_price}}" class="borderless-input">
                                </td>
{{--                                <td><a href="#" class="btn btn-black btn-sm">X</a></td>--}}
                            </tr>

                            <tr>
                                <td class="product-thumbnail">
                                    <img
                                        style="width: 100px; height: 100px;"
                                        src="{{(! empty($trip->image_path)) ? asset('attachments/trips/'.$trip->id.'/'.$trip->image_path) : asset('admin/dist/img/no_image.jpg') }}"                                        alt="Image" class="img-fluid">
                                </td>
                                <td class="product-name">
                                    <h2 class="h5 text-black">Children</h2>
                                </td>
                                <td>${{$trip->young_price}}</td>
                                <td>
                                    <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-black decrease-young" type="button">&minus;</button>
                                        </div>
                                        <input type="text" id="quantity_young" name="quantity_young" class="form-control text-center quantity-amount" value="0" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-black increase-young" type="button">&plus;</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input type="number"  id="young_subtotal" disabled name="young_subtotal" placeholder="$0" class="borderless-input">
                                </td>
{{--                                <td><a href="#" class="btn btn-black btn-sm">X</a></td>--}}
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>

                    <div class="mb-3">
                        <h2>You Have Description!</h2>

                        <div>
                                        <textarea name="description" class="form-control" rows="5"
                                                  placeholder="enter the description here ...">{{old('description')}}</textarea>
                        </div>
                        @error('description')
                        <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                        @enderror
                    </div>


            </div>
            <hr>
            <br>
            <br>
            <div class="row">
                <div class="col-md-6">
{{--                    <div class="row mb-5">--}}
{{--                        <div class="col-md-6 mb-3 mb-md-0">--}}
{{--                            <button class="btn btn-black btn-sm btn-block">Update Cart</button>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <button class="btn btn-outline-black btn-sm btn-block">Continue Shopping</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">You Have Coupon!</label>
                            <p>Enter your coupon code if you have one.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" name="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-4">
                            <label id="check_coupon" class="btn btn-black">Apply Coupon</label>
                        </div>

                        <!-- Display coupon status -->
                        <div id="coupon-status"></div>

                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">
                                        <input type="number" disabled id="final_subtotal" name="final_subtotal" value="{{$trip->old_price}}" placeholder="${{$trip->old_price}}" class="borderless-input">
                                    </strong>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Discount</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">
                                        <input type="number" disabled id="discount" name="discount" placeholder="$0" class="borderless-input">
                                    </strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">
                                        <input type="number" disabled id="final_total" name="final_total" placeholder="${{$trip->old_price}}" class="borderless-input">
                                    </strong>
                                </div>
                            </div>

{{--                            <div class="row">--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.html'">Proceed To Checkout</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="mb-0">
                <div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                        Next payment
                    </button>
{{--                    <button type="reset" class="btn btn-secondary waves-effect">--}}
{{--                        Cancel--}}
{{--                    </button>--}}
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
@section('js')
{{--   <script>--}}
{{--        function myMap() {--}}
{{--            var mapProp= {--}}
{{--                center:new google.maps.LatLng(51.508742,-0.120850),--}}
{{--                zoom:5,--}}
{{--            };--}}
{{--            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);--}}
{{--        }--}}
{{--    </script>--}}
{{--    <script--}}
{{--        src="https://maps.app.goo.gl/MCqpGy8dtxa5StdJ6"--}}
{{--        src="https://maps.googleapis.com/maps/api/js?key=MCqpGy8dtxa5StdJ6&callback=myMap"--}}
{{--    ></script>--}}


    @include('home.trip.bookScript')

@endsection
