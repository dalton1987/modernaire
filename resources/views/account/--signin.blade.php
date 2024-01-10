@extends('layouts.main')
@section('content')


<!-- banner_sec -->
<section class="inner-banner">  
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{asset('images/inner-banner-img.jpg')}}" class="img-fluid" alt="...">
       <div class="carousel-caption">
        <div class="container">
          <div class="row">
            <div class=" col-sm-12 ">
              <div class="inner-banner wow fadeInLeft" data-wow-duration="2s">
                <h2>Login /<span>Register</span> </h2> 
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>     
  </div>  
</section>
<!-- banner_sec -->


<section class="contact-page-main log-in-page-main pt-80 pb-80">
      <div class="container">
        <div class="row">
          <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
            <div class="log-in-wrap account-form">
              <h2>Login To Your Account</h2>
              <form method="POST" class="loginForm" id="login" action="{{ route('login') }}">
                @csrf
                <div class="col-md-12">
                  <div class="form-group">
                    <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User Name"> -->
                    <input type="email" id="exampleInputEmail1" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}" required aria-describedby="emailHelp">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                        <strong class="validate_css" >{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                  <!-- <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password"> -->
                  <input type="password" aria-describedby="emailHelp" id="exampleInputEmail1"  class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password">
                  @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                      <strong class="validate_css">{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                  </div>
                </div>
                
                <div class="col-md-12">
                  <button type="submit" class="product-details-btn btn10">Login</button>
                </div>
                <div class="col-md-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                      Remember me
                    </label>
                  </div>
                

                  <div class="forgot-pass">
                    <a href="{{ url('password/reset') }}">Forgot Password?</a>
                  </div>
                </div>
                </form>
            </div>
          </div>
          <div class="col-md-6 wow fadeInRight" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight;">
            <div class="log-in-wrap account-form">
              <h2>register  your  account</h2>
               <form class="loginForm" id="signup" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Last Name"> -->
                      <input type="text" id="exampleInputEmail1" aria-describedby="emailHelp" class="form-control {{ $errors->registerForm->has('name') ? ' is-invalid' : '' }}" placeholder="First Name" name="name" id="name"required>
                       @if ($errors->registerForm->has('name'))
                      <span class="invalid-feedback" role="alert">
                        <strong class="validate_css">{{ $errors->registerForm->registerForm->first('name') }}</strong>
                      </span>
                       @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <!-- <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="First Name"> -->
                      <input type="text" id="exampleInputEmail1" aria-describedby="emailHelp" class="form-control {{ $errors->registerForm->has('last_name') ? ' is-invalid' : '' }}" placeholder="Last Name" name="last_name" id="name"required>
                       @if ($errors->registerForm->has('last_name'))
                      <span class="invalid-feedback" role="alert">
                        <strong class="validate_css">{{ $errors->registerForm->registerForm->first('last_name') }}</strong>
                      </span>
                       @endif
                      </div>
                  </div>
                </div>
                 
                <div class="col-md-12">
                  <div class="form-group">
                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email"> -->
                    <input type="email" id="exampleInputEmail1" aria-describedby="emailHelp" class="form-control {{ $errors->registerForm->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" id="signup-email" required>
                   @if ($errors->registerForm->has('email'))
                    <span class="invalid-feedback" role="alert">
                    <strong class="validate_css">{{ $errors->registerForm->first('email') }}</strong>
                    </span>
                   @endif
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <!-- <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password"> -->
                    <input type="password" id="exampleInputEmail1" aria-describedby="emailHelp" class="form-control {{ $errors->registerForm->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" id="signup-password" required>
                    @if ($errors->registerForm->has('password'))
                      <span class="invalid-feedback" role="alert">
                      <strong class="validate_css">{{ $errors->registerForm->first('password') }}</strong>
                      </span>
                     @endif
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <!-- <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Retype Password"> -->
                    <input type="password" id="exampleInputEmail1" aria-describedby="emailHelp" class="form-control" placeholder="Retype Password" name="password_confirmation" id="signup-password" required>
                    @if ($errors->registerForm->has('password_confirmation'))
                      <span class="invalid-feedback" role="alert">
                      <strong class="validate_css">{{ $errors->registerForm->first('password_confirmation') }}</strong>
                      </span>
                     @endif
                  </div>
                </div>

                <div class="col-md-12">
                  <button type="submit" class="product-details-btn btn10">Create Account</button>
                </div>
                
                </form>
            </div>
          </div>
            
        </div>
      </div>
  </section>



@endsection
@section('css')

<link href="{{asset('css/checkout.css')}}" rel="stylesheet" >


<style type="text/css">
.input_icon_button button {
    border: 0;
    padding: 16px 0;
    background-color: #163a57;
    color: #fff;
    display: block;
    text-align: center;
    border-radius: 50px;
    font-size: 18px;
    width: 100%;
}

.loginPage .form-control {
    color: #000;
}

h2 {
    font-size: 40px;
  }

section.InnerContent.Login {
    margin: 60px 0px;
}


/*custom css*/
.contact-page-main .container {
  background-color: #F8F8F8;
  padding: 70px;
}

.log-in-page-main .form-check, .forgot-pass {
  display: inline-block;
}

.forgot-pass {
  float: right;
  text-align: right;
}

.forgot-pass a {
  font-size: 14px;
  font-family: 'Poppins';
  margin: 20px 0;
  font-weight: 400;
  color: #333333;
}

.agree-text {
  font-size: 14px;
  font-family: 'Poppins';
  margin: 20px 0;
  font-weight: 400;
  color: #333333;
}

.term-condition {
  font-weight: 500;
  margin-left: 10px;
  color: #939598;
  border-bottom: 2px solid #939598;
}

.pt-80 {
  padding-top: 70px !important;
}

.account-form input[type="text"], .account-form input[type="password"], .account-form select, .account-form input[type="email"],.account-form  input[type="url"], .account-form input[type="number"], .account-form textarea, .account-form input[type="tel"] {
  border: 1px solid #D3D3D3;
  background-color: #fff;
  font-size: 14px;
  line-height: 20px;
  color: #575757;
  height: 45px;
  margin-bottom: 20px;
  width: 100%;
  padding: 0px 15px;
  border-radius: 0;
  box-shadow: none;
}
.account-form textarea {
  padding: 10px;
  height: 167px;
}

.account-form input[type="text"]::placeholder, .account-form input[type="password"]::placeholder,  .account-form input[type="email"]::placeholder,.account-form  input[type="url"]::placeholder, .account-form input[type="number"]::placeholder, .account-form textarea::placeholder, .account-form input[type="tel"]::placeholder{
  color: #333333 !important;
  font-family: 'Poppins';
    font-size: 13px;
    font-weight: 500;
}

.primary-btn.dark-bg {
  color: #fff;
  background: #006B9F;
  border-color: #006B9F;
  padding: 10px 50px;
  font-family: 'Poppins';
  font-weight: 400;
  font-size: 18px;
  text-transform: uppercase;
  border: 2px solid #006B9F !important;
  margin-bottom: 30px;
}

.primary-btn::before {
  content: "";
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  transition: all .5s ease-in-out;
  -webkit-transition: all .5s ease-in-out;
  -moz-transition: all .5s ease-in-out;
  transform: translateX(100%);
}

.primary-btn.dark-bg:hover {
  color: #003279;
  border-color: #003279 !important;
   background: #ffffff;
}


.log-in-wrap h2 {
    margin: 0 0 20px 0;
    text-align: center;
    color: #000;
    font-size: 26px;
    line-height: 24px;
    font-weight: 600;
    text-transform: uppercase;
    text-align: left;
    margin-bottom: 40px;
}
.log-in-wrap {
    padding: 60px 35px;
    background-color: #ffffff;
    border: 1px solid #D3D3D3;
    /* float: right; */
}

.pt-80 {
    padding-bottom: 80px !important;
}

.contact-page-main .container {
    background-color: #F8F8F8;
    padding: 70px;
}

.btn10{
  margin-left: 0px!important;
  width: -webkit-fill-available;
}


</style>
@endsection
@section('js')

@endsection
