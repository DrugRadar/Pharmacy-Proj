<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function profile(){
        $admin = User::find(Auth::user()->id);
        return view('dashboard.admin.profile', ['admin' => $admin]);
    }
}
