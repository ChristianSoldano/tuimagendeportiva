<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tu Imagen Deportiva</title>
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="{{asset('css/secondary.css')}}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link rel="shortcut icon" href="{{asset('image/fav-icon.ico')}}">
  <script data-ad-client="ca-pub-1299160852377446" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158693912-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-158693912-1');
    </script>

</head>

<body>
  <div id='app'>
    @include("partials/nav")
    <div class="container">
      <div class="row">
        @include('partials/categories')
        <div class="col-lg-9 mt-5">
          <div class="text-center">
            <h2>{{$user->username}}</h2>
            <img src="{{$user->avatar}}" width="300" height="300">
            <br>

            <small>{{$user->name . " " . $user->lastname}}</small>
            @if($user->permissions == 'ADMIN')
            <h2>ADMINISTRADOR</h2>
            @endif
            @if($user->permissions == 'WRITER')
            <h2>ESCRITOR</h2>
            @endif
            @if($user->permissions == 'USER')
            <h2>USUARIO</h2>
            @endif

            @if(Auth::check() && $user->id == auth()->user()->id)

            <a href="{{route('user.profile.edit', auth()->user()->username)}}" class="btn btn-primary btn-sm">
              Editar Perfil</span>
            </a>

            @endif
            <hr>
            
            <div class="panel panel-default">
              <div class="panel-heading text-center">Redes</div>
              <div class="panel-body text-center">
                @foreach($socialNetworks as $sn)
                @if($sn->name == 'FACEBOOK')
                <a href="{{$sn->url}}" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>
                @endif
                @if($sn->name == 'INSTAGRAM')
                <a href="{{$sn->url}}" target="_blank"><i class="fa fa-instagram fa-2x"></i></a>
                @endif
                @if($sn->name == 'TWITTER')
                <a href="{{$sn->url}}" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
                @endif
                @endforeach
              </div>
            </div>
            
            <hr>
            <div class="row justify-content-center">
              <div class="col-9">
                <ul class="list-group">
                  <li class="list-group-item text-muted">Actividad <i class="fa fa-dashboard fa-1x ml-1"></i>
                  </li>
                  @if($user->permissions != 'USER')
                  <li class="list-group-item text-right"><span class="pull-left"><strong><i
                          class="fa fa-newspaper-o fa-1x mr-3"></i>Publicaciones</strong></span>
                    {{$posts}}
                  </li>
                  @endif

                  <li class="list-group-item text-right"><span class="pull-left"><strong><i
                          class="fa fa-comment-o fa-1x mr-3"></i>Comentarios</strong></span>
                    {{$comments}}
                  </li>
                </ul>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>

    <footer class="py-5 bg-dark mt-5">
      <div class="container">
        <p class="m-0 text-center text-white">Derechos Reservados &copy; Tu imagen Deportiva 2020</p>
      </div>
      <!-- /.container -->
    </footer>
  </div>

</body>

</html>