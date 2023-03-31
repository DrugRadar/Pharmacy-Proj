<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPrescription extends Model
{
    use HasFactory;
    protected $fillable = [ 'prescription'];
	public function order()
    {
    	return $this->belongsTo(Order::class);
    }
}
