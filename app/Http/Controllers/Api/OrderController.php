<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Models\Address;
use App\Models\Client;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderMedicine;
use App\Models\OrderPrescription;
use App\Models\Pharmacy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function create(CreateOrderRequest $request){
    
    $client = auth()->user();
    $validated = $request->validated();

    $is_insured = $validated['is_insured'];
    
    $is_insured = filter_var($is_insured, FILTER_VALIDATE_BOOLEAN);
    $prescriptions = $validated['prescription'];
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
    public function index() {
        $client = auth()->user();
        $orders = Order::where('client_id', $client->id)->get();
        $formattedOrders = [];
        
        foreach ($orders as $order) {
            $pharmacyInfo = Pharmacy::where('id', $order->assigned_pharmacy_id)->first();
            $medicineIds = OrderMedicine::where('order_id', $order->id)->pluck('medicine_id');
            $medicinesInfo = Medicine::whereIn('id', $medicineIds)->get();
            $medicines = [];
            foreach ($medicinesInfo as $medicineInfo) {
                $medicines[] = [
                    'id'=>$medicineInfo->id,
                    'name' => $medicineInfo->name,
                    'type' => $medicineInfo->type,
                    'quantity' => $medicineInfo->quantity,
                    'total_price' => $medicineInfo->total_price
                ];
            }
            $formattedOrder = [
                'id' => $order->id,
                'medicines' => $medicines,
                'order_total_price' => $order->total_price,
                'ordered_at' => $order->created_at->diffForHumans(),
                'status' => $order->status,
                'assigned_pharmacy' => [
                    'id' => $pharmacyInfo->id,
                    'name' => $pharmacyInfo->name,
                    'area_id' => $pharmacyInfo->area_id,
                    'avatar_image' => $pharmacyInfo->avatar_image,
                ]
            ];
            $formattedOrders[] = $formattedOrder;
        }
        
        return response()->json($formattedOrders, 200);
    }

    public function show($id){
        $client = auth()->user();
        $order = Order::find($id);
        $pharmacyInfo = Pharmacy::where('id', $order->assigned_pharmacy_id)->first();
        $medicineIds = OrderMedicine::where('order_id', $order->id)->pluck('medicine_id');
        $medicinesInfo = Medicine::whereIn('id', $medicineIds)->get();
        $avatar_url = url($pharmacyInfo->avatar_image);
        $medicines = [];
        foreach ($medicinesInfo as $medicineInfo) {
            $medicines[] = [
                'id'=>$medicineInfo->id,
                'name' => $medicineInfo->name,
                'type' => $medicineInfo->type,
                'quantity' => $medicineInfo->quantity,
                'total_price' => $medicineInfo->total_price
            ];
        }
        $formattedOrder = [
            'id' => $order->id,
            'medicines' => $medicines,
            'order_total_price' => $order->total_price,
            'ordered_at' => $order->created_at->diffForHumans(),
            'status' => $order->status,
            'assigned_pharmacy' => [
                'id' => $pharmacyInfo->id,
                'name' => $pharmacyInfo->name,
                'address' => $pharmacyInfo->area_id,
                'avatar_image_url' => $avatar_url,
            ]
        ];
        return response()->json($formattedOrder, 200);
    }
    
}