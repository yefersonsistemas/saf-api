@extends('dashboard.layouts.app')

@section('cites','active')
@section('day','active')
@section('inrol','d-block')
@section('dire','d-none')

@php
    use Carbon\Carbon;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    @endsection

    @section('title','Historia Medica')

@section('content')
{{-- <div class="container mt-25">
        <div class="card p-4">
        </div>
    </div> --}}
    <div class="container ml-4 mt-20">
        <form action="{{ route('save.history', $rs) }}" method='POST' class="card p-4"  enctype="multipart/form-data" >
            @csrf

            <div class="card ">

                @if($mostrar == 1)
                    <div class=" icon btn-scroll">
                        <a class="   ml-20 icon-primary fa fa-pencil  " href="#" id="EditPatient" title="Editar Historial"></a>
                        <div class=" container-description">
                        <a class="  icon-description" href="#">Editar Historial</a>
                        </div>
                    </div>
                    {{-- <ul class="share">
                        <!--Facebook-->
                        <li>
                            <div class="social-link">
                                <div class="nav-label">
                                    <span>Share Button</span>
                                </div>
                            </div>
                        </li>
                      </ul> --}}

                @endif
                 <div>
                    <label class="float-right position-absolute  m-4 d-block form-label" style="right: 5px">Nro. Historia <br>
                       <span class=" ml-4  badgeMargin badge badge-azuloscuro texto1">{{ $rs->patient->historyPatient->history_number  }}</span></label>
                <h5 class="text-center ml-125 mt-20">Datos Personales </h5>
                </div>
                <div class="row mt--70">
                    <div class="col-3 ml-2 mb-4 mt-25">
                        <div class="avatar-upload">
                            @if (!empty($rs->patient->image))
                            <div class="avatar-preview avatar-edit">
                                <div id="imagePreview" style="background-image: url({{ Storage::url($rs->patient->image->path)}});">
                                </div>
                                <button  disabled="true" type="button" data-toggle="modal" data-target="#photoModal" class="btn btn-azuloscamara position-absolute btn-camara"><i class="fa fa-camera"></i></button>
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
                    <input type="hidden" name="patient" id="patient-id" value="{{$rs->patient->id}}">
                    <input type="hidden" value="{{ $rs->id }}" id="reservacion_id"><!--reservation-->
                    <!-- Modal -->
                    {{-- <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h1>Selecciona un dispositivo</h1>
                                    <div>
                                        <select name="listaDeDispositivos" id="listaDeDispositivos"></select>
                                        <input type="hidden" name="tokenmodalfoto" id="tokenfoto" value="{{ csrf_token() }}">
                                        <input type="hidden" name="patient" id="patient-id" value="{{$rs->patient->id}}">
                                        <input type="hidden" name="image" id="imagen-id" value="{{$rs->patient->image->id}}">
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
                    </div> --}}

                    <div class="col-8 mt-90">
                        <div class="row mt--10">
                           <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label class="m-0 form-label">DNI</label>
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
                                        <label class="m-0 form-label">Nombre</label>
                                        <input type="text" disabled class="form-control" placeholder="Nombre del Paciente" value="{{ $rs->patient->name }}">
                                    </div>

                                    <div class="col-4">
                                        <label class="m-0 form-label">Apellido</label>
                                        <input type="text" disabled class="form-control" placeholder="Apellido del Paciente" value="{{ $rs->patient->lastname }}">
                                    </div>
                                </div>
                           </div>

                           <div class="col-12">
                                <div class="justify-content-center row mt-4">
                                    <h5 class="ml--50">Datos de la Cita</h5>
                                </div>
                                <div class="row mt-2 mb-2" >
                                    <div class="col-4">
                                        <label class="m-0 form-label">Fecha</label>
                                        <input type="text" disabled class="form-control" placeholder="Fecha de reservación" value="{{ $rs->date }}">
                                    </div>

                                    <div class="col-4">
                                        <label class="m-0 form-label">Médico tratante</label>
                                        <input type="text" disabled class="form-control" placeholder="Nombre del  doctor" value="{{ $rs->person->name }} {{ $rs->person->lastname }}">
                                    </div>

                                    <div class="col-4">
                                        <label class="m-0 form-label">Razón</label>
                                        <input type="text" disabled class="form-control" placeholder="Motivo de la reservación" value="{{ $rs->description }}">
                                    </div>
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <form action="{{ route('save.history') }}" method='POST' class="card p-4">
                @csrf --}}
                {{-- @method('PUT') --}}
            <div class="card p-4">
                <h5 class="text-center">Información personal</h5>
                <div class="row">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Fecha de Nacimiento</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input disabled name="birthdate" id="birthdate" value="{{ ($rs->patient->historyPatient->birthdate != null) ? $rs->patient->historyPatient->birthdate : '' }}" data-provide="datepicker" data-date-autoclose="true" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label ">Lugar de Nacimiento</label>
                                    <input type="text" id="place" name="place" disabled class="form-control" placeholder="Lugar de Nacimiento" value="{{ ($rs->patient->historyPatient->place != null) ? $rs->patient->historyPatient->place : '' }}">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label class="form-label">Edad</label>
                                    @if($rs->patient->historyPatient != null)
                                    <input type="text" disabled name="age" class="form-control" placeholder="Edad" value="{{ Carbon::parse($rs->patient->historyPatient->birthdate)->age }}">
                                    {{-- value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->age : '' }}" --}}
                                    @else
                                    {{-- <input type="text" disabled name="age" class="form-control" placeholder="Edad" value="{{ Carbon::parse($rs->patient->historyPatient->birthdate)->age }}"> --}}
                                    @endif
                                </div>
                            </div>

                            <div class="col-2">
                                {{-- <div class="form-group">
                                    <label class="form-label">Peso</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select name="peso" disabled class="custom-select input-group-text form-control">
                                                <option value="Lbs">Lbs</option>
                                            </select>
                                        </div>
                                        <input type="text" disabled class="form-control" placeholder="Peso" id="weight" value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->weight : '' }}" name="weight">
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label class="form-label">Peso (Lbs)</label>
                                    <input type="text" disabled id="weight" name="weight" class="form-control" placeholder="Peso" value="{{ ($rs->patient->historyPatient->weight != null) ? $rs->patient->historyPatient->weight : '' }}">
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-label">Direccion</label>
                                    <input type="text" disabled name="address" id="address" class="form-control" placeholder="Direccion" value="{{ ($rs->patient->address != null) ? $rs->patient->address: '' }}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Genero <span class=""><i class="fa fa-venus-mars"></i></span></label>
                                    <div class="form-check ladymen p-0">
                                        <div class="custom-control custom-radio custom-control-inline p-0 mr-1">
                                            <input disabled type="radio" id="genero1"
                                            @if ($rs->patient->historyPatient != null)
                                                @if ($rs->patient->historyPatient->gender == 'Masculino')
                                                    checked
                                                    @endif
                                            @endif
                                            name="gender" class="form-check-input" value="Masculino">
                                            <label class="form-check-label" for="genero1"><span><i class="fa fa-female"></i></span></label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline p-0 ml-1">
                                            <input disabled type="radio" id="genero2"
                                            @if ($rs->patient->historyPatient != null)
                                                @if ($rs->patient->historyPatient->gender == 'Femenino')
                                                    checked
                                                @endif
                                            @endif
                                            name="gender" class="form-check-input" value="Femenino">
                                            <label class="form-check-label" for="genero2"><span><i class="fa fa-male"></i></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" disabled id="email" name="email" class="form-control" placeholder="Email" value="{{ $rs->patient->email }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" disabled id="phone" name="phone" class="form-control" placeholder="Teléfono" value="{{ $rs->patient->phone }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Teléfono adicional</label>
                                    <input type="text" disabled id="another_phone" name="another_phone" class="form-control" placeholder="Teléfono adicional" value="{{ ($rs->patient->historyPatient->another_phone != null) ? $rs->patient->historyPatient->another_phone : '' }}">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Email adicional</label>
                                    <input type="email" disabled id="another_email" name="another_email" class="form-control" placeholder="Email adicional" value="{{ ($rs->patient->historyPatient->another_email != null) ? $rs->patient->historyPatient->another_email : '' }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Profesión</label>
                                    <input type="text" disabled id="profession" name="profession" class="form-control" placeholder="Profesión" value="{{ ($rs->patient->historyPatient->profession != null) ? $rs->patient->historyPatient->profession : '' }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Ocupación</label>
                                    <input type="text" disabled id="occupation" name="occupation" class="form-control" placeholder="Ocupación" value="{{ ($rs->patient->historyPatient->occupation != null) ? $rs->patient->historyPatient->occupation : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt--35">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label text-center">Instagram</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control"><i class="fa fa-instagram" style="color:#00506b;font-size:20px"></i></span>
                                    </div>
                                <input type="text" class="form-control" placeholder="Instagram" id="social_network" name="social_network" disabled value="{{ ($rs->patient->historyPatient->social_network != null) ? $rs->patient->historyPatient->social_network: '' }}">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-label text-center">Como nos Conocio</label>
                                    <input class="form-control" name="about_us" id="about_us" cols="60" rows="20" disabled value="{{ ($rs->patient->historyPatient->about_us != null) ? $rs->patient->historyPatient->about_us: '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($mostrar == 1)
                <div class="card p-5">
                    <label class="form-label">Exámenes</label>
                    <div class="dropzone" id="my-dropzone" style="border-color:#00506b">
                        {{-- <div class="fallback" id="files2"> --}}
                            {{-- <input type="file" name="file[]" id="files" value="" multiple/> --}}
                        {{-- </div> --}}
                    </div>
                </div>

                <div class="card p-4 d-flex justify-content-between">
                    <div class="row">
                        <!---------------------------Enfermedades-------------------------->
                        <div class="col-lg-12 col-md-12" id="framework_form">
                            <label class="form-label text-center"><h5>Enfermedades</h5></label>
                            <div class="card p-3" style="border-color:#00506b">
                                <div class="card-body">
                                    <div class="table-responsive mb-4">
                                        <div class="row mb-0">
                                            <div class="col-12">
                                                <div class="row justify-content-start">
                                                    <div>
                                                        <a class="btn btn-verdePastel btnEstandar text-white mx-2"  data-toggle="modal" data-target="#listaEnfermedades" style="font-size:12px;">
                                                            <i class="fa fa-plus"></i>&nbsp;Agregar
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a class="btn btn-azuloscuro btnEstandar text-white mx-2" data-toggle="modal" data-target="#nuevaenfermedad" style="font-size:12px;">
                                                            <i class="fa fa-plus"></i>&nbsp;Crear
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-7">
                                                <div class="row justify-content-end">
                                                    <label for="" class="mr-2 col-2 text-center mt-2" style="font-weight:bold">Buscar:</label><input id="buscar_enfermedades" type="text" class="col-8 form-control p-1 pl-3" placeholder="Buscar enfermedad..">
                                                </div>
                                            </div> --}}

                                        </div>
                                        <table class="table table-hover  table_custom spacing5 table-vcenter table-striped scrollableTable">
                                            <thead class="theadColor">
                                                <tr>
                                                    <th class="text-white">Enfermedad</th>
                                                    <th class="text-center text-white">Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody id="enfermedades">
                                                @if($rs->patient->historyPatient->disease != null)
                                                    @foreach ($rs->patient->historyPatient->disease as $disease)
                                                        <tr id="enfermedad{{$disease->id}}">
                                                            <td class="lis-group-item"><i class="fa fa-check text-verdePastel mr-2"></i> {{$disease->name}}</td>
                                                            <td class="text-center"><a style="cursor:pointer" id="enfermedad_id" name="{{$disease->id}}" class="text-dark btn"><i class="icon-trash"></i></a></td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!------------------------Medicamentos--------------------------->
                        <div class="col-lg-12 col-md-12 mt-4" id="framework_form2">
                            <label class="form-label text-center"><h5>Medicamentos</h5></label>
                            <div class="card p-3" style="border-color:#00506b">

                                <div class="card-body">
                                    <div class="table-responsive mb-4">
                                        <div class="row mb-0">
                                            <div class="col-12">
                                                <div class="row justify-content-start">
                                                    <div>
                                                        <a class="btn btn-verdePastel btnEstandar text-white mx-2" data-toggle="modal" data-target="#listaMedicamentos" style="font-size:12px;">
                                                            <i class="fa fa-plus"></i>&nbsp;Agregar
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a type="button" class="btn btn-azuloscuro btnEstandar text-white mx-2" data-toggle="modal" data-target="#nuevomedicamento" style="font-size:12px;">
                                                            <i class="fa fa-plus"></i>&nbsp;Crear
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-7">
                                                <div class="row justify-content-end">
                                                    <label for="" class="mr-2 col-2 text-center mt-2" style="font-weight:bold">Buscar:</label><input id="buscar_medicinas" type="text" class="col-8 form-control p-1 pl-3" placeholder="Buscar medicamento..">
                                                </div>
                                            </div> --}}

                                        </div>
                                        <table class="table dataTable table_custom spacing5 table-vcenter table-striped scrollableTable">
                                             <thead class="theadColor">
                                                <tr>
                                                    <th class="text-white">Medicina</th>
                                                    <th class="text-center text-white">Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody id="medicamentos">
                                                @if($rs->patient->historyPatient->medicine->first() != '')
                                                @foreach ($rs->patient->historyPatient->medicine as $medicine)
                                                    <tr id="medicina{{$medicine->id}}">
                                                        <td class="lis-group-item"><i class="fa fa-check text-verdePastel mr-2"></i> {{$medicine->name}}</td>
                                                        <td class="text-center"><a style="cursor:pointer" id="medicina_id" name="{{$medicine->id}}" class="text-dark btn"><i class="icon-trash"></i></a></td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                <tr class="d-flex justify-content-center" id="quitando">
                                                    <td class="text-center">La Información no esta disponible en la tabla</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <!------------------------Alergias-------------------------------->
                        <div class="col-lg-12 col-md-12 mt-4" id="framework_form3">
                            <label class="form-label text-center"><h5>Alergias</h5></label>
                            <div class="card p-3" style="border-color:#00506b">
                                <div class="card-body">
                                    <div class="table-responsive mb-4">

                                        <div class="row mb-0">
                                            <div class="col-12">
                                                <div class="row justify-content-start">
                                                    <div>
                                                        <a class="btn btn-verdePastel btnEstandar text-white mx-2" data-toggle="modal" data-target="#listaAlergias" style="font-size:12px;">
                                                            <i class="fa fa-plus"></i>&nbsp;Agregar
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a class="btn btn-azuloscuro btnEstandar text-white mx-2" data-toggle="modal" data-target="#nuevaalergia" style="font-size:12px;">
                                                            <i class="fa fa-plus"></i>&nbsp;crear
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-7">
                                                <div class="row justify-content-end">
                                                    <label for="" class="mr-2 col-2 text-center mt-2" style="font-weight:bold">Buscar:</label><input id="buscar_alergias" type="text" class="col-8 form-control p-1 pl-3" placeholder="Buscar alergia..">
                                                </div>
                                            </div> --}}

                                        </div>

                                        <table class="table table-hover table_custom spacing5 table-vcenter table-striped scrollableTable">
                                             <thead class="theadColor">
                                                <tr>
                                                    <th class="text-white">Alergia</th>
                                                    <th class="text-center text-white">Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody id="alergias">
                                                @if($rs->patient->historyPatient->allergy != null)
                                                    @foreach ($rs->patient->historyPatient->allergy as $allergy)
                                                        <tr id="alergia{{$allergy->id}}">
                                                                <td class="lis-group-item"><i class="fa fa-check text-verdePastel mr-2"></i> {{$allergy->name}}</td>
                                                                <td class="text-center"><a style="cursor:pointer" id="alergia_id" name="{{$allergy->id}}" class="text-dark btn"><i class="icon-trash"></i></a></td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!------------------------------Cirugias previas-------------------------------->
                        <div class="col-lg-12 col-md-12 mt-4">
                            <div class="form-group col-12">
                                <label class="form-label text-center">Cirugias previas</label>
                                <input style="height:85px" type="text" disabled id="previous_surgery" class="form-control" placeholder="Cirugias anteriores" value="{{ ($rs->patient->historyPatient != null) ? $rs->patient->historyPatient->previous_surgery : ''  }}" name="previous_surgery" disabled>
                                {{-- <textarea class="form-control" disabled id="previous_surgery" name="cirugia" cols="63" rows="5">{{ $rs->patient->historyPatient->previous_surgery  }}</textarea> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-4 row d-flex d-row justify-content-between">
                    <h5 class="text-center">Historial de Citas</h5>
                    <div class="">
                        {{-- <div class="tab-content mx-auto"> --}}
                        <div class="">
                            <div class="col-lg-12">
                                <div class="table-responsive mb-4">
                                    <table class="table table-hover js-basic-example dataTable table_custom spacing5 table-vcenter table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">Fecha</th>
                                                <th style="text-align:center">Doctor</th>
                                                <th style="text-align:center">Especialidad</th>
                                                <th style="text-align:center">Motivo de la Cita</th>
                                                {{-- <th style="text-align:center">Proxima Cita</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($cites as $reservation)
                                            <tr class="event-click">
                                                <td style="text-align:center">{{$reservation->date}}</td>
                                                <td style="text-align:center">{{$reservation->person->name}} {{$reservation->person->lastname}}</td>
                                                <td style="text-align:center">{{$reservation->speciality->name}}</td>
                                                <td style="text-align:center">{{$reservation->description}}</td>
                                                    {{-- <td style="text-align:center"></td> --}}
                                            </tr>
                                            @empty

                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($mostrar == 1)
                <div>
                    <a href="javascript:history.back(-1);" class="btn btn-azuloscuro float-right mr-10" style="width:150px;height:40px">Salir</a>
                    <button type="submit" class="btn btn-azuloscuro float-right mr-10" id="submit-all" style="width:150px;height:40px" > Guardar</button>
                </div>
            @else
                <div>
                    <a href="javascript:history.back(-1);" class="btn btn-azuloscuro float-right mr-10" style="width:150px;height:40px">Salir</a>
                </div>
            @endif
        </form>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form role="form" enctype="multipart/form-data" action="{{route('checkin.exams')}}" method="POST">
                        @csrf
                <input type="hidden" value="{{$rs->patient->historyPatient->id}}" name="patient">
                        <div class="dropzone" id="my-dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple id="files" />
                    </div>
                </div>
                        <button type="submit" class="btn btn-azuloscuro">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!------------ Modal para mostar enfermedades--------------->
    <div class="modal fade" id="listaEnfermedades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 text-center">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Enfermedades</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <h6><span aria-hidden="true">&times;</span></h6>
                    </button>
                </div>
                <form action="" id="enfermedad">
                    <div class="modal-body" style="max-height: 415px; ">
                        <div class="form-group">
                            <div class="custom-controls-stacked">
                                <div class="row">
                                    <label for="" class="col-2 mr-2 ml-2 text-center mt-2" style="font-weight:bold">Buscar:</label><input id="buscar_enfermedad" type="text" class="form-control p-1 pl-3 mr-2 col-9" placeholder="Buscar enfermedad..">
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="card-header">
                                                    <h6>Nombre</h6>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal_enfermedad" class="mt-4">
                                        @if($enfermedades != null)
                                            @foreach($enfermedades as $enfermedades)
                                                @if ($rs->patient->historyPatient != null)
                                                    @if(!($rs->patient->historyPatient->disease->contains($enfermedades->id)))
                                                        <tr id="quitarEnfermedad_modal{{$enfermedades->id}}">
                                                            <td>
                                                                <label class="custom-control custom-checkbox" >
                                                                    <input type="checkbox" class="custom-control-input" name="name_enfermedad" value="{{ $enfermedades->id }}">
                                                                    <span class="custom-control-label">{{ $enfermedades->name }} </span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   </div>
                    <div class="modal-footer">
                        <a  class="btn btn-secondary btnEstandar text-white"  data-dismiss="modal" type="button" >Cerrar</a>
                        <a class="btn btn-azuloscuro btnEstandar text-white" data-dismiss="modal" id="guardarEnfermedad">Agregar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-------- modal Registrar Enfermedad ------------>
    <div class="modal fade" id="nuevaenfermedad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 text-center">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Registrar Enfermedad</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <h6><span aria-hidden="true">&times;</span></h6>
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

    <!------------ Modal para mostar alergias---------->
    <div class="modal fade" id="listaAlergias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 text-center">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Alergias</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <h6><span aria-hidden="true">&times;</span></h6>
                    </button>
                </div>
                <form action="" id="form_alergias">
                    <div class="modal-body" style="max-height: 415px;">
                        <div class="form-group">
                            <div class="custom-controls-stacked">
                                <div class="row">
                                    <label for="" class="col-2 mr-2 ml-2 text-center mt-2" style="font-weight:bold">Buscar:</label><input id="buscar_alergia" type="text" class="form-control p-1 pl-3 mr-2 col-9" placeholder="Buscar alergia..">
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="card-header">
                                                    <h6>Nombre</h6>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal_alergias" class="mt-4">
                                        @if($alergias != null)
                                            @foreach ($alergias as $alergia)
                                                @if ($rs->patient->historyPatient != null)
                                                    @if(!($rs->patient->historyPatient->allergy->contains($alergia->id)))
                                                        <tr id="quitarAlergia{{$alergia->id}}">
                                                            <td>
                                                                <label class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="name_alergia" value="{{ $alergia->id }}">
                                                                    <span class="custom-control-label">{{ $alergia->name }} </span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-2">
                        <a  class="btn btn-secondary btnEstandar text-white"  data-dismiss="modal" type="button" >Cerrar</a>
                        <a  class="btn btn-azuloscuro btnEstandar text-white" data-dismiss="modal" id="guardarAlergias">Agregar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-------------- modal  Registrar Alergia ------------>
    <div class="modal fade" id="nuevaalergia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 text-center">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Registrar Alergia</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <h6><span aria-hidden="true">&times;</span></h6>
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

     <!------------ Modal para mostar medicamento---------->
     <div class="modal fade" id="listaMedicamentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 text-center">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Medicamentos</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <h6><span aria-hidden="true">&times;</span></h6>
                    </button>
                </div>
                <form action="" id="form_medicamentos">
                    <div class="modal-body" style="max-height: 415px; ">
                        <div class="form-group">
                            <div class="custom-controls-stacked">
                                <div class="row">
                                    <label for="" class="col-2 mr-2 ml-2 text-center mt-2" style="font-weight:bold">Buscar:</label><input id="buscar_medicamentos" type="text" class="form-control p-1 pl-3 mr-2 col-9" placeholder="Buscar medicamento..">
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="card-header">
                                                    <h6>Nombre</h6>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody  id="modal_medicamentos" class="mt-4">
                                        @if($medicinas != null)
                                            @foreach ($medicinas as $medicina)
                                                @if ($rs->patient->historyPatient != null)
                                                    @if(!($rs->patient->historyPatient->medicine->contains($medicina->id)))
                                                        <tr id="quitarMedicina{{$medicina->id}}">
                                                            <td>
                                                                <label class="custom-control custom-checkbox" >
                                                                    <input type="checkbox" class="custom-control-input" name="name_medicina" value="{{ $medicina->id }}">
                                                                    <span class="custom-control-label">{{ $medicina->name }} </span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   </div>
                    <div class="modal-footer">
                        <a  class="btn btn-secondary btnEstandar text-white"  data-dismiss="modal" type="button" >Cerrar</a>
                        <a class="btn btn-azuloscuro btnEstandar text-white" data-dismiss="modal" id="guardarMedicamentos">Agregar</a>
                        {{-- <a class="btn btn-azuloscuro row3 text-white" data-dismiss="modal" id="guardarMedicamentos">Agregar</a> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!------------ modal Registrar Medicamento ----------->
    <div class="modal fade" id="nuevomedicamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 text-center">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Registrar Medicamento</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <h6><span aria-hidden="true">&times;</span></h6>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" placeholder="Nombre del Medicamento" name="name" value="{{ old('name') }}" class="form-control" required id="newmedicine">
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
                    <button type="button" class="btn btn-azuloscuro" id="medicineR" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets\js\table\datatable.js') }}"></script>
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets\css\brandAn.css') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/js/dropzone.js') }}"></script>
<script src="{{ asset('js/brandAn.js') }}"></script>


<script>
    //========================buscador en tiempo real de enfermedades modal=======================
    $(document).ready(function(){
      $("#buscar_enfermedad").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#modal_enfermedad tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>


<script>
    //========================buscador en tiempo real de medicamentos modal=======================
    $(document).ready(function(){
      $("#buscar_medicamentos").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#modal_medicamentos tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>

<script>
    //========================buscador en tiempo real de alergias modal=======================
    $(document).ready(function(){
      $("#buscar_alergia").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#modal_alergias tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>


<script>
    //========================buscador en tiempo real de enfermedades en vista =======================
    $(document).ready(function(){
      $("#buscar_enfermedades").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#enfermedades tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>

<script>
    //========================buscador en tiempo real de alergias en vista =======================
    $(document).ready(function(){
      $("#buscar_alergias").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#alergias tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>

<script>
    //========================buscador en tiempo real de medicamentos en vista=======================
    $(document).ready(function(){
      $("#buscar_medicinas").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#medicamentos tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>

{{-- <script>
$boton.addEventListener("click", function() {

    // Codificarlo como JSON
    //Pausar reproducción
    $video.pause();
        //Obtener contexto del canvas y dibujar sobre él
        let contexto = $canvas.getContext("2d");
        $canvas.width = $video.videoWidth;
        $canvas.height = $video.videoHeight;
        contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

        let foto = $canvas.toDataURL(); //Esta es la foto, en base 64
        let datafoto=encodeURIComponent(foto);
            var data1 = {
                "tokenmodalfoto": $('#tokenfoto').val(),
                "idpatient":$('#patient-id').val(),
                "idimage":$('#imagen-id').val(),
                "pic":datafoto
                };
        const datos=JSON.stringify(data1)
        $estado.innerHTML = "Enviando foto. Por favor, espera...";
        fetch("{{ route('checkin.avatar') }}", {
            method: "POST",
            body: datos,
            headers: {
                "Content-type": "application/x-www-form-urlencoded",
                'X-CSRF-TOKEN': data1.tokenmodalfoto,// <--- aquí el token
            },
        }).then(function(response) {
            // console.log(response.json());
                return response.json();
            }).then(nombreDeLaFoto => {
                // nombreDeLaFoto trae el nombre de la imagen que le dio PHP
                console.log("La foto fue enviada correctamente");
                $estado.innerHTML = `Foto guardada con éxito. Puedes verla <a target='_blank' href='./${nombreDeLaFoto}'> aquí</a>`;
            })
        //Reanudar reproducción
        $video.play();

        $('.avatar-preview').load(
            $('#imagePreview').css('background-image', 'url({{ Storage::url($rs->patient->image->path) }})'),
            $('#imagePreview').hide(),
            $('#imagePreview').fadeIn(650)
        );
        });
</script> --}}


<script>
var carga = {}
var borrar ;
Dropzone.options.myDropzone = {

    url: "{{ route('save.history', $rs) }}",
    autoProcessQueue: true,
    parallelUploads: 100,
    uploadMultiple: true,
    maxFiles: 10,
    maxFilesize:10,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },

    // accept: function(file) {
    //     let fileReader = new FileReader();

    //     fileReader.readAsDataURL(file);
    //     fileReader.onloadend = function() {

    //         let content = fileReader.result;
    //         console.log('hols', content)

    //         $('#files2').append('<input type="file" name="file[]" id="files" value="'+content+'" multiple/>')
    //         // $('#files').val(content);

    //         file.previewElement.classList.add("dz-success");
    //     }
    //     file.previewElement.classList.add("dz-complete");

    // }
    success: function (file, response) {
        // myDropzone = this
        // console.log('trae', myDropzone);
        // console.log('trae', file.name);
        var cargar = $('#my-dropzone').append('<input type="hidden" name="'+file.name+'" class="'+file.name+'" id="examenb" value="'+file.name+'">')
        carga[file.name] = response.name
        // var data = $('input[name="file[]"]').filter('examenb');
        console.log('ysbe',file.name)
        // for(var i=0; i<data.length; i++){

        // console.log('trae', data[i]);
        // }
    //   borrar = file.name;
    },


    removedfile: function(file) {
    var name = file.name;
    console.log('trae', name);

        if(file.name != null){
            var id= $('#my-dropzone');
            $('.dropzone').remove(id.val());
            console.log('borrado');
        }
    }

}

// myDropzone.on("complete", function(file) {
//   myDropzone.removeFile(file);

// });

// ("#examenb").hide();
//     console.log('hola')

// $(document).on('click', '#examen', function(event) {
//                 // let id = this.name;
// // $("#examen").click(function(){
//     console.log('hola');
//     var borrar = $(this).val();
//         // let borrar = this.val();
//         console.log(borrar);
//          $("."+borrar).remove();
//         //  padre = imagen.parentNode;
//         // padre.removeChild(imagen);
//         // window.location = “borrar.HTML”;

//         //  $("div").remove("#quitar"+data[$i].id); //quitar del modal
//     });

//  Dropzone.options.myDropzone = {
//             url: "{{ route('save.history', $rs) }}",
//             autoProcessQueue: true,
//             uploadMultiple: true,
//             parallelUploads: 100,
//             maxFiles: 10,
//             maxFilesize:10,
//             // acceptedFiles: "image/*",

//             init: function () {

//                 var submitButton = document.querySelector("#submit-all");
//                 var wrapperThis = this;

//                 submitButton.addEventListener("click", function () {
//                     e.preventDefault();
//                     e.stopPropagation();
//                     wrapperThis.processQueue();
//                 });

//                 this.on("addedfile", function (file) {

//                     // Create the remove button
//                     var removeButton = Dropzone.createElement("<button class='btn btn-danger mt-2 text-center'><i class='fa fa-remove'></i></button>");

//                     // Escucha el evento click
//                     removeButton.addEventListener("click", function (e) {
//                         // Asegúrese de que el clic del botón no envíe el formulario:
//                         e.preventDefault();
//                         e.stopPropagation();

//                         // Eliminar la vista previa del archivo.
//                         wrapperThis.removeFile(file);
//                         // Si también quieres eliminar el archivo en el servidor,
//                         // puedes hacer la solicitud AJAX aquí.
//                     });

//                     // Agregue el botón al elemento de vista previa del archivo.
//                     file.previewElement.appendChild(removeButton);
//                 });

//             }
//         };
</script>
    <script>
        $('#disease').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
    </script>

    <script>
        $('#medicine').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
    </script>

    <script>
        $('#allergy').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200,
        })
    </script>


    <script>
        var disease_id;
        //-----------------------------------ENFERMEDADES---------------------------------------------

   //=================guardar enfermedades================
   $("#guardarEnfermedad").click(function() {
        var reservacion = $("#reservacion_id").val();
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
                show_diseases(data[1]);
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


        //================================ agregar enfermedad ======================
        function show_diseases(data){
            for($i=0; $i < data.length; $i++){
                enfermedad = '<tr id="enfermedad'+data[$i].id+'"><td class="lis-group-item"><i class="fa fa-check text-verdePastel mr-2"></i>'+data[$i].name+'</td><td class="text-center"><a style="cursor:pointer" id="enfermedad_id" name="'+data[$i].id+'" class="text-dark btn"><i class="icon-trash"></i></a></td></tr>';
                $("#enfermedades").append(enfermedad);
                $("tr").remove("#quitarEnfermedad_modal"+data[$i].id); //quitar del modal
            }
        }

        //================ eliminar enfermedad seleccionado ==========
        $(function() {
            $(document).on('click', '#enfermedad_id', function(event) {
                let id = this.name;
                var reservacion = $("#reservacion_id").val();
                $("tr").remove("#enfermedad"+id);

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

                   agregar=  `<tr id="quitarEnfermedad_modal${data[1].id}">
                                    <td>
                                        <label class="custom-control custom-checkbox" >
                                            <input type="checkbox" class="custom-control-input" name="name_enfermedad" value="${data[1].id}">
                                            <span class="custom-control-label">${data[1].name}</span>
                                        </label>
                                    </td>
                                </tr> `;

                // agregar = '<div class="row" id="quitar'+data[1].id+'"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="name_enfermedad" value="'+data[1].id+'"><span class="custom-control-label">'+data[1].name+'</span></label></div>',
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
            var patient_id = $('#patient-id').val();
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
            enfermedad= '<tr id="enfermedad'+data.id+'"><td class="lis-group-item"><i class="fa fa-check text-verdePastel mr-2"></i>'+data.name+'</td><td class="text-center"><a style="cursor:pointer" id="enfermedad_id" name="'+data.id+'" class="text-dark btn"><i class="icon-trash"></i></a></td></tr>';
            $("#enfermedades").append(enfermedad);
        }

    </script>

    <script>
        //----------------------------------------ALERGIAS------------------------------------------
        //================ guardar alergias =================

        $("#guardarAlergias").click(function() {
            console.log('hopla')
            var reservacion = $("#reservacion_id").val();
            var datos = $("#form_alergias").serialize(); //asignando el valor que se ingresa en el campo

            ajax_alergia(datos,reservacion); //enviando el valor a la funcion ajax(darle cualquier nombre)
        }); //fin de la funcion clikea

        function ajax_alergia(datos,reservacion){
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
                    show_allergies(data[1]);
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


        //============================mostrar alergias=========================
        function show_allergies(data){
            for($i=0; $i < data.length; $i++){
                alergia = '<tr id="alergia'+data[$i].id+'"><td class="lis-group-item"><i class="fa fa-check text-verdePastel mr-2"></i>'+data[$i].name+'</td><td class="text-center"><a style="cursor:pointer" id="alergia_id" name="'+data[$i].id+'" class="text-dark btn"><i class="icon-trash"></i></a></td></tr>';
                $("#alergias").append(alergia);
                $("tr").remove("#quitarAlergia"+data[$i].id); //quitar del modal
                $("tr").remove("#quitandoAlergia");
            }
        }

        //===================== eliminar alergia seleccionado ====================
        $(function() {
            $(document).on('click', '#alergia_id', function(event) {
                let id = this.name;
                var reservacion = $("#reservacion_id").val();
                $("tr").remove("#alergia"+id);    //quitar de la lista de alergias

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

                agregarAlergia = `<tr id="quitarAlergia${data[1].id}">
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="name_alergia" value="${data[1].id}">
                                            <span class="custom-control-label">${data[1].name}</span>
                                        </label>
                                    </td>
                                  </tr> `;
                // agregarAlergia = '<div class="row" id="quitarAlergia'+data[1].id+'"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="name_alergia" value="'+data[1].id+'"><span class="custom-control-label">'+data[1].name+'</span></label></div>',
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
            var patient_id = $('#patient-id').val();
            console.log(name, patient_id);
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
            alergia = '<tr id="alergia'+data.id+'"><td class="lis-group-item"><i class="fa fa-check text-verdePastel mr-2"></i>'+data.name+'</td><td class="text-center"><a style="cursor:pointer" id="alergia_id" name="'+data.id+'" class="text-dark btn"><i class="icon-trash"></i></a></td></tr>';
            $("#alergias").append(alergia);
        }

    </script>

    <script>
        //---------------------------------MEDICAMENTOS-------------------------------------

        //==========================guardar medicamentos==========================
        $("#guardarMedicamentos").click(function(){
            var reservacion = $("#reservacion_id").val();
            var datos = $("#form_medicamentos").serialize();
            medicamentos1(reservacion,datos);
        });

        function medicamentos1(reservacion,datos){
            $.ajax({
                url: "{{ route('checkin.medicines') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    data:datos,
                    id:reservacion,
                }
            })
            .done(function(data) {                        //recibe lo que retorna el metodo en la ruta definida
                console.log('esto',data[0][0]);
                if (data[1] == 201) {
                    Swal.fire({
                        title: 'Excelente!',
                        text:  'Medicamento Agregado con Exito!',
                        type:  'success',
                    })
                        show_medicines(data[0]);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
                }
            })
            .fail(function(data) {
                console.log(data);
            })
        }

        //=================================mostrar medicamentos=============================
        function show_medicines(data){
            for($i=0; $i < data.length; $i++){
                medicina = '<tr id="medicina'+data[$i].id+'"><td class="lis-group-item"><i class="fa fa-check text-verdePastel mr-2"></i>'+data[$i].name+'</td><td class="text-center"><a style="cursor:pointer" id="medicina_id" name="'+data[$i].id+'" class="text-dark btn"><i class="icon-trash"></i></a></td></tr>';
                $("#medicamentos").append(medicina);
                $("tr").remove("#quitarMedicina"+data[$i].id);
                $("tr").remove("#quitando");
            }
        }

        //================ eliminar enfermedad seleccionado ==========
        $(function() {
            $(document).on('click', '#medicina_id', function(event) {
                let id = this.name;
                var reservacion = $("#reservacion_id").val();
                $("tr").remove("#medicina"+id);

                $.ajax({
                    url: "{{ route('checkin.medicine_borrar') }}",
                    type: 'POST',
                    dataType:'json',
                    data: {
                    _token: "{{ csrf_token() }}",
                    id:id,
                    reservacion_id:reservacion,
                }

                })
                .done(function(data) {  //recibe lo que retorna el metodo en la ruta definida
                agregar = ` <tr id="quitarMedicina${data[1].id}">
                                <td>
                                    <label class="custom-control custom-checkbox" >
                                        <input type="checkbox" class="custom-control-input" name="name_medicina" value="${data[1].id}">
                                        <span class="custom-control-label">${data[1].name}</span>
                                    </label>
                                </td>
                            </tr>   ` ;
                // agregar = '<div class="row" id="quitarMedicina'+data[1].id+'"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="name_enfermedad" value="'+data[1].id+'"><span class="custom-control-label">'+data[1].name+'</span></label></div>',
                $("#modal_medicamentos").append(agregar); //agregar en el modal

                if(data[0] == 202){                  //si no trae valores
                    Swal.fire({
                        title: data.medicine,
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


        //===================crear medicina ======================
        $('#medicineR').click(function(){
            var name = $('#newmedicine').val();
            var patient_id = $('#patient-id').val();
            console.log(name, patient_id);
            nuevamedicina(name,patient_id);
        });

        //==================guardar medicina=====================
        function nuevamedicina(name,patient_id){
            console.log(name,patient_id);
            $.ajax({
                url: "{{ route('checkin.medicines_create') }}",
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
                    agregar_medicines(data[0]);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
                }
            })
            .fail(function(data) {
                console.log(data);
            })
        }

        //=============mostrar medicina creada==============
        function agregar_medicines(data){
            medicamento = '<tr id="medicina'+data.id+'"><td class="lis-group-item"><i class="fa fa-check text-verdePastel mr-2"></i>'+data.name+'</td><td class="text-center"><a style="cursor:pointer" id="medicina_id" name="'+data.id+'" class="text-dark btn"><i class="icon-trash"></i></a></td></tr>';
            $("#medicamentos").append(medicamento);
        }

    </script>

        <script>
            $('#EditPatient').click(function() {
                $('#weight').removeAttr('disabled');
                $('#place').removeAttr('disabled');
                $('#birthdate').removeAttr('disabled');
                $('#allergy').removeAttr('disabled');
                $('#medicine').removeAttr('disabled');
                $('#disease').removeAttr('disabled');
                $('#address').removeAttr('disabled');
                $('#genero1').removeAttr('disabled');
                $('#genero2').removeAttr('disabled');
                $('#phone').removeAttr('disabled');
                $('#profession').removeAttr('disabled');
                $('#occupation').removeAttr('disabled');
                $('#another_phone').removeAttr('disabled');
                $('#another_email').removeAttr('disabled');
                $('#previous_surgery').removeAttr('disabled');
                $('#social_network').removeAttr('disabled');
                $('#about_us').removeAttr('disabled');
                // $('#submit-all').removeAttr('disabled');
            });
        </script>

        <script>
        // $("#submit-all").click(function() {
        //     console.log('hello');
            // var tipo_dni = $("#tipo_dniC").val();
            // var dni = $("#dniC").val();
            // var name =  $("#nameC").val();
            // var lastname = $("#lastnameC").val();
            // var phone = $("#phoneC").val();
            // var email = $("#emailC").val();
            // var address = $("#direccionC").val();

        //     if(phone == ''){ phone = null; }
        //     if(email == ''){ email=null;   }



        // if(tipo_dni == '' || dni == '' || dni.length < 4 || name == '' || lastname == '' || address == ''){

        //     Swal.fire({
        //     title: 'Datos incompletos',
        //     text: "Click OK para continuar!!",
        //     type: 'error',
        //     allowOutsideClick:false,
        //     confirmButtonColor: '#3085d6',
        //     confirmButtonText: '<a href="#otro" style="color:#fff" data-toggle="modal">OK</a>'
        //     }).then((result) => {
        //         if (result.value) {
        //         }
        //     })

        // }else{
        //     registrar_cliente(tipo_dni, dni, name, lastname, phone, email, address);
        // }
        // }); //fin de la funcion clikea
        // //=================== funcion para registrar al cliente================
        // function registrar_cliente(tipo_dni, dni, name, lastname, phone, email, address) {
        //     console.log(phone)
        //     console.log(address)
        //     console.log(dni)
        //     console.log(tipo_dni)
        //     console.log(lastname)
        //     console.log(name)
        //     console.log(email)
        //     $.ajax({
        //         url: "{{ route('checkout.person') }}",
        //         type: "POST",
        //         data: {
        //             _token: "{{ csrf_token() }}",
        //             type_dni: tipo_dni,
        //             dni:dni,
        //             name:name,
        //             lastname:lastname,
        //             phone:phone,
        //             email:email,
        //             address:address,
        //         }
        //     })
        //     .done(function(data) {                        //recibe lo que retorna el metodo en la ruta definida
        //         console.log('esto',data);
        //         if (data[0] == 201) {
        //             Swal.fire({
        //                 title: 'Excelente!',
        //                 text:  'Registro satisfactorio',
        //                 type:  'success',
        //             })
        //             factura_cliente(data);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
        //         }
        //     })
        //     .fail(function(data) {
        //         console.log(data);
        //     })
        // } // fin de la funcion que busca datos del paciente/doctor/procedimientos
        </script>
@endsection
