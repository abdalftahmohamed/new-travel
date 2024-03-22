<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\CartResource;
use App\Http\Resources\Client\CouponResource;
use App\Http\Resources\Client\TripResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\Home\ReviewResource;
use App\Http\Traits\ImageTrait;
use App\Models\Cart;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\Review;
use App\Models\Trip;
use App\Models\trips_clients_favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class ClientController extends Controller
{
    use ImageTrait;

    public function favoriteTrip(Request $request)
    {
        try {
            $request->validate([
                'trip_id' => 'nullable|integer|exists:trips,id',
            ]);
            $trip_r = Trip::find($request->trip_id);
            if (!$trip_r) {
                return response()->json([
                    'status' => false,
                    'message' => __('transMessage.messNotFound'),
                ], 400);
            }
            $client = auth('clientApi')->user();
            #check in table if found
            $trip_successfully = $client->favoriteTrips()->where('trip_id', $request->trip_id);
            if ($trip_successfully->exists()) {
                $client->favoriteTrips()->detach($request->trip_id);
                return response()->json([
                    'status' => true,
                    'message' => __('transMessage.messUnFavoriteTrip'),
                ]);
            } else {
                $client->favoriteTrips()->syncWithoutDetaching($request->trip_id);
                return response()->json([
                    'status' => true,
                    'message' => __('transMessage.messFavoriteTrip'),
                ]);
            }

        } catch (\Throwable $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ],400);
        }
    }

    public function myFavoriteTrip()
    {
        $client = auth('clientApi')->user();
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'trips'=>TripResource::collection($client->favoriteTrips()->get())
            ]
        ]);
    }


    #review
    public function addReview(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name_ar' => ['nullable', 'max:255'],
                'name' => ['nullable', 'max:255'],
                'name_ur' => ['nullable', 'max:255'],
                'stars_numbers' => 'nullable|integer',
                'description_ar' => 'nullable|string',
                'description' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'trip_id' => 'nullable|integer|exists:trips,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);

            $client = Auth::guard('clientApi')->user();
// No need to check if validation fails as Laravel will automatically handle it
            $reviewData = [
                'name' => [
                    'ar' => $validatedData['name_ar'] ?? null,
                    'en' => $validatedData['name'] ?? null,
                    'ur' => $validatedData['name_ur'] ?? null
                ],
                'description' => [
                    'ar' => $validatedData['description_ar'] ?? null,
                    'en' => $validatedData['description'] ?? null,
                    'ur' => $validatedData['description_ur'] ?? null
                ],
                'stars_numbers' => $validatedData['stars_numbers'],
                'trip_id' => $validatedData['trip_id'],
                'client_id' => $client->id,
            ];

            $review = Review::where('client_id', $client->id)
                ->where('trip_id', $validatedData['trip_id'])
                ->first();
            if ($review){
                $review->update($reviewData);
                if ($request->hasFile('image_path')) {
                    $this->deleteFile('reviews',$review->id);
                    $review_image = $this->saveImage($request->file('image_path'), 'attachments/reviews/' . $review->id);
                    $review->image_path = $review_image;
                    $review->save();
                }
            }else{
                $review = Review::create($reviewData);
                // If image is provided, save it
                if ($request->hasFile('image_path')) {
                    $review_image = $this->saveImage($request->file('image_path'), 'attachments/reviews/' . $review->id);
                    $review->image_path = $review_image;
                    $review->save();
                }
            }


            // Return response with success message and review data
            return response()->json([
                'status' => true,
                'message' => __('transMessage.messSuccessRegister'),
                'data' => [
                    'review' => new ReviewResource($review)
                ]
            ], 201);

        } catch (\Exception $exception) {
            // Log or handle the exception appropriately
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage() // Optionally, include the exception message for debugging
            ], 400);
        }
    }

    public function myReviewTrip()
    {
        $client = auth('clientApi')->user();
        return response()->json([
            'status' => true,
            'message' => __('transMessage.messSuccess'),
            'data' => [
                'reviews'=>ReviewResource::collection($client->reviws()->get())
            ]
        ]);
    }

    public function showReview(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'review_id' => 'nullable|integer|exists:reviews,id',
            ]);
            $review =Review::findOrFail($validatedData['review_id']);


            // Return response with success message and review data
            return response()->json([
                'status' => true,
                'message' => __('transMessage.messSuccess'),
                'data' => [
                    'review' => new ReviewResource($review)
                ]
            ]);

        } catch (\Exception $exception) {
            // Log or handle the exception appropriately
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage() // Optionally, include the exception message for debugging
            ], 400);
        }
    }


    public function updateReview(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name_ar' => ['nullable', 'max:255'],
                'name' => ['nullable', 'max:255'],
                'name_ur' => ['nullable', 'max:255'],
                'stars_numbers' => 'nullable|integer',
                'description_ar' => 'nullable|string',
                'description' => 'nullable|string',
                'description_ur' => 'nullable|string',
                'trip_id' => 'nullable|integer|exists:trips,id',
                'review_id' => 'required|integer|exists:reviews,id',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
            ]);
            $review =Review::findOrFail($validatedData['review_id']);

// No need to check if validation fails as Laravel will automatically handle it
            $reviewData = [
                'name' => [
                    'ar' => $validatedData['name_ar'] ?? $review->getTranslation('name','ar'),
                    'en' => $validatedData['name'] ?? $review->getTranslation('name','en'),
                    'ur' => $validatedData['name_ur'] ?? $review->getTranslation('name','ur')
                ],
                'description' => [
                    'ar' => $validatedData['description_ar'] ?? $review->getTranslation('description','ar'),
                    'en' => $validatedData['description'] ?? $review->getTranslation('description','en'),
                    'ur' => $validatedData['description_ur'] ?? $review->getTranslation('description','ur')
                ],
                'stars_numbers' => $validatedData['stars_numbers'] ?? $review->stars_numbers,
                'trip_id' => $validatedData['trip_id'] ?? $review->trip_id,
                'client_id' => Auth::guard('clientApi')->user()->id,
            ];

            $review->update($reviewData);

            // If image is provided, save it
            if ($request->hasFile('image_path')) {
                $this->deleteFile('reviews',$review->id);
                $review_image = $this->saveImage($request->file('image_path'), 'attachments/reviews/' . $review->id);
                $review->image_path = $review_image;
                $review->save();
            }


            // Return response with success message and review data
            return response()->json([
                'status' => true,
                'message' => __('transMessage.messSuccessUpdated'),
                'data' => [
                    'review' => new ReviewResource($review)
                ]
            ]);

        } catch (\Exception $exception) {
            // Log or handle the exception appropriately
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage() // Optionally, include the exception message for debugging
            ], 400);
        }
    }


    public function deleteReview(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'review_id' => 'nullable|integer|exists:reviews,id',
            ]);
            $review =Review::findOrFail($validatedData['review_id']);

            $this->deleteFile('reviews',$review->id);

            $review->delete();

            // Return response with success message and review data
            return response()->json([
                'status' => true,
                'message' => __('transMessage.messSuccessDeleted'),
            ]);

        } catch (\Exception $exception) {
            // Log or handle the exception appropriately
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage() // Optionally, include the exception message for debugging
            ], 400);
        }
    }


    public function checkCoupon(Request $request)
    {
        $coupon =Coupon::where([['coupon_name',$request->coupon_name],['status',1]])->first();
        if (!$coupon){
            return response()->json([
                'status' => false,
                'message' => __('transMessage.messCheckCouponFail'),
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => __('transMessage.messCheckCouponSuccess'),
            'data' =>[
                'coupon'=>new CouponResource($coupon)
            ]
        ]);
    }

    public function checkoutTrip(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'coupon_name' => 'nullable|string',
                'subtotal_old' => 'nullable|numeric',
                'quantity_old' => 'nullable|numeric',
                'subtotal_child' => 'nullable|numeric',
                'quantity_young' => 'nullable|numeric',
                'final_subtotal' => 'nullable|numeric',
                'coupon_amount' => 'nullable|numeric',
                'total' => 'nullable|numeric',
                'date' => 'nullable|date',
                'description' => 'nullable|string',
                'trip_id' => 'nullable|integer|exists:trips,id',
            ]);
            $validatedData['coupon_amount']=$request->discount;
            $client = Auth::guard('clientApi')->user();
            $validatedData['client_id']=$client->id;

            $cart =Cart::where([['client_id',$client->id],['trip_id',$validatedData['trip_id']]])->first();
            if ($cart){
                $cart->update($validatedData);
            }else{
                $cart = Cart::create($validatedData);
            }


            // Return response with success message and review data
            return response()->json([
                'status' => true,
                'message' => __('transMessage.messSuccess'),
                'data' => [
                    'cart' => new CartResource($cart)
                ]
            ]);

        } catch (\Exception $exception) {
            // Log or handle the exception appropriately
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage() // Optionally, include the exception message for debugging
            ], 400);
        }
    }


}
