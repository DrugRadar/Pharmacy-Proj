<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PharmacyController extends Controller
{
    //
    public function index(){
        $pharmacies = Pharmacy::all();
        return view('dashboard.pharmacy.index',['pharmacies' => $pharmacies]); 
    }
    public function create(){
        return view('dashboard.pharmacy.create');
    }
    public function store(){
        if (request()->hasFile('avatar_image')) {
            $image = request()->file('avatar_image');
            $imagePath = $image->storeAs('public/image', $image->getClientOriginalName());
            $imageName = $image->getClientOriginalName();
        }
        
        Pharmacy::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' =>  request()->password,
            'national_id' =>  request()->national_id,
            'avatar_image'=> isset($imagePath) ? $imageName : null,
    
        ]);
        return to_route('pharmacy.index');
    }
    public function edit($id){
        $pharmacy= Pharmacy::find($id);
        return view('dashboard.pharmacy.edit',['pharmacy' => $pharmacy]);
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
    
    
}