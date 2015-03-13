@extends("layouts.application")
@section("content")
@if (Session::has('notice')) <div class="alert alert-info">{{Session::get('notice')}}</div> @endif
@if (Session::has('error')) <div class="alert alert-danger">{{Session::get('error')}}</div> @endif

{{Form::open(array('url' => 'sessions', 'class' => 'form-horizontal','role' => 'form'))}}
    
<div class="form-group">
    {{Form::label('username', 'Username', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-6">
        {{Form::text('username', null, array('class' => 'form-control','autofocus'=>'true'))}}
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
    {{Form::label('checkbox', 'Remember Me', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-6">
        {{Form::checkbox('remember', null, array('class' => 'form-control','autofocus'=>'true'))}}
    </div>
    <div class="clear"></div>
</div>
    
<div class="form-group">
    <div class="col-lg-3"></div>
        <div class="col-lg-9">
        {{Form::submit('Login', array('class' => 'btn btn-primary'))}}
        </div>
    <div class="clear"></div>
</div>
{{Form::close()}}
<i>{{link_to('reset-password/', 'Forgot Password')}}</i>
@stop