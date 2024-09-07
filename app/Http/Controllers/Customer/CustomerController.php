<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class CustomerController extends BaseController
{
    
    /**
     * Show the customer dashboard.
     *
     * This method is responsible for returning the customer dashboard view.
     */
    public function index()
    {
        // You can pass any data needed for the dashboard to the view.
        // For example, recent orders, account details, etc.
        $customer = Auth::guard('customer')->user();
        
        return view('customer.dashboard', compact('customer'));
    }
    public function store(Request $request)
    {
        // dd('Reached store method');
        $user = Customer::create([
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'phone_number' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // return redirect(route('dashboard', absolute: false));

        // // return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
        // Redirect after successful registration
        return redirect()->route('customer.dashboard')->with('success', 'Registration successful!');

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
}
