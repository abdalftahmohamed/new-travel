<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\LimitRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\Home\BlogResource;
use App\Http\Resources\Home\CityResource;
use App\Http\Resources\Home\CityTripsResource;
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

        $categories = Department::get()->slice(-9);
        $bestOffers = Trip::where([['status', 1], ['type', 'Best Offers']])->get()->slice(-9);
        $BestTripstrips = Trip::where([['status', 1], ['type', 'Best Trips']])->get()->slice(-9);
        $PopularExperiencetrips = Trip::where([['status', 1], ['type', 'Popular Experiences']])->get()->slice(-9);
        $blogs = Blog::get()->slice(-9);
        $ourPartners = OurPartner::get();
        $reviews = Review::whereIn('stars_numbers', [3, 4, 5])->get()->slice(-9);

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
        $topDestinations = City::get();

//        if ($request->filled(['start', 'limit'])) {
//            $topDestinations = City::offset($request->start)->limit($request->limit)->get();
//        } else {
//            $topDestinations = City::get();
//        }
        if ($request->filled(['start']) || $request->filled(['limit'])) {
            $start = $request->input('start', 0);
            $limit = $request->input('limit', $topDestinations->count());
            $topDestinations = $topDestinations->slice($start, $limit);
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
        $categories = Department::get();
        if ($request->filled(['start']) || $request->filled(['limit'])) {
            $start = $request->input('start', 0);
            $limit = $request->input('limit', $categories->count());
            $categories = $categories->slice($start, $limit);
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
        $reviews = Review::whereIn('stars_numbers', [3, 4, 5])->get();

        if ($request->filled(['start']) || $request->filled(['limit'])) {
            $start = $request->input('start', 0);
            $limit = $request->input('limit', $reviews->count());
            $reviews = $reviews->slice($start, $limit);
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
        $bestOffers = $query->get();
//        if ($request->filled(['start', 'limit'])) {
//            $bestOffers = $query->offset($request->start)->limit($request->limit)->get();
//        } else {
//            $bestOffers = $query->get();
//        }
        if ($request->filled(['start']) || $request->filled(['limit'])) {
            $start = $request->input('start', 0);
            $limit = $request->input('limit', $bestOffers->count());
            $bestOffers = $bestOffers->slice($start, $limit);
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
        $bestTrips = $query->get();

//        if ($request->filled(['start', 'limit'])) {
//            $bestTrips = $query->offset($request->start)->limit($request->limit)->get();
//        } else {
//            $bestTrips = $query->get();
//        }

        if ($request->filled(['start']) || $request->filled(['limit'])) {
            $start = $request->input('start', 0);
            $limit = $request->input('limit', $bestTrips->count());
            $bestTrips = $bestTrips->slice($start, $limit);
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
        $popularExperiencetrips = $query->get();
//        if ($request->filled(['start', 'limit'])) {
//            $popularExperiencetrips = $query->offset($request->start)->limit($request->limit)->get();
//        } else {
//            $popularExperiencetrips = $query->get();
//        }
        if ($request->filled(['start']) || $request->filled(['limit'])) {
            $start = $request->input('start', 0);
            $limit = $request->input('limit', $popularExperiencetrips->count());
            $popularExperiencetrips = $popularExperiencetrips->slice($start, $limit);
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
        $trips = $query->get();

//        if ($request->filled(['start', 'limit'])) {
//            $query->offset($request->start)->limit($request->limit);
//        }

        if ($request->filled(['start']) || $request->filled(['limit'])) {
            $start = $request->input('start', 0);
            $limit = $request->input('limit', $trips->count());
            $trips = $trips->slice($start, $limit);
        }


        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'trips' => TripResource::collection($trips),
            ]
        ]);
    }

    public function tripCity(LimitRequest $request)
    {
        if ($request->filled('destination_id')) {
            $city = City::findOrFail($request->destination_id);
//            return $city;
//            $trips = collect();
//            foreach ($city->companies as $company) {
//                $trips = $trips->merge($company->tripsStatus);
//            }
        }

//        if ($request->filled(['start'])||$request->filled(['limit'])) {
//            $start = $request->input('start', 0);
//            $limit = $request->input('limit', $trips->count());
//            $trips = $trips->slice($start, $limit);
//        }

        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'trips' => new CityTripsResource($city),
            ]
        ]);
    }


    public function blog(LimitRequest $request)
    {
        $blogs = Blog::get();

//        if ($request->filled(['start', 'limit'])) {
//            $query = Blog::offset($request->start)->limit($request->limit);
//            $blogs = $query->get();
//        } else {
//            $blogs = Blog::get();
//        }

        if ($request->filled(['start']) || $request->filled(['limit'])) {
            $start = $request->input('start', 0);
            $limit = $request->input('limit', $blogs->count());
            $blogs = $blogs->slice($start, $limit);
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
        $offers = Offer::where('status',1)->get();

//        if ($request->filled(['start', 'limit'])) {
//            $query = Offer::where('status',1)->offset($request->start)->limit($request->limit);
//            $offers = $query->get();
//        } else {
//            $offers = Offer::where('status',1)->get();
//        }

        if ($request->filled(['start']) || $request->filled(['limit'])) {
            $start = $request->input('start', 0);
            $limit = $request->input('limit', $offers->count());
            $offers = $offers->slice($start, $limit);
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
                $trip_search = $query->searchByKeyword($request->name)->get();
                return response()->json([
                    'status' => true,
                    'message' => __('transMessage.messSuccess'),
                    'data' => \App\Http\Resources\Search\TripResource::collection($trip_search),
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => __('transMessage.messNotFound'),
                    'data' => []
                ]);
            }


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
            if ($request->filled('name')) {
                $trip_search = Blog::searchByKeyword($request->name)->get();
                return response()->json([
                    'status' => true,
                    'message' => __('transMessage.messSuccess'),
                    'data' => \App\Http\Resources\Search\BlogResource::collection($trip_search),
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => __('transMessage.messNotFound'),
                    'data' => []
                ], 200);
            }

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
