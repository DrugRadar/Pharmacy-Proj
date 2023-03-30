<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PharmacyController extends Controller
{
    function __construct()
    {
        
         $this->middleware('role:admin', ['only' => ['index','show','edit','delete','create','update','store']]);
         $this->middleware('role:pharmacy', ['only' => ['show']]);

    }
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Pharmacy::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a id="'.$row->id.'" class="btn btn-primary" href="' . route("pharmacy.edit", $row->id) . '">Edit</a>  <button type="button" class="delete btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" id="'.$row->id.'">DELETE </button>';
                return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.pharmacy.index');
    }

    public function create(){
        $areas = Area::all();
        return view('dashboard.pharmacy.create', ['areas' => $areas]);
    }

    public function store(){
        if (request()->hasFile('avatar_image')) {
            $image = request()->file('avatar_image');
            $imagePath = $image->storeAs('public/image', $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
        }

        $newPharmacy= Pharmacy::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' =>  request()->password,
            'national_id' =>  request()->national_id,
            'area_id' =>  request()->area_id,
            'avatar_image'=> isset($imagePath) ? $imageName : null,
        ]);
        if($newPharmacy){
            $user = User::create([
                'name'=> request()->name ,
                'email' => request()->email,
                'password' => Hash::make(request()->password),
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

    public function update($id){
        $pharmacy = Pharmacy::find($id);
        if (request()->hasFile('avatar_image')) {
            $this->updateAvatarImage($pharmacy);
        }

        $this->updatePharmacy($pharmacy);
        return redirect()->route('pharmacy.index');
    }

    private function updateAvatarImage($pharmacy) {
        $image = request()->file('avatar_image');
        $imagePath = $image->storeAs('public/image', $image->getClientOriginalName());
        $imageName = $image->getClientOriginalName();

        if ($pharmacy->avatar_image != null) {
            Storage::delete('public/image/' . $pharmacy->avatar_image);
        }

        $pharmacy->avatar_image = $imageName;
        $pharmacy->save();
    }

    private function updatePharmacy($pharmacy) {
        $pharmacy->name = request()->name;
        $pharmacy->email = request()->email;
        $pharmacy->password = request()->password;
        $pharmacy->national_id = request()->national_id;
        $pharmacy->save();
    }

    public function destroy($id){
        Pharmacy::destroy($id);
        return redirect()->route('pharmacy.index');
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
}