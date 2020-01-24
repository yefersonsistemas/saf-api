@extends('dashboard.layouts.app')

@section('cites','active')
@section('pending','active')

@php
    use Carbon\Carbon;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title','Citas de hoy')

@section('content')

<style>
    .dataTables_filter label{
        color: #434a54;
    }
    .dataTables_filter label input:focus{
        border: 2px solid #00506b;
    }
</style>

<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            {{-- Contadores --}}
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Total De Citas Agendadas</h6>
                        <h3 class="pt-3"><i class="fa fa-address-book"></i> <span class="counter">2,250</span></h3>
                        {{-- <h5>$1,25,451.23</h5> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Total De Citas Del Mes</h6>
                        <h3 class="pt-3"><i class="fa fa-calendar"></i> <span class="counter">750</span></h3>
                        {{-- <h5>$3,80,451.00</h5> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Citas Para Hoy</h6>
                        <h3 class="pt-3"><i class="fa fa-users"></i> <span class="counter">{{ $citasDelDia }}</span></h3>
                        {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 65.27%</span> Since last month</span>                                --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Atendidos Hoy</h6>
                        <h3 class="pt-3"><i class="fa fa-user"></i> <span class="counter">{{ $atendidos }}</span></h3>
                        {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 165.27%</span> Since last month</span>                                --}}
                    </div>
                </div>
            </div>

              {{-- Tabs de citas --}}
            <div class="col-lg-12 col-md-12 mt-10">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center active btn btn-outline-success" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Hoy</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-primary m-auto" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">48 Horas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-secondary" id="pills-todas-tab" data-toggle="pill" href="#pills-todas" role="tab" aria-controls="pills-todas" aria-selected="false">Todas</a>
                    </li>
                </ul>
            </div>

            {{-- Tablas de los tabs de citas --}}
            <div class="tab-content container-fluid" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($hoy as $reservation)
                                        <tr style="height:40px;">
                                            <td style="text-align: center; font-size:10px; height:40px;">
                                                @if (!empty($reservation->patient->image->path))
                                                <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                    {{-- <div class="img-test" style="background-image:url('{{ Storage::url($reservation->patient->image->path) }}')"></div> --}}
                                                @else
                                                    <img src="" alt=""  width="100%" height="100%">
                                                    {{-- <div class="img-test"></div> --}}
                                                @endif
                                                <div class="text-center">
                                                    @if ($reservation->patient->historyPatient == null)
                                                        <a href="{{ route('checkin.history', [$reservation->id,0]) }}">Generar</a>
                                                    @else
                                                        @if($reservation->patient->inputoutput != '')
                                                            <a href="{{ route('checkin.history', [$reservation->id, 0] ) }}">Ver Historia</a>
                                                        @else
                                                            <a href="{{ route('checkin.history', [$reservation->id, 1] ) }}">Ver Historia</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                            <td class="text-center">{{ $reservation->patient->name }} <br> {{ $reservation->patient->lastname }}</td>
                                            <th>{{ Carbon::parse($reservation->date)->format('d-m-Y') }}</th>
                                            <td class="text-center">{{ $reservation->person->name }} <br> {{ $reservation->person->lastname }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td>
                                                @if ($reservation->status == 'Pendiente')
                                                    <span class="badge badge-azuloscuro">{{ $reservation->status }}</span>
                                                @endif
                                            </td>

                                            <td style="display: inline-block">
                                                @if ($reservation->status == 'Pendiente')
                                                @if(Carbon::now()->format('Y-m-d') == ($reservation->date ))
                                                    <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                    @endif
                                                    @if ((Carbon::now()->addDay()->format('Y-m-d') == $reservation->date))
                                                    <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                    @endif
                                                    @if ((Carbon::now()->addDay(2)->format('Y-m-d') == $reservation->date))
                                                    <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                    @endif
                                                    @if(($reservation->date > Carbon::now()->addDay(2)->format('Y-m-d')))
                                                    <button type="button" href="" disabled class="btn btn-success">A</button>
                                                    @endif

                                                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                @endif

                                                @if ($reservation->status == 'Aprobada')
                                                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                @endif
                                                @if ($reservation->status == 'Reprogramada')
                                                    <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                @endif
                                                @if ($reservation->status == 'Suspendida')
                                                    {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="Aprobar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Aprobada">A</button> --}}
                                                    {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button> --}}

                                                    <form method="POST" action="{{ route('delete.cite', $reservation->id) }}">
                                                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                        <button class="btn btn-danger"><i class="fa fa-eraser"></i></button>
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($horas as $reservation)
                                        {{-- @if ($reservation->date == Carbon::now()->addDay()->format('Y-m-d')) --}}
                                            <tr style="height:40px;">
                                                <td style="text-align: center; font-size:10px; height:40px;">
                                                    @if (!empty($reservation->patient->image->path))
                                                    <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                        {{-- <div class="img-test" style="background-image:url('{{ Storage::url($reservation->patient->image->path) }}')"></div> --}}
                                                    @else
                                                        <img src="" alt=""  width="100%" height="100%">
                                                        {{-- <div class="img-test"></div> --}}
                                                    @endif
                                                    <div class="text-center">
                                                        @if ($reservation->patient->historyPatient == null)
                                                            <a href="{{ route('checkin.history', [$reservation->id,0]) }}">Generar</a>
                                                        @else
                                                            @if($reservation->patient->inputoutput != '')
                                                                <a href="{{ route('checkin.history', [$reservation->id, 0] ) }}">Ver Historia</a>
                                                            @else
                                                                <a href="{{ route('checkin.history', [$reservation->id, 1] ) }}">Ver Historia</a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                                <td class="text-center">{{ $reservation->patient->name }} <br> {{ $reservation->patient->lastname }}</td>
                                                <th>{{ Carbon::parse($reservation->date)->format('d-m-Y') }}</th>
                                                <td class="text-center">{{ $reservation->person->name }} <br> {{ $reservation->person->lastname }}</td>
                                                <td>{{ $reservation->speciality->name }}</td>
                                                <td>
                                                    @if ($reservation->status == 'Pendiente')
                                                        <span class="badge badge-azuloscuro">{{ $reservation->status }}</span>
                                                    @endif
                                                </td>

                                                <td style="display: inline-block">
                                                    @if ($reservation->status == 'Pendiente')
                                                    @if(Carbon::now()->format('Y-m-d') == ($reservation->date ))
                                                        <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                        @endif
                                                        @if ((Carbon::now()->addDay()->format('Y-m-d') == $reservation->date))
                                                        <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                        @endif
                                                        @if ((Carbon::now()->addDay(2)->format('Y-m-d') == $reservation->date))
                                                        <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                        @endif
                                                        @if(($reservation->date > Carbon::now()->addDay(2)->format('Y-m-d')))
                                                        <button type="button" href="" disabled class="btn btn-success">A</button>
                                                        @endif

                                                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                    @endif

                                                    @if ($reservation->status == 'Aprobada')
                                                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                    @endif
                                                    @if ($reservation->status == 'Reprogramada')
                                                        <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                    @endif
                                                    @if ($reservation->status == 'Suspendida')
                                                        {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="Aprobar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Aprobada">A</button> --}}
                                                        {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button> --}}

                                                        <form method="POST" action="{{ route('delete.cite', $reservation->id) }}">
                                                            <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                            <button class="btn btn-danger"><i class="fa fa-eraser"></i></button>
                                                            @method('delete')
                                                            @csrf
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        {{-- @endif --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-todas" role="tabpanel" aria-labelledby="pills-todas-tab">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    {{-- @if($suspendidas != '') --}}
                                    @foreach ($todas as $reservation)
                                    <tr style="height:40px;">
                                        <td style="text-align: center; font-size:10px; height:40px;">
                                            @if (!empty($reservation->patient->image->path))
                                            <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                {{-- <div class="img-test" style="background-image:url('{{ Storage::url($reservation->patient->image->path) }}')"></div> --}}
                                            @else
                                                <img src="" alt=""  width="100%" height="100%">
                                                {{-- <div class="img-test"></div> --}}
                                            @endif
                                            <div class="text-center">
                                                @if ($reservation->patient->historyPatient == null)
                                                    <a href="{{ route('checkin.history', [$reservation->id,0]) }}">Generar</a>
                                                @else
                                                    @if($reservation->patient->inputoutput != '')
                                                        <a href="{{ route('checkin.history', [$reservation->id, 0] ) }}">Ver Historia</a>
                                                    @else
                                                        <a href="{{ route('checkin.history', [$reservation->id, 1] ) }}">Ver Historia</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                        <td class="text-center">{{ $reservation->patient->name }} <br> {{ $reservation->patient->lastname }}</td>
                                        <th>{{ Carbon::parse($reservation->date)->format('d-m-Y') }}</th>
                                        <td class="text-center">{{ $reservation->person->name }} <br> {{ $reservation->person->lastname }}</td>
                                        <td>{{ $reservation->speciality->name }}</td>
                                        <td>
                                            @if ($reservation->status == 'Pendiente')
                                                <span class="badge badge-azuloscuro">{{ $reservation->status }}</span>
                                            @endif
                                        </td>

                                        <td style="display: inline-block">
                                            @if ($reservation->status == 'Pendiente')
                                            @if(Carbon::now()->format('Y-m-d') == ($reservation->date ))
                                                <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                @endif
                                                @if ((Carbon::now()->addDay()->format('Y-m-d') == $reservation->date))
                                                <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                @endif
                                                @if ((Carbon::now()->addDay(2)->format('Y-m-d') == $reservation->date))
                                                <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                @endif
                                                @if(($reservation->date > Carbon::now()->addDay(2)->format('Y-m-d')))
                                                <button type="button" href="" disabled class="btn btn-success">A</button>
                                                @endif

                                                <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                            @endif

                                            @if ($reservation->status == 'Aprobada')
                                                <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                            @endif
                                            @if ($reservation->status == 'Reprogramada')
                                                <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                            @endif
                                            @if ($reservation->status == 'Suspendida')
                                                {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="Aprobar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Aprobada">A</button> --}}
                                                {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button> --}}

                                                <form method="POST" action="{{ route('delete.cite', $reservation->id) }}">
                                                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                    <button class="btn btn-danger"><i class="fa fa-eraser"></i></button>
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modals --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Paciente </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('reservation.status') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="reservation_id" class="reservation_id">
                        <input type="hidden" name="type" class="type">
                        <label for="message-text" class="col-form-label">Motivo:</label>
                        <textarea class="form-control" name="motivo" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modals --}}
@endsection

@section('scripts')
    <script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets\js\table\datatable.js') }}"></script>

    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
            var id  = button.data('id');
            var type = button.data('type');

            if (type == 'Reprogramada') {
                $('#fecha').html('<label>Seleccionar nueva fecha</label> <div class="input-group"> <input data-provide="datepicker" name="date" data-date-autoclose="true" class="form-control"> </div>');
                $('.reservation_id').val(id);
                $('.type').val(type);
            }
            insertDates(type, id);
            var modal = $(this);
            modal.find('.modal-title').text(recipient);
            $('.reservation_id').val(id);
            $('.type').val(type);

        });

        $('#modalReprogramadas').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
            var id  = button.data('id');
            var type = button.data('type');

            var modal = $(this);
            modal.find('.modal-title').text(recipient);
            insertDates(type, id);
        });

        function insertDates(type, id){
            $('#reservation_id').val(id);
            $('#type').val(type);
        }

    </script>
@endsection
