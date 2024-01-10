<?php 
$segment = Request::segments();
?>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('dealer_id') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::Label('dealer_id', 'Dealer') !!}

        <select required="" class="form-control" id="dealer_id" name="dealer_id" @if(isset($segment[3]) && $segment[3] == 'edit') disabled @endif>
            <option selected="" disabled="">Select Dealer</option>
            @foreach($dealer_id as $key=>$data)
            <option @if($dealeraccount->dealer_id == $key) selected @endif value="{{$key}}">{{$data}}</option>
            @endforeach
        </select>
    </div>
</div>



<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::email('email', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', 'Password', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        <input class="form-control" name="password" type="password" id="password">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
    {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        <input class="form-control" name="password_confirmation" type="password" id="password_confirmation">
        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
    </div>
</div>




<div class="form-group row justify-content-center">
    <div class="col-lg-4 col-12 align-content-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
