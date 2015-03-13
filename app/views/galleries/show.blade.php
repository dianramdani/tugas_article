@extends("layouts.application")
@section("content")
<div>
    {{link_to('galleries/create', 'Upload Image', array('class' => 'btn btn-success'))}}
    <p></p>
</div>
    @if (Session::has('notice'))
        <div class="alert alert-info">{{Session::get('notice')}}</div>
    @endif
    
    <div>
    
        {{HTML::image('/upload_gambar/'.$gallery->id.'/image-'.$gallery->image,'picture')}}
    
        <p>{{$gallery->title}}</p>
        <i>By {{$gallery->user}}</i>
    </div>
    
@stop