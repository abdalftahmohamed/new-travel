<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\LimitRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\Home\BlogResource;
use App\Http\Resources\Home\CityResource;
use App\Http\Resources\Home\DepartmentResource;
use App\Http\Resources\Home\OfferResource;
use App\Http\Resources\Home\OurPartnerResource;
use App\Http\Resources\Home\ReviewResource;
use App\Http\Resources\Home\TripResource;
use App\Http\Traits\ImageTrait;
use App\Models\Blog;
use App\Models\City;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Department;
use App\Models\Offer;
use App\Models\OurPartner;
use App\Models\Review;
use App\Models\SupscripeEmail;
use App\Models\Trip;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    use ImageTrait;

    public function index()
    {
//        $topDestinations = City::latest()->take(5)->get();
        #للحصول علي اخر خمس عناصر
        $topDestinations = City::get()->slice(-9);

        $categories = Department::get()->slice(-8);
        $bestOffers = Trip::where([['status', 1], ['type', 'Best Offers']])->get()->slice(-9);
        $BestTripstrips = Trip::where([['status', 1], ['type', 'Best Trips']])->get()->slice(-9);
        $PopularExperiencetrips = Trip::where([['status', 1], ['type', 'Popular Experiences']])->get()->slice(-9);
        $blogs = Blog::get()->slice(-9);
        $ourPartners = OurPartner::get();
        $reviews = Review::whereIn('stars_numbers', [3, 4, 5])->get();

        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'topDestinations' => CityResource::collection($topDestinations),
                'categories' => DepartmentResource::collection($categories),
                'bestOffers' => TripResource::collection($bestOffers),
                'bestTrips' => TripResource::collection($BestTripstrips),
                'popularExperiencetrips' => TripResource::collection($PopularExperiencetrips),
                'blogs' => BlogResource::collection($blogs),
                'ourPartners' => OurPartnerResource::collection($ourPartners),
                'reviews' => ReviewResource::collection($reviews),
            ]
        ], 201);
    }

    public function topDestination(LimitRequest $request)
    {
        if ($request->filled(['start', 'limit'])) {
            $topDestinations = City::offset($request->start)->limit($request->limit)->get();
        } else {
            $topDestinations = City::get();
        }
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'topDestinations' => CityResource::collection($topDestinations),
            ]
        ]);
    }

    public function category(LimitRequest $request)
    {
        if ($request->filled(['start', 'limit'])) {
            $categories = Department::offset($request->start)->limit($request->limit)->get();
        } else {
            $categories = Department::get();
        }
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'categories' => DepartmentResource::collection($categories),
            ]
        ]);
    }

    public function review(LimitRequest $request)
    {
        if ($request->filled(['start', 'limit'])) {
            $reviews = Review::offset($request->start)->limit($request->limit)->get();
        } else {
            $reviews = Review::get();
        }
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'reviews' => ReviewResource::collection($reviews),
            ]
        ]);
    }

    public function bestOffer(LimitRequest $request)
    {
        $query = Trip::where([['status', 1], ['type', 'Best Offers']]);

        if ($request->filled(['start', 'limit'])) {
            $bestOffers = $query->offset($request->start)->limit($request->limit)->get();
        } else {
            $bestOffers = $query->get();
        }
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'bestOffers' => TripResource::collection($bestOffers),
            ]
        ]);
    }

    public function bestTrip(LimitRequest $request)
    {
        $query = Trip::where([['status', 1], ['type', 'Best Trips']]);

        if ($request->filled(['start', 'limit'])) {
            $bestTrips = $query->offset($request->start)->limit($request->limit)->get();
        } else {
            $bestTrips = $query->get();
        }
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'bestTrips' => TripResource::collection($bestTrips),
            ]
        ]);
    }

    public function popularExperiencetrip(LimitRequest $request)
    {
        $query = Trip::where([['status', 1], ['type', 'Popular Experiences']]);

        if ($request->filled(['start', 'limit'])) {
            $popularExperiencetrips = $query->offset($request->start)->limit($request->limit)->get();
        } else {
            $popularExperiencetrips = $query->get();
        }
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'popularExperiencetrips' => TripResource::collection($popularExperiencetrips),
            ]
        ]);
    }

    public function trip(LimitRequest $request)
    {
        $query = Trip::where('status', 1);

        if ($request->filled('category_id')) {
            $query->where('department_id', $request->category_id);
        }

        if ($request->filled(['start', 'limit'])) {
//            $query->whereBetween('id', [$request->start, $request->limit]);
            $query->offset($request->start)->limit($request->limit);
        }

        $trips = $query->get();
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'trips' => TripResource::collection($trips),
            ]
        ]);
    }

    public function blog(LimitRequest $request)
    {
        if ($request->filled(['start', 'limit'])) {
            $query = Blog::offset($request->start)->limit($request->limit);
            $blogs = $query->get();
        } else {
            $blogs = Blog::get();
        }

        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'blogs' => BlogResource::collection($blogs),
            ]
        ]);
    }

    public function offer(LimitRequest $request)
    {
        if ($request->filled(['start', 'limit'])) {
            $query = Offer::where('status',1)->offset($request->start)->limit($request->limit);
            $offers = $query->get();
        } else {
            $offers = Offer::where('status',1)->get();
        }
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'offers' => OfferResource::collection($offers),
            ]
        ], 200);
    }

    public function searchTrip(Request $request)
    {
        try {
            $query = Trip::where('status', 1);

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            $trip_search = $query->get();

            if ($trip_search->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => __('transMessage.messNotFound'),
                    'data' => []
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => __('transMessage.messSuccess'),
                'data' => \App\Http\Resources\Home\TripResource::collection($trip_search),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('transMessage.messError'),
            ], 500);
        }
    }

    public function searchBlog(Request $request)
    {
        try {
            $query = Blog::where('name', 'like', '%' . $request->name . '%');

            $trip_search = $query->get();

            if ($trip_search->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => __('transMessage.messNotFound'),
                    'data' => []
                ], 200);
            }

            return response()->json([
                'status' => true,
                'message' => __('transMessage.messSuccess'),
                'data' => \App\Http\Resources\Home\BlogResource::collection($trip_search),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('transMessage.messError'),
            ], 500);
        }
    }

    public function subscriptionEmail(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'nullable|email',
            'name' => 'nullable|string',
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validatedData->errors()->first(),
            ], 400);
        }
        $arrayData = [
            'email' => $request->email,
            'name' => $request->name,
        ];
        $dataInsert = SupscripeEmail::create($arrayData);
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccessSaved'),
        ], 201);
    }

    public function sendMessage(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'nullable|email',
            'name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validatedData->errors()->first(),
            ], 400);
        }
        $arrayData = [
            'email' => $request->email,
            'name' => $request->name,
            'description' => $request->description,
        ];
        $dataInsert = Contact::create($arrayData);
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccessSaved'),
        ], 201);
    }

}
