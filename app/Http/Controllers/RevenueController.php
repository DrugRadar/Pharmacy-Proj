<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RevenueController extends Controller{
    public function index(Request $request){
        if(Auth::user()->roles[0]->name=='admin'){
            $data = Pharmacy::latest()->get();
            // ->map(function($pharmacy) {
            //     $pharmacy->avatar_image_url = $pharmacy->getFirstMediaUrl('avatar_image', 'thumb');
            //     return $pharmacy;
            // });
        }
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('avatar_image_url', function($row) {
                   return  $row->getFirstMediaUrl('avatar_image', 'thumb');
                })
                ->make(true);
        }
        return view('dashboard.revenue.index');
    }
}