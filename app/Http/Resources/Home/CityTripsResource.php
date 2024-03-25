<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityTripsResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        if ($this->image_path !== null){
            $this->image_path= url('attachments/citys/'.$this->id.'/'. $this->image_path);
        }else{
            $this->image_path=url(asset('admin/dist/img/no_image.jpg'));
        }

        if ($request->filled(['start']) || $request->filled(['limit'])) {
            $start = $request->input('start', 0);
            $limit = $request->input('limit', $this->trips->count());
            $this->trips = $this->trips->slice($start, $limit);
        }


//        if ($request->filled(['start', 'limit'])) {
//            $this->trips = $this->trips->offset($request->start)->limit($request->limit)->get();
//        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'imagePath' => $this->image_path,
            'country' => $this->country->name,
            'trips' => TripResource::collection($this->trips),
        ];
    }
}
