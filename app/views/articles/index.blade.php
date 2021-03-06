@extends("layouts.application")
@section("content")
<div>
    {{link_to('articles/create', 'Write Article', array('class' => 'btn btn-success'))}}
    {{link_to('import', 'Import Articles From Excel', array('class' => 'btn btn-info'))}}
</div>
    @if (Session::has('notice'))
        <div class="alert alert-info">{{Session::get('notice')}}</div>
    @endif
    @foreach ($articles as $article)
    <div>
        <h1>{{$article->title}}</h1>
        <p>{{$article->content}}</p>
        <i>By {{$article->author}}</i>
    <div>
    {{link_to('articles/'.$article->id, 'Show', array('class' => 'btn btn-info'))}}
    {{link_to('articles/'.$article->id.'/edit', 'Edit', array('class' =>'btn btn-warning'))}}
    
    <!-- {{link_to('articles/'.$article->id, 'Delete', array('class' =>
    'btn btn-danger', 'method' => 'DELETE', "onclick" => "return confirm('are you sure?')"))}} -->
    {{ Form::open(array('route' => array('articles.destroy', $article->id),'method' => 'delete')) }}
    {{ Form::submit('Delete', array('class' => 'btn btn-danger',"onclick" => "return confirm('are you sure?')")) }}
    {{ Form::close() }}
    </div>
</div>
@endforeach
<?php echo $articles->links(); ?>
@stop