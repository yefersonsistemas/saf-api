@extends('dashboard.layouts.app')

@section('cites','active')    
@section('newCite','active')

@section('title','Crear una nueva cita')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">

<style>
    .wizard > .steps > ul > li {
        font-size: 12px;
        width: 206px;
    }
    .wizard a, .tabcontrol a {
        outline: 0;
        margin-top: 28px;
    }
    .wizard > .content {
        min-height: 39rem;
    }

    .dropify-wrapper {
        height: 130px;
    }

    .page .section-body {
        margin-top: 26px;
    }

    .centrado{
        align-self: center;
    }
</style>
@endsection

@section('content')

<div class="section-body">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form id="wizard_horizontal" method="POST" action="" class="card">
                            @csrf
                            <h2>Buscar Paciente</h2>
                            <section>
                                <div class="row clearfix">                    
                                    <div class="col-lg-12">
                                        <div class="card-body">
                                            <h2 class="card-title">Edit Profile</h2>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Tipo de documento</label>
                                                        <select class="custom-select" name="type_dni" id="type_dni">
                                                            <option value="0">----Seleccione----</option>
                                                            <option value="V">V</option>
                                                            <option value="E">E</option>
                                                            <option value="J">J</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8 col-md-5">
                                                    <div class="form-group">
                                                        <label class="form-label">Dni</label>
                                                        <input type="text" id="dni" class="form-control" placeholder="DNI" value="">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="newPerson" id="newPerson">
                                                <div class="col-sm-5 col-md-3">
                                                    <div class="form-group">
                                                        <a id="search" class="btn btn-primary form-control"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-2">
                                                    <div class="card">
                                                            <h3 class="card-title">Foto</h3>
                                                        <div class="card-body">
                                                            <input disabled id="photo" type="file" class="dropify">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-4 centrado">
                                                    <div class="form-group">
                                                        <label class="form-label">Nombre</label>
                                                        <input type="text" id="name" name="name" disabled class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-4 centrado">
                                                    <div class="form-group">
                                                        <label class="form-label">Apellido</label>
                                                        <input type="text" disabled id="lastname" name="lastname" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Correo Electrónico</label>
                                                        <input type="text" disabled id="email" name="email" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Dirección</label>
                                                        <input type="text" disabled id="address" name="address" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Teléfono</label>
                                                        <input type="number" disabled id="phone" name="phone" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="card-footer text-right">
                                            <button type="submit" id="submit" class="btn btn-success" disabled>Registrar paciente</button>
                                        </div> --}}
                                    </div>
                                </div>
                            </section>
                            <h2>Elegir Especialidad</h2>
                            <section>
                                <div class="row">
                                    @foreach ($specialities as $speciality)
                                        <div class="col-sm-4">
                                            <div class="card" style="width: 18rem;">
                                                <img src="{{ Storage::url($speciality->image->path) }}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $speciality->name }}</h5>
                                                    <p class="card-text">{{ $speciality->description }}</p>
                                                    <a href="#" class="btn btn-primary"><input type="radio" name="speciality" value="{{ $speciality->id }}" id=""></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <input type="hidden" name="speciality" id="speciality">
                                </div>
                            </section>
                            <h2>Elegir Medico</h2>
                            <section>
                                <div class="row" id="medicos">
                                    <input type="hidden" name="doctor" id="doctor">
                                </div> 
                                
                            </section>
                            <h2>Motivo De La Consulta</h2>
                            <section>
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <label class="form-label">About Me</label>
                                        <textarea rows="5" id="motivo" class="form-control" placeholder="Here can be your description"></textarea>
                                    </div>
                                </div>
                            </section>
                            <h2>Elegir Fecha</h2>
                            <section>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card bg-indigo">
                                        <div class="card-header">
                                            <h3 class="card-title text-white">Inline Date Picker</h3>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input data-provide="datepicker" data-date-autoclose="true" id="date" name="date" class="form-control datepicker">
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
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>
    <script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
    <script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
    {{-- <script src="{{ asset('js\dashboard\createCite.js') }}"></script> --}}


    <script>
        var form = $('#wizard_horizontal').show(); 
        form.steps({
            headerTag: 'h2',
            bodyTag: 'section',
            transitionEffect: 'slideLeft',
            onInit: function(event, currentIndex) {
                setButtonWavesEffect(event);
                search();
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
                setButtonWavesEffect(event);
                if (currentIndex === 1)
                {
                    speciality();
                }
                if (currentIndex === 2)
                {
                    schedule();
                }
            },
            onFinished: function (event, currentIndex)
            {
                crear();
                Swal.fire({
                    title: 'Excelente!',
                    text:  'Cita Agendada Exitosamente!',
                    type:  'success',
                });
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
                        })
                        enabled();
                    }
                    if (data[0] == 201) {
                        Swal.fire({
                            title: 'Excelente!',
                            text:  'Paciente encontrado',
                            type:  'success',
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
        }

        function enabled() {
            $('#name').removeAttr('disabled');
            $('#lastname').removeAttr('disabled');
            $('#email').removeAttr('disabled');
            $('#address').removeAttr('disabled');
            $('#phone').removeAttr('disabled');
            $('#submit').removeAttr('disabled');
            $('#photo').removeAttr('disabled');
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
                        title: 'Excelente!',
                        text:  'Especialidad con medicos',
                        type:  'success',
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
            console.log(data.length);
            console.log(data[0].employe[0].image.path);
            console.log(data[0].employe.length);
            for (let i = 0; i < data.length; i++) {
                for (let j = 0; j < data[i].employe.length; j++) {
                    $('#medicos').append('<div class="col-sm-4"> <div class="card" style="width: 18rem;"> <img src="{{ Storage::url('+data[i].employe[j].image.path+') }}" class="card-img-top" alt="..."> <div class="card-body"> <h5 class="card-title">'+data[i].employe[j].person.name+'</h5><a href="#" class="btn btn-primary"><input type="radio" name="doctor" value="'+data[i].employe[j].id+'" id=""></a> </div> </div> </div>');
                }
            }
        }

        function schedule() {
            $("input[name='doctor']").click(function() {
                var doctor = $(this).val();
                $.ajax({
                    url: "{{ route('search.schedule') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: doctor,
                    }
                })
                .done(function(data) {
                    console.log(data);
                    Swal.fire({
                        title: 'Excelente!',
                        text:  'Medico Seleccionado',
                        type:  'success',
                    });
                    $('#doctor').val(data.employe.id);
                    $('.datepicker').datepicker({
                        todayHighlight: true,
                        language: 'es',
                        datesDisabled: data.available,
                    });
                    $('#fecha').val();
                })
                .fail(function(data) {
                    console.log(data);
                })
            });
        }

        function crear(){
            var type_dni    = $("#type_dni").val();
            var dni         = $("#dni").val();
            var name        = $('#name').val()
            var lastname    = $('#lastname').val();
            var email       = $('#email').val();
            var address     = $('#address').val();
            var phone       = $('#phone').val();
            var speciality  = $('#speciality').val();
            var doctor      = $('#doctor').val();
            var motivo      = $('#motivo').val();
            var date        = $('#date').val();
            var person      = $('#newPerson').val();
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
                $('.datepicker').datepicker({
                    todayHighlight: true,
                    language: 'es',
                    datesDisabled: data.available,
                });
            })
            .fail(function(data) {
                console.log(data);
            })
        }

    </script>

    <script>
        // Date picker
        fecha =new Date(2019,10,06),
        console.log(fecha);
    </script>
@endsection