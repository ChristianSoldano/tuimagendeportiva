<nav class="navbar navbar-light navbar-expand-sm bg-white shadow-sm">
    <div class="container">
        <img src="{{asset('image/escudo.png')}}" class="img-fluid" alt="Responsive image" width="50" height="50">
        <a class="navbar-brand" href="{{route('home')}}">{{config('app.name')}}</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- justify-content-end para mover los items del nav a la derecha --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Items a la izquierda -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item d-none d-md-block d-lg-none d-none d-sm-block d-md-none mt-1">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarTogglerCategoriesSM" aria-expanded="false" aria-label="Toggle navigation">
                        Categorías<span class="fa fa-bars ml-1"></span>
                    </a>
                </li>
            </ul>
            {{-- Items de la derecha --}}
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item avatar dropdown">
                    <a class="nav-link dropdown-toggle mr-2" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset(Auth::user()->avatar) }}"
                            class="profile-avatar rounded-circle z-depth-0 mr-3"
                            alt="avatar image">{{ Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
                        aria-labelledby="navbarDropdownMenuLink-55">
                        @if(Auth::user()->permissions == 'ADMIN')
                        <a class="dropdown-item" href="{{ route('admin.index') }}"><span
                                class="fa fa-table mr-3"></span>Panel de Administración</a>
                        @endif
                        @if(Auth::user()->permissions == 'WRITER')
                        <a class="dropdown-item" href="{{ route('writer.articles.published') }}"><span
                                class="fa fa-table mr-3"></span>Panel de Escritor</a>
                        @endif
                        <a class="dropdown-item" href="{{route('user.profile', auth()->user()->username)}}"><span
                                class="fa fa-user mr-3"></span> Perfil</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <span class="fa fa-sign-out mr-3"></span>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
                <li class="nav-item d-block d-sm-none">
                    
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#navbarTogglerCategoriesSM"
                        aria-controls="navbarTogglerCategoriesSM" aria-expanded="false" aria-label="Toggle navigation">
                        Categorías<span class="fa fa-bars ml-1"></span>
                    </a>

                    <nav class="navbar navbar-expand-lg navbar-light bg-light d-block d-sm-none">

                        <div class="collapse navbar-collapse" id="navbarTogglerCategoriesSM">
                            {!! Form::open(['route' => 'home', 'method' => 'GET'])!!}

                            {!! Form::text('searchTerm',null, ['class' => 'form-control mb-1', 'placeholder' =>'Buscar'])!!}
                            @if($search !=null)
                            <a class="btn btn-danger my-2 my-sm-0" href="{{route('home')}}" role="button"><i class="fa fa-times"
                                    aria-hidden="true"></i> {{$search}} </a>
                            @endif
                            {!! Form::close()!!}
                            <ul class="nav">
                                @foreach($categories as $category)
                                <li class="nav-item mr-3">
                                    <a class="nav-link"
                                        href="{{route('selectByCategory', $category->slug)}}">{{$category->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </nav>
                </li>
            </ul>
        </div>
</nav>


<nav class="navbar navbar-expand-lg navbar-light bg-light d-none d-md-block d-lg-none d-none d-sm-block d-md-none">
    <div class="collapse navbar-collapse" id="navbarNav">

        
        {!! Form::open(['route' => 'home', 'method' => 'GET'])!!}
        {!! Form::text('searchTerm',null, ['class' => 'form-control mb-1', 'placeholder' =>'Buscar'])!!}
        @if($search !=null)
        <a class="btn btn-danger my-2 my-sm-0" href="{{route('home')}}" role="button"><i class="fa fa-times"
                aria-hidden="true"></i> {{$search}} </a>
        @endif
        {!! Form::close()!!}

        <ul class="nav">
            @foreach($categories as $category)
            <li class="nav-item">
                <a class="nav-link mr-3" href="{{route('selectByCategory', $category->slug)}}"
                    style="color:rgba(0, 0, 0, 0.5);">{{$category->name}}</a>
            </li>
            @endforeach
        </ul>
    </div>
</nav>