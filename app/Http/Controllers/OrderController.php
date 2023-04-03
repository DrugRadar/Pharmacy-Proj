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
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    
    public function index(Request $request){

        if(Auth::user()->roles[0]->name=='admin'){
            $data = Order::withTrashed()->with('doctor')->latest()->get();
        }
        else if(Auth::user()->roles[0]->name=='pharmacy'){
            $data = Order::withTrashed()->where('assigned_pharmacy_id', Auth::user()->userable_id)->with('doctor')->get();
        }
        else if(Auth::user()->roles[0]->name=='doctor'){
            $doctor = Doctor::find(Auth::user()->userable_id);
            $pharmacyId=$doctor->pharmacy->id;
            $data = Order::withTrashed()->where('assigned_pharmacy_id', $pharmacyId)->with('doctor')->get();
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
                ->addColumn('is_insured', function ($row) {
                    
                    return $row->is_insured?"true":"false";
                })
                ->addColumn('action',function ($row) {return $this->showActionBtns($row);})
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
        $doctors='';
        if($user->roles[0]->name=='pharmacy')
        {
            $doctors=Doctor::where('pharmacy_id', $user->userable_id)->get();
        }
        if($user->roles[0]->name=='admin')
        {
            $doctors=Doctor::all();
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
    public function deliveringOrder($id){
        $order = Order::find($id);
        $order->status='delivered';
        $order->save();
        return back();
    }
    private function showActionBtns($row){
        if($row->status =='confirmed')
        {
            $actionBtn  = '<a href="' . route('order.delivered', $row->id) . '" class="edit btn btn-success" title="delivered" >delivered</a>  ';
        }
        elseif($row->status == 'WaitingForUserConfirmation' || $row->status == 'canceled' || $row->status == 'delivered'){
            $actionBtn  = '<a href="" class="edit btn btn-success disabled" title="unable to process" aria-disabled="true"><i class=\'bx bx-cog\'></i></a>  ';    
            $actionBtn .= '<a id="$row->id" class="btn btn-primary disabled" title="unable to edit" href=""><i class=\'bx bx-edit\'></i></a>  ';
            if($row['deleted_at']){
                $actionBtn .= '<a id="$row->id" class="btn btn-success disabled" title="unable to restore" href=""><i class=\'bx bx-recycle\'></i></a>';
            }
            else{
                $actionBtn .= '<button type="button"  class="delete btn btn-danger disabled" title="unable to delete" data-bs-toggle="modal"
                data-bs-target="" id="'.$row->id.'disabled"><i class=\'bx bxs-trash-alt\'></i></a>';
            }
        }else{
            $actionBtn  = '<a href="'.route('order.send', $row->id).'" class="edit btn btn-success" title="Click to process order"><i class=\'bx bx-cog\'></i></a>  ';    
            $actionBtn .= '<a id="$row->id" class="btn btn-primary" title="Click to edit order" href="' . route('order.edit', $row->id) . '"><i class=\'bx bx-edit\'></i></a>  ';
            if($row['deleted_at']){
                $actionBtn .= '<a id="$row->id" class="btn btn-success" title="Click to restore order" href="' . route('order.restore', $row->id) . '"><i class=\'bx bx-recycle\'></i></a>';
            }
            else{
                $actionBtn .= '<button type="button" class="delete btn btn-danger" title="Click to delete order" data-bs-toggle="modal"
                data-bs-target="#exampleModal" id="'.$row->id.'"><i class=\'bx bxs-trash-alt\'></i></button>';
            }
       }

        return $actionBtn;
    }
}