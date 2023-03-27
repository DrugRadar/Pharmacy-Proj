<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    //
    public function index(){
        $areas = Area::all();
        return view('dashboard.area.index',['areas' => $areas]); 
    }
    public function create(){
        return view('dashboard.area.create');
    }
    public function store(){
        Area::create([
            'name' => request()->name,
            'address' => request()->address,
        ]);
        return to_route('area.index');
    }
}