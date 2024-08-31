{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('layouts.app')
<style>
    .error{
        color: red;
        display: none;
    }
    .error-border {
            border-color: red !important;
    }
</style>
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">Register</h6>
            <h1 class="mb-5">Welcome to <span class="text-primary text-uppercase"> stayhub</span></h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/about-1.jpg" style="margin-top: 25%;">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="img/about-2.jpg">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="img/about-3.jpg">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/about-4.jpg">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <form method="POST" action="{{ route('customer.store') }}" onsubmit="return validateForm()" id="registerForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                                    <label for="fname">First Name</label>
                                    <span class="error" id="fname-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Email">
                                    <label for="lname">Last Name</label>
                                    <span class="error" id="lname-error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="mobile" class="form-control" id="mobile" name="mobile" placeholder="Last Email" maxlength="10">
                                    <label for="mobile">Mobile</label>
                                    <span class="error" id="mobile-error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                    <label for="email">Email</label>
                                    <span class="error" id="email-status"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                    <label for="password">Password</label>
                                    <span class="error" id="password-error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <span class="error" id="confirmPassword-error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="file" class="form-control" id="image" name="image" placeholder="image">
                                    <label for="image">Image</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Register</button>
                            </div>
                        </div>
                    </form>
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function validateForm(){
        let isValid = true;
        const fname = document.getElementById('fname');
        const lname = document.getElementById('lname');
        const mobile = document.getElementById('mobile');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');

        const fnameError = document.getElementById('fname-error');
        const lnameError = document.getElementById('lname-error');
        const mobileError = document.getElementById('mobile-error');
        const emailError = document.getElementById('email-status');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const mobilePattern = /^[0-9]{10}$/;
        const passwordError = document.getElementById('password-error');
        const confirmPasswordError = document.getElementById('confirmPassword-error');

            if (fname.value.trim() === '') {
                fnameError.textContent = 'First name is required.';
                fnameError.style.display = 'block'; 
                fname.classList.add('error-border');
                isValid = false;
            } else {
                fnameError.style.display = 'none';
                fname.classList.remove('error-border');
            }
            if (lname.value.trim() === '') {
                lnameError.textContent = 'Last name is required.';
                lnameError.style.display = 'block'; 
                lname.classList.add('error-border');
                isValid = false;
            } else {
                lnameError.style.display = 'none';
                lname.classList.remove('error-border');
            }
            // Mobile Number Validation
            if (mobile.value.trim() === '') {
                mobileError.textContent = 'Mobile number is required.';
                mobileError.style.display = 'block';
                mobile.classList.add('error-border');
                isValid = false;
            } else if (mobile.value.trim().length < 10) {
                mobileError.textContent = 'Mobile number must be at least 10 digits.';
                mobileError.style.display = 'block';
                mobile.classList.add('error-border');
                isValid = false;
            } else if (!mobilePattern.test(mobile.value.trim())) {
                mobileError.textContent = 'Invalid mobile number format.';
                mobileError.style.display = 'block';
                mobile.classList.add('error-border');
                isValid = false;
            } else {
                mobileError.textContent = '';
                mobileError.style.display = 'none';
                mobile.classList.remove('error-border');
            }

            //email
            if (!emailPattern.test(email.value.trim())) {
                emailError.textContent = 'Email is required.';
                emailError.style.display = 'block';
                email.classList.add('error-border');
                isValid = false;
            } else {
                emailError.textContent = '';
                emailError.style.display = 'none';
                emailError.classList.remove('error-border');
            }

            // Password Validation (if needed)
            if (password.value.trim() === '') {
                passwordError.textContent = 'Password is required.';
                passwordError.style.display = 'block';
                password.classList.add('error-border');
                isValid = false;
            } else {
                passwordError.textContent = '';
                passwordError.style.display = 'none';
                password.classList.remove('error-border');
            }
            if (confirmPassword.value.trim() === '') {
                confirmPasswordError.textContent = 'Confirm password is required.';
                confirmPasswordError.style.display = 'block';
                confirmPassword.classList.add('error-border');
                isValid = false;
            } else if (confirmPassword.value.trim() !== password.value.trim()) {
                confirmPasswordError.textContent = 'Passwords do not match.';
                confirmPasswordError.style.display = 'block';
                confirmPassword.classList.add('error-border');
                isValid = false;
            } else {
                confirmPasswordError.textContent = '';
                confirmPasswordError.style.display = 'none';
                confirmPassword.classList.remove('error-border');
            }
            
            return isValid;
    }
 
document.getElementById('email').addEventListener('keyup', function() {
    var email = this.value;

    if (email.length > 0) {
        fetch('/check-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => {
            if (response.status === 422) {
                // Handle validation errors
                return response.json().then(errorData => {
                    const status = document.getElementById('email-status');
                    if (errorData.errors && errorData.errors.email) {
                        status.textContent = errorData.errors.email[0]; // Display the first error message
                        status.style.color = 'red';
                    } else {
                        status.textContent = 'Invalid email.';
                        status.style.color = 'red';
                    }
                    throw new Error('Validation error');
                });
            } else if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            var status = document.getElementById('email-status');
            if (data.exists) {
                console.log(data.exists);
                
                status.textContent = 'Email already exists.';
                status.style.display = 'block';
                status.style.color = 'red';
            } else {
              
                status.textContent = 'Email is available.';
                status.style.display = 'block';
                status.style.color = 'green';
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    } else {
        document.getElementById('email-status').textContent = ''; // Clear content
    }
});  
document.getElementById('mobile').addEventListener('input', function() {
    
    this.value = this.value.replace(/\D/g, '');
}); 
</script>
@endsection