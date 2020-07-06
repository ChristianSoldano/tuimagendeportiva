@extends('layout')

@section('openGraph')
<!-- Search Engine -->
<meta name="description" content="Somos un grupo de personas que nos dedicamos de forma apasionante de hablar de los deportes que nos gustan y amamos.">
<meta name="image" content="https://www.tuimagendeportiva.com/image/escudo-index.png">
<!-- Schema.org for Google -->
<meta itemprop="name" content="Tu Imagen Deportiva | Noticias deportivas">
<meta itemprop="description" content="Somos un grupo de personas que nos dedicamos de forma apasionante de hablar de los deportes que nos gustan y amamos.">
<meta itemprop="image" content="https://www.tuimagendeportiva.com/image/escudo-index.png">
@endsection

@section('content')

<div class="col-lg-9">
    
    @if(!$articles->isEmpty())
    <div class="row mt-4 mb-3">
        <div class="card h-100">
            <a href="{{route('viewArticle', $articles[0]->slug)}}"><img class="card-img-top"
                    src="{{ $articles[0]->image}}" alt=""></a>
            <div class="card-body">
                <h3 class="card-title font-weight-bold"><a style = "font-family:times;" href="{{route('viewArticle',$articles[0]->slug)}}">{{$articles[0]->title}}</a></h3>
              
              <h5><small>Publicado {{$articles[0]->created_at->diffForHumans()}}</small></h5>
              
                Autor: <a href="{{route('user.profile',$articles[0]->user->username)}}">{{$articles[0]->user->username}}</a>
                 
                <p class="card-text">{{$articles[0]->excerpt}}</p>
            </div>
        </div>
    </div>
    @else
    
    <div class="alert alert-danger mt-4" role="alert">
        <h4 class="alert-heading">Ups! <i class="fa fa-frown-o" aria-hidden="true"></i></h4>
        <hr>
        <p style="font-size: 20px;">No encontramos artículos relacionados a la busqueda.</p>
    </div>

    @endif
    
    <div class="container">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- home medio -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-1299160852377446"
             data-ad-slot="7488382014"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    <div class="row mt-4">
        @foreach($articles as $article)
        @if($loop->index != 0)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <a href="{{route('viewArticle', $article->slug)}}"><img class="card-img-top" src="{{ $article->image}}"
                        alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a style = "font-family:times;" href="{{route('viewArticle', $article->slug)}}">{{$article->title}}</a>
                    </h4>
                    <h5><small>Publicado {{$article->created_at->diffForHumans()}}</small></h5>
                    Autor: <a href="{{route('user.profile',$article->user->username)}}">{{$article->user->username}}</a>
                    <p class="card-text">{{$article->excerpt}}</p>
                </div>
            </div>
        </div>
        @endif
        @endforeach


    </div>
    <div class="d-flex justify-content-center">{{$articles->render()}}</div>
</div>

</div>
<!-- /.row -->

</div>
<!-- /.col-lg-9 -->

</div>

</div>
<!-- /.row -->

</div>
<!-- /.container -->


<!-- Footer -->


<!-- Bootstrap core JavaScript -->

@endsection