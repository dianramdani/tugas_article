@extends("layouts.application")
@section("content")
<div>
    {{link_to('galleries/create', 'Upload Image', array('class' => 'btn btn-success'))}}
    <p></p>
</div>
    @if (Session::has('notice'))
        <div class="alert alert-info">{{Session::get('notice')}}</div>
    @endif
    
       
        <div class="row">
         @foreach ($galleries as $gallery)
            <div class="col-md-3">
           
                <div class="thumbnail">
                        
                            <a href="galleries/{{$gallery->id}}">
                               {{HTML::image('/upload_gambar/'.$gallery->id.'/thumb-'.$gallery->image,'picture',array('class'=>'thumb'))}}
                            </a>
                            <p class="caption">{{$gallery->title}}</p>
                            <i>By {{$gallery->user}}</i>
                            <div>    
                               {{link_to('galleries/'.$gallery->id.'/edit', 'Edit', array('class' =>'btn btn-warning'))}}
        
                               {{ Form::open(array('route' => array('galleries.destroy', $gallery->id),'method' => 'delete')) }}
                               {{ Form::submit('Delete', array('class' => 'btn btn-danger',"onclick" => "return confirm('are you sure?')")) }}
                               {{ Form::close() }}
                            </div>                
                       
                </div>
            
            </div>
        @endforeach
            
        </div>
    
    
<?php echo $galleries->links(); ?>
@stop