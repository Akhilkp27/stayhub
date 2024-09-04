<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    { 
        dd('ghg');
        $this->validateLogin($request);

        $guards = ['admin', 'staff', 'customer']; // Define the order of guards to check

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->attempt($this->credentials($request))) {
                dd('Authenticated as ' . $guard);
                $request->session()->regenerate();

                return redirect()->intended($this->redirectPath($guard));
            }
        }
        dd($this->credentials($request));
        // If none of the guards authenticate, throw an error
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    protected function redirectPath($guard)
    {
        // Define different redirects based on the guard
        switch ($guard) {
            case 'admin':
                return route('admin.dashboard');
            case 'staff':
                return route('staff.dashboard');
            default:
                return route('customer.dashboard');
        }
    }

    public function logout(Request $request)
    {
        $guard = Auth::getDefaultDriver();
        Auth::guard($guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
