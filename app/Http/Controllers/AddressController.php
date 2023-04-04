<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Client;
use App\Models\Address;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;

class AddressController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Address::withTrashed()->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('area_name', function ($row) {
                    return $row->area->name;
                })
                ->addColumn('action', function($row) {return $this->showActionBtns($row);})
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.address.index');
    }

    public function create(){
        $areas = Area::all();
        $clients = Client::all();
        return view('dashboard.address.create', ['areas'=> $areas, 'clients'=> $clients]);
    }

    public function store(StoreAddressRequest $request){
        Address::create([
            'area_id' => $request->area_id,
            'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'flat_number' => $request->flat_number,
            'is_main'   => $request->is_main,
            'client_id' => $request->client_id,
        ]);
        return to_route('address.index');
    }

    public function edit($id){
        $areas = Area::all();
        $clients = Client::all();
        $address= Address::find($id);
        return view('dashboard.address.edit',['address' => $address, 'areas'=> $areas, 'clients'=> $clients]);
    }

    public function update(UpdateAddressRequest $request, $id){
        $address = Address::find($id);
        $this->updateArea($request, $address);
        return redirect()->route('address.index');
    }

    public function destroy($id){
        $address = Address::find($id);
        $address->delete();
        return redirect()->route('address.index');
    }

    private function updateArea($request, $address) {
        $address->area_id = $request->area_id;
        $address->street_name = $request->street_name;
        $address->building_number = $request->building_number;
        $address->floor_number = $request->floor_number;
        $address->flat_number = $request->flat_number;
        $address->is_main = $request->is_main;
        $address->client_id = $request->client_id;
        $address->save();
    }

    public function restore($id){
        Address::withTrashed()->find($id)->restore();
        return back();
    }

    private function showActionBtns($row){
        $actionBtn = '<a id="$row->id" class="btn btn-primary" title="Click to edit address" href="' . route('address.edit', $row->id) . '"><i class=\'bx bx-edit\'></i></a>  ';
        if($row['deleted_at']){
            $actionBtn .= '<a id="$row->id" class="btn btn-success" title="Click to restore address" href="' . route('address.restore', $row->id) . '"><i class=\'bx bx-recycle\'></i></a>';
        }
        else{
            $actionBtn .= '<button type="button" class="delete btn btn-danger" title="Click to delete address" data-bs-toggle="modal"
            data-bs-target="#exampleModal" id="'.$row->id.'"><i class=\'bx bxs-trash-alt\'></i></button>';
        }
        return $actionBtn;
    }
}