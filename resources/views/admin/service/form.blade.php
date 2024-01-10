<?php
$segment = Request::segments();

$representative = json_decode($service->representative);
$representative_location = DB::table('representative_locations')->where('is_active', '1')->where('deleted_at', null)->get()->toArray();
?>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('representative_location') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::Label('representative_location', 'Select Location') !!}

    <?php $prodArr = isset($service)? explode(",",$service->representative_location):array();  ?>

        @if($representative_location)
        <select name="representative_location[]" multiple="multiple"  class="js-example-tags form-control" id= "e1" >
              @foreach($representative_location as $location)

                 <?php // if($lang->id)
                    $selected = '';
                    if (in_array($location->id, $prodArr)) { ?>

                         <option selected="selected" value="{{$location->id}}">{{$location->Name}}</option>

                   <?php

                    } else {

                    ?>
                       <option  value="{{$location->id}}">{{ $location->Name }}</option>

                <?php

                    }

                 ?>
              @endforeach
        </select>
        @endif

    </div>
</div>



<!--<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('representative_location') ? 'has-error' : ''}}">-->
<!--    {!! Form::label('representative_location', 'Representative Location', ['class' => 'col-md-12 control-label']) !!}-->
<!--    <div class="col-md-12">-->
<!--        {!! Form::text('representative_location', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}-->
<!--        {!! $errors->first('representative_location', '<p class="help-block">:message</p>') !!}-->
<!--    </div>-->
<!--</div>-->


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Company Name', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'onkeyup'=>'generateSlug(this.value);'] : ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('slug') ? 'has-error' : ''}}">
    {!! Form::label('slug', 'Slug', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('slug', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly'] : ['class' => 'form-control']) !!}
        {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('website') ? 'has-error' : ''}}">
    {!! Form::label('website', 'Website', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('website', null, ('required' == '') ? ['class' => 'form-control', 'required' => ''] : ['class' => 'form-control']) !!}
        {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<!--add more-->
{!! Form::label('representative_name', 'Representative Information', ['class' => 'col-md-12 control-label']) !!}


@if(isset($segment[2]) && $segment[2] == 'create')
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('representative_name') ? 'has-error' : ''}}">
    <!--{!! Form::label('representative_name', 'Representative Name', ['class' => 'col-md-12 control-label']) !!}-->
    <div class="col-md-12">
        
        <div id="invoice_data_div">
            <hr class="invoice_hr">
            <input type="text" name="representative[0][name]" class="form-control representative" placeholder="Enter Representative Name">
            <input type="text" name="representative[0][email]" class="form-control representative" placeholder="Enter Representative Email">
            <input type="text" name="representative[0][phone]" class="form-control representative input-phone" id="input-phone" placeholder="Enter Representative Phone">
            <hr class="invoice_hr">
        </div>
        
        
        <a href="javascript:void(0)" class="btn btn-success addNewButton" id="addNewButton" onclick="addmore(1)"><i class="fa fa-plus"></i>
            Add More
        </a>
        
        
        
        <!--{!! Form::text('representative_name', null, ('required' == '') ? ['class' => 'form-control', 'required' => '', placeholder => 'Enter Representative Name'] : ['class' => 'form-control', placeholder => 'Enter Representative Name']) !!}-->
        <!--{!! $errors->first('representative_name', '<p class="help-block">:message</p>') !!}-->
    </div>
</div>
@else
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('representative_name') ? 'has-error' : ''}}">

    <div class="col-md-12">
        
        <div id="invoice_data_div">
            
            <?php 
            $counter = 0;
            ?>
            @foreach($representative as $key=>$rep)
           
            <hr class="invoice_hr">
            <input value="{{$rep->name}}" type="text" name="representative[{{$counter}}][name]" class="form-control representative" placeholder="Enter Representative Name">
            <input value="{{$rep->email}}" type="text" name="representative[{{$counter}}][email]" class="form-control representative" placeholder="Enter Representative Email">
            <input value="{{$rep->phone}}" type="text" name="representative[{{$counter}}][phone]" class="form-control representative input-phone" id="input-phone" placeholder="Enter Representative Phone">
            <hr class="invoice_hr">
            <?php $counter++; ?>
            @endforeach
        </div>
        
        
        <a href="javascript:void(0)" class="btn btn-success addNewButton" id="addNewButton" onclick="addmore({{$counter}})"><i class="fa fa-plus"></i>
            Add More
        </a>
    </div>
</div>
@endif
<!--<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('representative_email') ? 'has-error' : ''}}">-->
    <!--{!! Form::label('representative_email', 'Representative Email', ['class' => 'col-md-12 control-label']) !!}-->
<!--    <div class="col-md-12">-->
<!--        {!! Form::text('representative_email', null, ('required' == '') ? ['class' => 'form-control', 'required' => '', placeholder => 'Enter Representative Email'] : ['class' => 'form-control', placeholder => 'Enter Representative Email']) !!}-->
<!--        {!! $errors->first('representative_email', '<p class="help-block">:message</p>') !!}-->
<!--    </div>-->
<!--</div>-->
<!--<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('representative_phone') ? 'has-error' : ''}}">-->
    <!--{!! Form::label('representative_email', 'Representative Email', ['class' => 'col-md-12 control-label']) !!}-->
<!--    <div class="col-md-12">-->
<!--        {!! Form::text('representative_email', null, ('required' == '') ? ['class' => 'form-control', 'required' => '', placeholder => 'Enter Representative Phone'] : ['class' => 'form-control', placeholder => 'Enter Representative Phone']) !!}-->
<!--        {!! $errors->first('representative_email', '<p class="help-block">:message</p>') !!}-->
<!--    </div>-->
<!--</div>-->
<!--add more-->



<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Logo', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

      <div class="max-text">
        <img alt="" class="img-responsive" id="banner1" 
        src="{{ isset($service)?asset($service->image):asset('images/upload.jpg') }}" style=" width: 30%; "> 
        <br/>
      </div>
        <br/>
        {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>



@if(isset($segment) && $segment[2] != 'create')
<!-- active -->
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('is_active') ? 'has-error' : ''}}">
    
    <div class="col-md-12">
        <label for="is_active" class="col-md-12 control-label"><input type="checkbox" name="is_active" value="1" @if($service->is_active == '1') checked @endif > Active</label>
        
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@endif

<div class="form-group row justify-content-center">
    <div class="col-lg-4 col-12 align-content-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

<style>
    .representative{
        margin-bottom:12px;
    }
</style>



@push('js')
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




<!--add more-->
<script>

    
    function addmore(index){

        if(index < 10){
            var html = '';
            html = "<div class='section"+index+"'><input type='text' name='representative["+index+"][name]' class='form-control representative' placeholder='Enter Representative Name'><input type='text' name='representative["+index+"][email]' class='form-control representative' placeholder='Enter Representative Email'><input type='text' name='representative["+index+"][phone]' class='form-control representative input-phone' id='input-phone' placeholder='Enter Representative Phone'><a href='javascript:void(0)' class='btn btn-danger delete_div' onclick='deleteSection("+index+")'>Delete</a><hr class='invoice_hr'></div>";


     
            
 
            $("#invoice_data_div").append(html);
            var inc = parseInt(index) + 1;

            $(".addNewButton").attr("onclick","addmore("+inc+")");

        }
        else{
            $(".addNewButton").hide();
        }


    }
    
    
    // delete div
        function deleteSection(index){

        $(".section"+index).remove();
        
        }
        
        

</script>
<!--add more-->




<!-- input mask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.60/inputmask/jquery.inputmask.js"></script>
   

<script type="text/javascript">



// $('#input-phone').focus(function(){
    

// //   $('.select-country').change(function(){
//     // country_code = $(this).val();

//     // $('.input-phone').removeAttr('readonly');
//     $('#input-phone').attr('placeholder', '(___)___-____');
//     // $(".input-phone").inputmask({"mask": country_code+"9999-99999"});
//     $(":input").inputmask();
//     $("#input-phone").inputmask({"mask": "(999)999-9999"});

// //   });
//   // $(".input-phone").inputmask({"mask": "(99) 9999 - 9999"});
  
// });
</script>



@endpush