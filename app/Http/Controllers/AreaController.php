<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function edit($id){
        $area= Area::find($id);
        return view('dashboard.area.edit',['area' => $area]);
    }
    public function update($id){
        $area = Area::find($id);   
        $this->updateArea($area);
        return redirect()->route('area.index');
    }
    public function delete($id){
        $area = Area::find($id);   
        $area->delete();
        return redirect()->route('area.index');
    }
}