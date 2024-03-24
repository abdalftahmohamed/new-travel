<?php

namespace App\Http\Resources\Search;

use App\Http\Resources\Home\AddressResource;
use App\Http\Resources\Home\ImageTripResource;
use App\Models\Client;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($this->image_path !== null){
            $this->image_path= url('attachments/trips/'.$this->id.'/'. $this->image_path);
        }else{
            $this->image_path=url(asset('admin/dist/img/no_image.jpg'));
        }

        $check = false;
        if ($request->has('client_id')) {
            $client = Client::find($request->client_id);
            if ($client !== null) {
                $check = $client->favoriteTrips->contains($this->id);
            }
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'description' => $this->trip_description,
            'oldPrice' => $this->old_price,
            'childPrice' => $this->young_price,
            'beforePrice' => $this->old_new_price,
            'saving' => $this->saving,
            'imagePath' => $this->image_path,
            'addresses' => AddressResource::collection($this->addresses),
            'images' => ImageTripResource::collection($this->images),
        ];
    }

}
