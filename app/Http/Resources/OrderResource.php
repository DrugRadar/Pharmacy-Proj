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
        $pharmacyInfo = $this->resource['assigned_pharmacy'];
        $avatar_url = url($pharmacyInfo['avatar_image']);
        
        return [
            'id' => $this->resource['id'],
            'medicines' => $this->resource['medicines'],
            'order_total_price' => $this->resource['order_total_price'],
            'ordered_at' => $this->resource['ordered_at'],
            'status' => $this->resource['status'],
            'assigned_pharmacy' => [
                'id' => $pharmacyInfo['id'],
                'name' => $pharmacyInfo['name'],
                'address' => $pharmacyInfo['address'],
                'avatar_image_url' => $avatar_url,
            ]
        ];
    }
}