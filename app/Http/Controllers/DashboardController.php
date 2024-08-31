<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        
        // return view('dashboard', ['user' => $user]);
        $user = Auth::guard('customer')->user(); // Use 'customer' guard to retrieve the authenticated user
    
        return view('dashboard', ['user' => $user]);
    }
}
