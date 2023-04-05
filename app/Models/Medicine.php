<?php

namespace App\Models;

use App\Models\OrderMedicine;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'name',
        'type',
        'price',
    ];

    public function orderMedicine()
    {
    	return $this->belongsToMany(OrderMedicine::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => ($value/100),
            set : fn (int $value) => ($value*100),
        );
    }
}
