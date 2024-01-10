<?php 
$segment = Request::segments();
?>


<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-12 control-label']) !!}
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

@if(isset($segment) && $segment[2] != 'create')
<!-- active -->
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('is_active') ? 'has-error' : ''}}">
    
    <div class="col-md-12">
        <label for="is_active" class="col-md-12 control-label"><input type="checkbox" name="is_active" value="1" @if($category->is_active == '1') checked @endif > Active</label>
        
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
@endpush
