<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'area_id',
        'street_name',
        'building_number',
        'floor_number',
        'flat_number',
        'is_main',
        'client_id',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
