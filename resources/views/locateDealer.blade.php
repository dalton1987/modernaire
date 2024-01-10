@extends('layouts.main')
@section('content')

<!-- META TAGS -->
@section('pageTitle',$pageTitle)
@section('pagedescription',$pagedescription)
@section('Keywords',$pagetags)

<?php
$total_dealers = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')->get();



// GOOGLE MAP
// get latitude/longitude from session
$current_location = Session::get('location');

$lat = isset($current_location['latitude']) ? $current_location['latitude'] : 0;

$long = isset($current_location['longitude']) ? $current_location['longitude'] : 0;


$dealers = DB::table('dealers')->where('deleted_at', null)->where('is_active', '1')
->where('latitude', '!=', null)->where('longitude', '!=', null)
->get();
// GOOGLE MAP


?>

<style type="text/css">
  /*GOOGLE MAP*/
  #map-canvas{
  margin: 54px 0 0 0!important;  
  width: 100%!important;
  height: 530px!important;
  filter: invert(1) contrast(1) grayscale(1);
}

/*GOOGLE MAP*/
</style>



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

    <div class="dealers-page">
       <div class="container">
          <div class="row flex-row">
              <!--old code -->
             <? if((($_GET['slug']) == '') and (($_GET['address']) == '') and (($_GET['zip']) == '')){ ?>
             <div class="col-md-7 col-sm-12">
                 <div class="dealer_head">
                     <h3 class="dealer_count">{{count($total_dealers)}} DEALERS IN YOUR LOCATION</h3>
                 </div>
                 <form action="{{route('locateDealer')}}" method="get" class="search_form">
                   <input type="text" name="address" placeholder="search for address" class="address" value="{{$_GET['address']}}">
                   <input type="text" name="zip" placeholder="search for zip" class="zip" value="{{$_GET['zip']}}">
                   <input type="submit" name="search" id="serach_btn" class="search-bnt-sub">
                 </form>
                 
                {{--
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                   <?php $counter=0; ?>
                   
                    @foreach($dealer as $value)
                 
                    <?php
                    $company = DB::table('services')->where('slug',$value->service)->where('deleted_at', null)->where('is_active', '1')->first();
                 
                    ?>
                    @if($value->id == '1')
                   
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="{{$company->slug}}-tab" data-bs-toggle="tab" data-bs-target="#{{$company->slug}}" type="button" role="tab" aria-controls="{{$company->slug}}" aria-selected="true">{{$company->name}}</button>
                  </li>
                  @else
                    @if($company != '')
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $counter == 0   ? 'active' : ''}}" id="{{$company->slug}}-tab" data-bs-toggle="tab" data-bs-target="#{{$company->slug}}" type="button" role="tab" aria-controls="{{$company->slug}}" aria-selected="true">{{$company->name}}</button>
                        </li>
                    @endif
                  @endif
                   <?php $counter++;  ?>
                  @endforeach
            <!--       <li class="nav-item" role="presentation">
                    <button class="nav-link" id="krik-tab" data-bs-toggle="tab" data-bs-target="#krik" type="button" role="tab" aria-controls="krik" aria-selected="false">Krik</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="lakeview-tab" data-bs-toggle="tab" data-bs-target="#lakeview" type="button" role="tab" aria-controls="lakeview" aria-selected="false">Lakeview Distributes</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Luxury-tab" data-bs-toggle="tab" data-bs-target="#Luxury" type="button" role="tab" aria-controls="Luxury" aria-selected="false">Luxury Backyard International</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Tandem-tab" data-bs-toggle="tab" data-bs-target="#Tandem" type="button" role="tab" aria-controls="Tandem" aria-selected="false">Tandem Product Solutions</button>
                  </li> -->
                </ul>
                --}}
                <div class="tab-content" id="myTabContent">
                  @foreach($dealer as $key=>$value) 
                  
                  <div class="tab-pane fade show <?=$key==0 ? 'active' : ''?>" id="{{$value->service}}" role="tabpanel" aria-labelledby="{{$value->service}}-tab">
                  <div class="page-section-bg dealers-wrap scrollbar" id="style-{{$value->id}}">
                           <div class="dealers-section">
                              <!-- dealer item -->
                        {{--@foreach(DB::table('dealers')->where('service', $value->service)->where('is_active', '1')->where('deleted_at', null)->get() as $data)--}}
                        @foreach(DB::table('dealers')->where('is_active', '1')->where('deleted_at', null)->get() as $data)
                         
                              <div class="dealer-item">
                                 <div class="dealer-title">
                                    <div class="wrapper">
                                       <h5><a href="javascript:void(0)">{{$data->name}}</a></h5>
                                     <!--  <div class="rating-area">
                                          <ul class="rating">
                                             <li><i class="fal fa-star"></i></li>
                                             <li><i class="fal fa-star"></i></li>
                                             <li><i class="fal fa-star"></i></li>
                                             <li><i class="fal fa-star"></i></li>
                                             <li><i class="fal fa-star"></i></li>
                                          </ul>
                                          <div class="rating-number">(4.5)</div>
                                          <a href="#" class="review">7 review</a>
                                          <a href="#" class="link-text2">Write a Review</a>
                                          <span>5 min away</span>
                                       </div>-->
                                    </div>
                                 </div>
                                 <div class="dealer-desc">
                                    <div class="contact-item">
                                       <a href="JavaScript:void(0);" class="address-link" data-embedLink="{{$data->embed_link}}"> <div class="contact-title">
                                           
                                             @if($data->address)
                                           <i class="fal fa-map-marker-alt"></i>
                                           @endif
                                           <span class="contact-desc" id="dealer_address">
                                           
                                           @if($data->address)
                                           {{$data->address}} 
                                           @endif
                                           
                                            @if($data->city)
                                           ,{{$data->city}}, 
                                             @endif
                                           @if($data->state)
                                           {{$data->state}} 
                                            @endif
                                           @if($data->zip_code)
                                           ,{{$data->zip_code}}
                                           @endif
                                           </span></div></a>
                                        
                                        @if($data->phone)
                                       <a class="contactDealer" href="tel:{{$data->phone}}"><span class="text-size-small"><i class="fal fa-phone-alt"></i>{{$data->phone}}</span></a>
                                       @endif
                                    </div>
                                    <div class="contact-section">
                                       <div class="contact-item">
                                           @if($data->model_number)
                                          <h6 class="contact-title">Model Number</h6>
                                          <span class="contact-desc">{{$data->model_number}}</span><br>
                                          @endif
                                          @if($data->website)
                                          <h6 class="contact-title">Visit Website</h6>
                                          <span class="contact-desc">
                                              <a class="dealerWebsite" href="{{$data->website}}" target="_blank">{{$data->website}}</a></span>
                                          @endif
                                       </div>
                                       <div class="contact-item">
                                          <h6 class="contact-title">
                                              <a  data-fancybox="images" href="{{asset($data->image)}}" data-type="image">View Model</a>
                                          </h6>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                           </div>
                        </div>
                  </div>
                  @endforeach
                
                </div>

                
             </div>
             
             <? } ?>
             <!-- while you have slug -->
             <? if((($_GET['slug']) != '') and (($_GET['address']) == '') and (($_GET['zip']) == '')){ ?>
             <div class="col-md-7 col-sm-12">
                 <div class="dealer_head">
                     <h3 class="dealer_count">{{count($dealer)}} DEALERS IN YOUR LOCATION </h3>
                 </div>
                 <form action="{{route('locateDealer')}}" method="get" class="search_form">
                    <input type="text" name="address" placeholder="search for address" class="address" value="{{$_GET['address']}}">
                   <input type="text" name="zip" placeholder="search for zip" class="zip" value="{{$_GET['zip']}}">
                   <input type="submit" name="search" id="serach_btn" class="search-bnt-sub">
                 </form>
                
                <div class="tab-content" id="myTabContent">
                  
                 
                  
                  <div class="tab-pane fade show <?=$key==0 ? 'active' : ''?>" id="{{$value->service}}" role="tabpanel" aria-labelledby="{{$value->service}}-tab">
                  <div class="page-section-bg dealers-wrap scrollbar" id="style-{{$value->id}}">
                           <div class="dealers-section">
                              <!-- dealer item -->
                        
                      
                         @foreach($dealer as $key=>$value) 
                              <div class="dealer-item">
                                 <div class="dealer-title">
                                    <div class="wrapper">
                                       <h5><a href="javascript:void(0)">{{$value->name}}</a></h5>
                                    
                                    </div>
                                 </div>
                                 <div class="dealer-desc">
                                    <div class="contact-item">
                                       <a href="JavaScript:void(0);" class="address-link" data-embedLink="{{$value->embed_link}}"> <div class="contact-title">
                                           
                                             @if($value->address)
                                           <i class="fal fa-map-marker-alt"></i>
                                           @endif
                                           <span class="contact-desc" id="dealer_address">
                                           
                                           @if($value->address)
                                           {{$value->address}} 
                                           @endif
                                           
                                            @if($value->city)
                                           ,{{$value->city}}, 
                                             @endif
                                           @if($value->state)
                                           {{$value->state}} 
                                            @endif
                                           @if($value->zip_code)
                                           ,{{$value->zip_code}}
                                           @endif
                                           </span></div></a>
                                        
                                        @if($value->phone)
                                       <a class="contactDealer" href="tel:{{$value->phone}}"><span class="text-size-small"><i class="fal fa-phone-alt"></i>{{$value->phone}}</span></a>
                                       @endif
                                    </div>
                                    <div class="contact-section">
                                       <div class="contact-item">
                                           @if($value->model_number)
                                          <h6 class="contact-title">Model Number</h6>
                                          <span class="contact-desc">{{$value->model_number}}</span><br>
                                          @endif
                                          @if($value->website)
                                          <h6 class="contact-title">Visit Website</h6>
                                          <span class="contact-desc">
                                              <a class="dealerWebsite" href="{{$value->website}}" target="_blank">{{$value->website}}</a></span>
                                          @endif
                                       </div>
                                       <div class="contact-item">
                                          <h6 class="contact-title">
                                              <a  data-fancybox="images" href="{{asset($value->image)}}" data-type="image">View Model</a>
                                          </h6>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                             @endforeach
                           </div>
                        </div>
                  </div>
                 
                
                </div>

                
             </div>
           <? } ?>
           <? if( ((($_GET['address']) != '') || (($_GET['zip']) != '')) and ($_GET['slug'] == '')){ ?>
           <div class="col-md-7 col-sm-12">
                 <div class="dealer_head">
                     <h3 class="dealer_count">{{count($dealer)}} DEALERS IN YOUR LOCATION </h3>
                 </div>
                 <form action="{{route('locateDealer')}}" method="get" class="search_form">
                   <input type="text" name="address" placeholder="search for address" class="address" value="{{$_GET['address']}}">
                   <input type="text" name="zip" placeholder="search for zip" class="zip" value="{{$_GET['zip']}}">
                   <input type="submit" name="search" id="serach_btn" class="search-bnt-sub">
                 </form>
                
                <div class="tab-content" id="myTabContent">
                  
                 
                  
                  <div class="tab-pane fade show <?=$key==0 ? 'active' : ''?>" id="{{$value->service}}" role="tabpanel" aria-labelledby="{{$value->service}}-tab">
                  <div class="page-section-bg dealers-wrap scrollbar" id="style-{{$value->id}}">
                           <div class="dealers-section">
                              <!-- dealer item -->
                        
                      
                         @foreach($dealer as $key=>$value) 
                              <div class="dealer-item">
                                 <div class="dealer-title">
                                    <div class="wrapper">
                                       <h5><a href="javascript:void(0)">{{$value->name}}</a></h5>
                                    
                                    </div>
                                 </div>
                                 <div class="dealer-desc">
                                    <div class="contact-item">
                                       <a href="JavaScript:void(0);" class="address-link" data-embedLink="{{$value->embed_link}}"> <div class="contact-title">
                                           
                                             @if($value->address)
                                           <i class="fal fa-map-marker-alt"></i>
                                           @endif
                                           <span class="contact-desc" id="dealer_address">
                                           
                                           @if($value->address)
                                           {{$value->address}} 
                                           @endif
                                           
                                            @if($value->city)
                                           ,{{$value->city}}, 
                                             @endif
                                           @if($value->state)
                                           {{$value->state}} 
                                            @endif
                                           @if($value->zip_code)
                                           ,{{$value->zip_code}}
                                           @endif
                                           </span></div></a>
                                        
                                        @if($value->phone)
                                       <a class="contactDealer" href="tel:{{$value->phone}}"><span class="text-size-small"><i class="fal fa-phone-alt"></i>{{$value->phone}}</span></a>
                                       @endif
                                    </div>
                                    <div class="contact-section">
                                       <div class="contact-item">
                                           @if($value->model_number)
                                          <h6 class="contact-title">Model Number</h6>
                                          <span class="contact-desc">{{$value->model_number}}</span><br>
                                          @endif
                                          @if($value->website)
                                          <h6 class="contact-title">Visit Website</h6>
                                          <span class="contact-desc">
                                              <a class="dealerWebsite" href="{{$value->website}}" target="_blank">{{$value->website}}</a></span>
                                          @endif
                                       </div>
                                       <div class="contact-item">
                                          <h6 class="contact-title">
                                              <a  data-fancybox="images" href="{{asset($value->image)}}" data-type="image">View Model</a>
                                          </h6>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                             @endforeach
                           </div>
                        </div>
                  </div>
                 
                
                </div>

                
             </div>
           <? } ?>
             <!-- while you have slug -->
             
             <div class="col-md-5 col-sm-12">
                <div class="dealers-map-wrap">
                      <iframe name="myiframe" id="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2969.3285304950005!2d-87.66222328472557!3d41.907295771566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880fcda31b56fcf9%3A0xea2e541f9735f6ef!2sN%20Elston%20Ave%2C%20Chicago%2C%20IL%2060642%2C%20USA!5e0!3m2!1sen!2s!4v1654705771680!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
				
				<div id="map-canvas"></div>
				
             </div>
          </div>
       </div>
    </div>
    
    
    <!--SECTION: REPRESENTATIVE STRT-->
    @include('widgets/representations')
    <!--SECTION: REPRESENTATIVE END-->


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
.dealerWebsite {
    color: black !important;
}
.contactDealer{
    color: #000!important;
}
a.contactDealer {
    color: #000;
}
a.contactDealer span.text-size-small {
    color: #000;
}

.dealer_head{
    margin-bottom: 20px;
}

ul#myTab {
    margin-bottom: 20px;
}

</style>
@endsection

@section('js')

<!-- google_map location -->
<script>

$('#serach_btn').click(function(e){

e.preventDefault();


getLocation();

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition,showError);
    } else { 
      $.toast({
        heading: 'Error!',
        position: 'bottom-right',
        text:  'Geolocation is not supported by this browser.',
        loaderBg: '#ff6849',
        icon: 'error',
        hideAfter: 4000,
        stack: 6
      });

    }
  }

  function showPosition(position) {
	  
	  
	  
    // console.log("Latitude: " + position.coords.latitude);
    // console.log("Longitude: " + position.coords.longitude);

    $('.latitude').val(position.coords.latitude);
    $('.longitude').val(position.coords.longitude);




    // submit form for lat/long
    var url = "{{route('submitLatLong')}}";

    $.ajax({
      type: "POST",
      url: url,
      data:$( "#submitLatLong" ).serialize(),
      dataType: "json", //expect html to be returned                
      success: function (response) {

      }
    });
    // submit form for lat/long
	
	
	$('.search_form').submit();

  }
  
  
  
  
  function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
	  //x.innerHTML = "User denied the request for Geolocation."
      break;
    case error.POSITION_UNAVAILABLE:
      //x.innerHTML = "Location information is unavailable."
	  
      break;
    case error.TIMEOUT:
      //x.innerHTML = "The request to get user location timed out."
	  
      break;
    case error.UNKNOWN_ERROR:
      //x.innerHTML = "An unknown error occurred."
	  
      break;
  }
  
  $('.search_form').submit();
  
}



});


</script>
<!-- google_map location -->





<script type="text/javascript">
    /*
    $('.address-link').click(function(){
        var embedLink = $(this).attr("data-embedLink");
        //alert(embedLink);
          var frameElement = document.getElementById("iframe");
         frameElement.src = embedLink;
       // document.getElementById("iframe").value = embedLink;
    });
    */
    
    $('.dealer-item').click(function(){
		
		$('.dealers-map-wrap').show();
		$('#map-canvas').hide();
	  
        
        // add class active
        $(this).addClass('active');
        $(this).siblings('.dealer-item').removeClass('active');
        
        
        
        
        
    // 	var address = $(this).find('span.contact-desc').text();
    var address = $(this).find('span#dealer_address').text();
    	var embedLink = "https://www.google.com/maps/embed/v1/place?&key=AIzaSyChZaoYMl1KSdFaO0TEHG16EeMOX5rOWDE&q=";
    	embedLink += address.replace(" ", "+");//"q=Space+Needle,Seattle+WA";
    	console.log(embedLink);
    	var frameElement = document.getElementById("iframe");
    	frameElement.src = embedLink;
    });
</script>


<!-- GOOGLE MAP -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.dealers-map-wrap').hide();
    $('#map-canvas').show();
  });
</script>



<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}" type="text/javascript"></script>


<script type="text/javascript">
       var map;
        var geocoder;
        var marker;
        var people = new Array();
        var latlng;
        var infowindow;

        $(document).ready(function() {
            ViewCustInGoogleMap();
        });

        function ViewCustInGoogleMap() {

            var mapOptions = {
                //center: new google.maps.LatLng('{{$lat}}', '{{$long}}'),  
                 center: new google.maps.LatLng(38.23995329338709, -99.48575337412571),  
                zoom: 7,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };


            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

            // Get data from database. It should be like below format or you can alter it.


            <?php
            foreach ($dealers as $key => $value) {
                $locationArray = array();
                $locationArray["DisplayText"] = $value->address.' '.$value->city.' '.$value->state.' '.$value->zip_code;
                $locationArray["ADDRESS"] = $value->address.' '.$value->city.' '.$value->state.' '.$value->zip_code;
                $locationArray["LatitudeLongitude"] = $value->latitude.','.$value->longitude;


                $locationJson = json_encode($locationArray);

            


            
                // print_r($locationArray);
         
            
            ?>
            var data = '[<?php echo json_encode($locationArray); ?>]';


            // var data = '[{ "DisplayText": "adcv", "ADDRESS": "Jamiya Nagar Kovaipudur Coimbatore-641042", "LatitudeLongitude": "10.9435131,76.9383790", "MarkerId": "Customer" },{ "DisplayText": "abcd", "ADDRESS": "Coimbatore-641042", "LatitudeLongitude": "11.0168445,76.9558321", "MarkerId": "Customer"}]';
            // console.log(data);




            people = JSON.parse(data); 
            // console.log(people);
            

            for (var i = 0; i < people.length; i++) {
                setMarker(people[i]);
            }

            <?php
        }
            ?>

            

        }

        function setMarker(people) {
            geocoder = new google.maps.Geocoder();
            infowindow = new google.maps.InfoWindow();
            if ((people["LatitudeLongitude"] == null) || (people["LatitudeLongitude"] == 'null') || (people["LatitudeLongitude"] == '')) {
                geocoder.geocode({ 'address': people["Address"] }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                        marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            draggable: false,
                            html: people["DisplayText"],
                            icon: "images/marker/" + people["MarkerId"] + ".png"
                        });
                        //marker.setPosition(latlng);
                        //map.setCenter(latlng);
                        google.maps.event.addListener(marker, 'click', function(event) {
                            infowindow.setContent(this.html);
                            infowindow.setPosition(event.latLng);
                            infowindow.open(map, this);
                        });
                    }
                    else {
                        alert(people["DisplayText"] + " -- " + people["Address"] + ". This address couldn't be found");
                    }
                });
            }
            else {
                var latlngStr = people["LatitudeLongitude"].split(",");
                var lat = parseFloat(latlngStr[0]);
                var lng = parseFloat(latlngStr[1]);
                latlng = new google.maps.LatLng(lat, lng);
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    draggable: false,               // cant drag it
                    html: people["DisplayText"]    // Content display on marker click
                    //icon: "images/marker.png"       // Give ur own image
                });
                //marker.setPosition(latlng);
                //map.setCenter(latlng);
                google.maps.event.addListener(marker, 'click', function(event) {
                    infowindow.setContent(this.html);
                    infowindow.setPosition(event.latLng);
                    infowindow.open(map, this);
                });
            }
        }
</script>
<!-- GOOGLE MAP -->
@endsection