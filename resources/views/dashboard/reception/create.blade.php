@extends('dashboard.layouts.app') 
@section('cites','active') 
@section('newCite','active') 
@section('title','Crear una nueva cita')
@section('css')
<link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">

@endsection @section('content')

<div class=" py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form id="wizard_horizontal" method="POST" action="" class="card pl-4 pr-4">
                    @csrf
                    <h2>Buscar Paciente</h2>
                    <section>
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 class="card-title">Datos del paciente</h2>
                                    </div>
                                    <div class="card-body ">
                                        <div class="col-lg-4  col-md-6">
                                            <div class="form-group d-flex flex-row  align-items-center">
                                                <div class="input-group">
                                                    <div class="input-group-prepend bg-white">
                                                        <span class="input-group-text btn-turquesa"><i
                                                                class="fa fa-id-card"></i></span>
                                                    </div>
                                                    <div class="input-group-prepend">
                                                        <select name="type_dni" id="type_dni" class="custom-select input-group-text bg-white">
                                                            <option value="0">...</option>
                                                            <option value="N">N</option>
                                                            <option value="E">E</option>
                                                        </select>
                                                    </div>
                                                    <input type="text" class="form-control mr-2" type="text" id="dni" placeholder="Cédula" value="">
                                                    <input type="hidden" name="newPerson" id="newPerson">
                                                    <button type="button" id="search" class="btn btn-azuloscuro text-white "><i
                                                            class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 mb-2">
                                                <input id="photo" type="file" class="dropify" disabled name="photo" data-default-file="">
                                            </div>
                                            <div class="col-lg-4 col-md-6 centrado">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre</label>
                                                    <input type="text" id="name" name="name" disabled class="form-control" placeholder="Nombre">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 centrado">
                                                <div class="form-group">
                                                    <label class="form-label">Apellido</label>
                                                    <input type="text" disabled id="lastname" name="lastname" class="form-control" placeholder="Apellido">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Correo Electrónico</label>
                                                    <input type="text" disabled id="email" name="email" class="form-control" placeholder="Correo Electrónico">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Dirección</label>
                                                    <input type="text" disabled id="address" name="address" class="form-control" placeholder="Dirección">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Teléfono</label>
                                                    <input type="number" disabled id="phone" name="phone" class="form-control" placeholder="Teléfono">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <h2>Elegir Especialidad</h2>
                    <section>
                        <div class="row justify-content-between">
                            @foreach ($specialities as $speciality)
                            {{-- <div class="col-6 col-sm-4">
                                    <label class="imagecheck mb-3">
                                        <div class="card max-card text-center">
                                            <div class="card-header text-center ">
                                                    <input type="radio" name="speciality" value="{{ $speciality->id }}" id="" class="imagecheck-input">
                                                <figure class="imagecheck-figure border-0">
                                                    <img src="{{ Storage::url($speciality->image->path) }}" alt="" class="imagecheck-image max-img">
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
                                                <img width="100%" height="100%" src="{{ Storage::url($speciality->image->path) }}" alt="" class="imagecheck-image w-auto">
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
                    <section>
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
                    <section>
                        <div class="col-md-6 m-auto">
                            <div class="card card-date">
                                <div class="card-header">
                                    <h3 class="card-title">Elegir Fecha</h3>
                                </div>
                                <div class="form-group mx-4">
                                    <div class="input-group">
                                        <input data-provide="datepicker" data-date-autoclose="true" id="picker" name="date" class="form-control datepicker" autocomplete="off">
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
@endsection 
@section('scripts')
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
{{--
<script src="{{ asset('js\dashboard\createCite.js') }}"></script> --}}


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
            }).then((result) => {
                if (result.value) {
                }
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
            ajax(type_dni, dni);
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
                console.log(data);
                if (data[0] == 202) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Paciente no encontrado',
                        type: 'error',
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
        console.log('dataaaa',data.length);
        console.log('imagen',data[0].employe[0].image.path);
        console.log(data[0].employe.length);
        $('#medicos').empty();
        for (let i = 0; i < data.length; i++) {
            for (let j = 0; j < data[i].employe.length; j++) {
                $('#medicos').append(`<div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                        <label class="imagecheck m-0">
                                        <div class="card assigment">
                                                <input type="radio" name="doctor" value="${data[i].employe[j].id }" id="" class="imagecheck-input">
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
        $("input[name='doctor']").click(function() {
            var doctor = $(this).val();
            console.log(doctor);
            $.ajax({
                    url: "{{ route('search.schedule') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: doctor,
                    }
                })
                .done(function(data) {
                    console.log('Doctores:',data);
                    console.log('Fechas disponibles de los Doctores',data.available);
                    Swal.fire({
                        title: 'Médico seleccionado!',
                        text: 'Click en OK para continuar',
                        type: 'success',
                        allowOutsideClick:false,
                    });
                    $('#doctor').val(data.employe.id);
                    $('#picker').datepicker({
                        todayHighlight: true,
                        language: 'es',
                        startDate: data.start,
                        endDate: data.end,
                        daysOfWeekHighlighted: [0,6],
                        datesDisabled: data.diff,
                    });
                    $('#fecha').val();
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
        var date = $('#date').val();
        var person = $('#newPerson').val();
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
                }
            })
            .done(function(data) {
                console.log(data);
                $('#picker').datepicker({
                    todayHighlight: true,
                    language: 'es',
                    datesDisabled: data.available,
                    daysOfWeekDisabled: '0'
                });
                window.location.href = "{{ route('checkin.index') }}";
            })
            .fail(function(data) {
                console.log(data);
            })
    }

</script>
<script>

</script>
@endsection