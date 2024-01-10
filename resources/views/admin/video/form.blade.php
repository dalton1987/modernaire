<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('designed_by') ? 'has-error' : ''}}">
    {!! Form::label('designed_by', 'Designed By', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('designed_by', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('designed_by', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('location') ? 'has-error' : ''}}">
    {!! Form::label('location', 'Location', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('location', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('video') ? 'has-error' : ''}}">
    {!! Form::label('video', 'Video', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">


        @if($video->video != '')
        <video width="200" height="150" controls>
          <source src="{{ asset($video->video) }}" type="video/mp4">
        Your browser does not support the video tag.
        </video>
        <br>
        @endif

        {!! Form::file('video', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('video', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('thumbnail') ? 'has-error' : ''}}">
    {!! Form::label('thumbnail', 'Thumbnail', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

        <div class="max-text">
        <img alt="" class="img-responsive" id="banner1" 
        src="{{ isset($video)?asset($video->thumbnail):asset('images/upload.jpg') }}" style=" width: 15%; "> 
        <br/>
      </div>
        <br/>

        {!! Form::file('thumbnail', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('thumbnail', '<p class="help-block">:message</p>') !!}
    </div>
</div>



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

$("#thumbnail").change(function() {
  readURL(this);
});
</script>

@endpush