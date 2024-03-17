<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->image_path !== null){
            $this->image_path= url('attachments/clients/'.$this->id.'/'. $this->image_path);
        }else{
            $this->image_path=url(asset('admin/dist/img/no_image.jpg'));
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'image_path' => $this->image_path,
        ];
    }
}
