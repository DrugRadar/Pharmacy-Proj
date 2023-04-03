<?php

namespace App\Http\Resources;

use App\Http\Resources\MedicineResource;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        $medicinesInfo = Medicine::where('id', $this->id)->get();

        return [
            'medicine_info'=> MedicineResource::collection($medicinesInfo),
            'quantity' => $this->quantity,
        ];
    }
}
