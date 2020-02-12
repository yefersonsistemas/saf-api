@extends('dashboard.layouts.app')

@section('title','Crear Historia Médica')
@section('inrol','d-block')
@section('dire','d-none')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">

@endsection

@section('content')
<div class="row clearfix" style="margin: 15px">                    
    <div class="col-lg-12">
        <form class="card" method="POST" action="{{ route('patients.store', $reservation) }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3 class="card-title">Historia Médica De <b>{{ $reservation->patient->name }}</b></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-label">Numero de historia</label>
                            <input type="text" class="form-control" disabled="" name="history_number" placeholder="SF-0001">
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Fecha</label>
                            <input type="text" class="form-control border-0 " name="date" value="{{ $fecha }}" disabled="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Documento de Identidad</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text btn-turquesa"><i class="fa fa-id-card"></i></span>
                                </div>
                                <div class="input-group-prepend">
                                    <select class="form-control custom-select" name="type_dni" name="profession">
                                        <option value="N">N</option>
                                        <option value="E">E</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control" placeholder="Nombre" value="{{ $reservation->patient->dni }}" name="dni">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre" value="{{ $reservation->patient->name }}" name="name">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="lastname" class="form-control" placeholder="Apellido" value="{{ $reservation->patient->lastname }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" value="{{ $reservation->patient->email }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Correo Electrónico 2</label>
                            <input type="email" name="email2" class="form-control" placeholder="Correo Electrónico">
                        </div>
                    </div>
                  
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="phone" class="form-control" placeholder="Teléfono" value="{{ $reservation->patient->phone }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Teléfono 2</label>
                            <input type="text" name="phone2" class="form-control" placeholder="Teléfono 2">
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Dirección</label>
                                <input type="text" class="form-control" placeholder="Dirección" name="address" value="{{ $reservation->patient->address }}">
                            </div>
                        </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Fecha de nacimiento</label>
                            <div class="input-group">
                                <input data-provide="datepicker" name="birthdate" data-date-autoclose="true" class="form-control" placeholder="11-11-2019">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Lugar de nacimiento</label>
                            <input type="text" name="place" class="form-control" placeholder="Lugar de nacimiento">
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-3 text-center">
                        <div class="form-group">
                            <label class="">Genero <span class=""><i class="fa fa-venus-mars"></i></span></label>
                            <div class="form-check ladymen p-0">
                                <div class="custom-control custom-radio custom-control-inline p-0 mr-1">
                                    <input type="radio" id="genero1" name="gender" class="form-check-input"  value="Masculino">
                                    <label class="form-check-label" for="genero1"><span><i class="fa fa-female"></i></span></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline p-0 ml-1">
                                    <input  type="radio" id="genero2" name="gender" class="form-check-input"  value="Femenino">
                                    <label class="form-check-label" for="genero2"><span><i class="fa fa-male"></i></span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-1">
                        <div class="form-group">
                            <label class="form-label">Peso</label>
                            <input type="text" name="weight" class="form-control" placeholder="Peso">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Profesión</label>
                            <select class="form-control custom-select" name="profession">
                                <option value="Cocinero">Cocinero</option>
                                <option value="Secretario">Secretario</option>
                                <option value="Programador">Programador</option>
                                <option value="Fotógrafo">Fotógrafo</option>
                                <option value="Mecánico/a">Mecánico/a</option>
                                <option value="Abogado/a">Abogado/a</option>
                                <option value="Periodista">Periodista</option>
                                <option value="Ama de casa">Ama De Casa</option>
                                <option value="Peluquero/a">Peluquero/a</option>
                                <option value="Ingeniero/a">Ingeniero/a</option>
                                <option value="Electricista">Electricista</option>
                                <option value="Economista">Economista</option>
                                <option value="Médico/a">Médico/a</option>
                                <option value="Dentista">Dentista</option>
                                <option value="Consultor">Consultor</option>
                                <option value="Albañil">Albañil</option>
                                <option value="Panadero">Panadero</option>
                                <option value="Arquitecto">Arquitecto</option>
                                <option value="Actor">Actor</option>
                                <option value="Contable">Contable</option>
                                <option value="Modelo">Modelo</option>
                                <option value="Monja">Monja</option>
                                <option value="Enfermero/a">Enfermero/a</option>
                                <option value="Oficinista">Oficinista</option>
                                <option value="Conserje">Conserje</option>
                                <option value="Político">Político</option>
                                <option value="Vendedor">Vendedor</option>
                                <option value=" Militar"> Militar</option>
                                <option value="Deportista">Deportista</option>
                                <option value="Cirujano">Cirujano</option>
                                <option value="Veterinario">Veterinario</option>
                                <option value="Profesor/a">Profesor/a</option>
                                <option value="Taxista">Taxista</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-label">Ocupación</label>
                            <input type="text" name="occupation" class="form-control" placeholder="Ocupación">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label class="form-label">Motivo de la consulta</label>
                            <textarea rows="5" class="form-control" name="reason" placeholder="Motivo de la consulta"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-verdePastel">Crear Historia</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets\js\table\datatable.js') }}"></script>
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>

<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>

@endsection