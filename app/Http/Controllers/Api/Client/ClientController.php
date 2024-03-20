<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\TripResource;
use App\Http\Resources\ClientResource;
use App\Http\Traits\ImageTrait;
use App\Models\Trip;
use App\Models\trips_clients_favorite;
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
}
