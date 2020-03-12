@extends('dashboard.layouts.app')

@section('cites','active')
@section('day','active')
@section('iorol','d-block')
@section('dire','d-none')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    
@endsection


@section('title','Citas del día')

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
            
            <div class="col-lg-12 mt-10">
                <div class="table-responsive mb-4">
                    <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Doc. Identidad</th>
                                <th>Paciente</th>
                                <th>Doctor</th>
                                <th>Cirugia</th>
                                <th>Quirofano</th>
                                <th>Fecha</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto</th>
                                <th>Doc. Identidad</th>
                                <th>Paciente</th>
                                <th>Doctor</th>
                                <th>Cirugia</th>
                                <th>Quirofano</th>
                                <th>Fecha</th>
                                <th>Accion</th>
                            </tr>
                        </tfoot>
                        <tbody>  
                            @foreach ($hoy as $surgeries)
                            <tr style="height:40px;">
                                @foreach ( $surgeries->patient as $patient )
                                    <td style="text-align: center; font-size:10px; height:40px;">
                                        @if(!empty($patient->person->image->path)) 
                                         <img class="roundedcircle"width="100%"height="100%" src="{{ Storage::url($patient->person->image->path)}}" alt="">                                          
                                         @endif  
                                    </td> 
                                @endforeach
                                @foreach ( $surgeries->patient as $patient )
                                    <td > {{ $patient->person->type_dni }} - {{ $surgeries->employe->person->dni }} </td> 
                                    <td > {{ $patient->person->name }} {{ $surgeries->employe->person->lastname }} </td> 
                                @endforeach
                                <td> {{ $surgeries->employe->person->name }} {{ $surgeries->employe->person->lastname }}</td>
                                <td> {{ $surgeries->typesurgeries->name }} </td>

                                @if ($surgeries->file_doctor->last() != null)
                                <td>Hospitalizado</td>
                                @else
                                <td> {{ $surgeries->area->name }}  </td>
                                @endif
                                
                                <td> {{ $surgeries->date }}  </td>
                                <td class="justify-content-center text-center"><a href="" class="btn btn-info text-white"  data-toggle="tooltip" data-placement="left" title="Facturar"><i class="fe fe-printer"></i></a></td>
                             </tr>
                            @endforeach
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
