<?php // any valid date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// always modified right now
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// HTTP/1.1
header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
// HTTP/1.0
header("Pragma: no-cache");?>

<!doctype html>
<html lang="en">

<head>
    <title>Tu Imagen Deportiva</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-3.3.1.slim.min.js')}}"></script>
    <link rel="shortcut icon" href="{{asset('image/fav-icon.ico')}}">

</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Menu Desplegable</span>
                </button>
            </div>
            <h1><a href="{{route('writer.articles.published')}}" class="logo">ESCRITOR</a></h1>
            <ul class="list-unstyled components mb-5">

                <div>
                    <div class="profile-userpic">
                        <img src="{{auth()->user()->avatar}}" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{auth()->user()->username}}
                        </div>
                        <div class="profile-usertitle-job">
                            @if(auth()->user()->permissions == 'ADMIN')
                            Administrador
                            @else
                            Escritor
                            @endif
                        </div>
                    </div>
                </div>

                <li class="top-border">
                    <a href="{{route('home')}}"><span class="fa fa-home mr-3"></span> Ir al Home</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                        <span class="fa fa-sign-out mr-3"></span>{{ __('Logout') }}
                    </a>
                </li>

                <li class="separador top-border">
                    <a href="{{route('writer.categories.index')}}"><span class="fa fa-th mr-3"></span> Categorías</a>
                </li>

                <li>
                    <a href="#articleSubmenu" data-toggle="collapse" aria-expanded="false"><span
                            class="fa fa-newspaper-o mr-3"></span>Mis Artículos<span
                            class="fa fa-sort-desc pull-right"></span></a>
                    <ul class="collapse list-unstyled" id="articleSubmenu">
                        <li>
                            <a href="{{route('writer.articles.create')}}"><span
                                class="fa fa-plus mr-3"></span>Nuevo</a>
                        </li>
                        <li>
                            <a href="{{route('writer.articles.published')}}"><span
                                    class="fa fa-check mr-3"></span>Publicados</a>
                        </li>
                        <li>
                            <a href="{{route('writer.articles.review')}}"><span class="fa fa-clock-o mr-3"></span>En
                                Revisión @if($notification != 0 )<span class="badge badge-danger">{{$notification}}
                                    @endif</span></a>
                        </li>
                        <li>
                            <a href="{{route('writer.articles.rejected')}}"><span
                                    class="fa fa-times mr-3"></span>Rechazados</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

        <!-- Page Content  -->

        <div id="content" class="p-1 p-md-5 pt-5">
            @if(count($errors))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ups! pasó lo siguiente: </strong><br>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @yield("content")
        </div>
    </div>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    @yield('scripts')
</body>

</html>