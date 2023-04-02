<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->roles[0]->name=='admin') {
            if ($request->ajax()) {
                $data = Pharmacy::latest()->get();
                return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('avatar_image_url', function ($row) {
                    return  $row->getFirstMediaUrl('avatar_image', 'thumb');
                })
                ->addColumn('totalOrders', function (Pharmacy $pharmacy) {
                    $ordersCount = DB::table('orders')->where('assigned_pharmacy_id', $pharmacy->id)->count();
                    return $ordersCount;
                })
               ->addColumn('totalRevenue', function (Pharmacy $pharmacy) {
                   $ordersRevenue = DB::table('orders')->where('assigned_pharmacy_id', $pharmacy->id)
                                                       ->where('status', 'confirmed')
                                                       ->sum('total_price');
                   return $ordersRevenue;
               })
                ->make(true);
                
            }
            return view('dashboard.revenue.index');
            }else if(Auth::user()->roles[0]->name == 'pharmacy'){
                $pharmacy_id = Auth::user()->id;
                $PharmacyRevenue = DB::table('orders')->where('assigned_pharmacy_id',$pharmacy_id)
                                                             ->sum('total_price');
                return view('dashboard.revenue.PharmacyRevenue',['pharmacy_revenue'=>$PharmacyRevenue]);
            }
        }
    }