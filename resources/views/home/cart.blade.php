@extends('home.frontend.master')
@section('css')

@endsection
{{--@section('page-header')--}}
<!-- breadcrumb -->
@section('cart')
    class="nav-item active"
@stop
@section('title1')
    Cart
@stop
@section('description')
    Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.
@stop
<!-- breadcrumb -->
{{--@endsection--}}
@section('content')

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Type</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Date</th>
                                <th class="product-quantity">status</th>
{{--                                <th class="product-remove">Remove</th>--}}
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($carts as $cart)
                            <tr>
                                <td class="product-thumbnail">
                                    <img
                                        style="width: 100px; height: 100px; border-radius: 8px"
                                        src="{{(! empty($cart->image_path)) ? asset('attachments/trips/'.$cart->id.'/'.$cart->image_path) : asset('admin/dist/img/no_image.jpg') }}"
                                         alt="Image" class="img-fluid">
                                </td>
                                <td class="product-name">
                                    <h2 class="h5 text-black">{{$cart->name}}</h2>
                                </td>
                                <td>${{$cart->pivot->total}}</td>
                                <td>{{ date('d:m:Y', strtotime($cart->pivot->date)) }}</td>
                                <td>
                                    @if($cart->pivot->status === 1)
                                        <span>active</span>
                                    @else
                                        <span>inActive</span>
                                    @endif
                                </td>
{{--                                <td><a href="#" class="btn btn-black btn-sm">X</a></td>--}}
                            </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="row mb-5">--}}
{{--                        <div class="col-md-6 mb-3 mb-md-0">--}}
{{--                            <button class="btn btn-black btn-sm btn-block">Update Cart</button>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <button class="btn btn-outline-black btn-sm btn-block">Continue Shopping</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <label class="text-black h4" for="coupon">Coupon</label>--}}
{{--                            <p>Enter your coupon code if you have one.</p>--}}
{{--                        </div>--}}
{{--                        @if(session('message'))--}}
{{--                            <div class="alert alert-success">--}}
{{--                                {{session('message')}}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        @if(session('error'))--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                {{session('error')}}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        @if ($errors->any())--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <ul>--}}
{{--                                    @foreach ($errors->all() as $error)--}}
{{--                                        <li>{{ $error }}</li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        <form action="{{route('checkCoupon')}}" method="GET">--}}
{{--                            @csrf--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-8 mb-3 mb-md-0">--}}
{{--                                    <input type="text" class="form-control py-3" id="coupon" name="coupon_name" placeholder="Coupon Code">--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <button type="submit" class="btn btn-black">Apply Coupon</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{----}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 pl-5">--}}
{{--                    <div class="row justify-content-end">--}}
{{--                        <div class="col-md-7">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-12 text-right border-bottom mb-5">--}}
{{--                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <form action="{{route('checkout')}}" method="post">--}}
{{--                                @csrf--}}
{{--                                <input hidden="" name="subtotal" value="{{$subtotalSum}}">--}}
{{--                                <input hidden="" name="discount" value="{{$discount ?? 0}}">--}}
{{--                                <input hidden="" name="total" value="{{$totalSum ?? $subtotalSum}}">--}}

{{--                                <div class="row mb-3">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <span class="text-black">Subtotal</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6 text-right">--}}
{{--                                        <strong class="text-black">${{$subtotalSum}}</strong>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-3">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <span class="text-black">Discount</span>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 text-right">--}}
{{--                                    <strong class="text-black">${{$discount ?? 0}}</strong>--}}
{{--                                </div>--}}
{{--                        </div>--}}
{{--                                <div class="row mb-5">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <span class="text-black">Total</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6 text-right">--}}
{{--                                        <strong class="text-black">${{$totalSum ?? $subtotalSum}}</strong>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}

{{--                                        <button class="btn btn-black btn-lg py-3 btn-block" type="submit">Proceed To Checkout</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </form>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>





    <!-- /.content -->
@endsection
@section('js')

    <!-- ChartJS -->
    <script src="{{URL::asset('admin/plugins/chart.js/Chart.min.js')}}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{URL::asset('admin/dist/js/pages/dashboard2.js')}}"></script>
@endsection
