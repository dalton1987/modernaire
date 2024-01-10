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
    <section class="productsec product-page-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="catogeriesbox">
                        <h4>CATEGORIES</h4>
                    </div>
                    <div class="frequently-list">
                        <div class="panel-groupnew" id="accordion1" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-bs-toggle="collapse" href="#headingone" aria-expanded="false">
                                        All
                                        <i class="fas fa-chevron-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div class="collapse" id="headingone">
                                    <div class="panel-body">
                                        <ul>

                                            @foreach($categories as $data)
                                            <li><a href="{{route('productCategory', $data->slug)}}"> {{$data->category}}</a> <i class="fa fa-chevron-right" aria-hidden="true"></i></li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--<div class="catogeriesbox mt-4">-->
                    <!--    <h4>PRICE RANGE</h4>-->
                    <!--</div>-->
                    <!--<div class="frequently-list">-->
                    <!--    <div class="panel-groupnew panel-groupnew2 " id="accordion" role="tablist" aria-multiselectable="true">-->
                    <!--        <div class="panel panel-default">-->
                    <!--            <div class="panel-heading" role="tab" id="headingOne2">-->
                    <!--                <h4 class="panel-title">-->
                    <!--                    <a role="button" class="hide-btn" data-bs-toggle="collapse" href="#headingtwo2" aria-expanded="true">-->
                    <!--                    All-->
                    <!--                    </a>-->
                    <!--                </h4>-->
                    <!--            </div>-->
                    <!--            <div class="collapse show" id="headingtwo2">-->
                    <!--                <div class="panel-body">-->
                    <!--                    <ul>-->
                    <!--                        <li> <input type="checkbox" class="freq-checkbox"><a href="#" class="price-rang">$0</a> <span class="dash"> - </span> <span class="dollar">$25 </span></li>-->
                    <!--                        <li> <input type="checkbox" class="freq-checkbox"><a href="#" class="price-rang">$25</a> <span class="dash"> - </span> <span class="dollar">$50 </span></li>-->
                    <!--                        <li> <input type="checkbox" class="freq-checkbox"><a href="#" class="price-rang">$50</a> <span class="dash"> - </span> <span class="dollar">$75 </span></li>-->
                    <!--                        <li> <input type="checkbox" class="freq-checkbox"><a href="#" class="price-rang">$75</a> <span class="dash"> - </span> <span class="dollar">$100 </span></li>-->
                    <!--                        <li> <input type="checkbox" class="freq-checkbox"><a href="#" class="price-rang">$100</a> <span class="dash"> - </span> <span class="dollar">$130</span></li>-->

                    <!--                    </ul>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12 prdt-pg-col">
                    <div class="row paddingbottom">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <form>
                                        <div class="defaultlist">
                                            <select>
                        <option>Default Sorting</option>
                      </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <form>
                                        <div class="defaultlist">
                                            <select>
                        <option>8</option>
                      </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="showinglist">
                                <p>Showing 1-12 of 48 results</p>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-1.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <!--<h6>$66.99</h6>-->
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                <!-- <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-2.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <!--<h6>$66.99</h6>-->
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <!--<li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                 <!--<li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-3.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <!--<h6>$66.99</h6>-->
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <!--<li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                <!-- <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-1.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <!--<h6>$66.99</h6>-->
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <!--<li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                <!-- <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-2.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <!--<h6>$66.99</h6>-->
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <!--<li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                <!-- <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-3.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <!--<h6>$66.99</h6>-->
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <!--<li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                <!-- <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-1.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <!--<h6>$66.99</h6>-->
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <!--<li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                <!-- <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-2.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <!--<h6>$66.99</h6>-->
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <!--<li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                <!-- <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-3.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <h6>$66.99</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <!--<li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                <!-- <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-1.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <h6>$66.99</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <!--<li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                <!-- <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-2.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <h6>$66.99</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <!--<li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                <!-- <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-main">
                                <a href="{{route('productDetail')}}"> <img src="{{asset('images/prdtc-img-3.jpg')}}" alt=""></a>
                                <div class="product-txt-inner">
                                    <ul class="d-flex">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>Product Name</h5>
                                            <h6>$66.99</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="product-cart-icon d-flex">
                                                <!--<li> <a href="{{route('cartPage')}}"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                <!-- <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
.defaultlist select{
    background: unset!important;
}
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection