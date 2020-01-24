@extends('dashboard.layouts.app')

@section('cites','active')
@section('record','active')

@php
    use Carbon\Carbon;
@endphp


@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title')
    Citas para hoy: {{ $citasDelDia }} | Atendidos Hoy: {{ $atendidos }}
@endsection

@section('content')

<style>
    .dataTables_filter label{
        color: #434a54;
    }
    .dataTables_filter label input:focus{
        border: 2px solid #00506b;
    }
</style>

<style type="text/css">
    .state{
        width: auto; 
        height: auto; 
        border-radius: 5px;}
</style>

<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix ">
            {{-- Contadores --}}
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">                                
                        <h6>Total De Citas Agendadas</h6>
                        <h3 class="pt-3"><i class="fa fa-address-book"></i> <span class="counter">2,250</span></h3>
                        {{-- <h5>$1,25,451.23</h5>--}}
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
           
            <div class="col-lg-12 mt--20">
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
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($record as $reservation)
                            {{-- @if (empty($reservation->cancel) && empty($reservation->discontinued) && empty($reservation->reschedule)) --}}
                                
                            <tr style="height:40px;">
                                <td style="text-align: center; font-size:10px; height:40px;">
                                    @if (!empty($reservation->patient->image->path))
                                    <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                    @else
                                        <img src="" alt="" width="100%" height="100%">
                                    @endif
                                </td>
                                    <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                    <td>{{ $reservation->patient->name }} {{ $reservation->patient->lastname }}</td>
                                    <th>{{ Carbon::parse($reservation->date)->format('d-m-Y') }}</th>
                                    <td>{{ $reservation->person->name }} {{ $reservation->person->lastname }}</td>
                                    <td>{{ $reservation->speciality->name }}</td>
                                    
                                    <td style="display: inline-block">
                                        @if ($reservation->status == 'Atendida')
                                        <span class="badge badge-success">{{ $reservation->status }}</span>
                                        @endif
                                        @if ($reservation->status == 'Cancelada')
                                            <span class="badge badge-danger">{{ $reservation->status }}</span>
                                        @endif
                                        @if ($reservation->status == 'Suspendida')
                                            <span class="badge badge-warning">{{ $reservation->status }}</span>
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
    </div>
</div>
@endsection
