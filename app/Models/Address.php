<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'area_id',
        'street_name',
        'building_number',
        'floor_number',
        'flat_number',
        'is_main',
        'client_id',
    ];

    public function area(){
        return $this->belongsTo(Area::class);
    }
}
