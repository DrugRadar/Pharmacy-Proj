<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index(){
         return view('dashboard.charts.revenue');

    } 
    public function revenue()
    {
        $currentYear = Carbon::now()->year;
        if (Auth::user()->roles[0]->name == 'admin') {
         $revenueData = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as revenue')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        }
        else if(Auth::user()->roles[0]->name == 'pharmacy'){
            $revenueData = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as revenue')
            ->where('assigned_pharmacy_id',Auth::user()->userable_id )
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        }
        return response()->json(['data' => $revenueData]);
    }

    public function genderAttendance()
    {
         $males = Client::where('gender', 'male')->count();
        $females = Client::where('gender', 'female')->count();
        return response()->json([
            'labels' => ['Males', 'Females'],
            'datasets' => [
                [
                    'data' => [$males, $females],
                    'backgroundColor' => ['#36a2eb', '#ff6384']
                ]
            ]
        ]);
    }

    public function topUsers()
{
    $client = Client::all();
    $data = DB::table('orders')
                ->select(DB::raw('client_id, COUNT(*) as orders'))
                ->groupBy('client_id')
                ->orderByDesc('orders')
                ->limit(10)
                ->get();
    return response()->json(['data' => $data]);
}

}