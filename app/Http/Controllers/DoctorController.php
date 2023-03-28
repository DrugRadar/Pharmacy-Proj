<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    //
    public function index(){
        $doctors = Doctor::all();
        return view('dashboard.doctor.index',['doctors' => $doctors]);
    }
    public function create(){
        $pharmacies = Pharmacy::all();
        return view('dashboard.doctor.create',['pharmacies' => $pharmacies]);
    }

    public function store(){
        if (request()->hasFile('avatar_image')) {
            $image = request()->file('avatar_image');
            $imagePath = $image->storeAs('public/image', $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
        }

        Doctor::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' =>  request()->password,
            'national_id' =>  request()->national_id,
            'avatar_image'=> isset($imagePath) ? $imageName : null,
            'pharmacy_id'=> request()->pharmacy,

        ]);
        return to_route('doctor.index');
    }
    public function edit($id){
        $doctor= Doctor::find($id);
        $pharmacies = Pharmacy::all();
        return view('dashboard.doctor.edit',['doctor' => $doctor],['pharmacies' => $pharmacies]);
    }

    public function update($id){
        $doctor = Doctor::find($id);
        if (request()->hasFile('avatar_image')) {
            $this->updateAvatarImage($doctor);
        }

        $this->updateDoctor($doctor);
        return redirect()->route('doctor.index');
    }

    private function updateAvatarImage($doctor) {
        $image = request()->file('avatar_image');
        $imagePath = $image->storeAs('public/image', $image->getClientOriginalName());
        $imageName = $image->getClientOriginalName();

        if ($doctor->avatar_image != null) {
            Storage::delete('public/image/' . $doctor->avatar_image);
        }

        $doctor->avatar_image = $imageName;
        $doctor->save(); 
    }

    private function updateDoctor($doctor) {
        $doctor->name = request()->name;
        $doctor->email = request()->email;
        $doctor->password = request()->password;
        $doctor->national_id = request()->national_id;
        $doctor->pharmacy_id = request()->pharmacy;
        $doctor->save();
    }

    public function destroy($doctor){

        $FoundDoctor = Doctor::findOrFail($doctor);
             
        if ($FoundDoctor->image) {
            $imagePath = 'image/' . $FoundDoctor->image;
            Storage::delete($imagePath);
        }
        $FoundDoctor->delete();
        return redirect()->route('doctor.index');
    }

}