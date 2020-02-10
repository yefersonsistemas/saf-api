@extends('dashboard.layouts.app')
@section('cites','active')
@section('agendar','active')
@section('title','Agendar Cirugia')
@section('outrol','d-block')
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
{{-- <link rel="stylesheet" href="{{ asset('assets\plugins\fullcalendar\fullcalendar.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">

<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection @section('content')


<div class=" py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
            <form id="wizard_horizontal" method="POST" action="{{ route('guardar.cirugia') }}" class="card pl-4 pr-4">
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
                                                        <option>...</option>
                                                        <option>N</option>
                                                        <option>E</option>
                                                    </select>
                                                    </div>
                                                        <input type="text" maxlength="9" class="form-control mr-2" type="text" id="dni" placeholder="Cédula" value="">
                                                    <input type="hidden" name="patient_id" id="patient_id" value="">
                                                    <button type="button" id="search" class="btn btn-azuloscuro text-white" ><i
                                                            class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 mb-2">
                                                <input id="photo" type="file" class="dropify" disabled name="photo" data-default-file="" value="">
                                            </div>
                                            <div class="col-lg-4 col-md-6 centrado">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre</label>
                                                    <input type="text" id="name" name="name" disabled class="form-control" placeholder="Nombre" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 centrado">
                                                <div class="form-group">
                                                    <label class="form-label">Apellido</label>
                                                    <input type="text" disabled id="lastname" name="lastname" class="form-control" placeholder="Apellido" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Correo Electrónico</label>
                                                    <input type="text" disabled id="email" name="email" class="form-control" placeholder="Correo Electrónico" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Dirección</label>
                                                    <input type="text" disabled id="address" name="address" class="form-control" placeholder="Dirección" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Teléfono</label>
                                                    <input type="number" disabled id="phone" name="phone" class="form-control" placeholder="Teléfono" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <h2>Elegir Procedimientos</h2>
                    <section>
                        <div class="row justify-content-between">
                            <div class="card p-3">
                              
                                <div class="form-group">
                                    @foreach ($procedures as $procedure)
                                    <div class="row">
                                        <div class="col-9">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="procedure[]" value="{{ $procedure->id }}">  
                                                <span class="custom-control-label">{{ $procedure->name }} </span>
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <span>{{ $procedure->price }} </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                {{-- <div class="  table-responsive mb-4">
                                    <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                        <thead>
                                            <tr>
                                                <th>Nombre </th>  
                                                <th>Precio </th>                                                                                      
                                            </tr>
                                        </thead>
                                        </tfoot>
                                        <tbody id="modal_enfermedad">
                                            @foreach ($procedures as $procedure)
                                                    <tr class="p-0 m-0">
                                                        <td class="py-0 my-1">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="procedure[]" value="{{ $procedure->id }}">  
                                                                <span class="custom-control-label">{{ $procedure->name }} </span>
                                                            </label>
                                                        </td>  
                                                        <td>{{ $procedure->price }}</td>                                                             
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div> --}}
                            </div>
                        </div>
                    </section>
                    <h2>Elegir Medico</h2>
                    <section>
                        <div class="card-body py-1">
                            <div class="row gutters-sm d-row d-flex justify-content-between">
                                @foreach ($em as $employe)
                                    <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                        <label class="imagecheck m-0">
                                            <div class="card assigment">
                                                @foreach ($employe->speciality as $item)
                                                <input type="hidden" name="speciality_id" value="{{ $item->id }}">
                                                @endforeach
                                                <input type="radio" name="employe" value="{{ $employe->id}} " id="employe" class="imagecheck-input">
                                                @if (!empty($employe->image->path))
                                                <figure class="imagecheck-figure border-0 text-center" style="max-height: 100px; width:170px; ">
                                                    <img width="100%" height="100%" src="{{ Storage::url($employe->image->path) }}" alt=""
                                                        class="imagecheck-image w-auto">
                                                </figure>
                                                @else
                                                <figure class="imagecheck-figure border-0 text-center">
                                                    <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image w-auto">
                                                </figure>
                                                @endif
                                                <div class="card-body text-center bg-grisinus pt-2 pb-0" style="height:70px; width:100%">
                                                    <h6 class="card-title font-weight-bold m-0 p-0 " style="font-size:13px">{{ $employe->person->name}} {{ $employe->person->lastname}}</h6>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
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

@endsection 
@section('scripts')
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\bundles\fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
{{-- para el calendario js --}}
<script src='{{asset('assets\fullcalendar\packages\core\main.js')}}'></script>
<script src='{{asset('assets\fullcalendar\packages\interaction\main.js')}}'></script>
<script src='{{asset('assets\fullcalendar\packages\daygrid\main.js')}}'></script>
<script src='{{asset('assets\fullcalendar\packages\timegrid\main.js')}}'></script>
<script src='{{asset('assets\fullcalendar\packages\list\main.js')}}'></script>
<script src='{{asset('assets\fullcalendar\js\calendar.js')}}'></script>
<script src='{{asset('assets\fullcalendar\packages\core\locales-all.js')}}'></script>
<script src="{{ asset('assets\js\table\datatable.js') }}"></script>


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

            if (currentIndex === 2) {
                empleado();
            }

            if (currentIndex === 3) {
                schedule();
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
                url: "{{ route('search.patients') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type_dni: type_dni,
                    dni: dni
                }
            })
            .done(function(data) {
                console.log('ee', data);
               
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
        $('#name').val(data.patient.person.name);
        $('#lastname').val(data.patient.person.lastname);
        $('#email').val(data.patient.person.email);
        $('#address').val(data.patient.person.address);
        $('#phone').val(data.patient.person.phone);
        $('#patient_id').val(data.patient.id);

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

    function empleado() {
        $("input[name='employe']").click(function() {
            var medico = $(this).val();
            console.log(medico);
            $.ajax({
                    url: "{{ route('search.schedule') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: medico,
                    }
                })
                .done(function(data) {
                    Swal.fire({
                        // title: 'Realizado!',
                        text: 'Click en OK para continuar',
                        type: 'success',
                        allowOutsideClick:false,
                    });
                    $('#employe').val(data[0].id);
                    schedule(data);
                })
                .fail(function(data) {
                    console.log(data);
                })
        });
    }
    
    function schedule(data) {

        $('#picker').val("");   
        $('#div').html(`<div class="inline-datepicker" data-provide="datepicker"></div>`);
    
        $('.inline-datepicker').datepicker({
            todayHighlight: true,
            language: 'es',
            startDate: data.start,
            endDate: data.end,
            daysOfWeekHighlighted: [0,6],
            datesDisabled: data.diff,
        });

        $('#doctor').val(data.employe.id);
        $('#fechas').val();
        $('.inline-datepicker').on('changeDate', function() {
            $('#picker').val(
                $('.inline-datepicker').datepicker('getFormattedDate')
            );
        }); 
    }     
</script>

@endsection