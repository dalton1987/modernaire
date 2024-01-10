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
                            <div class="log-form">
                                <h2 class="wow fadeInUp">Login Your Account</h2>
                                <input type="text" placeholder="User Name" class="wow fadeIn" data-wow-delay=".25s">
                                <input type="password" placeholder="Password" class="wow fadeIn" data-wow-delay=".45s">
                                <a href="#" class="btn-submits wow fadeInUp"> LOGIN </a>
                                <div class="log-form-footer">
                                    <div>
                                    <input type="checkbox"> 
                                    <a href="#">Remember me</a>
                                    </div>
                                    <div>
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="log-form">
                                <h2 class="wow fadeInUp">Register Your Account</h2>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="First Name" class="wow fadeIn" data-wow-delay=".25s">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Last Name" class="wow fadeIn" data-wow-delay=".45s">
                                    </div>
                                </div>
                                <input type="email" placeholder="Email Address" class="wow fadeIn" data-wow-delay=".65s">
                                <input type="password" placeholder="Password" class="wow fadeIn" data-wow-delay=".85s">
                                <input type="password" placeholder="Retype Password" class="wow fadeIn" data-wow-delay="1s">
                                
                                <p class="wow fadeInRight">By creating an account, You agree to our <a href="{{route('termsAndConditions')}}" target="_blank"> Terms &amp; Conditions </a> </p>
                                <a href="#" class="btn-submits wow fadeInUp"> CREATE ACCOUNT </a>
                            </div>
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
<style>

</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection