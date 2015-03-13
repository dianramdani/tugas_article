<div class="navbar navbar-fixed-top navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"/>
                <span class="icon-bar"/>
                <span class="icon-bar"/>
            </button>
            <a href="#" class = "navbar-brand">Trainings</a>
        </div>
        <div class="collapse navbar-collapse">
       
            <ul class="nav navbar-nav navbar-right">
                <li>{{link_to('home','Home')}}</li>
                <li>{{link_to('galleries','Gallery')}}</li>
                <li>{{link_to('articles','Articles')}}</li>
                <li>{{link_to('users/create', 'Signup')}}</li>
               
                @if (Auth::check())
                <li>
                    {{ Form::open(array('route' => array('sessions.destroy'), 'method' =>'delete')) }}
                    {{ Form::submit('Logout', array('class' => 'btn btn-normal')) }}
                    {{ Form::close() }}
                </li>
                @else
                <li>{{link_to('sessions/create', 'Login')}}</li>
                @endif
                
            </ul>
        </div>
    </div>
</div>