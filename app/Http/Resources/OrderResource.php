<?php

namespace App\Http\Resources;

use App\Http\Resources\MedicineOrderResource;
use App\Models\OrderMedicine;
use App\Models\Pharmacy;
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

        $pharmacyInfo = Pharmacy::where('id', $this->assigned_pharmacy_id)->first();
        // $medicineIds = OrderMedicine::where('order_id', $this->id)->pluck('medicine_id');
        $orderMedicine = OrderMedicine::where('order_id', $this->id)->get();
        // $medicinesInfo = Medicine::whereIn('id', $medicineIds)->get();
        // $append = [$medicineIds , $medicinesInfo];

        return [
            'id' => $this->id,
            'medicines' => MedicineOrderResource::collection($orderMedicine),
            'order_total_price' => $this->total_price,
            'ordered_at' => $this->created_at->diffForHumans(),
            'status' => $this->status,
            'assigned_pharmacy' => [
                'id' => $pharmacyInfo->id,
                'name' => $pharmacyInfo->name,
                'area_id' => $pharmacyInfo->area_id,
            ]
        ];
    }
}