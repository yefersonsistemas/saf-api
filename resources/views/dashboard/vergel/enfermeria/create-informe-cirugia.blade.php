@extends('dashboard.layouts.app')
@section('cites','active')
@section('newCite','active')
@section('title','Agregar informes al paciente')
@section('enrol','d-block')
@section('dire','d-none')
@section('css')
<link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/css/dropzone.css') }}">

@endsection @section('content')

<div class="py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                {{-- <form id="wizard_horizontal" action="{{route('update.lista_cirugias', $paciente->id)}}" method='POST' enctype="multipart/form-data" lass="card pl-4 pr-4"> --}}
                    {{-- @method('PUT') --}}
                    <form id="wizard_horizontal" action="" method='POST' enctype="multipart/form-data" lass="card pl-4 pr-4">
                    @csrf
                    <h2>Informe del Internista</h2>
                    <section class="py-1">
                        {{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" style="background-color: black"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="1" style="background-color: black"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="2" style="background-color: black"></li>
                            </ol>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                           
                                <img  src="{{ asset('assets/images/consultorio.jpg') }}" alt="" class="imagecheck-image">
                              </div>
                              <div class="carousel-item">
                               
                                <img  src="{{ asset('assets/images/consultorio.jpg') }}" alt="" class="imagecheck-image">
                              </div>
                              <div class="carousel-item">
                                
                                <img  src="{{ asset('assets/images/consultorio.jpg') }}" alt="" class="imagecheck-image">
                              </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                        </div> --}}

                        <div class="card mt-3">
                            <div class="row">
                                <div class="col-3 mt-3 mb-2">
                                <img src="{{ asset('assets/images/consultorio.jpg') }}" alt="Nature" style="width:100%" onclick="myFunction(this);">
                                </div>
                                <div class="col-3 mt-3 mb-2">
                                <img src="{{ asset('assets/images/consultorio.jpg') }}" alt="Snow" style="width:100%" onclick="myFunction(this);">
                                </div>
                                <div class="col-3 mt-3 mb-2">
                                <img src="{{ asset('assets/images/consultorio.jpg') }}" alt="Mountains" style="width:100%" onclick="myFunction(this);">
                                </div>
                                <div class="col-3 mt-3 mb-2">
                                <img src="{{ asset('assets/images/consultorio.jpg') }}" alt="Lights" style="width:100%" onclick="myFunction(this);">
                                </div>
                            </div>
                            
                            <div class="container">
                            <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
                            <img id="expandedImg" style="width:100%">
                            <div id="imgtext"></div>
                            </div>
                        </div>

                        <div class=" p-5">
                            <label class="form-label">Agregar Informe</label>
                            <div class="dropzone" id="my-dropzone" style="border-color:#00506b">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </div>
                        </div>
                          
                         
                    </section> 
                    <h2>Informe del Anestesiologo</h2>
                    <section class="py-1">
                        <div class=" p-5">
                            <label class="form-label">Agregar Informe</label>
                            <div class="dropzone" id="my-dropzone" style="border-color:#00506b">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </div>
                        </div>
                    </section> 
                    <h2>Informe del Cirujano</h2>
                    <section class="py-1">
                        <div class=" p-5">
                            <label class="form-label">Agregar Informe</label>
                            <div class="dropzone" id="my-dropzone" style="border-color:#00506b">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </div>
                        </div>
                    </section> 
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/brandAn.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/js/dropzone.js') }}"></script>
{{--<script src="{{ asset('js\dashboard\createCite.js') }}"></script> --}}


<script>
     function myFunction(imgs) {
      var expandImg = document.getElementById("expandedImg");
      var imgText = document.getElementById("imgtext");
      expandImg.src = imgs.src;
      imgText.innerHTML = imgs.alt;
      expandImg.parentElement.style.display = "block";
    }


    function stopDefAction(evt) {
        evt.preventDefault();
    }

    var form = $('#wizard_horizontal').show()
    ;
    form.steps({
        headerTag: 'h2',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        labels: {
            cancel: "Cancelar",
            current: "Paso actual:",
            pagination: "Paginación",
            finish: "Finalizar",
            next: "Siguiente",
            previous: "Anterior",
            loading: "Cargando ..."},
        onInit: function(event, currentIndex) {
            setButtonWavesEffect(event);
            
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);

           
        },
        onFinished: function(event, currentIndex) {
            var form = $(this);
            form.submit();
        }
    });

    function setButtonWavesEffect(event) {
        $(event.currentTarget).find('[role="menu"] li a').removeClass('');
        $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('');
    }

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
@endsection
