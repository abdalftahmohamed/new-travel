<?php

namespace App\Http\Resources\Home;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'description' => $this->trip_description,
            'oldPrice' => $this->old_price,
            'childPrice' => $this->young_price,
            'imagePath' => $this->image_path,
            'department' => $this->department,
            'addresses' => AddressResource::collection($this->addresses),
            'images' => ImageTripResource::collection($this->images),
            'clientFavourite' => ClientResource::collection($this->favoriteClients),
        ];
    }

}
