@extends('dashboard.layouts.app')

@section('doctor','active')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\summernote\dist\summernote.css') }}">


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
                        <div class="card-header">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <h3 class="card-title"> <a href="javascript:history.back(-1);" class="btn btn-sm btn-azuloscuro mr-3 text-white"><i class="icon-action-undo  mx-auto"></i></a>Nro. Historia: <span class="badge badge-info p-2">{{ $history->patient->historyPatient->history_number }}</span></h3>
                                </div>
                                {{-- <div class="col-md-6 text-right">
                                    <a href="{{ route('doctor.crearDiagnostico', $history->patient) }}" class="btn btn-azuloscuro">Diagnostico</a>
                                    <a href="{{ route('doctor.crearRecipe', [$history->patient_id, $history->person_id]) }}" class="btn btn-azuloscuro">Recipe</a>
                                    <a href="{{ route('doctor.crearReferencia', $history->patient) }}" class="btn btn-azuloscuro">Referencia</a>
                                </div> --}}
                            </div>
                            <div class="row mt-3 d-flex align-items-center">
                                <div class="col-md-2 text-center">
                                    <img src="{{ Storage::url($history->patient->image->path) }}" alt="" class="img-thumbnail" style=" width:150px">
                                </div>
                                <div class="col-md-4">
                                    <div class=" d-flex align-items-center">
                                        <label class="m-0 form-label">DNI:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <select name="type_dni" class="custom-select input-group-text border-0 bg-white" disabled="">
                                                    <option value="{{ $history->patient->type_dni }}">
                                                        {{ $history->patient->type_dni }}</option>
                                                </select>
                                            </div>
                                            <input type="text" class="form-control border-0 bg-white dni" placeholder="Documento de Identidad" name="dni" disabled="" value=" {{ $history->patient->dni }}" name="dniP">
                                        </div>
                                    </div>
                                    <div class=" d-flex align-items-center">
                                        <label class="m-0 form-label">Nombre:</label>
                                        <input type="text" class="form-control border-0 bg-white" disabled="" value="{{ $history->patient->name }}" name="nameP">
                                    </div>
                                    <div class=" d-flex align-items-center">
                                        <label class="m-0 form-label">Apellido:</label>
                                        <input type="text" class="form-control border-0 bg-white" disabled=""  value="{{ $history->patient->lastname }}" name="lastnameP">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="wizard_vertical">
                                <h2>Información Personal</h2>
                                <section>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Dirección:</label>
                                                <input type="text" class="form-control border-0 bg-white" disabled="" name="addressP" placeholder="dirección" value="{{ $history->patient->address }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Correo:</label>
                                                <input type="emailP" class="form-control border-0 bg-white" disabled="" placeholder="Email" value="{{ $history->patient->email }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group ">
                                                <label class="form-label">Lugar de nacimiento</label>
                                                <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Lugar de Nacimiento" value="{{ $history->patient->historyPatient->place }}" name="place">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 d-flex flex-row align-items-center">
                                            <div class="form-group col-md-8">
                                                <label class="form-label">Fecha de nacimiento:</label>
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control border-0 bg-white" placeholder="Fecha de naciemiento" disabled="" value="{{ $history->patient->historyPatient->birthdate }}" name="birthdate">        
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="form-label">Edad:</label>
                                                <input type="number" class="form-control border-0 bg-white " placeholder="Edad" disabled="" name="age" value="{{ $history->patient->historyPatient->age }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center">
                                            <div class="form-group">
                                                <label class="form-label">Genero <span class=""><i class="fa fa-venus-mars"></i></span>:</label>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" class="form-label">Telefono: </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Telefono" name="phone" value="{{ $history->patient->phone }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="form-label">Profesión: </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Profesión" name="profession" value="{{  $history->patient->historyPatient->profession }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="form-label">Ocupación: </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Ocupación" name="occupation" value="{{  $history->patient->historyPatient->occupation }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h2>Motivo</h2>
                                <section>
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
                                                <input type="text" class="form-control border-0 bg-white" disabled=""  value="{{ $history->description }}" name="razon">
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h2>Enfermedad Actual</h2>
                                <section>
                                    <textarea name="currentSisease" id="" cols="30" rows="10" class="summernote"></textarea>
                                </section>

                                <h2>Antecedentes</h2>
                                <section>
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header bg-azuloscuro" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                <h5 class="card-title text-white">Enfermedades</h5>
                                            </div>
                                            <div  class="collapse card-body list-group" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                                                @foreach ( $history->historyPatient->disease as $disease )
                                                    <a class="list-group-item list-group-item-action">{{ $disease->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header bg-azuloscuro" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <h5 class="card-title text-white">Alergias</h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse card-body list-group" aria-labelledby="headingTwo" data-parent="#accordion">
                                                @foreach ( $history->historyPatient->allergy as $allergy )
                                                    <a class="list-group-item list-group-item-action">{{ $allergy->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header bg-azuloscuro" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <h5 class="card-title text-white">Cirugias Previas</h5>
                                            </div>
                                            <div id="collapseThree" class="collapse list-group card-body" aria-labelledby="headingThree" data-parent="#accordion">
                                                <a class="list-group-item list-group-item-action">{{ $cite->previous_surgery }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h2>Examen Fisico</h2>
                                <section>
                                    <textarea name="fisicExam" id="" cols="30" rows="10" class="summernote"></textarea>
                                </section>

                                <h2>Estudios complementarios</h2>
                                <section>
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
                                <section>
                                    <textarea name="diagnostic" id="" cols="30" rows="10" class="summernote"></textarea>
                                </section>

                                <h2>Plan</h2>
                                <section>
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
                                                <a class="nav-link" id="pills-cita-tab" data-toggle="pill" href="#pills-cita" role="tab" aria-controls="pills-cita" aria-selected="false">Próxima cita</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content" id="pills-tabContent">
                                        <!--Examen-->
                                        <div class="tab-pane fade show active" id="pills-examenes" role="tabpanel" aria-labelledby="pills-examenes-tab">
                                            <div class="col-lg-12 col-md-12">
                                                <label>Examenes</label>
                                                <div class="form-group multiselect_div">
                                                    <select id="multiselect4-filter" name="multiselect4[]" class="multiselect multiselect-custom" multiple="multiple">
                                                        @foreach ($exams as $exam)
                                                            <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                                        @endforeach
                                                    </select>
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
                                                            <button class="btn btn-azuloscuro mb-15" id="add" type="button">
                                                                <i class="fe fe-plus-circle" aria-hidden="true"></i> Agregar
                                                            </button>                            
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
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        <div class="card-footer text-center">
                                                            <button type="submit" class="btn btn-azuloscuro">Generar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Informe medico-->
                                        <div class="tab-pane fade" id="pills-informe" role="tabpanel" aria-labelledby="pills-informe-tab">
                                            <section>
                                                <textarea name="fisicExam" id="" cols="30" rows="10" class="summernote"></textarea>
                                            </section>    
                                        </div>
                                        
                                        <!--Reposo-->
                                        <div class="tab-pane fade" id="pills-reposo" role="tabpanel" aria-labelledby="pills-reposo-tab">
                                            <section>
                                                <textarea name="fisicExam" id="" cols="30" rows="10" class="summernote"></textarea>
                                            </section>  
                                        </div>
                                       
                                        <!--Referencia-->
                                        <div class="tab-pane fade" id="pills-referencia" role="tabpanel" aria-labelledby="pills-referencia-tab">
                                            <div class="container">
                                                <div class="col-lg-12 mx-auto">
                                                    <form class="" method="POST" action="{{ route('reference.store', $history->patient_id) }}">
                                                        @csrf
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h3 class="card-title">Datos del Médico</h3>
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
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Razon</label>
                                                                            <textarea name="reason" id="reason" cols="30" rows="10" class="form-control text-razon" placeholder="Razon"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <div class=" text-center row d-flex justify-content-end mb-4 mr-4">
                                                                    <button type="submit" class="btn btn-azuloscuro pr-4 pl-4">Generar</button>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--Proxima cita-->
                                        <div class="tab-pane fade" id="pills-cita" role="tabpanel" aria-labelledby="pills-cita-tab">Proxima cita...</div>
                                        {{-- <div class="col-md-6 text-right">
                                            <a href="{{ route('doctor.crearDiagnostico', $history->patient) }}" class="btn btn-azuloscuro">Diagnostico</a>
                                            <a href="{{ route('doctor.crearRecipe', [$history->patient_id, $history->person_id]) }}" class="btn btn-azuloscuro">Recipe</a>
                                            <a href="{{ route('doctor.crearReferencia', $history->patient) }}" class="btn btn-azuloscuro">Referencia</a>
                                        </div> --}}
                                    </div>
                                </section>
                            </div>
                        </div>
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
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets\bundles\summernote.bundle.js') }}"></script>
<script src="{{ asset('assets\js\page\summernote.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src="{{ asset('assets\css\brandAn.js') }}"></script>

<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>

<script src="{{ asset('assets\plugins\bootstrap-colorpicker\js\bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>

<script>
    $('#multiselect4-filter').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
</script>

<script>
    var form = $('#wizard_vertical').show();
    //Vertical form basic
    $('#wizard_vertical').steps({
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
        }
        // onInit: function(event, currentIndex) {
        //     setButtonWavesEffect(event);
        // },
        // onStepChanged: function(event, currentIndex, priorIndex) {
        //     setButtonWavesEffect(event);
        // }
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
        patient        = $("input[id='patient']").val();
        employe         = $("input[id='employe']").val();
        reservacion         = $("input[id='reservacion']").val();

        ajax(medicina, dosis, medida, duracion, indicaciones, reservacion);

        validacion(medicina, dosis, medida, duracion, reservacion);
    });

    function validacion (medicina, dosis, medida, duracion, reservacion){
    }

    function ajax(medicina, dosis, medida, duracion, indicaciones, reservacion){
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
                console.log(data);
                Swal.fire({
                    title: 'Excelente!',
                    text: 'Medicina agregada',
                    type: 'success',
                })
                addRow(data);
            })
            .fail(function(data) {
                console.log(data);
            })
    }

    function addRow(data) {
        $('#addRow').append('<tr class="gradeA"> <td>'+data.medicine.name+'</td> <td>'+data.doses+'</td> <td>'+data.measure+'</td> <td>'+data.duration+'</td> <td>'+data.indications+'</td> <td class="actions"> <button class="btn btn-sm btn-icon on-editing m-r-5 button-save" data-toggle="tooltip" data-original-title="Save" hidden=""><i class="icon-drawer" aria-hidden="true"></i> </button> <button class="btn btn-sm btn-icon on-editing button-discard" data-toggle="tooltip" data-original-title="Discard" hidden=""><i class="icon-close" aria-hidden="true"></i> </button> <button class="btn btn-sm btn-icon on-default m-r-5 button-edit" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i> </button> <button class="btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button></td></tr>');
    }


    //======================Referenci medica=========================
      
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
