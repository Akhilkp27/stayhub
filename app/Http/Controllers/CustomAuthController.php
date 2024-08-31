<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('customer')->attempt($credentials)) {
        // Authentication passed
        return redirect()->intended('/customer-dashboard');
    }
   
    // Authentication failed - redirect back with input and error message
    return redirect()->back()->withErrors(['email' => 'Invalid credentials.'])->withInput($request->only('email'));
}

}
