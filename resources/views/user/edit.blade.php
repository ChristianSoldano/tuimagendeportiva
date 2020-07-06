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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158693912-1"></script>
    <link rel="shortcut icon" href="{{asset('image/fav-icon.ico')}}">
    <script data-ad-client="ca-pub-1299160852377446" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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

                    {!! Form::model($user, ['route' => ['user.profile.update', $user->id], 'method' => 'PATCH', 'files'
                    =>
                    true])!!}
                    {{Form::hidden('id', auth()->user()->id)}}

                    <div class="form-group">
                        <!-- Upload image input-->
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <!-- Uploaded image area-->
                                <div class="image-area mt-4"><img id="imageResult" src="{{$user->avatar}}" alt=""
                                        class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                <br>
                                <span id="spanSize"></span>
                                <h5 id="size" class="d-inline"></h5>
                                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-light shadow-sm">

                                    {{Form::file('avatar',['class' => 'form-control border-0', 'id' => 'upload', 'onchange' => 'readURL(this);'])}}


                                    <label id="upload-label" for="upload"
                                        class="font-weight-light text-dark text-light">Seleccionar
                                        archivo</label>


                                    <div class="input-group-append">
                                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i
                                                class="fa fa-cloud-upload mr-2 text-muted"></i><small
                                                class="text-uppercase font-weight-bold text-muted">Seleccionar</small></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('username', 'Usuario')}}
                        <h3>{{$user->username}}</h3>
                    </div>
                    <div class="form-group">
                        {{Form::label('email', 'Email')}}
                        <h3>{{$user->email}}</h3>
                    </div>

                    <div class="form-group">
                        {{Form::label('name', 'Nombre')}}
                        {{Form::text('name', null, ['class' => 'form-control', 'id' => 'name' ])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('lastname', 'Apellido')}}
                        {{Form::text('lastname', null, ['class' => 'form-control', 'id' => 'lastname' ])}}
                    </div>

                    <p class="text-center">{{Form::submit('Guardar', ['class' => 'btn btn-success'])}}</p>
                    {{ Form::close() }}


                    <hr>

                    {{-- SOCIAL NETWORK FORM--}}

                    @if(count($availableSN) > 1)
                    {!! Form::open(['route' => ['user.profile.socialnetwork' ,$user->username]])!!}
                    {{Form::hidden('user_id', auth()->user()->id)}}

                    <div class="form-group">
                        {{Form::label('name', 'Red Social')}}
                        {!! Form::select('name', $availableSN,null,['class' => 'form-control mt-3', 'onchange' =>
                        'socialNetworkSelect(this); activateButton();', 'id' => 'selectSN'])!!}
                    </div>

                    <div class="form-group">

                    </div>

                    {{Form::label('url', 'Url')}}
                    <div class="input-group mb-2">

                        <div class="input-group-prepend">
                            <div class="input-group-text" id="url-sn">

                            </div>


                        </div>
                        {{Form::text('url', null, ['class' => 'form-control', 'id' => 'url', 'placeholder' => 'Usuario'])}}
                    </div>

                    <div class="form-group">
                        {{Form::submit('Guardar', ['class' => 'btn btn-success', 'id' => 'submitSN', 'disabled'])}}
                    </div>
                    {!! Form::close()!!}
                    @endif
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


    {{-- SCRIPTS --}}
    <script>
        function socialNetworkSelect(nameSelect)
{
    if(nameSelect){
        socialNetworkValue = document.getElementById("selectSN").value;
        if(socialNetworkValue == "DEFAULT"){
            document.getElementById("url-sn").innerHTML = "";
        }
        if(socialNetworkValue == "FACEBOOK"){
            document.getElementById("url-sn").innerHTML = "www.facebook.com/";
        }
        if(socialNetworkValue == "INSTAGRAM"){
            document.getElementById("url-sn").innerHTML = "www.instagram.com/";
        }
        if(socialNetworkValue == "TWITTER"){
            document.getElementById("url-sn").innerHTML = "www.twitter.com/";
        }        
    }
}

function activateButton() {
var list = document.getElementById("selectSN");
var button = document.getElementById("submitSN");
if (list.selectedIndex != 0)
    button.disabled = false;
else {
    button.disabled = true;
}}



function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResult')
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }    
}

var _URL = window.URL || window.webkitURL;

$("#upload").change(function(e) {
    var file, img;


    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function() {
            if(this.width < 1280 || this.height < 720){
              
              document.getElementById('spanSize').className = 'fa fa-exclamation-triangle';

              document.getElementById("size").style.color = "#ff0000";
              document.getElementById("size").innerHTML = "El tamaño de la imagen es " + this.width + "x" + this.height + ", se requiere un mínimo de 1280x720.";
              
              Swal.fire({
                title: 'ATENCIÓN',
                html: "La imagen que ingresó no cumple con las dimensiones mínimas de <strong>1280x720</strong>",
                icon: 'error',
              })
            
            }else{
              
              document.getElementById('spanSize').className = 'fa fa-check';
              document.getElementById("size").style.color = "lime";
              document.getElementById("size").innerHTML = "Excelente imagen!";

            }
        };

        img.src = _URL.createObjectURL(file);


    }

});

$(function () {
    $('#upload').on('change', function () {
        readURL(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById( 'upload' );
var infoArea = document.getElementById( 'upload-label' );

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}

    </script>

</body>



</html>