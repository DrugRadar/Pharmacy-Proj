<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MedicineController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('role:admin', ['only' => ['index','show','edit','delete','create','update','store']]);

    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Medicine::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="/medicine/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a> <button type="button" class="delete btn btn-danger" data-bs-toggle="modal" 
                    data-bs-target="#exampleModal" id="'.$row->id.'">DELETE </button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.medicine.index');
    }
    public function create()
    {
        return view('dashboard.medicine.create');
    }

    public function store(StoreMedicineRequest $request)
    {
        $newMedicine= Medicine::create([
            'name' => $request->name,
            'type' => $request->type,
            'quantity' =>  $request->quantity,
            'price' =>  $request->price,
        ]);

        return to_route('medicine.index');
    }

    public function edit($id){
        $medicine= Medicine::find($id);
        return view('dashboard.medicine.edit',['medicine' => $medicine]);
    }

    public function update(UpdateMedicineRequest $request ,$id){
        $medicine= Medicine::find($id);
        $this->updateMedicine($request, $medicine);
        return redirect()->route('medicine.index');
    }
    public function destroy($id){
        $medicine= Medicine::find($id);
        $medicine->delete();
        return redirect()->route('medicine.index');
    }
    private function updateMedicine($request, $medicine) {
        $medicine->name = $request->name;
        $medicine->type = $request->type;
        $medicine->price = $request->price;
        $medicine->quantity = $request->quantity;
        $medicine->save();
    }
}