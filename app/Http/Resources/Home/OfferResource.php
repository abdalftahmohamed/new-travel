<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($this->image_path !== null){
            $this->image_path= url('attachments/offers/'.$this->id.'/'. $this->image_path);
        }else{
            $this->image_path=url(asset('admin/dist/img/no_image.jpg'));
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->offer_description,
            'oldPrice' => $this->old_price,
            'childPrice' => $this->young_price,
            'addresses' => AddressResource::collection($this->addresses),
            'images' => ImageOfferResource::collection($this->images),
            ];
    }

}
