<section class="represntative_sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 centerCol">
                    <div class="sec_head text-center">
                        <h3>{{$cms14->title}}</h3>
                        <p><?= html_entity_decode($cms14->content) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                
                @foreach($representatives as $rep_data)
                <?php
                $representative = json_decode($rep_data->representative);
                
                $rep = explode(',', $rep_data->representative_location); 
                ?>
                        
                        
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="represntative_box">
                        <h3>
                            @foreach($rep as $key=>$val)
                            <?php
                            $location = DB::table('representative_locations')->where('id', $val)->first()->Name;
                            ?>
                            {{ $location }} @if(count($rep) > 1 && $key+1 < count($rep)) , @endif
                            @endforeach
                            
                        </h3>
                        <h5 class="company_title position-relative">
                            <i class="fal fa-building"></i> {{$rep_data->name}}
                            
                            @if($rep_data->image != '')
                            <img src="{{asset($rep_data->image)}}" alt="images" class="position-absolute">
                            @endif
                        </h5>
                        
                        
                        @foreach($representative as $data)
                        <p>
                            @if($data->name != '')
                            <span class="rep_name">{{$data->name}}:</span> 
                            @endif
                            
                            @if($data->phone != '')
                            <span><a href="tel:{{$data->phone}}"><i class="fal fa-phone-alt"></i>  {{$data->phone}}</a></span>
                            @endif
                            
                            @if($data->email != '')
                            <span><a href="mailto:{{$data->email}}"> <i class="fal fa-envelope"></i> {{$data->email}}</a></span>
                            @endif
                            
                        </p>
                        @endforeach
                        <!--<p>-->
                        <!--    <span class="rep_name">David Roos:</span> -->
                        <!--    <span><a href="mailto:droos@dovetail-sales.com"> <i class="fal fa-envelope"></i> droos@dovetail-sales.com</a></span>-->
                        <!--</p>-->
                        <!--<p>-->
                        <!--    <span class="rep_name">Jason Artus:</span> -->
                        <!--    <span><a href="mailto:jartus@dovetail-sales.com">  <i class="fal fa-envelope"></i>  jartus@dovetail-sales.com</a></span>-->
                        <!--</p>-->
                        
                        <!--<a href="https://opportunitieswith@dovetail-sales.com/" target="_blank" class="rep_web_link"><i class="fal fa-globe"></i> opportunitieswith@dovetail-sales.com (General Info)</a> <br>-->
                        
                        @if($rep_data->website != '')
                        <a href="{{$rep_data->website}}" target="_blank" class="rep_web_link"><i class="fal fa-globe"></i> {{$rep_data->website}}</a>
                        @endif
                        <div class="row">
                         <a href="{{route('locateDealer',['slug'=>$rep_data->slug])}}" target="_blank" class="nav-link  active  rep_web_link view_dealer-btn">View Dealer</a>
                        </div>
                         
                    </div>
                </div>
                @endforeach
                
                
              {{--
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="represntative_box">
                        <h3>Northwest US</h3>
                        <h5 class="company_title"><i class="fal fa-building"></i> Tandem Product Solutions</h5>
                        <p>
                            <span class="rep_name">David LaFollette:</span> 
                            <span><a href="tel:7077710356"><i class="fal fa-phone-alt"></i> 707-771-0356</a></span>
                            <span><a href="mailto:david@tandemps.com">| <i class="fal fa-envelope"></i> david@tandemps.com</a></span>
                        </p>
                        <p>
                            <span class="rep_name">Robbyn Nicola:</span> 
                            <span><a href="tel:5303888332"><i class="fal fa-phone-alt"></i> 530-388-8332</a></span>
                            <span><a href="mailto:robbyn@tandemps.com">| <i class="fal fa-envelope"></i> robbyn@tandemps.com</a></span>
                        </p>
                        <a href="https://www.tandemproductsolutions.com/" target="_blank" class="rep_web_link"><i class="fal fa-globe"></i> www.tandemproductsolutions.com</a>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="represntative_box">
                        <h3>Midwest US</h3>
                        <h5 class="company_title"><i class="fal fa-building"></i> Lakeview Distributes</h5>
                        <p>
                            <span class="rep_name">General Inquiries:</span> 
                            <span><a href="tel:6302381280"><i class="fal fa-phone-alt"></i>  630-238-1280</a></span>
                        </p>
                        <p>
                            <span class="rep_name">Andy Hellmich:</span> 
                            <span><a href="tel:7085672301"><i class="fal fa-phone-alt"></i>  708-567-2301</a></span>
                        </p>
                        <p>
                            <span class="rep_name">Jim Taylor: <sub>(Product Info / Quotes)</sub></span> 
                            <span><a href="tel:630-787-4482"><i class="fal fa-phone-alt"></i> 630-787-4482</a></span>
                            <span><a href="mailto:jim.taylor@lvdistributes.com">| <i class="fal fa-envelope"></i> jim.taylor@lvdistributes.com</a></span>
                        </p>
                        
                        <div class="d-flex">
                            <p class="me-4">
                                <span class="rep_name">Parts</span> 
                                <span><a href="tel: 630-787-4498"><i class="fal fa-phone-alt"></i> 630-787-4498</a></span>
                            </p>
                            
                             <p>
                                <span class="rep_name">Services</span> 
                                <span><a href="tel:630-787-4496"><i class="fal fa-phone-alt"></i> 630-787-4496</a></span>
                            </p>
                        </div>
                        
                        <a href="https://lvdistributes.com/" target="_blank" class="rep_web_link"><i class="fal fa-globe"></i> lvdistributes.com</a>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="represntative_box">
                        <h3>Northeast US</h3>
                        <h5 class="company_title position-relative">
                            <i class="fal fa-building"></i> Dovetail Sales
                            <img src="https://demo-customlinks.com/modernaire/public/images/Dovetail-Sales-Logo.png" alt="images" class="position-absolute">
                        </h5>
                        <p>
                            <span class="rep_name">Sales:</span> 
                            <span><a href="tel:7176699386"><i class="fal fa-phone-alt"></i>  717-669-9386</a></span>
                            <span><a href="mailto:droos@dovetail-sales.com"> <i class="fal fa-envelope"></i> droos@dovetail-sales.com</a></span>
                        </p>
                        <p>
                            <span class="rep_name">David Roos:</span> 
                            <span><a href="mailto:droos@dovetail-sales.com"> <i class="fal fa-envelope"></i> droos@dovetail-sales.com</a></span>
                        </p>
                        <p>
                            <span class="rep_name">Jason Artus:</span> 
                            <span><a href="mailto:jartus@dovetail-sales.com">  <i class="fal fa-envelope"></i>  jartus@dovetail-sales.com</a></span>
                        </p>
                        
                        <a href="https://opportunitieswith@dovetail-sales.com/" target="_blank" class="rep_web_link"><i class="fal fa-globe"></i> opportunitieswith@dovetail-sales.com (General Info)</a> <br>
                        <a href="https://www.dovetail-sales.com/" target="_blank" class="rep_web_link"><i class="fal fa-globe"></i> www.dovetail-sales.com</a>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="represntative_box">
                        <h3>Southwest US</h3>
                        <h5 class="company_title"><i class="fal fa-building"></i> Luxury Backyard International</h5>
                        <p>
                            <span class="rep_name">Tarin Yankovich:</span> 
                            <span><a href="tel:8558558030"><i class="fal fa-phone-alt"></i>  855-855-8030 x626</a></span>
                            <span><a href="mailto:tarin@lbina.com">| <i class="fal fa-envelope"></i>  tarin@lbina.com</a></span>
                        </p>
                    </div>
                </div>
                
                
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="represntative_box">
                        <h3>Southeast US</h3>
                        <!--<h5 class="company_title"><i class="fal fa-building"></i> Kirk McCleary:</h5>-->
                        <p>
                            <span class="rep_name">Kirk McCleary:</span> 
                            <span><a href="tel:9543099539"><i class="fal fa-phone-alt"></i>  9543099539</a></span>
                            <span><a href="mailto:tarin@lbina.com">| <i class="fal fa-envelope"></i>  tarin@lbina.com</a></span>
                        </p>
                    </div>
                </div>
                --}}
                
            </div>
        </div>
    </section>
    
@section('css')
<style>
        
a.view_dealer-btn {
    font-size: 14px !important;
    text-decoration: none !important;
    color: black !important;
    background: #f7bb1c !important;
    font-weight: 600 !important;
    width: 40% !important;
    text-align: center !important;
    margin-top: 30px !important;
    margin-left: 20px !important;
}
</style>
@endsection