<?php  
$order = DB::table('orders')->where('id', $_GET['id'])->first();
$products = DB::table('orders_products')->where('orders_id', $_GET['id'])->get();
?>


@extends('layouts.main')
@section('content')

    <!-- banner start -->
    <section class="inner-banner">  
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{asset('images/inner-banner-img.jpg')}}" class="img-fluid" alt="...">
               <div class="carousel-caption">
                <div class="container">
                  <div class="row">
                    <div class=" col-sm-12 ">
                      <div class="inner-banner wow fadeInLeft" data-wow-duration="2s">
                        <h2> <span>Order</span> Complete</h2> 
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
            </div>     
          </div>  
      </section>
      <!-- banner end -->
      
      
      <section class="order-complete all-section">
            <div class="container-fluid all-side-padding">


                <div class="row mt-3">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-10">
                      <div class="thankyou_txt text-center">
                          <h3><i class="fa fa-check" aria-hidden="true"></i> Thank you. Your order has been received.</h3>
                      </div>
                  </div>
                  <div class="col-sm-1"></div>
                </div>


                <div class="row mt-4">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-2">
                      <div class="order_det text-center">
                          <h5>Order number</h5>
                          <p>{{$_GET['id']}}</p>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="order_det text-center">
                          <h5>Status</h5>
                          @if($order->payment_status == '1')
                          <p>Paid</p>
                          @else
                          <p>Not Paid</p>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="order_det text-center">
                          <h5>Date</h5>
                          <p>{{date_format(date_create($order->created_at),"F d, Y")}}</p>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="order_det text-center">
                          <h5>Total</h5>
                          <p>${{number_format($order->order_item_total, 2)}}</p>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="order_det text-center">
                          <h5>Payment Method</h5>
                          @if($order->payment_method == 'bank_transfer')
                          <p>Direct Bank Transfer</p>
                          @elseif($order->payment_method == 'cheque_payment')
                          <p>Cheque Payment</p>
                          @elseif($order->payment_method == 'cash_on_delivery')
                          <p>Cash On Delivery</p>
                          @elseif($order->payment_method == 'PayPal')
                          <p>PayPal</p>
                          @elseif($order->payment_method == 'square_up')
                          <p>Square Up</p>
                          @endif
                          
                      </div>
                  </div>
                  <div class="col-sm-1"></div>
                </div>


                <div class="row mt-4">
                    <div class="col-sm-12">
                        <div class="order_complete_detail">
                            <h3>Order Details</h3>
                            <div class="order_detail_table mt-3">
                                <h5>Product</h5>
                                <ul>
                                    @foreach($products as $data)
                                    <?php
                                    $prod = DB::table('products')->where('id', $data->order_products_product_id)->first();
                                    ?>
                                    <li>{{$prod->product_title}} x {{$data->order_products_qty}}<span>${{$data->order_products_qty * $prod->price}}</span></li>
                                    @endforeach
                                    <li>Subtotal <span>${{number_format($order->order_item_total, 2)}}</span></li>
                                </ul>
                                <h6>Shipping <span>Free</span></h6>

                                <!--<h6>Tax <span>{{$order->tax}}%</span></h6>-->

                                <h6>Total <span>${{number_format($order->order_item_total, 2)}}</span></h6>

                                <!--<h6>Total (including tax)<span>${{number_format($order->total_with_tax, 2)}}</span></h6>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

  
@endsection
@section('css')

@endsection
@section('js')

@endsection