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


    <section class="galler-pg-sec">
        <div class="container">
            <div class="row  ">
                <div class="col-md-12 centerCol col-lg-6">
                    <div class="our-photo-h">
                        <h3><?= html_entity_decode($cms11->title) ?></h3>
                        <p><?= html_entity_decode($cms11->content) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="gallery_tabs">
                <ul class="nav nav-tabs justify-content-center mt-5" id="myTab" role="tablist">
                        <?php $counter=0; ?>
                    @foreach($type as $value) 

                    @if($value->id == 1)
                     <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="{{$value->name}}-tab" data-bs-toggle="tab" data-bs-target="#{{$value->name}}" type="button" role="tab" aria-controls="{{$value->id}}" aria-selected="true">{{$value->name}}</button>
                  </li>
                  @else
                  <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $counter == 0  }} ? 'active' : ''" id="{{$value->name}}-tab" data-bs-toggle="tab" data-bs-target="#{{$value->name}}" type="button" role="tab" aria-controls="{{$value->name}}" aria-selected="true">{{$value->name}}</button>
                  </li>
                  @endif
                     <?php $counter++;  ?>
                  @endforeach
              <!--     <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Model</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Island/Wall</button>
                  </li> -->
                </ul>
                
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="Material" role="tabpanel" aria-labelledby="Material-tab">
                      <div class="row mt-5">

                        @foreach($galleries_material as $data)
                       
        
                        @if($data[0]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[0]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[0]->image)}}">
                                    <i class="fal fa-plus" aria-hidden="true"></i>
                                    <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a>
                                </a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[1]->image != '')
                        <div class="col-md-4 col-lg-6">
                            <div class="gallery-img">
                                <img src="{{asset($data[1]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[1]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[2]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[2]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[2]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[3]->image != '')
                        <div class="col-md-4 col-lg-6">
                            <div class="gallery-img">
                                <img src="{{asset($data[3]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[3]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[4]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[4]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[4]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif 
        
                        @if($data[5]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[5]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[5]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @endforeach
        
                    </div>
                  </div>
                  <div class="tab-pane fade" id="Model" role="tabpanel" aria-labelledby="Model-tab">
                      <div class="row mt-5">

                        @foreach($galleries_model as $data)
                        
        
                        @if($data[0]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[0]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[0]->image)}}">
                                    <i class="fal fa-plus" aria-hidden="true"></i>
                                    <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a>
                                </a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[1]->image != '')
                        <div class="col-md-4 col-lg-6">
                            <div class="gallery-img">
                                <img src="{{asset($data[1]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[1]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[2]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[2]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[2]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[3]->image != '')
                        <div class="col-md-4 col-lg-6">
                            <div class="gallery-img">
                                <img src="{{asset($data[3]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[3]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[4]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[4]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[4]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif 
        
                        @if($data[5]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[5]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[5]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @endforeach
        
                    </div>
                  </div>
                  <div class="tab-pane fade" id="Island" role="tabpanel" aria-labelledby="Island-tab">
                      <div class="row mt-5">

                        @foreach($galleries_Island as $data)
                        
        
                        @if($data[0]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[0]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[0]->image)}}">
                                    <i class="fal fa-plus" aria-hidden="true"></i>
                                    <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a>
                                </a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[1]->image != '')
                        <div class="col-md-4 col-lg-6">
                            <div class="gallery-img">
                                <img src="{{asset($data[1]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[1]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[2]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[2]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[2]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[3]->image != '')
                        <div class="col-md-4 col-lg-6">
                            <div class="gallery-img">
                                <img src="{{asset($data[3]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[3]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @if($data[4]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[4]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[4]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif 
        
                        @if($data[5]->image != '')
                        <div class="col-md-4 col-lg-3">
                            <div class="gallery-img">
                                <img src="{{asset($data[5]->image)}}" alt="">
                                <a href="javascript:void(0)" fancybox="{{asset($data[5]->image)}}"><i class="fal fa-plus" aria-hidden="true"></i>
                                <a href="https://www.instagram.com/" class="insta_logo"><i class="fab fa-instagram"></i></a></a>
                            </div>
                        </div>
                        @endif
        
                        @endforeach
        
                    </div>
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