<?php
$innerbanner = DB::table('inner_banners')->where('id', 1)->first();

$payment = Session::get('payment');
// dd($payment);
?>

@extends('layouts.main')
@section('content')

<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->


<!-- section inner banner start -->
<section class="inner-banner">  
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{asset('images/inner-banner-img.jpg')}}" class="img-fluid" alt="...">
               <div class="carousel-caption">
                <div class="container">
                  <div class="row">
                    <div class=" col-sm-12 ">
                      <div class="inner-banner wow fadeInLeft" data-wow-duration="2s">
                        <h2> Payment</h2> 
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
            </div>     
          </div>  
      </section>
<!-- section inner banner end -->


<!-- Payment Method -->

<form method="post" action="{{route('paymentComplete')}}" id="paymentComplete">
    @csrf

    <!-- booking ID -->
    <input type="hidden" name="order_id" value="{{$_GET['id']}}">


    <div class="payment">
        <!-- <h2 class="text-center form-title">PAYMENT METHOD</h2> -->
    </div>
    

<div class="container">
    <div class="row">
        <div class="row square_row">

          <div class="col-md-6">
            <div class="summary">
              <div class="cart_sidebar">
                <h3>Your Order</h3>

                @foreach($order_products as $data)
               
                <h5 class="h-sub">
                    {{$data->order_products_name}}<br>
                    <p class="prod_weight"><strong>Weight:</strong> {{$data->product_weight}}</p>
                    <p class="prod_quan"><strong>Quantity:</strong> {{$data->order_products_qty}}</p>
                </h5>
                
                @endforeach
                <!-- <h5 class="h-sub mt-3">Tax <span>${{$order->tax}} </span></h5> -->
                <h5 class="h-sub mt-3">Your Total Amount is <span>${{$order->total_with_tax}} </span></h5>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="square_div">
              <div id="form-container" class="form_square">
                <div id="sq-card-number"></div>
                <div class="third" id="sq-expiration-date"></div>
                <div class="third" id="sq-cvv"></div>
                <div class="third" id="sq-postal-code"></div>
                <button id="sq-creditcard" class="button-credit-card" onclick="onGetCardNonce(event)">Pay</button>
              </div>
              </div>
          </div>

      </div>
    </div>
</div>



<input type="hidden" name="total_amount" id="total_amount" value="{{$order->total_with_tax}}">



<!-- For Square -->
<input type="hidden" name="Amount" id="Amount">
<input type="hidden" name="CVVStatus" id="CVVStatus">
<input type="hidden" name="SquareOrderID" id="OrderID">
<input type="hidden" name="SquareReceiptNumber" id="ReceiptNumber">
<input type="hidden" name="SquareReceiptURL" id="ReceiptURL">
<input type="hidden" name="SquareStatus" id="Status">
<input type="hidden" name="SquareTransactionID" id="TransactionID">




</form>







<!-- ============================================================== -->
<!-- BODY END HERE -->
<!-- ============================================================== -->

@endsection
@section('css')
<link rel="stylesheet" href="{{asset('css/mysqpaymentform.css')}}">

<style>
.payment{
    padding: 40px 10px 41px 10px;
}

.square_row{
    padding-bottom: 70px;   
}

.form_square{
    transform: none!important;
}



/*custom css*/
.form-title {
    margin-bottom: 30px;
    padding-bottom: 15px;
    position: relative;
}

.text-center {
    text-align: center;
}

.summary h2{

    color: black;
    margin-top: 12%;
}

.cart_sidebar {
    padding: 20px 25px;
    border: 2px
    solid #b7b7b7;
    border-radius: 0;
    margin-top: 0%;
    width: 100%;
    
}

.cart_sidebar h3 {
    font-size: 22px;
    font-weight: 700;
    color: #000;
    margin-top: 0px;
    margin-bottom: 20px;
    text-transform: capitalize;
    font-family: 'Roboto', sans-serif;
}

.h-sub{
    line-height: 1!important;
    padding-bottom: 11px!important;
    padding-top: 0px!important;
}

.prod_weight{
    color: #000000;
    font-family: 'Poppins';
    font-size: 15px;
    line-height: 0;
    padding-top: 11px;
}
.prod_quan{
    color: #000000;
    font-family: 'Poppins';
    font-size: 15px;
    line-height: 0;
    padding-top: 3px;
}

</style>
@endsection

@section('js')


<!-- SQUARE UP SECTION -->
<!-- link to the SqPaymentForm library -->
<script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform">
</script>


<!-- TODO: Add script from step 1.1.3 -->

<script type="text/javascript">

    //TODO: paste code from step 2.1.1
    const idempotency_key = uuidv4();


    // Create and initialize a payment form object
    const paymentForm = new SqPaymentForm({
        // Initialize the payment form elements

        //TODO: Replace with your sandbox application ID
        applicationId: "sandbox-sq0idb-OMIEuC-mgV_bO5ijOIPjDA", // Sandbox Application ID
        inputClass: 'sq-input',
        autoBuild: false,
        // Customize the CSS for SqPaymentForm iframe elements
        inputStyles: [{
            fontSize: '16px',
            lineHeight: '24px',
            padding: '16px',
            placeholderColor: '#a0a0a0',
            backgroundColor: 'transparent',
        }],
        // Initialize the credit card placeholders
        cardNumber: {
            elementId: 'sq-card-number',
            placeholder: 'Card Number'
        },
        cvv: {
            elementId: 'sq-cvv',
            placeholder: 'CVV'
        },
        expirationDate: {
            elementId: 'sq-expiration-date',
            placeholder: 'MM/YY'
        },
        postalCode: {
            elementId: 'sq-postal-code',
            placeholder: 'Postal'
        },
        // SqPaymentForm callback functions
        callbacks: {
            /*
            * callback function: cardNonceResponseReceived
            * Triggered when: SqPaymentForm completes a card nonce request
            */
            cardNonceResponseReceived: function (errors, nonce, cardData) {
                if (errors) {
                    // Log errors from nonce generation to the browser developer console.
                    //console.error('Encountered errors:');
                               
                    errors.forEach(function (error) {
                     // console.error('  ' + error.message);
                         $.toast({
                      heading: 'Error!',
                      position: 'bottom-right',
                      text:  error.message,
                      loaderBg: '#ff6849',
                      icon: 'error',
                      hideAfter: 3000,
                      stack: 6
                  });
                    
                     //$('#debugDiv').append('<p>' + error.message + '</p>');

                  });


                    //alert('Encountered errors, check browser developer console for more details');
                  return;
               }


                var data = {nonce: nonce, amount: $('#total_amount').val()};

                jQuery.ajax({
                    method: 'POST',
                    url: 'https://demo-customlinks.com/kingcosper/square_up/payment.php',   // Payment URL
                    data: data,
                    success: function(response) {

                        var res = $.parseJSON(response);
                        // console.log(res.result);

                        var Amount = res.result.Amount;
                        $('#Amount').val(Amount);

                        var CVVStatus = res.result.CVVStatus;
                        $('#CVVStatus').val(CVVStatus);

                        var OrderID = res.result.OrderID;
                        $('#OrderID').val(OrderID);

                        var ReceiptNumber = res.result.ReceiptNumber;
                        $('#ReceiptNumber').val(ReceiptNumber);

                        var ReceiptURL = res.result.ReceiptURL;
                        $('#ReceiptURL').val(ReceiptURL);

                        var Status = res.result.Status;
                        $('#Status').val(Status);

                        var TransactionID = res.result.TransactionID;
                        $('#TransactionID').val(TransactionID);

                 
                        $('#paymentComplete').submit();

                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        //Loader.hide();
                        console.log(textStatus + ": " + jqXHR.status + " " + errorThrown, 'Error');
                        //console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
                    },
                    beforeSend: function()
                    {
                        //Loader.show();
                    }
                });  // JQUERY Native Ajax End


            }
        }
    });
    //TODO: paste code from step 1.1.4

    //TODO: paste code from step 1.1.5
    paymentForm.build();

    //TODO: paste code from step 2.1.2

    //Generate a random UUID as an idempotency key for the payment request
    // length of idempotency_key should be less than 45
    function uuidv4() {
       return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
         var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
         return v.toString(16);
       });
    }

    // onGetCardNonce is triggered when the "Pay $1.00" button is clicked
    function onGetCardNonce(event) {
        // Don't submit the form until SqPaymentForm returns with a nonce
        event.preventDefault();
        // Request a nonce from the SqPaymentForm object
        paymentForm.requestCardNonce();
    }


</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- SQUARE UP SECTION END -->


@endsection