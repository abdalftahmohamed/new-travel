<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripePaymentController extends Controller
{
    #code of Api here #Integration

    #https://www.youtube.com/watch?v=a55JZ8cOEj4


    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $totalprice = $request->get('total');
        $integerValue = intval($totalprice);

        $two0 = "00";
        $total = "$integerValue$two0";

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            "name" => "trips payment",
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],

            ],
            'mode'        => 'payment',
            'success_url' => route('checkout.success',$request->checkout_id, true) . "?session_id={CHECKOUT_SESSION_ID}",
//            'success_url' => route('checkout.success', ['checkout_id' => $request->checkout_id]) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url'  => route('cart'),
        ]);
        $checkout =Cart::findOrFail($request->checkout_id);
        $order = Order::create([
            'session_id' => $session->id,
            'status' => 'unpaid',
            'total_price' => $integerValue,
            'client_id' => $checkout->client->id,
        ]);
        return redirect()->away($session->url);
    }

    public function success(Request $request,$checkout_id)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $sessionId = $request->get('session_id');


        $checkout =Cart::findOrFail($request->checkout_id);
        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            // Check if the order already exists
            $order = Order::where('session_id', $session->id)->first();

            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }

//            auth('client')->user()->cartTrips()->detach();
            $checkout->update([
                'status'=>1
            ]);

            return view('home.thankyou');
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }
    }












    public function stripePost(Request $request){
        try {

//            return $request;
            $stripe =new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
//            return $stripe;

            $res = $stripe->tokens->create([
                'card' => [
                    'number' =>$request->number,
                    'exp_month' =>$request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);
//            return $res;

            Stripe\Stripe::setApiKey(
                env('STRIPE_SECRET')
            );

            $response = $stripe->charges->create([
                'amount' => $request->amount, #2000
                'currency' => 'usd', #usd
                'source' => $res->id, #tok_visa
                'description' => $request->description,
            ]);

            return response()->json([$response],201);

        }catch (\Exception $ex){
            return response()->json([
                'response'=>'Error',
                'error'=>$ex->getMessage()

            ],502);
        }
    }

}
