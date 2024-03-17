<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
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
use App\Models\Country;
use App\Models\Department;
use App\Models\Offer;
use App\Models\OurPartner;
use App\Models\Review;
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
        $topDestinations = City::get();
        $categories = Department::get();
        $bestOffers = Trip::where('type','Best Offers')->get();
        $BestTripstrips = Trip::where('type','Best Trips')->get();
        $PopularExperiencetrips = Trip::where('type','Popular Experiences')->get();
        $blogs=Blog::get();
        $ourPartners=OurPartner::get();
        $reviews = Review::whereIn('stars_numbers', [3, 4, 5])->get();

        return response()->json([
            'status' => true,
            'message' => [
                'en'=>'data successfully show',
                'ar'=>'تم عرض البيانات بنجاح',
            ],
            'data' => [
                'topDestinations'=>CityResource::collection($topDestinations),
                'categories'=>DepartmentResource::collection($categories),
                'bestOffers'=>TripResource::collection($bestOffers),
                'bestTripstrips'=>TripResource::collection($BestTripstrips),
                'popularExperiencetrips'=>TripResource::collection($PopularExperiencetrips),
                'blogs'=>BlogResource::collection($blogs),
                'ourPartners'=>OurPartnerResource::collection($ourPartners),
                'reviews'=>ReviewResource::collection($reviews),
            ]
        ], 201);
    }


    public function trip()
    {
        $trips = Trip::get();
        return response()->json([
            'status' => true,
            'message' => [
                'en'=>'data successfully show',
                'ar'=>'تم عرض البيانات بنجاح',
            ],
            'data' => [
                'trips'=>TripResource::collection($trips),
            ]
        ], 201);
    }

    public function blog()
    {
        $blogs=Blog::get();
        return response()->json([
            'status' => true,
            'message' => [
                'en'=>'data successfully show',
                'ar'=>'تم عرض البيانات بنجاح',
            ],
            'data' => [
                'blogs'=>BlogResource::collection($blogs),
            ]
        ], 201);
    }

    public function offer()
    {
        $offers=Offer::get();
        return response()->json([
            'status' => true,
            'message' => [
                'en'=>'data successfully show',
                'ar'=>'تم عرض البيانات بنجاح',
            ],
            'data' => [
                'blogs'=>OfferResource::collection($offers),
            ]
        ], 201);
    }

    public function show($id)
    {
        try {
            $country = Country::findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'Country retrieved successfully',
                'data' => new CountryResource($country)
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'status' => false,
                'message' => 'Country not found',
                'data' => []
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Error occurred while retrieving country',
                'data' => $exception->getMessage()
            ], 500);
        }
    }



}
