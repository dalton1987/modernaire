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




    <!-- SECTION: Cart -->
    <section class="add-to-cart  ">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th class="">Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Sub Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="space">
                                    <td class="col-md-5">
                                        <div class="row">
                                            <div class="table-space">
                                                <div class="col-md-5 no-padding ">
                                                    <div class="product-img">
                                                        <img src="{{asset('images/prdtc-smll.jpg')}}" alt="" class="img-responsive">
                                                    </div>
                                                </div>
                                                <div class="col-md-7 no-space">
                                                    <div class="poduct-name">
                                                        <h3>Lorem Ipsum </h3>
                                                        <span>Gram: 20</span></br>
                                                        <span>26 Reviews</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="col-md-3">
                                        <div class="number-item">
                                            <input type="number" class="qtystyle" value="1">
                                            <a href="" class="update">Update Cart</a>
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        <h4>$22</h4>
                                    </td>
                                    <td class="col-md-2">
                                        <h4>$44</h4>
                                    </td>
                                    <td><a href="" class="remove">x</a></td>
                                </tr>
                                <tr class="space">
                                    <td class="col-md-5">
                                        <div class="row">
                                            <div class="table-space">
                                                <div class="col-md-5 no-padding">
                                                    <div class="product-img">
                                                        <img src="{{asset('images/prdtc-smll.jpg')}}" alt="" class="img-responsive">
                                                    </div>
                                                </div>
                                                <div class="col-md-7 no-space">
                                                    <div class="poduct-name">
                                                        <h3>Lorem Ipsum </h3>
                                                        <span>Gram: 20</span></br>
                                                        <span>26 Reviews</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="col-md-3">
                                        <div class="number-item">
                                            <input type="number" class="qtystyle" value="1">
                                            <a href="" class="update">Update Cart</a>
                                        </div>
                                    </td>
                                    <td class="col-md-2">
                                        <h4>$32</h4>
                                    </td>
                                    <td class="col-md-2">
                                        <h4>$32</h4>
                                    </td>
                                    <td><a href="" class="remove">x</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="proceed">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12">
                                        <a href="{{route('product')}}">  Continue Shopping<span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                                    </div>
                                    <div class="col-md-7 col-sm-12 text-center">
                                        <a href="{{route('checkoutPage')}}" class="checkout-btn">Proceed To Checkout</a>
                                        <div class="or-amazon text-center">
                                            <p>Or Checkout With</p>
                                            <a href="#"><img src="{{asset('images/paypal.png')}}"></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="total-section">
                        <ul>
                            <li>Sub Total <span>$76</span></li>
                            <li>Discount <span>$10</span></li>
                            <li>Shipping <span>$15</span></li>
                            <li class="color-change">Total <span>$81</span></li>
                        </ul>
                    </div>
                    <div class="ship-estimate">
                        <ul>
                            <li>Shipping</li>
                            <li class="grey-style">Courier ($15)</li>
                        </ul>
                        <ul>
                            <li>Estimate For</li>
                            <li class="grey-style">Lorem Ipsum,NY,1230</li>
                        </ul>
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