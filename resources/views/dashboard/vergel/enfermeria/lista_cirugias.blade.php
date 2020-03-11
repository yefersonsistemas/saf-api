
@extends('dashboard.layouts.app')

@section('Lista de Cirugias','active')
@section('all','active')
@section('enrol','d-block')
@section('dire','d-none')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">
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
            <div class="col-lg-12 col-md-12">
                <div class="table-responsive mb-4">
                    <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Fecha</th>
                                <th>Paciente</th>
                                <th>Doctor</th>
                                <th>Operación</th>
                                <th>Quirofano</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto</th>
                                <th>Fecha</th>
                                <th>Paciente</th>
                                <th>Doctor</th>
                                <th>Operación</th>
                                <th>Quirofano</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($surgeries as $surgeries)
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
                                    
                                    <td>{{$surgeries->employe->person->name}} {{$surgeries->employe->person->lastname}}</td>
                                    {{-- @foreach ($surgeries as $surgery) --}}
                                    <td>{{$surgeries->typesurgeries->name}}</td>
                                    {{-- @endforeach --}}
                                    <td>{{$surgeries->area->name}}</td>

                                    @if ($surgeries->file_internista->first() == null)
                                    <td class="d-flex justify-content-center" style="display: inline-block ">
                                        <a href="{{route('create.lista_cirugias', [$patient->id, $surgeries->id ] )}}" class="btn btn-azuloscuro"  data-toggle="tooltip" data-placement="bottom" title="Subir informe Pre-operatorio"><i class="fa fa-arrow-circle-o-up" style="font-size:18px"></i></a>
                                    </td>
                                    @elseif ($surgeries->file_internista != null)
                                    <td class="d-flex justify-content-center" style="display: inline-block ">
                                        <a href="{{route('create.lista_cirugias', [$patient->id, $surgeries->id ] )}}" class="btn btn-verdePastel"  data-toggle="tooltip" data-placement="bottom" title="Subir informes faltantes"><i class="fa fa-arrow-circle-o-up" style="font-size:18px"></i></a>
                                    </td>
                                    @endif
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