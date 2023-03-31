<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderMedicine;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index(){

        return view('dashboard.order.index');
    }

    public function create(){
        $pharmacies = Pharmacy::all();
        $clients = Client::all();
        $addresses=Address::all();
        $medicines=Medicine::all();
        $doctors=Doctor::all();
        return view('dashboard.order.create', ['pharmacies' => $pharmacies,'clients'=>$clients,'addresses'=>$addresses,'medicines'=>$medicines,'doctors'=>$doctors]);
    }
    
    public function store(Request $request){

        $user = Auth::user();
        $creator_type=$request->creator_type;
        $doctor = null;
        $status = 'Processing';

        // if ($user->hasRole('doctor')) {
        //     $doctor = Doctor::find($user->userable_id);
        //     $creator = 'doctor';
        //     $pharmacy = Pharmacy::find($doctor->pharmacy_id);
        //     $doctor = $doctor->id;
        // } elseif ($user->hasRole('pharmacy')) {
        //     $creator = 'pharmacy';
        //     $pharmacy = Pharmacy::find($user->userable_id);
        // } 
  
       
       $newOrder= Order::create([
            'client_id' => $request->client_id,
            'client_address_id' => $request->client_address_id,
            'assigned_pharmacy_id' => $request->assigned_pharmacy_id,
            'doctor_id'=>$request->doctor_id,
            'status'=>$request->status,
            'is_insured'=>$request->is_insured,
            'creator_type'=>$creator_type,
            'total_price'=>$request->total_price,
            // 'medicine_id' => $request->medicine_id,
        ]);
        // $order_medicines=OrderMedicine::create();
        
        foreach ($request->medicine_id as $key => $medicine_id) {
            $newOrder->orderMedicine()->create([
                'medicine_id' => $medicine_id,
                'quantity' => 1,
             ]);
        }

        return to_route('order.index'); 
        
    }
}
