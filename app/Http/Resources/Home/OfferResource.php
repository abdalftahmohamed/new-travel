<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{

    public function toArray($request)
    {

        // Get all attributes of the model
        $attributes = $this->getAttributes();

//        if ($attributes['image_path'] !== null){
//            $attributes['image_path'] = url('attachments/offers/'.$attributes['id'].'/'. $attributes['image_path']);
//        }else{
//            $attributes['image_path'] =url(asset('admin/dist/img/no_image.jpg'));
//        }

        // List of attributes to exclude
        $excludedAttributes = ['offer_date','status','cus_rating','company_id','city','country'];

        // Remove excluded attributes from the array
        foreach ($excludedAttributes as $attribute) {
            unset($attributes[$attribute]);
        }

        // Merge related data
        $relatedData = [
            'trip' => new TripResource($this->trip),
        ];

        // Merge attributes and related data
        return array_merge($attributes, $relatedData);
    }
}
