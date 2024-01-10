@extends('layouts.main')

@section('content')


    <!-- META TAGS -->
<?php
// META TAGS
$pageTitle = 'CART';
$pagedescription = '';
$pagetags = '';
?>

@section('pageTitle',$pageTitle)
@section('pagedescription',$pagedescription)
@section('Keywords',$pagetags)



<?php


$banner = DB::table('inner_banners')->where('id', '8')->first();  



?>

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


    <!-- cart sec start -->
    <form method="post" action="{{ route('update_cart') }}" id="update-cart">
  	{{ csrf_field() }}  

  	<?php $subtotal  = 0; ?>  

  	<section class="cart_page ">
      <div class="container-fluid side-padding"> 
        
        <div class="row mt-5">
          <div class="col-md-8 col-sm-12">
            <div class="cart_table_main">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Parts</th>
                      <th>Item Price</th>
                      <th>Quantity</th>
                      <th>Subtotal</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>

                    @foreach($cart as $key=>$value)

                    <!-- <input type="hidden" name="weight_price" value="{{$value['baseprice']}}"> -->

                    <input type="hidden" name="type[]" id="type" value="{{$value['type']}}">

                    <?php 
                        if($key == 'shipping') {
                            continue;
                        }

                        $prod_image = App\Product::where('id',$value['id'])->first();
                        
                        
                        $att = explode(',' , $value['custom_attribute']);
                        
                      
                      
                    ?>

                    <tr>
                      <td>
                        <div class="image_cart_prod">
                          <div class="cart-img">
                            <img id="cartProductImage" src="{{ asset($prod_image->image) }}">

                          </div>
                          <div class="cart-product-name">
                            <p>{{ $value['name'] }}</p>
                            
                            
                            @if($value['custom_attribute'] != '')
                                <br>
                                <h4 class="attributes">Attributes:</h4>
                                <ul class="attributes_list">
                                @foreach($att as $attribute)
                                <?php $attribute_name = DB::table('attributes')->where('id', $attribute)->first()->attribute; ?>
                          
                                <li>{{$attribute_name}}</li>
                                @endforeach
                                </ul>
                            @endif
                          </div>
                        </div>
                      </td>
                      <td>${{ $value['baseprice'] }}</td>
                      <td>
                        <div class="num-block skin-2">
 
                            <ul class="quan">
                              <li>

                                <span class="input-number-decrement">–</span>
                                <input id="quan_input" readonly="" name="qty[]" class="input-number" type="number" value="{{ $value['qty'] }}" min="1" max="10">
                                <span class="input-number-increment">+</span>
                              </li>
                            </ul>


                          <!-- </div> -->
                        </div>
                      </td>

                      

                      <td>${{ number_format($value['baseprice'] * $value['qty'] , 2) }}</td>

                      <td>
                        <a id="update_remove" href="javascript:void(0)" class="updateCart remove"><span>✓</span></a>
                        <a id="update_remove" href="javascript:void(0)" onclick="window.location.href='{{ route('remove_cart',[$value['id']]) }}'" class="remove"><span>x</span></a>
                       </td>

                    </tr>

                    <input type="hidden" name="product_id[]" id="" value="<?php echo $value['id']; ?>">
                    <?php $subtotal+= $value['baseprice'] * $value['qty']; ?>  

                    @endforeach


    
                  </tbody>
                </table>
              </div>
            </div>


            <div class="cont_shopping_btns mt-4">
              <div class="row">
                <div class="col-sm-6">
                  <div class="continue_btn">
                    <span class="cartButton"><a href="{{route('parts')}}" class="btn btn_black" id="btn_black">Continue Shopping</a></span>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="clear_carT_list">
                    <ul>
                      <li>
                      	<span class="cartButton">
                      		<a href="{{route('clearCart')}}" class="btn btn_black" id="clearCart btn_black">Clear Cart</a>
                      	</span>
                      </li>
                      <!-- <li><a href="">Update Cart</a></li> -->
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-4 col-sm-6">
            <div class="cart_sidebar">
              <h3>Cart Total</h3>
              <!--<h5 class="h-sub">Subtotal <span class="price_price">${{number_format($subtotal,2) }}</span></h5>-->


              <input type="hidden" id="cartTotal" value="{{$subtotal }}">
              <input type="hidden" id="is_shipping" value="0">

              <!--<h5 class="h-sub">Shipping <span class="price_price">Free</span></h5>-->


              <h5 class="h-sub mt-3">Total <span class="cartTotal">${{number_format($subtotal,2) }}</span></h5>
              
              
              
                <span class="cartButton1">
                	<a class="checkout_btn btn btn_black" href="javascript:void(0)" id="proceedToCheckout">Proceed To Checkout</a>
                </span>
                
            </div>
          </div>
        </div>
      </div>
    </section>

	    {{--<!-- <section class="cart_page all-section mg-top">
	      <div class="container all-side-padding"> 
	        <div class="row">
	          <div class="col-sm-12">
	            <div class="check_menu">
	              
	            </div>
	          </div>
	        </div>
	        <div class="row mt-5">
	          <div class="col-md-12 col-sm-12">
	            <div class="cart_table_main">
	              <div class="table-responsive">
	                <table class="table" >
	                  <thead>
	                    <tr>
	                      <th>Product</th>
	                      <th>Quantity</th>
	                      <th>Price</th>
	                      <th>Sub Total</th>
	                    </tr>
	                  </thead>

	                  <tbody>

	                  	@foreach($cart as $key=>$value)

	                  	<?php 
	                  	$prod_image = App\Product::where('id',$value['id'])->first();
	                  	?>


	                  	<tr>
	                  		<td>
	                  			<div class="image_cart_prod">
	                  				<div class="cart-img">
	                            		<img id="cartProductImage" src="{{ asset($prod_image->image) }}">
	                            
	                          		</div>
		                          	<div class="cart-product-name">
		                            	<p>{{ $value['name'] }}</p>
		                          	</div>
		                        </div>
	                        </td>

	                      	<td>
	                      		<div class="num-block skin-2">
	                      			
	                          		<ul class="quan">
                              			<li>

                                			<span class="input-number-decrement">–</span><input id="quan_input" readonly="" name="qty[]" class="input-number" type="text" value="{{ $value['qty'] }}" min="1" max="10"><span class="input-number-increment">+</span>
                              			</li>
                            		</ul>
	                        	</div>
	                        </td>
	                      
	                     
	                      <td>${{ $value['baseprice'] }}</td>
	                      <td>${{ $value['baseprice'] * $value['qty'] }}</td>

	                      <td>
	                      	<a id="update_remove" href="javascript:void(0)" class="updateCart remove"><span>✓</span></a>
                        	<a id="update_remove" href="javascript:void(0)" onclick="window.location.href='{{ route('remove_cart',[$value['id']]) }}'" class="remove"><span>x</span></a>
                       	  </td>
	                    
	                    </tr>


	                    <input type="hidden" name="product_id[]" id="" value="<?php echo $value['id']; ?>">
                    	<?php $subtotal+= $value['baseprice'] * $value['qty']; ?>


	                    @endforeach
	                    
	                  </tbody>
	                </table>
	              </div>
	            </div>
	          </div>
	        </div>
	        <div class="row">
	          <div class="col-lg-6"></div>
	          <div class="col-lg-6 col-sm-12">
	            <div class="cart-bottom">
	              <div class="delivery-wrap">
	              <h6>Delivery costs</h6>
	              <span>This applies to standard delivery to  Europe.</span>
	              </div>
	              <div class="num-wrap">
	                <h4>4.00$</h4>
	              </div>
	            </div>
	          </div>
	        </div>
	          <div class="row">
	          <div class="col-md-6"></div>
	          <div class="col-lg-6 col-sm-12">
	            <div class="line-cart">
	            <div class="cart-bottom">
	              <div class="delivery-wrap">
	              <h5>Total *Including VAT</h5>
	              </div>
	              <div class="num-wrap-1">
	                <h4>27.00$</h4>
	              </div>
	              </div>
	            </div>
	            <div class="done-btn">
	            <a href="check-out.html">Send</a>
	          </div>
	          </div>
	          
	        </div>        
	      </div>
	    </section> -->--}}
	</form>
    <!-- cart sec end -->

    <form method="post" action="{{ route('checkout') }}" class="proceedToCheckoutForm">
	@csrf
	  <!-- <input type="hidden" name="shipping_amount" id="shipping_amount"> -->
	  <!-- <input type="hidden" name="shipping_id" id="shipping_id"> -->
	</form>



 

@endsection

@section('css')

<style type="text/css">
.price_price{
	float: right;
}
.cartTotal{
	float: right;
}

a.checkout_css {
    color: #fff;
    height: 41px;
    padding-top: 8px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-transform: uppercase;
    background: #bd2323;
    font-family: 'Oswald', sans-serif;
}

#cartProductImage{
  height: 125px;
width: 95px;
object-position: center;
object-fit: contain;
}



/*custom*/
.cart_sidebar .form {
    margin-top: 30px;
    padding-bottom: 40px;
    border-bottom: 1px solid #b7b7b7;
}

.cart_sidebar .form button:hover {
    background-color: transparent;
    transition: 0.3s ease-in-out;
}


.cart_sidebar .form button {
    color: #000;
    font-size: 15px;
    border-radius: 0px;
    font-family: 'Poppins', sans-serif;
    padding: 10px 40px;
    border: 2px solid #ebebeb;
}


/*quantity*/
.quan{
  margin-top: unset!important;
  justify-content: unset!important;
}



#update_remove{
    margin-bottom: 50%;
    background: #fff;
    width: 25px;
    height: 25px;
    font-weight: 600;
    color: #000;
    border-radius: 30px;
    box-shadow: 0 0 20px #00000021;
    display: flex;
    align-items: center;
    justify-content: center;
}



.cart_sidebar ul li span {
    position: relative;
    cursor: pointer;
    font-size: 16px;
    font-family: 'Poppins';
    font-weight: 400;
    color: #b7b7b7;
}

.cart_sidebar ul li input {
    padding: 0;
    height: initial;
    width: initial;
    margin-bottom: 0;
     display: inline; 
    cursor: pointer;
}

a.remove{
  font-size: 17px;
  padding: 5px 12px;
}

.cart_page {
    padding-top: 38px;
}

.table {
    --bs-table-bg: transparent;
    --bs-table-striped-color: #212529;
    --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
    --bs-table-active-color: #212529;
    --bs-table-active-bg: rgba(0, 0, 0, 0.1);
    --bs-table-hover-color: #212529;
    --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    vertical-align: top;
    border-color: #dee2e6;
}

.side-padding {
    padding-left: 95px;
    padding-right: 95px;
}

.cart_page {
    padding-bottom: 80px;
}


#quan_input{
	width: 58px!important;
    margin-right: -5px;
    margin-left: -5px;
}


.cart_table_main tbody td .image_cart_prod .cart-product-name p {
    font-size: 16px;
    color: #000;
    font-weight: 500;
    font-family: 'Poppins';
    margin: 0;
}

.cart_table_main tbody td .image_cart_prod .cart-img {
    margin-right: 30px;
    position: relative;
}

.cart_table_main tbody td .image_cart_prod {
    display: flex;
    align-items: center;
}

.cart_table_main tbody td {
    color: #878787;
    font-size: 16px;
    font-weight: 400;
}
.cart_table_main tbody td {
    vertical-align: middle !important;
    height: 170px;
}

.quan {
    display: flex;
    align-items: center;
}

.quan li:first-child {
    margin-right: 5px;
}
.quan li {
    display: inline-block;
    color: #000;
    font-weight: 600;
}

.input-number-decrement {
    border-right: none;
    border-radius: 4px 0 0 4px;
}

.input-number-decrement, .input-number-increment {
    display: inline-block;
    width: 30px;
    line-height: 38px;
    background: #fff;
    color: #444;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
}
.input-number, .input-number-decrement, .input-number-increment {
    border: 1px solid #ccc;
    height: 40px;
    user-select: none;
}

.input-number {
    width: 80px;
    padding: 0 12px;
    vertical-align: top;
    text-align: center;
    outline: none;
}

.input-number-increment {
    border-radius: 0 4px 4px 0;
}

.clear_carT_list{
  float: right;
}

.cartButton {
    width: 30%;
    position: relative;
}

.cartButton a{
	position: relative!important;
    width: 185px!important;
    font-size: 14px!important;
    color: #fff!important;
    background: #fc0!important;
    border: 0px!important;
    padding: 12px 0px!important;
}

  .cartButton a:hover {
    color: #000!important;
    transition: 0.8s ease-in-out!important;
}


.cartButton1 a{
	position: relative!important;
    width: 100%!important;
    font-size: 14px!important;
    color: #fff!important;
    background: #fc0!important;
    border: 0px!important;
    padding: 12px 0px!important;
}

  .cartButton1 a:hover {
    color: #000!important;
    transition: 0.8s ease-in-out!important;
}



.sub_image{
    margin-left: 220px;
    height: 540px;
}


.attributes{
    font-size: 16px;
    color: #000;
    font-weight: 500;
    font-family: 'Poppins';
    margin: 0;
    text-transform: uppercase;
    line-height: 20px;
    
}

.attributes_list{
        list-style-type: disc;
        padding-left: 28px;
}

</style>

@endsection

@section('js')

<script type="text/javascript">

  
 $(document).on('click', ".updateCart", function(e){

   // $('#type').val($(this).attr('data-attr'));
   $('#update-cart').submit();
    
 });
 
 $(document).on('keydown keyup', ".qtystyle", function(e) {
  if ( $(this).val() <= 1 ) {
    e.preventDefault();
    $(this).val( 1 ); 
  }

});


</script>

<script>

  function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }

  $(document).on('click', ".addCoupon", function(e){
    $('#addCoupon').submit(); 
  });  
  
  
  $('input.qtystyle').on('input',function(e){

    
    if( parseInt($(this).val()) >   parseInt($(this).attr('data-attr-stock')) ) {
      $(this).val(parseInt($(this).attr('data-attr-stock')));
      generateNotification('danger','please select only available '+parseInt($(this).attr('data-attr-stock'))+' items in stock');
    }
    
  });

</script>

<script>
function myFunction() {
  alert("Please Calculate Shipping First!");
}
</script>



<!-- quantity increment/decrement -->
<script type="text/javascript">

  // increment
  $('.input-number-increment').click(function(){
    var value = $(this).siblings('.input-number').val();
    value = parseInt(value) + 1;
    $(this).siblings('.input-number').val(value);
  });

  // descrement
  $('.input-number-decrement').click(function(){
    var value = $(this).siblings('.input-number').val();
    value = parseInt(value) - 1;
    $(this).siblings('.input-number').val(value);
  });
  


  // quantity on change
  $('.input-number-decrement').click(function(){
    var quantity = $('.input-number').val();
    if(quantity <= 0){
      $('.input-number').val('1');
    }

    console.log(quantity);
  });

  $('.input-number-increment').click(function(){
    var quantity = $('.input-number').val();
    if(quantity <= 0){
      $('.input-number').val('1');
    }
  });
</script>



<!-- shipping calculate -->
<script type="text/javascript">
  $('.updateTotal').click(function(){

if($('.radioButton').is(':checked')){
    var shipping_id = $('input[name=shipping]:checked').data('shipping_id');
    var shipping_fee = $('input[name=shipping]:checked').data('shipping_fee');
    var subtotal = $('#cartTotal').val();

    var total = parseFloat(subtotal) + parseFloat(shipping_fee);
    $('.cartTotal').text(total);
    $('#is_shipping').val('1');

    $('#shipping_amount').val(shipping_fee);
    $('#shipping_id').val(shipping_id);

    $.toast({
        heading: 'Success!',
        position: 'bottom-right',
        text:  'Total amount updated!',
        loaderBg: '#ff6849',
        icon: 'success',
        hideAfter: 3000,
        stack: 6
    });
}
else{
  $.toast({
      heading: 'Error!',
      position: 'bottom-right',
      text:  'Please select shipping type first!',
      loaderBg: '#ff6849',
      icon: 'error',
      hideAfter: 3000,
      stack: 6
  });
}
    
  });
</script>



<!-- proceedToCheckout -->
<script type="text/javascript">
  $('#proceedToCheckout').click(function(){

    $('.proceedToCheckoutForm').submit();

  });
</script>
@endsection

