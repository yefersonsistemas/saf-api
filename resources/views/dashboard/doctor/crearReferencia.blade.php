@extends('dashboard.layouts.app')
@section('doctor','active')
@section('docrol','d-block')
@section('dire','d-none')
@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-colorpicker\css\bootstrap-colorpicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title','Referencia')

@section('content')
<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            {{-- Contadores --}}
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Total De Citas Agendadas</h6>
                        <h4 class="pt-2"><i class="fa fa-address-book"></i> <span class="counter">2,250</span></h4>
                        {{--
                        <h5>$1,25,451.23</h5> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Total De Citas Del Mes</h6>
                        <h4 class="pt-2"><i class="fa fa-calendar"></i> <span class="counter">750</span></h4>
                        {{--
                        <h5>$3,80,451.00</h5> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Citas Para Hoy</h6>
                        <h4 class="pt-2"><i class="fa fa-users"></i> <span class="counter">25</span></h4>
                        {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 65.27%</span> Since last month</span> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Atendidos Hoy</h6>
                        <h4 class="pt-2"><i class="fa fa-user"></i> <span class="counter">5</span></h4>
                        {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 165.27%</span> Since last month</span> --}}
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="col-lg-10 mx-auto">
                    <form class="" method="POST" action="{{ route('reference.store', $patient) }}">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> <a href="javascript:history.back(-1);"
                                        class="btn btn-sm btn-azuloscuro mr-3 text-white"><i
                                            class="icon-action-undo  mx-auto"></i></a>Crear Referencia</h3>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Datos del Paciente</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Documento de Identidad:</label>
                                            <div class="input-group ">
                                                <div class="input-group-prepend col-md-3 p-0">
                                                    <input type="text" class="form-control input-group-text bg-white border-0" placeholder="Tipo de documento" name="type_dni" disabled value="{{ $patient->type_dni }}">
                                                </div>
                                                <input type="text" class="form-control bg-white border-0" placeholder="Documento de Identidad" name="dni" disabled value="{{ $patient->dni }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Nombre:</label>
                                            <input type="text" class="form-control border-0 bg-white" disabled placeholder="Nombre" value="{{ $patient->name }}" name="name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Apellido:</label>
                                            <input type="text" class="form-control border-0 bg-white" disabled placeholder="lastname" value="{{ $patient->lastname }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <label class="form-label" >Especialidad:</label>
                                        <select class="form-control custom-select" name="speciality" id="speciality">
                                            <option value="0" >Seleccione</option>
                                            @foreach ($specialities as $speciality)
                                                <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                            <div class="form-group" style=" margin-top:8px;">
                                                    <div class="custom-controls-stacked d-flex justify-content-between">
                                                        <label class="custom-control custom-radio custom-control-inline flex-column col-md-6 form-label ">
                                                            <input type="radio" class="custom-control-input" name="tipoMedico" value="Interno" id="interno">
                                                            <span class="custom-control-label">Medico Interno</span>
                                                            <select class="form-control custom-select" name="doctor" id="medicoInterno">
                                                                    <option>Medico Interno</option>
                                                            </select>
                                                        </label>
                                                        <label class="custom-control custom-radio custom-control-inline flex-column col-md-6 form-label ">
                                                            <input type="radio" class="custom-control-input" name="tipoMedico" value="Externo" id="externo">
                                                            <span class="custom-control-label">Medico Externo</span>
                                                            <input type="text" id="medicoExterno" class="form-control"  placeholder="" name="doctorExterno" >
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                    {{-- <div class="col-md-4">
                                        <label>Medico Interno</label>
                                        <select class="form-control custom-select" name="doctor" id="medicoInterno">
                                            <option>Medico Interno</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-5">
                                        <div class="form-group">
                                                <label class="form-label">Medico Externo</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <a class="btn btn-azuloscuro input-group-text text-white" id="doctorExterno">Medico externo</a>
                                                    </div>
                                                    <input type="text" id="medicoExterno" disabled class="form-control"  placeholder="" name="doctorExterno" value="">
                                                </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Razon</label>
                                            <textarea name="reason" id="reason" cols="30" rows="10" class="form-control text-razon" placeholder="Razon"></textarea>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-azuloscuro">Generar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets\plugins\bootstrap-colorpicker\js\bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src="{{ asset('assets\css\brandAn.js') }}"></script>
<script>

   $('input[name="tipoMedico"]').on('click',function(){

       if ($('#interno').is(':checked')) {
          $('#medicoExterno').attr('disabled', 'disabled');
          $('#medicoInterno').removeAttr('disabled');
          $('#medicoExterno').val(null);
       }

       if($('#externo').is(':checked')){
        $('#medicoInterno').attr('disabled', 'disabled');
        $('#medicoInterno').val(null);
        $('#medicoExterno').removeAttr('disabled');
       }
   })
  

    $("#speciality").change(function() {
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
                console.log(data);
                cargarMedicos(data);
            })
            .fail(function(data) {
                console.log(data);
            })
    });

    function cargarMedicos(data) {
        $('#medicoInterno').empty();
        for (let i = 0; i < data.length; i++) {
            console.log(data[i].employe.length);
            console.log(data[i].employe);
            for (let j = 0; j < data[i].employe.length; j++) {
                console.log(data[i].employe[j].id);
                $('#medicoInterno').append(`<option value="${data[i].employe[j].id}">${data[i].employe[j].person.name} ${data[i].employe[j].person.lastname}</option>`);
            }
        }
    }

    $('#doctorExterno').click(function () {
        console.log($('#medicoExterno').attr("disabled"))
        if ($('#medicoExterno').attr("disabled") == 'disabled') {
            $('#medicoExterno').removeAttr('disabled');
            $('#medicoInterno').attr('disabled', true);
        }
        if ($('#medicoExterno').attr("disabled") == 'undefined') {
            $('#medicoExterno').attr('disabled', true);
        }
    });

</script>
@endsection