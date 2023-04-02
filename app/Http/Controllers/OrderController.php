<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmOrder;
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
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    //
    public function index(Request $request){

        if(Auth::user()->roles[0]->name=='admin'){
            $data = Order::with('doctor')->latest()->get();
        }
        else if(Auth::user()->roles[0]->name=='pharmacy'){
            $data = Order::where('assigned_pharmacy_id', Auth::user()->userable_id)->with('doctor')->get();
        }
        else if(Auth::user()->roles[0]->name=='doctor'){
            $doctor = Doctor::find(Auth::user()->userable_id);
            $pharmacyId=$doctor->Pharmacy->id;
            $data = Order::where('assigned_pharmacy_id', $pharmacyId)->with('doctor')->get();
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
                    $actionBtn = '<a href="/orders/process/'.$row->id.'" class="edit btn btn-success btn-sm me-1"><i class=\'bx bxs-cog\'></i></a><a href="/orders/edit/'.$row->id.'" class="edit btn btn-dark me-1 btn-sm"><i class=\'bx bx-edit\'></i></a> <button type="button" class="delete btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" id="'.$row->id.'"><i class=\'bx bxs-trash-alt\'></i> </button>';
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
        if($user->roles[0]->name=='pharmacy')
        {
            $doctors=Doctor::where('pharmacy_id', $user->userable_id)->get();
        }
        if($user->roles[0]->name=='admin')
        {
            $doctors=Doctor::all();
        }
        if($user->roles[0]->name=='doctor')
        {
            $doctors='';
        }
        return view('dashboard.order.create', ['pharmacies' => $pharmacies,'clients'=>$clients,'addresses'=>$addresses,'medicines'=>$medicines,'doctors'=>$doctors]);
    }

    public function store(Request $request){

        $user = Auth::user();
        $creator_type=$request->creator_type;
        $doctor_id = $request->doctor_id;
        $status = 'Processing';
        $assigned_pharmacy=$request->assigned_pharmacy_id;
        if ($user->roles[0]->name=='doctor') {
            $doctor = Doctor::find($user->userable_id);
            $creator_type = 'doctor';
            $assigned_pharmacy = $doctor->pharmacy_id;
            $doctor_id = $doctor->id;
        } elseif ($user->roles[0]->name=='pharmacy') {
            $creator_type = 'pharmacy';
            $assigned_pharmacy = $user->userable_id;
        }
        $newOrder= Order::create([
            'client_id' => $request->client_id,
            'client_address_id' => $request->client_address_id,
            'assigned_pharmacy_id' => $assigned_pharmacy,
            'doctor_id'=>$doctor_id,
            'status'=>$request->status,
            'is_insured'=>$request->is_insured,
            'creator_type'=>$creator_type,
        ]);
       return $this->continue($request,$newOrder->id);
    }
    public function process($id){
        $user = Auth::user();
        $order= Order::find($id);
        $client=Client::find($order->client_id);
        $doctors=Doctor::where('pharmacy_id', $order->assigned_pharmacy_id)->get();
        $medicines=Medicine::all();
        $clientAddress=Address::find($order->client_address_id);
        if($user->roles[0]->name=='admin')
        {
            $pharmacies=Pharmacy::all();
            return view('dashboard.order.process',['order' => $order,'client'=>$client,'medicines'=>$medicines,'doctors'=>$doctors,'clientAddress'=>$clientAddress,'pharmacies'=>$pharmacies]);
        }
        return view('dashboard.order.process',['order' => $order,'client'=>$client,'medicines'=>$medicines,'doctors'=>$doctors,'clientAddress'=>$clientAddress]);
    }
    public function continue(Request $request,$orderId){
        $medicine_id= $request->medicine_id;
        $medicines =array() ;
        // dd($medicine_id);
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
        $this->pushMedicinesToOrder($orderInfo,$order,$medicinesQuantities);
        $order->total_price = $request->total;
        $order->status="WaitingForUserConfirmation";
        if(Auth::user()->roles[0]->name=='doctor')
        {
            $order->doctor_id=Auth::user()->userable_id;
        }
        else
        {
            $order->doctor_id=$orderInfo['doctor_id'];
        }
        $order->save();
        return to_route('order.index');
    }

    public function edit($id)
    {
        $order=Order::find($id);
        $client=Client::find($order->client_id);
        $clientAddress=Address::find($order->client_address_id);
        $addresses=Address::all();
        $medicines=Medicine::all();
        $pharmacies='';
        $doctors='';
        // dd($order->orderMedicine);
        if(Auth::user()->roles[0]->name=='pharmacy')
        {
            $doctors=Doctor::where('pharmacy_id', Auth::user()->userable_id)->get();
        }
        if(Auth::user()->roles[0]->name=='admin')
        {
            $pharmacies=Pharmacy::all();
            $doctors=Doctor::all();
        }
        return view('dashboard.order.edit',['order' => $order,'medicines'=>$medicines,'pharmacies'=>$pharmacies,'doctors'=>$doctors,'client'=>$client,'clientAddress'=>$clientAddress,'addresses'=>$addresses]);

    }
    public function update(Request $request,$id)
    {
        $order=Order::find($id);
        $user = Auth::user();
        $creator_type=$request->creator_type;
        $doctor_id = $request->doctor_id;
        $assigned_pharmacy=$request->assigned_pharmacy_id;
        if ($user->roles[0]->name=='doctor') {
            $doctor = Doctor::find($user->userable_id);
            $creator_type = 'doctor';
            $assigned_pharmacy = $doctor->pharmacy_id;
            $doctor_id = $doctor->id;
        } elseif ($user->roles[0]->name=='pharmacy') {
            $creator_type = 'pharmacy';
            $assigned_pharmacy = $user->userable_id;
        }
        $order->client_address_id = $request->client_address_id;
        $order->assigned_pharmacy_id =$assigned_pharmacy;
        $order->doctor_id =$doctor_id;
        $order->status = $request->status;
        $order->is_insured = $request->is_insured;
        $order->creator_type = $creator_type;
        $order->save();
        return $this->continue($request,$order->id);
    }

    public function destroy($id){
        $order = Order::find($id);
        $order->delete();
        return to_route('order.index');
    }

    private function pushMedicinesToOrder($orderInfo,$order,$medicinesQuantities){
    try {
        if(OrderMedicine::find($order->id))
        {
            $order->orderMedicine()->delete();
        }
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
       $this->sendOrderConfirmationMail($order) ;
    }
    }catch (\Exception $e) {
        throw $e;
    }
    }
    public function sendOrderConfirmationMail( $orderData)
    {
        Mail::to($orderData->client->email)->send(new ConfirmOrder($orderData));
    }

    public function confirmOrder($id){
        $order = Order::find($id);
        if ($order) {
            $order->status = 'confirmed';
            $order->save();
            return view('confirmOrder.confirmed');
        } else {
            abort(404);
        }
        // return response()->json("order confirmed" , 200);
    }
    public function cancelOrder($id){
        $order = Order::find($id);
        if ($order) {
            $order->status = 'canceled';
            $order->save();
            return view('confirmOrder.canceledOrder');
        } else {
            abort(404);
        }
    }
    public function payOrder($id){
        // code for payment
        return view('confirmOrder.payment',['id'=>$id]);
    }
}