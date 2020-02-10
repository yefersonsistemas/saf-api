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
                <form id="wizard_horizontal" method="POST" action="{{ route('guardar.cirugia') }}" class="card pl-4 pr-4">
                    @csrf
                    <h2>Elegir Procedimiento</h2>
                    <section class="py-1">
                        <input type="hidden" name="patient_id" id="patient_id" value="{{$paciente->id}}">
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
                                            <span> {{$procedure->price}}</span>
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
                    <section class="py-1">
                        <div class="card-body">
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
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/brandAn.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
{{--<script src="{{ asset('js\dashboard\createCite.js') }}"></script> --}}

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
            // search();
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);

            if (currentIndex === 1) {
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


    function schedule() {
        $("input[name='employe']").click(function() {
            var employe = $(this).val();
            console.log('empleado_id',employe);
            $.ajax({
                    url: "{{ route('search.schedule') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: employe,
                    }
                })
                .done(function(data) {
                    Swal.fire({
                        title: 'Realizado!',
                        text: 'Click en OK para continuar',
                        type: 'success',
                        allowOutsideClick:false,
                    });
                    // $('#employe_id').val(data.employe.id);
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
</script>
@endsection
