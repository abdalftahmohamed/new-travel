@extends('home.frontend.master')
@section('css')

@endsection
{{--@section('page-header')--}}
<!-- breadcrumb -->
@section('trip')
    class="nav-item active"
@stop
@section('title1')
    Chechout
@stop

<!-- breadcrumb -->
{{--@endsection--}}
@section('content')


    <div class="untree_co-section">
        <div class="container">

            <div class="row">
                <div class="col-md-6">



                    <div class="row ">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                    <th>Trip</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    </thead>
                                    <tbody>
{{--                                    @foreach($carts as $cart)--}}
                                    <tr>
                                        <td>{{$checkout->trip->name}}</td>
                                        <td>{{ date('d:m:Y', strtotime($checkout->date)) }}</td>
                                        <td>${{$checkout->total}}</td>
                                    </tr>
{{--                                    @endforeach--}}
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                        <td class="text-black"></td>
                                        <td class="text-black">${{$checkout->final_subtotal}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Cart discount</strong></td>
                                        <td class="text-black"></td>
                                        <td class="text-black">${{$checkout->coupon_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                        <td class="text-black font-weight-bold"><strong></strong></td>
                                        <td class="text-black font-weight-bold"><strong>${{$checkout->total}}</strong></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                                    <div class="collapse" id="collapsebank">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                                    <div class="collapse" id="collapsecheque">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border p-3 mb-5">
                                    <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                                    <div class="collapse" id="collapsepaypal">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{route('session')}}" method="POST">
                                    @csrf
                                    <input hidden="" name="total" value="{{$checkout->total}}">
                                    <input hidden="" name="checkout_id" value="{{$checkout->id}}">
                                    <input hidden="" name="_token" value="{{csrf_token()}}">

                                    <div class="form-group">
                                        <button class="btn btn-black btn-lg py-3 btn-block" type="submit">Place Order</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div>
                            <form action="{{route('trip.cancelCart')}}" method="POST">
                                @csrf
                                <input hidden="" name="checkout_id" value="{{$checkout->id}}">
                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                    Cancel
                                </button>
                            </form>

                            {{--                    <button type="reset" class="btn btn-secondary waves-effect">--}}
                            {{--                        Cancel--}}
                            {{--                    </button>--}}
                        </div>
                    </div>

                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>




@endsection
@section('js')

    <!-- ChartJS -->
    <script src="{{URL::asset('admin/plugins/chart.js/Chart.min.js')}}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{URL::asset('admin/dist/js/pages/dashboard2.js')}}"></script>
@endsection
