@extends('dashboard.layouts.app')
@section('cites','active')
@section('newCite','active')
@section('title','Crear una nueva cita')
@section('inrol','d-block')
@section('dire','d-none')
@section('css')
<link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">

@endsection @section('content')

<div class="py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form id="wizard_horizontal" method="POST" action="" class="card pl-4 pr-4 m-0">
                    @csrf
                    <h2>Buscar Paciente</h2>
                    <section class="py-1">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title">Datos del paciente</h2>
                                    </div>
                                    <div class="card-body py-0">
                                        <div class="col-lg-4  col-md-6">
                                            <div class="form-group d-flex flex-row  align-items-center">
                                                <div class="input-group">
                                                    <div class="input-group-prepend bg-white">
                                                        <span class="input-group-text btn-turquesa"><i
                                                                class="fa fa-id-card"></i></span>
                                                    </div>
                                                    <div class="input-group-prepend">
                                                        <select name="type_dni" id="type_dni"
                                                            class="custom-select input-group-text bg-white">
                                                            <option value="">...</option>
                                                            <option value="N">N</option>
                                                            <option value="E">E</option>
                                                        </select>
                                                    </div>
                                                    <input type="text" class="form-control mr-2" type="text" id="dni"
                                                        maxlength="9" placeholder="Cédula" value="">
                                                    <input type="hidden" name="newPerson" id="newPerson">
                                                    <button type="button" id="search"
                                                        class="btn btn-azuloscuro text-white "><i
                                                            class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 d-flex justify-content-center">
                                                <input type="hidden" name="file" id="foto">
                                                <div class="avatar-upload">
                                                    <div class="avatar-preview avatar-edit">
                                                        <div id="imagePreview" style="background-image: url();">
                                                        </div>
                                                        <button disabled type="button" data-toggle="modal"
                                                            data-target="#photoModal"
                                                            class="btn btn-azuloscuro position-absolute btn-camara"><i
                                                                class="fa fa-camera"></i></button>
                                                    </div>
                                                    {{-- <div class="avatar-preview avatar-edit">
                                                    <div id="imagePreview" style="background-image: url();">
                                                    </div>
                                                    <button type="button" data-toggle="modal" data-target="#photoModal" class="btn btn-azuloscuro position-absolute btn-camara"><i class="fa fa-camera"></i></button>
                                                </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 centrado">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre</label>
                                                    <input type="text" id="name" name="name" disabled
                                                        class="form-control" placeholder="Nombre">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 centrado">
                                                <div class="form-group">
                                                    <label class="form-label">Apellido</label>
                                                    <input type="text" disabled id="lastname" name="lastname"
                                                        class="form-control" placeholder="Apellido">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Correo Electrónico</label>
                                                    <input type="text" disabled id="email" name="email"
                                                        class="form-control" placeholder="Correo Electrónico">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Dirección</label>
                                                    <input type="text" disabled id="address" name="address"
                                                        class="form-control" placeholder="Dirección">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Teléfono</label>
                                                    <input type="number" disabled id="phone" name="phone"
                                                        class="form-control" placeholder="Teléfono">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <h2>Elegir Especialidad</h2>
                    <section class="py-1">
                        <div class="row justify-content-between">
                            @foreach ($specialities as $speciality)
                            {{-- <div class="col-6 col-sm-4">
                                    <label class="imagecheck mb-3">
                                        <div class="card max-card text-center">
                                            <div class="card-header text-center ">
                                                    <input type="radio" name="speciality" value="{{ $speciality->id }}"
                            id="" class="imagecheck-input">
                            <figure class="imagecheck-figure border-0">
                                <img src="{{ Storage::url($speciality->image->path) }}" alt=""
                                    class="imagecheck-image max-img">
                            </figure>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $speciality->name }}</h5>
                        </div>
            </div>
            </label>
        </div> --}}
        <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
            <label class="imagecheck m-0">
                <div class="card assigment">
                    <input type="radio" name="speciality" value="{{ $speciality->id }}" id="" class="imagecheck-input">
                    @if (!empty($speciality->image->path))
                    <figure class="imagecheck-figure border-0 text-center" style="max-height: 100px; width:170px; ">
                        <img width="100%" height="100%" src="{{ Storage::url($speciality->image->path) }}" alt=""
                            class="imagecheck-image w-auto">
                    </figure>
                    @else
                    <figure class="imagecheck-figure border-0 text-center">
                        <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image w-auto">
                    </figure>
                    @endif
                    <div class="card-body text-center pt-4" style="height:70px; width:170px">
                        <h6 class="font-weight-bold" style="font-size:15px">{{ $speciality->name }}</h6>
                    </div>
                </div>
            </label>
        </div>
        @endforeach
        <input type="hidden" name="speciality" id="speciality">
    </div>
    </section>
    <h2>Elegir Medico</h2>
    <section class="py-1">
        <div class="row justify-content-between" id="medicos">         
        </div>     
        <input type="hidden" name="doctor" id="doctor">
    </section>
    <h2>Motivo De La Consulta</h2>
    <section class="container">
        <div class="col-md-9 m-auto ">
            <div class="form-group mb-0">
                <label class="form-label">Motivo de la consula</label>
                <textarea rows="5" id="motivo" class="form-control" placeholder="Motivo de la Consulta"></textarea>
            </div>
        </div>
    </section>
    <h2>Elegir Fecha</h2>
    <section class="py-1 align-items-center">
        <div class="col-md-8 mx-auto mt-3">
            <div class="card card-date">
                <div class="card-header">
                    <h3 class="card-title">Elegir Fecha</h3>
                </div>
                <div class="form-group mx-4">
                    <div class="input-group date">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        {{-- <input value="" data-provide="datepicker" data-date-autoclose="true" id="picker" name="date" class="form-control datepicker" autocomplete="off"> --}}
                        <input value="" id="picker" name="date" class="form-control">
                    </div>
                    <div id="div">
                        <div class="inline-datepicker" data-provide="datepicker"></div>
                    </div>                  
                </div>              
            </div>
        </div>
    </section>
    </form>
</div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h1>Selecciona un dispositivo</h1>
                <div>
                    <select name="listaDeDispositivos" id="listaDeDispositivos"></select>
                    <input type="hidden" name="tokenmodalfoto" id="tokenfoto" value="{{ csrf_token() }}">
                    <input type="hidden" name="patient" id="person-id" value="">
                    <input type="hidden" name="image" id="imagen-id" value="">
                    <p id="estado"></p>
                </div>
                <video muted="muted" id="video" class="col-12"></video>
                <canvas id="canvas" style="display: none;" name="foto"></canvas>
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-azuloscuro text-white" id="boton" data-dismiss="modal">Tomar foto</button>
                </div>
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
{{--<script src="{{ asset('js\dashboard\createCite.js') }}"></script> --}}
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
            search();
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
            if (currentIndex === 1) {
                speciality();
            }

            if (currentIndex === 2) {
                schedule();
            }
        },
        onFinished: function(event, currentIndex) {
            crear();
            Swal.fire({
            title: 'Cita Agendada!',
            text: "Click OK para cerrar!!",
            type: 'success',
            allowOutsideClick:false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: '<a href="{{ route('checkin.day') }}" style="color:#fff">OK</a>'
            })
            // .then((result) => {
            //     if (result.value) {
            //     }
            .then(function(){
                window.location.href = '{{ route('checkin.day') }}'
            })
        }
    });

    function setButtonWavesEffect(event) {
        $(event.currentTarget).find('[role="menu"] li a').removeClass('');
        $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('');
    }

    function search() {
        $("#search").click(function() {
            var type_dni = $("#type_dni").val();
            var dni = $("#dni").val();

            console.log(type_dni)
            console.log(dni)

            if(type_dni == '' || dni ==  '' || dni.length < 7){
                Swal.fire({
                    title: 'Datos incompletos.!',
                    text: 'Por favor introduzca el documento de identidad completo.',
                    allowOutsideClick:false,
                });
            }else{

            ajax(type_dni, dni);
            }
        });
    }

    function ajax(type_dni, dni) {
        $.ajax({
                url: "{{ route('search.patient') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type_dni: type_dni,
                    dni: dni
                }
            })
            .done(function(data) {
                if (data[0] == 202) {
                    Swal.fire({
                        title: 'Paciente no encontrado.!',
                        text: 'Por favor realice el registro.',
                        // type: 'error',
                        allowOutsideClick:false,
                    })
                    enabled();
                }
                if (data[0] == 201) {
                    Swal.fire({
                        title: 'Excelente!',
                        text: 'Paciente encontrado',
                        type: 'success',
                        allowOutsideClick:false,
                    })
                    disabled(data);
                }
            })
            .fail(function(data) {
                console.log(data);
            })
    }

    function disabled(data) {
        $('#name').val(data.person.name);
        $('#lastname').val(data.person.lastname);
        $('#email').val(data.person.email);
        $('#address').val(data.person.address);
        $('#phone').val(data.person.phone);
        $('#newPerson').val(data.person.id);
        $('.avatar-preview').load(
            $('#person-id').val(data.person.id),
            $('#imagen-id').val(data.person.image.id),
            $('#imagePreview').css('background-image', `url(/storage/${data.person.image.path})`),
                $('#imagePreview').hide(),
                $('#imagePreview').fadeIn(650)
        );

        $("#photo").attr('disabled', true);
        $(".dropify-wrapper").addClass('disabled');
        $('#name').attr('disabled', true);
        $('#lastname').attr('disabled', true);
        $('#email').attr('disabled', true);
        $('#address').attr('disabled', true);
        $('#phone').attr('disabled', true);
        $('#submit').attr('disabled', true);
        // $("#photo").val(data.person.photo);
        // $('.dropify-render')
    }

    function enabled() {
        $("#photo").val('');
        $('#name').val('');
        $('#lastname').val('');
        $('#email').val('');
        $('#address').val('');
        $('#phone').val('');
        $("#photo").removeAttr('disabled');
        $(".dropify-wrapper").removeClass('disabled');
        $('#name').removeAttr('disabled');
        $('#lastname').removeAttr('disabled');
        $('#email').removeAttr('disabled');
        $('#address').removeAttr('disabled');
        $('#phone').removeAttr('disabled');
        $('#submit').removeAttr('disabled');
        $('#newPerson').val('nuevo');
        $('.btn-camara').removeAttr('disabled');
        $('.avatar-preview').load(
            $('#imagePreview').css('background-image', `url()`),
                $('#imagePreview').hide(),
                $('#imagePreview').fadeIn(650)
        );
    }

    function speciality() {
        $("input[name='speciality']").click(function() {
            var speciality = $(this).val();
            $.ajax({
                    url: "{{ route('search.medic') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: speciality,
                    }
                })
                .done(function(data) {
                    Swal.fire({
                        title: 'Realizado!',
                        text: 'Click en OK para continuar',
                        type: 'success',
                        allowOutsideClick:false,
                    });
                    $('#speciality').val(data[0].id);
                    cargarMedicos(data);
                })
                .fail(function(data) {
                    console.log(data);
                })
        });
    }

    function cargarMedicos(data) {
        // console.log('dataaaa',data.length);
        // console.log('imagen',data[0].employe[0].image.path);
        // console.log(data[0].employe.length);
        $('#medicos').empty();
        for (let i = 0; i < data.length; i++) {
            for (let j = 0; j < data[i].employe.length; j++) {
                $('#medicos').append(`<div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                        <label class="imagecheck m-0">
                                        <div class="card assigment">
                                                <input type="radio" name="doctor"  value="${data[i].employe[j].id }" id="doctore" class="imagecheck-input">
                                                <figure class="imagecheck-figure border-0 text-center" style="max-height: 100px; width:170px;">
                                                    <img width="100%" height="100%" src="/storage/${data[i].employe[j].image.path}" alt="" class="imagecheck-image m-auto">
                                                </figure>
                                                <div class="card-body text-center bg-grisinus pt-4" style="height:70px; width:170px">
                                                    <h6 class="font-weight-bold" style="font-size:15px">${data[i].employe[j].person.name} ${data[i].employe[j].person.lastname}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        </label>
                                    </div>`);
            }
        }
    }

    function schedule() {
        $(document).on('click', '#doctore', function(event) {
            // let id = this.name;

         // $("input[name='doctor']").click(function() {
            // $('.inline-datepicker').empty();
            // doctor = '';
            var doctor = $(this).val();
            // var doctor = g;
            console.log('jajaja',doctor);
            console.log('otro',doctor);
            $.ajax({
                    url: "{{ route('search.schedule') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: doctor,
                    }
                })
                .done(function(data) {
                    // console.log('Doctores:',data);
                    // console.log('Fechas disponibles de los Doctores',data.available);
                    Swal.fire({
                        title: 'Médico seleccionado!',
                        text: 'Click en OK para continuar',
                        type: 'success',
                        allowOutsideClick:false,
                    });
                    $('#doctor').val(data.employe.id);
                    $('#picker').val("");   
                    $('#div').html(`<div class="inline-datepicker" data-provide="datepicker"></div>`);
                    
                //  $(".inline-datepicker").val("");
                    $('.inline-datepicker').datepicker({
                        todayHighlight: true,
                        language: 'es',
                        startDate: data.start,
                        endDate: data.end,
                        daysOfWeekHighlighted: [0,6],
                        datesDisabled: data.diff,
                    });
                    $('#fechas').val();
                    $('.inline-datepicker').on('changeDate', function() {
                        $('#picker').val(
                            $('.inline-datepicker').datepicker('getFormattedDate')
                        );
                });    
                })
                .fail(function(data) {
                    console.log(data);
                })
            });
    }


    function crear() {
        var type_dni = $("#type_dni").val();
        var dni = $("#dni").val();
        var name = $('#name').val()
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var phone = $('#phone').val();
        var speciality = $('#speciality').val();
        var doctor = $('#doctor').val();
        var motivo = $('#motivo').val();
        var date = $('#picker').val();
        var person = $('#newPerson').val();
        var image = $('#foto').val();
        console.log('hoaws',image);
        console.log('al enviar', date);
        console.log('haha', person);

        $.ajax({
                url: "{{ route('reservation.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type_dni: type_dni,
                    dni: dni,
                    name: name,
                    lastname: lastname,
                    email: email,
                    address: address,
                    phone: phone,
                    speciality: speciality,
                    doctor: doctor,
                    motivo: motivo,
                    date: date,
                    person: person,
                    image: image
                }
            })
            .done(function(data) {
                console.log(data);
                $('.inline-datepicker').datepicker({
                    todayHighlight: true,
                    language: 'es',
                    datesDisabled: data.available,
                    daysOfWeekDisabled: '0',
                });

            })
            .fail(function(data) {
                console.log(data);
            })
        }
</script>
<script>

</script>
@endsection
