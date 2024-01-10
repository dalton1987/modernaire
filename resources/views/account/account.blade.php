@extends('layouts.main')
@section('content')

<?php $segment = Request::segments(); ?>

<!-- banner_sec -->
<section class="inner-banner">  
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{asset('images/inner-banner-img.jpg')}}" class="img-fluid" alt="...">
       <div class="carousel-caption">
        <div class="container">
          <div class="row">
            <div class=" col-sm-12 ">
              <div class="inner-banner wow fadeInLeft" data-wow-duration="2s">
                <h2><span>Account</span> </h2> 
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>     
  </div>  
</section>
<!-- banner_sec -->

<main class="my-cart">
    <!-- banner start -->
    <!-- banner end -->

<!-- main content start -->

 <!-- my account wrapper start -->
    <div class="my-account-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            @include('account/accountSidebar')
                            <!-- My Account Tab Menu End -->
    
                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                   
                                   <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade active" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Account Details</h3>

                                        <div class="account-details-form">
                                           <form action="{{ route('update.account') }}" method="post" enctype="multipart/form-data" id="accountForm">
                                            @csrf
                                            
                                            
                                            
                                            
                                            
                                            @if(Auth::user()->user_type != '2')
                                                <div class="row">
                                                
                                                    <div class="col-lg-12">
                                                        <div class="single-input-item">
                                                            <label for="last-name" class="required">First Name</label>
                                                            <input type="text" id="last-name" name="name" placeholder="First Name" value="<?php echo Auth::user()->name; ?>">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                
                                                    <div class="col-lg-12">
                                                        <div class="single-input-item">
                                                            <label for="last-name" class="required">Last Name</label>
                                                            <input type="text" id="last-name" name="last_name" placeholder="Last Name" value="<?php echo Auth::user()->last_name; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="single-input-item">
                                                    <label for="email" class="required">Email Address</label>
                                                    <input type="email" id="email" placeholder="Email Address" name="email" value="<?php echo Auth::user()->email; ?>">
                                                </div>
                                                
                                                
                                                
                                                <!--other details-->
                                                <div class="single-input-item">
                                                    <label for="email">Phone</label>
                                                    <input class="form-control right" placeholder="Phone" name="phone" id="phone" type="text" value="{{Auth::user()->profile->phone}}">
                                                </div>
                                                
                                                
                                                <div class="single-input-item">
                                                    <label for="email">Country</label>
                                                     
                                                    <select name="country" id="country" class="form-control left" placeholder="Select Country">
                                                        <option selected="" disabled="">Select Country</option>
                                                        <?php $countries = DB::table('countries')->get(); ?>
                                                        @if(isset($countries) and count($countries) > 0)
                                                            @foreach($countries as $country)
                                                            <option @if(Auth::user()->profile->country == $country->name) selected @endif value="{{  $country->name }}" data-countryId="{{ $country->id }}">{{ $country->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                
                                                <div class="single-input-item">
                                                    <label for="email">Street Address</label>
                                                    <input class="form-control" id="address" name="address" placeholder="Address" type="text" value="{{Auth::user()->profile->address}}">
                                                </div>
                                                
                                                <div class="single-input-item">
                                                    <label for="email">Suite</label>
                                                    <input class="input_suite" type="text" name="suite" placeholder="Apartment, Suite, unit etc" value="{{Auth::user()->profile->suite}}">
                                                </div>
                                                
                                                <div class="single-input-item">
                                                    <label for="email">City</label>
                                                    <input class="form-control right" placeholder="Town / City" name="city" id="city" type="text" value="{{Auth::user()->profile->city}}">
                                                </div>
                                                
                                                <div class="single-input-item">
                                                    <label for="email">State</label>
                                                    <input class="form-control right" placeholder="State" name="state" id="state" type="text" value="{{Auth::user()->profile->state}}">
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="email">Zip Code</label>
                                                    <input class="form-control right" placeholder="Zip Code" name="postal" id="postal" type="text" value="{{Auth::user()->profile->postal}}">
                                                </div>
                                                
                                            @elseif(Auth::user()->user_type == '2')
                                            <div class="single-input-item">
                                                    <label for="email" class="required">Email Address</label>
                                                    <input type="email" id="email" placeholder="Email Address" name="email" value="<?php echo Auth::user()->email; ?>">
                                                </div>
                                            @endif
                                                <!--other details-->
                                                
                                                
                                                

                                                <div class="single-input-item" id="single-input-item">
                                                    <div class="find_button">
                                                        <button class="product-details-btn" id="form1">Save Changes</button>
                                                    </div>
                                                    
                                                </div>
                                                </form>

                                                <hr>
                                                
                                                <form action="{{ route('accountPasswordUpdate') }}" method="post" enctype="multipart/form-data" id="accountForm2">
                                                @csrf
                                                <fieldset>
                                                    <legend id="pwd_change">Reset Password</legend>

                                                    <div class="row">

                                                        <!-- current password -->
                                                        <div class="col-lg-12">
                                                            <div class="single-input-item">
                                                                <label for="new-pwd" class="required">Current Password</label>
                                                                <input class="" required="" type="password" id="new-pwd" placeholder="Enter Current Password" name="current_pass">
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="new-pwd" class="required">New Password</label>
                                                                <input class="@error('password') is-danger @enderror" required="" type="password" id="new-pwd" placeholder="New Password" name="password">
                                                                @error('password')
                                                                <p class="help is-danger" style="color: red;">{{ $errors->first('password') }}</p>
                                                                <?php 
                                                                Session::flash('flash_message', $errors->first('password'));
                                                                Session::flash('alert-class', 'alert-success'); 
                                                                ?>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="confirm-pwd" class="required">Confirm Password</label>
                                                                <input class="@error('password_confirmation') is-danger @enderror" required="" type="password" id="confirm-pwd" placeholder="Confirm Password" name="password_confirmation">
                                                                @error('password_confirmation')
                                                                <p class="help is-danger" style="color: red;">{{ $errors->first('password_confirmation') }}</p>
                                                                <?php 
                                                                Session::flash('flash_message', $errors->first('password_confirmation'));
                                                                Session::flash('alert-class', 'alert-success'); 
                                                                ?>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <div class="single-input-item" id="single-input-item">
                                                    <div class="find_button">
                                                        <button class="product-details-btn" id="form2">Save Changes</button>
                                                    </div>
                                                    
                                                    <!-- <a href="javascript:void(0)" class="save_changes" id="form2">Save Changes</a> -->
                                                </div>
                                                </form>
                                            
                                        </div>
                                    </div>
</div> <!-- Single Tab Content End -->
    
                                    
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->


<!-- main content end -->   
</main>
@endsection
@section('css')

<link href="{{asset('css/checkout.css')}}" rel="stylesheet" >

<style type="text/css">
.product-details-btn{
    font-size: 15px!important;
    width: 26%;
    height: 50px;
    text-align: center;
    position: relative;
    transition: all 0.3s ease-in-out 0s;
    z-index: 10;
    display: inline-block;
    color: rgb(255, 255, 255);
    padding: 14px;
    font-size: 17px;
    font-family: Poppins;
    font-weight: 400;
    border: unset!important; 
    overflow: hidden !important;
    background: #f7bb1c!important;
    }

.product-details-btn:hover{
    background-color: #000!important;
}
</style>
@endsection
@section('js')

<script type="text/javascript">

 $(document).on('click', "#updateProfile", function(e){
        $('#accountForm').submit();
  });

</script>

@endsection