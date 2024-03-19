<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        if ($this->image_path !== null){
            $this->image_path= url('attachments/citys/'.$this->id.'/'. $this->image_path);
        }else{
            $this->image_path=url(asset('admin/dist/img/no_image.jpg'));
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'imagePath' => $this->image_path,
            'country' => $this->country->name,
        ];
    }
}
