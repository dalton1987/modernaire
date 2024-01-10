<?php
$segment = Request::segments()
?>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('question') ? 'has-error' : ''}}">
    {!! Form::label('question', 'Question', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('question', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('question', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('Answer') ? 'has-error' : ''}}">
    {!! Form::label('Answer', 'Answer', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::textarea('Answer', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('Answer', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if(isset($segment) && $segment[2] != 'create') 
<!-- active -->
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('is_active') ? 'has-error' : ''}}">
    
    <div class="col-md-12">
        <label for="is_active" class="col-md-12 control-label"><input type="checkbox" name="is_active" value="1" @if($faq->is_active == '1') checked @endif > Active faq</label>
        
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>


@endif

<div class="form-group row justify-content-center">
    <div class="col-lg-4 col-12 align-content-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
