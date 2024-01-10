@extends('layouts.main')
@section('content')

<!-- META TAGS -->
@section('pageTitle',$pageTitle)
@section('pagedescription',$pagedescription)
@section('Keywords',$pagetags)


<?php
$categories = DB::table('gallery_categories')->where('is_active', '1')->where('deleted_at', null)->get();


$segment = Request::segments();



$all_models = DB::table('products')->where('is_active', '1')->where('is_deleted', '0')->where('model', '!=', null)->get();
?>
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
                
                <div class="row">
                
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="follow_us_wrap mb-5">
                        <h4>Follow Us</h4>
                        <a target="_blank" href="{{ App\Http\Traits\HelperTrait::returnFlag(400) }}"><i class="fab fa-instagram"></i></a>
                    </div>
                    
                    <div class="catogeriesbox">
                        <h4>CATEGORIES</h4>
                    </div>
                    <div class="frequently-list">
                        <div class="panel-groupnew" id="accordion1" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-bs-toggle="collapse" href="#headingone" aria-expanded="false" class="collapsed @if(!isset($segment[1])) active @endif" >
                                        All
                                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div class="collapse @if(isset($segment[1])) show @endif" id="headingone" style="">
                                    <div class="panel-body">
                                        <ul>
                                            @foreach($categories as $data)

                                                @if($data->name == 'Model')
                                                <div class="panel-heading" role="tab" id="headingOne{{$data->id}}">
                                                    <li id="subcat_list">
                                                        <a role="button" data-bs-toggle="collapse" href="#headingone{{$data->id}}" aria-expanded="false" class="collapsed @if(isset($segment) && $segment[0] == 'galleryModelCategory') active @endif" >
                                                        {{$data->name}}
                                                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                </div>
                                                <div class="collapse @if(isset($segment) && $segment[0] == 'galleryModelCategory') active @endif" id="headingone{{$data->id}}" style="">
                                                    <div class="panel-body">
                                                        <ul class="model_list">
														
														<li><a class="@if(isset($segment) && $segment[1] == 'model') active @endif" href="{{route('galleryModelCategory', 'model')}}"> All Models</a> 
                                                                </li>
                                                            @foreach($all_models as $data)
                                                         
                                                                <li><a class="@if(isset($segment) && $segment[1] == $data->slug) active @endif" href="{{route('galleryModelCategory', $data->slug)}}"> {{$data->model}}</a> 
                                                                </li>
                                                            @endforeach
                                                            
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                                @else
                                                <li><a class="@if(isset($segment) && $segment[1] == $data->slug) active @endif" href="{{route('galleryCategory', $data->slug)}}"> {{$data->name}}</a> 
                                                <!--<i class="fa fa-chevron-right" aria-hidden="true"></i>-->
                                                </li>
                                                @endif
                                            @endforeach
                                            
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                
                <div class="col-md-9 col-sm-12 col-xs-12 prdt-pg-col">
                    
                    <div class="row">
                        
                        @if(count($galleries_material) != '')
                            @foreach($galleries_material as $data)
                            
                            
                            
                            <div class="col-md-4">
                                <div class="gallery-img">
                                    <img src="{{asset($data->image)}}" alt="">
                                    <a href="javascript:void(0)" fancybox="{{asset($data->image)}}"><i class="fal fa-plus" aria-hidden="true"></i></a>
                                    
                                    @if($data->product_id != null || $data->product_id != '0')
                                    
                                    <?php
                                    $model = DB::table('products')->where('id', $data->product_id)->first();
                                    ?>
                            
                                    <span class="type_new">{{$model->model}}</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @else
                        <div class="col-md-12">
                        <div class="product-main">
                            <div class="product-txt-inner" style="height: 100%;">
                                <div class="row">
                                   <h3 id="no_image">No Image Found</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endif
                                                           
                   
                    
                    <div class="row mt-4">
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                        <div class="pagination">
                          {!! $galleries_material->appends(['search' => Request::get('search')])->render() !!}
                        </div>
                      </div>
                      <div class="col-md-3"></div>
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
.gallery_tabs{
    margin-top: 60px;
}

.catogeriesbox {
    margin-top: 12px;
}





.panel-body ul li a.active{
    color: #F7BB1C!important;
}

.panel-title a.active{
    color: #F7BB1C!important;
}

.pagination {
    margin-bottom: 25px;
}


.type_new {
    position: absolute;
    top: 10px;
    left: 10px;
    color: #000;
    font-weight: 900;
    background: #f7bb1c;
    padding: 0 12px;
    font-family: 'oswald_stencilbold';
}



/*model filter*/
#subcat_list{
        border-bottom: 1px solid #EEEEEE!important;
}


.model_list{
    overflow-y: scroll;
    height: 600px;
}


#no_image{
	color: #000!important;
}
	
/*model filter*/

</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection