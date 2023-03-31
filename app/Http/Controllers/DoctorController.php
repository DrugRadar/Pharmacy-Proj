<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;
use Yajra\DataTables\DataTables;


class DoctorController extends Controller
{
    function __construct(){
        $this->middleware('permission:see all doctors', ['only' => ['index']]);
        $this->middleware('permission:delete doctor', ['only' => ['delete']]);
        $this->middleware('permission:create doctor', ['only' => ['create','store']]);
        $this->middleware('permission:edit doctor', ['only' => ['edit','update']]);
    }

    public function index(Request $request){
        if(Auth::user()->hasrole('admin')){
            $data = Doctor::latest()->get();
        }
        else if(Auth::user()->hasrole('pharmacy')){
            $data = Doctor::where('pharmacy_id', Auth::user()->userable_id)->get();
        }
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $actionBtn = '<a href="/doctor/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a> <button type="button" class="delete btn btn-danger" data-bs-toggle="modal" 
                    data-bs-target="#exampleModal" id="'.$row->id.'">DELETE </button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.doctor.index');
    }

    public function create(){
        $pharmacies = Pharmacy::all();
        return view('dashboard.doctor.create',['pharmacies' => $pharmacies]);
    }

    public function store(UpdateDoctorRequest $request){
        $newDoctor = Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  $request->password,
            'national_id' =>  $request->national_id,
            'pharmacy_id'=> $request->pharmacy_id,
        ]);

        if ($request->hasFile('avatar_image')) {
            $image = $request->file('avatar_image');
            $imagePath = $image->storeAs('public/image', $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
            $newDoctor->avatar_image = $imageName;
            $newDoctor->save();
        }

        if($newDoctor){
            $user = User::create([
                'name'=> $request->name , 
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole(['doctor']);
            $newDoctor->user()->save($user);
        }

        return to_route('doctor.index');
    }

    public function edit($id){
        $doctor= Doctor::find($id);
        $pharmacies = Pharmacy::all();
        return view('dashboard.doctor.edit',['doctor' => $doctor],['pharmacies' => $pharmacies]);
    //    return response()->json($doctor);
    }

    public function update(UpdateDoctorRequest $request, $id){
        dd($this);
        $doctor = Doctor::find($id);
        if ($request->hasFile('avatar_image')) {
            $this->updateAvatarImage($request, $doctor);
        }

        $this->updateDoctor($request, $doctor);
        return redirect()->route('doctor.index');
    }

    private function updateAvatarImage($request, $doctor) {
        $image = $request->file('avatar_image');
        $imagePath = $image->storeAs('public/image', $image->getClientOriginalName());
        $imageName = $image->getClientOriginalName();

        if ($doctor->avatar_image != null) {
            Storage::delete('public/image/' . $doctor->avatar_image);
        }

        $doctor->avatar_image = $imageName;
        $doctor->save(); 
    }

    private function updateDoctor($request, $doctor) {
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->password = $request->password;
        $doctor->national_id = $request->national_id;
        $doctor->pharmacy_id = $request->pharmacy;
        $doctor->save();
    }

    public function destroy($id){

        $FoundDoctor = Doctor::findOrFail($id);
        if ($FoundDoctor->image) {
            $imagePath = 'image/' . $FoundDoctor->image;
            Storage::delete($imagePath);
        }
        $FoundDoctor->delete();
        return redirect()->route('doctor.index');
    }

}