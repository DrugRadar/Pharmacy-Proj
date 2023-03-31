<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use App\Models\Medicine;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(){

        return view('dashboard.order.index');
    }

    public function create(){
        $pharmacies = Pharmacy::all();
        $clients = Client::all();
        $addresses=Address::all();
        $medicines=Medicine::all();
        return view('dashboard.order.create', ['pharmacies' => $pharmacies,'clients'=>$clients,'addresses'=>$addresses,'medicines'=>$medicines]);
    }
    
    public function store(){
        // $pharmacies = Pharmacy::all();
        // $clients = Client::all();
        // $addresses=Address::all();
        // $medicines=Medicine::all();
        // return view('dashboard.order.create', ['pharmacies' => $pharmacies,'clients'=>$clients,'addresses'=>$addresses,'medicines'=>$medicines]);
    }
}
