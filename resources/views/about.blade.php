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
                <div class="col-md-12 col-lg-6">
                    <div class="build-hood-txt">
                        <div class="abt-hed">
                            <h5><?= html_entity_decode($cms9->title) ?> </h5>
                            <h3><?= html_entity_decode($cms9->sub_title) ?></h3>
                        </div>
                        <p><?= html_entity_decode($cms9->content) ?></p>

                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="build-hood-img">
                        <img src="{{asset($cms9->image)}}" alt="images">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="abt-txt">
                        <?= html_entity_decode($cms9->extra_content) ?>
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


<!-- ============================================================== -->
<!-- BODY END HERE -->
<!-- ============================================================== -->

@endsection
@section('css')
<style>
.build-hood-sec {
    background-image: url({{asset($cms9->sub_image)}});
}

.abt-hed * {
    z-index: unset;
}


</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection