<?php

namespace App\Models;

use App\Models\Medicine;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMedicine extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity'   
    ];
    public function order()
    {
    	return $this->belongsTo(Order::class);
    }
    public function medicine()
    {
        return $this->hasMany(Medicine::class);
    }
}
