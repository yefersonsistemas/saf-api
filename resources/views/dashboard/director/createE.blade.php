@extends('dashboard.layouts.app')

@section('cites','active')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">

@endsection

@section('title','Registro de Empleados')

@section('content')
@can('registrar empleados')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('employe.store')}}" method='POST' enctype="multipart/form-data" class="row d-flex justify-content-center">
            @csrf
            <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card p-4">

                    <div class="row d-flex justify-content-between create-employee">
                        <div class="form-group col-lg-3 col-md-3" >
                            <label class="form-label">Foto</label>
                            <div class=" mb-2">
                                <input id="image" type="file" class="dropify" name="image" data-default-file="">
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-7 d-flex justify-content-between">
                            <div class="row">
                                <div class="form-group col-lg-4">
                                        <label class="form-label">Documento de Identidad</label>
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <select name="type_dni" class="custom-select input-group-text form-control" value=" {{ old('type_dni') }}" required>
                                                    <option value="0">...</option>
                                                    <option value="N">N</option>
                                                    <option value="E">E</option>
                                                </select>
                                            </div>
                                            <input minlength="7" maxlength="9" type="text" class="form-control" placeholder="Documento de Identidad" value=" {{ old('dni') }}" required name="dni">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 ">
                                        <div class="form-group">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Apellido</label>
                                            <input type="text" class="form-control" placeholder="Apellido" name="lastname" value="{{ old('lastname') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Direccion</label>
                                                <input type="text" name="address" id="address" class="form-control" placeholder="Direccion" value="{{ old('address') }}" required>
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"> Teléfono </label>
                                                <input type="text" class="form-control validanumericos" placeholder="Telefono" name="phone" value="{{ old('phone') }}" required>
                                            </div>
                                        </div>


                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label"> Correo Electronico </label>
                                            <input type="email" placeholder="name@example.com" class="form-control" name="email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-between">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Cargo</label>
                                    <select name="position_id" id="id" class="custom-select input-group-text bg-white form-control">
                                        <option value="0">Ninguna selección</option>
                                        @foreach ($position as $position)
                                        <option value={{$position->id}}>{{$position->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row ">
                                    <div class="col-lg-6 mt-2 d-flex justify-content-center">
                                        <div class="form-group">
                                            <div class="form-label">Usara el Sistema</div>
                                            <div class="custom-controls-stacked">
                                                <label class="custom-control custom-radio custom-control-inline" data-toggle="modal" data-target="#staticBackdrop">
                                                    <input type="radio" class="custom-control-input" onclick="enableBtn()"  name="pass" value="option1" >
                                                    <span class="custom-control-label">Si</span>
                                                </label>
                                                <label class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input" onclick="disableBtn()" name="pass" value="option2">
                                                    <span class="custom-control-label">No</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- @can('asignar permisos') --}}
                                    <div class="col-lg-6 mt-3">
                                        <button disabled type="button" id="boton" class="btn btn-info" style="width: 230px" data-toggle="modal" data-target="#permission"> Agregar Permisos </button>
                                    </div>
                                    {{-- @endcan --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="btn-group-toggle mb-2 mt-3 d-flex justify-content-end" style="text-align:center">
                        <button type="submit" class="btn mr-2 pr-4 pl-4 text-white bg-verdePastel" >Enviar</button>
                        <button type="reset" style="background:#a1a1a1" class="btn mr-2 pr-4 pl-4 text-white">Limpiar</button>
                    </div>
                </div>
            </div>
                    <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Crear Contraseña</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-10" >
                                <div class="input-group">
                                    <input id="clave" type="Password" onkeyup="contar(this);"  name="contra" Class="form-control" maxlength="16" minlength="8" required>

                                    <div class="input-group-append">
                                        <button id="ver" class="form-control" type="button" onclick="mostrarPassword()"><i class="fa fa-eye-slash " style="color:#00506b; font-size:17px" id="icon"></i></button>
                                    </div>
                                </div>
                                    <p id="charNum"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="permission" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Asignar Permisos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12" >
                                <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Seleccionar</th>
                                        </tr>
                                </thead>
                                <tbody>
                                @foreach ($permissions as $item)
                                <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @can('asignar permisos')
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-switch-input" name="perms[]" value="{{ $item->name }}" >
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>
                                    @endcan
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endcan
@endsection


@section('scripts')
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/brandAn.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>

<script>
onload = function(){
  var ele = document.querySelectorAll('.validanumericos')[0];
  ele.onkeypress = function(e) {
     if(isNaN(this.value+String.fromCharCode(e.charCode)))
        return false;
  }
  ele.onpaste = function(e){
     e.preventDefault();
  }
}
</script>

<script>
function disableBtn() {
  document.getElementById("boton").disabled = true;
}

function enableBtn() {
  document.getElementById("boton").disabled = false;
}
</script>

<script>
function mostrarPassword(){
        var eye = document.getElementById("clave");
        if(eye.type == "password"){
            eye.type = "text";
            $('#icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            eye.type = "password";
            $('#icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }

    $(document).ready(function () {
	//CheckBox mostrar contraseña
	$('#ver').click(function () {
		$('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});
});
</script>

<script>
function contar(obj){
    if(obj.value.length < 8){
        document.getElementById("charNum").innerHTML = '<p style="color:red">Debe contener de 8 - 16 caracteres.</p>';
    }else{
        document.getElementById("charNum").innerHTML = '<p style="color:green">Número de carácteres válidos.</p>';
    }
}
</script>

<script>
    $boton.addEventListener("click", function() {
        // Codificarlo como JSON
        //Pausar reproducción
        $video.pause();
            //Obtener contexto del canvas y dibujar sobre él
            let contexto = $canvas.getContext("2d");
            $canvas.width = $video.videoWidth;
            $canvas.height = $video.videoHeight;
            contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

            let foto = $canvas.toDataURL(); //Esta es la foto, en base 64
            let datafoto=encodeURIComponent(foto);
                var data1 = {
                    "tokenmodalfoto": $('#tokenfoto').val(),
                    "pic":datafoto
                    };
            const datos=JSON.stringify(data1);
            $estado.innerHTML = "Enviando foto. Por favor, espera...";
            fetch("{{ route('cita.foto') }}", {
                method: "POST",
                body: datos,
                headers: {
                    "Content-type": "application/x-www-form-urlencoded",
                    'X-CSRF-TOKEN': data1.tokenmodalfoto,// <--- aquí el token
                },
            }).then(resultado => {
                            // A los datos los decodificamos como texto plano
                            return resultado.text()
                        })
                        .then(nombreDeLaFoto => {
                            console.log(nombreDeLaFoto);
                            // nombreDeLaFoto trae el nombre de la imagen que le dio PHP
                            console.log("La foto fue enviada correctamente");
                            // let timerInterval
                            Swal.fire({
                                    type: 'success',
                                    title: 'La foto fue guardada con Exíto',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                $estado.innerHTML = '';
                                $('.avatar-preview').load(
                                    $('#imagePreview').css('background-image', `url(/storage/${nombreDeLaFoto})`),
                                    $('#foto').val(nombreDeLaFoto),
                                    $('#imagePreview').hide(),
                                    $('#imagePreview').fadeIn(650),
                                    );
                        })
            //Reanudar reproducción
            // $video.play();
            });
</script>

@endsection


