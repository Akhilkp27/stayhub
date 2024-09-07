<?php

namespace App\Http\Requests\Auth;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Staff;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): RedirectResponse
    {
        $this->ensureIsNotRateLimited();

        $credentials = $this->only('email', 'password');
    
        // Determine which guard to use based on the existence of the email
        if (Admin::where('email', $credentials['email'])->exists()) {
            $guard = 'admin';
        } elseif (Staff::where('email', $credentials['email'])->exists()) {
            $guard = 'staff';
        } elseif (Customer::where('email', $credentials['email'])->exists()) {
            $guard = 'customer';
        } else {
            // If none of the guards authenticate, throw an error
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    
        // Attempt to authenticate with the determined guard
        if (Auth::guard($guard)->attempt($credentials, $this->boolean('remember'))) {
            $this->session()->regenerate();
     
            // return redirect()->intended($this->redirectPath($guard));
            return redirect()->intended('customer/dashboard');
        }
    
        // If authentication fails, increment the rate limiter and throw an error
        RateLimiter::hit($this->throttleKey());
    
        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
    protected function redirectPath($guard)
    {
        
        switch ($guard) {
           
            case 'admin':
                return route('admin.dashboard');  // Redirect to the admin dashboard
            case 'staff':
                return route('staff.dashboard');  // Redirect to the staff dashboard
            case 'customer':
                // return route('customer.dashboard');
                return redirect()->route('customer.dashboard');  // Redirect to the customer home
            default:
                return '/';  // Redirect to the homepage or some default route
        }
    }
}
