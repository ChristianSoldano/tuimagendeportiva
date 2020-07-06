@extends('layout')

@section('openGraph')
    <meta name="description" content="{{$article->excerpt}}">
    <meta name="image" content="{{$article->image}}">
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="{{$article->title}}">
    <meta itemprop="description" content="{{$article->excerpt}}">
    <meta itemprop="image" content="{{$article->image}}">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{$article->title}}">
    <meta name="twitter:description" content="{{$article->excerpt}}">
    <meta name="twitter:site" content="@TuImagenDepor">
    <meta name="twitter:creator" content="@TuImagenDepor">
    <meta name="twitter:image:src" content="{{$article->image}}">
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:title" content="{{$article->title}}">
    <meta name="og:description" content="{{$article->excerpt}}">
    <meta name="og:image" content="{{$article->image}}">
    <meta name="og:url" content="https://www.tuimagendeportiva.com/articulo/{{$article->slug}}">
    <meta name="og:site_name" content="{{$article->title}}">
    <meta name="og:locale" content="es_ES">
    <meta name="og:type" content="article">
    <!-- Open Graph - Article -->
    <meta name="article:section" content="{{$article->category->name}}">
    <meta name="article:author" content="Tu Imagen Deportiva">
    <meta name="article:tag" content="{{$article->category->name}}">
@endsection

@section('SDK')
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v6.0">
</script>
@endsection

@section('content')

<!-- Post Content Column -->
<div class="col-lg-8">

    <div class="card my-4">

        <div class="card-header">
            <h1 style = "font-family:times-new-roman;">{{$article->title}}</h1>

        </div>
        <div class="card-body">
            <!-- Preview Image -->
            <img class="img-fluid rounded" src="{{$article->image}}" alt="">

            <hr>

            <p>
                Categoría: <a
                    href="{{route('selectByCategory', $article->category->slug)}}">{{$article->category->name}}</a>
                <br>
                Publicado el {{$article->created_at->formatLocalized('%A de %d de %B de %Y')}} a
                las {{$article->created_at->format('H:i')}}
                <br>
                Autor: <a href="{{route('user.profile',$article->user->username)}}">{{$article->user->username}}</a>
            </p>
            <div class="row ml-1">
                <div class="fb-share-button" data-href="https://www.tuimagendeportiva.com/articulo/{{$article->slug}}"
                    data-layout="button" data-size="large">
                </div>

                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large"
                    data-url="https://www.tuimagendeportiva.com/articulo/{{$article->slug}}" data-lang="es"
                    data-show-count="false" data-text="{{$article->title}}">Tweet</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>

            <hr>
            <div class="container">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:block; text-align:center;"
                 data-ad-layout="in-article"
                 data-ad-format="fluid"
                 data-ad-client="ca-pub-1299160852377446"
                 data-ad-slot="2485329168"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            </div>
            <hr>

            <!-- Post Content -->
            {!! $article->body!!}

            <hr>


            <!-- Comments Form -->
            @auth
            <div class="card my-4">
                <h5 class="card-header">Deja un comentario:</h5>
                <div class="card-body">
                    {!! Form::open(['route' => ['comments.comment', $article->slug]])!!}
                    {{Form::hidden('user_id', auth()->user()->id)}}
                    {{Form::hidden('article_id', $article->id)}}
                    {{Form::textarea('commentary', null, ['class' => 'form-control commentary-textarea','name' => 'commentary', 'style' => 'height:100px;', 'placeholder' => 'Escriba su comentario'])}}
                    {{Form::submit('Comentar', ['class' => 'btn btn-success mt-3 pull-right', 'id' => 'submitCommentary', 'disabled'])}}
                    {!! Form::close()!!}
                </div>
            </div>
            @else
            <div class="card my-4">
                <h5 class="card-header">Inicia Sesion para comentar:</h5>
                <div class="card-body">
                    <textarea class="commentary-textarea form-control" style="height:150px;" disabled></textarea>

                </div>
            </div>
            @endauth
            <hr style="border-top: 1px solid #0000002a;">
            <!-- Single Comment -->
            @foreach($comments as $c)
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="{{$c->user->avatar}}" width="50px">
                <div class="media-body">
                    <p>
                        @auth
                        @if(auth()->user()->id == $c->user_id)
                        {!! Form::open(['route' => ['comments.destroy', $c->id], 'method' =>
                        'DELETE']
                        )!!}
                        @endif
                        @endauth
                        <a
                            href="{{route('user.profile',$c->user->username)}}"><strong>{{$c->user->username}}</strong></a>
                        | {{$c->created_at->diffForHumans()}}
                        @auth
                        @if(auth()->user()->id == $c->user_id)
                        <button type="submit" id="deleteButton" data-name="{{ $article->title }}"
                            class="badge badge-pill badge-danger"><span class="fa fa-trash"></span> Eliminar
                            comentario</button>
                        {!! Form::close() !!}
                        @endif
                        @endauth
                        <br>
                        <span style="font-size: 25px; color: #000000;">{{$c->commentary}}</span>
                    </p>
                    @foreach($replies as $r)

                    @if($r->comment_id == $c->id)
                    <div class="media mt-4">
                        <img class="d-flex mr-3 rounded-circle" src="{{$r->user->avatar}}" width="50px">
                        <div class="media-body">
                            <p>
                                @auth
                                @if(auth()->user()->id == $r->user_id)
                                {!! Form::open(['route' => ['comments.destroyReply', $r->id], 'method' =>
                                'DELETE']
                                )!!}
                                @endif
                                @endauth
                                <a
                                    href="{{route('user.profile',$c->user->username)}}"><strong>{{$c->user->username}}</strong></a>
                                | {{$r->created_at->diffForHumans()}}
                                @auth
                                @if(auth()->user()->id == $r->user_id)
                                <button type="submit" id="deleteButton" data-name="{{ $article->title }}"
                                    class="badge badge-pill badge-danger"><span class="fa fa-trash"></span> Eliminar
                                    comentario</button>
                                {!! Form::close() !!}
                                @endif
                                @endauth
                                <br> <span style="font-size: 25px; color: #000000;">{{$r->reply}}</span>

                            </p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @auth
                    <hr style="border-top: 1px solid #0000002a;">
                    <div class="media mb-4">
                        <img class="d-flex rounded-circle mt-2" src="{{auth()->user()->avatar}}" width="50px">
                        <div class="media-body mt-3 ml-3">
                            {!! Form::open(['route' => ['comments.reply', $article->slug]])!!}
                            {{Form::hidden('user_id', auth()->user()->id)}}
                            {{Form::hidden('article_id', $article->id)}}
                            {{Form::hidden('comment_id', $c->id)}}
                            {{Form::textarea('reply', null, ['class' => 'form-control commentary-textarea', 'placeholder' => 'Escriba su respuesta','name' => 'reply', 'style' => 'height:40px;'])}}
                            {{Form::submit('Responder', ['class' => 'btn btn-success mt-3 pull-right', 'id' =>'submitReply','disabled'])}}

                            {!! Form::close()!!}
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
            <hr style="border-top: 1px solid #0000002a;">
            @endforeach
        </div>
    </div>
</div>




@section('scripts')
<script>
    $('button#deleteButton').on('click', function(e){
    var name = $(this).data('name');
    e.preventDefault();
Swal.fire({
  title: '¿Estás seguro?',
  html: "Se eliminará su comentario.",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: "Cancelar",
  confirmButtonText: 'Si, Eliminar!'
})
.then ((result) => {
    if (result.value) {
       $(this).closest("form").submit();
    }
});
}); 

$('textarea[name=reply]').keyup(function(e){
    $(this).parent().find("#submitReply").attr("disabled", true);
    val = $(this).val().trim();    
    if(val.length > 0){
        $(this).parent().find("#submitReply").attr("disabled", false);
    }
});

$('textarea[name=commentary]').keyup(function(e){
    $(this).parent().find("#submitCommentary").attr("disabled", true);
    val = $(this).val().trim();    
    if(val.length > 0){
        $(this).parent().find("#submitCommentary").attr("disabled", false);
    }
});

</script>
@endsection


@endsection