<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('category') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::Label('category', 'Category') !!}
      
        <select required="" class="form-control" id="category" name="category">
          
            <option selected="" disabled="">Select Category</option>
            @foreach($category as $key=>$data)

            <option @if($motoroption->category == $data->id) selected @endif value="{{$data->id}}">{{$data->category}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::text('title', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">
        {!! Form::textarea('description', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'col-md-12 control-label']) !!}
    <div class="col-md-12">

        <div class="max-text">
        <img alt="" class="img-responsive" id="banner1" 
        src="{{ isset($motoroption)?asset($motoroption->image):asset('images/upload.jpg') }}" style=" width: 15%; "> 
        <br/>
      </div>
        <br/>

        {!! Form::file('image', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>




<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('is_active') ? 'has-error' : ''}}">
    
    <div class="col-md-12">

        <label class="css-control css-control-success css-switch">
            <input type="checkbox" class="css-control-input" value="1" name="is_active" @if($motoroption->is_active == '1') checked @endif>
            <span class="css-control-indicator"></span> Active
        </label>

        
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row justify-content-center">
    <div class="col-lg-4 col-12 align-content-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>




<style>
/*checkbox switch*/
.css-switch {
    padding: 3px 0!important;
}
.css-control {
    position: relative!important;
    display: inline-block!important;
    padding: 6px 0!important;
    margin: 0!important;
    font-weight: 400!important;
    font-size: 1rem!important;
    cursor: pointer!important;
}
.css-switch.css-control-success .css-control-input:checked~.css-control-indicator {
    background-color: #9ccc65!important;
}

.css-switch .css-control-input:checked~.css-control-indicator {
    background-color: #ddd!important;
}
.css-switch .css-control-input~.css-control-indicator {
    width: 51px!important;
    height: 30px!important;
    background-color: #eee!important;
    border-radius: 30px!important;
    transition: background-color .3s!important;
}
.css-control-input~.css-control-indicator {
    position: relative!important;
    display: inline-block!important;
    margin-top: -3px!important;
    margin-right: 3px!important;
    vertical-align: middle!important;
}
.css-switch .css-control-input:checked~.css-control-indicator::after {
    box-shadow: -2px 0 3px rgba(0,0,0,.3)!important;
    -webkit-transform: translateX(20px)!important;
    transform: translateX(20px)!important;
}

.css-switch .css-control-input~.css-control-indicator::after {
    top: 2px!important;
    bottom: 2px!important;
    left: 2px!important;
    width: 26px!important;
    background-color: #fff!important;
    border-radius: 50%!important;
    box-shadow: 1px 0 3px rgba(0,0,0,.1)!important;
    transition: -webkit-transform .15s ease-out!important;
    transition: transform .15s ease-out!important;
    transition: transform .15s ease-out,-webkit-transform .15s ease-out!important;
}
.css-control-input~.css-control-indicator::after {
    position: absolute;
    content: '';
}
input[type=checkbox], input[type=radio] {
    box-sizing: border-box;
    padding: 0;
}
.css-control-input {
    position: absolute;
    z-index: -1;
    opacity: 0;
}
/*checkbox switch*/
</style>
