<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function profile(){
        // $admin = User::where('is_admin', true)->get();
        $admin = User::find(Auth::user()->id);
        // dd($admin);
        return view('dashboard.admin.profile', ['admin' => $admin]);
    }
}
