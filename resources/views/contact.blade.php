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

    <!--<section class="contact-sec   wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">-->
    <!--    <div class="container">-->
    <!--        <div class="row  ">-->
    <!--            <div class="col-md-7 centerCol">-->
    <!--                <div class="sec_head text-center ">-->
    <!--                    <h3>-->
    <!--                        <?= html_entity_decode($cms10->title) ?>-->
    <!--                    </h3>-->
    <!--                    <p><?= html_entity_decode($cms10->content) ?></p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--        <div class="row">-->
    <!--            <div class="container">-->
    <!--                <div class="col-md-10 centerCol">-->
    <!--                    <form id="inquiryFormContact" method="post" action="javascript:void(0)">-->
    <!--                    @csrf-->

    <!--                    <input type="hidden" name="page" value="contact">-->

    <!--                    @if(Auth::user())-->
    <!--                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">-->
    <!--                    @endif-->

    <!--                        <div class="row">-->
    <!--                            <div class="col-lg-6">-->
    <!--                                <input required="" name="first_name" type="text" placeholder="First Name">-->
    <!--                            </div>-->

    <!--                            <div class="col-lg-6">-->
    <!--                                <input required="" name="last_name" type="text" placeholder="Last Name">-->
    <!--                            </div>-->
    <!--                        </div>-->

    <!--                        <div class="row">-->
    <!--                            <div class="col-lg-12">-->
    <!--                                <input required="" name="email" type="email" placeholder="Email">-->
    <!--                            </div>-->
    <!--                        </div>-->

    <!--                        <div class="row">-->
    <!--                            <div class="col-lg-12">-->
    <!--                                <textarea required="" name="message" placeholder="Comment"></textarea>-->
    <!--                            </div>-->
    <!--                        </div>-->

    <!--                        <div class="row">-->
    <!--                            <div class="col-lg-12">-->
    <!--                                <div class="text-center">-->
    <!--                                    <button type="submit" class="cntnt-bnt-sub">SUBMIT</button>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </form>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    
    
    <!--SECTION: CONTACT STRT-->
      <section class="contact-page">
        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-5">
              <div class="get-in-touch">
                <h2><?= html_entity_decode($cms10->title) ?></h2>
                <p><?= html_entity_decode($cms10->content) ?></p>
                <div class="contact-socail">
                  <div class="row">
                    <div class="col-4 col-md-3 col-lg-3">
                      <i class="far fa-clock"></i>
                    </div>
                    <div class="col-8 col-md-7 col-lg-7">
                      <h6>Office Hours:</h6>
                      <a href="javascript:void(0)">{{ App\Http\Traits\HelperTrait::returnFlag(900) }}</a>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-4 col-md-3 col-lg-3">
                      <i class="fa fa-phone"></i>
                    </div>
                    <div class="col-8 col-md-7 col-lg-7">
                      <h6>Phone :</h6>
                      <a href="tel:{{ App\Http\Traits\HelperTrait::returnFlag(100) }}"> {{ App\Http\Traits\HelperTrait::returnFlag(100) }}</a>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-4 col-md-3 col-lg-3">
                      <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="col-8 col-md-7 col-lg-7">
                      <h6>Address :</h6>
                      <a href="javascript:void(0)">{{ App\Http\Traits\HelperTrait::returnFlag(800) }}</a>
                    </div>
                  </div>
                    <br>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-7">
              <div class="requet-quote">
                  
                <form id="inquiryFormContact" method="post" action="javascript:void(0)">
                @csrf
                
                <h2>Contact Us</h2>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <input type="text" placeholder="Name" name="name">
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <input type="email" placeholder="Email" name="email">
                    </div>
                    
                    
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <select class="form-select" name="country" id="country">
                            <option selected="" disabled="">Country</option>
                            @foreach($country as $key=>$value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
        
            
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <select disabled id="state" name="state" class="form-select">
                            <option  selected disabled>State</option>
                            
                                @foreach($states as $data)
                                <option value="{{$data->name}}">{{$data->name}}</option>
                                @endforeach
                              <!--<option value="AK">Alaska</option>-->
                              <!--<option value="AZ">Arizona</option>-->
                              <!--<option value="AR">Arkansas</option>-->
                              <!--<option value="CA">California</option>-->
                              <!--<option value="CO">Colorado</option>-->
                              <!--<option value="CT">Connecticut</option>-->
                              <!--<option value="DE">Delaware</option>-->
                              <!--<option value="FL">Florida</option>-->
                              <!--<option value="GA">Georgia</option>-->
                              <!--<option value="HI">Hawaii</option>-->
                              <!--<option value="ID">Idaho</option>-->
                              <!--<option value="IL">Illinois</option>-->
                              <!--<option value="IN">Indiana</option>-->
                              <!--<option value="IA">Iowa</option>-->
                              <!--<option value="KS">Kansas</option>-->
                              <!--<option value="KY">Kentucky</option>-->
                              <!--<option value="LA">Louisiana</option>-->
                              <!--<option value="ME">Maine</option>-->
                              <!--<option value="MD">Maryland</option>-->
                              <!--<option value="MA">Massachusetts</option>-->
                              <!--<option value="MI">Michigan</option>-->
                              <!--<option value="MN">Minnesota</option>-->
                              <!--<option value="MS">Mississippi</option>-->
                              <!--<option value="MO">Missouri</option>-->
                              <!--<option value="MT">Montana</option>-->
                              <!--<option value="NE">Nebraska</option>-->
                              <!--<option value="NV">Nevada</option>-->
                              <!--<option value="NH">New Hampshire</option>-->
                              <!--<option value="NJ">New Jersey</option>-->
                              <!--<option value="NM">New Mexico</option>-->
                              <!--<option value="NY">New York</option>-->
                              <!--<option value="NC">North Carolina</option>-->
                              <!--<option value="ND">North Dakota</option>-->
                              <!--<option value="OH">Ohio</option>-->
                              <!--<option value="OK">Oklahoma</option>-->
                              <!--<option value="OR">Oregon</option>-->
                              <!--<option value="PA">Pennsylvania</option>-->
                              <!--<option value="RI">Rhode Island</option>-->
                              <!--<option value="SC">South Carolina</option>-->
                              <!--<option value="SD">South Dakota</option>-->
                              <!--<option value="TN">Tennessee</option>-->
                              <!--<option value="TX">Texas</option>-->
                              <!--<option value="UT">Utah</option>-->
                              <!--<option value="VT">Vermont</option>-->
                              <!--<option value="VA">Virginia</option>-->
                              <!--<option value="WA">Washington</option>-->
                              <!--<option value="WV">West Virginia</option>-->
                              <!--<option value="WI">Wisconsin</option>-->
                              <!--<option value="WY">Wyoming</option>-->
                            </select>
                    </div>
                    
                    
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="text" placeholder="City" name="city">
                    </div>
                    
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        
                        <select name="services" class="form-select">
                            <option selected disabled>Select Service</option>
                            <option value="Customer Service">Customer Service</option>
                            <option value="Technical Information">Technical Information</option>
                            <option value="Installation">Installation</option>
                        </select>

                    </div>
                    
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <!--<input type="text" placeholder="Message" name="message">-->
                        <textarea placeholder="Message" name="message"></textarea>
                    </div>
                    
                    {{--<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="technical_information" checked>
                          <label class="form-check-label" for="technical_information">
                            Technical Information
                          </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="installation" checked>
                          <label class="form-check-label" for="installation">
                            Installation
                          </label>
                        </div>
                    </div>--}}
                </div>
                  
                  
                  
                  
                    <div class="text-start">
                        <button type="submit" class="cntnt-bnt-sub">SUBMIT</button>
                    </div>
                    
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--SECTION: CONTACT END-->
      
      
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
.requet-quote textarea {
    width: 100%;
    border: 1px solid #ccccce;
    padding: 15px 20px;
    border-radius: 10px;
    margin-top: 17px;
}

.requet-quote{
    height: 100%;
}

.get-in-touch{
    height: 100%;
}
</style>
@endsection

@section('js')
<!-- country state -->
<script type="text/javascript">
  $("#country").change(function(){
      
      $('.state_div').show();

        var selectedCountry = $("#country option:selected").val();
        var url = "{{route('getStates', country)}}";
        url = url.replace('country', selectedCountry);

        $('#state').html("");

        var option=$('<option />');option.attr('value','').text('Please Wait');$('#state').append(option);
    $.ajax({
        type: "GET",
         crossDomain: true,
         contentType: "application/json",
        url: url,
     
    }).done(function(data){
        
        $('#state').removeAttr('disabled');

        $('#state').find("option:eq(0)").html("Select State");
        $.each(data,function(key,val){
            var option=$('<option />');
            option.attr('value',val).text(val);
            $('#state').append(option);
        });
        
    });
    
});

</script>
<!-- country state -->
@endsection