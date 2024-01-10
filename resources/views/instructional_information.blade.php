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

    <!-- FAQ PAGE STRT -->
    <section class="faq_page">
      <div class="container">
          
          
          <div class="row  ">
                <div class="col-md-12 centerCol col-lg-6">
                    <div class="our-photo-h">
                        <h3>Instructional Information</h3>
                    </div>
                </div>
            </div>
            
            
          
          <!--pdf links-->
          <div class="mb-5">
              <div class="row">
                  
            <div class="col-lg-4 col-md-4 col-4">
                <div class="file_sec">
                       <a target="_blank" href="{{asset($general_wallhood_installation->file)}}" class="pdf_btn">
                           {{$general_wallhood_installation->title}} <i class="far fa-file-pdf"></i>
                           </a>
                    </div>
                    
                    <div class="file_sec">
                       <a target="_blank" href="{{asset($fan_switch_installation->file)}}" class="pdf_btn">
                           {{$fan_switch_installation->title}}  <i class="far fa-file-pdf"></i>
                           </a>
                    </div>
                    
                    <div class="file_sec">
                       <a target="_blank" href="{{asset($light_switch_installation->file)}}" class="pdf_btn">
                           {{$light_switch_installation->title}}  <i class="far fa-file-pdf"></i>
                           </a>
                    </div>
                    
            </div>
            
            <div class="col-lg-4 col-md-4 col-4">
                <div class="file_sec">
                       <a target="_blank" href="{{asset($knob_installation->file)}}" class="pdf_btn">
                           {{$knob_installation->title}} <i class="far fa-file-pdf"></i>
                           </a>
                    </div>
                    
                    <div class="file_sec">
                       <a target="_blank" href="{{asset($baffle_filter_installation->file)}}" class="pdf_btn">
                           {{$baffle_filter_installation->title}}  <i class="far fa-file-pdf"></i>
                           </a>
                    </div>
                    
                    <div class="file_sec">
                       <a target="_blank" href="{{asset($mesh_filter_installation->file)}}" class="pdf_btn">
                           {{$mesh_filter_installation->title}}  <i class="far fa-file-pdf"></i>
                           </a>
                    </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-4">
                <div class="file_sec">
                       <a target="_blank" href="{{asset($wiring_harness_installation->file)}}" class="pdf_btn">
                           {{$wiring_harness_installation->title}} <i class="far fa-file-pdf"></i>
                           </a>
                    </div>
                    
                    <div class="file_sec">
                       <a target="_blank" href="{{asset($charcoal_filter_installation->file)}}" class="pdf_btn">
                           {{$charcoal_filter_installation->title}}  <i class="far fa-file-pdf"></i>
                           </a>
                    </div>
                    
                    <div class="file_sec">
                       <a target="_blank" href="{{asset($motor_replacement_installation->file)}}" class="pdf_btn">
                           {{$motor_replacement_installation->title}}  <i class="far fa-file-pdf"></i>
                           </a>
                    </div>
            </div>
               
  
               
           </div>
          </div>
      </div>
    </section>
    <!-- FAQ PAGE END -->


    <!-- company logo sec -->
    @include('widgets/partner')

    
   


<!-- ============================================================== -->
<!-- BODY END HERE -->
<!-- ============================================================== -->

@endsection
@section('css')
<style>
.our-photo-h h3 {
    font-size: 50px;
    font-family: inherit;
    margin-bottom: 55px;
}



.use_care{
    font-family: Saira, sans-serif;
    font-size: 31px;
    line-height: 45px;
    color: var(--backgroundlight-main-color);
    font-weight: 600;
}

.inner-banner h2 {
    text-transform: capitalize;
}



.file_sec{
        margin-bottom: 25px;
}


.pdf_btn{
    font-size: inherit!important;
    width: 83%!important;
}
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection