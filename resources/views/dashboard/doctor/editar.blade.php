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
</style>
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
            </div>

                {{-- --------Step-----------}}
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">

                                <!--Header-->
                                <div class="card-header">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-6">
                                            <h3 class="card-title"> <a href="javascript:history.back(-1);" class="btn btn-sm btn-azuloscuro mr-3 text-white"><i class="icon-action-undo  mx-auto"></i></a>Nro. Historia: <span class="badge badge-info p-2">{{ $reservation->patient->historyPatient->history_number }}</span></h3>
                                        </div>
                                    </div>

                                    <!--Informacion del paciente-->
                                    <div class="row mt-3 d-flex align-items-center">
                                        <div class="col-md-2 text-center">
                                            <img src="{{ Storage::url($reservation->patient->image->path) }}" alt="" class="img-thumbnail" style=" width:150px">
                                        </div>
                                        <div class="col-md-4">
                                            <div class=" d-flex align-items-center">
                                                <label class="m-0 form-label">DNI:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <select name="type_dni" class="custom-select input-group-text border-0 bg-white" disabled="">
                                                            <option value="{{ $reservation->patient->type_dni }}">
                                                                {{ $reservation->patient->type_dni }}</option>
                                                        </select>
                                                    </div>
                                                    <input type="text" class="form-control border-0 bg-white dni" placeholder="Documento de Identidad" name="dni" disabled="" value=" {{ $reservation->patient->dni }}" name="dniP">
                                                </div>
                                            </div>
                                            <div class=" d-flex align-items-center">
                                                <label class="m-0 form-label">Nombre:</label>
                                                <input type="text" class="form-control border-0 bg-white" disabled="" value="{{ $reservation->patient->name }}" name="nameP">
                                            </div>
                                            <div class=" d-flex align-items-center">
                                                <label class="m-0 form-label">Apellido:</label>
                                                <input type="text" class="form-control border-0 bg-white" disabled=""  value="{{ $reservation->patient->lastname }}" name="lastnameP">
                                            </div>
                                        </div>
                                    </div>
                                    <!--Fin de informacion paciente-->
                                </div>
                                <!--Fin del header-->

                                <!--body-->
                                <div class="card-body">
                                    {{-- <div id="wizard_vertical"> --}}
                                    <form id="wizard_vertical" action="{{ route('doctor.update', $reservation->patient_id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="patient_id" value="{{ $reservation->patient_id }}"> 
                                        <input type="hidden" name="employe_id" value="{{ $reservation->person_id }}"> 
                                        <input type="hidden" name="razon" value="{{ $reservation->description }}"> 
                                        <input type="hidden" name="reservacion_id" value="{{ $reservation->id }}"> 

                                        <h2>Información Personal</h2>
                                        <section class="card mr-4 ml-4">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Dirección:</label>
                                                        <input type="text" class="form-control border-0 bg-white" disabled="" name="addressP" placeholder="dirección" value="{{ $reservation->patient->address }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Correo:</label>
                                                        <input type="emailP" class="form-control border-0 bg-white" disabled="" placeholder="Email" value="{{ $reservation->patient->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group ">
                                                        <label class="form-label">Lugar de nacimiento</label>
                                                        <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Lugar de Nacimiento" value="{{ $reservation->patient->historyPatient->place }}" name="place">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 d-flex flex-row align-items-center">
                                                    <div class="form-group col-md-8">
                                                        <label class="form-label">Fecha de nacimiento:</label>
                                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control border-0 bg-white" placeholder="Fecha de naciemiento" disabled="" value="{{ $reservation->patient->historyPatient->birthdate }}" name="birthdate">        
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="form-label">Edad:</label>
                                                        <input type="number" class="form-control border-0 bg-white " placeholder="Edad" disabled="" name="age" value="{{ $reservation->patient->historyPatient->age }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center">
                                                    <div class="form-group">
                                                        <label class="form-label">Genero <span class=""><i class="fa fa-venus-mars"></i></span>:</label>
                                                        <div class="form-check ladymen p-0">
                                                            <div class="custom-control custom-radio custom-control-inline p-0 mr-1">
                                                                <input type="radio" id="genero1" name="gender" class="form-check-input" {{ $reservation->patient->historyPatient->gender == 'Femenino' ? 'checked':'' }} disabled value="Masculino">
                                                                <label class="form-check-label" for="genero1"><span><i class="fa fa-female"></i></span></label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline p-0 ml-1">
                                                                <input  type="radio" id="genero2" name="gender" class="form-check-input"  {{ $reservation->patient->historyPatient->gender == 'Masculino' ? 'checked':'' }} disabled value="Femenino">
                                                                <label class="form-check-label" for="genero2"><span><i class="fa fa-male"></i></span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="" class="form-label">Telefono: </label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Telefono" name="phone" value="{{ $reservation->patient->phone }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="form-label">Profesión: </label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Profesión" name="profession" value="{{  $reservation->patient->historyPatient->profession }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="form-label">Ocupación: </label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Ocupación" name="occupation" value="{{  $reservation->patient->historyPatient->occupation }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <h2>Motivo</h2>
                                        <section class="card mr-4 ml-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="m-0 form-label">Fecha:</label>
                                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control border-0 bg-white" placeholder="Proxima Cita" disabled="" value="{{ $reservation->date }}" name=proxCita>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="m-0 form-label">Medico Tratante:</label>
                                                        <div class="input-group d-flex flex-row align-items-center">
                                                            <label for="" class="m-0">Dr.(a) </label>
                                                            <input type="hidden" value="{{ $reservation->patient_id }}" id="patient"><!--paciente-->
                                                            <input type="hidden" value="{{ $reservation->person_id }}" id="employe"><!--Empleado-->
                                                            <input type="hidden" value="{{ $reservation->id }}" id="reservacion"><!--reservation-->

                                                            <input type="text" class="form-control col-md-4 ml-1 border-0 bg-white" disabled="" value="{{ $reservation->person->name }}" name="nameM">
                                                            <input type="text" class="form-control col-md-4 ml-1 border-0 bg-white" disabled=""  value="{{ $reservation->person->lastname }}" name="lastnameM">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="m-0 form-label">Razon:</label>
                                                        <input type="text" class="form-control border-0 bg-white" disabled=""  value="{{ $reservation->description }}" name="razon">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <h2>Enfermedad Actual</h2>
                                        <section class="ml-4">
                                            <textarea name="enfermedad" cols="30" rows="10" class="summernote">{{ $r_patient->enfermedad_actual }}</textarea>
                                        </section>

                                        <h2>Antecedentes</h2>
                                        <section class="ml-4">
                                            <div id="accordion">
                                                <div class="card">
                                                    <div class="card-header bg-azuloscuro" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                        <h5 class="card-title text-white">Enfermedades</h5>
                                                    </div>
                                                    <div  class="collapse card-body list-group" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                                                        @foreach ( $reservation->historyPatient->disease as $disease )
                                                            <a class="list-group-item list-group-item-action">{{ $disease->name }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-header bg-azuloscuro" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        <h5 class="card-title text-white">Alergias</h5>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse card-body list-group" aria-labelledby="headingTwo" data-parent="#accordion">
                                                        @foreach ( $reservation->historyPatient->allergy as $allergy )
                                                            <a class="list-group-item list-group-item-action">{{ $allergy->name }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                {{-- <div class="card">
                                                    <div class="card-header bg-azuloscuro" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        <h5 class="card-title text-white">Cirugias Previas</h5>
                                                    </div>
                                                    <div id="collapseThree" class="collapse list-group card-body" aria-labelledby="headingThree" data-parent="#accordion">
                                                        <a class="list-group-item list-group-item-action">{{ $cite->previous_surgery }}</a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </section>

                                        <h2>Examen Fisico</h2>
                                        <section class="ml-4">
                                            <textarea name="examen_fisico" id="" cols="30" rows="10" class="summernote">{{ $r_patient->examen_fisico }}</textarea>
                                        </section>

                                        <h2>Estudios complementarios</h2>
                                        <section class="ml-4">
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

                                        <h2>Diagnostico y Procedimientos</h2>
                                        <section class="ml-4">
                                            <div class="row">
                                                <div class="col-12">

                                                    <textarea name="diagnostic" id="" cols="30" rows="10" class="summernote">{{ $r_patient->description }}</textarea>
                                                </div>    
                                                <div class="row">
                                                    <div class="col-12 mt-30">
                                                        <h5>Procedimientos Realizados al Paciente:</h5>
                                                    </div>
                                                    <div class="col-12 mt-10">
                                                        <button type="button" data-toggle="modal" data-target="#proceconsul" class="btn btn-success">
                                                            <i class="fa fa-plus"></i>
                                                            Agregar Procedimiento
                                                        </button>
                                                    </div>   
                                                    <div class="col-12 mt-20 p-4  card ml-2">
                                                        <h6 class="text-center" style="font-weight:bold">Procedimientos Realizados</h6>
                                                        <ul class="text-start pl-4 pr-4" id="procesc" style="font-size:14px;">
                                                            @foreach ($proceduresR as $proces)
                                                            <li>{{ $proces->name }}</li>
                                                            @endforeach
                                                        </ul>  
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <h2>Plan</h2>
                                        <section class="ml-4">
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
                                                        <a class="nav-link" id="pills-candidato-tab" data-toggle="pill" href="#pills-candidato" role="tab" aria-controls="pills-candidato" aria-selected="false">Candidato A:</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="pills-cita-tab" data-toggle="pill" href="#pills-cita" role="tab" aria-controls="pills-cita" aria-selected="false">Próxima cita</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content" id="pills-tabContent">
                                                <!--Examen-->
                                                <div class="tab-pane fade show active" id="pills-examenes" role="tabpanel" aria-labelledby="pills-examenes-tab">
                                                <div>
                                                    <h5>Examenes Medicos Que El Paciente Se Debe Realizar:</h5>
                                                </div>
                                                    <div class="row">
                                                        <div class="col-12 mt-30 d-flex justify-content-start">
                                                            <button type="button" data-toggle="modal" data-target="#examenes" class="btn btn-success">
                                                                <i class="fa fa-plus"></i>
                                                                Agregar examen
                                                            </button>
                                                        </div>
                                                        <div class="col-12 mt-30 p-4  card ml-2">
                                                            <h6 class="text-center" style="font-weight:bold">Examenes médicos a realizar</h6>
                                                            <ul class="text-start pl-4 pr-4" id="examen" style="font-size:14px;">
                                                                @foreach ($exams as $exam)
                                                                <li>{{ $exam->name }}</li>
                                                                @endforeach
                                                            </ul>  
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Recetario-->
                                                <div class="tab-pane fade" id="pills-recetario" role="tabpanel" aria-labelledby="pills-recetario-tab">
                                                    <div class="row clearfix">
                                                        <div class="col-lg-12 mx-auto">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h3 class="card-title">Agregar Medicamento</h3>
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Medicamento</label>
                                                                                <select class="form-control custom-select" name="medicamento">
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
                                                                                <input type="text" class="form-control" name="dosis" placeholder="3">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Medida</label>
                                                                                <select name="medida" class="form-control custom-select">
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
                                                                                <input type="text" class="form-control" placeholder="1 Mes" name="duracion" value="{{ old('duracion') }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group mb-0">
                                                                        <label class="form-label">Indicaciones</label>
                                                                        <textarea rows="5" class="form-control" name="indicaciones" placeholder="Tomar 1 diaria" value=""></textarea>
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
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <th>Medicamento Seleccionado</th>
                                                                                            <th>Dosis</th>
                                                                                            <th>Medidas</th>
                                                                                            <th>Duracion</th>
                                                                                            <th>Indicaciones</th>
                                                                                            <th>Acciones</th>
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                    <tbody id="addRow">
                                                                                        @foreach ($itinerary->recipe->medicine as $item)
                                                                                            <tr>
                                                                                            <td>{{$item->name}}</td>
                                                                                            <td>{{$item->treatment->doses}}</td>
                                                                                            <td>{{$item->treatment->measure}}</td>
                                                                                            <td>{{$item->treatment->duration}}</td>
                                                                                            <td>{{$item->treatment->indications}}</td>
                                                                                            <td class="actions">
                                                                                                <button class="btn btn-sm btn-icon on-editing m-r-5 button-save" data-toggle="tooltip" data-original-title="Save" hidden="">
                                                                                                    <i class="icon-drawer" aria-hidden="true"></i> 
                                                                                                </button> 
                                                                                                <button class="btn btn-sm btn-icon on-editing button-discard" data-toggle="tooltip" data-original-title="Discard" hidden="">
                                                                                                    <i class="icon-close" aria-hidden="true"></i> 
                                                                                                </button> 
                                                                                                <button class="btn btn-sm btn-icon on-default m-r-5 button-edit" data-toggle="tooltip" data-original-title="Edit">
                                                                                                    <i class="icon-pencil" aria-hidden="true"></i> 
                                                                                                </button> 
                                                                                                <button class="btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip" data-original-title="Remove">
                                                                                                    <i class="icon-trash" aria-hidden="true"></i>
                                                                                                </button>
                                                                                            </td>
                                                                                            </tr>
                                                                                        @endforeach
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
                                                <div class="tab-pane fade" id="pills-informe" role="tabpanel" aria-labelledby="pills-informe-tab">
                                                    <section>
                                                        <textarea name="reporte" id="" cols="30" rows="10" class="summernote">{{$r_patient->reportMedico->descripction}}</textarea>
                                                    </section>    
                                                </div>
                                                
                                                <!--Reposo-->
                                                <div class="tab-pane fade" id="pills-reposo" role="tabpanel" aria-labelledby="pills-reposo-tab">
                                                    <section>
                                                    <textarea name="reposop" id="" cols="30" rows="10" class="summernote">{{$r_patient->repose->description}}</textarea>
                                                    </section>  
                                                </div>
                                            
                                                <!--Referencia-->
                                                <div class="tab-pane fade" id="pills-referencia" role="tabpanel" aria-labelledby="pills-referencia-tab">
                                                    <div class="container mt-2 p-0">
                                                        <div class="col-lg-12 mx-auto m-0 ">
                                                            <input type="hidden" id="patient" name="patient" value="{{ $reservation->patient_id }}">
                                                                <div class="card mr-0 ml-0">
                                                                    <div class="card-body m-0">
                                                                        <div class="row">
                                                                            <div class="col-sm-6 col-md-4">
                                                                                <label class="form-label" >Especialidad:</label>
                                                                                {{-- <select class="form-control custom-select" name="speciality" id="speciality">
                                                                                    <option value="0" >Seleccione</option>
                                                                                    @foreach ($specialities as $speciality)
                                                                                        <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                                                                    @endforeach
                                                                                </select> --}}
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
                                                                                                <input type="text" id="medicoExterno" class="form-control"  required placeholder="" name="doctorExterno" >
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

                                                    <div class="tab-pane fade" id="pills-candidato" role="tabpanel" aria-labelledby="pills-candidato-tab">
                                                        <div class="row d-flex justify-content-center">
                                                            <div class=" col-4">
                                                                <button class="btn btn-success" data-toggle="modal" data-target="#surgerys">
                                                                    <i class="fa fa-plus"></i>
                                                                    Agregar Cirugia
                                                                </button>
                                                            </div>
                                                            
                                                            <div class="col-4">
                                                                <button type="button" data-toggle="modal" data-target="#proces" class="btn btn-success">
                                                                    <i class="fa fa-plus"></i>
                                                                    Agregar Procedimiento
                                                                </button>
                                                            </div>                                                            
                                                        </div>
                                                        <div class="row d-flex mt-20 justify-content-center">
                                                            <div class="col-5 mt-30 p-4 card ml-2">
                                                                <h6 class="text-center" style="font-weight:bold">Posible Cirugia/as</h6>
                                                                <ul class="text-start pl-4 pr-4" id="cirugias" style="font-size:14px;">
                                                                    @foreach ($surgery as $surge)
                                                                    <li>{{ $surge->name }}</li>
                                                                    @endforeach
                                                                </ul>  
                                                            </div>

                                                            <div class="col-5 mt-30 p-4 card ml-2">
                                                                <h6 class="text-center" style="font-weight:bold">Posible Procedimiento/tos</h6>
                                                                <ul class="text-start pl-4 pr-4" id="procedimientos" style="font-size:14px;">
                                                                    @foreach ($procedures as $proces)
                                                                    <li>{{ $proces->name }}</li>
                                                                    @endforeach
                                                                </ul>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!--Proxima cita-->
                                                <div class="tab-pane fade" id="pills-cita" role="tabpanel" aria-labelledby="pills-cita-tab">
                                                    <div class="container">
                                                        <div class="col-lg-12 mx-auto">
                                                            Proxima cita...
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        
                                    </form>
                                    </div>
                                </div>
                                <!--Fin del body-->
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    {{-- </div> --}}

    {{-- modal de procedimientos en la consulta --}}
    <div class="modal fade" id="proceconsul" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Procedimientos no</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="proceduresC-office">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="custom-controls-stacked">
                                {{-- @foreach ($proceduresR as $item)
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" checked="" class="custom-control-input" name="procedures-office" value="{{ $item->id }}">
                                    <span class="custom-control-label">{{ $item->name }}</span>
                                </label>
                                @endforeach --}}

                                @foreach ($diff_PR as $demas)
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="procedures-office" value="{{ $demas->id }}">
                                    <span class="custom-control-label">{{ $demas->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div> 
                    </div>   
                    <div class="modal-footer">
                        <button  class="btn btn-success" data-dismiss="modal" id="guardarO">Guardar</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>

    {{-- modal de los examenes --}}
    <div class="modal fade" id="examenes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Examenes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="exam">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="custom-controls-stacked">
                                {{-- @foreach ($exams as $item)
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" checked="" class="custom-control-input" name="procedures-office" value="{{ $item->id }}">
                                    <span class="custom-control-label">{{ $item->name }}</span>
                                </label>
                                @endforeach --}}

                                @foreach ($diff_E as $demas)
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="procedures-office" value="{{ $demas->id }}">
                                    <span class="custom-control-label">{{ $demas->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>   
                    <div class="modal-footer">
                        <button class="btn btn-success" data-dismiss="modal" id="guardarE">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal de posibles cirugias --}}
    <div class="modal fade" id="surgerys" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cirugias</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="posible-surgerys">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-controls-stacked">
                            <label class="custom-control custom-checkbox custom-control-inline">
                                {{-- @foreach ($surgery as $item)
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" checked="" class="custom-control-input" name="procedures-office" value="{{ $item->id }}">
                                    <span class="custom-control-label">{{ $item->name }}</span>
                                </label>
                                @endforeach --}}

                                @foreach ($diff_C as $demas)
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="procedures-office" value="{{ $demas->id }}">
                                    <span class="custom-control-label">{{ $demas->name }}</span>
                                </label>
                                @endforeach
                            </label>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" data-dismiss="modal" id="guardarC">Guardar</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>

    {{-- modal de candidatos a posibles procedimientos --}}
    <div class="modal fade" id="proces" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Procedimientos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="posible-procedures">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-controls-stacked">
                            {{-- @foreach ($procedures as $item)
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" checked="" class="custom-control-input" name="procedures-office" value="{{ $item->id }}">
                                <span class="custom-control-label">{{ $item->name }}</span>
                            </label>
                            @endforeach --}}

                            @foreach ($diff_P as $demas)
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="procedures-office" value="{{ $demas->id }}">
                                <span class="custom-control-label">{{ $demas->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="guardarP" data-dismiss="modal">Guardar</button>
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

        console.log("1",medicina);
        console.log("2",dosis);
        console.log("3",medida);
        console.log("4",duracion);
        console.log("5",indicaciones);
        console.log("6",patient);
        console.log("7",employe);
        console.log("8",reservacion);

        ajaxRecipe(medicina, dosis, medida, duracion, indicaciones, reservacion);

        // validacion(medicina, dosis, medida, duracion, reservacion);
    });

    // function validacion (medicina, dosis, medida, duracion, reservacion){
    // }

    function ajaxRecipe(medicina, dosis, medida, duracion, indicaciones, reservacion){
        console.log("1",medicina);
        console.log("2",dosis);
        console.log("3",medida);
        console.log("4",duracion);
        console.log("5",indicaciones);
        console.log("6",patient);
        console.log("7",employe);
        console.log("8",reservacion);
        console.log("hola");

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
                console.log(data);
                cargarMedicos(data);
            })
            .fail(function(data) {
                console.log(data);
            })
    });

    //cargar medicos
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
            console.log('estos son ', exam_id);
            console.log(exam_id.length); // el length en este caso permite agarrar el ultimo valor del arreglo
    });

    $('#referir').click(function () {
        // console.log('referir');
        var speciality = $("#speciality").val(); 
        var reason = $("#reason").val(); 
        var doctor = $("#medicoInterno").val(); 
        var doctorExterno = $("#medicoExterno").val(); 
        var patient = $("#patient").val();   
        var reservation = $("#reservacion_id").val();
        console.log('espe',speciality);
        console.log('reason',reason);
        console.log('d',doctor);
        console.log('d e',doctorExterno);
        console.log('patient',patient);

        ajaxReferencia(speciality, reason, doctor, doctorExterno, patient);                          
        // console.log('espe',especialidad);                  
        // ajax(dni); 
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


    //captar datos de los procedimientos en la consulta
    $("#guardarO").click(function() {
            var reservacion = $("#reservacion").val();
            var procesof = $("#proceduresC-office").serialize();          //asignando el valor que se ingresa en el campo

            ajax_PO(procesof,reservacion);                                //enviando el valor a la funcion ajax(darle cualquier nombre)
        });                                                               //fin de la funcion clikea
        
        function ajax_PO(procesof,reservacion) {
        $.ajax({ 
            url: "{{ route('doctor.procedures_realizados') }}",   //definiendo ruta
            type: "POST",
            dataType:'json',                             //definiendo metodo
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

    //examenes a realizar (paciente)
    $("#guardarE").click(function() {
            var reservacion = $("#reservacion").val();
            var exam = $("#exam").serialize();          //asignando el valor que se ingresa en el campo

            ajax_E(exam,reservacion);                          // enviando el valor a la funcion ajax(darle cualquier nombre)
        }); //fin de la funcion clikea
        
        function ajax_E(exam,reservacion) {
        $.ajax({ 
            url: "{{ route('doctor.examR') }}",   //definiendo ruta
            type: "POST",
            dataType:'json',                             //definiendo metodo
            data: {
                _token: "{{ csrf_token() }}",        
                data:exam, 
                id:reservacion
            }
        })
        .done(function(data) {               
            console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida
            console.log('gfhdg', data[1]);

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

    //captar datos de los posibles procedimientos
    $("#guardarP").click(function() {
            var reservacion = $("#reservacion").val();
            var proce = $("#posible-procedures").serialize();          //asignando el valor que se ingresa en el campo

            ajax(proce,reservacion);                          // enviando el valor a la funcion ajax(darle cualquier nombre)
        }); //fin de la funcion clikea
        
        function ajax(proce,reservacion) {
        $.ajax({ 
            url: "{{ route('doctor.proceduresP') }}",   //definiendo ruta
            type: "POST",
            dataType:'json',                             //definiendo metodo
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

    // mostrando posibles procedimientos 
    function mostrarProcedure(data){
        console.log('hh',data);

        for($i=0; $i < data.length; $i++){
            procedure='<p style="text-align:center">'+data[$i].name+'</p>';
            $("#procedimientos").append(procedure);
        }
        
    }

    // mostrando posibles procedimientos 
    function mostrarExamen(data){
        console.log('hh',data);

        for($i=0; $i < data.length; $i++){
            examen='<li>'+data[$i].name+'</li>';
            $("#examen").append(examen);
        }
    }

    //captar datos de las posibles cirugias
    $("#guardarC").click(function() {

            var reservacion = $("#reservacion").val();
            var surgery = $("#posible-surgerys").serialize();          //asignando el valor que se ingresa en el campo

            ajax_S(surgery,reservacion);                          // enviando el valor a la funcion ajax(darle cualquier nombre)
        }); //fin de la funcion clikea
        
        function ajax_S(surgery,reservacion) {
        $.ajax({ 
            url: "{{ route('doctor.surgerysP') }}",   //definiendo ruta
            type: "POST",
            dataType:'json',                             //definiendo metodo
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


    
    function mostrarProceduresC(data){
            console.log('hh',data);

            for($i=0; $i < data.length; $i++){
                procesc='<li>'+data[$i].name+'</li>';
                $("#procesc").append(procesc);
            }
            
        }
    //mostrando posibles cirugias
    function mostrarSurgery(data){
            console.log('hh',data);

            for($i=0; $i < data.length; $i++){
                cirugias='<li>'+data[$i].name+'</li>';
                $("#cirugias").append(cirugias);
            }
            
        }

        // mostrando posibles procedimientos 
        function mostrarProcedure(data){
            console.log('hh',data);
    
            for($i=0; $i < data.length; $i++){
                procedure='<li>'+data[$i].name+'</li>';
                $("#procedimientos").append(procedure);
            }
            
        }
    
        // mostrando examenes 
        function mostrarExamen(data){
            console.log('hh',data);
    
            for($i=0; $i < data.length; $i++){
                examen='<li>'+data[$i].name+'</li>';
                $("#examen").append(examen);
            }
            
        }
</script>
@endsection
