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
        
    <section class="build-hood-sec about-page-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="build-hood-txt">
                        <div class="abt-hed">
                            <h5><?= html_entity_decode($cms17->title) ?> </h5>
                            <h3><?= html_entity_decode($cms17->sub_title) ?></h3>
                        </div>
                        <p><?= html_entity_decode($cms17->content) ?></p>

                    </div>
                </div>
                <!--<div class="col-md-12 col-lg-6">
                    <div class="build-hood-img">
                        <img src="{{asset($cms9->image)}}" alt="images">
                    </div>
                </div>-->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="abt-txt">
                        <?= html_entity_decode($cms17->extra_content) ?>
                    </div>
                </div>
            </div>



            @include('widgets/partner')
            
            <!-- <div class="row mt-8">
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
            </div> -->


        </div>
    </section>

<section class="faq_page">
      <div class="container">
          
          <!--pdf links-->
          <div class="mb-5">
              <div class="row">
               <div class="col-lg-6 col-md-6 col-6 centerCol">
                   <ul class="d-flex align-items-center justify-content-center">
                       <li>
                           <a target="_blank" href="{{asset($use_care->file)}}" class="pdf_btn">
                           {{$use_care->title}} <i class="far fa-file-pdf"></i>
                           </a>
                       </li>
                       
                   </ul>
               </div>
           </div>
          </div>
          
      </div>
    </section>

<!-- ============================================================== -->
<!-- BODY END HERE -->
<!-- ============================================================== -->

@endsection
@section('css')
<style>
.build-hood-sec {
     background-image: unset!important; 
    width: 100%!important;
    height: 100%!important;
    background-position: center center!important;
    background-size: cover!important;
    margin-top: -90px!important;
    padding-bottom: 80px!important;
    z-index: -1;
}
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection