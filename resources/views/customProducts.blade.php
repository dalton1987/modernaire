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


    <!-- Prtoducts -->
    <section class="productsec product-page-sec">
        <div class="container">
            
            @if(count($products) != '')
                @foreach($products->chunk(3) as $product)
                <div class="row mt-5">

                    @foreach($product as $data)

                    <?php
                    $reviews = DB::table('reviews')->where('product_id', $data->id)->orderBy('id', 'DESC')->where('is_deleted', '0')->get();


                    // star rating
                    $sum = 0;
                    for($counter= 0; $counter < count($reviews); $counter++){
                      $sum = $sum + $reviews[$counter]->star;
                    }
                    if($sum > 0){
                      $averageRatings = round($sum/$counter);
                    }
                    else{
                      $averageRatings = 0;
                    }
                    // star rating
                    ?>



                    <div class="col-md-4">
                        <div class="product-main">
                            <a href="{{route('productDetail2', $data->slug)}}"> <img class="customImage" src="{{asset($data->image)}}" alt=""></a>
                            <div class="product-txt-inner">
                                <ul class="d-flex">
                                    @for($counter= 0; $counter < $averageRatings; $counter++)
                                    <li><i class="fa fa-star"></i></li>
                                    @endfor
                                    @for($counter= 0; $counter < 5 - $averageRatings; $counter++)
                                    <li><i class="fa fa-star-o"></i></li>
                                    @endfor
                                  <!--   <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li> -->
                                </ul>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>{{$data->product_title}}</h5>
                                        <h6>${{$data->price}}</h6>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                           
                </div>
                @endforeach
            @else
            <div class="col-md-12">
                <div class="product-main">
                    <div class="product-txt-inner">
                        <div class="row">
                            <div class="col-md-8">
                                <h5>No Product Found!</h5>    
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
            @endif



            <div class="row mt-4">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="pagination">
                  {!! $products->appends(['search' => Request::get('search')])->render() !!}
                </div>
              </div>
              <div class="col-md-3"></div>
            </div>


                
        </div>
    </section>




    <!-- company logo sec -->
    @include('widgets/partner')
    
    <!-- <section class=" company-log-sc">
        <div class="container">
            <div class="row">
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
            </div>
        </div>
    </section> -->

<!-- ============================================================== -->
<!-- BODY END HERE -->
<!-- ============================================================== -->

@endsection
@section('css')
<style>
.customImage{
    height: 405px!important;
}

.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #f7bb1c;
    border-color: #f7bb1c;
}
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection