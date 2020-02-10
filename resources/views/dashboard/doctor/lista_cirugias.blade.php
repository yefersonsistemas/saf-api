@extends('dashboard.layouts.app')

@section('Lista de Cirugias','active')
@section('cirugia','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
@endsection

@section('title','Lista de Cirugias')

@section('content')
<style>
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
<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix justify-content-between">
            {{-- Contadores --}}
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">                                
                        <h6>Reservaciones confirmadas</h6>
                        <h3 class="pt-3"><i class="fa fa-address-book"></i> <span class="counter">2,250</span></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Pacientes por atender</h6>
                        <h3 class="pt-3"><i class="fa fa-calendar"></i> <span class="counter">750</span></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Pacientes atendidos</h6>
                        <h3 class="pt-3"><i class="fa fa-users"></i> <span class="counter">{{ $atendidos }}</span></h3>                             
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-10">
                <div class="table-responsive mb-4">
                    <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Fecha</th>
                                <th>Paciente</th>
                                <th>Operación</th>
                                <th>Quirofano</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto</th>
                                <th>Fecha</th>
                                <th>Paciente</th>
                                <th>Operación</th>
                                <th>Quirofano</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            {{-- @foreach ($surgeries as $surgeries) --}}
                            <tr style="height:40px;">
                                {{-- @foreach ($surgeries->patient as $patient) --}}
                                <td style="text-align: center; font-size:10px; height:40px;">
                                    {{-- @if (!empty($patient->person->image->path))
                                        <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($patient->person->image->path) }}" alt="">
                                        @else
                                        <img src="" alt="" width="100%" height="100%">
                                        @endif --}}
                                        {{-- <div class="text-center">
                                            @if ($reservation->patient->historyPatient == null)
                                            <a href="{{ route('checkin.history', $reservation->patient_id) }}">Generar</a>
                                            @else
                                            @if($reservation->patient->inputoutput->isEmpty())
                                            <a href="{{ route('checkin.history', [$reservation->id, 0] ) }}">Ver Historia</a>
                                            @else
                                            <a href="{{ route('checkin.history', [$reservation->id, 1] ) }}">Ver Historia</a>
                                            @endif
                                            @endif
                                        </div> --}}
                                    </td>
                                    {{-- @endforeach --}}
                                    <td></td>
                                    {{-- @foreach ($surgeries->patient as $patient) --}}
                                        <td></td>
                                    {{-- @endforeach --}}
                                    
                                    <td></td>
                                    <td></td>
                                </tr>
                            {{-- @endforeach  --}}
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets\js\table\datatable.js') }}"></script>
@endsection