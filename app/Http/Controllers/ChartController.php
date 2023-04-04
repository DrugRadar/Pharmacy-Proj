<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function revenue()
    {
        // Get the current year
        $currentYear = Carbon::now()->year;
        if (Auth::user()->roles[0]->name == 'admin') {
    // Query the orders table for the revenue by month for the current year
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
        // Create arrays for the labels and data values
        $labels = $revenueData->pluck('month')->toArray();
        $data = $revenueData->pluck('revenue')->toArray();

        // Return the chart view with the labels and data
        return view('dashboard.charts.revenue', compact('labels', 'data'));
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
    
    
}