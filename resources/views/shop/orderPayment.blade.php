<?php
$payment = Session::get('payment');
// dd($payment);
$banner = DB::table('inner_banners')->where('id', '9')->first();  


?>

@extends('layouts.main')
@section('content')

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
                                <h2>Payment</h2>
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
    
    
    
<!-- Payment Method -->

<form method="post" action="{{route('paymentComplete')}}" id="order-place">
    @csrf

    <!-- booking ID -->
    <input type="hidden" name="order_id" value="{{$_GET['id']}}">
    

<div class="container">
    <div class="row">
        <div class="row square_row">

          <div class="col-md-6">
            <div class="summary">
              <div class="cart_sidebar contact_form">
                
                  <h2 class="w-100">Your <span>Order</span></h2>


                @foreach($order_products as $data)
               
                <h5 class="h-sub" id="h-sub">
                    {{$data->order_products_name}} <span>x{{$data->order_products_qty}}</span>
                    <p class="prod_price"><strong>${{number_format($data->order_products_subtotal,2)}}</strong></p>
                </h5>
                
                @endforeach

                <h5 class="h-sub mt-3">Total Amount: <span>${{number_format($order->order_item_total,2)}} </span></h5>
              </div>
            </div>
          </div>

          <?php
          $subtotal = $order->order_item_total;
          ?>

          <div class="col-md-6">

            <div class="review_box contact_form">
                
                <h2 class="w-100">Pay With <span>PayPal</span></h2>

                <input type="hidden" name="price" value="{{ $subtotal }}" />
                <input type="hidden" name="id" value="{{$order->id}}" />

                <input type="hidden" name="paypal_orderID" value="" />
                <input type="hidden" name="paypal_payerID" value="" />
                <input type="hidden" name="paypal_paymentID" value="" />
                <input type="hidden" name="paypal_paymentToken" value="" />

                <input type="hidden" name="payment_status" value="" />
                <input type="hidden" name="payment_method" id="payment_method" value="paypal" />
                <div id="paypal-button-container-popup"></div>
            </div>
            
                 
          </div>

      </div>
    </div>
</div>

</form>







<!-- ============================================================== -->
<!-- BODY END HERE -->
<!-- ============================================================== -->

@endsection
@section('css')

<style>

.square_row{

 padding: 105px 10px 100px 10px;
 
}


.h-sub{
    line-height: 1!important;
    padding-bottom: 11px!important;
    padding-top: 0px!important;
    padding-left: 20px;
    padding-right: 20px;
    border-bottom: 1px solid #dbdbdb;
}
.cart_sidebar h5 span {
    float: right;
}
#h-sub{
    font-size: 18px!important;
}
.summary{
    box-shadow: 0px 1px 6px #d2d2d2;
    padding: 33px 30px;
    /*min-height: 341px;*/
    min-height: auto;
}

.cart_sidebar {
    padding: 20px 0px;
    box-shadow: 0px 0px 5px #bebebe;
    border-radius: 3px;
    background: #fff;
}

.cart_sidebar h3 {
    font-weight: bolder;
    font-size: 30px;
    letter-spacing: 1px;
    padding-left: 20px;
    padding-right: 20px;
    color: #00a2e8;
    font-family: 'Oswald', sans-serif;
}

.review_box h3{
    color: #00a2e8;
    font-family: 'Oswald', sans-serif;
}

.prod_price{
    color: #000;
    float: right;
}

.mt-3{
       border-bottom: 1px solid #dbdbdb;
}

.review_box {
    /*box-shadow: 0px 1px 6px #d2d2d2;*/
    padding: 53px 30px;
    /*min-height: 341px;*/
}

#paypal-button-container-popup{
    margin-bottom: 10%;
    margin-top: 5%;
}

#h-sub{
    font-weight: 500;
}

#h-sub span{
    font-weight: 900;
    float: unset;
    margin-left: 1%;
}

h2.w-100 {
    font-size: 42px;
    margin-left: 3%;
}
</style>
@endsection

@section('js')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>   



<script>

  
  paypal.Button.render({
  //env: 'production', //sandbox
 env: 'sandbox', //production
       
  style: {
    label: 'checkout',
    size:  'responsive',  
    shape: 'rect',    
    color: 'gold'      
  },
  client: { 
    // sandbox : 'AfFoE9Jcdf3JPtEvj2H4naH6nMqc0rgUDe4UhN6JHMhQkodTcFsqaHz38AQHdvs4Mys9pQ97vXA_56jr',
sandbox: 'AbgYzEZTgwvQARzYeZ5yYRh3Pn_usQNSJMwoggo5k9ubNl24GWji0EPkoIAVVcqAxnq8Pu-DY3VGml4M',
 // production:'AShRVnDTooVniTa-R1SL7fkJfpG4yMBjDlI8YSmwZbAKD-EMswNJzow-vbeN5dpWy-eYIapL9oT2wWtf',
  },
  payment: function(data, actions) {
    return actions.payment.create({
      payment: {
        transactions: [
          {
            amount: { total: {{number_format(((float)$subtotal),2, '.', '')}}, currency: 'USD' }
          }
        ]
      }
    });
  },
  onAuthorize: function(data, actions) {
    return actions.payment.execute().then(function() {
      // generateNotification('success','Payment Authorized');
      
       $.toast({
                  heading: 'Success!',
                  position: 'bottom-right',
                  text:  'Payment Authorized!',
                  loaderBg: '#ff6849',
                  icon: 'success',
                  hideAfter: 1000,
                  stack: 6
              });
      
      var params = {
        payment_status:'Completed',
        paymentID: data.paymentID,
        payerID: data.payerID
      };
      
      console.log(data);
      // return false;
      $('input[name="payment_status"]').val('Completed');

      $('input[name="paypal_orderID"]').val(data.orderID);
      $('input[name="paypal_payerID"]').val(data.payerID);
      $('input[name="paypal_paymentID"]').val(data.paymentID);
      $('input[name="paypal_paymentToken"]').val(data.paymentToken);

      $('input[name="payment_method"]').val('paypal');
      $('#order-place').submit();
    });
  },
  onCancel: function(data, actions) {
      var params = {
        payment_status:'Failed',
        paymentID: data.paymentID
      };
      $('input[name="payment_status"]').val('Failed');
      $('input[name="payment_id"]').val(data.paymentID);
      $('input[name="payer_id"]').val('');
      $('input[name="payment_method"]').val('paypal');
  }
  }, '#paypal-button-container-popup');
  
  $("#shippingChange").change(function() {
    var ischecked= $(this).is(':checked');
    if(ischecked)
        $("#shippingForm").css('display', 'block');
    else
        $("#shippingForm").css('display', 'none');
}); 
  
 
</script>


@endsection