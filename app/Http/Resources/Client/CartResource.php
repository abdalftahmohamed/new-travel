<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Home\AddressResource;
use App\Http\Resources\Home\ClientResource;
use App\Http\Resources\Home\ImageOfferResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            'id'=>$this->id,
            'trip_id' => $this->trip_id,
            'subtotal_old' => $this->subtotal_old,
            'quantity_old' => $this->quantity_old,
            'subtotal_child' => $this->subtotal_child,
            'quantity_young' => $this->quantity_young,
            'final_subtotal' => $this->final_subtotal,
            'coupon_name' => $this->coupon_name,
            'discount' => $this->coupon_amount,
            'total' => $this->total,
            'date' => $this->date,
            'description' => $this->description,
            'client' => new ClientResource($this->client),
            'trip' => new \App\Http\Resources\Client\TripResource($this->trip),
            ];
    }

}
