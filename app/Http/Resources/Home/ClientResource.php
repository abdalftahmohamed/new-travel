<?php

namespace App\Http\Resources\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{

    public function toArray($request)
    {

        if ($this->image_path !== null) {
            $this->image_path = url('attachments/clients/' . $this->id . '/' . $this->image_path);
        } else {
            $this->image_path = url(asset('admin/dist/img/no_image.jpg'));
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'image_path' => $this->image_path,
        ];
    }}
