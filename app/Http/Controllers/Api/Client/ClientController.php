<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\TripResource;
use App\Http\Resources\ClientResource;
use App\Http\Traits\ImageTrait;
use App\Models\Trip;
use Illuminate\Http\Request;


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
                    'message' => [
                        'en' => 'trip not found',
                        'ar' => 'الرحلة غير موجوده',
                    ],
                ], 400);
            }
            $trip_successfully = auth('clientApi')->user()->favoriteTrips();
            if ($trip_successfully->exists()){
                $trip_successfully->detach($request->trip_id);
                return response()->json([
                    'status' => true,
                    'message' => __('transMessage.messUnFavoriteTrip'),
                ]);
            }else{
                $trip_successfully->syncWithoutDetaching($request->trip_id);
                return response()->json([
                    'status' => true,
                    'message' => __('transMessage.messFavoriteTrip'),
                ]);
            }

        } catch (\Throwable $ex) {
            return response()->json([
                'status' => false,
                'message' =>$ex->getMessage()
            ], 501);
        }
    }

    public function myFavoriteTrip()
    {
        $client = auth('clientApi')->user();
        return response()->json([
            'status' => true,
            'message' =>__('transMessage.messSuccess'),
            'data'=>TripResource::collection($client->favoriteTrips()->get())
        ]);
    }
}
