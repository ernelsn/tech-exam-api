<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'street'  => $this->street,
            'suite'   => $this->suite,
            'city'    => $this->city,
            'zipcode' => $this->zipcode,
            'geo'     => [
                'lat' => $this->geo_lat,
                'lng' => $this->geo_lng,
            ],
        ];
    }
}