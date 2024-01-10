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

     <section class="motr-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6 centerCol">
                    <div class="prod-sec-h wow fadeInUp">
                        <h4>INTERNAL BLOWERS</h4>

                    </div>
                </div>
            </div>
            <div class="row wow fadeInLeft">
			@if(count($internal) > 0)
            <? foreach ($internal as $key => $value) {?>
                <div class="col-md-4">
                    <div class="prdtc-inn">
                        <a href="javascript:void(0)"> 
                            <img src="{{asset($value->image)}}" alt="images"></a>
                        <span>{{$value->title}}</span>
                        <p>{{$value->description}}</p>

                    </div>
                </div>
            <? } ?>
			@else
				<div class="col-md-12">
					<span class="not_available">No Blower Available</span>
                </div>
			@endif
            </div>

            <div class="row mt-8">
                <div class="col-md-12 col-lg-6 centerCol">
                    <div class="prod-sec-h wow fadeInUp">
                        <h4>INLINE BLOWERS</h4>

                    </div>
                </div>
            </div>
            <div class="row wow fadeInLeft">
			
				@if(count($inline) > 0)
                <? foreach ($inline as $in_key => $in_value) {?>
                <div class="col-md-4">
                    <div class="prdtc-inn">
                        <a href="javascript:void(0)"> 
                            <img src="{{asset($in_value->image)}}" alt="images"></a>
                        <span>{{$in_value->title}}</span>
                        <p>{{$in_value->description}}</p>

                    </div>
                </div>
                <? } ?>
				@else
				<div class="col-md-12">
					<span class="not_available">No Blower Available</span>
                </div>
				@endif
				
            </div>

            <div class="row mt-8">
                <div class="col-md-12 col-lg-6 centerCol">
                    <div class="prod-sec-h wow fadeInUp">
                        <h4>External BLOWERS</h4>

                    </div>
                </div>
            </div>
            <div class="row wow fadeInLeft">
			
				@if(count($external) > 0)
                <? foreach ($external as $ex_key => $ex_value) {?>
                <div class="col-md-4">
                    <div class="prdtc-inn">
                        <a href="javascript:void(0)"> 
                            <img src="{{asset($ex_value->image)}}" alt="images"></a>
                        <span>{{$ex_value->title}}</span>
                        <p>{{$ex_value->description}}</p>

                    </div>
                </div>
                <? } ?>
				@else
				<div class="col-md-12">
					<span class="not_available">No Blower Available</span>
                </div>
				@endif
            </div>

        </div>
    </section>


<!-- ============================================================== -->
<!-- BODY END HERE -->
<!-- ============================================================== -->

@endsection
@section('css')
<style>
.not_available{
	color: var(--theme-color);
    font-size: 38px;
    line-height: 0px;
    font-weight: 600;
    position: relative;
    text-align: center;
    display: block;
}
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection