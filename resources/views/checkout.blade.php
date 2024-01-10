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
                        <div class=" col-md-12 col-lg-6">
                            <div class="inner-banner wow fadeInLeft" data-wow-duration="2s">
                                <h2>{{$banner->title}}</h2>
                            </div>
                        </div>
                        <div class=" col-md-12 col-lg-6">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner end -->

    <section class="checkout_page  all-section all-side">
        <div class="container  ">
            <div class="row mt-5">
                <div class="col-sm-8">
                    <div class="billing_form">
                        <h3>Billing Details</h3>
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First Name*</label>
                                    <input type="text" name="fname">
                                </div>
                                <div class="col-sm-6">
                                    <label>Last Name*</label>
                                    <input type="text" name="lname">
                                </div>
                                <div class="col-sm-12">
                                    <label>Company Name (Optional)</label>
                                    <input type="text" name="companyname">
                                </div>
                                <div class="col-sm-12">
                                    <label>Country / Region *</label>
                                    <input type="text" name="country" placeholder="United States">
                                </div>
                                <div class="col-sm-12">
                                    <label>Street Address*</label>
                                    <input type="text" name="add1" placeholder="House Number and Street Name">
                                    <input type="text" name="add2" placeholder="Apartment, Suite, unit etc">
                                </div>
                                <div class="col-sm-6">
                                    <label>Town / City *</label>
                                    <input type="text" name="town">
                                </div>
                                <div class="col-sm-6">
                                    <label>State*</label>
                                    <input type="text" name="state">
                                </div>

                                <div class="col-sm-6">
                                    <label>Zip*</label>
                                    <input type="text" name="zip">
                                </div>

                                <div class="col-sm-6">
                                    <label>Phone*</label>
                                    <input type="text" name="phone">
                                </div>
                                <div class="col-sm-12">
                                    <label>Email Address*</label>
                                    <input type="text" name="email">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class=" col-sm-4">
                    <div class="cart_sidebar">
                        <h3>Your Order</h3>
                        <h5 class="h-sub">Product</h5>
                        <ul class="cart_lst">
                            <li>Palm Print Jacket x1 <span>$40.00</span></li>
                            <li>Palm Print Jacket x1 <span>$60.00</span></li>
                            <li>Subtotal <span>$100.00</span></li>
                        </ul>


                        <h4>Shipping</h4>

                        <ul class="shipping-ul">
                            <li>
                                <input type="checkbox" name="free" id="free">
                                <label for="free">Free Shipping</label>
                            </li>
                            <li>
                                <input type="checkbox" name="local" id="local">
                                <label for="local">Local Pickup</label>
                            </li>
                            <li>
                                <input type="checkbox" name="flat" id="flat">
                                <label for="flat">Flat rate: $5.00</label>
                            </li>
                        </ul>
                        <h5 class="h-sub mt-3">Total <span>$100.00</span></h5>

                        <h6 class="payment-h">Payment Method</h6>

                        <ul class="radiosss radiosss-payments">
                            <li>
                                <input type="radio" name="direct" id="direct" data-bs-toggle="collapse" href="#direct-p" role="button" aria-expanded="false" aria-controls="collapseExample" class="collapsed">
                                <label for="direct">Direct Bank Transfer</label>

                            </li>
                            <li>
                                <div class="collapse" id="direct-p">
                                    <div class="card card-body">
                                        <p class=" p-same-p">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                            ea commodo </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <input type="radio" name="direct" id="cp" data-bs-toggle="collapse" href="#payment-pp" role="button" aria-expanded="false" aria-controls="collapseExample" class="collapsed">
                                <label for="cp">Check Pyaments</label>
                            </li>
                            <li>
                                <div class="collapse" id="payment-pp">
                                    <div class="card card-body">
                                        <p class=" p-same-p">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                            ea commodo </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <input type="radio" name="direct" id="cod" data-bs-toggle="collapse" href="#dilivery-pp" role="button" aria-expanded="false" aria-controls="collapseExample" class="collapsed">
                                <label for="cod">Cash On Delivery</label>
                            </li>
                            <li>
                                <div class="collapse" id="dilivery-pp">
                                    <div class="card card-body">
                                        <p class=" p-same-p">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                            ea commodo </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <input type="radio" name="direct" id="paypal" data-bs-toggle="collapse" href="#paypal-pp" role="button" aria-expanded="false" aria-controls="collapseExample" class="collapsed">
                                <label for="paypal">Paypal</label>
                            </li>
                            <li>
                                <div class="collapse" id="paypal-pp">
                                    <div class="card card-body">
                                        <p class=" p-same-p">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                            ea commodo </p>
                                    </div>
                                </div>
                            </li>
                        </ul>


                        <a href="javascript:void(0)" class="checkout_btn mt-4 btn13">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- company logo sec -->
    @include('widgets/partner')

    <!-- <section class=" company-log-sc">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="compny-logo">
                        <img src="{{asset('images/company-logo-1.png')}}" alt="images">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="compny-logo">
                        <img src="{{asset('images/company-logo-2.png')}}" alt="images">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="compny-logo">
                        <img src="{{asset('images/company-logo-3.png')}}" alt="images">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="compny-logo">
                        <img src="{{asset('images/company-logo-4.png')}}" alt="images">
                    </div>
                </div>
            </div>
        </div>
    </section> -->   

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