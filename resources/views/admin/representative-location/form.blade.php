<?php 
$segment = Request::segments();
?>

<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('Name') ? 'has-error' : ''}}">
    {!! Form::label('Name', 'Name', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('Name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if(isset($segment) && $segment[2] != 'create')
<!-- active -->
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('is_active') ? 'has-error' : ''}}">
    
    <div class="col-md-12">
        <label for="is_active" class="col-md-12 control-label"><input type="checkbox" name="is_active" value="1" @if($testimonial->is_active == '1') checked @endif > Active</label>
        
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif



<div class="form-group row justify-content-center">
    <div class="col-lg-4 col-12 align-content-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
