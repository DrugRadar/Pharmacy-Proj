<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Requests\Api\AddressRegisterRequest;

/**
 * @group Address management
 *
 * APIs for managing addresses of clients
 */

class AddressController extends Controller
{

/**
 * @api {post} /api/addresses Create Address
 * @apiName CreateAddress
 * @apiGroup Addresses
 *
 * @apiDescription Create a new address resource for the authenticated user.
 *
 * @apiHeader {String} Authorization Bearer <access_token>
 *
 * @apiParam {Number} area_id ID of the area where the address is located.
 * @apiParam {String} street_name Name of the street where the address is located.
 * @apiParam {String} building_number Building number of the address.
 * @apiParam {Number} [floor_number] Floor number of the address.
 * @apiParam {Number} [flat_number] Flat number of the address.
 * @apiParam {Boolean} is_main Flag indicating whether the address is the user's main address.
 *
 * @apiSuccess {String} message Success message.
 * @apiSuccess {Object} data Address resource.
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "message": "Address added successfully",
 *       "data": {
 *         "id": 1,
 *         "area_id": 1,
 *         "street_name": "Example Street",
 *         "building_number": "123",
 *         "floor_number": 4,
 *         "flat_number": 16,
 *         "is_main": true,
 *         "client_id": 1,
 *         "created_at": "2023-04-03T10:00:00.000000Z",
 *         "updated_at": "2023-04-03T10:00:00.000000Z"
 *       }
 *     }
 *
 * @apiError Unauthorized The user must be authenticated.
 * @apiErrorExample {json} Error-Response:
 *     HTTP/1.1 401 Unauthorized
 *     {
 *       "error": "Unauthorized"
 *     }
 *
 * @apiError BadRequest The request parameters are invalid.
 * @apiErrorExample {json} Error-Response:
 *     HTTP/1.1 400 Bad Request
 *     {
 *       "error": "Invalid request parameters"
 *     }
 *
 * @apiError InternalServerError An internal server error occurred.
 * @apiErrorExample {json} Error-Response:
 *     HTTP/1.1 500 Internal Server Error
 *     {
 *       "error": "Internal Server Error"
 *     }
 */
    public function create(AddressRegisterRequest $request){

        $client = auth()->user();

        $areaId= $request->area_id;
        $street_name = $request->street_name;
        $building_number = $request->building_number;
        $floor_number = $request->floor_number;
        $flat_number = $request->flat_number;
        $is_main = $request->is_main;

        $validated = new Address([
            'area_id' => $areaId,
            'street_name'=> $street_name,
            'building_number'=>$building_number,
            'floor_number' => $floor_number,
            'flat_number'=> $flat_number,
            'is_main'=>$is_main,
            'client_id'=> $client->id
        ]);

        $validated->save();
        return response()->json([
            'message' => 'Address added successfully',
            'data' => $validated
        ], 200);
    }

    /**
 * @api {get} /api/addresses/:id Get User Addresses
 * @apiName GetUserAddresses
 * @apiGroup Addresses
 *
 * @apiDescription Retrieve a list of addresses for the specified user.
 *
 * @apiHeader {String} Authorization Bearer <access_token>
 *
 * @apiParam {Number} id User ID.
 *
 * @apiSuccess {Array} addresses List of addresses.
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     [
 *       {
 *         "id": 1,
 *         "street_name": "Example Street",
 *         "building_number": "123",
 *         "floor_number": 4,
 *         "flat_number": 16,
 *         "is_main": true,
 *         "client_id": 1
 *       },
 *       {
 *         "id": 2,
 *         "street_name": "Another Street",
 *         "building_number": "456",
 *         "floor_number": 2,
 *         "flat_number": 8,
 *         "is_main": false,
 *         "client_id": 1
 *       }
 *     ]
 *
 * @apiError Unauthorized The user must be authenticated.
 * @apiErrorExample {json} Error-Response:
 *     HTTP/1.1 401 Unauthorized
 *     {
 *       "error": "Unauthorized"
 *     }
 *
 * @apiError NotFound The specified user was not found.
 * @apiErrorExample {json} Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": "User not found"
 *     }
 *
 * @apiError InternalServerError An internal server error occurred.
 * @apiErrorExample {json} Error-Response:
 *     HTTP/1.1 500 Internal Server Error
 *     {
 *       "error": "Internal Server Error"
 *     }
 */

    public function index($id) {
        $client = auth()->user();
        $addresses = Address::where('client_id', $id)->get();
        $showAddresses = [];

        foreach ($addresses as $address) {
            $showAddresses[] = [
                'id' => $address->id,
                'street_name' => $address->street_name,
                'building_number' => $address->building_number,
                'floor_number' => $address->floor_number,
                'flat_number' => $address->flat_number,
                'is_main' => $address->is_main,
                'client_id' => $address->client_id,
            ];
        }

        return response()->json($showAddresses, 200);
    }

    /**
 * @group Addresses
 *
 * Update the specified address of a client
 *
 * @bodyParam street_name string required The street name of the address.
 * @bodyParam building_number string required The building number of the address.
 * @bodyParam floor_number string required The floor number of the address.
 * @bodyParam flat_number string required The flat number of the address.
 * @bodyParam is_main boolean required Whether the address is the main address of the client.
 *
 * @param int $clientId The ID of the client.
 * @param int $addressId The ID of the address to update.
 * @param \Illuminate\Http\Request $request The HTTP request object.
 *
 * @response {
 *  "data": {
 *      "id": 1,
 *      "street_name": "123 Main St",
 *      "building_number": "5",
 *      "floor_number": "3",
 *      "flat_number": "10",
 *      "is_main": true,
 *      "client_id": 1
 *  },
 *  "message": "Address updated successfully"
 * }
 * @response 404 {
 *  "error": "Address not found"
 * }
 */

    public function update(Request $request, $clientId, $addressId){

        $address = Address::where('client_id', $clientId)->where('id', $addressId)->first();
        $request = $request->all();
        if (!$address) {
        return "Address not found";
        }

        $address->street_name = $request['street_name'];
        $address->building_number = $request['building_number'];
        $address->floor_number = $request['floor_number'];
        $address->flat_number = $request['flat_number'];
        $address->is_main = $request['is_main'];

        $address->save();

        return new AddressResource($address);
}

/**
 * @group address
 * Delete a specific address for a client.
 *
 * @urlParam clientId required The ID of the client who owns the address.
 * @urlParam addressId required The ID of the address to be deleted.
 *
 * @response {
 *   "message": "Address deleted successfully"
 * }
 * @response 404 {
 *   "message": "Address not found"
 * }
 */

    public function delete($clientId, $addressId){
        $address = Address::where('client_id', $clientId)->where('id', $addressId)->delete();
        return response()->json( "Message deleted successfully", 200);
    }
}