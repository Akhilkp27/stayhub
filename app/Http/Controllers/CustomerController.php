<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
    //    dd($request->all());
        $user = Customer::create([
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'phone_number' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));

        // return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }
    public function checkEmail(Request $request)
    {
     
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'lowercase', 'email'],
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); 
        }
        $emailExists = Customer::where('email', $request->email)->exists();

        return response()->json([
            'exists' => $emailExists,
        ]);
    }
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('customer')->attempt($credentials)) {
        // The user is authenticated with the 'customer' guard
        $user = Auth::guard('customer')->user();
        return redirect()->intended('dashboard');
    }

    return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
}
}
