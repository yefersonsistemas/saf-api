@extends('dashboard.layouts.app')

@section('stock2','active')
@section('farma','active')
@section('farmarol','d-block')
@section('dire','d-none')
@section('css')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
@endsection


@endsection

@section('title','Asignación de Insumos')

@section('content')
    <div class="section-body  py-4">
        <div class="container-fluid">
            <div class="row clearfix d-flex justify-content-between mb-2">
                {{-- Contadores --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Total De Insumos</h6>
                            <h4 class="pt-2"><i class="fa fa-address-book"></i> <span class="counter">2,250</span></h4>
                            {{--
                                <h5>$1,25,451.23</h5> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Total De Insumos Asignados</h6>
                            <h4 class="pt-2"><i class="fa fa-calendar"></i> <span class="counter">750</span></h4>
                            {{--
                                <h5>$3,80,451.00</h5> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Total De insumos Usados</h6>
                            <h4 class="pt-2"><i class="fa fa-users"></i> <span class="counter">25</span></h4>
                            {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 65.27%</span> Since last month</span> --}}
                        </div>
                    </div>
                </div>
            </div>
                {{-- --------Step-----------}}
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cirugía</th>
                                        <th>Fecha Ingreso</th>
                                        <th>Fecha culminar</th>
                                        <th class="text-center">Medicamento</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cirugía</th>
                                        <th>Fecha Ingreso</th>
                                        <th>Fecha culminar</th>
                                        <th class="text-center">Medicamento</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($informe as $item)
                                        <tr>
                                            <td style="text-align: center; font-size:10px; height:40px;">
                                                @if (!empty($item->surgery->patient->first()->person->image->path))
                                                <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($item->surgery->patient->first()->person->image->path) }}" alt="">
                                                @else
                                                    <img src="" alt="" width="100%" height="100%">
                                                @endif
                                            </td>
                                                <td>{{$item->surgery->patient->first()->person->name}}</td>
                                                <td>{{$item->surgery->patient->first()->person->lastname}}</td>
                                            <td>{{$item->surgery->typesurgeries->name}}</td>
                                            <td>{{$item->fecha_ingreso}}</td>
                                            <td>{{$item->fecha_culminar}}</td>
                                            @if(!empty($item->surgery->file_doctor->first()))
                                            <td class="d-flex justify-content-center"><a href="{{route('farmaceuta.asignar_medicine',$item->id)}}" class="btn btn-verdePastel text-white">Asignar</a></td>
                                            @else
                                            <td class="d-flex justify-content-center"><a href="{{route('farmaceuta.asignar_medicine',$item->id)}}" class="btn btn-verdePastel text-white">Agregar</a></td>
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
