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




    <!-- product detail sec start -->
    <form method="post" action="{{ route('save_cart') }}" id="add-cart">
    @csrf
      <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
      <input type="hidden" name="quantity" id="quant">
      <input type="hidden" name="price" id="price" value="{{$product->price}}">


    <section class="productdetailsec">
        <div class="container">
            <div class="row">
                <div class="col-md-6  ">
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
                    </script>
                 

                  
                </div>

                <div class="col-md-6">
                    <div class="productdetailtext">
                        <ul class="product-detail-heading">
                            <li>
                                <h3 class="pull-left">{{$product->product_title}} </h3>
                            </li>
                          @if($product->type == "part")
                           <li> <span class="pull-right">${{$product->price}}</span></li>
                           @endif
                        </ul>

                        <div class="clearfix"></div>
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
                   @if($product->type == "product")
                        <br> <br>
                         

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
                                <a class=" cat-sub-btn me-2"  download href="{{asset('images/UseandCare.pdf')}}">
                                Download Product Manual 1
                            </a>
                                  <a class="cat-sub-btn me-2"  download href="{{asset('images/WallHoodInstallationInstructions.pdf')}}">
                               Download Product Manual 2
                            </a>
                           
                              <!-- <a class=" cat-sub-btn" download href="{{asset($product->pdf)}}">
                                Download Product Manual
                            </a>-->
                                @endif
                         
                            
                             

                        <?= html_entity_decode($product->short_description) ?>

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
                    </div>
                    <div class="iconlist">
                      @if($product->type == "part")
                        <ul>
                           <li><i class="fa fa-truck" aria-hidden="true"></i>Lorem ipsum dolor sit amet, consectetur.</li>
                         <li><i class="fa fa-tag" aria-hidden="true"></i>Lorem ipsum dolor sit amet, consectetur.</li> 
                        </ul>

                      
                        <a id="addCart" href="javascript:void(0)" class=" cat-sub-btn ">Shop Now</a>
                        @else
                        <a href="{{url('locateDealer')}}" class=" cat-sub-btn ">Contact Dealer</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    </form>
    <!-- product detail sec end -->





    <!-- tabs -->
    <section class="description">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Reviews</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Additional Info</button>
                        </li>
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
/*reviews*/
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

@endsection