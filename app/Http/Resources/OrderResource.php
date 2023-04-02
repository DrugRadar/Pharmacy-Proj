<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // $pharmacyInfo = $this->assigned_pharmacy;
        //$avatar_url = url($pharmacyInfo->avatar_image);
    
        return [
            'id' => $this->id,
            'medicines' => $this->medicines->id,
            // 'order_total_price' => $this->order_total_price,
            // 'ordered_at' => $this->ordered_at,
            // 'status' => $this->status,
            // 'assigned_pharmacy' => [
            //     'id' => $pharmacyInfo->id,
            //     'name' => $pharmacyInfo->name,
            //     'address' => $pharmacyInfo->address,
            //     'avatar_image_url' => $avatar_url,
            // ]
        ];
    }
}