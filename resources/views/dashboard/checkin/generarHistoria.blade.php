@extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')
@section('inrol','d-block')
@section('dire','d-none')

@php
    use Carbon\Carbon;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/css/dropzone.css') }}">

    @endsection

    @section('title','Historia Medica')
    
@section('content')
<div class="container mt-25">
        <div class="card p-4">
            <div class="card p-4">
                <h5 class="text-center">Datos de la cita</h5>

                <div class="row mt-4 mb-2">
                    <div class="col-4">
                        <label class="m-0 form-label">Fecha:</label>
                        <input type="text" disabled class="form-control" placeholder="Fecha de reservación" value="{{ $rs->date }}">
                    </div>

                    <div class="col-4">
                        <label class="m-0 form-label">Médico tratante:</label>
                        <input type="text" disabled class="form-control" placeholder="Nombre del  doctor" value="{{ $rs->person->name }} {{ $rs->person->lastname }}">
                    </div>
                    
                    <div class="col-4">
                        <label class="m-0 form-label">Razón:</label>
                        <input type="text" disabled class="form-control" placeholder="Motivo de la reservación" value="{{ $rs->description }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="{{ route('save.history', $rs) }}" method='POST' class="card p-4" id="my-awesome-dropzone" enctype="multipart/form-data" >
            @csrf
            <div class="card p-4">
                @if($mostrar == 1)
                <div style="margin-bottom:12px">
                        <a class="btn btn-primary" id="EditPatient">Editar datos <i class="fa fa-vcard"></i></a>
                </div>
                @endif
                <div class="card p-4">
                    <h5 class="text-center">Datos Personales</h5>
                    <div class="row">
                        <div class="col-3 ml-4 mb-4">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                @if (!empty($rs->patient->image->path))
                                <div class="avatar-preview avatar-edit">
                                    <div id="imagePreview" style="background-image: url({{ Storage::url($rs->patient->image->path)}});">
                                    </div>
                                    <button type="button" data-toggle="modal" data-target="#photoModal" class="btn btn-azuloscuro position-absolute btn-camara"><i class="fa fa-camera"></i></button>
                                </div>
                            @else
                            <div class="avatar-preview avatar-edit">
                                <div id="imagePreview" style="background-image: url();">
                                </div>
                                <button type="button" data-toggle="modal" data-target="#photoModal" class="btn btn-azuloscuro position-absolute btn-camara"><i class="fa fa-camera"></i></button>
                            </div>
                            @endif
                        </div>
                            </div>
                        <!-- Modal -->
                        <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h1>Selecciona un dispositivo</h1>
                                        <div>
                                            <select name="listaDeDispositivos" id="listaDeDispositivos"></select>
                                            <input type="hidden" name="tokenmodalfoto" id="tokenfoto" value="{{ csrf_token() }}">
                                            <input type="hidden" name="patient" id="patient-id" value="{{$rs->patient->id}}">
                                            <input type="hidden" name="image" id="imagen-id" value="{{$rs->patient->image->id}}">
                                            <p id="estado"></p>
                                        </div>
                                        <video muted="muted" id="video" class="col-12"></video>
                                        <canvas id="canvas" style="display: none;" name="foto"></canvas>
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-azuloscuro text-white" id="boton">Tomar foto</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-8 mt-4">
                            <div class="row mt-4">
                                <div class="form-group col-4">
                                    <label class="m-0 form-label">DNI:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select name="type_dni" disabled class="custom-select input-group-text form-control">
                                                <option value="{{ $rs->patient->type_dni }}">
                                                    {{ $rs->patient->type_dni }}</option>
                                                </select>
                                            </div>
                                        <input type="hidden" value=" {{ $rs->patient->dni }}" name="dni">
                                        <input type="text" disabled class="form-control" placeholder="Documento de Identidad" id="dni" value=" {{ $rs->patient->dni }}" name="dni">
                                    </div>
                                </div>
                            
                                <div class="col-4">
                                    <label class="m-0 form-label">Nombre:</label>
                                    <input type="text" disabled class="form-control" placeholder="Lugar de Nacimiento" value="{{ $rs->patient->name }}">
                                </div>
                                
                                <div class="col-4">
                                    <label class="m-0 form-label">Apellido:</label>
                                    <input type="text" disabled class="form-control" placeholder="Lugar de Nacimiento" value="{{ $rs->patient->lastname }}">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        
            {{-- <form action="{{ route('save.history') }}" method='POST' class="card p-4">
                @csrf --}}
                {{-- @method('PUT') --}}
            <div class="card p-4">
                <h5 class="text-center">Información personal</h5>
                <div class="row">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Fecha de Nacimiento</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input disabled name="birthdate" value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->birthdate : '' }}" data-provide="datepicker" data-date-autoclose="true" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Lugar de Nacimiento</label>
                                    <input type="text" id="place" name="place" disabled class="form-control" placeholder="Lugar de Nacimiento" value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->place : '' }}">
                                </div>
                            </div>
                            
                            <div class="col-2">
                                <div class="form-group">
                                    <label class="form-label">Edad</label>
                                    <input type="text" disabled name="age" class="form-control" placeholder="Edad" value="{{ Carbon::parse($rs->patient->historyPatient->birthdate)->age }}">
                                    {{-- value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->age : '' }}" --}}
                                </div>
                            </div>
                            
                            <div class="col-2">
                                <div class="form-group">
                                    <label class="form-label">Peso</label>
                                    <input type="text" disabled id="weight" name="weight" class="form-control" placeholder="Peso" value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->weight : '' }}">
                                </div>
                            </div>
                            
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-label">Direccion</label>
                                    <input type="text" disabled name="address" id="address" class="form-control" placeholder="Direccion" value="{{ $rs->patient->address }}">
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Genero <span class=""><i class="fa fa-venus-mars"></i></span></label>
                                    <div class="form-check ladymen p-0">
                                        <div class="custom-control custom-radio custom-control-inline p-0 mr-1">
                                            <input disabled type="radio" id="genero1"
                                            @if ($rs->patient->historyPatient != null)
                                                @if ($rs->patient->historyPatient->gender == 'Masculino')
                                                    checked
                                                    @endif
                                            @endif 
                                            name="gender" class="form-check-input" value="Masculino">
                                            <label class="form-check-label" for="genero1"><span><i class="fa fa-female"></i></span></label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline p-0 ml-1">
                                            <input disabled type="radio" id="genero2" 
                                            @if ($rs->patient->historyPatient != null)
                                                @if ($rs->patient->historyPatient->gender == 'Femenino')
                                                    checked
                                                    @endif
                                            @endif
                                            name="gender" class="form-check-input" value="Femenino">
                                            <label class="form-check-label" for="genero2"><span><i class="fa fa-male"></i></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" disabled id="email" name="email" class="form-control" placeholder="Email" value="{{ $rs->patient->email }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" disabled id="phone" name="phone" class="form-control" placeholder="Teléfono" value="{{ $rs->patient->phone }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Teléfono adicional</label>
                                    <input type="text" disabled id="another_phone" name="another_phone" class="form-control" placeholder="Teléfono adicional" value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->another_phone : '' }}">
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Email adicional</label>
                                    <input type="email" disabled id="another_email" name="another_email" class="form-control" placeholder="Email" value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->another_email : '' }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Profesión</label>
                                    <input type="text" disabled id="profession" name="profession" class="form-control" placeholder="Profesión" value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->profession : '' }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Ocupación</label>
                                    <input type="text" disabled id="occupation" name="occupation" class="form-control" placeholder="Ocupación" value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->occupation : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @if($mostrar == 1)
                <div class="card p-4">
                    <label class="form-label">Exámenes</label>
                    <div class="dropzone" id="my-dropzone">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </div>
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Launch demo modal
                    </button> --}}
                </div>

                <div class="card p-4 d-flex justify-content-between">
                    <div class="row">
                        <div class="col-lg-6 col-md-3" id="framework_form">
                            <label class="form-label">Enfermedades</label>
                            <div class="form-group multiselect_div">
                                <select id="disease" name="disease[]" class="multiselect multiselect-custom" multiple="multiple">
                                    @foreach ($disease as $enfermedades)
                                        <option value= {{ $enfermedades->id }}
                                            @if ($rs->patient->historyPatient != null)
                                            @if ($rs->patient->historyPatient->disease->contains($enfermedades->id))
                                                selected
                                                @endif
                                            @endif>
                                            {{ $enfermedades->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-3" id="framework_form2">
                            <label class="form-label">Medicamentos</label>
                            <div class="form-group multiselect_div">
                                <select id="medicine" name="medicine[]" class="multiselect multiselect-custom " multiple="multiple" >
                                    @foreach ($medicine as $medicamentos)
                                    <option value= {{ $medicamentos->id }}
                                    @if ($rs->patient->historyPatient != null)
                                        @if ($rs->patient->historyPatient->medicine->contains($medicamentos->id))
                                        selected
                                        @endif
                                        @endif>{{ $medicamentos->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-3" id="framework_form3">
                            <label class="form-label">Alergias</label>
                            <div class="form-group multiselect_div">
                                <select id="allergy" name="allergy[]" class="multiselect multiselect-custom" multiple="multiple" >
                                    @foreach ($allergy as $alergias)
                                    <option value= {{ $alergias->id }}
                                    @if ($rs->patient->historyPatient != null)
                                        @if ($rs->patient->historyPatient->allergy->contains($alergias->id))
                                        selected
                                        @endif
                                        @endif>{{ $alergias->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-3">
                            <div class="form-group col-12">
                                <label class="form-label">Cirugias previas</label>
                                <input  type="text" disabled id="previous_surgery" class="form-control" placeholder="Cirugias anteriores" value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->previous_surgery : ''  }}" name="previous_surgery" disabled>
                                {{-- <textarea class="form-control" disabled id="previous_surgery" name="cirugia" cols="63" rows="5">{{ $rs->patient->historyPatient->previous_surgery  }}</textarea> --}}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card p-4 row d-flex d-row justify-content-between">
                    <div class="card p-4">
                        <h5 class="text-center">Citas anteriores</h5>
                        @forelse ($cites as $reservation)
                            <div class="card col-4 text-justify p-4 form-control mt-2">
                                <div>
                                    <label class="m-0 form-label">Doctor:</label>
                                    <input type="text" class="form-control border-0 bg-white" placeholder="Lugar de Nacimiento" value=" {{ $reservation->employe->person->name }} {{ $reservation->employe->person->lastname }}">
                                </div>
                                
                                <div>
                                    <label class="m-0 form-label">Especialidad:</label>
                                    <input type="text" class="form-control border-0 bg-white" placeholder="Lugar de Nacimiento" value=" {{ $reservation->speciality->name }}">
                                </div>
                                
                                <div>
                                    <label class="m-0 form-label">Fecha de la reservacion:</label>
                                    <input type="text" class="form-control border-0 bg-white" placeholder="Lugar de Nacimiento" value=" {{ $reservation->date }}">
                                </div>

                                <div>
                                    <label class="m-0 form-label">Razon de la cita:</label>
                                    <input type="text" class="form-control border-0 bg-white" placeholder="Lugar de Nacimiento" value=" {{ $reservation->description }}">
                                </div>
                            </div> 
                        @empty
                            <div>
                                <label class="m-0 form-label">No posee Citas Anteriores</label>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
            
            @if($mostrar == 1)
                <div>
                    <button type="submit" class="btn btn-primary" id="submit-all"> Guardar</button>
                </div>
            @else
                <div>
                    <a href="{{Route('checkin.day')}}"  class="btn btn-primary">Salir</a>
                </div>
            @endif
        </form>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form role="form" enctype="multipart/form-data" action="{{route('checkin.exams')}}" method="POST">
                        @csrf
                <input type="hidden" value="{{$rs->patient->historyPatient->id}}" name="patient">
                      <div class="dropzone" id="my-dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple id="files" />
                    </div>
                </div>
                    
                        <button type="submit" class="btn btn-azuloscuro">Submit</button>
                    </form>
                </div>
            </div>
          </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets\css\brandAn.css') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/js/dropzone.js') }}"></script>
<script src="{{ asset('js/brandAn.js') }}"></script>

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
                "idpatient":$('#patient-id').val(),
                "idimage":$('#imagen-id').val(),
                "pic":datafoto
                };
        const datos=JSON.stringify(data1)
        $estado.innerHTML = "Enviando foto. Por favor, espera...";
        fetch("{{ route('checkin.avatar') }}", {
            method: "POST",
            body: datos,
            headers: {
                "Content-type": "application/x-www-form-urlencoded",
                'X-CSRF-TOKEN': data1.tokenmodalfoto,// <--- aquí el token
            },
        }).then(function(response) {
            // console.log(response.json());
                return response.json();
            }).then(nombreDeLaFoto => {
                // nombreDeLaFoto trae el nombre de la imagen que le dio PHP
                console.log("La foto fue enviada correctamente");
                $estado.innerHTML = `Foto guardada con éxito. Puedes verla <a target='_blank' href='./${nombreDeLaFoto}'> aquí</a>`;
            })
        //Reanudar reproducción
        $video.play();
  
        $('.avatar-preview').load(
            $('#imagePreview').css('background-image', 'url({{ Storage::url($rs->patient->image->path) }})'),
             $('#imagePreview').hide(),
             $('#imagePreview').fadeIn(650)
         );        
        });
</script>


<script>
Dropzone.options.myDropzone = {
    url: "{{ route('checkin.exams') }}",
    autoProcessQueue: true,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 10,
    maxFilesize:10,
    addRemoveLinks: true,
    accept: function(file) {
        let fileReader = new FileReader();

        fileReader.readAsDataURL(file);
        fileReader.onloadend = function() {

            let content = fileReader.result;
            $('#files').val(content);
            file.previewElement.classList.add("dz-success");
        }
        file.previewElement.classList.add("dz-complete");
        
    }
}
//  Dropzone.options.myDropzone = {
//             url: "{{ route('save.history', $rs) }}",
//             autoProcessQueue: true,
//             uploadMultiple: true,
//             parallelUploads: 100,
//             maxFiles: 10,
//             maxFilesize:10,
//             // acceptedFiles: "image/*",

//             init: function () {

//                 var submitButton = document.querySelector("#submit-all");
//                 var wrapperThis = this;

//                 submitButton.addEventListener("click", function () {
//                     e.preventDefault();
//                     e.stopPropagation();
//                     wrapperThis.processQueue();
//                 });

//                 this.on("addedfile", function (file) {

//                     // Create the remove button
//                     var removeButton = Dropzone.createElement("<button class='btn btn-danger mt-2 text-center'><i class='fa fa-remove'></i></button>");

//                     // Escucha el evento click
//                     removeButton.addEventListener("click", function (e) {
//                         // Asegúrese de que el clic del botón no envíe el formulario:
//                         e.preventDefault();
//                         e.stopPropagation();

//                         // Eliminar la vista previa del archivo.
//                         wrapperThis.removeFile(file);
//                         // Si también quieres eliminar el archivo en el servidor,
//                         // puedes hacer la solicitud AJAX aquí.
//                     });

//                     // Agregue el botón al elemento de vista previa del archivo.
//                     file.previewElement.appendChild(removeButton);
//                 });
                
//             }
//         };
</script>
<script>
        $('#disease').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
    </script>

    <script>
        $('#medicine').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
    </script>

    <script>
        $('#allergy').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
    </script>

    <script>
        $('#EditPatient').click(function() {
            $('#weight').removeAttr('disabled');
            $('#place').removeAttr('disabled');
            $('#allergy').removeAttr('disabled');
            $('#medicine').removeAttr('disabled');
            $('#disease').removeAttr('disabled');
            $('#address').removeAttr('disabled');
            $('#genero1').removeAttr('disabled');
            $('#genero2').removeAttr('disabled');
            $('#phone').removeAttr('disabled');
            $('#profession').removeAttr('disabled');
            $('#occupation').removeAttr('disabled');
            $('#another_phone').removeAttr('disabled');
            $('#another_email').removeAttr('disabled');
            $('#previous_surgery').removeAttr('disabled');
        });
    </script>

    <script>
        // para el select de las enfermedades
        $("#disease").change(function(){
            var disease_id = $(this).val();     // Capta el id de la enfermedad 
            console.log('enfermedad', disease_id); 
            //console.log(disease_id.length); // el length en este caso permite agarrar el ultimo valor del arreglo
        });
    </script>

    <script>
        // para el select de las alergias
        $("allergy").change(function(){
            var allergy_id = $(this).val();     // Capta el id de la alergia 
            console.log('alergia', allergy_id);
            console.log(allergy_id.length); // el length en este caso permite agarrar el ultimo valor del arreglo
        });
    </script>

    <script>
        // para el select de las medicamentos
        $("#medicine").change(function(){
            var medicine_id = $(this).val(); // Capta el id del medicamento 
            console.log('medicamento', medicine_id);
            console.log(medicine_id.length); // el length en este caso permite agarrar el ultimo valor del arreglo
        });
    </script>
@endsection
