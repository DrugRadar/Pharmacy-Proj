<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderPrescription;
use App\Models\Pharmacy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function create(Request $request){
    
    $client = auth()->user();
    $is_insured = $request->input('is_insured');
    
    $is_insured = filter_var($is_insured, FILTER_VALIDATE_BOOLEAN);
    $prescriptions = $request->file('prescription');
    $delivering_address_id = $request->input('delivering_address_id');
    $clientAddress = Address::find($delivering_address_id);
    $pharmacy = Pharmacy::where('area_id', $clientAddress->area_id)->first();
    

    $order = new Order([
        'client_address_id' => $delivering_address_id,
        'assigned_pharmacy_id'=> $pharmacy->id,
        'doctor_id'=>null,
        'is_insured' => $is_insured,
        'status'=> "new",
        'creator_type'=>"client",
        'total_price'=>null,
        'client_id'=> $client->id
        
    ]);
    
    $order->save();
    $this->fillPrescription($prescriptions,$order->id);
    return response()->json([
        'message' => 'Order created successfully',
       'data' => $order
    ], 200);
        
    }

    private function fillPrescription($prescriptions, $order_id) {
       foreach ($prescriptions as $prescription) {
            $prescriptionName = $prescription->getClientOriginalName();
            $prescriptionPath = $prescription->storeAs('public/image', $prescriptionName);
    
            $orderPrescription = new OrderPrescription([
                'prescription' => $prescriptionName,
                'order_id' => $order_id
            ]);
            $orderPrescription->save();
       }
    }
    
    public function show(){
        
    }
}