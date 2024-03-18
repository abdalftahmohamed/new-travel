<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{

    public function toArray($request)
    {

        // Get all attributes of the model
        $attributes = $this->getAttributes();

        if ($attributes['image_path'] !== null){
            $attributes['image_path'] = url('attachments/trips/'.$attributes['id'].'/'. $attributes['image_path']);
        }else{
            $attributes['image_path'] =url(asset('admin/dist/img/no_image.jpg'));
        }

        // List of attributes to exclude
        $excludedAttributes = ['trip_date','status','cus_rating'];

        // Remove excluded attributes from the array
        foreach ($excludedAttributes as $attribute) {
            unset($attributes[$attribute]);
        }

        // Merge related data
        $relatedData = [
            'clientFavourite' => ClientResource::collection($this->favoriteClients),
            'addresses' => $this->addresses,
        ];

        // Merge attributes and related data
        return array_merge($attributes, $relatedData);
    }
}
