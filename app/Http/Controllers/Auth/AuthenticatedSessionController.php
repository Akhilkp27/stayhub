<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();
        $guards = ['admin', 'staff', 'customer']; // Define the guards you are using

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->attempt($request->only('email', 'password'))) {
                Auth::guard($guard)->login(Auth::guard($guard)->user());

                $request->session()->regenerate();

                $redirectTo = match ($guard) {
                    'admin' => route('admin.dashboard'),
                    'staff' => route('staff.dashboard'),
                    'customer' => route('customer.dashboard'),
                    default => route('login'),
                };

                return redirect()->intended($redirectTo);
            }
        }

        // If no guards matched, return an error response
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
