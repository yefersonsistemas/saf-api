@extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')

@php
    use Carbon\Carbon;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/css/dropzone.css') }}">

    @endsection

    @section('title','Historia Medica')
    
@section('content')
<!------------------Datos de la cita -------------->
    <div class="container mt-25">
        <div class="card p-4">
            <div class="card p-4">
                <h5 class="text-center">Datos de la cita</h5>

                <div class="row mt-4 mb-2">
                    <div class="col-4">
                        <label class="m-0 form-label">Fecha:</label>
                        <input type="text" disabled class="form-control" placeholder="Fecha de reservación" value="{{ $rs->date }}">
                    </div>

                    <div class="col-4">
                        <label class="m-0 form-label">Médico tratante:</label>
                        <input type="text" disabled class="form-control" placeholder="Nombre del  doctor" value="{{ $rs->person->name }} {{ $rs->person->lastname }}">
                    </div>
                    
                    <div class="col-4">
                        <label class="m-0 form-label">Razón:</label>
                        <input type="text" disabled class="form-control" placeholder="Motivo de la reservación" value="{{ $rs->description }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--------------Guardar historia------------>
    <div class="container">
        <form action="{{ route('save.history', $rs) }}" method='POST' class="card p-4" id="my-awesome-dropzone" enctype="multipart/form-data" >
            @csrf
            <div class="card p-4">
                @if($mostrar == 1)
                <div style="margin-bottom:12px">
                        <a class="btn btn-primary" id="EditPatient">Editar datos <i class="fa fa-vcard"></i></a>
                </div>
                @endif
                <h5 class="text-center">Datos Personales</h5>
                <div class="row mt--25">
                    <div class="col-3 ml-2 mb-4">
                        <div class="avatar-upload">
                            @if (!empty($rs->patient->image))
                            <div class="avatar-preview avatar-edit">
                                <div id="imagePreview" style="background-image: url({{ Storage::url($rs->patient->image->path)}});">
                                </div>
                                <button type="button" data-toggle="modal" data-target="#photoModal" class="btn btn-azuloscuro position-absolute btn-camara"><i class="fa fa-camera"></i></button>
                            </div>
                        @else
                        <div class="avatar-preview avatar-edit">
                            <div id="imagePreview" style="background-image: url();">
                            </div>
                            <button type="button" data-toggle="modal" data-target="#photoModal" class="btn btn-azuloscuro position-absolute btn-camara"><i class="fa fa-camera"></i></button>
                        </div>
                        @endif
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1>Selecciona un dispositivo</h1>
                                    <div>
                                        <select name="listaDeDispositivos" id="listaDeDispositivos"></select>
                                        <input type="hidden" name="tokenmodalfoto" id="tokenfoto" value="{{ csrf_token() }}">
                                        <input type="hidden" name="patient" id="patient-id" value="{{$rs->patient->id}}">
                                        {{-- <input type="hidden" name="image" id="imagen-id" value="{{$rs->patient->image->id}}">  --}}
                                        <p id="estado"></p>
                                    </div>
                                    <video muted="muted" id="video" class="col-12"></video>
                                    <canvas id="canvas" style="display: none;" name="foto"></canvas>
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-azuloscuro text-white" id="boton">Tomar foto</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-8 mt-4">
                        <div class="row mt-4">
                            <div class="form-group col-4">
                                <label class="m-0 form-label">DNI:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <select name="type_dni" disabled class="custom-select input-group-text form-control">
                                            <option value="{{ $rs->patient->type_dni }}">
                                                {{ $rs->patient->type_dni }}</option>
                                            </select>
                                        </div>
                                    <input type="hidden" value=" {{ $rs->patient->dni }}" name="dni">
                                    <input type="text" disabled class="form-control" placeholder="Documento de Identidad" id="dni" value=" {{ $rs->patient->dni }}" name="dni">
                                </div>
                            </div>
                        
                            <div class="col-4">
                                <label class="m-0 form-label">Nombre:</label>
                                <input type="text" disabled class="form-control" placeholder="Lugar de Nacimiento" value="{{ $rs->patient->name }}">
                            </div>
                            
                            <div class="col-4">
                                <label class="m-0 form-label">Apellido:</label>
                                <input type="text" disabled class="form-control" placeholder="Lugar de Nacimiento" value="{{ $rs->patient->lastname }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </form>
    </div>
      
@endsection

@section('scripts')
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets\css\brandAn.css') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/js/dropzone.js') }}"></script>
<script src="{{ asset('js/brandAn.js') }}"></script>



   
@endsection
