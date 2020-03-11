@extends('dashboard.layouts.app')
@section('cites','active')
@section('newCite','active')
@section('title','Agregar informes al paciente')
@section('enrol','d-block')
@section('dire','d-none')
@section('css')
<link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/css/dropzone.css') }}">

    <style>
        /* body {font-family: Arial, Helvetica, sans-serif;} */
    
        #myImg {
          border-radius: 5px;
          cursor: pointer;
          transition: 0.3s;
          opacity: 0.6;
        }
    
        #myImg:hover {opacity: 1;}

        #myImg1 {
          border-radius: 5px;
          cursor: pointer;
          transition: 0.3s;
          opacity: 0.6;
        }
    
        #myImg1:hover {opacity: 1;}

        #myImg2 {
          border-radius: 5px;
          cursor: pointer;
          transition: 0.3s;
          opacity: 0.6;
        }
    
        #myImg2:hover {opacity: 1;}
    
        /* The Modal (background) */
    
        .modall{
          display: none;
          position: fixed; /* Stay in place */
          /* z-index: 1; Sit on top */
          padding-top: 20px; /* Location of the box */
          left: 0;
          top: 0;
          /* max-width: 1500px; */
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0);
          background-color: rgba(0,0,0,0.8);
    
        }
    
    
        /* Modal Content (image) */
        .modal-content {
          margin: auto;
          display: block;
          width: 85%;
          max-width: 1500px;
        }
    
        /* Caption of Modal Image */
        .caption {
          margin: auto;
          display: block;
          width: 50%;
          /* max-width: 400px; */
          text-align: center;
          color: #ccc;
          padding: 10px 0;
          height: 150px;
        }
        .sombra
        {
            -webkit-box-shadow: 1px 1px 3px #878585; /* Sombra normal */
            border-radius: 2px
            
        }
    
    
        .caption_extra_grande {
          margin: auto;
          display: block;
          width: 130%;
          /* max-width: 1700px; */
          text-align: center;
          color: #ccc;
          padding: 5px 0;
          height: 180px;
        }
    
        img{
            opacity: 1;
        }
    
        /* Add Animation */
        .caption {
          -webkit-animation-name: zoom;
          -webkit-animation-duration: 0.6s;
          animation-name: zoom;
          animation-duration: 0.6s;
        }
    
        @-webkit-keyframes zoom {
          from {-webkit-transform:scale(0)}
          to {-webkit-transform:scale(1)}
        }
    
        @keyframes zoom {
          from {transform:scale(0)}
          to {transform:scale(1)}
        }
    
        /* The Close Button */
        .close {
          position: absolute;
          top: 15px;
          right: 35px;
          color: #fff;
          font-size: 40px;
          font-weight: bold;
          transition: 0.3s;
        }
    
        .close:hover,
        .close:focus {
          color: #bbb;
          text-decoration: none;
          cursor: pointer;
        }
    
        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
         #caption {
            width: 100%;
          }
        }
    </style>
@endsection @section('content')

<div class="py-4 ">
    <div class="container-fluid  " >
        <div class="row clearfix card">
            <div class="col-lg-12 col-md-12 col-sm-12" >
                <form id="wizard_horizontal" action="{{ route('guardar.informe', [$surgery, 0] ) }}" method='POST' enctype="multipart/form-data" lass="card pl-4 pr-4">
                @csrf
                <h2>Informe del Internista</h2>
                {{-- <input type="hidden" name="patient_id" id="patient_id" value="{{$patient->id}}"> --}}
                <section class="py-1" >

                @if ($internista->first() != null)
                   <div class="row  d-flex justify-content-center">
                        <div class="card mt-3 col-11" style="height:120px; overflow-x: scroll; background: #a1a1a1;">
                            <div class="row flex-row flex-nowrap justify-content-between p-0" style="height:100%; ">
                                @foreach ($internista as $item)
                                    <div class="col-2 p-0 m-0 my-1 mt-1"  id="carta{{ $item->id }}">
                                       <div class="card" >
                                           <a id="galeria" name="{{ $item->id }}" title="Eliminar"><i class="fa fa-trash"></i></a>
                                           <input type="hidden" value="1" id="internista_id">
                                           <img src="{{ Storage::url($item->path) }}" alt="" class="col-12" id="myImg" name="{{ $item->path }}" style="width:100%; height:100%; border-radius:10px;" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                            
                   </div>

                    <div class=" p-3">
                        <div class="dropzone row d-flex p-0" id="my-dropzone" style="border-color:#00506b; height:230; overflow-y: scroll;" ></div>
                    </div>
                    @endif
                    
                    @if ($internista->first() == null)
                        <div class=" p-5">
                            <label class="form-label">Agregar Informe</label>
                            <div class="dropzone row d-flex p-0" id="my-dropzone" style="border-color:#00506b; height:250px; overflow-y: scroll;" ></div>
                        </div>
                    @endif
                </section> 

                <h2>Informe del Anestesiologo</h2>
                <section class="py-1">

                    @if ($anestesiologo->first() != null)
                    <div class="row  d-flex justify-content-center">
                        <div class="card mt-3 col-11" style="height:100px; overflow-x: scroll; background: #a1a1a1;">
                            <div class="row flex-row flex-nowrap justify-content-between p-0" style="height:100%; ">
                            @foreach ($anestesiologo as $item)
                                    <div class="col-2 p-0 m-0 my-1 mt-1" id="carta1{{ $item->id }}">
                                        <div class="card">
                                            <a id="galeria1" name="{{ $item->id }}" title="Eliminar"><i class="fa fa-trash"></i></a>
                                            <input type="hidden" value="2" id="anestesiologo_id">
                                        <img src="{{ Storage::url($item->path) }}" alt="" id="myImg1" name="{{ $item->path }}" class="col-12" style="width:100%; height:100%; border-radius:10px;" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                       </div>
    
                        <div class=" p-3">
                            <div class="dropzone row d-flex p-0" id="my-dropzone1" style="border-color:#00506b; height:230; overflow-y: scroll;" ></div>
                        </div>
                        @endif
                        @if ($anestesiologo->first() == null)
                            <div class=" p-5">
                                <label class="form-label">Agregar Informe</label>
                                <div class="dropzone row d-flex p-0" id="my-dropzone1" style="border-color:#00506b; height:250px; overflow-y: scroll;" ></div>
                            </div>
                        @endif
                </section> 

                <h2>Informe del Cirujano</h2>
                <section class="py-1">
                   @if ($cirujano->first() != null)
                   <div class="row  d-flex justify-content-center">
                    <div class="card mt-3 col-11" style="height:100px; overflow-x: scroll; background: #a1a1a1;">
                        <div class="row flex-row flex-nowrap justify-content-between p-0" style="height:100%; ">
                        @foreach ($cirujano as $item)
                            <div class="col-2 p-0 m-0 my-1 mt-1" id="carta2{{ $item->id }}">
                                <div class="card">
                                    <a id="galeria2" name="{{ $item->id }}" title="Eliminar"><i class="fa fa-trash"></i></a>
                                    <input type="hidden" value="3" id="cirujano_id">
                                <img src="{{ Storage::url($item->path) }}" alt="" id="myImg2" name="{{ $item->path }}" class="col-12" style="width:100%; height:100%; border-radius:10px;">
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                   </div>

                    <div class=" p-3">
                        <div class="dropzone row d-flex p-0" id="my-dropzone2" style="border-color:#00506b; height:230; overflow-y: scroll;" ></div>
                    </div>
                    @elseif ($cirujano->first() == null)

                    <div class=" p-5">
                        <label class="form-label">Agregar Informe</label>
                        <div class="dropzone row d-flex p-0" id="my-dropzone2" style="border-color:#00506b; height:250px; overflow-y: scroll;" ></div>
                    </div>
                    @endif
                </section> 
                </form>
            </div>
        </div>
    </div>
</div>

<div id="myModall"  data-backdrop="static" class="modal modall">
    <div class="container"> 
    <div class="row"> 
    <button type="button" class=" close atras" data-dismiss="modal" aria-label="Close"></button>
    <div class="col-6 align-right"  id="cambiar">
        <a class="btn medio  " style="color:#fff; font-size:20px;"><i class=" sombra fe fe-plus"></i></a>
    </div>  
    <div class="col-6 " id="restaurar">
        <a class="btn atras  " style="color:#fff; font-size:20px;"><i class=" fe fe-minus"></i></a>
    </div>       
    </div>      
    <div class="caption" id="caption">
    </div>
</div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>
<script src="{{ asset('assets\css\brandAn.css') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/js/dropzone.js') }}"></script>
<script src="{{ asset('js/brandAn.js') }}"></script>

<script>


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

    $('a[id="galeria"]').on('click', function(){
        var img = this.name;
        let tipo = $('#internista_id').val();
        console.log('aca', img, tipo);
        $('div').remove("#carta"+img);
        
                $.ajax({
                    type: 'POST',
                    url: '{{ route("galeria.delete") }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        filename: img,
                        tipo:tipo,
                        },
                    success: function (data){                 //si no trae valores
                    console.log('ysbelia', data);


                        Swal.fire({
                            title: 'Archivo eliminado correctamente',
                            text: 'Click en OK para continuar',
                            type: 'success',
                        });

                        // console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
    })

    $('a[id="galeria1"]').on('click', function(){
        var img = this.name;
        let tipo = $('#anestesiologo_id').val();
        console.log('aca', img, tipo);

        $('div').remove("#carta1"+img);
        
                $.ajax({
                    type: 'POST',
                    url: '{{ route("galeria.delete") }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        filename: img,
                        tipo:tipo,
                        },
                    success: function (data){                 //si no trae valores
                    console.log('ysbelia', data);


                        Swal.fire({
                            title: 'Archivo eliminado correctamente',
                            text: 'Click en OK para continuar',
                            type: 'success',
                        });

                        // console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
    })

    $('a[id="galeria2"]').on('click', function(){
        var img = this.name;
        let tipo = $('#cirujano_id').val();
        console.log('aca', img, tipo);

        $('div').remove("#carta2"+img);
        
                $.ajax({
                    type: 'POST',
                    url: '{{ route("galeria.delete") }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        filename: img,
                        tipo:tipo,
                        },
                    success: function (data){                 //si no trae valores
                    console.log('ysbelia', data);


                        Swal.fire({
                            title: 'Archivo eliminado correctamente',
                            text: 'Click en OK para continuar',
                            type: 'success',
                        });

                        // console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
    })



    $('img[id="myImg"]').on('click',function(){
            var modalImg = this.name;
            console.log(modalImg);

            console.log('aqui va la imagen seleccionada', modalImg);

            concatenar = '/Storage/';
            url = concatenar+modalImg;

        $('#caption').html('<img src="'+url+'" alt="Snow" class=" ml-3 img-thumbnail modal-content" style="  display: block; width: 80%; max-width: 1500px; ">');
        $('#myModall').modal('show');
    });

    $('img[id="myImg1"]').on('click',function(){
            var modalImg = this.name;
            console.log(modalImg);

            console.log('aqui va la imagen seleccionada', modalImg);

            concatenar = '/Storage/';
            url = concatenar+modalImg;

        $('#caption').html('<img src="'+url+'" alt="Snow" class=" ml-3 img-thumbnail modal-content" style="  display: block; width: 80%; max-width: 1500px; ">');
        $('#myModall').modal('show');
    });

    $('img[id="myImg2"]').on('click',function(){
            var modalImg = this.name;
            console.log(modalImg);

            console.log('aqui va la imagen seleccionada', modalImg);

            concatenar = '/Storage/';
            url = concatenar+modalImg;

        $('#caption').html('<img src="'+url+'" alt="Snow" class=" ml-3 img-thumbnail modal-content" style="  display: block; width: 80%; max-width: 1500px; ">');
        $('#myModall').modal('show');
    });

</script>

<script>
    $('.medio').click(function(){
        console.log('zoon_max');
        $("#caption").removeClass("caption");
        $("#caption").addClass("caption_extra_grande");

        $('#cambiar').html('<a class="btn" style="color:#fff; font-size:20px;"><i class="  fe fe-plus"></i></a>')

    }); 
    
</script>

<script>
    $('.atras').click(function(){
        console.log('zoon_max_atras');
        $("#caption").removeClass("caption_extra_grande");
        $("#caption").addClass("caption");
        $('#cambiar').html(`<a class="btn extra_grande" id="grande" style="color:#fff; font-size:20px;"><i class="   fe fe-plus"></i></a> ` );
        //aumentar
        $('#grande').click(function(){
            console.log('zoon_max');
            $("#caption").removeClass("caption_medio");
            $("#caption").addClass("caption_extra_grande");

            $('#cambiar').html(`<a class="btn" id="extra_grande" style="color:#fff; font-size:20px;"><i class=" sombra fe fe-plus"></i></a> `);
        });
    });
  
</script>

<script>
    Dropzone.options.myDropzone = {


        url: "{{ route('guardar.informe', [$surgery, 1]) }}",
            headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
         },
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
            return time+file.name;
            },
            // autoProcessQueue:true,
            // maxFilesize: 10, //peso del archivo q se subira
            // maxFiles:3,  //cantidad de archivos q se guardaran en bd asi se hayan colocado mas
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file,response)
            {
                var name = file.xhr.response;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("eliminarI") }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        filename: name
                        },
                    success: function (data){                 //si no trae valores
                            Swal.fire({
                                title: 'Archivo eliminado correctamente',
                                text: 'Click en OK para continuar',
                                type: 'success',
                            });
                        // console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function(file, response)
            {
                console.log('controlador',response);
            },
            error: function(file, response)
            {
            return false;
            }
            
    }

</script>

<script>
    Dropzone.options.myDropzone1 = {


        url: "{{ route('guardar.informe', [$surgery, 2]) }}",
            headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
         },
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
            return time+file.name;
            },
            // autoProcessQueue:true,
            // maxFilesize: 10, //peso del archivo q se subira
            // maxFiles:3,  //cantidad de archivos q se guardaran en bd asi se hayan colocado mas
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file,response)
            {
                var name = file.xhr.response;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("eliminarA") }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        filename: name
                        },
                    success: function (data){                 //si no trae valores
                            Swal.fire({
                                title: 'Archivo eliminado correctamente',
                                text: 'Click en OK para continuar',
                                type: 'success',
                            });
                        // console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function(file, response)
            {
                console.log('controlador',response);
            },
            error: function(file, response)
            {
            return false;
            }
    }

</script>

<script>
    Dropzone.options.myDropzone2 = {


        url: "{{ route('guardar.informe', [$surgery, 3]) }}",
            headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
         },
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
            return time+file.name;
            },
            // autoProcessQueue:true,
            // maxFilesize: 10, //peso del archivo q se subira
            // maxFiles:3,  //cantidad de archivos q se guardaran en bd asi se hayan colocado mas
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file,response)
            {
                var name = file.xhr.response;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("eliminarD") }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        filename: name
                        },
                    success: function (data){                 //si no trae valores
                            Swal.fire({
                                title: 'Archivo eliminado correctamente',
                                text: 'Click en OK para continuar',
                                type: 'success',
                            });
                        // console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function(file, response)
            {
                console.log('controlador',response);
            },
            error: function(file, response)
            {
            return false;
            }
    }

</script>
@endsection
