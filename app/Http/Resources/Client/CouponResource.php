<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Home\AddressResource;
use App\Http\Resources\Home\ImageOfferResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'coupon_name' => $this->coupon_name,
            'coupon_amount' => $this->coupon_amount,
            'coupon_start' => $this->coupon_start,
            'coupon_end' => $this->coupon_end,
            ];
    }

}
