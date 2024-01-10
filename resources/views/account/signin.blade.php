<?php
if(Session::has('register')){
  $register = Session::get('register');
}
?>



@extends('layouts.main')
@section('content')

<!-- META TAGS -->
@section('pageTitle',$pageTitle)
@section('pagedescription',$pagedescription)
@section('Keywords',$pagetags)


<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->

    <!-- banner start -->
    <section class="inner-banner">
        <div class="inner-abnner-mn">
            <img src="{{asset($banner->image)}}" class="img-fluid inner-banner-img" alt="...">
            <div class="inr-bnr-txt-mn">
                <div class="container">
                    <div class="row">
                        <div class=" col-md-12 col-lg-8">
                            <div class="inner-banner wow fadeInLeft" data-wow-duration="2s">
                                <h2>{{$banner->title}}</h2>
                            </div>
                        </div>
                        <div class=" col-md-12 col-lg-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner end -->


    <!-- Prtoducts -->
    <!-- login start -->
   <section class="log-p"> 
                <div class="container">
                    <div class="row">


                        <div class="col-lg-6">
                            <form method="POST" class="loginForm" id="login" action="{{ route('login') }}">
                            @csrf
                                <div class="log-form">
                                    <h2 class="wow fadeInUp">Login Your Account</h2>

                                    <input type="email" id="exampleInputEmail1" class="wow fadeIn {{ $errors->has('email') ? ' is-invalid' : '' }}" data-wow-delay=".25s" placeholder="Email Address" name="email" value="{{ old('email') }}" required aria-describedby="emailHelp">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="validate_css" >{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif


                                    <input type="password" aria-describedby="emailHelp" id="exampleInputEmail1"  class="wow fadeIn {{ $errors->has('password') ? ' is-invalid' : '' }}" data-wow-delay=".45s" placeholder="Password" name="password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="validate_css">{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                                    <button type="submit" class="btn-submits wow fadeInUp">LOGIN</button>


                                    <div class="log-form-footer">
                                        <div>
                                            <label><input type="checkbox"> 
                                        Remember me</label>
                                        
                                        </div>
                                        <div>
                                            <a href="{{ url('password/reset') }}">Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="col-lg-6">

                            <form class="loginForm" id="signup" method="POST" action="{{ route('register') }}">
                            @csrf
                                <div class="log-form">
                                    <h2 class="wow fadeInUp">Register Your Account</h2>
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <input value="{{$register['name']}}" type="text" id="exampleInputEmail1" aria-describedby="emailHelp" class="wow fadeIn {{ $errors->registerForm->has('name') ? ' is-invalid' : '' }}" data-wow-delay=".25s" placeholder="First Name" name="name" id="name"required>
                                            @if ($errors->registerForm->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="validate_css">{{ $errors->registerForm->registerForm->first('name') }}</strong>
                                            </span>
                                            @endif


                                        </div>
                                        <div class="col-lg-6">


                                            <input value="{{$register['last_name']}}" type="text" id="exampleInputEmail1" aria-describedby="emailHelp" class="wow fadeIn {{ $errors->registerForm->has('last_name') ? ' is-invalid' : '' }}" data-wow-delay=".45s" placeholder="Last Name" name="last_name" id="name"required>
                                            @if ($errors->registerForm->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="validate_css">{{ $errors->registerForm->registerForm->first('last_name') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>


                                    <input value="{{$register['email']}}" type="email" id="exampleInputEmail1" aria-describedby="emailHelp" class="wow fadeIn {{ $errors->registerForm->has('email') ? ' is-invalid' : '' }}" data-wow-delay=".65s" placeholder="Email Address" name="email" id="signup-email" required>
                                    @if ($errors->registerForm->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="validate_css">{{ $errors->registerForm->first('email') }}</strong>
                                    </span>
                                    @endif


                                    <input value="{{$register['password']}}" type="password" id="exampleInputEmail1" aria-describedby="emailHelp" class="wow fadeIn {{ $errors->registerForm->has('password') ? ' is-invalid' : '' }}" data-wow-delay=".85s" placeholder="Password" name="password" id="signup-password" required>
                                    @if ($errors->registerForm->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="validate_css">{{ $errors->registerForm->first('password') }}</strong>
                                    </span>
                                    @endif



                                    <input type="password" id="exampleInputEmail1" aria-describedby="emailHelp" class="wow fadeIn" data-wow-delay="1s" placeholder="Retype Password" name="password_confirmation" id="signup-password" required>
                                    @if ($errors->registerForm->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="validate_css">{{ $errors->registerForm->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif




                                    
                                    <p class="wow fadeInRight">By creating an account, you agree to our <a href="{{route('termsAndConditions')}}" target="_blank"> Terms &amp; Conditions </a> </p>

                                    <button type="submit" class="btn-submits wow fadeInUp">CREATE ACCOUNT</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>      
            </section>
   <!-- login end -->




    <!-- company logo sec -->
    @include('widgets/partner')
   

<!-- ============================================================== -->
<!-- BODY END HERE -->
<!-- ============================================================== -->

@endsection
@section('css')
<link href="{{asset('css/checkout.css')}}" rel="stylesheet" >


<style>
button.btn-submits.wow.fadeInUp {
    border: unset;
}
button.btn-submits.wow.fadeInUp:hover {
    background-color: #000;
}
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection