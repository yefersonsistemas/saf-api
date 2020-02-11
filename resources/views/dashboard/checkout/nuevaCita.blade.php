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
                        <h2>Motivo De La Consulta</h2>
                        <section class="container">
                            <div class="col-md-9 m-auto ">
                                <div class="form-group mb-0">
                                    <label class="form-label">Motivo de la consula</label>
                                    <textarea rows="5" id="motivo" class="form-control" placeholder="Motivo de la Consulta"></textarea>
                                </div>
                            </div>
                            <input type="hidden" id="employe_id" name="employe" value="{{$itinerary->employe_id}}">
                            <input type="hidden" id="itinerary" value="{{$itinerary->id}}">
                            <input type="hidden" id="newPerson" value="{{$itinerary->person->id}}">
                            <input type="hidden" id="doctor" value="{{$itinerary->employe_id}}">
                            <input type="hidden" id="speciality" value="{{$reservation->speciality->id}}"> 
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
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/brandAn.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>


<script>
     $( document ).ready(function() {
        var employe = $('#employe_id').val();

        console.log('empleado', employe);
        schedule(employe); 
    });

    function stopDefAction(evt) {
        evt.preventDefault();
    }
    
    var form = $('#wizard_horizontal').show();
   
    form.steps({
        headerTag: 'h2',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        // enableAllSteps: false,        
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
            confirmButtonText: '<a href="{{ route('checkout.index') }}" style="color:#fff">OK</a>'
            })
            // .then((result) => {
            //     if (result.value) {
            //     }
            .then(function(){
                window.location.href = '{{ route('checkout.index') }}'
            })
        }
    });

    function setButtonWavesEffect(event) {
        $(event.currentTarget).find('[role="menu"] li a').removeClass('');
        $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('');
    }

   

    function schedule(employe) {
            $.ajax({
                    url: "{{ route('search.schedule') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: employe,
                    }
                })
                .done(function(data) {
                    $('#doctor').val(data.employe.id);

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
    }

    function crear() {
        var date = $('#picker').val();
        var motivo = $('#motivo').val();           
        var person = $('#newPerson').val();
        var doctor = $('#doctor').val();
        var speciality = $('#speciality').val();

        var itinerary = $('#itinerary').val();

        console.log("fecha", date)
        console.log('motivo',motivo);
        console.log('person',person);
        console.log('doctor',doctor);
        console.log('specialidad',speciality);

        $.ajax({
                url: "{{ route('checkout.store_nueva_cita') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    date: date,     //fecha seleccionada
                    motivo: motivo, //motivo que se introduce
                    person: person,  //id del paciente person
                    doctor: doctor, //id del employe                    
                    speciality: speciality,
                    itinerary:itinerary,
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
