<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Requests\StoreDoctorRequest;


class DoctorController extends Controller
{
    function __construct(){
        $this->middleware('permission:see all doctors', ['only' => ['index']]);
        $this->middleware('permission:delete doctor', ['only' => ['delete']]);
        $this->middleware('permission:create doctor', ['only' => ['create','store']]);
        $this->middleware('permission:edit doctor', ['only' => ['edit','update']]);
    }

    public function index(Request $request){
        if(Auth::user()->roles[0]->name=='admin'){
            $data = Doctor::latest()->get();
        }
        else if(Auth::user()->roles[0]->name=='pharmacy'){
            $data = Doctor::where('pharmacy_id', Auth::user()->userable_id)->get();
        }
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $actionBtn = '<a href="/doctor/'.$row->id.'/edit" class="edit btn btn-success btn-sm"><i class=\'bx bx-edit\'></i></a><a href="/doctor/ban/'.$row->id.'" class="ban btn btn-dark btn-sm">ban</a> <button type="button" class="delete btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" id="'.$row->id.'"><i class=\'bx bxs-trash-alt\'></i> </button>';
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

    public function store(StoreDoctorRequest $request){
        $newDoctor = Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  $request->password,
            'national_id' =>  $request->national_id,
            'pharmacy_id'=> $request->pharmacy_id,
        ]);

        if ($request->hasFile('avatar_image')) {
            $newDoctor->addMediaFromRequest('avatar_image')->toMediaCollection('avatar_image');
        }

        if($newDoctor){
            $user = User::create([
                'name'=> request()->name ,
                'email' => request()->email,
                'password' => Hash::make(request()->password),
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
    }

    public function update(UpdateDoctorRequest $request, $id){
        $doctor = Doctor::find($id);
        if ($request->hasFile('avatar_image')) {
            foreach($doctor->getMedia('avatar_image') as $image){
                $image->delete();
            }
            $doctor->addMediaFromRequest('avatar_image')->toMediaCollection('avatar_image');
        }

        $this->updateDoctor($request, $doctor);
        return redirect()->route('doctor.index');
    }

    private function updateDoctor($request, $doctor) {
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->password = $request->password;
        $doctor->national_id = $request->national_id;
        $doctor->pharmacy_id = $request->pharmacy_id;
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
    public function ban($id){
        $bannedDoctor=Doctor::find($id);
        $bannedDoctor->ban();
        $user=User::where('userable_id',$bannedDoctor->id)->first();
        $user->assignRole(['banned']);
        return redirect()->route('doctor.index');
    }
    public function unBan($id){
        $bannedDoctor=Doctor::find($id);
        $bannedDoctor->unban();
        $user=User::where('userable_id',$bannedDoctor->id)->first();
        $user->removeRole('banned');
        return redirect()->route('doctor.index');
    }
    public function profile(){
        $doctor = Doctor::find(Auth::user()->userable_id);
        return view('dashboard.doctor.profile', ['doctor' => $doctor]);
    }

}