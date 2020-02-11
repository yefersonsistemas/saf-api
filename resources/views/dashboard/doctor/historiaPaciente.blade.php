
@extends('dashboard.layouts.app')

@section('doctor','active')


@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\summernote\dist\summernote.css') }}">
<style type="text/css"> button[data-original-title="Code View"], button[data-original-title="Video"],
button[data-original-title="Picture"], button[data-original-title="Link (CTRL+K)"],
button[data-original-title="Help"]{ display: none; }

    .dataTables_filter label{
        color: #434a54;
    }
    .dataTables_filter label input:focus{
        border: 2px solid #00506b;
    }

    .btn-repro{
        background: #ff8000;
        color: #fff;
    }
</style>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection


@section('title','Doctor')

@section('content')
    <div class="section-body  py-4">
        <div class="container-fluid">
            <div class="row clearfix">
                {{-- Contadores --}}
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Total De Citas Agendadas</h6>
                            <h4 class="pt-2"><i class="fa fa-address-book"></i> <span class="counter">{{ $reserva2->count() }}</span></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Total De Citas Del Mes</h6>
                            <h4 class="pt-2"><i class="fa fa-calendar"></i> <span class="counter">{{ $todas }}</span></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Citas Para Hoy</h6>
                            <h4 class="pt-2"><i class="fa fa-users"></i> <span class="counter">{{ $today->count() }}</span></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Atendidos Hoy</h6>
                            <h4 class="pt-2"><i class="fa fa-user"></i> <span class="counter">{{ $yasevieron->count() }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
            {{-- --------Step-----------}}
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                            <!--HEADER-->
                            <a href="javascript:history.back(-1);" class="btn btn-lg btn-azuloscuro text-white position-absolute mt-3 ml-3  "><i class="icon-action-undo mx-auto"></i></a>
                            <div class="container">
                                <div class="row my-3 d-flex flex-row align-items-center">
                                    <div class="col-4 ml-4">
                                        <label class="m-4 d-block p-2 form-label">Nro. Historia: <br>
                                            <span class=" ml-4   badge badge-verdePastel texto  ">{{ $history->patient->historyPatient->history_number }}</span></label>
                                    </div>            
                                    <div class="col-3">
                                        <img src="{{ Storage::url($history->patient->image->path) }}" alt="" class="img-thumbnail" style=" width:100px">
                                    </div>           
                                    <div class="col">
                                        <div class=" d-flex align-items-center">
                                            <label class="m-0 d-block p-2 form-label">DNI:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <select name="type_dni" class="custom-select input-group-text border-0 bg-white" disabled="">
                                                        <option value="{{ $history->patient->type_dni }}">
                                                            {{ $history->patient->type_dni }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control border-0 bg-white dni" placeholder="Documento de Identidad" name="dni" disabled="" value=" {{ $history->patient->dni }}" name="dniP">
                                            </div>
                                        </div>
                                        <div class=" d-flex align-items-center">
                                            <label class="m-0 d-block p-2 form-label">Nombre:</label>
                                            <input type="text" class="form-control border-0 bg-white" disabled="" value="{{ $history->patient->name }}" name="nameP">
                                        </div>
                                        <div class=" d-flex align-items-center">
                                            <label class="m-0 d-block p-2 form-label">Apellido:</label>
                                            <input type="text" class="form-control border-0 bg-white" disabled=""  value="{{ $history->patient->lastname }}" name="lastnameP">
                                        </div>
                                   </div>  
                                </div>
                            <hr style="border: 0;
                            height: 1px;
                            background: #333;
                            background-image: linear-gradient(to right, #ccc, #333, #ccc);">
                                <!--Fin de informacion paciente-->
                            <!--body-->
                            <div class="card-group">
                                {{-- <div id="wizard_vertical"> --}}
                                <form id="wizard_vertical" action="{{ route('diagnostic.store', $history->patient_id) }}" method="POST" class="pb-4 step-doctor">
                                    @csrf
                                    <input type="hidden" id="patient_id" name="patient_id" value="{{ $history->patient_id }}">
                                    <input type="hidden" name="employe_id" value="{{ $history->person_id }}">
                                    <input type="hidden" name="razon" value="{{ $history->description }}">
                                    <input type="hidden" name="reservacion_id" id="reservacion_id" value="{{ $history->id }}">
                                    <h2>Información Personal</h2>
                                    <section class=" p-4 card mr-4 ml-4 pb-0 pt-4">
                                        <article class="ml-3 my-auto">
                                            <h6>Dirección:</h6>
                                            <input type="text" class="form-control border-0 bg-white" disabled="" name="addressP" placeholder="dirección" value="{{ $history->patient->address }}">
                                        </article>
                                        <article class="ml-3 my-auto">
                                            <h6>Correo:</h6>
                                            <input type="emailP" class="form-control border-0 bg-white" disabled="" placeholder="Email" value="{{ $history->patient->email }}">
                                        </article>
                                        <article class="ml-3 my-auto">
                                            <h6>Lugar de nacimiento:</h6>
                                            <input type="text" class="form-control border-0 bg-white"  disabled="" placeholder="Lugar de Nacimiento" value="{{ $history->patient->historyPatient->place }}" name="place">
                                        </article>
                                        <div class="card-group">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Fecha de nacimiento:</h6>
                                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control border-0 bg-white" placeholder="Fecha de naciemiento" disabled="" value="{{ $history->patient->historyPatient->birthdate }}" name="birthdate">
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Edad:</h6>
                                                    <input type="number" class="form-control border-0 bg-white " placeholder="Edad" disabled="" name="age" value="{{ $history->patient->historyPatient->age }}">
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">Genero:</h6>
                                                    <div class="form-check ladymen p-0">
                                                        <div class="custom-control custom-radio custom-control-inline p-0 mr-1">
                                                            <input type="radio" id="genero1" name="gender" class="form-check-input" {{ $history->patient->historyPatient->gender == 'Femenino' ? 'checked':'' }} disabled value="Masculino">
                                                            <label class="form-check-label" for="genero1"><span><i class="fa fa-female"></i></span></label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline p-0 ml-1">
                                                            <input  type="radio" id="genero2" name="gender" class="form-check-input"  {{ $history->patient->historyPatient->gender == 'Masculino' ? 'checked':'' }} disabled value="Femenino">
                                                            <label class="form-check-label" for="genero2"><span><i class="fa fa-male"></i></span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-group">    
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Telefono:</h5>
                                                    <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Telefono" name="phone" value="{{ $history->patient->phone }}">
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                        <h5 class="card-title">Profesión:</h5>
                                                    <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Profesión" name="profession" value="{{ $history->patient->historyPatient->profession }}">
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Ocupación:</h5>
                                                    <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Ocupación" name="occupation" value="{{ $history->patient->historyPatient->occupation }}">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h2>Motivo</h2>
                                    <section class="card mr-4 ml-4 pb-0 pt-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="m-0 form-label">Fecha:</label>
                                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control border-0 bg-white" placeholder="Proxima Cita" disabled="" value="{{ $history->date }}" name=proxCita>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="m-0 form-label">Medico Tratante:</label>
                                                    <div class="input-group d-flex flex-row align-items-center">
                                                        <label for="" class="m-0">Dr.(a) </label>
                                                        <input type="hidden" value="{{ $history->patient_id }}" id="patient"><!--paciente-->
                                                        <input type="hidden" value="{{ $history->person_id }}" id="employe"><!--Empleado-->
                                                        <input type="hidden" value="{{ $history->id }}" id="reservacion"><!--reservation-->

                                                        <input type="text" class="form-control col-md-4 ml-1 border-0 bg-white" disabled="" value="{{ $history->person->name }}" name="nameM">
                                                        <input type="text" class="form-control col-md-4 ml-1 border-0 bg-white" disabled=""  value="{{ $history->person->lastname }}" name="lastnameM">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="m-0 form-label">Razon:</label>
                                                    <input type="text" class="form-control border-0 bg-white" disabled="" value="{{ $history->description }}" name="razon">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h2>Enfermedad Actual</h2>
                                    <section class="ml-4 pb-0 pt -4">
                                        <textarea name="enfermedad_actual" cols="30" rows="10" class="summernote" ></textarea>
                                    </section>
                                    <h2>Antecedentes</h2>   
                                    <section class="ml-4 pb-0 pt-4">
                                        <div id="accordion">
                                            <!-------------------agregar enfermedad-------------------->
                                            <div class="card border border-info rounded">
                                                <div class="card-header bg-azuloscuro" >
                                                    <div class="row" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                        <div class="col-8">
                                                            <h5 class="card-title text-white ">Enfermedades</h5>
                                                        </div>
                                                        <div class="col-4 d-flex justify-content-end">
                                                            <p class="card-title text-white " style="font-size:12px; cursor: pointer;">Ver más</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="collapse card-body list-group " id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion" >
                                                    <div id="mostrar_enfermedad">
                                                        @foreach ($history->patient->historyPatient->disease as $disease )
                                                        <div class="row" id="{{$disease->id}}">
                                                            <div class="col-9">
                                                                <a class="list-group-item list-group-item-action row "><i class="fa fa-check mr-3 text-verdePastel"></i>{{ $disease->name }}</a>
                                                            </div> 
                                                            <div class="col-3">
                                                                <input id="enfermedad_id" name="{{$disease->id}}" style="padding: 7px 20px 7px 20px; font-size:12px; border-radius:7px;" type="button" class="btn-azuloscuro btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip"
                                                                    value="Eliminar">
                                                            </div>
                                                        </div>                                                           
                                                    @endforeach    
                                                    </div>
                                                        <div class="col-12 d-flex justify-content-end mt-4">
                                                            <button class="btn btn-info mx-2" data-toggle="modal" data-target="#enfermedades" style="font-size:12px;"><i class="fa fa-plus"></i>&nbsp;Agregar </button>
                                                            <button class="btn btn-info mx-2" data-toggle="modal" data-target="#nuevaenfermedad" style="font-size:12px;"><i class="fa fa-plus"></i>&nbsp;crear </button>
                                                        </div>                                                      
                                                    </div>
                                            </div>
                                            <!----------------agregar alergias----------------->
                                            <div class="card border border-info rounded">
                                                <div class="card-header bg-azuloscuro" >
                                                    <div class="row" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        <div class="col-8">
                                                            <h5 class="card-title text-white">Alergias</h5>
                                                        </div>
                                                        <div class="col-4 d-flex justify-content-end">
                                                            <p class="card-title text-white" style="font-size:12px; cursor: pointer;">Ver más</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="collapseTwo" class="collapse card-body list-group" aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div id="mostrar_alergias">
                                                        @foreach ( $history->patient->historyPatient->allergy as $allergy )
                                                            <div class="row" id="{{$allergy->id}}">
                                                                <div class="col-9">
                                                                    <a class="list-group-item list-group-item-action row "><i class="fa fa-check mr-3 text-verdePastel"></i>{{ $allergy->name }}</a>
                                                                </div> 
                                                                <div class="col-3">
                                                                    <input id="alergia_id" name="{{$allergy->id}}" style="padding: 7px 20px 7px 20px; font-size:12px; border-radius:7px;" type="button" class="btn-azuloscuro btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip"
                                                                        value="Eliminar">
                                                                </div>
                                                            </div>     
                                                         @endforeach
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end mt-4">
                                                        <button class="btn btn-info mx-2" data-toggle="modal" data-target="#alergias" style="font-size:12px;"><i class="fa fa-plus"></i>&nbsp;Agregar </button>
                                                        <button class="btn btn-info mx-2" data-toggle="modal" data-target="#nuevaalergia" style="font-size:12px;"><i class="fa fa-plus"></i>&nbsp;crear </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--------------------agregar cirugias------------->
                                            <div class="card border border-info rounded">
                                                <div class="card-header bg-azuloscuro" >
                                                    <div class="row" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        <div class="col-8">
                                                            <h5 class="card-title text-white">Cirugias Previas</h5>
                                                        </div>
                                                        <div class="col-4 d-flex justify-content-end">
                                                            <p class="card-title text-white" style="font-size:12px; cursor: pointer;">Ver más</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="collapseThree" class="collapse card-body list-group cirugias" aria-labelledby="headingThree" data-parent="#accordion">
                                                   <div id="agregar_cirugia">
                                                        @if($cite->previous_surgery != null)
                                                        <div class="row" id="cirugia{{$cite->id}}">
                                                            <div class="col-9" id="cirugia{{$cite->id}}">
                                                                <a class="list-group-item list-group-item-action row" >{{ $cite->previous_surgery }}</a>
                                                            </div> 
                                                            <div class="col-3" id="cirugia{{$cite->id}}">
                                                                <input id="borrar_cirugia" name="cirugia{{$cite->id}}" style="padding: 7px 20px 7px 20px; font-size:12px; border-radius:7px;" type="button" class="btn-azuloscuro btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip" 
                                                                    value="Eliminar">
                                                            </div>
                                                        </div> 
                                                        @endif 
                                                   </div>
                                                    <div class="col-12 d-flex justify-content-end mt-4">
                                                            <button class="btn btn-info" data-toggle="modal" data-target="#mcirugias" style="font-size:12px;"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h2>Examen Fisico</h2>
                                    <section class="ml-4 pb-0 pt-4">
                                        <textarea name="examen_fisico" id="" cols="30" rows="10" class="summernote"></textarea>
                                    </section>
                                    <h2>Estudios complementarios</h2>
                                    <section class="ml-4 pb-0 pt-4">
                                        <div class="row">
                                            @foreach ( $cite->person->reservationPatient as $cites )
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-header bg-azuloscuro">
                                                            <h5 class="card-title text-white">{{$cites->date}}</h5>
                                                        </div>
                                                        <div class="card-body">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </section>
                                    <h2>Diagnostico</h2>
                                    <section class="ml-4 pb-0 pt-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <textarea name="diagnostic" id="" cols="30" rows="10" class="summernote"></textarea>
                                            </div>
                                        </div>
                                    </section>
                                    <!------------------------------PROCEDIMIENTOS REALIZADOS---------------------->
                                    <h2>Procedimientos Realizados</h2>
                                    <section class="ml-4 pb-0 pt-4">
                                        <h5>Procedimientos Realizados al Paciente:</h5>
                                        <div class="card">
                                            <div class="card-header">
                                                <button type="button" data-toggle="modal" data-target="#proceconsul" class="btn btn-verdePastel"><i class="fa fa-plus"></i>Agregar Procedimiento</button>
                                                <h6 class="text-center" style="font-weight:bold">Procedimientos Realizados</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-vcenter table-striped"
                                                    cellspacing="0" id="addrowExample">
                                                        <thead>
                                                            <tr>
                                                                <th>Procedimiento Seleccionado</th>
                                                                <th class="text-center"> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="procesc">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h2>Plan</h2>
                                     <section class="ml-4 pb-0 pt-2 plan">
                                        <div class="plan-steps">
                                            <ul style="list-style: none !important" class="nav nav-pills" id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="pills-examenes-tab" data-toggle="pill" href="#pills-examenes" role="tab" aria-controls="pills-examenes" aria-selected="true">Examenes</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-recetario-tab" data-toggle="pill" href="#pills-recetario" role="tab" aria-controls="pills-recetario" aria-selected="false">Recetario</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-informe-tab" data-toggle="pill" href="#pills-informe" role="tab" aria-controls="pills-informe" aria-selected="false">Informe médico</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-reposo-tab" data-toggle="pill" href="#pills-reposo" role="tab" aria-controls="pills-reposo" aria-selected="false">Reposo</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-referencia-tab" data-toggle="pill" href="#pills-referencia" role="tab" aria-controls="pills-referencia" aria-selected="false">Referir a otro médico</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-acciones-tab" data-toggle="pill" href="#pills-acciones" role="tab" aria-controls="pills-acciones" aria-selected="false">Acciones programadas</a>
                                                </li>
                                                {{-- <li class="nav-item">
                                                    <a class="nav-link" id="pills-cita-tab" data-toggle="pill" href="#pills-cita" role="tab" aria-controls="pills-cita" aria-selected="false">Próxima cita</a>
                                                </li> --}}
                                            </ul>
                                        </div>
                                        <div class="tab-content pb-0 pt-4" id="pills-tabContent">
                                            <!--Examen-->
                                            <div class="tab-pane fade show active container" id="pills-examenes" role="tabpanel" aria-labelledby="pills-examenes-tab">
                                                <h5>Examenes Medicos Que El Paciente Se Debe Realizar:</h5>
                                                <div class="row">
                                                    <h6 class="text-center col-12 mt-2 p-2" style="font-weight:bold">Examenes médicos a realizar</h6>
                                                    <div class="col-lg-12 mx-auto">
                                                        <div class="card">
                                                            <div class="card-header my-1 py-3">
                                                                <button type="button" data-toggle="modal" data-target="#examenes" class="btn btn-verdePastel"><i class="fa fa-plus"></i>Agregar examen</button>
                                                            </div>
                                                            <div class="card-body py-1">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover table-vcenter table-striped"
                                                                    cellspacing="0" id="addrowExample">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Examen Seleccionado</th>
                                                                                <th class="text-center">Accion</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="examen">
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Recetario-->
                                            <div class="tab-pane fade" id="pills-recetario" role="tabpanel" aria-labelledby="pills-recetario-tab">
                                                <div class="row clearfix">
                                                    <div class="col-lg-12 mx-auto">
                                                        <div class="card mx-2">
                                                            <div class="card-body">
                                                                <h3 class="card-title">Agregar Medicamento</h3>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Medicamento</label>
                                                                            <select class="form-control custom-select" id="medicamento" name="medicamento">
                                                                                <option value="0">Seleccione</option>
                                                                                @foreach ($medicines as $medicine)
                                                                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-md-3">
                                                                        <div class="form-group">
                                                                        <label class="form-label">Dosis</label>
                                                                        <input type="text" id="dosis" class="form-control" name="dosis" placeholder="3">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Medida</label>
                                                                            <select name="medida" id="medida" class="form-control custom-select">
                                                                                <option value="0">Seleccione</option>
                                                                                <option value="CC">CC</option>
                                                                                <option value="G">G</option>
                                                                                <option value="ML">ML</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-md-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Duracion</label>
                                                                            <input type="text" id="duracion" class="form-control" placeholder="1 Mes" name="duracion" value="{{ old('duracion') }}">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-0">
                                                                    <label class="form-label">Indicaciones</label>
                                                                    <textarea rows="5" id="indicacion" class="form-control" name="indicaciones" placeholder="Tomar 1 diaria" value=""></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer text-right">
                                                                <a class="btn btn-azuloscuro mb-15 text-white" id="add">
                                                                <i class="fe fe-plus-circle" aria-hidden="true"></i> Agregar
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 mx-auto">
                                                        <div class="card">
                                                            <div class="row">
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-hover table-vcenter table-striped"
                                                                        cellspacing="0" id="addrowExample">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Medicamento Seleccionado</th>
                                                                                    <th>Dosis</th>
                                                                                    <th>Medidas</th>
                                                                                    <th>Duracion</th>
                                                                                    <th>Indicaciones</th>
                                                                                    <th>Acciones</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="addRow">
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Informe medico-->
                                            <div class="tab-pane fade mx-2" id="pills-informe" role="tabpanel" aria-labelledby="pills-informe-tab">
                                                <section>
                                                    <textarea name="reporte" id="" cols="30" rows="10" class="summernote"></textarea>
                                                </section>
                                            </div>
                                            <!--Reposo-->
                                            <div class="tab-pane fade mx-2" id="pills-reposo" role="tabpanel" aria-labelledby="pills-reposo-tab">
                                                <section>
                                                    <textarea name="reposop" id="" cols="30" rows="10" class="summernote"></textarea>
                                                </section>
                                            </div>
                                            <!--Referencia-->
                                            <div class="tab-pane fade" id="pills-referencia" role="tabpanel" aria-labelledby="pills-referencia-tab">
                                                <div class="container mt-2 p-0">
                                                    <div class="col-lg-12 mx-auto m-0 ">
                                                        <input type="hidden" id="patient" name="patient" value="{{ $history->patient_id }}">
                                                        <div class="card mr-0 ml-0">
                                                            <div class="card-body m-0">
                                                                <div class="row">
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
                                                                                    <span class="custom-control-label">Médico Interno</span>
                                                                                    <select class="form-control custom-select" name="doctor" id="medicoInterno">
                                                                                        <option value="null">Médico Interno</option>
                                                                                    </select>
                                                                                </label>
                                                                                <label class="custom-control custom-radio custom-control-inline flex-column col-md-6 form-label ">
                                                                                    <input type="radio" class="custom-control-input" name="tipoMedico" value="Externo" id="externo">
                                                                                    <span class="custom-control-label">Médico Externo</span>
                                                                                    <input type="text" id="medicoExterno" class="form-control" required placeholder="" name="doctorExterno" >
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Razon</label>
                                                                            <textarea name="reason" id="reason" cols="30" rows="10" class="form-control text-razon" placeholder="Razon"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class=" text-center row d-flex justify-content-end mb-4 mr-4">
                                                                <a id="referir" class="btn btn-azuloscuro pr-4 pl-4 text-white">Generar referencia</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-acciones" role="tabpanel" aria-labelledby="pills-acciones-tab">
                                                <div class="container">
                                                    <div class="tab-pane fade show active container" id="pills-examenes" role="tabpanel" aria-labelledby="pills-examenes-tab">
                                                        <div class="row">
                                                            <div class="container">
                                                                <div class="row mx-auto">
                                                                     <div class="col-12 justify-content-center text-center">
                                                                        <button class=" mb-3 btn btn-verdePastel px-5 py-2" id="citaProxima">
                                                                            <i style="font-size:25px" class=" fa fa-bell"></i>
                                                                            Notificar proxima cita  
                                                                            
                                                                        </button>
                                                                        <input type="hidden" id="proximaCita" name="proximaCita" value="0">
                                                                    </div>
                                                                 </div>
                                                            </div>
                                                            <div class="col-lg-12 mx-auto">
                                                                <div class="card">
                                                                    <div class="card-header text-start">
                                                                        <button type="button"  class="btn btn-verdePastel" data-toggle="modal" data-target="#surgerys">
                                                                            <i class="fa fa-plus"></i>
                                                                            Agregar Cirugia
                                                                        </button>
                                                                    </div>
                                                                    <div class="card-body py-1">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover table-vcenter table-striped"
                                                                                cellspacing="0" id="addrowExample">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Posible Cirugía</th>
                                                                                        <th class="text-center">Accion</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="cirugias">
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 mx-auto">
                                                                <div class="card">
                                                                    <div class="card-header text-start">
                                                                        <button type="button" data-toggle="modal" data-target="#proces" class="btn btn-verdePastel">
                                                                        <i class="fa fa-plus"></i>
                                                                        Agregar Procedimiento
                                                                        </button>
                                                                    </div>
                                                                    <div class="card-body py-1">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover table-vcenter table-striped"
                                                                                cellspacing="0" id="addrowExample">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Posibles procedimientos </th>
                                                                                        <th class="text-center">Accion</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="procedimientos">
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>                                                                
                                                                </div>                   
                                                            </div>
                                                        </div>
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
      </div>
   </div>

    <!-- Modal para mostar enfermedades-->
    <div class="modal fade " id="enfermedades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable rowww " role="document">
            <div class="modal-content row " style="width: 150%;">
                <div class="modal-header p-2 text-center " style="background-color: #00506b; color: #fff;">
                    <h5 class="col-11 modal-title text-center " id="exampleModalLabel">Enfermedades</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <h6><span aria-hidden="true">&times;</span></h6>
                    </button>
                </div>
                <form action="" id="enfermedad">
                    <div class="  modal-body  " style="max-height: 415px; ">
                        <div class="  form-group">
                            <div class="  custom-controls-stacked">
                                <div class="  tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="  col-lg-12 col-md-12">
                                        <div class="  table-responsive mb-4">
                                            <table class=" table table-hover js-basic-example dataTable table_custom spacing5">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre </th>                                                                                         
                                                    </tr>
                                                    <tr></tr>
                                                   </thead>
                                                </tfoot>
                                                <tbody id="modal_enfermedad">
                                                      @if($enfermedad != null)
                                                        @foreach ($enfermedad as $item)
                                                            <tr class="p-0 m-0">
                                                                <td class="py-0 my-1">
                                                                    <label id="quitar{{$item->id}}" class="custom-control custom-checkbox" >
                                                                        <input type="checkbox" class="custom-control-input" name="name_enfermedad" value="{{ $item->id }}">
                                                                        <span class="custom-control-label">{{ $item->name }} </span>
                                                                    </label>
                                                                </td>                                                               
                                                            </tr>
                                                        @endforeach
                                                    @endif                                                       
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-2 ">
                        <a class="btn btn-azuloscuro rowww text-white" data-dismiss="modal" id="guardarEnfermedad">Agregar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

      <!-------- modal Registrar Enfermedad ------------>
    <div class="modal fade" id="nuevaenfermedad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog rowwww" role="document">
            <div class="modal-content  ">
                <div class="modal-header p-2"  style="background-color: #00506b; color: #fff;">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Registrar Enfermedad</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    
                <div class="modal-body">
                    <input type="text" placeholder="Nombre de la Enfermedad" name="name" value="{{ old('name') }}" class="form-control" required id="newdisease">
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-azuloscuro" id="diseaseR">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostar alergias-->
    <div class="modal fade" id="alergias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable rowww" role="document">
            <div class="modal-content">
                <div class="modal-header p-2" style="background-color: #00506b; color: #fff;">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Alergias</h5>
                    <button type="button" class="btn btn-azuloscuro"data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="form_alergias">
                    <div class="modal-body" style="max-height: 415px;">
                        <div class="form-group">
                            <div class="custom-controls-stacked" id="modal_alergias">
                                @if($alergia != null)
                                    @foreach ($alergia as $item)
                                        <div class="row" id="quitarAlergia{{$item->id}}">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="name_alergia" value="{{ $item->id }}">
                                                <span class="custom-control-label">{{ $item->name }} </span>
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-2">
                        <a  class="btn btn-azuloscuro" data-dismiss="modal" id="guardarAlergias">Agregar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-------------- modal  Registrar Alergia ------------>
    <div class="modal fade" id="nuevaalergia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog rowwww" role="document">
            <div class="modal-content">
                <div class="modal-header p-2" style="background-color: #00506b; color: #fff;">
                        <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Registrar Alergia</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    
                <div class="modal-body">
                    <input type="text" placeholder="Nombre de la Alergia" name="name" value="{{ old('name') }}" class="form-control" required id="newallergy">
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-azuloscuro" id="allergyR">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar cirugias-->
    <div class="modal fade" id="mcirugias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable rowww" role="document">
            <div class="modal-content">
                <div class="modal-header p-2" style="background-color: #00506b; color: #fff;">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Cirugias</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="">
                    <div class="modal-body" style="max-height: 415px;">
                        <div class="form-group">
                            <div class="custom-controls-stacked">
                                <textarea id="form_cirugias" cols="63" rows="5" style="max-height: 400px; height:100%;">{{ $cite->previous_surgery }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-2">
                        <button  class="btn btn-azuloscuro" data-dismiss="modal" id="guardarCirugias">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal de procedimientos en la consulta --}}
    <div class="modal fade" id="proceconsul" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg rowwwww" role="document">
            <div class="modal-content">
                <div class="modal-header p-2" style="background-color: #00506b; color: #fff;">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Procedimientos Realizados</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="proceduresC-office">
                    <div class="modal-body" style="max-height: 415px;">
                        <div class="form-group">
                            <div class="custom-controls-stacked" id="modal_procedureR">
                                @foreach ($procesm->procedures as $proces)
                                <div class="row " id="quitar_procedureR{{$proces->id}}">
                                    <div class="col-9">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="procedures-office" value="{{ $proces->id }}">
                                        <span class="custom-control-label">{{ $proces->name }} </span>
                                    </label>
                                    </div>
                                    <div class="col-3">
                                        <span>{{ $proces->price }} </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-2">
                        <button  class="btn btn-azuloscuro" data-dismiss="modal" id="guardarO">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal de los examenes --}}
    <div class="modal fade" id="examenes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable rowww" role="document">
            <div class="modal-content">
                <div class="modal-header p-2" style="background-color: #00506b; color: #fff;">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Examenes</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="exam">
                    <div class="modal-body m-3">
                        <div class="form-group">
                            <div class="custom-controls-stacked" id="modal_examen">
                                @foreach ($exams as $exam)
                                <label class="custom-control custom-checkbox" id="quitar_examen{{$exam->id}}">
                                    <input type="checkbox" class="custom-control-input" name="exam" value="{{ $exam->id }}">
                                    <span class="custom-control-label">{{ $exam->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-2">
                        <button class="btn btn-azuloscuro" data-dismiss="modal" id="guardarE">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal de los posible cirugia --}}
    <div class="modal fade" id="surgerys" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header p-2" style="background-color: #00506b; color: #fff;">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Cirugias</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="posible-surgerys">
                    <div class="modal-body ml-4 pb-0 pt-2 plan">
                        <div class="plan-steps">
                            <!-- Nav tabs -->
                            <ul style="list-style: none !important" class="nav nav-pills row" id="pills-tab" role="tablist">
                                <li role="presentation" class="active nav-item col-5">
                                    <a class="nav-link active" href="#hospitalariaTab" aria-controls="hospitalariaTab" role="tab" data-toggle="tab">Cirugias Hospitalarias</a>
                                </li>
                                <li class="nav-item col-5" role="presentation">
                                    <a class="nav-link" href="#ambulatoriaTab" aria-controls="ambulatoriaTab" role="tab" data-toggle="tab">Cirugias Ambulatorias</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="hospitalariaTab">
                                    <div class="form-group">
                                        <div class="custom-controls-stacked" id="modal_cirugiaP_hospitalaria">
                                            @foreach ($surgerys as $surgery)
                                            @if ($surgery->classification->name == 'hospitalaria')
                                            <div class="row"  id="quitar_cirugia{{$surgery->id}}">
                                                <div class="col-9">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="radio" class="custom-control-input" name="surgerys" value="{{ $surgery->id }}">
                                                        <span class="custom-control-label">{{ $surgery->name }}</span>
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <span>{{ $surgery->cost }}</span>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="ambulatoriaTab">
                                    <div class="form-group">
                                        <div class="custom-controls-stacked" id="modal_cirugiaP_ambulatoria">
                                            @foreach ($surgerys as $surgery)
                                                @if ($surgery->classification->name == 'ambulatoria')
                                                    <div class="row"  id="quitar_cirugia{{$surgery->id}}">
                                                        <div class="col-9">
                                                            <label class="custom-control custom-checkbox">
                                                            <input type="radio" class="custom-control-input" name="surgerys" value="{{ $surgery->id }}">
                                                            <span class="custom-control-label">{{ $surgery->name }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-3">
                                                            <span>{{ $surgery->cost }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer p-2">
                            <button type="submit" class="btn btn-azuloscuro" data-dismiss="modal" id="guardarC">Guardar</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    {{-- modal de candidatos a posibles procedimientos --}}
    <div class="modal fade" id="proces" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header p-2" style="background-color: #00506b; color: #fff;">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Procedimientos</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="posible-procedures">
                <div class="modal-body" style="max-height: 415px;">
                    <div class="form-group">
                        <div class="custom-controls-stacked" id="modal_procedureP">
                            @foreach ($procesm->procedures as $proces)
                            <div class="row" id="quitar_procedureP{{$proces->id}}">
                                <div class="col-9 mt-3">
                                <label class="custom-control custom-checkbox d-flex">
                                    <input type="checkbox" class="custom-control-input" name="procedures-office" value="{{ $proces->id }}">
                                    <span class="custom-control-label">{{ $proces->name }} </span>
                                </label>
                                </div>
                                <div class="col-3">
                                    <span>{{ $proces->price }} </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-2">
                    <button class="btn btn-azuloscuro" id="guardarP" data-dismiss="modal">Guardar</button>
                </div>
            </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets\bundles\summernote.bundle.js') }}"></script>
<script src="{{ asset('assets\js\page\summernote.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src="{{ asset('assets\css\brandAn.js') }}"></script>

<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>

<script src="{{ asset('assets\plugins\bootstrap-colorpicker\js\bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('assets\bundles\modalSearch.js') }}"></script>
<!-- <script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script> -->
<script src="{{ asset('assets\js\table\datatable.js') }}"></script>

<script>
    $('#selectexam').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
</script>

<script>
    $('#selectprocesm').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
</script>

<script>
    var form = $('#wizard_vertical').show();
    //Vertical form basic
    var procedures=0;
    form.steps({
        headerTag: 'h2',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        stepsOrientation: 'vertical',
        enableAllSteps: true,
        enablePagination: true,
        labels: {
            cancel: "Cancelar",
            current: "Paso actual:",
            pagination: "Paginación",
            finish: "Finalizar",
            next: "Siguiente",
            previous: "Anterior",
            loading: "Cargando ..."
        },
        onFinished: function (event, currentIndex)
        {
            var form = $(this);

            form.submit();
        },
        onInit: function(event, currentIndex) {
            setButtonWavesEffect(event);
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
        }
    });

    function setButtonWavesEffect(event) {
        $(event.currentTarget).find('[role="menu"] li a').removeClass('');
        $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('');
    }

    //--------------------------------------------------RECIPE -------------------------------------

    //================================= Para el recipe============================
    $('#add').click(function () {
        console.log('hola');
        medicina        = $("select[name='medicamento']").val();
        dosis           = $("input[name='dosis']").val();
        medida          = $("select[name='medida']").val();
        duracion        = $("input[name='duracion']").val();
        indicaciones    = $("textarea[name='indicaciones']").val();
        patient         = $("input[id='patient']").val();
        employe         = $("input[id='employe']").val();
        reservacion     = $("input[id='reservacion']").val();

        //con val obtengo  y assigno
        $('#indicacion').val(''); //aqui dice que se limpie o que asigne vacio cuando se cliquea el boton de agregar
        $('#medicamento').val('');
        $('#dosis').val('');
        $('#medida').val('');
        $('#duracion').val('');

        ajaxRecipe(medicina, dosis, medida, duracion, indicaciones, reservacion);

        // validacion(medicina, dosis, medida, duracion, reservacion);
    });

    // function validacion (medicina, dosis, medida, duracion, reservacion){
    // }

    function ajaxRecipe(medicina, dosis, medida, duracion, indicaciones, reservacion){

        $.ajax({
                url: "{{ route('recipe.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    medicina : medicina,
                    dosis: dosis,
                    medida : medida,
                    duracion: duracion,
                    indicaciones: indicaciones,
                    reservacion: reservacion,
                }
            })
            .done(function(data) {
                console.log("hola ken", data);
                if(data[0] == 202){
                    Swal.fire({
                    title: 'Error!',
                    text: data.recipe,
                    type: 'error',
                });
                }else{
                Swal.fire({
                    title: 'Excelente!',
                    text: 'Medicina agregada',
                    type: 'success',
                })
                addRow(data);
            }
            })
            .fail(function(data) {
                console.log(data);
            })
    }

    function addRow(data) {
        $('#addRow').append('<tr class="gradeA"> <td>'+data.medicine.name+'</td> <td>'+data.doses+'</td> <td>'+data.measure+'</td> <td>'+data.duration+'</td> <td>'+data.indications+'</td> <td class="actions"> <button class="btn btn-sm btn-icon on-editing m-r-5 button-save" data-toggle="tooltip" data-original-title="Save" hidden=""><i class="icon-drawer" aria-hidden="true"></i> </button> <button class="btn btn-sm btn-icon on-editing button-discard" data-toggle="tooltip" data-original-title="Discard" hidden=""><i class="icon-close" aria-hidden="true"></i> </button> <button class="btn btn-sm btn-icon on-default m-r-5 button-edit" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i> </button> <button class="btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button></td></tr>');
    }


    //======================Referencia medica=========================

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
                cargarMedicos(data);
            })
            .fail(function(data) {
                console.log(data);
            })
    });

    //=================== cargar medicos ================
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

    $("#select").change(function(){
        var exam_id = $(this).val(); // valor que se enviara al metodo de crear factura
    });

    //---------------------------------------- REFERENCIA MEDICA ----------------------------------------

    //================= referir medico =============
    $('#referir').click(function () {
        var speciality = $("#speciality").val();
        var reason = $("#reason").val();
        var doctor = $("#medicoInterno").val();
        var doctorExterno = $("#medicoExterno").val();
        var patient = $("#patient").val();
        var reservation = $("#reservacion_id").val();

        ajaxReferencia(speciality, reason, doctor, doctorExterno, patient);
    });

    function ajaxReferencia(speciality, reason, doctor, doctorExterno, patient) {
        console.log("hola hoy");
        $.ajax({
            url: "{{ route('reference.store') }}",   //definiendo ruta
            type: "POST",                             //definiendo metodo
            data: {
                _token: "{{ csrf_token() }}",
                speciality:speciality,
                reason:reason,
                doctor:doctor,
                doctorExterno:doctorExterno,
                patient:patient,
            }
        })
        .done(function(data) {
            console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida

            if(data[0] == 201){                  //si trae valores
                Swal.fire({
                    title: data.reference,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
            }

            if (data[0] == 202) {                       //si no trae valores
                Swal.fire({
                    title: data.reference,
                    text:  'Click en OK para continuar',
                    type:  'error',
                })
                // disabled(data);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            }
        })
        .fail(function(data) {
            console.log(data);
        })
    } // fin de la funcion


    //-------------------------------------------ENFERMEDADES -------------------------------------------

    //=================guardar enfermedades================
    $("#guardarEnfermedad").click(function() {
        var reservacion = $("#reservacion").val();
        var enfermedad = $("#enfermedad").serialize();          //asignando el valor que se ingresa en el campo
        
        ajax_enfermedad(enfermedad,reservacion); //enviando el valor a la funcion ajax(darle cualquier nombre)
    }); //fin de la funcion clikea

    function ajax_enfermedad(enfermedad,reservacion){
        $.ajax({
            url: "{{ route('doctor.agregar_enfermedad') }}", //definiendo ruta
            type: "POST",
            dataType:'json', //definiendo metodo
            data: {
                _token: "{{ csrf_token() }}",
                data:enfermedad,
                id:reservacion
            }
        })
        .done(function(data) {
            console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida

            if(data[0] == 201){                  //si no trae valores
                Swal.fire({
                    title: data.enfermedad,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
                mostrarEnfermedad(data[1]);
            }

            if (data[0] == 202) {                       //si no trae valores
                Swal.fire({
                    title: data.enfermedad,
                    text:  'Click en OK para continuar',
                    type:  'error',
                })       // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            }
        })
        .fail(function(data) {
            console.log(data);
        })
    } // fin de la funcion

   //=================  mostrando enfermedades ===================
   function mostrarEnfermedad(data){
        for($i=0; $i < data.length; $i++){
            enfermedad = '<div class="row" id="'+data[$i].id+'"><div class="col-9"><a class="list-group-item list-group-item-action row" ><i class="fa fa-check mr-3 text-verdePastel"></i>'+data[$i].name+'</a></div><div class="col-3"><input id="enfermedad_id" name="'+data[$i].id+'" style="padding: 7px 20px 7px 20px; font-size:12px; border-radius:7px;" type="button" class="btn-azuloscuro btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip"value="Eliminar"></div></div>',
            $("#mostrar_enfermedad").append(enfermedad);
            $("label").remove("#quitar"+data[$i].id); //quitar del modal
        }
    }

    //================ eliminar enfermedad seleccionado ==========
    $(function() {
        $(document).on('click', '#enfermedad_id', function(event) {
            let id = this.name;
            var reservacion = $("#reservacion_id").val();
            $("div").remove("#"+id);   
          
            $.ajax({
                url: "{{ route('doctor.enfermedad_eliminar') }}",
                type: 'POST',
                dataType:'json',
                data: {
                _token: "{{ csrf_token() }}",
                id:id,
                reservacion_id:reservacion,
            }

            })
            .done(function(data) {  //recibe lo que retorna el metodo en la ruta definida  
            agregar = '<tr class="p-0 m-0"><td class="py-0 my-1"><label id="quitar'+data[1].id+'" class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="name_enfermedad" value="'+data[1].id+'"><span class="custom-control-label">'+data[1].name+'</span></label></td></tr>',
            $("#modal_enfermedad").append(agregar); //agregar en el modal

            if(data[0] == 202){                  //si no trae valores
                Swal.fire({
                    title: data.enfermedad,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
            }            
        })
        .fail(function(data) {
            console.log(data);
        })

        });

    });

    
    //=====================crear enfermedad======================
    $('#diseaseR').click(function(){
        var name = $('#newdisease').val();
        var patient_id = $('#patient_id').val();
        nuevaenfermedad(name,patient_id);
    });

    //=========================guardar enfermedad creada=================
    function nuevaenfermedad(name,patient_id){
        console.log(name,patient_id);
        $.ajax({ 
            url: "{{ route('checkin.diseases_create') }}",  
            type: "POST",                            
            data: {
                _token: "{{ csrf_token() }}",        
                name: name,
                id:patient_id,                          
            }
        })
        .done(function(data) {                        //recibe lo que retorna el metodo en la ruta definida
            console.log('esto',data);
            if (data[1] == 201) {                       
                Swal.fire({
                    title: 'Excelente!',
                    text:  data.data,
                    type:  'success',
                })


                agregar_diseases(data[0]);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            }
        })
        .fail(function(data) {
            console.log(data);
        })
    }

    //====================mostrar enfermedad creada================
    function agregar_diseases(data){
       enfermedad = '<div class="row" id="'+data.id+'"><div class="col-9"><a class="list-group-item list-group-item-action row" ><i class="fa fa-check mr-3 text-verdePastel"></i>'+data.name+'</a></div><div class="col-3"><input id="enfermedad_id" name="'+data.id+'" style="padding: 7px 20px 7px 20px; font-size:12px; border-radius:7px;" type="button" class="btn-azuloscuro btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip"value="Eliminar"></div></div>',
       $("#mostrar_enfermedad").append(enfermedad);
    }


    //-------------------------------------------- ALERGIAS -----------------------------------------------

    //================ guardar alergias =================
    $("#guardarAlergias").click(function() {
        var reservacion = $("#reservacion").val();
        var datos = $("#form_alergias").serialize(); //asignando el valor que se ingresa en el campo
        
        ajax_alergia(datos,reservacion); //enviando el valor a la funcion ajax(darle cualquier nombre)
    }); //fin de la funcion clikea

    function ajax_alergia(datos,reservacion) {
        $.ajax({
            url: "{{ route('doctor.agregar_alergias') }}", //definiendo ruta
            type: "POST",
            dataType:'json', //definiendo metodo
            data: {
                _token: "{{ csrf_token() }}",
                data:datos,
                id:reservacion
            }
        })
        .done(function(data) {        //recibe lo que retorna el metodo en la ruta definida
           
            if(data[0] == 201){                  //si no trae valores
                Swal.fire({
                    title: data.alergia,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
                mostrarAlergias(data[1]);
            }

            if (data[0] == 202) {                       //si no trae valores
                Swal.fire({
                    title: data.alergia,
                    text:  'Click en OK para continuar',
                    type:  'error',
                })        // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            }
        })
        .fail(function(data) {
            console.log(data);
        })
    } // fin de la funcion

   //====================  mostrando alergias =============
   function mostrarAlergias(data){
        for($i=0; $i < data.length; $i++){
           alergia = '<div class="row" id="'+data[$i].id+'"><div class="col-9"><a class="list-group-item list-group-item-action row" ><i class="fa fa-check mr-3 text-verdePastel"></i>'+data[$i].name+'</a></div><div class="col-3"><input id="alergia_id" name="'+data[$i].id+'" style="padding: 7px 20px 7px 20px; font-size:12px; border-radius:7px;" type="button" class="btn-azuloscuro btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip"value="Eliminar"></div></div>',
            $("#mostrar_alergias").append(alergia);
            $("div").remove("#quitarAlergia"+data[$i].id); //quitar del modal alergia
        }
    }

    //================ eliminar alergia seleccionado ==========
    $(function() {
        $(document).on('click', '#alergia_id', function(event) {
            let id = this.name;
            var reservacion = $("#reservacion_id").val();
            $("div").remove("#"+id);    //quitar de la lista de alergias

            $.ajax({
                url: "{{ route('doctor.alergia_eliminar') }}",
                type: 'POST',
                dataType:'json',
                data: {
                _token: "{{ csrf_token() }}",
                id:id,
                reservacion_id:reservacion,
            }
        })
            .done(function(data) {  
            agregarAlergia = '<div class="row" id="quitarAlergia'+data[1].id+'"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="name_alergia" value="'+data[1].id+'"><span class="custom-control-label">'+data[1].name+'</span></label></div>',
            $("#modal_alergias").append(agregarAlergia); //agregar al modal

            if(data[0] == 202){                  //si no trae valores
                Swal.fire({
                    title: data.alergia,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
            }            
        })
        .fail(function(data) {
            console.log(data);
        })  
        });    
    });


    
    //=========================crear alergia=========================
    $('#allergyR').click(function(){
        var name = $('#newallergy').val();
        var patient_id = $('#patient_id').val();
        nuevaalergia(name,patient_id);
    });

    //=========================guardar alergia creada====================
    function nuevaalergia(name,patient_id){
        console.log(name,patient_id);
        $.ajax({ 
            url: "{{ route('checkin.allergies_create') }}",  
            type: "POST",                            
            data: {
                _token: "{{ csrf_token() }}",        
                name: name,
                id: patient_id,                          
            }
        })
        .done(function(data) {                        //recibe lo que retorna el metodo en la ruta definida
            console.log('esto',data);
            if (data[1] == 201) {                       
                Swal.fire({
                    title: 'Excelente!',
                    text:  data.data,
                    type:  'success',
                })
                agregar_allergies(data[0]);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            }
        })
        .fail(function(data) {
            console.log(data);
        })
    }

    //=================mostrar alergia creada ===================
    function agregar_allergies(data){
        alergia = '<div class="row" id="'+data.id+'"><div class="col-9"><a class="list-group-item list-group-item-action row" ><i class="fa fa-check mr-3 text-verdePastel"></i>'+data.name+'</a></div><div class="col-3"><input id="alergia_id" name="'+data.id+'" style="padding: 7px 20px 7px 20px; font-size:12px; border-radius:7px;" type="button" class="btn-azuloscuro btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip"value="Eliminar"></div></div>',
            $("#mostrar_alergias").append(alergia);
    }



    //------------------------------------------- CIRUGIAS PREVIAS--------------------------------------------

    //========================= guardar cirugias ==================
    $("#guardarCirugias").click(function() {
        var reservacion = $("#reservacion").val();
        var datos = $("#form_cirugias").val();
        ajax_cirugia(datos,reservacion); //enviando el valor a la funcion ajax(darle cualquier nombre)
    }); //fin de la funcion clikea

    function ajax_cirugia(datos,reservacion) {
        $.ajax({
            url: "{{ route('doctor.agregar_cirugias') }}", //definiendo ruta
            type: "POST",
            dataType:'json', //definiendo metodo
            data: {
                _token: "{{ csrf_token() }}",
                data:datos,
                id:reservacion,
            }
        })
        .done(function(data) {
        console.log('encontrado',data[1].previous_surgery) //recibe lo que retorna el metodo en la ruta definida

            if(data[0] == 201){                  //si no trae valores
                Swal.fire({
                    title: data.cirugia,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
                mostrarCirugia(data[1]);
            }

            if (data[0] == 202) {                       //si no trae valores
                Swal.fire({
                    title: data.cirugia,
                    text:  'Click en OK para continuar',
                    type:  'error',
                })
                // disabled(data);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            }
        })
        .fail(function(data) {
            console.log(data);
        })
    } // fin de la funcion

   // ================== mostrando cirugias ==================
   function mostrarCirugia(data){
        cirugia = '<div class="row" id="cirugia'+data.id+'"><div class="col-9"><a class="list-group-item list-group-item-action row" >'+data.previous_surgery+'</a></div><div class="col-3"><input id="borrar_cirugia" na,e="cirugia'+data.id+'" style="padding: 7px 20px 7px 20px; font-size:12px; border-radius:7px;" type="button" class="btn-azuloscuro btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip"value="Eliminar"></div></div>',
        $("#agregar_cirugia").html(cirugia); 
    }

    //================ eliminar cirugia previa  ==========
    $(function() {
        $(document).on('click', '#borrar_cirugia', function(event) {
            let id = this.name;
            var reservacion = $("#reservacion_id").val();
            $("div").remove("#"+id); 

            $.ajax({
                url: "{{ route('doctor.cirugia_borrar') }}",
                type: 'POST',
                dataType:'json',
                data: {
                _token: "{{ csrf_token() }}",
                reservacion_id:reservacion,
            }

            })
            .done(function(data) {               //recibe lo que retorna el metodo en la ruta definida  
            $("#form_cirugias").val('');

            if(data[0] == 202){                  //si no trae valores
                Swal.fire({
                    title: data.cirugia,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
            }            
        })
        .fail(function(data) {
            console.log(data);
        })

        });
    });


    //-------------------------------PROCEDIMIENTOS REALIZADOS ------------------------------------------

    //============= captar datos de los procedimientos en la consulta===========
    $("#guardarO").click(function() {
        var reservacion = $("#reservacion").val();
        var procesof = $("#proceduresC-office").serialize();          //asignando el valor que se ingresa en el campo

        ajax_PO(procesof,reservacion); //enviando el valor a la funcion ajax(darle cualquier nombre)
    }); //fin de la funcion clikea

    function ajax_PO(procesof,reservacion) {
        $.ajax({
            url: "{{ route('doctor.procedures_realizados') }}", //definiendo ruta
            type: "POST",
            dataType:'json', //definiendo metodo
            data: {
                _token: "{{ csrf_token() }}",
                data:procesof,
                id:reservacion
            }
        })
        .done(function(data) {
            console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida

            if(data[0] == 201){                  //si no trae valores
                Swal.fire({
                    title: data.procedures,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
                mostrarProceduresC(data[1]);
            }

            if (data[0] == 202) {                       //si no trae valores
                Swal.fire({
                    title: data.procedureR2,
                    text:  'Click en OK para continuar',
                    type:  'error',
                })
                // disabled(data);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            }
        })
        .fail(function(data) {
            console.log(data);
        })
    } // fin de la funcion

     //=============== mostrando procedimientos realizados ===============
    function mostrarProceduresC(data){
        for($i=0; $i < data.length; $i++){
            procesc='<tr  id="'+data[$i].id+'"><td><div class="col-6">'+data[$i].name+'</div></td><td class="d-flex justify-content-center"><input id="procedureR_id" name="'+data[$i].id+'" style="border-radius:5px; font-size:12px; padding:7px 20px 7px 20px;" type="button" class="btn-azuloscuro btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip" data-original-title="Remove" value="Eliminar"></td></tr>'
            $("#procesc").append(procesc); 
            $("div").remove("#quitar_procedureR"+data[$i].id); //quitar del modal
        }
    }

    //================ eliminar procedure realizado seleccionado ==========
    $(function() {
        $(document).on('click', '#procedureR_id', function(event) {
            let id = this.name;
            var reservacion = $("#reservacion_id").val();
            $("tr").remove("#"+id);   

            $.ajax({
                url: "{{ route('doctor.procedureR_eliminar2') }}",
                type: 'POST',
                dataType:'json',
                data: {
                _token: "{{ csrf_token() }}",
                id:id,
                reservacion_id:reservacion,
            }

            })
            .done(function(data) {
            console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida

            agregar_procedureR = '<div class="row " id="quitar_procedureR'+data[1].id+'"><div class="col-9"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="procedures-office" value="'+data[1].id+'"><span class="custom-control-label">'+data[1].name+'</span></label></div><div class="col-3"><span>'+data[1].price+'</span></div></div>',
             $("#modal_procedureR").append(agregar_procedureR); //agregar al modal

            if(data[0] == 202){                  //si no trae valores
                Swal.fire({
                    title: data.procedure,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });

            }

        })
        .fail(function(data) {
            console.log(data);
        })

        });

    });


    //------------------------------------------- EXAMENES ----------------------------------------------
    //=================== examenes a realizar (paciente) =================
    $("#guardarE").click(function() {
            var reservacion = $("#reservacion").val();
            var exam = $("#exam").serialize(); //asignando el valor que se ingresa en el campo

            ajax_E(exam,reservacion);                          // enviando el valor a la funcion ajax(darle cualquier nombre)
    }); //fin de la funcion clikea

    function ajax_E(exam,reservacion) {
        $.ajax({
            url: "{{ route('doctor.examR') }}",   //definiendo ruta
            type: "POST",
            dataType:'json', //definiendo metodo
            data: {
                _token: "{{ csrf_token() }}",
                data:exam,
                id:reservacion
            }
        })
        .done(function(data) {
            console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida
            console.log('examen creado', data[1]);

            if(data[0] == 201){                  //si no trae valores
                Swal.fire({
                    title: data.exam,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
                mostrarExamen(data[1]);
            }

            if (data[0] == 202) {                       //si no trae valores
                Swal.fire({
                    title: data.exam2,
                    text:  'Click en OK para continuar',
                    type:  'error',
                })
                // disabled(data);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            }
        })
        .fail(function(data) {
            console.log(data);
        })
    } // fin de la funcion

    //==================== mostrando examenes ===================
    function mostrarExamen(data){
            for($i=0; $i < data.length; $i++){
            examen='<tr id="'+data[$i].id+'"><td><div class="col-6" >'+data[$i].name+'</div></td><td class="d-flex justify-content-center"><input id="exam_id" name="'+data[$i].id+'" type="button" class="btn-azuloscuro  btn btn-sm btn-icon on-default button-remove" style="border-radius:7px; font-size:12px; padding:7px 20px 7px 20px;" data-toggle="tooltip" data-original-title="Remove" value="Eliminar"></td></tr>'
            $("#examen").append(examen);
            $("label").remove("#quitar_examen"+data[$i].id); //quitar del modal
        }
    }


    //================ eliminar examen seleccionado ==========
    $(function() {
        $(document).on('click', '#exam_id', function(event) {
            let id = this.name;
            var reservacion = $("#reservacion_id").val();
            $("tr").remove("#"+id);   

            $.ajax({
                url: "{{ route('doctor.exam_eliminar2') }}",
                type: 'POST',
                dataType:'json',
                data: {
                _token: "{{ csrf_token() }}",
                id:id,
                reservacion_id:reservacion,
            }

            })
            .done(function(data) {     //recibe lo que retorna el metodo en la ruta definida
             agregar_examen = '<label class="custom-control custom-checkbox" id="quitar_examen'+data[1].id+'"><input type="checkbox" class="custom-control-input" name="exam" value="'+data[1].id+'"><span class="custom-control-label">'+data[1].name+'</span></label>',
             $("#modal_examen").append(agregar_examen); //agregar al modal

            if(data[0] == 202){                  //si no trae valores
                Swal.fire({
                    title: data.exam,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
            }
        })
        .fail(function(data) {
            console.log(data);
        })

        });

    });


    //-------------------------------------    POSIBLE PROCEDIMIENTOS ------------------------------------

    //================= captar datos de los posibles procedimientos ============
    $("#guardarP").click(function() {
            var reservacion = $("#reservacion").val();
            var proce = $("#posible-procedures").serialize();          //asignando el valor que se ingresa en el campo

            ajax(proce,reservacion);                          // enviando el valor a la funcion ajax(darle cualquier nombre)
    }); //fin de la funcion clikea

    function ajax(proce,reservacion) {
        $.ajax({
            url: "{{ route('doctor.proceduresP') }}", //definiendo ruta
            type: "POST",
            dataType:'json', //definiendo metodo
            data: {
                _token: "{{ csrf_token() }}",
                data:proce,
                id:reservacion
            }
        })
        .done(function(data) {
            console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida

            if(data[0] == 201){                  //si no trae valores
                Swal.fire({
                    title: data.proceduresR,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
                mostrarProcedure(data[1]);
            }

            if (data[0] == 202) {                       //si no trae valores
                Swal.fire({
                    title: data.reference,
                    text:  'Click en OK para continuar',
                    type:  'error',
                })
                // disabled(data);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            }
        })
        .fail(function(data) {
            console.log(data);
        })
    } // fin de la funcion

   //================ mostrando posibles procedimientos =============
    function mostrarProcedure(data){
        for($i=0; $i < data.length; $i++){
            procedure='<tr id="'+data[$i].id+'"><td><div class="col-6" >'+data[$i].name+'</div></td><td class="d-flex justify-content-center"><input id="procedureP_id" name="'+data[$i].id+'" type="button" style=" border-radius:7px; font-size:12px; padding:7px 20px 7px 20px;" class="btn-azuloscuro  btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip" value="Eliminar"></td></tr>'
            $("#procedimientos").append(procedure);
            $("div").remove("#quitar_procedureP"+data[$i].id);    //quitar del modal      
        }
    }

    //================ eliminar posible procedimiento seleccionado ==========
    $(function() {
        $(document).on('click', '#procedureP_id', function(event) {
            let id = this.name;
            var reservacion = $("#reservacion_id").val();
            $("tr").remove("#"+id);   

            $.ajax({
                url: "{{ route('doctor.procedureP_eliminar2') }}",
                type: 'POST',
                dataType:'json',
                data: {
                _token: "{{ csrf_token() }}",
                id:id,
                reservacion_id:reservacion,
            }

            })
            .done(function(data) {
            console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida
            agregar_procedureP = '<div class="row" id="quitar_procedureP'+data[1].id+'"><div class="col-9 mt-3"><label class="custom-control custom-checkbox d-flex"><input type="checkbox" class="custom-control-input" name="procedures-office" value="'+data[1].id+'"><span class="custom-control-label">'+data[1].name+'</span></label></div><div class="col-3"><span>'+data[1].price+'</span></div></div>',
          $('#modal_procedureP').append(agregar_procedureP); //agregar al modal

            if(data[0] == 202){                  //si no trae valores
                Swal.fire({
                    title: data.procedure,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });

            }

        })
        .fail(function(data) {
            console.log(data);
        })
        });
    });


    //-----------------------------------------  POSIBLE CIRUGIA ------------------------------------------

    //=============== captar datos de las posibles cirugias===============
    $("#guardarC").click(function() {

            var reservacion = $("#reservacion").val();
            var surgery = $("#posible-surgerys").serialize();          //asignando el valor que se ingresa en el campo
            
            var id = $("#cirugia_posible").val();
            var name = $("#cirugia_posible_name").val();
            var cost = $("#cirugia_posible_costo").val();
            var clasificacion = $("#cirugia_posible_clasificacion").val();
        
            if(id != null && name != null && cost != null && clasificacion != null){
                agregar_cirugiaP = ' <div class="row"  id="quitar_cirugia'+id+'"><div class="col-9"><label class="custom-control custom-checkbox"><input type="radio" class="custom-control-input" name="surgerys" value="'+id+'"><span class="custom-control-label">'+name+'</span></label></div><div class="col-3"><span>'+cost+'</span></div></div>'
               
                if(clasificacion == 'hospitalaria'){
                    $("#modal_cirugiaP_hospitalaria").append(agregar_cirugiaP);
                }else{
                    $("#modal_cirugiaP_ambulatoria").append(agregar_cirugiaP);
                }
            }

            ajax_S(surgery,reservacion); // enviando el valor a la funcion ajax(darle cualquier nombre)
        }); //fin de la funcion clikea

        function ajax_S(surgery,reservacion) {
        $.ajax({
            url: "{{ route('doctor.surgerysP') }}",   //definiendo ruta
            type: "POST",
            dataType:'json', //definiendo metodo
            data: {
                _token: "{{ csrf_token() }}",
                data:surgery,
                id:reservacion
            }
        })
        .done(function(data) {
            console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida

            if(data[0] == 201){                  //si no trae valores
                Swal.fire({
                    title: data.surgerysR,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
                mostrarSurgery(data[1]);
            }

            if (data[0] == 202) {                       //si no trae valores
                Swal.fire({
                    title: data.surgerysR2,
                    text:  'Click en OK para continuar',
                    type:  'error',
                })
                // disabled(data);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            }
        })
        .fail(function(data) {
            console.log(data);
        })
    } // fin de la funcion

    //======================== mostrando posibles cirugias ======================
    function mostrarSurgery(data){
        for($i=0; $i < data.length; $i++){
            cirugias='<tr id="'+data[$i].id+'"><input type="hidden" value="'+data[$i].id+'" id="cirugia_posible"><input type="hidden" value="'+data[$i].name+'" id="cirugia_posible_name"><input type="hidden" value="'+data[$i].cost+'" id="cirugia_posible_costo"><input type="hidden" value="'+data[$i].classification.name+'" id="cirugia_posible_clasificacion"><td id="'+data[$i].id+'"><div class="col-6" >'+data[$i].name+'</div></td><td class="d-flex justify-content-center"><input id="cirugiaP_id" name="'+data[$i].id+'"style="padding:7px 20px 7px 20px; border-radius:7px; font-size:12px;  color:#fff"  type="button" class="btn-azuloscuro  btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip" value="Eliminar"></td></tr>'
            $("#cirugias").html(cirugias);
            $("div").remove("#quitar_cirugia"+data[0].id);   //quitar del modal
        }         
    }

    //======================= eliminar posible cirugia seleccionada ==============
    $(function() {
        $(document).on('click', '#cirugiaP_id', function(event) {
            let id = this.name;
            var reservacion = $("#reservacion_id").val();
            $("tr").remove("#"+id);   

                $.ajax({
                    url: "{{ route('doctor.cirugiaP_eliminar2') }}",
                    type: 'POST',
                    dataType:'json',
                    data: {
                    _token: "{{ csrf_token() }}",
                    id:id,
                    reservacion_id:reservacion,
                }
            })
            .done(function(data) {
            console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida

            agregar_cirugiaP = ' <div class="row"  id="quitar_cirugia'+data[1].id+'"><div class="col-9"><label class="custom-control custom-checkbox"><input type="radio" class="custom-control-input" name="surgerys" value="'+data[1].id+'"><span class="custom-control-label">'+data[1].name+'</span></label></div><div class="col-3"><span>'+data[1].cost+'</span></div></div>'

            if(data[1].classification.name == 'hospitalaria'){
                $("#modal_cirugiaP_hospitalaria").append(agregar_cirugiaP); //agregar al modal
            }else{
                $("#modal_cirugiaP_ambulatoria").append(agregar_cirugiaP); //agregar al modal
            }           

            if(data[0] == 202){                  //si no trae valores
                Swal.fire({
                    title: data.cirugia,
                    text: 'Click en OK para continuar',
                    type: 'success',
                });
            }
        })
        .fail(function(data) {
            console.log(data);
        })
        });
    });

    $("#citaProxima").click(function() {

        $('#proximaCita').val(1);
        var proxima_cita = $('#proximaCita').val();

        if(proxima_cita == 1){                  //si no trae valores
                Swal.fire({
                    title: 'Próxima Cita',
                    text: 'Click en OK para continuar',
                    type: 'success',
                });

            // $('#citaProxima').attr('disabled');
            $("#citaProxima").prop('disabled', true);
            }else{
                Swal.fire({
                    title: 'No próxima Cita',
                    text: 'Click en OK para continuar',
                    type: 'error',
                });
            }

    });
</script>
@endsection

