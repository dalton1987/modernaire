@extends('layouts.main')
@section('content')

<!-- META TAGS -->
@section('pageTitle',$pageTitle)
@section('pagedescription',$pagedescription)
@section('Keywords',$pagetags)

<?php
$segment = Request::segments();

$cms15 = DB::table('pages')->where('id', '15')->first();


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
    
    
    
            <!--parts-->
            @if(isset($segment) && $segment[0] == 'parts' || $segment[0] == 'product')
            <section class="galler-pg-sec">
                <div class="row  ">
                    <div class="col-md-12 centerCol col-lg-6">
                        <div class="our-photo-h">
                            <h3>{{$cms15->title}}</h3>
                            <p><?= html_entity_decode($cms15->content) ?></p>
                        </div>
                    </div>
                </div>
            </section>
            @endif
            
            
            
            

    <!-- Prtoducts -->
    <section class="productsec product-page-sec">
        <div class="container">
            
            
            <!--products-->
            @if(isset($segment) && $segment[0] != 'parts' && $segment[0] != 'product')
            <div class="gallery_tabs">
                <ul class="nav nav-tabs justify-content-center mt-5" id="myTab" role="tablist">
                    
                    
                    
                    <li class="nav-item" role="presentation">
                        <a href="{{route('shop')}}" class="nav-link @if(isset($segment) && $segment[0] == 'shop') active @endif" type="button">All</a>
                    </li>
                    
                    @foreach($categories as $data) 
                    <li class="nav-item" role="presentation">
                        <a href="{{route('categoryDetail', $data->slug)}}" class="nav-link @if(isset($segment) && $segment[1] == $data->slug) active @endif" type="button">{{$data->category}}</a>
                    </li>
                  @endforeach
                </ul>
            </div>
            @endif
                
            
            
            
            
            
            
                
            <div class="row">
                
                {{--
                @if(isset($segment) && $segment[0] == 'parts' || $segment[0] == 'product')
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="catogeriesbox">
                        <h4>CATEGORIES</h4>
                    </div>
                    <div class="frequently-list">
                        <div class="panel-groupnew" id="accordion1" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-bs-toggle="collapse" href="#headingone" aria-expanded="false" class="@if(!isset($segment[1])) active @endif">
                                        All
                                        <i class="fas fa-chevron-down"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div class="collapse @if(isset($segment[1])) show @endif" id="headingone">
                                    <div class="panel-body">
                                        <ul>

                                               @if(isset($segment) && $segment[0] == 'parts' || $segment[0] == 'product')
                                              @foreach($categories as $data)
                                            <li><a class="@if(isset($segment) && $segment[1] == $data->slug) active @endif" href="{{route('partscategoryDetail', $data->slug)}}"> {{$data->category}}</a> 
                                            <!--<i class="fa fa-chevron-right" aria-hidden="true"></i>-->
                                            </li>
                                            @endforeach

                                            @else
                                                @foreach($categories as $data)
                                            <li><a href="{{route('categoryDetail', $data->slug)}}"> {{$data->category}}</a> 
                                            <!--<i class="fa fa-chevron-right" aria-hidden="true"></i>-->
                                            </li>
                                            @endforeach
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="catogeriesbox mt-4">-->
                    <!--    <h4>PRICE RANGE</h4>-->
                    <!--</div>-->
                    <!--<div class="frequently-list">-->
                    <!--    <div class="panel-groupnew panel-groupnew2 " id="accordion" role="tablist" aria-multiselectable="true">-->
                    <!--        <div class="panel panel-default">-->
                    <!--            <div class="panel-heading" role="tab" id="headingOne2">-->
                    <!--                <h4 class="panel-title">-->
                    <!--                    <a role="button" class="hide-btn" data-bs-toggle="collapse" href="#headingtwo2" aria-expanded="true">-->
                    <!--                    All-->
                    <!--                    </a>-->
                    <!--                </h4>-->
                    <!--            </div>-->
                    <!--            <div class="collapse show" id="headingtwo2">-->
                    <!--                <div class="panel-body">-->
                    <!--                    <ul>-->
                    <!--                    <li> -->
                    <!--                      <input @if($range['range'] == 'less_25') checked @endif data-amount="less_25" type="checkbox" class="freq-checkbox priceRange">-->
                    <!--                      <a href="javascript:void(0)" class="price-rang">$0</a>-->
                    <!--                      <span class="dash"> - </span> -->
                    <!--                      <span class="dollar">$25 </span>-->
                    <!--                    </li>-->

                    <!--                    <li> -->
                    <!--                      <input @if($range['range'] == 'between_25_50') checked @endif  data-amount="between_25_50" type="checkbox" class="freq-checkbox priceRange">-->
                    <!--                      <a href="javascript:void(0)" class="price-rang">$25</a> -->
                    <!--                      <span class="dash"> - </span> -->
                    <!--                      <span class="dollar">$50 </span>-->
                    <!--                    </li>-->

                    <!--                    <li> -->
                    <!--                      <input @if($range['range'] == 'between_50_75') checked @endif data-amount="between_50_75" type="checkbox" class="freq-checkbox priceRange">-->
                    <!--                      <a href="javascript:void(0)" class="price-rang">$50</a> -->
                    <!--                      <span class="dash"> - </span> -->
                    <!--                      <span class="dollar">$75 </span>-->
                    <!--                    </li>-->

                    <!--                    <li> -->
                    <!--                      <input @if($range['range'] == 'between_75_100') checked @endif data-amount="between_75_100" type="checkbox" class="freq-checkbox priceRange">-->
                    <!--                      <a href="javascript:void(0)" class="price-rang">$75</a> -->
                    <!--                      <span class="dash"> - </span> -->
                    <!--                      <span class="dollar">$100 </span>-->
                    <!--                    </li>-->

                    <!--                    <li> -->
                    <!--                      <input @if($range['range'] == 'greater_100') checked @endif data-amount="greater_100" type="checkbox" class="freq-checkbox priceRange">-->
                    <!--                      <a href="javascript:void(0)" class="price-rang">$100</a> -->
                    <!--                      <span class="dash"> < </span> -->
                    <!--                      <span class="dollar"></span>-->
                    <!--                    </li>-->

                    <!--                  </ul>-->
                                      
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
                @endif
                --}}
                
                {{--<div  @if(isset($segment) && $segment[0] == 'parts' || $segment[0] == 'product') class="col-md-9 col-sm-12 col-xs-12 prdt-pg-col" @else class="col-md-12 col-sm-12 col-xs-12 prdt-pg-col" @endif>--}}
                    
                <div class="col-md-12 col-sm-12 col-xs-12 prdt-pg-col">     
                    
                    @if(isset($segment) && $segment[0] == 'parts' || $segment[0] == 'product')
                    <div class="row paddingbottom">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <form>
                                      <div class="defaultlist">
                                        @if(isset($segment) && $segment[0] == 'category')
                                          <select id="sort_by_select">
                                             <option selected="" disabled="">Sort By</option>
                                             
                                             <option data-link="{{route('productsCategorySort', ['category'=>$segment[1],'sort'=>oldest] )}}" value="oldest">Oldest</option>
                                             
                                             <option data-link="{{route('productsCategorySort', ['category'=>$segment[1],'sort'=>newest] )}}" value="newest">Newest</option>
                                             
                                             <option data-link="{{route('productsCategorySort', ['category'=>$segment[1],'sort'=>low_to_high] )}}" value="low_to_high">Price Low to High</option>
                                             
                                             <option data-link="{{route('productsCategorySort', ['category'=>$segment[1],'sort'=>high_to_low] )}}" value="high_to_low">Price High to Low</option>
                                          </select>
                                        @else
                                          <select id="sort_by_select">
                                             <option selected="" disabled="">Sort By</option>
                                             <option value="oldest">Oldest</option>
                                             <option value="newest">Newest</option>
                                             <option value="low_to_high">Price Low to High</option>
                                             <option value="high_to_low">Price High to Low</option>
                                          </select>
                                        @endif
                                      </div>
                                       
                                     </form>
                                </div>
                                <!-- <div class="col-md-3 col-sm-12 col-xs-12">
                                    <form>
                                        <div class="defaultlist">
                                            <select>
                                                <option>8</option>
                                            </select>
                                        </div>
                                    </form>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="showinglist">
                                <!-- <p>Showing 1-12 of 48 results</p> -->
                                <p>Showing @if($shop->total() == '0') 0 @else 1 @endif-{{$shop->count()}} of {{$shop->total()}} results</p>
                            </div>
                        </div>
                    </div>
                    @endif




                    @if(count($shop) != '')
                        @foreach($shop->chunk(3) as $key=>$prod)
                        <div @if($key == '0') class="row" @else class="row mt-5" @endif>

                            @foreach($prod as $data)


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
                                    <a href="{{route('shopDetail', $data->slug)}}"> <img class="prodImage" src="{{asset($data->image)}}" alt=""></a>
                                    <div class="product-txt-inner">
                                        <!--<ul class="d-flex">-->

                                        <!--    @for($counter= 0; $counter < $averageRatings; $counter++)-->
                                        <!--    <li><i class="fa fa-star"></i></li>-->
                                        <!--    @endfor-->
                                        <!--    @for($counter= 0; $counter < 5 - $averageRatings; $counter++)-->
                                        <!--    <li><i class="fa fa-star-o"></i></li>-->
                                        <!--    @endfor-->

                                        <!--</ul>-->
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h5>{{$data->product_title}}</h5>
                                                @if($data->type =="part")

                                                    @if(Auth::user() && Auth::user()->user_type == '2')
                                                    <h6>${{$data->dealer_price != ''? $data->dealer_price: '0.00'}}</h6>
                                                    @else
                                                    <h6>${{$data->price}}</h6>
                                                    @endif
                                                @endif
                                            </div>
                                            <!--<div class="col-md-4">-->
                                            <!--    <ul class="product-cart-icon d-flex">-->
                                            <!--        <li> <a class="shopCart" data-product_id_hidden="{{ $data->id }}" data-product_price_hidden="{{$data->price}}"  href="javascript:void(0)"><i class="fal fa-shopping-cart" aria-hidden="true"></i></a></li>-->
                                                    
                                            <!--    </ul>-->
                                            <!--</div>-->
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
                            <div class="product-txt-inner" style="height: 100%;">
                                <div class="row">
                                   <h3>No Product Found</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
               
                    <div class="row mt-4">
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                        <div class="pagination">
                          {!! $shop->appends(['search' => Request::get('search')])->render() !!}
                        </div>
                      </div>
                      <div class="col-md-3"></div>
                    </div>




                </div>
            </div>
        </div>
    </section>



<form class="shopCartForm" method="post" action="{{route('save_cart')}}">
@csrf
    <input type="hidden" name="product_id" class="product_id">
    <input type="hidden" name="quantity" id="quant" value="1">
    <input type="hidden" name="price" class="price">
</form>


    <!-- company logo sec -->
    @include('widgets/partner')
    
 

<!-- ============================================================== -->
<!-- BODY END HERE -->
<!-- ============================================================== -->

@endsection
@section('css')
<style>
.defaultlist select{
    background: unset!important;
}

.prodImage{
    height: 297px!important;
}


.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #f7bb1c;
    border-color: #f7bb1c;
}






.panel-body ul li a.active{
    color: #F7BB1C!important;
}


/*.frequently-list .panel-default>.panel-heading h4 a:not(.collapsed) {*/
/*     color: #000!important; */
/*}*/

.panel-title a.active{
    color: #F7BB1C!important;
}
</style>


@if(isset($segment) && $segment[0] != 'parts' && $segment[0] != 'product')
<style>
#myTab{
    margin-top: unset!important;
    margin-bottom: 50px!important;   
}

section.productsec {
    padding: 80px 0 100px;
}
.gallery_tabs .nav .nav-item .nav-link {
    font-size: 18px!important;
    text-align: center!important;
}
</style>
@endif
@endsection

@section('js')
<!-- price range -->
<script type="text/javascript">
  $('.priceRange').click(function(){
    var amount = $(this).data('amount');

    var url = window.location.href;
    var field1 = 'page';
    var field2 = 'q';
    var field3 = 'range';

    if(url.indexOf('?' + field1 + '=') != -1){
    //   alert('if');
      url = url.split('?')[0];
      var url = url+'?range='+amount;
      window.location = url;
    }
    else if(url.indexOf('?' + field2 + '=') != -1){
    //   alert('if');
      url = url.split('?')[0];
      var url = url+'?range='+amount;
      window.location = url;
    }
    else if(url.indexOf('?' + field3 + '=') != -1){
    //   alert('if');
      url = url.split('?')[0];
      var url = url+'?range='+amount;
      window.location = url;
    }
    else{
    //   alert('else');
      var url = window.location.href+'?range='+amount;
      window.location = url;
    }
    
  });
</script>





<!-- sort by -->

@if(isset($segment) && $segment[0] == 'category')

<script type="text/javascript">
  
  $('#sort_by_select').on('change', function() {

    var redirect = $(this).find(':selected').data('link');
    window.location = redirect;
    
  }); 

</script>


@else

<!-- without category -->
<script type="text/javascript">
    $('#sort_by_select').on('change', function() {

      var value = this.value;

      var redirect = '{{route('productSort', val)}}';
      redirect = redirect.replace('val', value);
      // alert(redirect);
      window.location = redirect;
    
  });  
</script>
@endif
<!-- sort by -->



<script>
    $('.shopCart').click(function(){
        
        var id = $(this).data('product_id_hidden');
        var price = $(this).data('product_price_hidden');
        
        $('.product_id').val(id);
        $('.product_price').val(price);
        
        $('.shopCartForm').submit();
    });
</script>
@endsection