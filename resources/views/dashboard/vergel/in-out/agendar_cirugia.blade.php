


@extends('dashboard.layouts.app')
@section('cites','active')
@section('agendar','active')
@section('title','Agendar Cirugia')
@section('iorol','d-block')
@section('dire','d-none')
@section('css')
<link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
{{-- para el calendario de js --}}
<link href='{{asset('assets\fullcalendar\packages\core\main.css')}}' rel='stylesheet' />
<link href='{{asset('assets\fullcalendar\packages\daygrid\main.css')}}' rel='stylesheet' />
<link href='{{asset('assets\fullcalendar\packages\timegrid\main.css')}}' rel='stylesheet' />
<link href='{{asset('assets\fullcalendar\packages\list\main.css')}}' rel='stylesheet' />
<link href='{{asset('assets\fullcalendar\css\style.css')}}' rel='stylesheet' />
<link rel="stylesheet" href=" {{ asset('\assets\plugins\parsleyjs\css\parsley.css') }} ">
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">

@endsection
@section('content')

<div class=" py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form id="wizard_horizontal" method="POST" action="{{route('inout.hospitalaria_store')}}" class="card pl-4 pr-4">
                    @csrf
                    <h2>Buscar Paciente</h2>
                    <section class="py-1">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body py-0">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col">
                                        <div class="col-lg-4  col-md-6">
                                            <div class="form-group d-flex flex-row align-items-center">
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
                                                    <input type="text" class="form-control mr-2" id="dni" maxlength="9" placeholder="Cédula">
                                                    <input type="hidden" name="patient_id" id="patient_id" >
                                                    <a type="button" id="search" class="btn btn-azuloscuro text-white "><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col md-12" >
                                            <h2 class=" mt-2 text-center card-title">Datos del paciente</h2>
                                          </div>
                                        </div>
                                    </div>
                                 </div>
                                        <div class="row ml-5 ">
                                            <div class="row justify-content-between">
                                            <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                                <label class="imagecheck m-0">
                                                    <div class="card assigment">
                                                        <figure class="imagecheck-figure border-0 text-center">
                                                            <div class="" style="height:180px; width:150px" id="photo">
                                                                <img src="" alt=""  class="img-thumbnail" style=" width:100%; height:100%; background:#000">
                                                            </div>
                                                        </figure>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-lg-4 col-md-6 centrado">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre</label>
                                                    <input type="text" id="name" name="name" disabled class="form-control" placeholder="Nombre" value="" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 centrado">
                                                <div class="form-group">
                                                    <label class="form-label">Apellido</label>
                                                    <input type="text" disabled id="lastname" name="lastname" class="form-control" placeholder="Apellido" value="" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Correo Electrónico</label>
                                                    <input type="text" disabled id="email" name="email" class="form-control" placeholder="Correo Electrónico" value="" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Dirección</label>
                                                    <input type="text" disabled id="address" name="address" class="form-control" placeholder="Dirección" value="" required="">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Teléfono</label>
                                                    <input type="number" disabled id="phone" name="phone" class="form-control number" placeholder="Teléfono" value="" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <h2>Elegir Cirugia</h2>
                    <section>
                        <div class="row justify-content-between">
                            @foreach ($surgery as $surgeries)
                            <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                <label class="imagecheck m-0">
                                    <div class="card assigment p-2">
                                        {{-- aqui --}}
                                        <input type="hidden" value="{{ $surgeries->name }}" id="name_surgery{{ $surgeries->id }}" name="name_surg" class="imagecheck-input">
                                        {{-- aqui --}}
                                        <input type="radio" name="type_surgery_id" value="{{ $surgeries->id }}" id="type_surgery_id" class="imagecheck-input">
                                         @if (!empty($surgeries->image->path))
                                        <figure class="imagecheck-figure border-0 text-center" style="max-height: 100px; width:170px; ">
                                            <img width="100%" height="100%" src="{{ Storage::url($surgeries->image->path) }}" alt="" class="imagecheck-image w-auto">
                                        </figure>
                                        @else
                                        <figure class="imagecheck-figure border-0 text-center">
                                            <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image w-auto">
                                        </figure>
                                        @endif
                                        <div class="card-body text-center pt-4" style="height:70px; width:170px">
                                            <h6 class="font-weight-bold" style="font-size:15px">{{ $surgeries->name }}</h6>
                                         </div>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </section>

                    <h2>Elegir Medico</h2>
                    <section>
                        <div class="row justify-content-between" id="medicos">
                        </div>
                    </section>

                    <h2>Seleccione Quirofano</h2>
                    <section class="container">
                        <div class="row justify-content-between">
                            @foreach ($area as $area)
                                @if ($area->status == '')
                                    <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                        <label class="imagecheck m-0">
                                            <div class="card assigment">
                                                 <input type="radio" name="area_id" value="{{ $area->id }}" id="area_id" class="imagecheck-input">
                                                <figure class="imagecheck-figure border-0 text-center">
                                                    <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image">
                                                </figure>
                                                <div class="card-body text-center pt-4" style="height:70px; width:170px">
                                                     <h6 class="font-weight-bold" style="font-size:15px">{{ $area->name }}</h6>
                                                    <h6 class="card-subtitle mt-1"><span class="badge badge-light text-white bg-verdePastel pl-3 pr-3 pb-2" style="">Desocupado</span></h6>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @else
                                @if ( $area->status == 'ocupado')
                                <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                    <label class="imagecheck m-0">
                                        <div class="card assigment">
                                            <input type="radio" name="area_id" value="" id="area_id" class="imagecheck-input" disabled>
                                            <figure class="imagecheck-figure border-0 text-center">
                                                <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image">
                                            </figure>
                                            {{-- @endif --}}
                                            <div class="card-body text-center pt-4" style="height:70px; width:170px">
                                                 <h6 class="font-weight-bold" style="font-size:15px">{{ $area->name }}</h6>
                                                 <h6 class="card-subtitle mt-1"><span class="badge badge-light text-danger pl-3 pr-3 pb-1" style="color:red">{{ $area->status }}</span> </h6>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endif
                                @endif
                            @endforeach
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
                                        <input value="" id="picker" name="date" class="form-control">
                                    </div>
                                    <div>
                                        <div class="inline-datepicker" data-provide="datepicker" id="datepicker"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- </section> --}}
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\bundles\fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src='{{asset('assets\fullcalendar\packages\core\main.js')}}'></script>
<script src='{{asset('assets\fullcalendar\packages\interaction\main.js')}}'></script>
<script src='{{asset('assets\fullcalendar\packages\daygrid\main.js')}}'></script>
<script src='{{asset('assets\fullcalendar\packages\timegrid\main.js')}}'></script>
<script src='{{asset('assets\fullcalendar\packages\list\main.js')}}'></script>
<script src='{{asset('assets\fullcalendar\js\calendar.js')}}'></script>
<script src='{{asset('assets\fullcalendar\packages\core\locales-all.js')}}'></script>
<script src=" {{ asset('assets\plugins\parsleyjs\js\parsley.min.js') }} "></script>
<script src=" {{ asset('assets\js\form\parsleyjs.js') }} "></script>


<script>
        function stopDefAction(evt) {
        evt.preventDefault();
    }
    
var form = $('#wizard_horizontal').show();
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
                surgery();
            }

            if (currentIndex === 2) {
                doctor();
            }

            if (currentIndex === 3) {
                quirofano();
            }
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

//-------------------------funcion buscar paciente---------------------------

    function search() {
        $("#search").click(function() {
            var type_dni = $("#type_dni").val();
            var dni = $("#dni").val();

            $('#name').val('');
            $('#lastname').val('');
            $('#email').val('');
            $('#address').val('');
            $('#phone').val('');

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
                url: "{{ route('search.inout.patients') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type_dni: type_dni,
                    dni: dni
                }
            })
            .done(function(data) {
                console.log('paciente es', data);
                if (data[0] == 202) {
                    Swal.fire({
                        title: data.message,
                        text: 'Datos Incorrectos o la Persona No es Paciente',
                        type: 'error',
                        allowOutsideClick:false,
                    })
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
        console.log('hola');
        url = '/storage/'+data.patient.person.image.path;
        $('#name').val(data.patient.person.name);
        $('#name_pay').text(data.patient.person.name);
        $('#lastname').val(data.patient.person.lastname);
        $('#lastname_pay').text(data.patient.person.lastname);
        $('#email').val(data.patient.person.email);
        $('#address').val(data.patient.person.address);
        $('#phone').val(data.patient.person.phone);
        $('#patient_id').val(data.patient.id);
        //mostrar en resumen
        // $('#name_surgery').text(data.surgery.name);

        console.log('aqui', url);
        $("#photo").html('<img src="'+url+'" alt="" class="img-thumbnail" style=" width:100%; height:100%; background:#000;">');

        $(".dropify-wrapper").addClass('disabled');
        $('#name').attr('disabled', true);
        $('#lastname').attr('disabled', true);
        $('#email').attr('disabled', true);
        $('#address').attr('disabled', true);
        $('#phone').attr('disabled', true);
        $('#submit').attr('disabled', true);
    }


//----------------------------cirugias registradas------------------------------------



    function surgery() {
        $("input[name='type_surgery_id']").click(function() {


            var surgery = $(this).val();
            console.log("lee aqui para verificar ID de la cirugia",surgery);
            $('#patient_id').text();



            //aqui
            var name = $('#name_surgery'+surgery).val();
             //aqui

            console.log("lee aqui para verificar nombre de la cirugia",name);



            $.ajax({
                    url: "{{ route('inout.search_doctor') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: surgery,
                    }
                })
                .done(function(data) {
                    console.log("este es el dato",data.surgery.employe_surgery);
                    Swal.fire({
                        title: 'Cirugia Seleccionada!',
                        text: 'Click en OK para continuar',
                        type: 'success',
                        allowOutsideClick:false,
                    });
                    cargarMedicos(data);
                })
                .fail(function(data) {
                    console.log(data);
                })
        });
    }




    function cargarMedicos(data) {
        console.log('datos captados---->',data.surgery.employe_surgery[0] );
        $('#medicos').empty();
            for (let j = 0; j < data.surgery.employe_surgery.length; j++) {
                $('#medicos').append(`<div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                        <label class="imagecheck m-0">
                                        <div class="card assigment">

                                                <input type="radio" name="employe_id" value="${data.surgery.employe_surgery[j].id }" id="employe_id" class="imagecheck-input">
                                                 <figure class="imagecheck-figure border-0 text-center" style="max-height: 100px; width:170px;">
                                                    <img width="100%" height="100%" src="/storage/${data.surgery.employe_surgery[j].image.path}" alt="" class="imagecheck-image m-auto">
                                                </figure>
                                                <div class="card-body text-center bg-grisinus pt-4" style="height:70px; width:170px">
                                                    <h6 class="font-weight-bold" style="font-size:15px">${data.surgery.employe_surgery[j].person.name} ${data.surgery.employe_surgery[j].person.lastname}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>`);
        }
        $('#medic').empty();
        for (let j = 0; j < data.surgery.employe_surgery.length; j++)
    {
                $('#medic').append(`<div">

                                            <h6>${data.surgery.employe_surgery[j].person.name} ${data.surgery.employe_surgery[j].person.lastname}</h6>
                                </div>`);
        }
        $('#surgery').empty();
        for (let j = 0; j < data.type_surgery.length; j++) {
                $('#medic').append(`<div">
                                            <h6>${data.type_surgeries[j].name} </h6>
                                </div>`);
        }
    }

//----------------------------Doctores registrados------------------------------------

    function doctor() {
        $("input[name='employe_id']").click(function() {
            var doctor = $(this).val();
            console.log('evento click en doctor funcionando!');
            console.log(doctor);

            Swal.fire({
                title: 'Médico seleccionado!',
                text: 'Click en OK para continuar',
                type: 'success',
                allowOutsideClick:false,
            });
        });
    }

    function quirofano() {
        $("input[name='area_id']").click(function() {
            var quirofano = $(this).val();
            console.log('seleccionaste el quirofano',quirofano);

            Swal.fire({
                title: 'Quirofano seleccionado!',
                text: 'Click en OK para continuar',
                type: 'success',
                allowOutsideClick:false,
            });
        });
    }

</script>
 <script>
    $(".inline-datepicker").datepicker({
        todayHighlight: true,
        language: 'es',
        daysOfWeekHighlighted: [0,6],
     });
    $('.inline-datepicker').on('changeDate', function() {
        $('#picker').val(
            $('.inline-datepicker').datepicker('getFormattedDate')
        );
    });

</script>

<script type="text/javascript">
    // Solo permite ingresar numeros.
    function soloNumeros(e){
        var key = window.Event ? e.which : e.keyCode
        return (key >= 48 && key <= 57)
    }
</script>


@endsection

