<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <meta name="description" content="Admin"> -->
        <meta name="author" content="Admin">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset(!empty($favicon->img_path)?$favicon->img_path:'')}}">
        <!-- <title>{{ config('app.name') }}</title> -->


        <!-- META TAGS -->
        
        @hasSection('pageTitle')
            <title>@yield('pageTitle')</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif
        
        <meta name="description" content="@yield('pagedescription')">
        <meta name="Keywords" content="@yield('Keywords')">

        
        <!-- ============================================================== -->
        <!-- All CSS LINKS IN BELOW FILE -->
        <!-- ============================================================== -->
        @include('layouts.front.css')
        @yield('css')

    </head>
    <body style="--theme-color:#f7bb1c;--primary-text-color:#000000;--secondary-text-color:#ffffff;">
      

        @include('layouts/front.header')
		
		
		 
	

		
        @yield('content')
        @include('layouts/front.footer')
        <!-- ============================================================== -->
        <!-- All SCRIPTS ANS JS LINKS IN BELOW FILE -->
        <!-- ============================================================== -->
        @include('layouts/front.scripts')
        @yield('js')



        <div class="gallery-wrap">
            <img src="{{asset('images/gal-img-1.jpg')}}" alt="">
        </div>

        <button class="menu-toggle"></button>
        <nav>
            <ul class="menu poppup-mnu">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('about')}}">ABOUT US</a></li>
                <li><a href="{{route('shop')}}">HOODS</a></li>
                <li><a href="{{route('gallery')}}">PHOTO GALLERY </a></li>
                <li><a href="{{route('contact')}}">CONTACT US</a></li>
            </ul>
        </nav>

    </body>
</html>