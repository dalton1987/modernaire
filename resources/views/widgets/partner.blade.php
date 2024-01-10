<?php 

$segment = Request::segments();
$partners = DB::table('partners')->where('deleted_at', null)->where('is_active', '1')->get();
?>


{{--
@if(isset($segment[0]))
    @if($segment[0] == 'home')
    <section class=" company-log-sc wow slideInLeft">
        <div class="container">
            <div class="row partnerSlider">

                @foreach($partners as $data)
                <div class="col-lg-3 col-md-6">
                    <div class="compny-logo">
                        <a 
                        @if($data->url != '')
                        href="{{$data->url}}" target="_blank"
                        @else
                        href="javascript:void(0)"
                        @endif

                        ><img src="{{asset($data->image)}}" alt="images"></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @elseif($segment[0] == 'about')
    <div class="row mt-8 partnerSlider">
        @foreach($partners as $data)
        <div class="col-lg-3 col-md-6">
            <div class="compny-logo">
                <a 
                @if($data->url != '')
                href="{{$data->url}}" target="_blank"
                @else
                href="javascript:void(0)"
                @endif

                ><img src="{{asset($data->image)}}" alt="images"></a>
            </div>
        </div>
        @endforeach
  
    </div>
    @else
    <section class=" company-log-sc">
        <div class="container">
            <div class="row partnerSlider">
                @foreach($partners as $data)
                <div class="col-lg-3 col-md-6">
                    <div class="compny-logo">
                        <a 
                        @if($data->url != '')
                        href="{{$data->url}}" target="_blank"
                        @else
                        href="javascript:void(0)"
                        @endif

                        ><img src="{{asset($data->image)}}" alt="images"></a>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>
    </section>

    @endif

@else
<section class=" company-log-sc wow slideInLeft">
    <div class="container">
        <div class="row partnerSlider">
            @foreach($partners as $data)
            <div class="col-lg-3 col-md-6">
                <div class="compny-logo">
                    <a 
                    @if($data->url != '')
                    href="{{$data->url}}" target="_blank"
                    @else
                    href="javascript:void(0)"
                    @endif

                    ><img src="{{asset($data->image)}}" alt="images"></a>
                </div>
            </div>
            @endforeach
           
        </div>
    </div>
</section>
@endif
--}}

<style type="text/css">
.slick-current {
    opacity: 1;
}

.slick-active {
    opacity: 1;
}

</style>