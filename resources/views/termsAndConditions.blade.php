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
                        <div class=" col-md-12 col-lg-12">
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

    <section class="contact-sec   wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
        <div class="container">
            <div class="row  ">
                <div class="col-md-10 centerCol">
                    <div class="sec_head ">
                        <h3 class="text-center">
                            <?= html_entity_decode($cms13->title) ?>
                        </h3>
                        <p><?= html_entity_decode($cms13->content) ?></p>
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
.contact-sec .sec_head p {
    margin-top: 12px;
}

.contact-sec {
    height: auto!important;
}
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection