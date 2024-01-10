@extends('layouts.main')
@section('content')

<?php $segment = Request::segments(); ?>


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
                <h2><span>Account</span> </h2> 
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>     
  </div>  
</section>
<!-- banner_sec -->



<main class="my-cart">
    <!-- banner start -->
    <!-- banner end -->

<!-- main content start -->

 <!-- my account wrapper start -->
    <div class="my-account-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            @include('account/accountSidebar')
                            <!-- My Account Tab Menu End -->
    
                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="dashboad">
                                        <div class="myaccount-content">
                                            <h3>Dashboard</h3>
    
                                            <div class="welcome">
                                            
                                                <p>Hello, <strong>{{ Auth::user()->name }} {{ Auth::user()->last_name }}</strong>!</p>
                                            </div>
                                            
                                            
                                            @if(Auth::user()->user_type != '2')
                                            <p class="mb-0">From your account dashboard, you can easily check & view your recent orders and edit your password and account details.</p>
                                            @else
                                            <p class="mb-0">From your account dashboard, you can easily edit your password and account details.</p>
                                            @endif
                                        
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->
    
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->


<!-- main content end -->   
</main>

@endsection
@section('css')

<link href="{{asset('css/checkout.css')}}" rel="stylesheet" >


<style type="text/css">
    
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