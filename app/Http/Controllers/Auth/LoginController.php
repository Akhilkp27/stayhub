<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $guards = ['admin', 'staff', 'customer'];
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->attempt($this->credentials($request), $request->filled('remember'))) {
                return $this->sendLoginResponse($request, $guard);
            }
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    protected function sendLoginResponse(Request $request, $guard)
    {
        $request->session()->regenerate();

        $redirectTo = match ($guard) {
            'admin' => route('admin.dashboard'),
            'staff' => route('staff.dashboard'),
            'customer' => route('customer.dashboard'),
            default => route('home'),
        };

        return redirect()->intended($redirectTo);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
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
