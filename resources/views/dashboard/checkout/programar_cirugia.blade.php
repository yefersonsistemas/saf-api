@extends('dashboard.layouts.app') 
@section('cites','active') 
@section('agendar','active') 
@section('title','Agendar Cirugia')
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

@endsection @section('content')

<div class=" py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
            <form id="wizard_horizontal" method="POST" action="{{ route('surgerys.store') }}" class="card pl-4 pr-4">
                    @csrf
                    <h2>Elegir Medico</h2>
                        <section class="container">
                            <input type="hidden" name="type_surgery_id" id="type_surgery_id" value="{{$paciente->typesurgery->id}}">
                            <input type="hidden" name="patient_id" id="patient_id" value="{{$paciente->person->id}}">
                            <input type="hidden" name="reservation_id" value="{{$paciente->reservation_id }}">
                            <div class="row justify-content-between">
                            @foreach ($medico->employe_surgery as $employe)
                            <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                    <label class="imagecheck m-0">  
                                        <div class="card assigment">
                                            <input type="radio" name="employe_id" value="{{ $employe->id }}" id="employe_id" class="imagecheck-input">
                                            @if (!empty($employe->person->image->path))
                                            <figure class="imagecheck-figure border-0 text-center" style="max-height: 100px; width:170px; ">
                                                <img width="100%" height="100%" src="{{ Storage::url($employe->person->image->path) }}" alt="" class="imagecheck-image w-auto">
                                            </figure>
                                            @else
                                            <figure class="imagecheck-figure border-0 text-center">
                                                <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image w-auto">
                                            </figure>
                                            @endif
                                            <div class="card-body text-center pt-4" style="height:70px; width:170px">
                                                <h6 class="font-weight-bold" style="font-size:15px">{{ $employe->person->name }}&nbsp;{{ $employe->person->lastname }}</h6>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                    </section>
                    <h2>Seleccione Quirofano</h2>
                    <section class="container">
                        <div class="row justify-content-between">
                            @foreach ($quirofano as $quirofano)
                                @if ($quirofano->status == '')
                                    <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                        <label class="imagecheck m-0">
                                            <div class="card assigment">
                                                <input type="radio" name="area_id" value="{{ $quirofano->id }}" id="area_id" class="imagecheck-input">
                                                {{-- @if (!empty($quirofano->image->path)) --}}
                                                <figure class="imagecheck-figure border-0 text-center" style="max-height: 100px; width:170px; ">
                                                    <img width="100%" height="100%" src="{{ asset('assets/images/consultorio.jpg') }}" alt="" class="imagecheck-image w-auto">
                                                </figure>
                                                {{-- @else
                                                <figure class="imagecheck-figure border-0 text-center">
                                                    <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image w-auto">
                                                </figure>
                                                @endif --}}
                                                <div class="card-body text-center pt-4" style="height:70px; width:170px">
                                                    <h6 class="font-weight-bold" style="font-size:15px">{{ $quirofano->name }}</h6>
                                                    <h6 class="card-subtitle mt-1"><span class="badge badge-light text-white bg-verdePastel pl-3 pr-3 pb-2" style="color:#fff">Desocupado</span></h6>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @else    
                                @if ( $quirofano->status == 'ocupado')
                                <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                    <label class="imagecheck m-0">
                                        <div class="card assigment">
                                            <input type="radio" class="imagecheck-input" disabled>
                                            {{-- @if (!empty($quirofano->image->path)) --}}
                                            <figure class="imagecheck-figure border-0 text-center" style="max-height: 100px; width:170px; ">
                                                <img width="100%" height="100%" src="{{ asset('assets/images/consultorio.jpg') }}" alt="" class="imagecheck-image w-auto">
                                            </figure>
                                            {{-- @else
                                            <figure class="imagecheck-figure border-0 text-center">
                                                <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image w-auto">
                                            </figure>
                                            @endif --}}
                                            <div class="card-body text-center pt-4" style="height:70px; width:170px">
                                                <h6 class="font-weight-bold" style="font-size:15px">{{ $quirofano->name }}</h6>
                                                <h6 class="card-subtitle mt-1"><span class="badge badge-light text-danger pl-3 pr-3 pb-1" style="color:red">{{ $quirofano->status }}</span> </h6>
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
                        {{-- <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header bline">
                                    <h3 class="card-title">Calendario</h3>
                                    <div class="card-options">
                                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div> --}}
                        <div id='wrap'>
                        {{-- <div id='external-events'>
                            <h4>Draggable Events</h4>
                            <div id='external-events-list'>
                            <div class='fc-event'>My Event 1</div>
                            <div class='fc-event'>My Event 2</div>
                            <div class='fc-event'>My Event 3</div>
                            <div class='fc-event'>My Event 4</div>
                            <div class='fc-event'>My Event 5</div>
                            </div>
                            <p>
                            <input type='checkbox' id='drop-remove' />
                            <label for='drop-remove'>remove after drop</label>
                            </p>
                        </div> --}}
                    
                        <div id='calendar'></div>
                    
                        <div style='clear:both'></div>
                    
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
{{-- <script src="{{ asset('assets\js\page\calendar.js') }}"></script> --}}
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

    

    $("input[name='employe_id']").click(function(){
        var doctor = $(this).val();
        console.log('hola',doctor);
        Swal.fire({
                title: 'Médico seleccionado!',
                text: 'Click en OK para continuar',
                type: 'success',
                allowOutsideClick:false,
            });
    });

    $("input[name='area_id']").click(function(){
        var quirofano = $(this).val();
        console.log('hola',quirofano);
        Swal.fire({
                title: 'Médico seleccionado!',
                text: 'Click en OK para continuar',
                type: 'success',
                allowOutsideClick:false,
            });
    });

</script>

@endsection