<div class="col-lg-3 d-none d-lg-block">

    <br>
    <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('image/escudo-index.png')}}" class="img-fluid"></a>
    <br><br>
    <div class="list-group mr-3">
        {!! Form::open(['route' => 'home', 'method' => 'GET'])!!}

        {!! Form::text('searchTerm',null, ['class' => 'form-control mb-1', 'placeholder' =>'Buscar'])!!}
        @if($search !=null)
        <a class="btn btn-danger my-2 my-sm-0" href="{{route('home')}}" role="button"><i class="fa fa-times"
                aria-hidden="true"></i> {{$search}} </a>
        @endif
        {!! Form::close()!!}
        <br>
        @foreach($categories as $category)
        <a href="{{route('selectByCategory', $category->slug)}}" class="list-group-item" style="color:rgba(0, 0, 0, 0.5);">{{$category->name}}</a>
        @endforeach
    </div>
    <br>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Principal -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1299160852377446"
     data-ad-slot="2121532937"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>