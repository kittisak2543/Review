@extends('layouts/master')

@section('content')

    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Login</h2>
                        <p>Welcome to the official RV Movie.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <!-- Normal Breadcrumb End -->
     <!-- Login Section Begin -->
     <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <x-jet-validation-errors class="mb-4 text-danger" />
                        <h3>Login</h3>
                        @if (session('status'))
                        <div class="mb-4 font-medium text-sm ">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="{{ route('login') }}" method="post">
                           @csrf
                            <div class="input__item">
                                
                                <input id="email" class="block mt-1 w-full text-dark" type="email" name="email" :value="old('email')" required autofocus  placeholder="Email address">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input  type="password" id="password" class="block mt-1 w-full text-dark"  name="password" required autocomplete="current-password" placeholder="Password">
                                <span class="icon_lock"></span>
                            </div>
                            
                            <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                
                                <button class="site-btn ml-4">
                                    {{ __('Login Now') }}
                                </button>
                            </div>
                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center ">
                                    <x-jet-checkbox id="remember_me" name="remember" />
                                    <span class="ml-4 text-sm text-light">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                        </form>
                        
                       
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>Dont’t Have An Account?</h3>
                        @if (Route::has('registert'))
                            <a href="{{ route('registert') }}" class="primary-btn">Register Now</a>
                        @endif
                        
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- Login Section End -->
@endsection

