@extends('layouts/master')

@section('content')
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Register</h2>
                        <p>Welcome to the official RV Movie.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Signup Section Begin -->
    <section class="signup spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <x-jet-validation-errors class="mb-4 text-danger" />
                        <h3>Register </h3>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="input__item">
                                
                                <input id="name" class="block mt-1 w-full text-dark" type="text" name="name"  required autofocus autocomplete="name" placeholder="Your Name">
                                <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                
                                <input id="email" class="block mt-1 w-full text-dark" type="email" name="email" required placeholder="Email address">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input input id="password" class="block mt-1 w-full text-dark" type="password" name="password" required autocomplete="new-password" placeholder="Password">
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                
                                <input id="password_confirmation" class="block mt-1 w-full text-dark" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                <span class="icon_lock"></span>
                            </div>
                            <x-jet-button class="ml-4 site-btn">
                                {{ __('Register') }}
                            </x-jet-button>
                            
                        </form>
                        <h5>Already have an account? <a href="{{ route('logint') }}">Log In!</a></h5>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__social__links" >
                        
                        <img src="{{asset('img/movie.jpg')}}" alt="" style="width: 500px; margin:auto;" >
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    

@endsection


