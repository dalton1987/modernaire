@extends('layouts.main')

@section('content')



<!-- META TAGS -->

@section('pageTitle',$pageTitle)

@section('pagedescription',$pagedescription)

@section('Keywords',$pagetags)



<?php

$general_installation = DB::table('file_managements')->where('id', '3')->first();

$spec_sheet = DB::table('file_managements')->where('id', '5')->first();

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

                                

                                @if($product->type == "product")

                                <h2>{{$product->product_title}}</h2>

                                @else

                                <h2>{{$banner->title}}</h2>

                                @endif

                                

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









    <!-- product detail sec start -->

    <form method="post" action="{{ route('save_cart') }}" id="add-cart">

    @csrf

      <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">

      <input type="hidden" name="quantity" id="quant">



      @if(Auth::user() && Auth::user()->user_type == '2')

      <input type="hidden" name="price" id="price" value="{{$product->dealer_price != ''? $product->dealer_price : '0'}}">

      @else

      <input type="hidden" name="price" id="price" value="{{$product->price}}">

      @endif



      <input type="hidden" name="sizes" id="sizes" value="">    



    <section class="productdetailsec">

        <div class="container">

            <div class="row">

                <div class="col-md-6  ">







                  <div class="productdetailfor">

                    <div>

                        <div class="productdetailportion">

                            <img src="{{asset($product->image)}}" class="img-responsive" alt="img">

                        </div>

                    </div>

                  </div>









                    <!-- Viewing the 3D .stl file should be available as an option to the user. -->

                    {{--

                    <div id="stl_cont" style="width:500px;height:500px;margin:0 auto;"></div>







                    <script src="{{asset('stl_viewer.min.js')}}"></script>

                    <script>

                        var stl_viewer = new StlViewer(

                            document.getElementById("stl_cont"), {

                                models: [{

                                    filename: "mystl.STL"

                                }]

                            }

                        );

                    </script>--}}

                 



                  

                </div>



                <div class="col-md-6">

                    <div class="productdetailtext">

                        <ul class="product-detail-heading">

                            <li>

                                <h3 class="pull-left">{{$product->product_title}} </h3>

                            </li>

                          @if($product->type == "part")

                            @if(Auth::user() && Auth::user()->user_type == '2')

                            <li> <span class="pull-right">${{$product->dealer_price != ''? $product->dealer_price: '0.00'}}</span></li>

                            @else

                            <li> <span class="pull-right">${{$product->price}}</span></li>

                            @endif

                           @endif

                        </ul>



                        <div class="clearfix"></div>

                        {{--

                        <ul>

                              @for($counter= 0; $counter < $averageRatings; $counter++)

                              <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>

                              @endfor

                              @for($counter= 0; $counter < 5 - $averageRatings; $counter++)

                              <li><a href="#"><i class="fa fa-star-o"></i></a></li>

                              @endfor

                            <!-- <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>

                            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>

                            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>

                            <li><a href="#"><i class="fa fa-star"></i></a></li>

                            <li><a href="#"><i class="fa fa-star"></i></i></a></li>

 -->                        </ul>

                        --}}

                   @if($product->type == "product")

                        

                         



                            @if($product->is_custom == '1')

                            <!-- view catalog -->

                            <a class=" cat-sub-btn me-2" href="{{route('productDetail2', $product->slug)}}">

                            Customise Product

                         <!--    <a class=" cat-sub-btn" download href="{{route('productDetail2', $product->slug)}}">

                                Download Product Manual

                            </a> -->

                            </a>

                            @endif

                             @endif

                                @if($product->type == "product")

                                <a class=" cat-sub-btn me-2"  target="_blank" href="{{asset('images/UseandCare.pdf')}}">

                                Product Manual 

                            </a>

                                  <a class="cat-sub-btn me-2"  target="_blank" href="{{asset($general_installation->file)}}">

                               {{$general_installation->title}} 

                            </a>

                           

                              

                           

                           

                             

                                @endif

                

              

              @if($product->type == "product")

              <ul class="desc_list">
                <table>
                  
                  <tr>
                    <th class="w-30">Model</th>
                    <td class="w-70">{{$product->model}}</td>
                  </tr>
                  @if($product->standard_sizes != '')
                  <tr>
                    <th class="w-30">Standard Sizes</th>
                    <td class="w-70"><?= html_entity_decode($product->standard_sizes) ?></td>
                  </tr>
                   @endif
                   @if($product->finishes != '')
                   <tr>
                     <th class="w-30">Finishes</th>
                     <td class="w-70"><span><?= html_entity_decode($product->finishes) ?></span></td>
                   </tr>
                  @endif
                </table>

                <!-- <li>Model <span>{{$product->model}}</span></li>

                

                

                @if($product->standard_sizes != '')

                <li>Standard Sizes<span>

                <?= html_entity_decode($product->standard_sizes) ?>

                

                {{--<ul class="desc_sub_list">

                    <li>Widths: 30”, 36”, 42”, 48”, 54”, 60”, and 66”</li>

                    <li>Heights: 18” or 30”</li>

                    <li>Depths: 24” or 27”</li>

                  </ul>--}}

                  </span>

                </li>

                @endif

                

                

                @if($product->finishes != '')

                <li>Finishes<span><?= html_entity_decode($product->finishes) ?></span></li>

                @endif -->

                

                

              </ul>

              @endif

                         

                            

                        <div class="prod_det_p">     



                            <?= html_entity_decode($product->short_description) ?>

                        </div>



                        <!-- lead time -->

                        @if($product->type == "product")



                        <?php

                        $hoods = DB::table('m_flag')->where('id', '1500')->orWhere('id', '1600')->get();

                        $hoods = array($hoods[0]->flag_show_text => $hoods[0]->flag_value, $hoods[1]->flag_show_text => $hoods[1]->flag_value);



                        $liners = DB::table('m_flag')->where('id', '1700')->orWhere('id', '1800')->get();

                        $liners = array($liners[0]->flag_show_text => $liners[0]->flag_value, $liners[1]->flag_show_text => $liners[1]->flag_value);



                        ?>





                        {{--<select class="hoods_types" id="hoods_types">

                          <option selected="" disabled="">Select Type</option>

                          @if($product->category == 'wall-hoods' || $product->category == 'island-hoods')



                            @foreach($hoods as $key1=>$type1)

                            <option value="{{$type1}}">{{$key1}}</option>

                            @endforeach



                          @elseif($product->category == 'liners')



                            @foreach($liners as $key2=>$type2)

                            <option value="{{$type2}}">{{$key2}}</option>

                            @endforeach



                          @endif





                            

                        </select>--}}



                        <p class="lead">Lead Time: <span class="lead_time"></span></p>

                        @endif









                        @if($product->type != "product")

                        <ul class="d-flex">

                            <li>Quantity</li>

                            <li class="quanity product-detail">

                                <div class="num-block skin-2">

                                    <div class="num-in">

                                        <span class="minus dis"></span>

                                        <input id="product_quantity" type="text" class="in-num" value="1" readonly="">

                                        <span class="plus"></span>

                                    </div>

                                </div>

                            </li>

                        </ul>

                         <? 

                      if(($product->sizes) != null){

                   

                        $sizes = explode(',', $product->sizes);

                        foreach ($sizes as $key => $value) {

                           $sizes_data = DB::table('sizes')->where('deleted_at', null)->where('id', $value)->get(); 





                        }

 

                       ?>

                        <select class="sizes" id="product_sizes">

                          <option selected="" disabled="">Select Size</option>

                          <? foreach ($sizes as $key => $value) {

                        

                          $sizes_data = DB::table('sizes')->where('deleted_at', null)->where('id', $value)->get(); 

                         

                          foreach ($sizes_data as $sz_key => $sz_value) {

                            ?>

                          <option value="{{$sz_value->id}}">{{$sz_value->title}}</option>

                          <? }   } ?>

                        </select>

                      <? } ?>

                        @endif

                        

                    </div>

                    <div class="iconlist">

                      @if($product->type == "part")

                        <ul>

                           <li><i class="fa fa-truck" aria-hidden="true"></i>Lorem ipsum dolor sit amet, consectetur.</li>

                         <li><i class="fa fa-tag" aria-hidden="true"></i>Lorem ipsum dolor sit amet, consectetur.</li> 

                        </ul>



                      

                        <a id="addCart" href="javascript:void(0)" class=" cat-sub-btn ">Add to Cart</a>

                        <? if(($product->instruction_file) != null){ ?>

                        <a class=" cat-sub-btn me-2" target="_blank"  href="{{asset($product->instruction_file)}}">

                               {{'General Instruction File'}} 

                        </a>

                      <? } ?>

                        @else

                        {{--<a href="{{url('locateDealer')}}" class=" cat-sub-btn ">Contact Dealer</a>--}}

          

            <a class=" cat-sub-btn me-2"  href="javascript:void(0)">

                               View 3D File

                         </a>

             

                         <a class=" cat-sub-btn me-2" target="_blank"  href="{{route('customProducts')}}">

                               Build Your Own

                         </a>

                         <? if(($product->instruction_file != null)){ ?>

                         <a class=" cat-sub-btn me-2" target="_blank"  href="{{asset($product->instruction_file)}}">

                               {{'Specification Sheet'}} 

                         </a>

                         <? }else{ ?>

                         <a class=" cat-sub-btn me-2" target="_blank"  href="{{asset($spec_sheet->file)}}">

                               {{$spec_sheet->title}} 

                         </a>

                         <? } ?>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>



    </form>

    <!-- product detail sec end -->

  

  

  

  

  

  <!-- spec details -->

  @if($product->type == "product")

  <section class="miss-viss spec_sec_head">

    <div class="container">

	

		@if($product->chrome_knob_image != '')

        <div class="row align-items-center">

            <div class="col-md-6 new_pad">

                <h3>Chrome Variable Knobs</h3>

                <?= html_entity_decode($product->chrome_knob) ?>

            </div>

            <div class="col-md-6 p-0">

                <img src="{{asset($product->chrome_knob_image)}}" alt="">

            </div>

        </div>

		@endif

		

		@if($product->led_lighting_image != '')

        <div class="row align-items-center">

            <div class="col-md-6 p-0">

                <img src="{{asset($product->led_lighting_image)}}" alt="">

            </div>

            <div class="col-md-6 new_pad">

                <h3>3000K LED Lighting</h3>

                <?= html_entity_decode($product->led_lighting) ?>

            </div>

        </div>

		@endif

		

		

		

		@if($product->baffle_filters_image != '')

    <div class="row align-items-center">

            <div class="col-md-6 new_pad">

                <h3>Baffle Filters</h3>

                <?= html_entity_decode($product->baffle_filters) ?>

            </div>

            <div class="col-md-6 p-0">

                <img src="{{asset($product->baffle_filters_image)}}" alt="">

            </div>

        </div>

		@endif

		

		@if($product->implemented_underside_image != '')

        <div class="row align-items-center">

            <div class="col-md-6 p-0">

                <img src="{{asset($product->implemented_underside_image)}}" alt="">

            </div>

            <div class="col-md-6 new_pad">

                <h3>Fully Implemented Underside</h3>

                <?= html_entity_decode($product->implemented_underside) ?>

            </div>

        </div>

		@endif

		

		

    </div>

  </section>

  @endif

  <!-- spec details -->

    

    

    

    @if($product->type == "product")

    

    <?php

    $product_images = DB::table('product_imagess')->where('product_id', $product->id)->where('is_deleted', '0')->get();

    

    ?>

    

    {{--<section class="four_accordions_section">

        <div class="container">

            <div class="row">

                <div class="centerCol col-lg-9 col-md-10 col-sm-12">

                    <div class="accordion_wrap_portion">

                        <div class="accordion" id="accordionExample">



                                   

              {{--<div class="accordion-item">

                              <h2 class="accordion-header" id="heading1">

                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapseOne">

                                 Images

                                  

                                </button>

                              </h2>

                              <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionExample" style="">

                                <div class="accordion-body">

                                    <div class="row">

                                        

                                        @if(count($product_images) > 0)

                                            @foreach($product_images as $image)

                                            <div class="col-lg-4">

                                              <div class="gallery-sec-images">

                                                <a href="{{asset($image->image)}}" data-fancybox="Images">

                                                    <img class="prod_gallery" src="{{asset($image->image)}}">

                                                </a>

                                              </div>

                                            </div>

                                             @endforeach

                                        @else

                                        <div class="col-lg-12">

                                          <div class="gallery-sec-images">

                                              <h3 class="no_image">No images available!</h3>

                                          </div>

                                          </div>

                                        @endif

                                  

                                  

                                  <!--<div class="col-lg-4">-->

                                  <!--  <div class="gallery-sec-images">-->

                                  <!--    <a href="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652938490-gal-img-5.jpg.jpg" data-fancybox="Images"><img src="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652938490-gal-img-5.jpg.jpg"></a>-->

                                  <!--    <a href="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652938511-gal-img-1.jpg.jpg" data-fancybox="Images"><img src="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652938511-gal-img-1.jpg.jpg"></a>-->

                                  <!--    <a href="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652939384-gal-img-4.jpg.jpg" data-fancybox="Images"><img src="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652939384-gal-img-4.jpg.jpg"></a>-->

                                  <!--    <a href="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652939384-gal-img-4.jpg.jpg" data-fancybox="Images"><img src="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652939384-gal-img-4.jpg.jpg"></a>-->

                                  <!--  </div>-->

                                  <!--</div>-->

                                  <!--<div class="col-lg-4">-->

                                  <!--  <div class="gallery-sec-images">-->

                                  <!--    <a href="https://demo-customlinks.com/modernaire/public/uploads/gallery/gal-img-1_1652939345.jpg" data-fancybox="Images"><img src="https://demo-customlinks.com/modernaire/public/uploads/gallery/gal-img-1_1652939345.jpg"></a>-->

                                  <!--    <a href="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652938464-gal-img-2.jpg.jpg" data-fancybox="Images"><img src="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652938464-gal-img-2.jpg.jpg"></a>-->

                                  <!--    <a href="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652938478-gal-img-3.jpg.jpg" data-fancybox="Images"><img src="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652938478-gal-img-3.jpg.jpg"></a>-->

                                  <!--    <a href="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652938485-gal-img-4.jpg.jpg" data-fancybox="Images"><img src="https://demo-customlinks.com/modernaire/public/uploads/gallery/20220519-1652938485-gal-img-4.jpg.jpg"></a>-->

                                  <!--  </div>-->

                                  <!--</div>-->

                                </div>

                                                     </div>

                              </div>

                            </div>--}}

                                               

              {{--<div class="accordion-item">

                              <h2 class="accordion-header" id="heading2">

                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapseOne">

                                 Standard Sizes

                                  

                                </button>

                              </h2>

                              <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample" style="">

                                <div class="accordion-body" id="standard_sizes_data">



                                  @if($product->standard_sizes != '')

                                    <?= html_entity_decode($product->standard_sizes) ?>

                                  @else

                                  <div class="col-lg-12">

                                    <div class="gallery-sec-images">

                                        <h3 class="no_image">No data available!</h3>

                                    </div>

                                    </div>

                                  @endif



                                  

                                 <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla&lt;</p> -->                    </div>

                              </div>

                            </div>--}}

                                               

              {{--<div class="accordion-item">

                              <h2 class="accordion-header" id="heading3">

                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapseOne">

                                 Motor Options

                                  

                                </button>

                              </h2>

                              <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionExample" style="">

                                <div class="accordion-body" id="motor_options_data">



                                  @if($product->motor_options != '')

                                    <?= html_entity_decode($product->motor_options) ?>

                                  @else

                                  <div class="col-lg-12">

                                    <div class="gallery-sec-images">

                                        <h3 class="no_image">No data available!</h3>

                                    </div>

                                    </div>

                                  @endif

                                  

                                 <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla</p>  -->                   

                               </div>

                                 <!-- <img class="motor_image" src="https://demo-customlinks.com/modernaire/public/uploads/motoroptions/20220816-1660644121-bowler-img.png.png" alt="images">

                                 <img class="motor_image" src="https://demo-customlinks.com/modernaire/public/uploads/motoroptions/20220816-1660644121-bowler-img.png.png" alt="images">

                                 <img class="motor_image" src="https://demo-customlinks.com/modernaire/public/uploads/motoroptions/20220816-1660644121-bowler-img.png.png" alt="images"> -->

                              </div>

                            </div>--}}

                                               

              {{--<div class="accordion-item">

                              <h2 class="accordion-header" id="heading4">

                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapseOne">

                                 Finishes

                                  

                                </button>

                              </h2>

                              <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample" style="">

                                <div class="accordion-body" id="finishes_data">



                                  @if($product->finishes != '')

                                    <?= html_entity_decode($product->finishes) ?>

                                  @else

                                  <div class="col-lg-12">

                                    <div class="gallery-sec-images">

                                        <h3 class="no_image">No data available!</h3>

                                    </div>

                                    </div>

                                  @endif

                                  

                                  

                                 <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla</p>  -->                   

                               </div>

                                 <!-- <img class="finish_image" src="https://demo-customlinks.com/modernaire/public/uploads/gallery/gal-img-1_1652939345.jpg" alt="">

                                 <img class="finish_image" src="https://demo-customlinks.com/modernaire/public/uploads/gallery/gal-img-1_1652939345.jpg" alt="">

                                 <img class="finish_image" src="https://demo-customlinks.com/modernaire/public/uploads/gallery/gal-img-1_1652939345.jpg" alt=""> -->

                              </div>

                            </div>

                                               

                            

                             

                          </div>

                    </div>

                </div>

            </div>

        </div>

    </section>--}}

    @endif







    <!-- tabs -->

    <section class="description">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">



                        <li class="nav-item" role="presentation">

                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Description</button>

                        </li>

                        {{--<li class="nav-item" role="presentation">

                            <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Reviews</button>

                        </li>--}}

                        

                        @if($product->type != "product")

                        <li class="nav-item" role="presentation">

                            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Additional Info</button>

                        </li>

                        @endif

                        

                    </ul>



                    <div class="tab-content">

                        <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            <?= html_entity_decode($product->description) ?>



                        </div>

                        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">



                            <div class="row mt-5">

                                <div class="col-md-6 col-xs-6 col-sm-6">

                                  <div class="commentsMain">

                                    @if(count($reviews) != '')

                                      @foreach($reviews as $data)



                                      <div class="comments">

                                      <input type="hidden" class="name" value="{{$data->name}}">

                                        <div class="row">

                                          <div class="col-md-2 col-xs-12 col-sm-2"> 



                                            <div class="profileImage"></div> 

                                          </div>

                                          <div class="col-md-10 col-xs-12 col-sm-10 no-margin">

                                            <div class="row">

                                              <div class="col-md-8 col-xs-12 col-sm-8">

                                                <h2> {{$data->name}} <span>-  {{date_format(date_create($data->created_at),"F d, Y")}}</span></h2>

                                              </div>



                                              <div class="col-md-4 col-xs-12 col-sm-4 text-right">

                                                <div class="rating">

                                                  <div class="starts" id="stars">

                                                    @for($counter= 0; $counter < $data->star; $counter++)

                                                    <span class="fa fa-star"></span>

                                                    @endfor

                                                    @for($counter= 0; $counter < 5 - $data->star; $counter++)

                                                    <span class="fa fa-star-o" aria-hidden="true"></span>

                                                    @endfor

                                                  </div>

                                                </div>

                                              </div>



                                              <div class="col-md-12 col-xs-12 col-sm-12">

                                                <p id="reviewText">{{$data->comments}}</p>

                                              </div>

                                            </div>

                                          </div>

                                        </div>

                                      </div>

                                      @endforeach 

                                    @else

                                    <div class="comments">

                                      <div class="row">   

                                        <div class="col-md-10 col-xs-12 col-sm-10 no-margin">

                                          <div class="col-md-12 col-xs-12 col-sm-12">

                                            <h2 id="noReviews">No reviews yet</h2>

                                          </div>

                                        </div>

                                      </div>

                                    </div>

                                    @endif

                                  </div>

                                </div>



                                <div class="col-md-6 col-xs-6 col-sm-6">

                                  <div class="leavereply">

                                    <h1>Leave a Comment</h1>



                                    <form method="post" action="javascript:void(0)" @if(Auth::user()) id="productReview" @else id="notLogged" @endif>

                                    @csrf



                                      <input type="hidden" name="product_id" value="{{$product->id}}">

                                      <input type="hidden" name="user_id" value="{{Auth::user()->id}}">



                                      <div class="rating">

                                        <div class="stars">

                                          <select class="form-control" name="star" id="starRating">

                                            <option selected="" disabled="">Please Select Star(s)</option>

                                            <option value="1">1</option>

                                            <option value="2">2</option>

                                            <option value="3">3</option>

                                            <option value="4">4</option>

                                            <option value="5">5</option>

                                          </select>

                                         </div>

                                      </div><br>



                                    

                                      <input id="name_input" class="form-control" type="text" name="name" placeholder="Name" required="" value="{{Auth::user()->name}} {{Auth::user()->last_name}}"><br>

                                      <input id="email_input" class="form-control" type="email" name="email" placeholder="Email" required="" value="{{Auth::user()->email}}"><br>

                                      <textarea rows="5" class="form-control" name="comments" placeholder="Message"></textarea><br>

                                      <div class="news-form">

                                        <span><button class=" cat-sub-btn ">POST COMMENT</button></span>

                                      </div>

                                    </form>

                                  </div>

                                </div>

                              </div>





                            

                        </div>

                        <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                            <?= html_entity_decode($product->additional_information) ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- tabs -->





    <!-- company logo sec -->

    @include('widgets/partner')

 



<!-- ============================================================== -->

<!-- BODY END HERE -->

<!-- ============================================================== -->



@endsection

@section('css')

<style>

/*reviews*/



.mt-5 {

    margin-top: 3rem !important;

}

.commentsMain {

    height: 485px;

    overflow-y: scroll;

    overflow-x: hidden;

}

.comments {

    margin-bottom: 30px;

    padding-right: 40px;

}

#noReviews {

    font-size: 30px;

    margin-top: 6%;

}

.comments h2 {

    font-size: 19px;

    font-weight: 600;

    color: #000;

    margin-bottom: 0;

}

.leavereply h1 {

    color: #000;

    font-size: 40px;

}

#name_input, #email_input{

  text-align: unset;

}



#profile p{

    color: #a8a8a8;

    font-size: 15px;

    line-height: 30px;

    padding-top: 15px;

    margin-top: 15px;

}



#reviewText{

    color: #a8a8a8;

    font-size: 15px;

    line-height: 0px!important;

}



.profileImage {

  width: 60px;

  height: 60px;

  border-radius: 50%;

  background: #00a2e8;

  font-size: 35px;

  color: #fff;

  text-align: center;

  line-height: 61px;

  margin: 20px 0;

  text-transform: capitalize;

}



button.cat-sub-btn {

    background: #f7bb1c;

    color: #fff;

    padding: 16px 30px;

    border: unset;

}



button.cat-sub-btn:hover {

    background: #000;

}



.productdetailtext ul li:nth-child(4) a i {

    color: #ffba00!important;

}



.productdetailtext ul li:last-child a i {

    color: #ffba00!important;

}



.sizes{

    width: 50%;

    border: 1px solid #ccccce;

    padding: 15px 20px;

    border-radius: 10px;

    margin-top: 17px;

    background-position: right 0.75rem center; 

}

/*reviews*/







.no_image{

    font-size: 30px;

}





.prod_gallery{

    height: 220px;

    object-fit: cover;

    object-position: center;

}



.motor_image{

    padding-top: 12px;

    padding-left: 20px;

    padding-bottom: 22px;

}



.finish_image{

    height: 162px;

    width: 162px;

    padding-top: 12px;

    padding-left: 20px;

    padding-bottom: 22px;

}





.hoods_types{

    width: 50%;

    border: 1px solid #ccccce;

    padding: 15px 20px;

    border-radius: 10px;

    margin-top: 17px;

    background-position: right 0.75rem center; 

}





.lead_time{

    color: #212529!important;

    font-size: 24px!important;

    line-height: 45px!important;

    font-weight: 600!important;

    /*margin: 17px 0 0!important;*/

    font-family: inherit!important;

    padding: 20px 0 0px!important;

}



.lead{

  font-size: 24px!important;

  font-weight: 600!important;

  color: #F7BB1C!important;

  font-family: inherit!important;

  line-height: 45px!important;

  /*margin: 17px 0 0!important;*/

  padding: 20px 0 0px!important;

}







#motor_options_data img{

    padding-top: 12px;

    padding-left: 20px;

    padding-bottom: 22px;

}



#finishes_data img{

    height: 162px;

    width: 162px;

    padding-top: 12px;

    padding-left: 20px;

    padding-bottom: 22px;

}





</style>

@endsection







@section('js')





<script type="text/javascript">



   $(document).ready(function(){



      $('#addCart').click(function(){

        $('#quant').val($('#product_quantity').val());



         $('#add-cart').submit();  

      });

      

   });

 

</script>



<script>

var e = document.getElementById("product_sizes");



function onChange() {

  var value = e.value;

  $('#sizes').val(value);

}

e.onchange = onChange;

onChange();

</script>



<script type="text/javascript">



  // review image display 

  $(document).ready(function(){

    $('.comments').each(function() {

      var intials = $(this).find('.name').val().charAt(0);

      var profileImage = $(this).find('.profileImage').text(intials);

    });

  });

   



    







  // review submit

  $('#productReview').submit(function( event ) {

  let form_id = $('#productReview');

  var formData = new FormData($(this)[0]);



    event.preventDefault();

    $.ajax({

        url: '{{route('reviewSubmit')}}',

        type: 'post',

        data: formData,

        contentType: false,

        processData: false,

        dataType: 'json',

        success: function( _response ){

            // Handle your response..

            console.log(_response.message);

            if(_response.status == true){

              $.toast({

                heading: 'Success!',

                position: 'bottom-right',

                text:  _response.message,

                loaderBg: '#ff6849',

                icon: 'success',

                hideAfter: 3000,

                stack: 6

              });



              form_id[0].reset();

              setTimeout(function(){

                window.location.reload(1);

              }, 2000);

            }

            else{

              $.toast({

                  heading: 'Error!',

                  position: 'bottom-right',

                  text:  _response.message,

                  loaderBg: '#ff6849',

                  icon: 'error',

                  hideAfter: 2000,

                  stack: 6

                });



            }

            

            

        },

        error: function( _response ){

            // Handle error

            console.log(_response.message);

            $.toast({

              heading: 'Error!',

              position: 'bottom-right',

              text:  _response.message,

              loaderBg: '#ff6849',

              icon: 'error',

              hideAfter: 3000,

              stack: 6

            });

            

        }

    });

});

</script>



<!-- review (not logged) -->

<script type="text/javascript">

  $('#notLogged').submit(function( event ) {



    event.preventDefault();



    $.toast({

      heading: 'Error!',

      position: 'bottom-right',

      text:  'You need to login first!',

      loaderBg: '#ff6849',

      icon: 'error',

      hideAfter: 3000,

      stack: 6

    });

            





});

</script>





<!-- hoods_types -->

<script type="text/javascript">



  $('.lead').hide();



  $('.hoods_types').change(function(){

    var lead_time = $(this).val();

    

    $('.lead').show();

    $('.lead_time').text(lead_time);



  });

</script>



@endsection