<?php
$segment = Request::segments();
/*dd($segment);*/

?>



<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('service') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::Label('service', 'Company') !!}

        <select required="" class="form-control" id="service" name="service">
            <option selected="" disabled="">Select Company</option>
            @foreach($service as $key=>$data)
            <option @if($dealer->service == $data->slug) selected @endif value="{{$data->slug}}">{{$data->name}}</option>
            @endforeach
        </select>
    </div>
</div>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', 'Address', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('address', null, ('required' == '') ? ['class' => 'form-control', 'required' => ''] : ['class' => 'form-control']) !!}
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!---<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('embed_link') ? 'has-error' : ''}}">
    {!! Form::label('embed_link', 'Add embed Link', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::textarea('embed_link', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('embed_link', '<p class="help-block">:message</p>') !!}
    </div>
</div>-->


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', 'Phone', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
      
        <!--{!! Form::number('phone', null, ('required' == '') ? ['class' => 'form-control input-phone', 'required' => '', 'placeholder' => '(___)___-____'] : ['class' => 'form-control input-phone', 'placeholder' => '(___)___-____']) !!}-->
        <input type="text" name="phone" class="form-control input-phone" placeholder="(___)___-____" value="{{$dealer->phone}}">
        
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('model_number') ? 'has-error' : ''}}">
    {!! Form::label('model_number', 'Model Number', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('model_number', null, ('required' == '') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
        {!! $errors->first('model_number', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('city') ? 'has-error' : ''}}">
    {!! Form::label('city', 'City', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('city', null, ('required' == '') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
        {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('state') ? 'has-error' : ''}}">
    {!! Form::label('state', 'State', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('state', null, ('required' == '') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
        {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('zip_code') ? 'has-error' : ''}}">
    {!! Form::label('zip_code', 'Zip Code', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('zip_code', null, ('required' == '') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
        {!! $errors->first('zip_code', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<!-- latitude/longitude -->
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('latitude') ? 'has-error' : ''}}">
    {!! Form::label('latitude', 'Latitude', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::number('latitude', null, ('required' == 'required') ? ['class' => 'form-control', 'required'=>'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('latitude', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('longitude') ? 'has-error' : ''}}">
    {!! Form::label('longitude', 'Longitude', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::number('longitude', null, ('required' == 'required') ? ['class' => 'form-control', 'required'=>'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('longitude', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('website') ? 'has-error' : ''}}">
    {!! Form::label('website', 'Website', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('website', null, ('required' == '') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
        {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

      <div class="max-text">
        <img alt="" class="img-responsive" id="banner1" 
        src="{{ isset($dealer)?asset($dealer->image):asset('images/upload.jpg') }}" style=" width: 30%; "> 
        <br/>
      </div>
        <br/>
        {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>


@if(isset($segment) && $segment[2] != 'create')
<!-- active -->
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('is_active') ? 'has-error' : ''}}">
    
    <div class="col-md-12">
        <label for="is_active" class="col-md-12 control-label"><input type="checkbox" name="is_active" value="1" @if($dealer->is_active == '1') checked @endif > Active Dealer</label>
        
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@endif
<div class="form-group row justify-content-center">
    <div class="col-lg-4 col-12 align-content-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>




<style type="text/css">
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

</style>





@push('js')
<script type="text/javascript">
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#banner1').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#image").change(function() {
  readURL(this);
});
</script>




  <!-- input mask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.60/inputmask/jquery.inputmask.js"></script>
   

<script type="text/javascript">



$('.input-phone').focus(function(){
    

//   $('.select-country').change(function(){
    // country_code = $(this).val();

    // $('.input-phone').removeAttr('readonly');
    $('.input-phone').attr('placeholder', '(___)___-____');
    // $(".input-phone").inputmask({"mask": country_code+"9999-99999"});
    $(":input").inputmask();
    $(".input-phone").inputmask({"mask": "(999)999-9999"});

//   });
  // $(".input-phone").inputmask({"mask": "(99) 9999 - 9999"});
  
});
</script>
@endpush


