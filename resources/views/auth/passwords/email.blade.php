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



<section class="Registration-sec padding-80">
  <div class="container">
    <div class="row">
<main class="my-cart">
    <!-- banner start -->

    <!-- banner end -->

<!-- main content start -->
<div class="login-pg-forms">
  <div class="container">
    <div class="col-md-12">
      <div class="row">

        <div class="col-md-3 col-sm-offset-3"></div>

        <div class="col-md-6 col-sm-offset-3">
        <div class="rgster-login-form login-form contact-sec">
           <h3>Reset Password</h3> 
        
                            
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form class="form bordered-input" method="POST" action="{{ route('password.email') }}">
                                {{csrf_field()}}
                                <div class="p-30 pb-0">
                                <p>Enter your email to help us identify you.</p>
                                <div class="">
                                    <div class="col-12">
                                        <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="text" placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="news-form">
                                  
                  <span><button class="cntnt-bnt-sub" id="resetButton">Send Reset Instruction</button></span>
                                   
                                </div>
                            </div>
                        
                           
                        </form>
                   
  </div>
        </div>

        <div class="col-md-3 col-sm-offset-3"></div>

      </div>
    </div>
  </div>
</div>
<!-- main content end -->   
</main>
</div>
</div>
</section>


@endsection
@section('css')
<style type="text/css">
    
  h3{
    font-size: 33px;
        margin: unset;
  }
  
  .form-control {
    width: 90%;
    height: 50px;
  }
  
  .news-form span{
    width: 90%;
    height: 50px;
  }
  
input.form-control.pl-0.font-12 {
    padding: 23px;
    margin-top: 15px;
}

.alert {
    width: 100%;
}

.contact-sec form {
    margin-top: 30px;
}

button#resetButton {
    width: 100%;
}

.contact-sec {
     height: auto; 
}

</style>
@endsection
@section('js')
<script type="text/javascript">
     $(document).on('click', ".btn1", function(e){
            // alert('it works');
            $('.loginForm').submit();
     });
</script>
@endsection