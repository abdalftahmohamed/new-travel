<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Department;
use App\Models\OurPartner;
use App\Models\Review;
use App\Models\SupscripeEmail;
use App\Models\Trip;
use App\Notifications\MailClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    public function home()
    {
        $TopDestinationtrips = City::get();
        $BestTripstrips = Trip::where('type','Best Trips')->get();
        $BestOfferstrips = Trip::where('type','Best Offers')->get();
        $PopularExperiencetrips = Trip::where('type','Popular Experiences')->get();
        $departments=Department::get();
        $blogs=Blog::get();
        $ourPartners=OurPartner::get();
        $reviews = Review::whereIn('stars_numbers', [3, 4, 5])->get();

        return view('home.index',compact('reviews','ourPartners','blogs','departments','TopDestinationtrips','BestTripstrips','BestOfferstrips','PopularExperiencetrips'));
    }

    public function blog()
    {
        $blogs = Blog::get();
        return view('home.blog',compact('blogs'));

    }

    public function blogShow($id)
    {
        $blog = Blog::findOrFail($id);
        $addresses = $blog->addresses()->get();
        $attachments = $blog->attachments()->get();
        return view('home.blogShow', compact('attachments', 'addresses', 'blog'));
    }



    public function showTravelCity($city_id)
    {
//        return $city_id;
        $city = City::findOrFail($city_id);
        $companys = $city->companies()->get();

        return view('home.showTravelCity',compact('companys','city'));

    }

    public function showTravelDepartment($department_id)
    {
//        return $city_id;
        $department = Department::findOrFail($department_id);
        $trips = $department->trips()->get();

        return view('home.showTravelDepartment',compact('trips','department'));

    }

    public function bookNow($id)
    {
        $trip =Trip::findOrFail($id);
        return view('home.trip.book',compact('trip'));
    }

    public function storeCart(Request $request)
    {
//        return $request;
        $trip = Trip::findOrFail($request->trip_id);

        $old_subtotal = $trip->old_price * $request->quantity_old;
        $young_subtotal = $trip->young_price * $request->quantity_young;
        $final_subtotal = $old_subtotal + $young_subtotal;

        $coupon = Coupon::where('coupon_name', $request->coupon)->where('status', 1)->first();

        if (!$coupon) {
            $totalSum =$final_subtotal;
//            $trip->cartClients()->syncWithoutDetaching([
//                auth('client')->user()->id => [
//                    'total' => $totalSum,
//                    'date' => $request->date,
//                    'status' => 1,
//                    'coupon_amount' => 0,
//                    'quantity_old' => $request->quantity_old,
//                    'subtotal_old' => $old_subtotal,
//                    'quantity_young' => $request->quantity_young,
//                    'subtotal_child' => $young_subtotal,
//                    'description' => $request->description,
//                ],
//            ]);
            $checkout = Cart::create([
                'trip_id'=>$request->trip_id,
                'total' => $totalSum,
                'date' => $request->date,
//                'status' => 1,
                'coupon_amount' => 0,
                'quantity_old' => $request->quantity_old,
                'subtotal_old' => $old_subtotal,
                'quantity_young' => $request->quantity_young,
                'subtotal_child' => $young_subtotal,
                'description' => $request->description,
                'final_subtotal' => $final_subtotal,
                'coupon_name' => $request->coupon,
            ]);

        }else{
            $discount = $coupon->coupon_amount*$final_subtotal/100;
            $totalSum =$final_subtotal-$discount;
//            $trip->cartClients()->syncWithoutDetaching([
//                auth('client')->user()->id => [
//                    'total' => $totalSum,
//                    'date' => $request->date,
//                    'coupon_amount' => $discount,
//                    'quantity_old' => $request->quantity_old,
//                    'subtotal_old' => $old_subtotal,
//                    'quantity_young' => $request->quantity_young,
//                    'subtotal_child' => $young_subtotal,
//                    'description' => $request->description,
//                ],
//            ]);
            $checkout = Cart::create([
                'trip_id'=>$request->trip_id,
                'total' => $totalSum,
                'date' => $request->date,
                'coupon_amount' => $discount,
                'quantity_old' => $request->quantity_old,
                'subtotal_old' => $old_subtotal,
                'quantity_young' => $request->quantity_young,
                'subtotal_child' => $young_subtotal,
                'description' => $request->description,
                'final_subtotal' => $final_subtotal,
                'coupon_name' => $request->coupon,
            ]);
        }
        session()->flash('message', 'Trip Added Successfully');
        return redirect()->route('trip.showCheckout',$checkout->id);
    }

    public function cancelCart(Request $request)
    {
        $checkout = Cart::findOrFail($request->checkout_id);
        $checkout->delete();
        session()->flash('message', 'Trip removed Successfully');
        return redirect()->route('shop');
    }

    public function showCheckout($checkout_id)
    {
        $checkout=Cart::findOrFail($checkout_id);
        return view('home.trip.showCheckout',compact('checkout'));
    }

    public function cart()
    {
        $client = Client::findOrFail(auth('client')->user()->id);
        $carts = $client->cartTrips()->get();
        $subtotalSum = $carts->sum(function ($cart) {
            return $cart->pivot->total;
        });
        return view('home.cart',compact('carts','subtotalSum'));
    }

    public function newCheckCoupon(Request $request)
    {
//        dd($request);
//        return $request;
        $couponName = $request->code;
        $coupon = Coupon::where('coupon_name', $couponName)->where('status', 1)->first();

        if (!$coupon) {
            // Coupon not found or not active
            return response()->json(['status' => 'error', 'message' => 'Sorry, this coupon is not correct']);
        }

        // Coupon found and is active, return additional data
        return response()->json([
            'status' => 'success',
            'message' => 'Good Coupon is valid',
            'coupon_data' => [
                'coupon_amount' => $coupon->coupon_amount,
            ]
        ]);
    }

    public function checkCoupon(Request $request)
    {
        $coupons =Coupon::where([['coupon_name',$request->coupon_name],['status',1]]);

        if (!$coupons->exists()){
            session()->flash('error', 'Sorry This Coupon Is Not Correct');
            return redirect()->route('cart');
        }

        $client = Client::findOrFail(auth('client')->user()->id);
        $carts = $client->cartTrips()->get();
        $subtotalSum = $carts->sum(function ($cart) {
            return $cart->pivot->total;
        });
        $discount = $coupons->first()->coupon_amount*$subtotalSum/100;
        $totalSum =$subtotalSum-$discount;
        return view('home.cart',compact('carts','totalSum','subtotalSum','discount'));
    }

    public function aboutUs()
    {
        $blogs = Blog::get();
        return view('home.aboutUs',compact('blogs'));

    }

    public function privacyPolicy()
    {
        return view('home.PrivacyPolicy');

    }

    public function terms()
    {
        return view('home.TermsConditions');
    }

    public function shop()
    {
        $trips = Trip::where('status',1)->get();
        return view('home.shop',compact('trips'));
    }

    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        $addresses = $trip->addresses()->get();
        $images = $trip->images()->get();
        $BestOfferstrips = Trip::where('type','Best Offers')->get();
        return view('home.trip.show', compact('images', 'addresses', 'trip','BestOfferstrips'));
    }

    public function checkout(Request $request)
    {
        $client = Client::findOrFail(auth('client')->user()->id);
        $carts = $client->cartTrips()->get();
        return view('home.trip.checkout',compact('carts','request'));
    }

    public function checkoutNow(Request $request)
    {
//        return $request;
        $client = Client::findOrFail(auth('client')->user()->id);
        $checkout = Cart::findOrFail($request->checkout_id);
        $checkout->update([
            'client_id'=>$client->id
        ]);
//        $carts = $client->cartTrips()->get();
        return view('home.trip.checkoutNow',compact('checkout','request'));
    }

    public function subscriptionEmail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
        $subscripe = SupscripeEmail::create($validatedData);
        session()->flash('message', 'Subscription Email Send Successfully');
        toastr()->success('Data has been saved successfully!');

        return redirect()->route('home');
    }


    public function contactNewUs()
    {
        return view('home.ContactNewUs');
    }

    public function storeMessage(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'description' => 'nullable|string',
        ]);
        $Contact = Contact::create($validatedData);
//        Mail::to($Contact->email)->send(new MailClient($Contact));
        $Contact->notify(new MailClient);

        session()->flash('message', 'Subscription Email Send Successfully');
        toastr()->success('Data has been saved successfully!');

        return redirect()->route('home');
    }

    public function searchTrip(Request $request)
    {
        try {
            $query = Trip::where('status', 1);
            if ($request->filled('name')) {
                $trip_search = $query->searchByKeyword($request->name)->get();
                if ($trip_search->isEmpty()) {
                    toastr()->warning('عفوا لا توجد بيانات بهذا الاسم');
                    return redirect()->route('home');
                }

                return view('home.searchTripWeb',compact('trip_search'));

            }else{
                toastr()->error('عفوا لم يتم ادخال بيانات');
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            return redirect()->route('home');
        }
    }


}
