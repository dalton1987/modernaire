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
                                    <div class="tab-pane fade show active" id="orders" role="#">
                                        <div class="myaccount-content">
                                            <h3>Orders</h3>
    
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <!-- <th>#</th> -->
                                                            <th>Order Number</th>
                                                            <th>Date</th>
                                                            <th>Order Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
    
                                                    <tbody>
                                                    
                                                    @if($ORDERS)

                                                        <?php $counter=0; ?>
                                                        @foreach($ORDERS as $key=>$ORDER)
                                                            <tr>
                                                              <!-- <td>{{ $key+1 }}</td> -->
                                                             
                                                              <td>{{ $ORDER->id }}</td>
                                                              <td>{{date_format(date_create($ORDER->created_at),"F d, Y") }}</td>
                                                              <td>${{ number_format($ORDER->order_item_total, 2)  }}</td>
                                                              <td class="viewbtn"><a href="{{ route('invoice',[$ORDER->id]) }}">View</a></td>
                                                              
                                                            </tr>
                                                        <?php $counter++; ?>
                                                        @endforeach
                                                    @endif
                    
                                                    </tbody>
                                                </table>


                                                <div class="row">
                                                    <div class="col-md-4"></div>

                                                    <div class="col-md-4">
                                                        <div class="testi-pagination">
                                                            <nav aria-label="Page navigation example">
                                                                <ul class="pagination">
                                                                    {!! $ORDERS->appends(['search' => Request::get('search')])->render() !!}
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4"></div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->
    
                                    
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
</main
>

@endsection
@section('css')
<link href="{{asset('css/checkout.css')}}" rel="stylesheet" >

<style type="text/css">
    
</style>
@endsection
@section('js')
<script type="text/javascript">
     $(document).on('click', ".btn1", function(e){
            // alert('it works');
            $('.loginForm').submit();
     });
</script>
@endsection