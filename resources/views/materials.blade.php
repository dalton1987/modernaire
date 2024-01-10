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
                                <!--<h2>{{$banner->title}}</h2>-->
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


    <section class="galler-pg-sec">
        <div class="container">
            <div class="row  ">
                <div class="col-md-12 centerCol col-lg-6">
                    <div class="our-photo-h">
                        <!--<h3><?= html_entity_decode($cms11->title) ?></h3>-->
                        <h3>Materials Photos</h3>
                        <p><?= html_entity_decode($cms11->content) ?></p>
                        
                        <div id="materialFinish">
                            <a target="_blank" class=" cat-sub-btn me-2"  href="{{asset('files/Modern_Aire_Available_Finishes.pdf')}}">
                                Modern Aire Available Finishes
                            </a>
                        </div>
                        
                            
                    </div>
                </div>
            </div>
            
            
            
                            
            <div class="row mt-8">

                @foreach($galleries as $data)
                

                @if($data[0]->image != '')
                <div class="col-md-4 col-lg-3">
                    <div class="gallery-img">
                        <img src="{{asset($data[0]->image)}}" alt="">
                        <a href="javascript:void(0)" fancybox="{{asset($data[0]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
                @endif

                @if($data[1]->image != '')
                <div class="col-md-4 col-lg-6">
                    <div class="gallery-img">
                        <img src="{{asset($data[1]->image)}}" alt="">
                        <a href="javascript:void(0)" fancybox="{{asset($data[1]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
                @endif

                @if($data[2]->image != '')
                <div class="col-md-4 col-lg-3">
                    <div class="gallery-img">
                        <img src="{{asset($data[2]->image)}}" alt="">
                        <a href="javascript:void(0)" fancybox="{{asset($data[2]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
                @endif

                @if($data[3]->image != '')
                <div class="col-md-4 col-lg-6">
                    <div class="gallery-img">
                        <img src="{{asset($data[3]->image)}}" alt="">
                        <a href="javascript:void(0)" fancybox="{{asset($data[3]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
                @endif

                @if($data[4]->image != '')
                <div class="col-md-4 col-lg-3">
                    <div class="gallery-img">
                        <img src="{{asset($data[4]->image)}}" alt="">
                        <a href="javascript:void(0)" fancybox="{{asset($data[4]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
                @endif 

                @if($data[5]->image != '')
                <div class="col-md-4 col-lg-3">
                    <div class="gallery-img">
                        <img src="{{asset($data[5]->image)}}" alt="">
                        <a href="javascript:void(0)" fancybox="{{asset($data[5]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
                @endif

                @endforeach

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
#materialFinish{
    margin-top: 45px;
    margin-bottom: 0px;
}


.galler-pg-sec {
    padding: 80px 0px 55px!important;
}


</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection