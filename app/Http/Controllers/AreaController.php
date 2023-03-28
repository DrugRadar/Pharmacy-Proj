<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;



class AreaController extends Controller
{

    public function index(Request $request){
         if ($request->ajax()) {
            $data = Area::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.area.index');
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
    private function updateArea($area) {
        $area->name = request()->name;
        $area->address = request()->address;

        $area->save();
    }


    //  public function getArea(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Area::latest()->get();
    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    //     return view('dashboard.area.index');
    // }
}