<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Http\Requests\Api\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Address;
use App\Models\Client;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderMedicine;
use App\Models\OrderPrescription;
use App\Models\Pharmacy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
 * Create a new order.
 *
 * @param CreateOrderRequest $request
 * @return \Illuminate\Http\JsonResponse
 */

    public function create(CreateOrderRequest $request){
        $client = auth()->user();
        $validated = $request->validated();
        $is_insured = $validated['is_insured'];

        $is_insured = filter_var($is_insured, FILTER_VALIDATE_BOOLEAN);
        $prescriptions = $validated['prescription'];
        $delivering_address_id = $request->input('delivering_address_id');

        if( $this->checkForClientAddress($delivering_address_id , $client->id) ){
            $order = new Order([
                'client_address_id' => $delivering_address_id,
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
        }else{
            return response()->json("The entered address id ($request->delivering_address_id) does not exist for the client", 400);
        }
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

    /**
 * Retrieve a list of orders for the authenticated client.
 *
 * @return \Illuminate\Http\JsonResponse
 */

    public function index() {
        $client = auth()->user();
        $orders = Order::where('client_id', $client->id)->get();
        return  response()->json(OrderResource::collection($orders)); 
    }

    /**
 * Display the specified order.
 *
 * @param  int  $id
 */

    public function show($id){
        $client = auth()->user();
        $order = Order::find($id);
        return response()->json(new OrderResource($order), 200);
    }


/**
 * Update an existing order.
 *
 * @param UpdateOrderRequest $request
 * @param int $id
 */

    public function edit(UpdateOrderRequest $request,$id){
        $order = Order::find($id);

        if($order->status == "new"){
            if( $this->checkForClientAddress($request->delivering_address_id , $id) ){

                $order->is_insured = $request->is_insured;
                $order->client_address_id = $request->delivering_address_id;

                if($request->hasFile('prescription')){
                    $this->deletePrescription($id);
                    $this->fillPrescription($request->prescription, $id);
                }

                return response()->json( ['message' => 'Order updated successfully',
                    'data' => $order], 202);
            }else{
                return response()->json("The entered address id ($request->delivering_address_id) does not exist for the client", 400);
            }
        }else{
            return response()->json( "Your order is in processing, you cant update it", 400);
        }
    }

    private function checkForClientAddress($delivering_address_id, $client_id){
        $address = Address::find($delivering_address_id);

        if($address != null){
            if($address->client_id == $client_id){
                return true;
            }
        }
        return false;
    }

    private function deletePrescription($order_id) {
        $rows = OrderPrescription::where("order_id", $order_id)->get();
        foreach ($rows as $row) {
            $imagePath = 'image/'.$row->prescription;
            Storage::delete($imagePath);
        }
        $rows = OrderPrescription::where("order_id", $order_id)->delete();
    }

}