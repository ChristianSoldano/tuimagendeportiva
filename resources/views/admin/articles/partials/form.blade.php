{{Form::hidden('user_id', auth()->user()->id)}}

<div class="form-group">
  {{Form::label('title', 'Título')}}
  {{Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'onkeyup' => 'countChar(this)'])}}
  <p id="charNum" class="pull-right mt-1">Máximo 128 caracteres.</p>
</div>

<div class="form-group">
  {{Form::label('slug', 'Url Amigable')}}
  {{Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug' ])}}
</div>

<div class="form-group">


  <!-- Upload image input-->
  <div class="input-group mb-3 px-2 py-2 rounded-pill bg-light shadow-sm">

    {{Form::file('image',['class' => 'form-control border-0', 'id' => 'upload', 'onchange' => 'readURL(this);'])}}


    <label id="upload-label" for="upload" class="font-weight-light text-dark text-light">Seleccionar archivo</label>


    <div class="input-group-append">
      <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i
          class="fa fa-cloud-upload mr-2 text-muted"></i><small
          class="text-uppercase font-weight-bold text-muted">Seleccionar</small></label>
    </div>
  </div>

  <!-- Uploaded image area-->
  <p class="font-italic text-dark text-center">La imagen subida aparecerá aqui debajo</p>
  <div class="image-area mt-4"><img id="imageResult" src="@if(isset($article)) {{$article->image}}@endif" alt=""
      class="img-fluid rounded shadow-sm mx-auto d-block"></div>
  <br>
  <span id="spanSize"></span>
  <h5 id="size" class="d-inline"></h5>
</div>

<div class="form-group">
  {{ Form::label('category_id', 'Categoría')}}
  {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'id' => 'category'])}}
</div>

<div class='form-group'>
  {{Form::label('excerpt', 'Extracto')}}
  {{Form::textarea('excerpt', null, ['class' => 'form-control', 'id' => 'excerpt', 'rows' => '2', 'onkeyup' => 'countCharExcerpt(this)'])}}
  <p id="charNumExcerpt" class="pull-right mt-1">Máximo 250 caracteres.</p>
</div>

<div class="form-group">
  {{Form::label('body', 'Contenido')}}
  {{Form::textarea('body', null, ['class' => 'form-control', 'id' => 'body'] )}}
</div>

<div class="form-group">
  {{Form::submit('Guardar', ['class' => 'btn btn-success'])}}
</div>

@section('scripts')

<script src="{{ asset('vendor/ckeditor/ckeditor.js')}}"></script>

<script>
  function countChar(val) {
        var len = val.value.length;
        if (len >= 128) {
          val.value = val.value.substring(0, 128);
          document.getElementById("charNum").style.color = "#ff0000";
          $('#charNum').text('Se alcanzó el límite de caracteres.');
        }else if(len == 127){
          
          document.getElementById("charNum").style.color = "#000000";
          $('#charNum').text('Quedan 1 caracter.');
        
          }else {
          document.getElementById("charNum").style.color = "#000000";
          $('#charNum').text('Quedan ' + (128 - len) + ' caracteres.');
        }
      };

  function countCharExcerpt(val) {
        var len = val.value.length;
        if (len >= 250) {
          val.value = val.value.substring(0, 250);
          document.getElementById("charNumExcerpt").style.color = "#ff0000";
          $('#charNumExcerpt').text('Se alcanzó el límite de caracteres.');
        }else if(len == 249){
          
          document.getElementById("charNumExcerpt").style.color = "#000000";
          $('#charNumExcerpt').text('Quedan 1 caracter.');
        
          }else {
          document.getElementById("charNumExcerpt").style.color = "#000000";
          $('#charNumExcerpt').text('Quedan ' + (250 - len) + ' caracteres.');
        }
      };

$(document).ready(function(){
         $("#title").keyup(function(){
                var cadena = $(this).val();
                string_to_slug(cadena);
            });
});

CKEDITOR.config.height = 400;
CKEDITOR.config.width = 'auto';
CKEDITOR.config.language = 'es';
CKEDITOR.replace('body');

function string_to_slug (str) {
         str = str.replace(/^\s+|\s+$/g, '');
         str = str.toLowerCase(); 
        
          //quita acentos, cambia la ñ por n, etc
          var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
          var to   = "aaaaeeeeiiiioooouuuunc------";
          
          for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
           }

           str = str.replace(/[^a-z0-9 -]/g, '') // quita caracteres invalidos
                 .replace(/\s+/g, '-') // reemplaza los espacios por -
                 .replace(/-+/g, '-'); // quita las plecas

           return $("#slug").val(str);
}



/*  ==========================================
    SHOW UPLOADED IMAGE
* ========================================== */
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
            if(this.width < 900 || this.height < 400){
              
              document.getElementById('spanSize').className = 'fa fa-exclamation-triangle';

              document.getElementById("size").style.color = "#ff0000";
              document.getElementById("size").innerHTML = "El tamaño de la imagen es " + this.width + "x" + this.height + ", se requiere un mínimo de 900x400.";
              
              Swal.fire({
                title: 'ATENCIÓN',
                html: "La imagen que ingresó no cumple con las dimensiones mínimas de <strong>900x400</strong>",
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
@endsection