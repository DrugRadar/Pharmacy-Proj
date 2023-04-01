<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create(Request $request){

        $client = auth()->user();
        $validated = $request->all();

        $areaId= $validated['area_id'];
        $street_name = $validated['street_name'];
        $building_number = $validated['building_number'];
        $floor_number = $validated['floor_number'];
        $flat_number = $validated['flat_number'];
        $is_main = $validated['is_main'];

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

    public function delete($clientId, $addressId){
        $address = Address::where('client_id', $clientId)->where('id', $addressId)->delete();
        return response()->json( "Message deleted successfully", 200);
        // $address->delete();

    }
}