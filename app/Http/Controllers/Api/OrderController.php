<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderPrescription;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderController extends Controller
{
    /**
 * Create a new order.
 *
 * @param CreateOrderRequest $request
 * @return \Illuminate\Http\JsonResponse
 */

/**
 * Create a new order for a client.
 *
 * This function takes in a `CreateOrderRequest` object as a parameter, which contains the request data for creating a new order. It validates the request data, checks if the delivering address ID exists for the authenticated client, and creates a new order in the database with the provided data. The prescription data is also filled in for the order. A JSON response is returned with the status message "Order created successfully" and the order data.
 *
 * @param CreateOrderRequest $request The request object containing the order data.
 *
 * @return JsonResponse The response containing the status message and order data.
 *
 * @throws \Illuminate\Validation\ValidationException If the request data fails validation.
 * @throws \Symfony\Component\HttpKernel\Exception\HttpException If the delivering address ID does not exist for the client.
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
 * Retrieve the orders for a client.
 *
 * This function retrieves the orders associated with the authenticated client. It queries the `Order` model to fetch all orders that have the same client ID as the authenticated client. The retrieved orders are then transformed into a collection of `OrderResource` objects and returned as the response.
 *
 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection The collection of orders as `OrderResource` objects.
 */
    public function index() {
        $client = auth()->user();
        $orders = Order::where('client_id', $client->id)->get();
        return  OrderResource::collection($orders);
    }

/**
 * Retrieve the details of a specific order.
 *
 * This function retrieves the details of a specific order identified by the given ID. It queries the `Order` model to find the order with the provided ID. If the order is found, it is transformed into an `OrderResource` object and returned as the response. If the order is not found, an appropriate error response is returned.
 *
 * @param int $id The ID of the order to retrieve.
 *
 * @return \Illuminate\Http\JsonResponse The order details as an `OrderResource` object, or an error response if the order is not found.
 */
    public function show($id){
        $client = auth()->user();
        $order = Order::find($id);
        return response()->json(new OrderResource($order), 200);
    }


/**
 * Update the details of an existing order.
 *
 * This function updates the details of an existing order identified by the given ID. It first retrieves the order using the `Order` model and checks if the order status is "new". If the order status is "new", it then validates and updates the order details based on the provided request data. If the updated order details are valid, the order is saved and a success response is returned with the updated order details. If the order status is not "new", an appropriate error response is returned indicating that the order cannot be updated. If the delivering address ID provided in the request does not exist for the client, another error response is returned indicating the same.
 *
 * @param CreateOrderRequest $request The request object containing the updated order details.
 * @param int $id The ID of the order to update.
 *
 * @return \Illuminate\Http\JsonResponse The updated order details as a JSON response, or an error response if the order status is not "new" or the delivering address ID does not exist for the client.
 */

    public function edit(CreateOrderRequest $request,$id){
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