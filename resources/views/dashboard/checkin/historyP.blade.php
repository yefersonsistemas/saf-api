@extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')

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
<!------------------Datos de la cita -------------->
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

    <!--------------Guardar historia------------>
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
                            </div>
                        </div>                   

                    </div>
                </div>
            </div>        
        </form>
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
