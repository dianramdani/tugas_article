@extends("layouts.application")
@section("content")
{{Form::open(array('url' => 'galleries', 'class' => 'form-horizontal','role' => 'form', 'enctype' => 'multipart/form-data'))}}
<div class="form-group">
    {{Form::label('title', 'Title', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-9">
        {{Form::text('title', null, array('class' => 'form-control','autofocus' => 'true'))}}
        <p class="text-danger">{{$errors->first('title')}}</p>
    </div>
    <div class="clear"></div>
</div>
<div class="form-group">
    {{Form::label('image', 'Image', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-9">
        {{Form::file('image', null, array('class' => 'form-control'))}}
        <p class="text-danger">{{$errors->first('image')}}</p>
    </div>
    <div class="clear"></div>
</div>
<div class="form-group">
    {{Form::label('user', 'User', array('class' => 'col-lg-3 control-label'))}}
    <div class="col-lg-9">
        {{Form::text('user', null, array('class' => 'form-control'))}}
        <p class="text-danger">{{$errors->first('user')}}</p>
    </div>
    <div class="clear"></div>
</div>
<div class="form-group">
    <div class="col-lg-3"></div>
        <div class="col-lg-9">
        {{Form::submit('Save', array('class' => 'btn btn-primary'))}}
        </div>
    <div class="clear"></div>
</div>
{{Form::close()}}
@stop