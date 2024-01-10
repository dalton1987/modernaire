@extends('layouts.main')

@section('content')

<section class="inner-banner">
    <div class="inner-abnner-mn">
        <img src="{{asset('images/inner-banner-img.jpg')}}" class="img-fluid inner-banner-img" alt="...">
        <div class="inr-bnr-txt-mn">
            <div class="container">
                <div class="row">
                    <div class=" col-md-12 col-lg-8">
                        <div class="inner-banner wow fadeInLeft" data-wow-duration="2s">
                            <h2>Reset Password</h2>
                        </div>
                    </div>
                    <div class=" col-md-12 col-lg-4">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
    <section class="resetSection">
    <div class="container">
        <div class="page-wrapper m-0 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-12"></div>

                    <div class="col-lg-6 col-12">
                        <div class="card border-0 contact-sec">
                            
                                <form method="POST" class="form bordered-input" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">


                                    <div class="p-30 pb-0" id="resetForm">
                         

                                        <div class="m-t-20 row">
                                            <div class="col-12">
                                                <label>Email Address</label>
                                                <input class="form-control pl-0 font-12 {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="Email" name="email" readonly="" value="{{$_GET['email']}}">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row m-b-30">
                                            <div class="col-12">
                                                <label>Password</label>
                                                <input class="form-control  pl-0 font-12 {{ $errors->has('password') ? ' is-invalid' : '' }}"  type="password" name="password" placeholder="Password" id="password" >
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row m-b-20">
                                            <div class="col-12">
                                                <label>Confirm Password</label>
                                                <input id="password-confirm" type="password" class="form-control  pl-0 font-12" name="password_confirmation"  placeholder="Confirm Password" >
                                            </div>
                                            <div id="msg"></div>

                                            <div class="clearfix"></div>
                                        </div>

                                      
                                        
                                        <div class="news-form">
                                            <span><button class="cntnt-bnt-sub" id="resetButton">Reset Password</button></span>
                                        </div>
                                        
                                            <!--<div class="col-12">
                                                <p><button type="submit" class="product-details-btn btn10" id="resetButton"></button></p>
                                            </div>-->
                                       
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="col-lg-3 col-12"></div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection

<style type="text/css">


#reset{
    font-size: 40px;
    margin-top: 75px;
}

#resetForm{
    margin-bottom: 40px;
}


.form-control {
    width: 100%!important;
    height: 50px;
    margin-bottom: 25px!important;
}

.news-form span{
        width: 90%!important;
        height: 50px;
    }

.contact-sec {
     height: auto!important;
    padding: unset!important; 
}

.contact-sec input[type="password"] {
    width: 100%;
    height: 55px;
    border: 1px solid #D6D6D6;
    padding: 0 30px;
    margin-bottom: 30px;
    font-family: 'Poppins';
    color: black;
}
.contact-sec input[type="email"] {
    height: 55px!important;
}

button#resetButton {
    width: 100%;
}

section.resetSection {
    padding-bottom: 50px;
}

</style>

@section('js')
<script>
    $(document).ready(function(){
        $("#password-confirm").keyup(function(){
             if ($("#password").val() != $("#password-confirm").val()) {
                 $("#msg").html("Passwords do not match!").css("color","red");
                 $('#resetButton').prop('disabled', true);
             }else{
                 $("#msg").html("Passwords matched!").css("color","green");
                 $('#resetButton').prop('disabled', false);
            }
      });
});
</script>
@endsection