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
    <section class="main_slider">
        <span><?= html_entity_decode($cms2->title) ?></span>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators slick-dots">

                @foreach($banners as $key=>$data)
                <div data-bs-target="#carouselExampleControls" data-bs-slide-to="{{$key}}" 
                @if($key == '0') class="active" aria-current="true" @endif aria-label="Slide {{$key+1}}"></div>
                @endforeach

            </div>
            <div class="carousel-inner">

                @foreach($banners as $key=>$data)
                <div class="carousel-item @if($key == '0') active @endif">
                    <img src="{{asset($data->image)}}" class="img-fluid main-bannr-img" alt="...">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row">
                                <div class=" col-md-12 col-lg-6">
                                    <div class="banner_text wow fadeInLeft" data-wow-duration="2s">
                                        <h4><?= html_entity_decode($data->title) ?></h4>
                                        <h2><?= html_entity_decode($data->sub_title) ?></h2>
                                        <p><?= html_entity_decode($data->content) ?></p>
                                        <a href="{{route('about')}}" class="theme-btn">Learn More <i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class=" col-md-12 col-lg-6">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- banner end -->

    <section class="after-banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-5">
                    <div class="sl-bullet  wow fadeInUp">
                        <ul>
                            <li>
                                <h5> <span class="currentBan"><sub class="sub"></sub> <em>1</em> </span>/<span class="totalBan">
                                    @if(count($banners) < 10) 
                                        0{{count($banners)}}
                                    @else
                                        {{count($banners)}}
                                    @endif </span></h5>
                            </li>
                            
                            
                            <li>
                                @if(App\Http\Traits\HelperTrait::returnFlag(300) != '')
                                <a target="_blank" href="{{App\Http\Traits\HelperTrait::returnFlag(300) }}">  <i class="fab fa-facebook-f"></i> </a>
                                @endif
                            </li>
                            
                            
                            
                            <li>
                                @if(App\Http\Traits\HelperTrait::returnFlag(400) != '')
                                <a target="_blank" href="{{App\Http\Traits\HelperTrait::returnFlag(400) }}">  <i class="fab fa-instagram"></i>   </a>
                                @endif
                            </li>
                            
                            
                            
                            <li>
                                @if(App\Http\Traits\HelperTrait::returnFlag(500) != '')
                                <a target="_blank" href="{{App\Http\Traits\HelperTrait::returnFlag(500) }}">   <i class="fab fa-twitter"></i> </a>
                                @endif
                            </li>
                            
                            
                        </ul>

                    </div>
                </div>
                <div class="col-md-12 col-lg-7">
                    <div class="after-b-vdo-slider">
                        
                        
                        @foreach($featured_hoods as $hood)
                        <div>
                            <div class="after-b-vdo wow fadeInRight">
                                <span>Made In USA</span>
                                <ul>
                                    <li>
                                        <h3>Featured Hoods</h3>
                                        <h5>Designed by</h5>
                                        <h6>{{$hood->designed_by}}</h6>
                                        
                                    </li>
                                    <li>
                                        <h5>Model</h5>
                                        <h6>{{$hood->model}}</h6>
                                    </li>
                                    
                                    <!--<p>Made in USA</p>-->
                                    
                                    <li>
                                        <div class="vdo-div">
                                            <img class="hood_image" src="{{asset($hood->image)}}" alt="images">
                                            <a data-fancybox="" href="{{asset($hood->image)}}">
                                                <!--<img src="{{asset('images/play-button.png')}}" alt="">-->
                                                </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        
                        <!--<div>-->
                        <!--    <div class="after-b-vdo wow fadeInRight">-->
                        <!--        <ul>-->
                        <!--            <li>-->
                        <!--                <h3>Featured Hoods</h3>-->
                        <!--                <h5>Designed by</h5>-->
                        <!--                <h6>{{$videos->designed_by}}</h6>-->
                        <!--            </li>-->
                        <!--            <li>-->
                        <!--                <h5>Model</h5>-->
                        <!--                <h6>{{$videos->location}}</h6>-->
                        <!--            </li>-->
                        <!--            <li>-->
                        <!--                <div class="vdo-div">-->
                        <!--                    <img src="{{asset($videos->thumbnail)}}" alt="images">-->
                        <!--                    <a data-fancybox="" href="{{asset($videos->video)}}"><img src="{{asset('images/play-button.png')}}" alt=""></a>-->
                        <!--                </div>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <!--<div>-->
                        <!--    <div class="after-b-vdo wow fadeInRight">-->
                        <!--        <ul>-->
                        <!--            <li>-->
                        <!--                <h3>Featured Hoods</h3>-->
                        <!--                <h5>Designed by</h5>-->
                        <!--                <h6>{{$videos->designed_by}}</h6>-->
                        <!--            </li>-->
                        <!--            <li>-->
                        <!--                <h5>Model</h5>-->
                        <!--                <h6>{{$videos->location}}</h6>-->
                        <!--            </li>-->
                        <!--            <li>-->
                        <!--                <div class="vdo-div">-->
                        <!--                    <img src="{{asset($videos->thumbnail)}}" alt="images">-->
                        <!--                    <a data-fancybox="" href="{{asset($videos->video)}}"><img src="{{asset('images/play-button.png')}}" alt=""></a>-->
                        <!--                </div>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <!--<div>-->
                        <!--    <div class="after-b-vdo wow fadeInRight">-->
                        <!--        <ul>-->
                        <!--            <li>-->
                        <!--                <h3>Featured Hoods</h3>-->
                        <!--                <h5>Designed by</h5>-->
                        <!--                <h6>{{$videos->designed_by}}</h6>-->
                        <!--            </li>-->
                        <!--            <li>-->
                        <!--                <h5>Model</h5>-->
                        <!--                <h6>{{$videos->location}}</h6>-->
                        <!--            </li>-->
                        <!--            <li>-->
                        <!--                <div class="vdo-div">-->
                        <!--                    <img src="{{asset($videos->thumbnail)}}" alt="images">-->
                        <!--                    <a data-fancybox="" href="{{asset($videos->video)}}"><img src="{{asset('images/play-button.png')}}" alt=""></a>-->
                        <!--                </div>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- we manufacture sec -->
    <section class="we-manuf-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="we-manuf-img wow fadeInLeft">
                        <img src="{{asset($cms1->image)}}" alt="images">
                        <span> <img src="{{asset($cms1->sub_image)}}" alt="images"></span>

                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="we-manuf-txt wow fadeInUp">
                        <h6><?= html_entity_decode($cms1->title) ?></h6>
                        <div class="">
                            <h3><?= html_entity_decode($cms1->sub_title) ?></h3>
                        </div>
                        <p><?= html_entity_decode($cms1->content) ?></p>
                        <a href="{{route('shop')}}" class="theme-btn theme-btn-2">See our Models <i class="fal fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- products sec  -->
    <section class="prod-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6 centerCol">
                    <div class="prod-sec-h wow fadeInUp">
                        <h4><?= html_entity_decode($cms3->title) ?></h4>
                        <p><?= html_entity_decode($cms3->content) ?></p>
                    </div>
                </div>
            </div>
          <!--  <div class="row wow fadeInLeft">

                @foreach($products as $data)
                <?php $category = DB::table('categories')->where('slug', $data->category)->first(); ?>
                <div class="col-md-4">
                    <div class="prdtc-inn">
                        <img src="{{asset($data->image)}}" alt="images">
                        <a class="prod_featured" href="{{route('shopDetail', $data->slug)}}">
                            <span>{{$data->product_title}}</span>
                        </a>
                        <?= html_entity_decode(Str::limit($data->short_description, 80) ) ?>

                        
                    </div>
                </div>
                @endforeach
              
              
            </div>-->
            <div class="row wow fadeInLeft">

                @foreach($hoods_catgeories as $data) 
                <div class="col-md-4">
                    <div class="prdtc-inn">
                        <? if(!empty($data->image)){ ?>
                        <img src="{{asset($data->image)}}" alt="images">
                        <? } else{ ?>
                            <img src="{{asset('images/dummy_image.jpg')}}" alt="images">
                        <? } ?>
                        <a class="prod_featured" href="{{route('categoryDetail', $data->slug)}}">
                            <span>{{$data->category}}</span>
                        </a>
                        <?= html_entity_decode(Str::limit($data->catgeory, 80) ) ?>

                        <!--@if($data->discount != '')-->
                        <!--<h6>${{$data->discount}} <span>${{$data->price}}</span> </h6>-->
                        <!--@endif-->
                    </div>
                </div>
                @endforeach
              
              
            </div>
            
        </div>
    </section>

    <!-- build a hood -->


    <!--<section class="build-hood-sec">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-md-12 col-lg-6">-->
    <!--                <div class="build-hood-txt wow fadeInLeft">-->
    <!--                    <h5><?= html_entity_decode($cms4->title) ?> </h5>-->
    <!--                    <h3><?= html_entity_decode($cms4->sub_title) ?></h3>-->
    <!--                    <p><?= html_entity_decode($cms4->content) ?></p>-->
    <!--                    <a href="{{route('about')}}" class="theme-btn theme-btn-2">Read more <i class="fal fa-long-arrow-right" aria-hidden="true"></i></a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-md-12 col-lg-6">-->
    <!--                <div class="build-hood-img">-->
    <!--                    <img src="{{asset($cms4->image)}}" alt="images">-->
    <!--                </div>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--        <div class="row mt-8 wow fadeInUp">-->
    <!--            <div class="col-md-12 col-lg-6">-->
    <!--                <div class="our-photo-h">-->
    <!--                    <h3><?= html_entity_decode($cms5->title) ?></h3>-->
    <!--                    <p><?= html_entity_decode($cms5->content) ?></p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-md-12 col-lg-6">-->
    <!--                <div class="our-photo-btn">-->
    <!--                    <a href="{{route('gallery')}}" class="theme-btn theme-btn-2">View Gallery <i class="fal fa-long-arrow-right" aria-hidden="true"></i></a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--        <div class="row mt-8 wow fadeInUp">-->
    <!--            @foreach($galleries as $data)-->


    <!--            @if($data[0]->image != '')-->
    <!--            <div class="col-md-4 col-lg-3">-->
    <!--                <div class="gallery-img">-->
    <!--                    <img src="{{asset($data[0]->image)}}" alt="">-->
    <!--                    <a href="javascript:void(0)" fancybox="{{asset($data[0]->image)}}"><i class="fal fa-plus"></i></a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            @endif-->

    <!--            @if($data[1]->image != '')-->
    <!--            <div class="col-md-4 col-lg-6">-->
    <!--                <div class="gallery-img">-->
    <!--                    <img src="{{asset($data[1]->image)}}" alt="">-->
    <!--                    <a href="javascript:void(0)" fancybox="{{asset($data[1]->image)}}"><i class="fal fa-plus"></i></a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            @endif-->

    <!--            @if($data[2]->image != '')-->
    <!--            <div class="col-md-4 col-lg-3">-->
    <!--                <div class="gallery-img">-->
    <!--                    <img src="{{asset($data[2]->image)}}" alt="">-->
    <!--                    <a href="javascript:void(0)" fancybox="{{asset($data[2]->image)}}"><i class="fal fa-plus"></i></a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            @endif-->

    <!--            @if($data[3]->image != '')-->
    <!--            <div class="col-md-4 col-lg-6">-->
    <!--                <div class="gallery-img">-->
    <!--                    <img src="{{asset($data[3]->image)}}" alt="">-->
    <!--                    <a href="javascript:void(0)" fancybox="{{asset($data[3]->image)}}"><i class="fal fa-plus"></i></a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            @endif-->

    <!--            @if($data[4]->image != '')-->
    <!--            <div class="col-md-4 col-lg-3">-->
    <!--                <div class="gallery-img">-->
    <!--                    <img src="{{asset($data[4]->image)}}" alt="">-->
    <!--                    <a href="javascript:void(0)" fancybox="{{asset($data[4]->image)}}"><i class="fal fa-plus"></i></a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            @endif-->

    <!--            @if($data[5]->image != '')-->
    <!--            <div class="col-md-4 col-lg-3">-->
    <!--                <div class="gallery-img">-->
    <!--                    <img src="{{asset($data[5]->image)}}" alt="">-->
    <!--                    <a href="javascript:void(0)" fancybox="{{asset($data[5]->image)}}"><i class="fal fa-plus"></i></a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            @endif-->


    <!--            @endforeach-->

    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

    <!-- testimonial sec  -->
    
    
    @if($showReview == '1')
    <section class="testi-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <div class="testi-txt wow bounceIn">
                        <h2><?= html_entity_decode($cms6->title) ?>
                        </h2>
                        <p><?= html_entity_decode($cms6->content) ?></p>

                        <ul>
                            <li><a href="#"><i class="fal fa-long-arrow-left" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fal fa-long-arrow-right" aria-hidden="true"></i></a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-md-8 col-lg-8">
                    <div class="testi-sl-mn">
                        
                        @foreach($testimonials as $data)
                        <div>
                            <div class="testi-sl-inn">
                                <p><?= html_entity_decode($data->comment) ?></p>
                                <h5>{{$data->title}}</h5>
                                <h6>{{$data->designation}}</h6>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif


    <!-- contact home sec -->
    <!--<section class="contact-sec">-->
    <!--    <img src="{{asset($cms7->sub_image)}}" class="img-1" alt="images">-->
    <!--    <img src="{{asset($cms7->image)}}" class="img-2" alt="images">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-md-12 col-lg-6">-->
    <!--                <div class="contact-txt wow fadeInLeft">-->
    <!--                    <h5><?= html_entity_decode($cms7->title) ?></h5>-->
    <!--                    <h3><?= html_entity_decode($cms7->content) ?></h3>-->
    <!--                    <p><?= html_entity_decode($cms7->sub_title) ?></p>-->
    <!--                    <h2><a href="tel:{{App\Http\Traits\HelperTrait::returnFlag(100) }}">{{App\Http\Traits\HelperTrait::returnFlag(100) }}</a> </h2>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-md-12 col-lg-6">-->
    <!--                <div class="contact-frm wow fadeInUp">-->
    <!--                    <form id="inquiryFormContact" method="post" action="javascript:void(0)">-->
    <!--                    @csrf-->

    <!--                    <input type="hidden" name="page" value="home">-->

    <!--                    @if(Auth::user())-->
    <!--                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">-->
    <!--                    @endif-->

    <!--                        <input required="" type="text" name="first_name" placeholder="Name">-->
    <!--                        <input required="" type="email" name="email" placeholder="Email">-->
    <!--                        <input required="" type="text" name="subject" placeholder="Subject">-->
    <!--                        <textarea required="" name="message" placeholder="Message" rows="5"></textarea>-->
                            <!-- <input type="submit" value="Send Request"> -->
    <!--                        <input type="submit" value="Submit">-->
    <!--                    </form>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--    </div>-->
    <!--</section>-->
    
    
    <section class="fnd_dealer_sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 centerCol">
                    <div class="dealer_fnd_txt">
                        <h2>FIND A DEALER</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim</p>
                        <a href="https://demo-customlinks.com/modernaire/locateDealer" class="theme-btn theme-btn-2">Find now <i class="fal fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

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