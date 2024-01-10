<?php
$attributes = DB::table('attributes')->where('is_active', '1')->where('deleted_at', null)->get();

$segment = Request::segments();
if($segment[2] != 'create'){
    $check_record = DB::table('custom_prices')->where('product_id', $_GET['id'])->first();

    $attribute_id_record = $check_record->attribute_id;
    $attribute_id_record = explode(',', $attribute_id_record);

    $value_price_record = json_decode($check_record->value_price);
}
?>

<div class="accordion" id="accordionExample">
  

  @foreach($attributes as $key=>$data)
  <?php
  $att_values = DB::table('attribute_values')->where('attribute_id', $data->id)->get();
  ?>


  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne{{$key}}">
      <button class="accordion-button @if($key != '0') collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$key}}" @if($key == '0') aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapseOne{{$key}}">

        
        <input 
        @foreach($attribute_id_record as $key1=>$rec)
        @if($rec == $data->id)
        checked
        @endif
        @endforeach

        data-attribute_id="{{$data->id}}" type="checkbox" class="attribute_check" name="attribute_check"> 
        

        {{$data->attribute}}
      </button>
    </h2>
    <div id="collapseOne{{$key}}" class="accordion-collapse collapse @if($key == '0') show @endif" aria-labelledby="headingOne{{$key}}" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        
        @foreach($att_values as $key=>$val)


        <input type="hidden" class="att_val" value="{{$val->value}}">


        <div class="row">
            <div class="col-md-3">
                <h4>Value: {{$val->value}}</h4>
            </div>

            <div class="col-md-6">
                <h4>Price:</h4>

                <input 

                @foreach($value_price_record as $rec1=>$rec2)
                @if($rec1 == $val->value)
                value="{{$rec2}}"
                @endif
                @endforeach

                data-value_id="{{$val->id}}" class="input_price" type="number" min="1" step="any">
            
            </div>

             
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endforeach

</div>



<!-- <div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('product_id') ? 'has-error' : ''}}">
    {!! Form::label('product_id', 'Product Id', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('product_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('attribute_id') ? 'has-error' : ''}}">
    {!! Form::label('attribute_id', 'Attribute Id', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('attribute_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('attribute_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('value_price') ? 'has-error' : ''}}">
    {!! Form::label('value_price', 'Value Price', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::textarea('value_price', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('value_price', '<p class="help-block">:message</p>') !!}
    </div>
</div> -->



@if($segment[2] == 'create')
<form class="customPriceForm" action="{{route('customPriceStore')}}" method="post">
@csrf
    <input type="hidden" name="product_id" value="{{$_GET['id']}}">
    <input type="hidden" name="attribute_id" class="selected_attributes">
    <input type="hidden" name="attribute_value_price" class="attribute_value_price">
</form>
@else
<form class="customPriceFormUpdate" action="{{route('customPriceUpdate', $check_record->id)}}" method="post">
@csrf
    <input type="hidden" name="product_id" value="{{$_GET['id']}}">
    <input type="hidden" name="attribute_id" class="selected_attributes">
    <input type="hidden" name="attribute_value_price" class="attribute_value_price">
</form>
@endif





<div class="form-group row justify-content-center">
    <input 
    @if($segment[2] != 'create')
        class="btn btn-primary customPriceUpdate"
    @else 
        class="btn btn-primary customPriceSave"
    @endif
     type="submit" value="Submit">
</div>


<!-- <div class="form-group row justify-content-center">
    <div class="col-lg-4 col-12 align-content-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div> -->

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->


<style type="text/css">
.accordion-item:first-of-type {
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
}

.accordion-item {
    background-color: #fff;
    border: 1px solid rgba(0,0,0,.125);
}

.accordion-header {
    margin-bottom: 0;
}
.accordion-item:first-of-type .accordion-button {
    border-top-left-radius: calc(0.25rem - 1px);
    border-top-right-radius: calc(0.25rem - 1px);
}

.accordion-button:not(.collapsed) {
    color: #0c63e4;
    background-color: #e7f1ff;
    box-shadow: inset 0 -1px 0 rgb(0 0 0 / 13%);
}

.accordion-button {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    padding: 1rem 1.25rem;
    color: #212529;
    text-align: left;
    background-color: #fff;
    border: 0;
    border-radius: 0;
    overflow-anchor: none;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,border-radius .15s ease;

    font-weight: 700;
    font-size: 12px;
    font-size: 19px;
    text-transform: uppercase;
}

.accordion-button:not(.collapsed)::after {
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230c63e4'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e);
    transform: rotate(-180deg);
}

.accordion-button::after {
    flex-shrink: 0;
    width: 1.25rem;
    height: 1.25rem;
    margin-left: auto;
    content: "";
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e);
    background-repeat: no-repeat;
    background-size: 1.25rem;
    transition: transform .2s ease-in-out;
}
.collapse.show {
    display: block;
}
.collapse {
    display: none;
}

.accordion-body {
    padding: 1rem 1.25rem;
}

div#accordionExample{
    width: 100%;
    padding-right: 5%;
    padding-left: 5%;
}

.accordion-item h2{
    line-height: 16px;
}

.accordion-body h4{
    font-size: 16px;
    display: inline-block;
    font-weight: 600;
}



.attribute_check{
    margin-right: 10px;
}


.input_price{
    margin-left: 12px;
}
</style>



@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



<script type="text/javascript">
    $('.attribute_check').click(function(){
        


        
        // $(".attribute_check").each(function() {

            if($(this).is(':checked')){
              $.toast({
                  heading: 'Success!',
                  position: 'bottom-right',
                  text:  'Please add prices for the selected attribute!',
                  loaderBg: '#ff6849',
                  icon: 'success',
                  hideAfter: 3000,
                  stack: 6
              });


              // add in form
              // var selected_attributes = $(this).data('attribute_id');
              // alert(selected_attributes);
              // $('.selected_attributes').val(selected_attributes);
              // var arr = [];

              // code = $(this).data('attribute_id');
              //   arr.push(code);
              //   console.log(arr);
            // $div.append(code + "<br />");

            }


            
            
        // });


    });
</script> 


<!-- <script type="text/javascript">
    var array = []

    $('.attribute_check').click(function(){
    $("input:checkbox[name=attribute_check]:checked").each(function(){
        console.log($(this).data('attribute_id'));
        // array.push($(this).val());
    });
    });
</script> -->


<!-- <script type="text/javascript">
    $('.input_price').keyup(function(){
        var value = $(this).data('value_id');
        alert(value);
    });
</script> -->

<!-- form submit -->

@if($segment[2] == 'create')
<script type="text/javascript">
    // $('.customPriceSave').click(function(){
    //     var array = [];

    //     $("input:checkbox[name=attribute_check]:checked").each(function(){
    //     array1 = array.push($(this).data('attribute_id'));

    //     });
    //     $('.selected_attributes').val(array1);

    // });


    $('.customPriceSave').on('click', function() {

            // attribute id
            var array = [];
           


            $("input:checkbox[name=attribute_check]:checked").each(function() {
                array.push($(this).data('attribute_id'));


            // att_prices
            // var div_id = $(this).closest('h2').attr('id');

            $(this).closest('h2').siblings().find('.input_price').attr('name', 'price_val[]');


            // att_values
            $(this).closest('h2').siblings().find('.att_val').attr('name', 'att_val[]');


            });
            console.log(array);
          
            $('.selected_attributes').val(array);

             


            // attribute value
            var values = $("input[name='att_val\\[\\]']")
              .map(function(){return $(this).val();}).get();
              console.log(values);



            // attribute price
            var prices = $("input[name='price_val\\[\\]']")
              .map(function(){return $(this).val();}).get();
              console.log(prices);


            //merge values and prices
            var result = {};
            for (var i = 0; i < values.length; i++) {
                    result[values[i]] = prices[i];
            }

            var attribute_value_price = JSON.stringify(result);

            $('.attribute_value_price').val(attribute_value_price);


            // submit form
            $('.customPriceForm').submit();


            
        });

</script>
@else
<script type="text/javascript">
    // $('.customPriceSave').click(function(){
    //     var array = [];

    //     $("input:checkbox[name=attribute_check]:checked").each(function(){
    //     array1 = array.push($(this).data('attribute_id'));

    //     });
    //     $('.selected_attributes').val(array1);

    // });


    $('.customPriceUpdate').on('click', function() {

            // attribute id
            var array = [];
           


            $("input:checkbox[name=attribute_check]:checked").each(function() {
                array.push($(this).data('attribute_id'));


            // att_prices
            // var div_id = $(this).closest('h2').attr('id');

            $(this).closest('h2').siblings().find('.input_price').attr('name', 'price_val[]');


            // att_values
            $(this).closest('h2').siblings().find('.att_val').attr('name', 'att_val[]');


            });
            console.log(array);
          
            $('.selected_attributes').val(array);

             


            // attribute value
            var values = $("input[name='att_val\\[\\]']")
              .map(function(){return $(this).val();}).get();
              console.log(values);



            // attribute price
            var prices = $("input[name='price_val\\[\\]']")
              .map(function(){return $(this).val();}).get();
              console.log(prices);


            //merge values and prices
            var result = {};
            for (var i = 0; i < values.length; i++) {
                    result[values[i]] = prices[i];
            }

            var attribute_value_price = JSON.stringify(result);

            $('.attribute_value_price').val(attribute_value_price);


            // submit form
            $('.customPriceFormUpdate').submit();


            
        });

</script>
@endif


@endpush