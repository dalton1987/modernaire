<?php 
$segment = Request::segments();

$category = DB::table('gallery_categories')->where('is_active', '1')->where('deleted_at', null)->pluck('name', 'slug');

?>



<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('type') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::Label('type', 'Type') !!}
        
        <select required="" class="form-control" id="type" name="type">
            <option selected="" disabled="">Select Category</option>
            @foreach($category as $key=>$data)
            <option @if($gallery->type == $key) selected @endif value="{{$key}}">{{$data}}</option>
            @endforeach
        </select>

        <!--<select required="" class="form-control" id="type" name="type">-->
        <!--    <option selected="" disabled="">Select Type</option>-->
        <!--    @foreach($gallery_options as $key=>$data)-->
        <!--    <option @if($gallery->type == $data->name) selected @endif value="{{$data->name}}">{{$data->name}}</option>-->
        <!--    @endforeach-->
        <!--</select>-->
    </div>
</div>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

        <div class="max-text">
        <img alt="" class="img-responsive" id="banner1" 
        src="{{ isset($gallery)?asset($gallery->image):asset('images/upload.jpg') }}" style=" width: 30%; "> 
        <br/>
      </div>
        <br/>


        {!! Form::file('image', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>


@if(isset($segment) && $segment[2] != 'create')
<!-- active -->
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('is_active') ? 'has-error' : ''}}">
    
    <div class="col-md-12">
        <label for="is_active" class="col-md-12 control-label"><input type="checkbox" name="is_active" value="1" @if($gallery->is_active == '1') checked @endif > Active</label>
        
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif




<div class="form-group row justify-content-center">
    <div class="col-lg-4 col-12 align-content-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>



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

@endpush