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
            <img src="https://demo-customlinks.com/modernaire/public/uploads/innerbanners/20220516-1652705071-inner-banner-img.jpg.jpg" class="img-fluid inner-banner-img" alt="...">
            <div class="inr-bnr-txt-mn">
                <div class="container">
                    <div class="row">
                        <div class=" col-md-12 col-lg-6">
                            <div class="inner-banner wow fadeInLeft" data-wow-duration="2s">
                                <h2>Locate A Dealer</h2>
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
             <div class="col-md-7 col-sm-12">
                 <div class="dealer_head">
                     <h3>77 DEALERS IN YOUR LOCATION</h3>
                 </div>
                 
                 <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="dovetail-tab" data-bs-toggle="tab" data-bs-target="#dovetail" type="button" role="tab" aria-controls="dovetail" aria-selected="true">Dovetail Sales</button>
                  </li>
                  <li class="nav-item" role="presentation">
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
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="dovetail" role="tabpanel" aria-labelledby="dovetail-tab">
                      <div class="page-section-bg dealers-wrap scrollbar" id="style-2">
                           <div class="dealers-section">
                              <!-- dealer item -->
        
                              @foreach($dealer as $value)
                              <div class="dealer-item">
                                 <div class="dealer-title">
                                    <div class="wrapper">
                                       <h5><a href="#">{{$value->name}}</a></h5>
                                       <div class="rating-area">
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
                                       </div>
                                    </div>
                                 </div>
                                 <div class="dealer-desc">
                                    <div class="contact-item">
                                       <div class="contact-title"><i class="fal fa-map-marker-alt"></i><span class="contact-desc">{{$value->address}} ,{{$value->city}}, {{$value->state}} ,{{$value->zip_code}}</span></div>
                                       
                                       <span class="text-size-small"><i class="fal fa-phone-alt"></i>{{$value->phone}}</span>
                                    </div>
                                    <div class="contact-section">
                                       <div class="contact-item">
                                          <h6 class="contact-title">Model Number</h6>
                                          <span class="contact-desc">{{$value->model_number}}</span>
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
                  <div class="tab-pane fade" id="krik" role="tabpanel" aria-labelledby="krik-tab">
                      <div class="page-section-bg dealers-wrap scrollbar" id="style-2">
                           <div class="dealers-section">
                              <!-- dealer item -->
        
                              @foreach($dealer as $value)
                              <div class="dealer-item">
                                 <div class="dealer-title">
                                    <div class="wrapper">
                                       <h5><a href="#">{{$value->name}}</a></h5>
                                       <div class="rating-area">
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
                                       </div>
                                    </div>
                                 </div>
                                 <div class="dealer-desc">
                                    <div class="contact-item">
                                       <div class="contact-title"><i class="fal fa-map-marker-alt"></i><span class="contact-desc">{{$value->address}} ,{{$value->city}}, {{$value->state}} ,{{$value->zip_code}}</span></div>
                                       
                                       <span class="text-size-small"><i class="fal fa-phone-alt"></i>{{$value->phone}}</span>
                                    </div>
                                    <div class="contact-section">
                                       <div class="contact-item">
                                          <h6 class="contact-title">Model Number</h6>
                                          <span class="contact-desc">{{$value->model_number}}</span>
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
                  <div class="tab-pane fade" id="lakeview" role="tabpanel" aria-labelledby="lakeview-tab">
                      <div class="page-section-bg dealers-wrap scrollbar" id="style-2">
                           <div class="dealers-section">
                              <!-- dealer item -->
        
                              @foreach($dealer as $value)
                              <div class="dealer-item">
                                 <div class="dealer-title">
                                    <div class="wrapper">
                                       <h5><a href="#">{{$value->name}}</a></h5>
                                       <div class="rating-area">
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
                                       </div>
                                    </div>
                                 </div>
                                 <div class="dealer-desc">
                                    <div class="contact-item">
                                       <div class="contact-title"><i class="fal fa-map-marker-alt"></i><span class="contact-desc">{{$value->address}} ,{{$value->city}}, {{$value->state}} ,{{$value->zip_code}}</span></div>
                                       
                                       <span class="text-size-small"><i class="fal fa-phone-alt"></i>{{$value->phone}}</span>
                                    </div>
                                    <div class="contact-section">
                                       <div class="contact-item">
                                          <h6 class="contact-title">Model Number</h6>
                                          <span class="contact-desc">{{$value->model_number}}</span>
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
                  <div class="tab-pane fade" id="Luxury" role="tabpanel" aria-labelledby="Luxury-tab">
                      <div class="page-section-bg dealers-wrap scrollbar" id="style-2">
                           <div class="dealers-section">
                              <!-- dealer item -->
        
                              @foreach($dealer as $value)
                              <div class="dealer-item">
                                 <div class="dealer-title">
                                    <div class="wrapper">
                                       <h5><a href="#">{{$value->name}}</a></h5>
                                       <div class="rating-area">
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
                                       </div>
                                    </div>
                                 </div>
                                 <div class="dealer-desc">
                                    <div class="contact-item">
                                       <div class="contact-title"><i class="fal fa-map-marker-alt"></i><span class="contact-desc">{{$value->address}} ,{{$value->city}}, {{$value->state}} ,{{$value->zip_code}}</span></div>
                                       
                                       <span class="text-size-small"><i class="fal fa-phone-alt"></i>{{$value->phone}}</span>
                                    </div>
                                    <div class="contact-section">
                                       <div class="contact-item">
                                          <h6 class="contact-title">Model Number</h6>
                                          <span class="contact-desc">{{$value->model_number}}</span>
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
                  <div class="tab-pane fade" id="Tandem" role="tabpanel" aria-labelledby="Tandem-tab">
                      <div class="page-section-bg dealers-wrap scrollbar" id="style-2">
                           <div class="dealers-section">
                              <!-- dealer item -->
        
                              @foreach($dealer as $value)
                              <div class="dealer-item">
                                 <div class="dealer-title">
                                    <div class="wrapper">
                                       <h5><a href="#">{{$value->name}}</a></h5>
                                       <div class="rating-area">
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
                                       </div>
                                    </div>
                                 </div>
                                 <div class="dealer-desc">
                                    <div class="contact-item">
                                       <div class="contact-title"><i class="fal fa-map-marker-alt"></i><span class="contact-desc">{{$value->address}} ,{{$value->city}}, {{$value->state}} ,{{$value->zip_code}}</span></div>
                                       
                                       <span class="text-size-small"><i class="fal fa-phone-alt"></i>{{$value->phone}}</span>
                                    </div>
                                    <div class="contact-section">
                                       <div class="contact-item">
                                          <h6 class="contact-title">Model Number</h6>
                                          <span class="contact-desc">{{$value->model_number}}</span>
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
             <div class="col-md-5 col-sm-12">
                <div class="dealers-map-wrap">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2969.3285304950005!2d-87.66222328472557!3d41.907295771566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880fcda31b56fcf9%3A0xea2e541f9735f6ef!2sN%20Elston%20Ave%2C%20Chicago%2C%20IL%2060642%2C%20USA!5e0!3m2!1sen!2s!4v1654705771680!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
             </div>
          </div>
       </div>
    </div>


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

</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection