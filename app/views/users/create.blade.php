@extends("layouts.application")
@section("content")
{{Form::open(array('url' => 'users', 'class' => 'form-horizontal','role' => 'form'))}}
<div class="form-group">
    
    {{Form::label('email', 'Email', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-6">
        {{Form::email('email', null, array('class' => 'form-control','autofocus' => 'true'))}}
        @if ($errors->has('email')) <p class="text-danger">{{ $errors->first('email') }}</p> @endif
    </div>
    <div class="clear"></div>
</div>
    
<div class="form-group">
    {{Form::label('username', 'Username', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-6">
        {{Form::text('username', null, array('class' => 'form-control'))}}
        @if ($errors->has('username')) <p class="text-danger">{{ $errors->first('username') }}</p> @endif
    </div>
    <div class="clear"></div>
</div>
    
<div class="form-group">
    {{Form::label('password', 'Password', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-6">
        {{Form::password('password', array('class' => 'form-control','autofocus'=>'true'))}}
        @if ($errors->has('password')) <p class="text-danger">{{ $errors->first('password') }}</p> @endif
    </div>
    <div class="clear"></div>
</div>
    
<div class="form-group">
    {{Form::label('password', 'Confirm Password', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-6">
        {{Form::password('password_confirmation', array('class' => 'form-control','autofocus'=>'true'))}}
        @if ($errors->has('password')) <p class="text-danger">{{ $errors->first('password') }}</p> @endif
    </div>
    <div class="clear"></div>
</div>
    
<div class="form-group">
    <div class="col-lg-3"></div>
        <div class="col-lg-9">
        {{Form::submit('SigUp', array('class' => 'btn btn-primary'))}}
        </div>
    <div class="clear"></div>
</div>
{{Form::close()}}
@stop