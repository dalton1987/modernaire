<?php
// META TAGS
$pageTitle = 'CHECKOUT';
$pagedescription = '';
$pagetags = '';

$banner = DB::table('inner_banners')->where('id', '9')->first();  



?>



@extends('layouts.main')
@section('content')


    <!-- META TAGS -->
@section('pageTitle',$pageTitle)
@section('pagedescription',$pagedescription)
@section('Keywords',$pagetags)




      
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




      
      <!-- check out sec -->
      <form action="{{route('order.place')}}" method="POST" class="order-place">
      @csrf

      <input type="hidden" name="create" id="create">

        <section class="checkout_page cart_page all-section all-side about_inner_sec">
          <div class="container  ">
           
            <div class="row mt-5">
              <div class="col-sm-8">
                <div class="billing_form contact_form">

                  <h2 class="w-100">Billing <span>Details</span></h2>
    
                    <!-- billing details -->
                    <div class="row">
                      <div class="col-sm-6" id="checkout_field">
                        <label>First Name*</label>
                        <span class="invalid-feedback fname" >
                        <strong>{{ $errors->first('first_name') }}</strong></span>
                          <input class="form-control" id="f-name" name="first_name" value="{{Auth::user()?Auth::user()->name:''}}" placeholder="First Name *" type="text" >
                      </div>
                      
                      <div class="col-sm-6" id="checkout_field">
                        <label>Last Name*</label>
                        <span class="invalid-feedback fname" >
                        <strong>{{ $errors->first('last_name') }}</strong></span>
                          <input class="form-control" id="l-name" name="last_name" value="{{Auth::user()?Auth::user()->last_name:''}}" placeholder="Last Name *" type="text" >
                      </div>

                      <div class="col-sm-12" id="checkout_field">
                        <label>Country / Region *</label>
                        <span class="invalid-feedback" >
                        <strong>{{ $errors->first('country') }}</strong></span>
                        <select name="country" id="country" class="form-control left" placeholder="Select Country">
                          <option selected="" disabled="">Select Country</option>
                        @if(isset($countries) and count($countries) > 0)
                          @foreach($countries as $country)
                          <option @if(Auth::user()->profile->country == $country->name) selected @endif value="{{  $country->name }}" data-countryId="{{ $country->id }}">{{ $country->name }}</option>
                          @endforeach
                        @endif
                      </select>
                      </div>
                      <div class="col-sm-12" id="checkout_field">
                        <label class="street_address">Street Address*</label>
                        <span class="invalid-feedback" >
                        <strong>{{ $errors->first('address') }}</strong></span>
                          <input class="form-control" id="address" name="address" placeholder="Address" type="text" value="{{Auth::user()->profile->address}}">
                        <input class="input_suite" type="text" name="suite" placeholder="Apartment, Suite, unit etc" value="{{Auth::user()->profile->suite}}">
                      </div>

                      <div class="col-sm-6" id="checkout_field">
                        <label>Town / City *</label>
                        <span class="invalid-feedback" >
                         <strong>{{ $errors->first('city') }}</strong></span>
                          <input class="form-control right" placeholder="Town / City" name="city" id="city" type="text" value="{{Auth::user()->profile->city}}">
                      </div>
                      <div class="col-sm-6" id="checkout_field">
                        <label>State*</label>
                        <span class="invalid-feedback" >
                         <strong>{{ $errors->first('state') }}</strong></span>
                          <input class="form-control right" placeholder="State" name="state" id="state" type="text" value="{{Auth::user()->profile->state}}">
                      </div>
    
                      <div class="col-sm-6" id="checkout_field">
                        <label>Zip Code</label>
                        <input class="form-control" id="compnayName" name="zip_code" placeholder="Zip Code" type="text" value="{{Auth::user()->profile->postal}}">
                      </div>
    
                      <div class="col-sm-6" id="checkout_field">
                        <label>Phone*</label>
                        <span class="invalid-feedback" >
                        <strong>{{ $errors->first('phone') }}</strong></span>
                          <input class="form-control right" placeholder="Phone" name="phone" type="number" min="1" value="{{Auth::user()->profile->phone}}">
                      </div>
                      <div class="col-sm-12" id="checkout_field">
                        <label>Email Address*</label>
                        <span class="invalid-feedback" >
                        <strong>{{ $errors->first('email') }}</strong></span>
                          <input id="email"  class="form-control left" name="email" placeholder="Email" type="email" value="{{Auth::user()?Auth::user()->email:''}}">
                      </div>


                      <div class="col-sm-12" id="checkout_field">
                        <label>Order Notes</label>
                        <textarea class="form-control" id="comment" name="order_notes" placeholder="Order Notes" rows="5" style="height: auto;"></textarea>
                        
                      </div>

                    </div>
                    <!-- billing details -->


                    <!-- shipping details -->
                    <br>

                  <h2 class="w-100">Shipping <span>Details</span></h2>

                    <div class="row">
                      <div class="col-md-12">
                        <input type="checkbox" id="sameAsBilling">
                        <label class="form-check-label" id="labelCheck">Same as Billing Details</label>
                      </div>
                    </div>


                    <input type="hidden" name="shippingAddress" id="shippingAddress">


                    <div class="shipAddress">
                      <div class="row">
                        <div class="col-sm-6" id="checkout_field">
                          <label>First Name*</label>
                            <input class="form-control"  name="ship_first_name" id="ship_first_name" placeholder="First Name" type="text">
                        </div>

                        <div class="col-sm-6" id="checkout_field">
                          <label>Last Name*</label>
                            <input class="form-control"  name="ship_last_name" id="ship_last_name" placeholder="Last Name" type="text">
                        </div>

                        <div class="col-sm-12" id="checkout_field">
                          <label>Country / Region*</label>
                          <select name="ship_country" id="ship_country" class="form-control left" placeholder="Select Country">
                            <option selected="" disabled="">Select Country</option>
                          @if(isset($countries) and count($countries) > 0)
                            @foreach($countries as $country)
                            <option value="{{  $country->name }}" data-countryId="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                          @endif
                        </select>
                        </div>
                        <div class="col-sm-12" id="checkout_field">
                          <label class="street_address">Street Address*</label>
                            <input class="form-control" name="ship_address" id="ship_address" placeholder="Address" type="text">
                          <input class="input_suite" type="text" name="ship_suite" id="ship_suite" placeholder="Apartment, Suite, unit etc">
                        </div>

                        <div class="col-sm-6" id="checkout_field">
                          <label>Town / City*</label>
                            <input class="form-control right" placeholder="Town / City" name="ship_city" id="ship_city" type="text">
                        </div>
                        <div class="col-sm-6" id="checkout_field">
                          <label>State*</label>
                            <input class="form-control right" placeholder="State" name="ship_state" id="ship_state" type="text">
                        </div>
      
                        <div class="col-sm-6" id="checkout_field">
                          <label>Zip Code</label>
                          <input class="form-control" id="compnayName" name="ship_zip_code" placeholder="Zip Code" type="text">
                        </div>
      
                        <div class="col-sm-6" id="checkout_field">
                          <label>Phone*</label>
                            <input class="form-control right" placeholder="Phone" name="ship_phone" id="ship_phone" type="number" min="1">
                        </div>
                        <div class="col-sm-12" id="checkout_field">
                          <label>Email Address*</label>
                            <input  class="form-control left" name="ship_email" id="ship_email" placeholder="Email Address" type="email">
                        </div>

                      </div>
                    </div>
                    <!-- shipping details -->


                    @if(!Auth::check())

                  <!--<div class="row">
                      <div class="col-md-12">
                        <input value="1" style="width: min-content;" type="checkbox" name="create_account" id="create_account">
                        <label class="form-check-label" id="labelCheck">Create an account?</label>
                      </div>
                    </div>-->

                  <input type="hidden" name="create_account" class="create_account">
                  @endif

                  <div class="guest">
                    <div class="row">
                      <div class="col-sm-6">
                        <label>Password</label>
                        <span class="invalid-feedback" >
                        <strong>{{ $errors->first('password') }}</strong></span>
                        <input type="password" class="form-control left" name="password" placeholder="Password">
                      </div>

                      <div class="col-sm-6">
                        <label>Retype Password</label>
                        <span class="invalid-feedback" >
                        <strong>{{ $errors->first('confirm_password') }}</strong></span>
                        <input type="password" class="form-control right" name="confirm_password" placeholder="Confirm Password">
                      </div>
                    </div>
                  </div>

                  
                </div>
              </div>
    
    
              <div class=" col-sm-4">
                <div class="cart_sidebar">
                  
                  <h2 class="w-100">Your <span>Order</span></h2>


                  <?php $subtotal  = 0; $addon_total = 0; ?>

                  <h5 class="h-sub">Product</h5>
                  <ul class="cart_lst">
                    @foreach($cart as $key=>$value)
                     <input type="hidden" name="sizes" value="{{$value['sizes']}}">
                    <li>{{ $value['name'] }} <b>x{{ $value['qty'] }}</b> <span>${{ number_format($value['baseprice'] * $value['qty'], 2) }}</span></li>
                     <?php $subtotal+= $value['baseprice'] * $value['qty']; ?> 
                     @endforeach
                    <!-- <li>Palm Print Jacket x1 <span>$40.00</span></li> -->
                    <!-- <li>Palm Print Jacket x1 <span>$60.00</span></li> -->
                    <li class="total_show">Subtotal <span>${{ number_format($subtotal,2) }}</span></li>
                    <li class="total_show">Shipping <span>Free</span></li>
                 

                  </ul>
    
    
                  <!-- <h4>Shipping</h4> -->
    
                  <!-- <ul class="shipping-ul">
                    <li>
                      <input type="checkbox" name="free" id="free">
                      <label for="free">Free Shipping</label>
                    </li>
                    <li>
                      <input type="checkbox" name="local" id="local">
                      <label for="local">Local Pickup</label>
                    </li>
                    <li>
                      <input type="checkbox" name="flat" id="flat">
                      <label for="flat">Flat rate: $5.00</label>
                    </li>
                  </ul> -->
                  <h5 class="h-sub mt-3">Total <span class="total_amt">${{ number_format($subtotal,2) }}</span></h5>
 
    
                  <h6 class="payment-h">Payment Method</h6>
    
                  <ul class="radiosss radiosss-payments">
                    <!-- <li>
                      <input required="" type="radio" name="payment_type" class="payment_type" value="bank_transfer" id="direct">
                      <label for="direct">Direct Bank Transfer</label>
                      
                    </li> -->
                    <!-- <li></li> -->
                    <!-- <li>
                      <input required="" type="radio" name="payment_type" class="payment_type" value="cheque_payment" id="cp">
                      <label for="cp">Cheque Payment</label> 
                    </li> -->
                    <!-- <li></li> -->
                    <!-- <li>
                      <input required="" type="radio" name="payment_type" class="payment_type" value="cash_on_delivery" id="cod">
                      <label for="cod">Cash On Delivery</label>
                    </li> -->
                    <li></li>
                    <!-- <li>
                      <input required="" type="radio" name="payment_type" class="payment_type" value="square_up" id="square_up">
                      <label for="square_up">Square Up</label> 
                    </li> -->
                    <li>
                      <input checked="" required="" type="radio" name="payment_type" class="payment_type" value="paypal" id="paypal">
                      <label for="paypal">PayPal</label> 
                    </li>
                    <li></li>
                  </ul>
    
                  
                  <a href="javascript:void(0)" id="placeOrderButton" class="checkout_btn theme_btn">Place Order</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </form>

  
@endsection
@section('css')

<link href="{{asset('css/checkout.css')}}" rel="stylesheet">

<style type="text/css">
  .form-group input.form-control {
    border-width: 1px;
    border-color: rgb(215, 215, 215);
    border-style: solid;
    border-radius: 6px;
  background-color: #fff;
    height: 45px;
}
form.loginForm {
    padding: 20px;
}

.body-space {
    padding: 60px 0;
}

span.invalid-feedback.fname {
    float: left;
    width: 100%;
    color: red;
}

span.invalid-feedback.lname {
    float: left;
    width: auto;
    color: red;
    margin-top: -22px;
}

.form-group label {
    color: #000;
    
}
#checkout_field label{
    font-size: 16px;
}

.form-control {
  height: 45px;
}

.checkoutPage h4 {
    font-size: 39px;
    color: #000000;
    text-transform: uppercase;
}


/*.error{
  color: red!important;
}*/

label.error {
    color: red!important;
    margin-bottom: 22px!important;
}

#sameAsBilling, #create_account{
  width: 2%;
  height: 12px;
}

#labelCheck{
  font-size: 15px;
}


.total_show {
    font-size: 18px!important;
    font-weight: 600!important;
    color: #000000!important;
}


h6.payment-h {
    margin-bottom: 0px!important;
    font-family: inherit;
    font-size: 18px;
    line-height: 23px;
    color: #393939;
    font-weight: 800;
    margin: 0 0 22px;
}



.cart_sidebar, .billing_form {
    padding: 40px 25px;
    border: 2px solid #b7b7b7;
    border-radius: 0;
}

.checkout_page {
    margin-top: 0px;
    margin-bottom: 120px;
}

.all-section {
    padding-top: 30px;
}


h2.w-100 {
    font-size: 35px;
    margin-bottom: 16px;
    color: #000000;
}

.contact_form select {
    width: 100%;
    height: 51px;
    border: none;
    background: #f2f2f2;

    margin-bottom: 25px;
    padding: 16px;
    font-size: 14px;
}

.contact_form input, .contact_form textarea {
    margin-bottom: 25px;
}


.cart_sidebar .cart_lst li span {
    float: right;
}

.cart_sidebar .cart_lst li:not(:last-child) {
    margin-bottom: 15px;
}


.cart_sidebar .h-sub {
    font-weight: 600;
    color: #000;
    font-size: 18px;
    padding-bottom: 15px;
    border-bottom: 1px solid #dbdbdb;
    margin-bottom: 20px;
}

.total_amt {
    float: right;
}

a#placeOrderButton {
    width: 100%;
    text-align: center;
}


</style>
@endsection
@section('js')
<!-- 
<script>
    $('#placeOrderButton').hide();
</script> -->

<script src="https://www.paypalobjects.com/api/checkout.js"></script> 


<script type="text/javascript">
  // <!-- shipping address -->
  $('#sameAsBilling').change(function(){

    if(this.checked){
        $('.shipAddress').hide();
        $('#shippingAddress').val('1');
    }
    else{
        $('.shipAddress').show();
        $('#shippingAddress').val('0');
    }
        
  });
</script>


<script>
$('.guest').hide();

$('#create_account').click(function(){

  if($("#create_account").is(":checked")){
    $('.guest').show();
    $('#create').val('1');    
  }
  else{
    $('.guest').hide();
    $('#create').val('0');
  }

});
</script>

<!-- submit form -->
<!-- <script type="text/javascript">
  $('#placeOrderButton').click(function(){

    if($(".payment_type").is(":checked")){
      $('.order-place').submit();
    }
    else{
      $.toast({
        heading: 'Error!',
        position: 'bottom-right',
        text:  'Please select a payment method first.',
        loaderBg: '#ff6849',
        icon: 'error',
        hideAfter: 4000,
        stack: 6
      });
    }
    
  });
</script> -->


<!-- check email -->
@if(Auth::guest())
<!--<script type="text/javascript">
  $('#email').change(function(){


// get user id through data attribute
var email = $(this).val();


// define the route of edit method
var url = '{{route('checkEmail', value)}}';
url = url.replace('value', email);

// response returned from edit method
$.get(url, function (data) {


  if(data == '1'){
    alert('Account already exists with the entered email address. Click Login/Register if you wish to log in before proceeding your order.');
 
  }



})

  });
</script>-->
@endif

<!-- validation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>


<script>
  
  
$('#placeOrderButton').click(function(){
    if($("#sameAsBilling").is(":checked")){
    $('.order-place').validate({ // initialize the plugin
      ignore:'',
            rules: {
      first_name:{ required: true},
      last_name:{ required: true},
      country:{ required: true},
      address:{ required: true},
      suite:{ required: true},
      city:{ required: true},
      state:{ required: true},
      phone:{ required: true},
      email:{ required: true},
      payment_type:{required: true}
      }
    });
    
    $("#ship_first_name").rules("remove", "required");
    $("#ship_last_name").rules("remove", "required");
    $("#ship_country").rules("remove", "required");
    $("#ship_address").rules("remove", "required");
    $("#ship_suite").rules("remove", "required");
    $("#ship_city").rules("remove", "required");
    $("#ship_state").rules("remove", "required");
    $("#ship_phone").rules("remove", "required");
    $("#ship_email").rules("remove", "required")
    
  }
  else{
    $('.order-place').validate({ // initialize the plugin
      ignore:'',
            rules: {
      first_name:{ required: true},
      last_name:{ required: true},
      country:{ required: true},
      address:{ required: true},
      suite:{ required: true},
      city:{ required: true},
      state:{ required: true},
      phone:{ required: true},
      email:{ required: true},
      payment_type:{required: true},
      
      ship_first_name:{ required: true},
      ship_last_name:{ required: true},
      ship_country:{ required: true},
      ship_address:{ required: true},
      ship_suite:{ required: true},
      ship_city:{ required: true},
      ship_state:{ required: true},
      ship_phone:{ required: true},
      ship_email:{ required: true},
      }
    });
  } 
  
  $('.order-place').submit();
});

    
</script>
@endsection