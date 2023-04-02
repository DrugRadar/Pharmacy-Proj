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
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    //
    public function index(Request $request){
        if(Auth::user()->hasrole('admin')){
            $data = Order::with('doctor')->latest()->get();
        }
        else if(Auth::user()->hasrole('pharmacy')){
            $data = Order::where('assigned_pharmacy_id', Auth::user()->userable_id)->with('doctor')->get();
        }
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('client_name', function ($row) {
                    return $row->client->name;
                })
                ->addColumn('doctor_name', function ($row) {
                return $row->doctor?->name ?? 'N/A';
                })
                ->addColumn('creator_type', function ($row) {
                    return $row->creator_type;
                    })
                ->addColumn('action', function($row) {
                    $actionBtn = '<a href="/orders/process/'.$row->id.'" class="edit btn btn-success btn-sm me-1">Process</a><a href="/orders/edit/'.$row->id.'" class="edit btn btn-dark me-1 btn-sm">EDIT</a> <button type="button" class="delete btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" id="'.$row->id.'">DELETE </button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.order.index');
    }

    public function create(){
        $user = Auth::user();
        $pharmacies = Pharmacy::all();
        $clients = Client::all();
        $addresses=Address::all();
        $medicines=Medicine::all();
        if($user->hasRole('pharmacy'))
        {
            $doctors=Doctor::where('pharmacy_id', $user->userable_id)->get();
        }
        if($user->hasRole('admin'))
        {
            $doctors=Doctor::all();
        }
        return view('dashboard.order.create', ['pharmacies' => $pharmacies,'clients'=>$clients,'addresses'=>$addresses,'medicines'=>$medicines,'doctors'=>$doctors]);
    }

    public function store(Request $request){

        $user = Auth::user();
        $creator_type=$request->creator_type;
        $doctor = null;
        $status = 'Processing';
        $assigned_pharmacy=$request->assigned_pharmacy_id;
        if ($user->hasRole('doctor')) {
            $doctor = Doctor::find($user->userable_id);
            $creator_type = 'doctor';
            $assigned_pharmacy = $doctor->pharmacy_id;
            $doctor = $doctor->id;
        } elseif ($user->hasRole('pharmacy')) {
            $creator_type = 'pharmacy';
            $assigned_pharmacy = $user->userable_id;
        }
        $newOrder= Order::create([
            'client_id' => $request->client_id,
            'client_address_id' => $request->client_address_id,
            'assigned_pharmacy_id' => $assigned_pharmacy,
            'doctor_id'=>$request->doctor_id,
            'status'=>$request->status,
            'is_insured'=>$request->is_insured,
            'creator_type'=>$creator_type,
            'total_price'=>$request->total_price,
        ]);
        // $this->pushMedicinesToOrder($request,$newOrder);
        return to_route('order.index'); 
        
    }

    public function process($id){
        $user = Auth::user();
        $order= Order::find($id);
        $client=Client::find($order->client_id);
        $doctors=Doctor::where('pharmacy_id', $order->assigned_pharmacy_id)->get();
        $medicines=Medicine::all();
        $clientAddress=Address::find($order->client_address_id);
        if($user->hasRole('admin'))
        {
            $pharmacies=Pharmacy::all();
            return view('dashboard.order.process',['order' => $order,'client'=>$client,'medicines'=>$medicines,'doctors'=>$doctors,'clientAddress'=>$clientAddress,'pharmacies'=>$pharmacies]);
        }
        return view('dashboard.order.process',['order' => $order,'client'=>$client,'medicines'=>$medicines,'doctors'=>$doctors,'clientAddress'=>$clientAddress]);
    }
    public function continue(Request $request,$orderId){
        $medicine_id= $request->medicine_id;
        $medicines =array() ;
        foreach ($medicine_id as $key => $value) {
            $medicine=Medicine::find($value);
            if($medicine)
            {
                array_push( $medicines,$medicine);
            }
            else{
                array_push( $medicines,$value);
            }
        }
        session()->put('data',$request->all());
        return view('dashboard.order.medicinesOrder',['data' => $request,'orderId' => $orderId,'medicines'=>$medicines]);
    }
    public function send(Request $request,$id){
        $order= Order::find($id);
        $orderInfo=session()->get('data');
        $medicinesQuantities=$request->quantity;
        // dd($orderInfo);
        $this->pushMedicinesToOrder($orderInfo,$order,$medicinesQuantities);
        $order->total_price = $request->total;
        $order->status="WaitingForUserConfirmation";
        $order->doctor_id=$orderInfo['doctor_id'];
        $order->save();
        return to_route('order.index'); 
    }


    public function destroy($id){
        $order = Order::find($id);
        $order->delete();
        return to_route('order.index'); 
    }

    private function pushMedicinesToOrder($orderInfo,$order,$medicinesQuantities){
    try {
    foreach ($orderInfo['medicine_id'] as $key => $medicine_id) {
        $medicine=Medicine::find($medicine_id);
        if ($medicine) {
            $order->orderMedicine()->create([
                    'medicine_id' => $medicine_id,
                    'quantity' => $medicinesQuantities[$key],
                    ]);
        } else {
            $order->orderMedicine()->create([
                'medicine_name' => $medicine_id,
                'quantity' => $medicinesQuantities[$key],
            ]);
        }
    }
    }catch (\Exception $e) {
        throw $e;
    }
    }
}