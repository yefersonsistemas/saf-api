@extends('dashboard.layouts.app')

@section('Lista de Cirugias','active')
@section('cirugia','active')
@section('docrol','d-block')
@section('dire','d-none')

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

            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
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

            <div class="col-lg-12 col-md-12 mt-10">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center active btn btn-outline-primary m-auto" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Hospitalarias</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-success" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Ambulatorias</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content container-fluid" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="col-lg-12 col-md-12">
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
                                @foreach ($all as $surgeries)
                                <tr style="height:40px;">
                                    @foreach ($surgeries->patient as $patient)
                                    <td style="text-align: center; font-size:10px; height:40px;">
                                        @if (!empty($patient->person->image->path))
                                            <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($patient->person->image->path) }}" alt="">
                                            @else
                                            <img src="" alt="" width="100%" height="100%">
                                            @endif
                                        </td>
                                        @endforeach
                                        <td>{{$surgeries->date}}</td>
                                        @foreach ($surgeries->patient as $patient)
                                            <td>{{$patient->person->name}} {{$patient->person->lastname}}</td>
                                        @endforeach

                                        {{-- <td>{{$surgeries->typesurgeries->name}}</td> --}}
                                        <td>{{$surgeries->area->name}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="col-lg-12 col-md-12">
                    <div class="table-responsive mb-4">
                        <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Fecha</th>
                                    <th>Paciente</th>
                                    <th>Doctor</th>
                                    <th>Consultorio</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Foto</th>
                                    <th>Fecha</th>
                                    <th>Paciente</th>
                                    <th>Doctor</th>
                                    <th>Consultorio</th>
                                    <th>Descripción</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($all as $surgeries)
                                <tr style="height:40px;">
                                    @foreach ($surgeries->patient as $patient)
                                    <td style="text-align: center; font-size:10px; height:40px;">
                                        @if (!empty($patient->person->image->path))
                                            <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($patient->person->image->path) }}" alt="">
                                            @else
                                            <img src="" alt="" width="100%" height="100%">
                                            @endif
                                        </td>
                                        @endforeach
                                        <td>{{$surgeries->date}}</td>
                                        @foreach ($surgeries->patient as $patient)
                                            <td>{{$patient->person->name}} {{$patient->person->lastname}}</td>
                                        @endforeach

                                        {{-- <td>{{$surgeries->typesurgeries->name}}</td> --}}
                                        <td>{{$surgeries->area->name}}</td>
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


@endsection

@section('scripts')
<script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets\js\table\datatable.js') }}"></script>
@endsection
