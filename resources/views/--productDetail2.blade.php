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




    <!-- product detail sec start -->
    <section class="productdetailsec">
        <div class="container">
            <div class="row">
                <div class="col-md-2  ">
                    <div class="single-dropwon">
                        <form action="#">
                            <select>
                                <option value="1" selected>WIDTH</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                            </select>

                            <select>
                                <option value="1" selected>CFM</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                            </select>

                            <select>
                                <option value="1" selected>FINISH</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                            </select>

                            <select>
                                <option value="1" selected>COUNTRY</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                            </select>

                            <button type="submit" class="btn-slct-sub"> GENERATE</button>


                        </form>
                    </div>
                </div>
                <div class="col-md-5  ">
                    <div id="stl_cont" style="width:500px;height:500px;margin:0 auto;"></div>

                    <script src="{{asset('stl_viewer.min.js')}}"></script>
                    <script>
                        var stl_viewer = new StlViewer(
                            document.getElementById("stl_cont"), {
                                models: [{
                                    filename: "mystl.STL"
                                }]
                            }
                        );
                    </script>
                    <!--<div class="  productdetailfor">-->
                    <!--    <div>-->
                    <!--        <div class="productdetailportion">-->
                    <!--            <img src="images/prdtc-dtl-img-main.png" class="img-responsive" alt="img">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div>-->
                    <!--        <div class="productdetailportion">-->
                    <!--            <img src="images/prdtc-dtl-img-main.png" class="img-responsive" alt="img">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div>-->
                    <!--        <div class="productdetailportion">-->
                    <!--            <img src="images/prdtc-dtl-img-main.png" class="img-responsive" alt="img">-->
                    <!--        </div>-->
                    <!--    </div>-->

                    <!--</div>-->

                    <!--<div class="productdetailnav  ">-->
                    <!--    <div>-->
                    <!--        <div class="productdetailsmallportion">-->
                    <!--            <img src="images/prdtc-smll.jpg" class="img-responsive" alt="img">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div>-->
                    <!--        <div class="productdetailsmallportion">-->
                    <!--            <img src="images/prdtc-smll.jpg" class="img-responsive" alt="img">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div>-->
                    <!--        <div class="productdetailsmallportion">-->
                    <!--            <img src="images/prdtc-smll.jpg" class="img-responsive" alt="img">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>

                <div class="col-md-5  ">
                    <div class="productdetailtext">
                        <ul class="product-detail-heading">
                            <li>
                                <h3 class="pull-left">Your Heading Here! </h3>
                            </li>
                            <li> <span class="pull-right">$20.00</span></li>
                        </ul>

                        <div class="clearfix"></div>
                        <ul>
                            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></i></a></li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            Duis aute irure dolor in reprehenderit.</p>

                        <ul class="d-flex">
                            <li>Quantity</li>
                            <li class="quanity product-detail">
                                <div class="num-block skin-2">
                                    <div class="num-in">
                                        <span class="minus dis"></span>
                                        <input type="text" class="in-num" value="1" readonly="">
                                        <span class="plus"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="iconlist">
                        <ul>
                            <li><i class="fa fa-truck" aria-hidden="true"></i>Lorem ipsum dolor sit amet, consectetur.</li>
                            <li><i class="fa fa-tag" aria-hidden="true"></i>Lorem ipsum dolor sit amet, consectetur.</li>
                        </ul>
                        <a href="{{route('cartPage')}}" class=" cat-sub-btn ">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product detail sec end -->





    <!-- tabs -->
    <section class="description">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Reviews</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Additional Info</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut
                                perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                                ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>

                        </div>
                        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore elt dolore magna aliqua uliat enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident suint in culpa qui officia deserunt mollit anim id est laborum.
                                This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet
                                nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu inist eliate. Class aptent taciti sociosqu ad litora
                                torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam
                                pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore elt dolore magna aliqua uliat enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat duis aute irure dolor in reprehenderit in voluptate velit esse .</p>
                        </div>
                        <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore elt dolore magna aliqua uliat enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident suint in culpa qui officia deserunt mollit anim id est laborum.
                                This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet
                                nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu inist eliate. Class aptent taciti sociosqu ad litora
                                torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam
                                pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore elt dolore magna aliqua uliat enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat duis aute irure dolor in reprehenderit in voluptate velit esse .</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- tabs -->


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