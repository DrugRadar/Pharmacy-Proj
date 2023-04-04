<?php

namespace App\Models;

use App\Models\Medicine;
use App\Models\OrderPrescription;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'client_id',
        'assigned_pharmacy_id',
        'doctor_id',
        'is_insured',
        'status',
        'creator_type',
        'total_price',
        'client_address_id'
    ];
    public function orderMedicine()
    {
        return $this->hasMany(OrderMedicine::class);
    }
    public function orderPrescription()
    {
        return $this->hasMany(OrderPrescription::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }    
}