<?php
$segment = Request::segments();

?>

<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('page_name') ? 'has-error' : ''}}">
    {!! Form::label('page_name', 'Page Name', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

        <select disabled="" required="" class="form-control" name="page_name">
            <option selected="" disabled="">Please Select</option>
            <option @if($page->page_name == 'Homepage') selected @endif value="Homepage">Homepage</option>
            <option @if($page->page_name == 'About') selected @endif value="About">About</option>
            <option @if($page->page_name == 'Footer') selected @endif value="Footer">Footer</option>
            <option @if($page->page_name == 'Contact') selected @endif value="Contact">Contact</option>
            <option @if($page->page_name == 'Photo Gallery') selected @endif value="Photo Gallery">Photo Gallery</option>
            <option @if($page->page_name == 'Terms and Conditions') selected @endif value="Terms and Conditions">Terms and Conditions</option>
            <option @if($page->page_name == 'Parts') selected @endif value="Parts">Parts</option>

        </select>

        {!! $errors->first('page_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="title_sec" class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('title', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

        <!-- {!! Form::textarea('title', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor', 'required' => 'required'] : ['class' => 'form-control']) !!} -->
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="sub_title_sec" class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('sub_title') ? 'has-error' : ''}}">
    {!! Form::label('sub_title', 'Sub Title', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('sub_title', null, ('required' == 'required') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}

        <!-- {!! Form::textarea('sub_title', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor1'] : ['class' => 'form-control']) !!} -->
        {!! $errors->first('sub_title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="content_sec" class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'Content', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

        <textarea rows="10" class="form-control" name="content">{{$page->content}}</textarea>

        <!-- {!! Form::textarea('content', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor2'] : ['class' => 'form-control']) !!} -->
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="extra_content_sec" class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('extra_content') ? 'has-error' : ''}}">
    {!! Form::label('extra_content', 'Extra Content', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        
        <textarea rows="10" class="form-control" name="extra_content">{{$page->extra_content}}</textarea>

        <!-- {!! Form::textarea('extra_content', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor3'] : ['class' => 'form-control']) !!} -->
        {!! $errors->first('extra_content', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="image_sec" class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

        <div class="max-text">
        <img alt="" class="img-responsive" id="banner1" 
        src="{{ isset($page)?asset($page->image):asset('images/upload.jpg') }}" style="width: 20%; background-color: grey;"> 
        <br/>
        </div>
        <br/>

        {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="sub_image_sec" class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('sub_image') ? 'has-error' : ''}}">
    {!! Form::label('sub_image', 'Sub Image', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

        <div class="max-text">
        <img alt="" class="img-responsive" id="banner2" 
        src="{{ isset($page)?asset($page->sub_image):asset('images/upload.jpg') }}" style="width: 20%; background-color: grey;"> 
        <br/>
        </div>
        <br/>

        {!! Form::file('sub_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('sub_image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-lg-4 col-12 align-content-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>



@push('js')

<script type="text/javascript">

// image 
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


// sub image
  function readURL1(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#banner2').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#sub_image").change(function() {
  readURL1(this);
});
</script>



@if(isset($segment[2]) && $segment[2] == '1')
<script>
    $('#extra_content_sec').hide();
    
    $('.sub_title_edit').hide();
    $('.title_edit').hide();
    $('.content_text').hide();
    
</script>
@elseif(isset($segment[2]) && $segment[2] == '2')
<script>
    $('#sub_title_sec').hide();
    $('#extra_content_sec').hide();
    $('#content_sec').hide();
    $('#sub_image_sec').hide();
    $('#image_sec').hide();

</script>
@elseif(isset($segment[2]) && $segment[2] == '3')
<script>
    $('#sub_title_sec').hide();
    $('#extra_content_sec').hide();
    $('#sub_image_sec').hide();

</script>
@elseif(isset($segment[2]) && $segment[2] == '4')
<script>
    $('#sub_image_sec').hide();
    $('#extra_content_sec').hide();
</script>
@elseif(isset($segment[2]) && $segment[2] == '5')
<script>
    $('#sub_title_sec').hide();
    $('#extra_content_sec').hide();
    $('#sub_image_sec').hide();
</script>
@elseif(isset($segment[2]) && $segment[2] == '6')
<script>
    $('#sub_title_sec').hide();
    $('#extra_content_sec').hide();
    $('#sub_image_sec').hide();
</script>
@elseif(isset($segment[2]) && $segment[2] == '7')
<script>
    $('#extra_content_sec').hide();
</script>
@elseif(isset($segment[2]) && $segment[2] == '8')
<script>
    $('#sub_title_sec').hide();
    $('#extra_content_sec').hide();
    $('#sub_image_sec').hide();
</script>
@elseif(isset($segment[2]) && $segment[2] == '9')
<script>

</script>
@elseif(isset($segment[2]) && $segment[2] == '10')
<script>
    $('#sub_title_sec').hide();
    $('#extra_content_sec').hide();
    $('#image_sec').hide();
    $('#sub_image_sec').hide();
</script>
@elseif(isset($segment[2]) && $segment[2] == '11')
<script>
    $('#sub_title_sec').hide();
    $('#extra_content_sec').hide();
    $('#image_sec').hide();
    $('#sub_image_sec').hide();
    
</script>
@elseif(isset($segment[2]) && $segment[2] == '12')
<script>
    $('#sub_title_sec').hide();
    $('#extra_content_sec').hide();
    
    $('#sub_image_sec').hide();
</script>
@elseif(isset($segment[2]) && $segment[2] == '13')
<script>
    $('#sub_title_sec').hide();
    $('#extra_content_sec').hide();
    $('#image_sec').hide();
    $('#sub_image_sec').hide();
</script>
@elseif(isset($segment[2]) && $segment[2] == '14')
<script>
    $('#sub_title_sec').hide();
    $('#extra_content_sec').hide();
    $('#image_sec').hide();
    $('#sub_image_sec').hide();
</script>
@elseif(isset($segment[2]) && $segment[2] == '15')
<script>
    $('#sub_title_sec').hide();
    $('#extra_content_sec').hide();
    $('#image_sec').hide();
    $('#sub_image_sec').hide();
</script>
@endif

@endpush
