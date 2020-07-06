<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tu Imagen Deportiva</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/secondary.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-3.3.1.slim.min.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <link rel="shortcut icon" href="{{asset('image/fav-icon.ico')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    @yield('openGraph')
    
    <script src="{{ asset('js/app.js') }}" defer></script>
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
    
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
    <script>
        window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "#17344d",
          "text": "#ffffff"
        },
        "button": {
          "background": "#e69f25",
          "text": "#000000"
        }
      },
      "position": "bottom-right",
      "content": {
        "message": "Utilizamos cookies propias y de terceros para mejorar la experiencia del usuario a través de su navegación. Si continuas navegando aceptas su uso. ",
        "dismiss": "Acepto",
        "link": "Leer más.",
        "href": "https://www.tuimagendeportiva.com/cookies"
      }
    });
    </script>
    
    @yield('SDK')
    <div id='app'>
        @include("partials/nav")
        <div class="container">
            <div class="row">
                @include('partials/categories')
                @yield("content")
            </div>
        </div>

        

        <footer class="py-5 bg-dark mt-5">
            <div class="container">
                <p class="m-0 text-center text-white">Derechos Reservados &copy; Tu imagen Deportiva 2020</p>
                <p class="m-0 text-center"> <a class="text-secondary" href="{{route('cookies')}}">Política de Cookies</a></p>

            </div>
            <!-- /.container -->
        </footer>

    </div>
    @yield('scripts')
</body>

</html>