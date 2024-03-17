<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{

    public function toArray($request)
    {

        // Get all attributes of the model
        $attributes = $this->getAttributes();

        if ($attributes['image_path'] !== null){
            $attributes['image_path'] = url('attachments/reviews/'.$attributes['id'].'/'. $attributes['image_path']);
        }else{
            $attributes['image_path'] =url(asset('admin/dist/img/no_image.jpg'));
        }

//        // List of attributes to exclude
//        $excludedAttributes = ['updated_at'];
//
//        // Remove excluded attributes from the array
//        foreach ($excludedAttributes as $attribute) {
//            unset($attributes[$attribute]);
//        }

        if ($this->blog == null){
            $blog = [];
        }else{
            $blog = new BlogResource($this->blog);
        }


        if ($this->trip == null){
            $trip = [];
        }else{
            $trip = new TripResource($this->trip);
        }


        // Merge related data
        $relatedData = [
            'client' => new ClientResource($this->client),
            'trip' => $trip,
            'blog' => $blog,
        ];

        // Merge attributes and related data
        return array_merge($attributes, $relatedData);
    }
}
