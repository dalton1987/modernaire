<?php
$cms8 = DB::table('pages')->where('id', '8')->first();
$cms12 = DB::table('pages')->where('id', '12')->first();
$images = DB::table('galleries')->where('deleted_at', null)->where('is_active', '1')->orderBy('id', 'DESC')->take(8)->get();

$products = DB::table('products')->where('is_active', '1')->where('is_deleted', '0')->where('type', 'product')->orderBy('id', 'DESC')->get()->take(4);

$parts = DB::table('products')->where('is_active', '1')->where('is_deleted', '0')->where('type', 'part')->orderBy('id', 'DESC')->get()->take(4);
?>

<!-- NEWSLETTER SEC STRT -->
{{--<section class="newsletter_sec">
   <div class="container">
      <div class="row flexRow">
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="row align-items-center">
               <div class="col-lg-2">
                  <img src="{{asset($cms12->image)}}" class="img-fluid" alt="">
               </div>
               <div class="col-12 col-sm-12 col-md-10 col-lg-10">
                  <div class="newsletter_txt">
                     <h2><?= html_entity_decode($cms12->title) ?></h2>
                     <p>
                     <p><?= html_entity_decode($cms12->content) ?></p>
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-5 offset-lg-1">
            <div class="newsletter_form">
               <form id="newsletterForm" method="post">
               @csrf
                  <input required type="text" placeholder="Enter your email address here…" name="newsletter_email">
                  <button class="btn_newsletter" id="newsletterBtn">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>--}}
<!-- NEWSLETTER SEC END -->

<div class="footerSec" id="foot-id">
    <div class="container">

        <div class="row">
            <!--<div class="col-md-4 col-sm-12  ">-->
            <!--    <div class="footer-about">-->
            <!--        <h2><?= html_entity_decode($cms8->title) ?></h2>-->
            <!--        <p><?= html_entity_decode($cms8->content) ?></p>-->

            <!--        <div class="foot-review">-->
            <!--            <i class="fas fa-users"></i>-->
            <!--            <div class="review-txt">-->
            <!--                <h3>Review from customers</h3>-->
            <!--                <ul>-->
            <!--                    <li><a href="#"><i class="fas fa-star"></i></a></li>-->
            <!--                    <li><a href="#"><i class="fas fa-star"></i></a></li>-->
            <!--                    <li><a href="#"><i class="fas fa-star"></i></a></li>-->
            <!--                    <li><a href="#"><i class="fas fa-star"></i></a></li>-->
            <!--                    <li><a href="#"><i class="fas fa-star"></i></a></li>-->
            <!--                </ul>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="col-md-4 col-sm-12  ">-->
            <!--    <div class="footer-gallery">-->
            <!--        <h2>GALLERY</h2>-->

            <!--        @foreach($images->chunk(4) as $data)-->
            <!--        <div class="row">-->

            <!--            @foreach($data as $value)-->
            <!--            <div class="col-3">-->
            <!--                <div class="foott-gall">-->
            <!--                    <img src="{{asset($value->image)}}" alt="images">-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            @endforeach-->

            <!--        </div>-->
            <!--        @endforeach-->

            <!--    </div>-->
            <!--</div>-->
            <!--<div class="col-md-4 col-sm-12  ">-->
            <!--    <div class="footer-news">-->
            <!--        <h2><?= html_entity_decode($cms12->title) ?></h2>-->
            <!--        <p><?= html_entity_decode($cms12->content) ?></p>-->
            <!--        <form method="post" action="javascript:void(0)" class="newsletter_form" id="newsletterForm">-->
            <!--        @csrf-->

            <!--            <input required="" type="email" name="newsletter_email" placeholder="Email">-->
            <!--            <input type="submit" value="SUBSCRIBE">-->
            <!--        </form>-->



            <!--    </div>-->
            <!--</div>-->
            
            
            
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="footer_logo">
                     <img src="{{asset($logo->img_path)}}" class="img-fluid" alt="">
                </div>
                <div class="footer_social">
                    <ul>
                        
                        @if(App\Http\Traits\HelperTrait::returnFlag(300) != '')
                        <li class="f1"><a target="_blank" href="{{ App\Http\Traits\HelperTrait::returnFlag(300) }}"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        
                        @if(App\Http\Traits\HelperTrait::returnFlag(500) != '')
                        <li><a target="_blank" href="{{ App\Http\Traits\HelperTrait::returnFlag(500) }}"><i class="fab fa-twitter"></i></a></li>
                        @endif
                        
                        @if(App\Http\Traits\HelperTrait::returnFlag(400) != '')
                        <li class="f2"><a target="_blank" href="{{ App\Http\Traits\HelperTrait::returnFlag(400) }}"><i class="fab fa-instagram"></i></a></li>
                        @endif
                        
                        @if(App\Http\Traits\HelperTrait::returnFlag(600) != '')
                        <li ><a target="_blank" href="{{ App\Http\Traits\HelperTrait::returnFlag(600) }}"><i class="fab fa-pinterest-p"></i></a></li>
                        @endif
                        
                        
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="footer_links_wrap mb-5">
                    <h4>Hoods</h4>
                    <ul>
                        
                        @foreach($products as $data)
                        <li><a href="{{route('shopDetail', $data->slug)}}">{{$data->product_title}}</a></li>
                        @endforeach
                        <!--<li><a href="#">Island</a></li>-->
                        <!--<li><a href="#">Liner</a></li>-->
                        <!--<li><a href="#">Lorem ipsum</a></li>-->
                    </ul>
                </div>
                
                <div class="footer_links_wrap">
                    <h4>Parts</h4>
                    <ul>
                        
                        @foreach($parts as $data)
                        <li><a href="{{route('shopDetail', $data->slug)}}">{{$data->product_title}}</a></li>
                        @endforeach
                        
                        <!--<li><a href="#">Lorem ipsum</a></li>-->
                        <!--<li><a href="#">Lorem ipsum</a></li>-->
                        <!--<li><a href="#">Lorem ipsum</a></li>-->
                    </ul>
                </div>
            </div>
            
            
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="footer_links_wrap mb-5">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="{{route('locateDealer')}}">Find A Dealer</a></li>
                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                        <li><a href="{{route('faq')}}">FAQs</a></li>
                        <li><a href="{{route('parts')}}">Purchase Parts</a></li>
                        <li><a href="{{route('materials')}}">Materials</a></li>
                        
                        @if(Auth::guest())
                        <li><a href="{{route('signin')}}">Login / Sign Up</a></li>
                        @else
                        <li><a href="{{route('account')}}">Account</a></li>
                        @endif
                
                
                    </ul>
                </div>
                
                <div class="footer_links_wrap">
                    <h4>Open Hours</h4>
                    <ul>
                        <li><a href="javascript:void(0)">{{ App\Http\Traits\HelperTrait::returnFlag(900) }}</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="footer_links_wrap mb-5">
                    <h4>Contact Info</h4>
                    <ul>
                        <li><a href="javascript:void(0)" class="d-flex align-items-baseline"><i class="fas fa-map-marker-alt me-3"></i> <span>{{ App\Http\Traits\HelperTrait::returnFlag(800) }}</span></a></li>
                        <li><a href="tel:{{ App\Http\Traits\HelperTrait::returnFlag(100) }}" class="d-flex align-items-baseline"><i class="fas fa-phone-alt me-3"></i> {{ App\Http\Traits\HelperTrait::returnFlag(100) }}</a></li>
                        
                        @if(App\Http\Traits\HelperTrait::returnFlag(700) != '')
                        <li><a target="_blank" href="{{ App\Http\Traits\HelperTrait::returnFlag(700) }}"  class="d-flex align-items-baseline"><i class="fas fa-envelope me-3"></i>{{ App\Http\Traits\HelperTrait::returnFlag(700) }}</a></li>
                        @endif
                        
                    </ul>
                </div>
                
            </div>
            
        </div>
    </div>

    <div class="footer-btm">
        <div class="row">
            <div class="col-md-6">
                <div class="copy-txt">
                    <p>{{App\Http\Traits\HelperTrait::returnFlag(200) }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="copy-txt">
                    <p>Design and Developed by <a href="https://designsraptor.com/" target="blank">Designs Raptor</a></p>
                </div>
            </div>
        </div>
    </div>
</div>



{{--<ul class="color_pallet">
    <li>
        <label for="theme-color">Select your Theme Color:</label>
        <input type="color" id="theme-color" name="theme-color" value="#f7bb1c">
        
    </li>
    <li>
        <label for="primary-text-color">Select your Primary Font Color:</label>
        <input type="color" id="primary-text-color" name="primary-text-color" value="#000000">
        
    </li>
    <li>
        <label for="secondary-text-color">Select your Secondary Font Color:</label>
        <input type="color" id="secondary-text-color" name="secondary-text-color" value="#ffffff">
        
    </li>
</ul>--}}


<style type="text/css">
/*.footerSec {*/
/*    background-image: url({{asset($cms8->image)}});*/
/*}*/

.footerSec {
    background-image: url({{asset($cms8->image)}});
    background-color: #000 !important;
    background-image: none;
}
</style>