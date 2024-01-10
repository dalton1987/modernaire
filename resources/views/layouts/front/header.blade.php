<?php 
   $segment = Request::segments();
   $hood_categories = DB::table('categories')->where('type', 'hoods')->where('deleted_at', null)->where('is_active', '1')->get();
   $part_categories = DB::table('categories')->where('type', 'parts')->where('deleted_at', null)->where('is_active', '1')->get();
   
   ?>
<header id="header">
   <div class="menuSec">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-md-7 col-sm-7 col-12 centerCol">
               <div class="main_logo text-center">
                  <a href="{{route('home')}}"><img src="{{asset($logo->img_path)}}"/></a>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-2 col-md-2">
               <div class="header-logo">
                  <a href="{{route('home')}}"><img class="websiteLogo" src="{{asset($logo->img_path)}}" alt="img"></a>
               </div>
            </div>
            <div class="col-md-8 col-lg-8 d-none d-md-block">
               <!--destop menu start-->
               <ul id="menu" class="desktop_header" style="display: block;">
                  <!--<li><a class="{{request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">HOME</a></li>-->
                  <li>
                     <a class="{{request()->routeIs('shop') ? 'active' : '' }}" href="{{route('shop')}}">HOODS </a>
                     <ul>
                        @foreach($hood_categories as $hood_cat)
                        <li><a href="{{route('categoryDetail', $hood_cat->slug)}}">{{$hood_cat->category}}</a></li>
                        @endforeach
                        <!--<li><a href="">Island Hoods</a></li>-->
                        <!--<li><a href="">Liners</a></li>-->
                     </ul>
                  </li>
                  <li><a class="{{request()->routeIs('gallery') ? 'active' : '' }}" href="{{route('gallery')}}">PHOTO GALLERY </a></li>
                  <li>
                     <a class="{{request()->routeIs('faq') ? 'active' : '' }}" href="javascript:void(0)">PRODUCT INFORMATION</a>
                     <ul>
                        <li><a href="{{route('faq')}}">FAQs</a></li>
                        <li><a href="{{route('motoroption')}}">Motor Options</a></li>
                        <li><a href="{{route('materials')}}">Materials</a></li>
                        <li><a href="javascript:void(0)">Downloads</a></li>
                     </ul>
                  </li>
                  <li>
                     <a class="{{request()->routeIs('parts') ? 'active' : '' }}" href="javascript:void(0)">OWNERS</a>
                     <ul>
                        <li><a href="{{route('parts')}}">PARTS</a></li>
                        <li><a href="{{route('useandcare')}}">Use and Care</a></li>
                        {{-- <li><a href="{{route('materials')}}">Materials</a></li> --}}
                        <li><a href="{{route('instructional_information')}}">Instructional Information</a></li>
                        <li><a href="{{route('warrantyinformation')}}">Warranty Information</a></li>
                     </ul>
                  </li>
                  <!--<li><a class="{{request()->routeIs('locateDealer') ? 'active' : '' }}" href="{{route('locateDealer')}}">Find a Dealer</a></li>-->
                  <li><a class="{{request()->routeIs('contact') ? 'active' : '' }}" href="{{route('contact')}}">CONTACT US</a></li>
                  <!-- <li><a href="{{route('customProducts')}}" class="cs-btn">Build Your Own</a></li> -->
                  {{--
                  <li>
                     <a class="{{request()->routeIs('parts') ? 'active' : '' }}" href="{{route('parts')}}">PARTS</a>
                     <ul>
                        @foreach($part_categories as $part_cat)
                        <li><a href="{{route('partscategoryDetail', $part_cat->slug)}}">{{$part_cat->category}}</a></li>
                        @endforeach
                        <!--<li><a href="">Filters</a></li>-->
                     </ul>
                  </li>
                  --}}
                  {{--@if(Auth::guest())
                  <li><a href="{{route('signin')}}"><i class="fa fa-user"></i></a></li>
                  @else
                  <li><a href="{{route('account')}}"><i class="fa fa-user"></i></a></li>
                  @endif--}}
               </ul>
               <!--destop menu end-->
               <!--mobile menu start-->
               <ul id="menu">
                  <!--<li><a class="{{request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">HOME</a></li>-->
                  <li>
                     <a class="{{request()->routeIs('shop') ? 'active' : '' }}" href="{{route('shop')}}">HOODS </a>
                     <ul>
                        @foreach($hood_categories as $hood_cat)
                        <li><a href="{{route('categoryDetail', $hood_cat->slug)}}">{{$hood_cat->category}}</a></li>
                        @endforeach
                     </ul>
                  </li>
                  <li><a class="{{request()->routeIs('gallery') ? 'active' : '' }}" href="{{route('gallery')}}">PHOTO GALLERY </a></li>
                  <li>
                     <a class="{{request()->routeIs('faq') ? 'active' : '' }}" href="javascript:void(0)">PRODUCT INFORMATION</a>
                     <ul>
                        <li><a href="{{route('faq')}}">FAQs</a></li>
                        <li><a href="{{route('motoroption')}}">Motor Options</a></li>
                        <li><a href="{{route('materials')}}">Materials</a></li>
                        <li><a href="javascript:void(0)">Downloads</a></li>
                     </ul>
                  </li>
                  <li>
                     <a class="{{request()->routeIs('parts') ? 'active' : '' }}" href="javascript:void(0)">OWNERS</a>
                     <ul>
                        <li><a href="{{route('parts')}}">PARTS</a></li>
                        <li><a href="{{route('useandcare')}}">Use and Care</a></li>
                        {{--<li><a href="{{route('materials')}}">Materials</a></li>--}}
                        <li><a href="{{route('instructional_information')}}">Instructional Information</a></li>
                        <li><a href="{{route('warrantyinformation')}}">Warranty Information</a></li>
                     </ul>
                  </li>
                  <li><a class="{{request()->routeIs('contact') ? 'active' : '' }}" href="{{route('contact')}}">CONTACT US</a></li>
                  <li><a href="{{route('customProducts')}}" class="cs-btn">Build Your Own</a></li>
                  {{--
                  <li>
                     <a class="{{request()->routeIs('parts') ? 'active' : '' }}" href="{{route('parts')}}">PARTS</a>
                     <ul>
                        @foreach($part_categories as $part_cat)
                        <li><a href="{{route('partscategoryDetail', $part_cat->slug)}}">{{$part_cat->category}}</a></li>
                        @endforeach
                     </ul>
                  </li>
                  --}}
                  {{--@if(Auth::guest())
                  <li><a href="{{route('signin')}}"><i class="fa fa-user"></i></a></li>
                  @else
                  <li><a href="{{route('account')}}"><i class="fa fa-user"></i></a></li>
                  @endif--}}
               </ul>
            </div>
            <div class="col-lg-2 col-md-2">
            	<div class="header_build_cta">
            		<a href="{{route('customProducts')}}" class="cs-btn">Build Your Own</a>
            	</div>
            </div>
         </div>
      </div>
      <div class="find_dealer">
         <a href="{{route('locateDealer')}}"><i class="fas fa-map-marker-alt"></i> Find a Dealer</a>
      </div>
   </div>
</header>
<style type="text/css">
   .websiteLogo{
   height: 27px;
   object-fit: contain;
   }
   .menu.poppup-mnu a {
   text-transform: uppercase;
   }
</style>