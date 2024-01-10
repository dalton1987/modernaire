@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Product #{{ $product->id }}</h3>
                  
                        <a class="btn btn-success pull-right" href="{{ url('admin/product') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
               
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $product->id }}</td>
                            </tr>


                            <?php
                            $category = DB::table('categories')->where('slug', $product->category)->first()->category;
                            ?>

                            <tr><th> Category </th><td> {{ $category }} </td></tr>

                            <tr><th> Product Title </th><td> {{ $product->product_title }} </td></tr>

                            <tr><th> Slug </th><td> {{ $product->slug }} </td></tr>
                            
                            @if($product->model != '')
                            <tr><th> Model </th><td> {{ $product->model }} </td></tr>
                            @endif
                            
                            @if($product->designed_by != '')
                            <tr><th> Designed By </th><td> {{ $product->designed_by }} </td></tr>
                            @endif
                            
                            
                            
                            <tr><th> Price </th><td> ${{ $product->price }} </td></tr>
                            
                            @if($product->discount != '')
                            <tr><th> Discount </th><td> ${{ $product->discount }} </td></tr>
                            @endif

                            @if($product->dealer_price != '')
                            <tr><th> Dealers Price </th><td> ${{ $product->dealer_price }} </td></tr>
                            @endif

                            
                            <tr><th> Short Description </th><td> <?= html_entity_decode($product->short_description) ?> </td></tr>
                            
                            @if($product->description != '')
                            <tr><th> Detail Description </th><td> <?= html_entity_decode($product->description) ?> </td></tr>
                            @endif
                            
                            @if($product->additional_information != '')
                            <tr><th> Additional Information </th><td> <?= html_entity_decode($product->additional_information) ?> </td></tr>
                            @endif


                            <!-- hodos custom fields -->
                            @if($product->standard_sizes != '')
                            <tr><th> Standard Sizes </th><td> <?= html_entity_decode($product->standard_sizes) ?> </td></tr>
                            @endif

                            @if($product->motor_options != '')
                            <tr class="motor_options"><th> Motor Options </th><td> <?= html_entity_decode($product->motor_options) ?> </td></tr>
                            @endif

                            @if($product->finishes != '')
                            <tr class="finishes"><th> Finishes </th><td> <?= html_entity_decode($product->finishes) ?> </td></tr>
                            @endif
							
							
							@if($product->chrome_knob != '')
                            <tr class="chrome_knob"><th> Chrome Variable Knobs </th><td> <?= html_entity_decode($product->chrome_knob) ?> </td></tr>
                            @endif
							@if($product->chrome_knob_image != '')
                            <tr><th> Chrome Variable Knobs Image </th><td> <img src="{{ asset($product->chrome_knob_image) }}" style="width: 20%;"> </td></tr>
                            @endif
							@if($product->led_lighting != '')
                            <tr class="led_lighting"><th> 3000K LED Lighting </th><td> <?= html_entity_decode($product->led_lighting) ?> </td></tr>
                            @endif
							@if($product->led_lighting_image != '')
                            <tr><th> 3000K LED Lighting Image </th><td> <img src="{{ asset($product->led_lighting_image) }}" style="width: 20%;"> </td></tr>
                            @endif
							@if($product->baffle_filters != '')
                            <tr class="baffle_filters"><th> Baffle Filters </th><td> <?= html_entity_decode($product->baffle_filters) ?> </td></tr>
                            @endif
							@if($product->baffle_filters_image != '')
                            <tr><th> Baffle Filters Image </th><td> <img src="{{ asset($product->baffle_filters_image) }}" style="width: 20%;"> </td></tr>
                            @endif
							@if($product->implemented_underside != '')
                            <tr class="implemented_underside"><th> Fully Implemented Underside </th><td> <?= html_entity_decode($product->implemented_underside) ?> </td></tr>
                            @endif
							@if($product->implemented_underside_image != '')
                            <tr><th> Fully Implemented Underside Image </th><td> <img src="{{ asset($product->implemented_underside_image) }}" style="width: 20%;"> </td></tr>
                            @endif
                            <!-- hodos custom fields -->

                            
                            <tr><th> Image </th><td> <img src="{{ asset($product->image) }}" style="width: 20%;"> </td></tr>
                            
                            @if(count($images) > 0)
                            <tr><th> Gallery Images </th><td> 
                                @foreach($images as $data)
                                <img src="{{ asset($data->image) }}" style="width: 130px;height: 130px;object-fit: contain;object-position: center;"> 
                                @endforeach
                            </td></tr>
                            @endif
                            
                            
                            
                            
                            <tr><th> 3D File </th><td> {{ $product->file }} </td></tr>
                            
                            <tr><th> Active Product</th>
                                @if($product->is_active == '1')
                                <td style="color: green;">Yes</td>
                                @else
                                <td style="color: red;">No</td>
                                @endif
                            </tr>

                            <tr><th> Featured </th>
                                @if($product->is_featured == '1')
                                <td style="color: green;">Yes</td>
                                @else
                                <td style="color: red;">No</td>
                                @endif
                                
                            </tr>

                            <tr><th> Custom Product </th>
                              <!--   @if($product->is_custom == '1')
                                <td style="color: green;">Yes</td>
                                @else
                                <td style="color: red;">No</td>
                                @endif -->

                                <?php $record = DB::table('custom_prices')->where('product_id', $product->id)->first(); 
                                $attr = explode(',', $record->attribute_id);
                                $value_price = json_decode($record->value_price);
                                ?>

                                <td>

                                    <h4 style="text-transform: uppercase; font-weight: 600; font-size: 15px;">Attributes</h4>
                                    <ul>
                                    @foreach($attr as $key=>$data)
                                    <?php $atr = DB::table('attributes')->where('id', $data)->first(); ?>
                                    <li>
                                        {{$atr->attribute}}
                                    </li> 
                                    @endforeach
                                    </ul>

                                    <br>

                                    <h4 style="text-transform: uppercase; font-weight: 600; font-size: 15px;">Value Prices</h4>
                                    <ul>
                                        @foreach($value_price as $key=>$data)
                                        <li>
                                            {{$key}} => ${{$data}}
                                        </li> 
                                        @endforeach
                                    </ul>
                                </td>
                               
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.footer')
</div>
@endsection


<style type="text/css">
    .motor_options img{
        width: 15%;
    }

    .finishes img{
        width: 15%;
    }
</style>
