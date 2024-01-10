
<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<!-- <link rel="stylesheet" href="style.css"> -->
		<!-- <script src="script.js"></script> -->
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">

		<style type="text/css">
			/* reset */

*
{
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

/* content editable */




/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address {  font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block;  }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: 18px;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }


.content{    color: #c61a41;
    line-height: 24px;
    font-size: 18px;
    font-weight: 500;
}
.customp{
	font-family: "Work Sans", sans-serif;
	font-size: 18px;
}
@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }
address.c_details h3 {
    font-size: 20px;
}

address.c_details h3 b {
    font-weight: 700;
    font-family: serif;
    margin-right: 3px;
    
}

img.c_logo {
    height: 35px;
    margin-left: 238px;
    margin-right: 238px;
}

.c_table p strong {
    font-size: 17px;
    font-weight: 700;
}

.c_table td {font-size: 15px;width: 30% !important;text-align: center !important;}

.c_table .customp {
}

.c_table td {text-align: center;border-bottom: 2px solid #ccc !important;border-style: none;border-radius: 0;}
table.inventory td:nth-child(1) {
    width: 30% !important;
}
.c_table td strong {
    font-weight: 700;
}
table.inventory td:nth-child(2) {
    width: 12% !important;
}
table.inventory td:nth-child(3) {
    width: 18% !important;}
    table.c_table thead tr td {
    border: 2px solid #ccc;
        text-align: center !important;
}
.c_table{
border-collapse: collapse;
}
table.c_table .qt {
    width: 33% !important;
}
		</style>



	</head>
	<body>
		<header>
			<h1>Invoice</h1>
			
			<span>
			
			<!--<img alt="" src="{{asset($logo->img_path)}}">-->
			<img class="c_logo" alt="" src="{{asset($footer_logo->img_path)}}">
				
			</span>
			
			<address class="c_details">
			    <strong><h3 style="font-weight: 800;">Billing Details:</h3></strong><br>
				<h3><b>Name</b>:{{$send_email['billing_first_name']}} {{$send_email['billing_last_name']}}</h3>
				<h3><b>Email</b>:{{$send_email['billing_email']}}</h3>
				<h3><b>Phone</b>:{{$send_email['billing_phone_no']}}</h3>
				<h3><b>Address</b>:{{$send_email['billing_address_1']}}, {{$send_email['billing_city']}}, {{$send_email['billing_state']}}, {{$send_email['billing_country']}}, {{$send_email['billing_zip_code']}}</h3>
			</address>
			
			<address class="c_details">
			    <strong><h3 style="font-weight: 800;">Shipping Details:</h3></strong><br>
				<h3><b>Name</b>:{{$send_email['delivery_first_name']}} {{$send_email['delivery_last_name']}}</h3>
				<h3><b>Email</b>:{{$send_email['order_email']}}</h3>
				<h3><b>Phone</b>:{{$send_email['delivery_phone_no']}}</h3>
				<h3><b>Address</b>:{{$send_email['delivery_address_1']}}, {{$send_email['delivery_city']}}, {{$send_email['delivery_state']}}, {{$send_email['delivery_country']}}, {{$send_email['delivery_zip_code']}}</h3>
			</address>
			
			
			
		</header>
		<article>


			<table class="inventory c_table  table-bordered">

				<thead>
				    
				    <tr>
					<td class="c_pro" >
				    	<p class="customp">
				<strong>Product</strong>
					</p>
						
					</td>
						<td>
				    	<p class="customp">
				<strong>Price</strong>
					</p>
						
					</td>
					
				
					
						<td class="qt">
				    	<p class="customp">
				<strong>Quantity</strong>
					</p>
						
					</td>
						<td>
				    	<p class="customp">
				<strong>Sub Total</strong>
					</p>
						
					</td>
					</tr>
				<!--	<tr>
					<td style="border: 0">
				    	<p class="customp">
					Hi {{$send_email['delivery_first_name']}},
					<br>
					<br>
						You successfully Purchased  for <span class="content">"test"</span> package for 
					
					<br>
					<span class="content"> </span>.
					</p>
						
					</td>
					</tr>-->			
                    
				</thead>
				<tbody>
    						
								<?php $subtotal  = 0;?>
    							@foreach($order_products as $order_product)
									<tr>
										<td >{{$order_product->order_products_name}}</td>
									<td >${{number_format($order_product->order_products_price,2)}}</td>
									<td >{{$order_product->order_products_qty}}</td>
									<td >${{number_format($order_product->order_products_subtotal,2)}}</td>
									</tr>
									<?php $subtotal+= $order_product->order_products_qty * $order_product->order_products_price; ?>
								@endforeach
    							<tr>
									
    								<td ></td>
									<td ></td>
    								<td ><strong>Total</strong></td>
    								<td >${{ number_format($subtotal,2) }}</td>
    							</tr>
								
                                 @if($send_email->order_shipping != '')
								<tr>
    								
    								<td ></td>
									<td ></td>
    								<td ><strong>Shipping</strong></td>
    								<td >${{$order->order_shipping}}</td>
    							</tr>
                                @endif
							
								
								
								<tr>
								
    								<td ></td>
									<td ></td>
									<td ><strong>Transaction ID</strong></td>
									<td style="width: 100%!important;">{{$send_email['transaction_id']}}</td>
    							</tr>
								
								<tr>
								
    								<td style="border: 0"></td>
									<td style="border: 0"></td>
									<td style="border: 0"><strong>Payer ID</strong></td>
									<td style="border: 0">{{$send_email['payer_id']}}</td>
    							</tr>
    						</tbody>
				
				
			</table>
			
		
		</article>
	
	</body>
</html>