<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Webpatser\Countries\Countries;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;

class AreaController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Area::withTrashed()->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('country', function($row) { return $row->country->name; })
                ->addColumn('action', function($row) {return $this->showActionBtns($row);})
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.area.index');
    }

    public function create(){
        $countries = Countries::all();
        return view('dashboard.area.create', ['countries'=> $countries]);
    }

    public function store(StoreAreaRequest $request){
        Area::create([
            'name' => $request->name,
            'address' => $request->address,
            'country_id' => $request->country_id,
        ]);
        return to_route('area.index');
    }

    public function edit($id){
        $area= Area::find($id);
        $countries = Countries::all();
        return view('dashboard.area.edit',['area' => $area, 'countries'=> $countries]);
    }

    public function update(UpdateAreaRequest $request, $id){
        $area = Area::find($id);
        $this->updateArea($request, $area);
        return redirect()->route('area.index');
    }
    
    private function updateArea($request, $area) {
        $area->name = $request->name;
        $area->address = $request->address;
        $area->country_id = $request->country_id;
        $area->save();
    }

    public function destroy($id){
        $area = Area::find($id);
        $area->delete();
        return redirect()->route('area.index');
    }

    public function restore($id){
        Area::withTrashed()->find($id)->restore();
        return back();
    }

    private function showActionBtns($row){
        $actionBtn = '<a id="$row->id" class="btn btn-primary" title="Click to edit area" href="' . route('area.edit', $row->id) . '"><i class=\'bx bx-edit\'></i></a>  ';
        if($row['deleted_at']){
            $actionBtn .= '<a id="$row->id" class="btn btn-success" title="Click to restore area" href="' . route('area.restore', $row->id) . '"><i class=\'bx bx-recycle\'></i></a>';
        }
        else{
            $actionBtn .= '<button type="button" class="delete btn btn-danger" title="Click to delete area" data-bs-toggle="modal"
            data-bs-target="#exampleModal" id="'.$row->id.'"><i class=\'bx bxs-trash-alt\'></i></button>';
        }
        return $actionBtn;
    }
}