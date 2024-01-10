<?php 
$segment = Request::segments();
?>



<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('type') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::Label('type', 'Type') !!}

        <select required="" class="form-control" id="type" name="type">
            <option selected="" disabled="">Select Type</option>
            <option value="part"  @if($product->type == "part") selected @endif>Parts</option>
            <option value="product" @if($product->type == "product") selected @endif>Hoods</option>
            
            
           {{--
           @if($product->type == "part")
            <option value="part" selected>Parts</option>
            @else
            <option value="part">Parts</option>
            @endif
             @if($product->type == "product")
            <option value="product" selected>Products</option>
            @else
            <option value="product">Products</option>
               @endif
            --}}
            
        </select>
    </div>
</div>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('category') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::Label('category', 'Category') !!}

        <?php
        if($product->type == 'product'){
            $category = DB::table('categories')->where('is_active', '1')->where('deleted_at', null)->where('type', 'hoods')->pluck('category', 'slug');
        }
        elseif($product->type == 'part'){
            $category = DB::table('categories')->where('is_active', '1')->where('deleted_at', null)->where('type', 'parts')->pluck('category', 'slug');
        }
        ?>
		
		

        <select required="" class="form-control" id="category" name="category">
            <option selected="" disabled="">Select Category</option>
            @foreach($category as $key=>$data)
            <option @if($product->category == $key) selected @endif value="{{$key}}">{{$data}}</option>
            @endforeach
        </select>
    </div>
</div>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('product_title') ? 'has-error' : ''}}">
    {!! Form::label('product_title', 'Product Title', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('product_title', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'onkeyup'=>'generateSlug(this.value);'] : ['class' => 'form-control']) !!}
        {!! $errors->first('product_title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('slug') ? 'has-error' : ''}}">
    {!! Form::label('slug', 'Slug', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('slug', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly'] : ['class' => 'form-control']) !!}
        {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="sizes">
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('sizes') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::Label('Sizes', 'Select Size') !!}

    <?php 

    $chef_services = explode(',', $product->sizes);
    $prodArr = isset($chef_services)? $chef_services:array();  
    // dd($prodArr);
    ?>

        @if($services)
        <select name="sizes[]" multiple="multiple"  class="js-example-tags form-control" id= "e1" >
              @foreach($services as $service)

                 <?php // if($lang->id)
                    $selected = '';
                    if (in_array($service->id, $prodArr)) { ?>

                         <option selected="selected" value="{{$service->id}}">{{$service->title}}</option>

                   <?php

                    } else {

                    ?>
                       <option  value="{{$service->id}}">{{ $service->title }}</option>

                <?php

                    }

                 ?>
              @endforeach
        </select>
        @endif

    </div>
</div>
</div>

<div class="hoods">
    <div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('model') ? 'has-error' : ''}}">
        {!! Form::label('model', 'Model', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::text('model', null, ('required' == '') ? ['class' => 'form-control', 'required' => ''] : ['class' => 'form-control']) !!}
            {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
    <div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('designed_by') ? 'has-error' : ''}}">
        {!! Form::label('designed_by', 'Designed By', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::text('designed_by', null, ('required' == '') ? ['class' => 'form-control', 'required' => ''] : ['class' => 'form-control']) !!}
            {!! $errors->first('designed_by', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>



<div class="prices_div">
    
    <div id="price" class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('price') ? 'has-error' : ''}}">
        {!! Form::label('price', 'Price', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::number('price', null, ('required' == '') ? ['class' => 'form-control', 'required' => '', 'step'=> 'any', 'min'=>'1'] : ['class' => 'form-control', 'step'=> 'any', 'min'=>'1']) !!}
            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    

    <div id="discount" class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('discount') ? 'has-error' : ''}}">
        {!! Form::label('discount', 'Sale Price ( If Any )', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::number('discount', null, ('required' == '') ? ['class' => 'form-control', 'required' => '', 'step'=> 'any', 'min'=>'1'] : ['class' => 'form-control', 'step'=> 'any', 'min'=>'1']) !!}
            {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div id="dealer_price" class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('dealer_price') ? 'has-error' : ''}}">
        {!! Form::label('dealer_price', 'Dealer Price', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::number('dealer_price', null, ('required' == '') ? ['class' => 'form-control', 'required' => '', 'step'=> 'any', 'min'=>'1'] : ['class' => 'form-control', 'step'=> 'any', 'min'=>'1']) !!}
            {!! $errors->first('dealer_price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>




<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('short_description') ? 'has-error' : ''}}">
    {!! Form::label('short_description', 'Short Description', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::textarea('short_description', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('short_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::textarea('description', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor1', 'required' => ''] : ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('additional_information') ? 'has-error' : ''}}">
    {!! Form::label('additional_information', 'Additional Information', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::textarea('additional_information', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor2', 'required' => ''] : ['class' => 'form-control']) !!}
        {!! $errors->first('additional_information', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<!-- hoods fields -->
<div class="hoods_custom">
    <div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('standard_sizes') ? 'has-error' : ''}}">
        {!! Form::label('standard_sizes', 'Standard Sizes', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::textarea('standard_sizes', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor3', 'required' => ''] : ['class' => 'form-control']) !!}
            {!! $errors->first('standard_sizes', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('motor_options') ? 'has-error' : ''}}">
        {!! Form::label('motor_options', 'Motor Options', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::textarea('motor_options', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor4', 'required' => ''] : ['class' => 'form-control']) !!}
            {!! $errors->first('motor_options', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('finishes') ? 'has-error' : ''}}">
        {!! Form::label('finishes', 'Finishes', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::textarea('finishes', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor5', 'required' => ''] : ['class' => 'form-control']) !!}
            {!! $errors->first('finishes', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
	
	
	
	<!-- spec details -->
	
	<div class="row">
		<div class="col-md-8">
		<div class="form-group row {{ $errors->has('chrome_knob') ? 'has-error' : ''}}">
        {!! Form::label('chrome_knob', 'Chrome Variable Knobs', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::textarea('chrome_knob', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor6', 'required' => ''] : ['class' => 'form-control']) !!}
            {!! $errors->first('chrome_knob', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
	</div>
		<div class="col-md-4">
		<div class="form-group row {{ $errors->has('chrome_knob_image') ? 'has-error' : ''}}">
    {!! Form::label('chrome_knob_image', 'Chrome Variable Knobs Image', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

      <div class="max-text">
        <img alt="" class="img-responsive" id="banner1" 
        src="{{ isset($product)?asset($product->chrome_knob_image):asset('images/upload.jpg') }}" style=" width: 60%; "> 
        <br/>
      </div>
        <br/>
        {!! Form::file('chrome_knob_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('chrome_knob_image', '<p class="help-block">:message</p>') !!}
    </div>
	</div></div>
	</div>
	
	
	<div class="row">
		<div class="col-md-8">
		<div class="form-group row {{ $errors->has('led_lighting') ? 'has-error' : ''}}">
        {!! Form::label('led_lighting', '3000K LED Lighting', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::textarea('led_lighting', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor7', 'required' => ''] : ['class' => 'form-control']) !!}
            {!! $errors->first('led_lighting', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
	</div>
		<div class="col-md-4">
		<div class="form-group row {{ $errors->has('led_lighting_image') ? 'has-error' : ''}}">
    {!! Form::label('led_lighting_image', '3000K LED Lighting Image', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

      <div class="max-text">
        <img alt="" class="img-responsive" id="banner1" 
        src="{{ isset($product)?asset($product->led_lighting_image):asset('images/upload.jpg') }}" style=" width: 60%; "> 
        <br/>
      </div>
        <br/>
        {!! Form::file('led_lighting_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('led_lighting_image', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-8">
		<div class="form-group row {{ $errors->has('baffle_filters') ? 'has-error' : ''}}">
        {!! Form::label('baffle_filters', 'Baffle Filters', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::textarea('baffle_filters', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor8', 'required' => ''] : ['class' => 'form-control']) !!}
            {!! $errors->first('baffle_filters', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
	</div>
		<div class="col-md-4">
		<div class="form-group row {{ $errors->has('baffle_filters_image') ? 'has-error' : ''}}">
    {!! Form::label('baffle_filters_image', 'Baffle Filters Image', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

      <div class="max-text">
        <img alt="" class="img-responsive" id="banner1" 
        src="{{ isset($product)?asset($product->baffle_filters_image):asset('images/upload.jpg') }}" style=" width: 60%; "> 
        <br/>
      </div>
        <br/>
        {!! Form::file('baffle_filters_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('baffle_filters_image', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-8">
		<div class="form-group row {{ $errors->has('implemented_underside') ? 'has-error' : ''}}">
        {!! Form::label('implemented_underside', 'Fully Implemented Underside', ['class' => 'col-md-12 control-label']) !!}
        <div class="col-md-12">
            {!! Form::textarea('implemented_underside', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor9', 'required' => ''] : ['class' => 'form-control']) !!}
            {!! $errors->first('implemented_underside', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
	</div>
		<div class="col-md-4">
		<div class="form-group row  {{ $errors->has('implemented_underside_image') ? 'has-error' : ''}}">
    {!! Form::label('implemented_underside_image', 'Fully Implemented Underside Image', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

      <div class="max-text">
        <img alt="" class="img-responsive" id="banner1" 
        src="{{ isset($product)?asset($product->implemented_underside_image):asset('images/upload.jpg') }}" style=" width: 60%; "> 
        <br/>
      </div>
        <br/>
        {!! Form::file('implemented_underside_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('implemented_underside_image', '<p class="help-block">:message</p>') !!}
    </div>
</div></div>
	</div>
	
	
	<!-- spec details -->
	
	
	
	
</div>

<!-- hoods fields -->





<div class="form-group row justify-content-center left_css col-md-12  {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

      <div class="max-text">
        <img alt="" class="img-responsive" id="banner1" 
        src="{{ isset($product)?asset($product->image):asset('images/upload.jpg') }}" style=" width: 15%; "> 
        <br/>
      </div>
        <br/>
        {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row justify-content-center left_css col-md-12  {{ $errors->has('file') ? 'has-error' : ''}}">
    {!! Form::label('file', '3D File', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

        {!! Form::file('file', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row justify-content-center left_css col-md-12  {{ $errors->has('pdf') ? 'has-error' : ''}}">
    {!! Form::label('pdf', 'Upload .stl file and specification page', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
         <div class="max-text">
             @if($product->pdf)
      <a href="{{asset($product->pdf)}}" target="_blank" download>  <img alt="" class="img-responsive" id="banner1" 
        src="{{asset('images/pdf.png')}}" style=" width: 15%; "> </a>
        @endif
        <br/>
      </div>
        <br/>
        {!! Form::file('pdf', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('pdf', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="instruction_file">
<div class="form-group row justify-content-center left_css col-md-12  {{ $errors->has('pdf') ? 'has-error' : ''}}">
    {!! Form::label('instruction_file', 'Installation / Size Instructions File', ['class' => 'col-md-12 control-label', 'id' => 'instruction_file']) !!}
    <div class="col-md-12">
         <div class="max-text">
             @if($product->instruction_file)
      <a href="{{asset($product->instruction_file)}}" target="_blank" download>  <img alt="" class="img-responsive" id="banner1" 
        src="{{asset('images/pdf.png')}}" style=" width: 15%; "> </a>
        @endif
        <br/>
      </div>
        <br/>
        {!! Form::file('instruction_file', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('instruction_file', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>





    <!--multi images-->
<div class="hoods_images">

<div class="form-group row justify-content-center  {{ $errors->has('images') ? 'has-error' : ''}}">
    {!! Form::label('images', 'Gallery Images', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

    @if(isset($product_images) && count($product_images) > 0)
      <div class="max-text">
        @foreach($product_images as $pimage)
        <div class="gallery_css">
            <a href="{{ route('product_image.delete', $pimage->id) }}" class="delete_css">X</a>
                <img style="width: 223px; height:223px; padding: 10px;" alt="" class="img-responsive" id="banner1" 
                src="{{ asset($pimage->image) }}" > 
        </div>  
        @endforeach        
        
      </div>
    @else            
    @endif  

        
    </div>
    
        <div class="col-md-12">
        <br/>
              <div id="demo"></div>
        <br/>
        </div>
</div>
</div>
    <!--multi images-->
    
    
    
    
    

@if(isset($segment) && $segment[2] != 'create')
<!-- active -->
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('is_active') ? 'has-error' : ''}}">
    
    <div class="col-md-12">
        <label for="is_active" class="control-label"><input type="checkbox" name="is_active" value="1" @if($product->is_active == '1') checked @endif > Active</label>
        
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif



<!-- is_featured -->
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('is_featured') ? 'has-error' : ''}}">
    
    <div class="col-md-12">
        <label for="is_featured" class=" control-label"><input type="checkbox" name="is_featured" value="1" @if($product->is_featured == '1') checked @endif > Featured Product</label>
        
        {!! $errors->first('is_featured', '<p class="help-block">:message</p>') !!}
    </div>
</div>




<!-- is_custom -->
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('is_custom') ? 'has-error' : ''}}">
    
    <div class="col-md-12">
        <label for="is_custom" class="control-label"><input type="checkbox" name="is_custom" value="1" @if($product->is_custom == '1') checked @endif > Customize Product</label>
        
        {!! $errors->first('is_custom', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<!-- //edit custom_product -->
@if($product->is_custom == '1')
<?php
$record = DB::table('custom_prices')->where('product_id', $product->id)->first();
?>

<div class="form-group row justify-content-center left_css col-md-12">
    
    <div class="col-md-12">
        <a href="{{url('admin/custom-price/'.$record->id.'/edit?id='.$product->id)}}" class="btn btn-success">Edit Custom Attributes</a>
    </div>
</div>
@endif








<div class="form-group row justify-content-center">
    <div class="col-lg-4 col-12 align-content-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>



<style type="text/css">



label.error{
    color: red;
}

a.delete_css {
    position: absolute;
    background: red;
    padding: 5px 10px;
    color: #fff;
    font-weight: 800;
}

.gallery_css {
    width: 24%;
    float: left;
    margin: 0px 4px;
}



.form-group {
    margin-bottom: 59px!important;
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

<script>
$("#demo").spartanMultiImagePicker({
  fieldName:  'images[]'
});

</script>



<!-- slug script -->
<script>

    var custom=function(){
        return {
            create_slug:function (string) {
                var $slug = '';
                var trimmed = $.trim(string);
                $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
                replace(/-+/g, '-').
                replace(/^-|-$/g, '');
                return $slug.toLowerCase();
            }
        }
    }

    function generateSlug(string){
        $('#slug').val(custom().create_slug(string));
    }

</script>
<!-- slug script -->


<!--hoods-->
<script>

    $('.hoods').hide();
    $('.hoods_images').hide();
    $('.prices_div').show();
    $('.hoods_custom').hide();

    
    $('#type').change(function(){
        var option = $(this).find(':selected').val();
        if(option == 'product'){
            $('.hoods').show();
             $('.sizes').hide();
             $('.hoods_images').show();
             $('.prices_div').hide();
            $('.hoods_custom').show();

              document.getElementById('instruction_file').innerHTML = "Specification Sheet";
        }
        else if(option == 'part'){
            $('.hoods').hide();
            $('.sizes').show();
            $('.hoods_images').hide();
            $('.prices_div').show();
            $('.hoods_custom').hide();


           document.getElementById('instruction_file').innerHTML = "Installation / Size Instructions File";
        }
    });
</script>


@if($product->type == 'product')
<script>
    $('.hoods').show();
    $('.hoods_images').show();
    $('.prices_div').hide();
    $('.hoods_custom').show();

</script>
@endif




<!-- get specific type's categories -->
<script type="text/javascript">


        $("select[name='type']").change(function() {

        
          var type_id = $(this).val();
          var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          
          $.ajax({ 
                url: "{{route('typeCategory')}}",
                type: 'POST',
                data: {"_token":CSRF_TOKEN,type_id:type_id},
                dataType: "json",

                success: function (response)
                {
                 

                    if(response.list != ''){
                    

                        $("select[name='category']").html("");

                            $("select[name='category']").append( new Option('Select Category','') );
                        $.each(response.list, function(val, text) {
                            $("select[name='category']").append( new Option(text,val) );
                        });
                    }
                    // else{
                    //     $('.sec_div').hide();
                    // }
              
                },
                beforeSend: function(response)
                {
                    //$(this).text("Loading...");
                }
            });
        });
    </script>
@endpush