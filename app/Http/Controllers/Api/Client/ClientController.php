<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Models\Trip;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    use ImageTrait;

    public function favoriteTrip(Request $request)
    {
        try {
            $trip_r = Trip::find($request->trip_id);
            if (!$trip_r) {
                return response()->json([
                    'status' => false,
                    'message' => [
                        'en' => 'trip not found',
                        'ar' => 'الرحلة غير موجوده',
                    ],
                ], 400);
            }
            $trip_successfully = auth('clientApi')->user()->favoriteTrips();
            $trip_successfully->syncWithoutDetaching($request->trip_id);
            return response()->json([
                'status' => true,
                'message' => [
                    'en' => 'created favorite successfully',
                    'ar' => 'تم تسجيل الرحلة للمفضله بنجاح',
                ],
            ]);
        } catch (\Throwable $ex) {
            return response()->json([
                'message' => [
                    'en' => 'Error System Please try again',
                    'ar' => 'خطأ بالنظام',
                ],
                'status' => false,
                'error' => $ex->getMessage()
            ], 501);
        }
    }

    public function unFavoriteTrip(Request $request)
    {
        try {
            $trip_r = Trip::find($request->trip_id);
            if (!$trip_r) {
                return response()->json([
                    'status' => false,
                    'message' => [
                        'en' => 'trip not found',
                        'ar' => 'الرحلة غير موجوده',
                    ],
                ], 400);
            }
            $trip_successfully = auth('clientApi')->user()->favoriteTrips();
            $trip_successfully->detach($request->trip_id);
            return response()->json([
                'status' => true,
                'message' => [
                    'en' => 'Not preferred successfully',
                    'ar' => 'تم الازاله من المفضله بنجاح',
                ],
            ]);
        } catch (\Throwable $ex) {
            return response()->json([
                'status' => false,
                'message' => [
                    'en' => 'Error System Please try again',
                    'ar' => 'خطأ بالنظام',
                ],
                'error' => $ex->getMessage()
            ], 501);
        }
    }


}
