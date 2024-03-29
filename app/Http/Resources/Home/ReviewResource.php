<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if ($this->image_path !== null){
            $this->image_path= url('attachments/reviews/'.$this->id.'/'. $this->image_path);
        }else{
            $this->image_path=url(asset('admin/dist/img/no_image.jpg'));
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'starsNumber' => $this->stars_numbers,
            'description' => $this->description,
            'imagePath' => $this->image_path,
            'client' => new ClientResource($this->client),
//            'trip' => new \App\Http\Resources\Client\TripResource($this->trip),
        ];
    }

}
