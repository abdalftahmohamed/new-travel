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
//        $topDestinations = City::latest()->take(5)->get();
        #للحصول علي اخر خمس عناصر
        $topDestinations = City::get()->slice(-9);

        $categories = Department::get()->slice(-8);
        $bestOffers = Trip::where('type','Best Offers')->get()->slice(-9);
        $BestTripstrips = Trip::where('type','Best Trips')->get()->slice(-9);
        $PopularExperiencetrips = Trip::where('type','Popular Experiences')->get()->slice(-9);
        $blogs=Blog::get()->slice(-9);
        $ourPartners=OurPartner::get()->slice(-9);
        $reviews = Review::whereIn('stars_numbers', [3, 4, 5])->get();

        return response()->json([
            'status' => true,
            'message' =>__('transMessage.messSuccess'),
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


    public function trip($ar)
    {
        $trips = Trip::get();

        return response()->json([
            'status' => true,
            'message' =>__('transMessage.messSuccess'),
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


    public function searchTrip(Request $request)
    {
        try {
//            $r=Trip::findOrFail($request->name);
            if (isset($request->name)){
                $trip_search = Trip::where('status',1)->whereRaw("name LIKE ?", ['%'.$request->name.'%'])->get();
                return response()->json([
                    'status' => true,
                    'message' => [
                        'ar'=>'تم رجوع البانات بنجاح',
                        'en'=>'data return successfully'
                    ],
                    'data'=>\App\Http\Resources\Home\TripResource::collection($trip_search)
                ]);
            }

        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => [
                    'ar'=>'لا توجد بيانات بهذا الاسم',
                    'en'=>'not found any data'
                ],
            ], 501);
        }
    }

    public function searchBlog(Request $request)
    {
        try {
            if (isset($request->name)){
                $blog_search = Blog::whereRaw("name LIKE ?", ['%'.$request->name.'%'])->get();
                return response()->json([
                    'status' => true,
                    'message' => [
                        'ar'=>'تم رجوع البانات بنجاح',
                        'en'=>'data return successfully',
//                        'or'=>'data return successfully',
                    ],
                    'data'=>\App\Http\Resources\Home\BlogResource::collection($blog_search)
                ]);
            }

        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => [
                    'ar'=>'لا توجد بيانات بهذا الاسم',
                    'en'=>'not found any data'
                ],
            ], 404);
        }
    }

}
