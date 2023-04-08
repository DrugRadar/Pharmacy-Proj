<?php

namespace App\Http\Controllers;

use App\Exports\PharmacyExport;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Models\Area;
use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class PharmacyController extends Controller
{

    public function index(Request $request){
        if ($request->ajax()) {
            $data = Pharmacy::withTrashed()->latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('area_name', function ($row) {
                    return $row->area->name;
                })
            ->addColumn('action', function($row){return $this->showActionBtns($row);})
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('dashboard.pharmacy.index');
    }

    public function create(){
        $areas = Area::all();
        return view('dashboard.pharmacy.create', ['areas' => $areas]);
    }

    public function store(StorePharmacyRequest $request){
        $newPharmacy= Pharmacy::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make ($request->password),
            'national_id' =>  $request->national_id,
            'priority' => $request->priority,
            'area_id' =>  $request->area_id,
        ]);

        if ($request->hasFile('avatar_image')) {
            $newPharmacy->addMediaFromRequest('avatar_image')->toMediaCollection('avatar_image');
        }

        if($newPharmacy){
            $user = User::create([
                'name'=> $request->name ,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole(['pharmacy']);
            $newPharmacy->user()->save($user);
        }

        return to_route('pharmacy.index');
    }

    public function edit($id){
        $areas = Area::all();
        $pharmacy= Pharmacy::find($id);
        return view('dashboard.pharmacy.edit',['pharmacy' => $pharmacy, 'areas' => $areas]);
    }

    public function update(UpdatePharmacyRequest $request ,$id){
        $pharmacy = Pharmacy::find($id);
        if ($request->hasFile('avatar_image')) {
            foreach($pharmacy->getMedia('avatar_image') as $image){
                $image->delete();
            }
            $pharmacy->addMediaFromRequest('avatar_image')->toMediaCollection('avatar_image');
        }


        $this->updatePharmacy($request, $pharmacy);
        if(Auth::user()->roles[0]->name=='pharmacy')
        {
            return redirect()->route('pharmacy.profile',Auth::user()->userable_id);
        }
        return redirect()->route('pharmacy.index');
    }
    private function updatePharmacy($request, $pharmacy) {
        $pharmacy->name = $request->name;
        $pharmacy->email = $request->email;
        $pharmacy->password = Hash::make($request->password);
        if($request->priority)
        $pharmacy->priority = $request->priority;
        $pharmacy->national_id = $request->national_id;
        $pharmacy->save();
    }

    public function destroy($id){
        $pharmacyOrders = Order::where([['assigned_pharmacy_id',$id],['status' , '!=', 'delivered']])->get();
        if( ! count($pharmacyOrders) > 0 ){
            Pharmacy::destroy($id);
            return redirect()->route('pharmacy.index');
        }
        else{
            Session::flash('error', 'You can not delete this pharmacy ');
            return back();
        }
    }

    public function getPharmacy(Request $request){
        if ($request->ajax()) {
            $data = Pharmacy::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

        public function profile(){
        $pharmacy = Pharmacy::find(Auth::user()->userable_id);
        return view('dashboard.pharmacy.profile', ['pharmacy' => $pharmacy]);
    }

    public function restore($id){
    Pharmacy::withTrashed()->find($id)->restore();
    return back();
} 


public function export() {
    $pharmacy = Pharmacy::find(Auth::user()->userable_id);
    return Excel::download(new PharmacyExport($pharmacy), 'orders.xlsx');
}

private function showActionBtns($row){
    $actionBtn = '<a id="$row->id" class="btn btn-primary" title="click to edit pharmacy" href="' . route('pharmacy.edit', $row->id) . '"><i class=\'bx bx-edit\'></i></a>  ';
    if($row['deleted_at']){
        $actionBtn .= '<a id="$row->id" class="btn btn-success" title="click to restore pharmacy" href="' . route('pharmacy.restore', $row->id) . '">
        <i class=\'bx bx-recycle\'></i></a>';
    }
    else{
        $actionBtn .= '<button type="button" class="delete btn btn-danger" title="click to delete pharmacy" data-bs-toggle="modal"
        data-bs-target="#exampleModal" id="'.$row->id.'"><i class=\'bx bxs-trash-alt\'></i></button>';
    }

return $actionBtn;
}
}