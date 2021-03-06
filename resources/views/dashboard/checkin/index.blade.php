@extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')
@section('inrol','d-block')
@section('dire','d-none')

@php
    use Carbon\Carbon;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">

    <!-- estilo para hacer lista scrolleable -->
    <!-- <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}"> -->
@endsection

@section('title','Todas las citas')

@section('content')

<style>
    .dataTables_filter label{
        color: #434a54;
    }
    .dataTables_filter label input:focus{
        border: 2px solid #00506b;
    }

        img.rounded{
            max-width: 50px;
            width: 50px;
        }
    .img-test{
        height: 100%;
        width: 100%;
        background-position: center;
        background-size: cover;
    }

    .btn-repro{
        background: #ff8000;
        color: #fff;
    }
    .btn-enabled{
        color: #E6E6E6;
    }
</style>

<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            {{-- Contadores --}}
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Total De Citas del año</h6>
                        <h4 class="pt-3"><i class="fa fa-address-book"></i> <span class="counter">{{ $citasAnual }}</span></h4>
                        {{-- <h5>$1,25,451.23</h5> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Total De Citas Del Mes</h6>
                        <h4 class="pt-3"><i class="fa fa-calendar"></i> <span class="counter">{{ $citasDelMes }}</span></h4>
                        {{-- <h5>$3,80,451.00</h5> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Citas Para Hoy</h6>
                        <h4 class="pt-3"><i class="fa fa-users"></i> <span class="counter">{{ $citasDelDia }}</span></h4>
                        {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 65.27%</span> Since last month</span>                                --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Atendidos Hoy</h6>
                        <h4 class="pt-3"><i class="fa fa-user"></i> <span class="counter">{{ $atendidos }}</span></h4>
                        {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 165.27%</span> Since last month</span>                                --}}
                    </div>
                </div>
            </div>

            {{-- Tabs de citas --}}
            <div class="col-lg-12 col-md-12 mt-10">
                <ul class="nav nav-pills mb-3 d-flex justify-content-around" id="pills-tab" role="tablist">
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  pt-0 pb-0 pr-3 pl-3 d-flex flex-row justify-content-center active btn btn-outline-primary m-auto" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Todas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  pt-0 pb-0 pr-3 pl-3 d-flex flex-row justify-content-center btn btn-outline-success" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Aprobadas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  pt-0 pb-0 pr-3 pl-3 d-flex flex-row justify-content-center btn btn-outline-danger" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Canceladas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  pt-0 pb-0 pr-3 pl-3 d-flex flex-row justify-content-center btn btn-outline-warning" id="pills-reprogram-tab" data-toggle="pill" href="#pills-reprogram" role="tab" aria-controls="pills-reprogram" aria-selected="false">Reprogramadas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  pt-0 pb-0 pr-3 pl-3 d-flex flex-row justify-content-center btn btn-outline-secondary" id="pills-suspendidas-tab" data-toggle="pill" href="#pills-suspendidas" role="tab" aria-controls="pills-suspendidas" aria-selected="false">Suspendidas</a>
                    </li>
                </ul>
            </div>

            {{-- lista de todas --}}
            <div class="tab-content container-fluid p-0 m-0" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="col-lg-12 col-md-12 mt-10">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($reservations != '')
                                        @foreach ($reservations as $reservation)
                                            @if ($reservation->status=="Suspendida")
                                                @if (!empty($reservation->cite) )
                                                    <tr style="height:40px;" data-toggle="tooltip" data-placement="top" title="{{$reservation->cite->first()->reason}}">
                                                @endif
                                            @else
                                                <tr style="height:40px;">
                                            @endif
                                                <td style="text-align: center; font-size:10px; height:40px;">
                                                @if (!empty($reservation->patient->image->path))
                                                    <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                    <img src="" alt=""  width="100%" height="100%">
                                                @endif
                                                <div class="">
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
                                            <td class="">{{ $reservation->patient->name }} <br> {{ $reservation->patient->lastname }}</td>
                                            <td class="">{{ $reservation->person->name }} <br> {{ $reservation->person->lastname }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td>{{ Carbon::parse($reservation->date)->format('d-m-Y') }}</td>
                                            <td>
                                                @if ($reservation->status == 'Aprobada')
                                                    <span class="badge badge-success">{{ $reservation->status }}</span>
                                                @endif
                                                @if ($reservation->status == 'Cancelada')
                                                    <span class="badge badge-danger">{{ $reservation->status }}</span>
                                                @endif
                                                @if ($reservation->status == 'Reprogramada')
                                                    <span class="badge badge-secondary">{{ $reservation->status }}</span>
                                                @endif
                                                @if ($reservation->status == 'Suspendida')
                                                    <span class="badge badge-warning">{{ $reservation->status }}</span>
                                                @endif
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
                                                    <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                @endif

                                                @if ($reservation->status == 'Aprobada')
                                                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                    <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                    <a type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</a>
                                                @endif

                                                @if ($reservation->status == 'Cancelada')
                                                    <button type="button" class="btn btn-secondary" disabled>A</button>
                                                    <button type="button" class="btn btn-secondary" disabled>R</button>
                                                    <button type="button" class="btn btn-secondary" disabled>S</button>
                                                    <button type="button" class="btn btn-secondary" disabled>C</button>
                                                @endif
                                                @if ($reservation->status == 'Reprogramada')
                                                    <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                    <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
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
                                            <!-- <td>
                                                {{-- <div class="container" id="ID_element_0">
                                                    @if($reservation->patient->inputoutput->isEmpty() && $reservation->approved == null )
                                                        <button disabled class="btn btn-danger state state_0" state="0"></button>
                                                        <button class="btn btn-danger state state_1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-danger state state_2" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-danger state state_3" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    @endif

                                                    @if($reservation->patient->inputoutput->isEmpty() && $reservation->approved != null )
                                                        <a href="{{ route ('checkin.statusIn', $reservation->id) }}" class="btn btn-danger state state_0" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')"></a>
                                                        <button class="btn btn-danger state state_1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-danger state state_2" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-danger state state_3" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    @endif

                                                        @if(!empty($reservation->patient->inputoutput->first()->inside) && empty($reservation->patient->inputoutput->first()->inside_office) && empty($reservation->patient->inputoutput->first()->outside_office) && empty($reservation->patient->inputoutput->first()->outside))
                                                        <button class="btn btn-success state state_0" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <a href="{{ route ('checkin.insideOffice', $reservation->id) }}" class="btn btn-danger state state_1" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')"></a>
                                                        <button class="btn btn-danger state state_2" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-danger state state_3" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        @endif

                                                    @if(!empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->inside)  && empty($reservation->patient->inputoutput->first()->outside_office) && empty($reservation->patient->inputoutput->first()->outside))
                                                        <button class="btn btn-success state state_0" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-success state state_1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-danger state state_2" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-danger state state_3" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    @endif

                                                    @if(!empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->inside) && !empty($reservation->patient->inputoutput->first()->outside_office) && empty($reservation->patient->inputoutput->first()->outside))
                                                    <button class="btn btn-success state state_0" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-success state state_1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-success state state_2" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-danger state state_3" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    @endif

                                                    @if(!empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->inside) && !empty($reservation->patient->inputoutput->first()->outside_office) && !empty($reservation->patient->inputoutput->first()->outside))
                                                        <button class="btn btn-success state state_0" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-success state state_1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-success state state_2" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                        <button class="btn btn-success state state_3" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    @endif
                                                </div> --}}
                                            </td> -->
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- lista aprobadas --}}
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
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
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($aprobadas != '')
                                    @forelse ($aprobadas as $reservation)
                                        @if ($reservation->status == 'Aprobada')
                                            <tr>
                                                <td style="text-align: center; font-size:10px">
                                                    @if (!empty($reservation->patient->image->path))
                                                    <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                    @else
                                                    <img src="" alt="" >
                                                    @endif
                                                    <div class="">
                                                        @if ($reservation->patient->historyPatient == null)
                                                        <a href="{{ route('checkin.history', $reservation->patient_id) }}">Generar</a>
                                                        @else
                                                            @if($reservation->patient->inputoutput->isEmpty())
                                                                <a href="{{ route('checkin.history', [$reservation->id, 0] ) }}">Ver Historia</a>
                                                            @else
                                                                <a href="{{ route('checkin.history', [$reservation->id, 1] ) }}">Ver Historia </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                                <td>{{ $reservation->patient->name }}</td>
                                                <td>{{ $reservation->patient->lastname }}</td>
                                                <td>{{ $reservation->person->name }}</td>
                                                <td>{{ $reservation->speciality->name }}</td>
                                                {{-- <td><span class="badge badge-success">{{ $reservation->status }}</span></td> --}}
                                                <td>
                                                    @if ($reservation->status == 'Aprobada')
                                                        <span class="badge badge-success">{{ $reservation->status }}</span>
                                                    @endif
                                                    @if ($reservation->status == 'Cancelada')
                                                        <span class="badge badge-danger">{{ $reservation->status }}</span>
                                                    @endif
                                                    @if ($reservation->status == 'Reprogramada')
                                                        <span class="badge badge-secondary">{{ $reservation->status }}</span>
                                                    @endif
                                                    @if ($reservation->status == 'Suspendida')
                                                        <span class="badge badge-warning">{{ $reservation->status }}</span>
                                                    @endif
                                                    @if ($reservation->status == 'Pendiente')
                                                        <span class="badge badge-azuloscuro">{{ $reservation->status }}</span>
                                                    @endif
                                                </td>

                                                <td style="display: inline-block ">
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
                                                        <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                    @endif

                                                    @if ($reservation->status == 'Aprobada')
                                                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                        <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                    @endif

                                                    @if ($reservation->status == 'Cancelada')
                                                        <button type="button" class="btn btn-success" disabled>A</button>
                                                        <button type="button" class="btn btn-warning" disabled>R</button>
                                                        <button type="button" class="btn btn-repro" disabled>S</button>
                                                        <button type="button" class="btn btn-danger" disabled>C</button>
                                                    @endif
                                                    @if ($reservation->status == 'Reprogramada')
                                                        <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a>
                                                        <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
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
                                        @endif
                                    @empty
                                    @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- lista canceladas --}}
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Status</th>
                                        {{-- <th>Acciones</th> --}}
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Status</th>
                                        {{-- <th>Acciones</th> --}}
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($canceladas != '')
                                    @foreach ($canceladas as $reservation)
                                        <tr>
                                            <td style="text-align: center; font-size:10px">
                                                @if (!empty($reservation->patient->image->path))
                                                    <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                    <img src="" alt="" >
                                                @endif
                                                <div class="">
                                                    @if ($reservation->patient->historyPatient == null)
                                                        <a href="{{ route('checkin.history', $reservation->patient_id) }}">Generar</a>
                                                    @else
                                                        @if($reservation->patient->inputoutput->isEmpty())
                                                            <a href="{{ route('checkin.history', [$reservation->id, 0] ) }}">Ver Historia</a>
                                                        @else
                                                            <a href="{{ route('checkin.history', [$reservation->id, 1] ) }}">Ver Historia</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td><span class="badge badge-danger">{{ $reservation->status }}</span></td>
                                            {{-- <td style="display: inline-block">
                                                <a href="" class="btn btn-warning">R</a>
                                                <form method="POST" action="{{ route('delete.cite', $reservation->id) }}">
                                                    <button class="btn btn-danger"><i class="fa fa-eraser"></i></button>
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- lista reprogramadas --}}
                <div class="tab-pane fade" id="pills-reprogram" role="tabpanel" aria-labelledby="pills-reprogram-tab">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Fecha</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Fecha</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($reprogramadas != '')
                                    @foreach ($reprogramadas as $reservation)
                                        <tr>
                                            <td style="text-align: center; font-size:10px">
                                                @if (!empty($reservation->patient->image->path))
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                <img src="" alt="" >
                                                @endif
                                                <div class="">
                                                    @if ($reservation->patient->historyPatient == null)
                                                        <a href="{{ route('checkin.history', $reservation->patient_id) }}">Generar</a>
                                                    @else
                                                        @if($reservation->patient->inputoutput->isEmpty())
                                                            <a href="{{ route('checkin.history', [$reservation->id, 0] ) }}">Ver Historia</a>
                                                        @else
                                                            <a href="{{ route('checkin.history', [$reservation->id, 1] ) }}">Ver Historia</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td>{{ $reservation->date }}</td>
                                            <td>
                                                @if ($reservation->status == 'Pendiente')
                                                    <span class="badge badge-azuloscuro">{{ $reservation->status }}</span>
                                                @endif
                                            </td>
                                            <td style="display: inline-block">
                                                @if ($reservation->status == 'Pendiente')
                                                    <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                @endif

                                                @if ($reservation->status == 'Aprobada')

                                                    <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                @endif

                                                @if ($reservation->status == 'Cancelada')
                                                    <button type="button" class="btn btn-success" disabled>A</button>
                                                    <button type="button" class="btn btn-warning" disabled>R</button>
                                                    <button type="button" class="btn btn-repro" disabled>S</button>
                                                    <button type="button" class="btn btn-danger" disabled>C</button>
                                                @endif
                                                @if ($reservation->status == 'Reprogramada')

                                                    <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
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
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- lista suspendidas --}}
                <div class="tab-pane fade" id="pills-suspendidas" role="tabpanel" aria-labelledby="pills-suspendidas-tab">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
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
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($suspendidas != '')
                                    @foreach ($suspendidas as $reservation)
                                        @if ($reservation->status=="Suspendida")
                                        @if (!empty($reservation->cite) )
                                        <tr style="height:40px;" data-toggle="tooltip" data-placement="top" title="Motivo de cita: {{$reservation->cite->first()->reason}}">
                                        @endif
                                        @else
                                        <tr style="height:40px;">
                                        @endif
                                            <td style="text-align: center; font-size:10px">
                                                @if (!empty($reservation->patient->image->path))
                                                    <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                    <img src="" alt="" >
                                                @endif
                                                <div class="">
                                                    @if ($reservation->patient->historyPatient == null)
                                                        <a href="{{ route('checkin.history', $reservation->patient_id) }}">Generar</a>
                                                    @else
                                                        @if($reservation->patient->inputoutput->isEmpty())
                                                            <a href="{{ route('checkin.history', [$reservation->id, 0] ) }}">Ver Historia</a>
                                                        @else
                                                            <a href="{{ route('checkin.history', [$reservation->id, 1] ) }}">Ver Historia</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td>
                                                @if ($reservation->status == 'Suspendida')
                                                    <span class="badge badge-secondary">{{ $reservation->status }}</span>
                                                @endif
                                            </td>
                                            <td style="display: inline-block">
                                                @if ($reservation->status == 'Pendiente')
                                                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                @endif

                                                {{-- @if ($reservation->status == 'Aprobada')
                                                 <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                @endif

                                                @if ($reservation->status == 'Cancelada')
                                                    <button type="button" class="btn btn-success" disabled>A</button>
                                                    <button type="button" class="btn btn-warning" disabled>R</button>
                                                    <button type="button" class="btn btn-repro" disabled>S</button>
                                                    <button type="button" class="btn btn-danger" disabled>C</button>
                                                @endif
                                                @if ($reservation->status == 'Reprogramada')

                                                    <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                                @endif --}}
                                                @if ($reservation->status == 'Suspendida')

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
                                    @endif
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
        <div class="modal-content  row">
            <div class="modal-header p-2" >
                <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Paciente </h5>
                <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
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
                    <button type="submit" class="btn btn-azuloscuro">Guardar</button>
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
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>

{{-- SCRIPT PARA MENSAJE CON BOTON HACIA ATRAS DEL NAVEGADOR --}}
{{-- <script>
    var submitted = false;

     $(document).ready(function() {
       $("form").submit(function() {
         submitted = true;
       });

       window.onbeforeunload = function () {
         if (!submitted) {
           return 'Do you really want to leave the page?';
         }
       }
     });
    </script> --}}
    {{--FIN SCRIPT PARA MENSAJE CON BOTON HACIA ATRAS DEL NAVEGADOR --}}

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
