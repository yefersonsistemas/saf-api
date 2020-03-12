     @extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')
@section('iorol','d-block')
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
                    <div class="card-body">
                        <h6>Total Cirugías Agendadas</h6>
                        <h3 class="pt-3"><i class="fa fa-address-book"></i> <span class="counter"> {{ $surgery2->count() }} </span></h3>
                        {{-- <h3 class="pt-3"><i class="fa fa-address-book"></i> <span class="counter">{{ $citasAnual }}</span></h3> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Cirugías del Mes</h6>
                        <h3 class="pt-3"><i class="fa fa-calendar"></i> <span class="counter">  {{ $mensual }} </span></h3>
                        {{-- <h3 class="pt-3"><i class="fa fa-calendar"></i> <span class="counter">{{ $citasDelMes }}</span></h3> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Cirugías para Hoy</h6>
                        <h3 class="pt-3"><i class="fa fa-users"></i> <span class="counter"> {{ $hoy->count() }} </span></h3>
                        {{-- <h3 class="pt-3"><i class="fa fa-users"></i> <span class="counter">{{ $citasDelDia }}</span></h3> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Atendidos Hoy</h6>
                        <h3 class="pt-3"><i class="fa fa-user"></i> <span class="counter"> {{$atendidos->count()}} </span></h3>
                        {{-- <h3 class="pt-3"><i class="fa fa-user"></i> <span class="counter">{{ $atendidos }}</span></h3> --}}
                    </div>
                </div>
            </div>

            {{-- lista de todas --}}
            {{-- <div class="tab-content container-fluid p-0 m-0" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"> --}}
                    <div class="col-lg-12 col-md-12 mt-10">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Doc. Identidad</th>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                         <th>Cirugia</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Doc. Identidad</th>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                         <th>Cirugia</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                               <tbody>
                              
                                        @foreach ($day as $surgeries)
                                            <tr style="height:40px;">

                                            @foreach ($surgeries->patient as $patient)
                                            <td style="text-align: center; font-size:10px; height:40px;">                                               
                                                @if (!empty($patient->person->image->path))
                                                    <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($patient->person->image->path) }}" alt="">
                                                @else
                                                    <img src="" alt=""  width="100%" height="100%">
                                                @endif     
                                            </td>
                                            @endforeach   

                                            @foreach ( $surgeries->patient as $patient ) 
                                            <td>{{ $patient->person->type_dni }} - {{$patient->person->dni }}</td>
                                            <td>{{ $patient->person->name }} {{$patient->person->lastname }}</td> 
                                            @endforeach
                                            <td class="">{{ $surgeries->employe->person->name }} {{$surgeries->employe->person->lastname }}</td> 
                                            <td class="">{{ $surgeries->typesurgeries->name }} </td> 
                                            <td> {{ $surgeries->date }}  </td>

                                            @if($surgeries->informe->first()->fecha_culminar > Carbon::now())
                                            <td class="badge badge-success py-1 mt-3">Hospitalizado</td>
                                            @else
                                            <td class="badge badge-azuloscuro py-1 mt-3">Atendido</td>
                                            @endif
                                        </tr>
                                    @endforeach                                  
                                </tbody> 
                            </table>
                        </div>
                    </div>
                </div>
@endsection

@section('scripts')

<script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets\js\table\datatable.js') }}"></script>
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>

@endsection 
