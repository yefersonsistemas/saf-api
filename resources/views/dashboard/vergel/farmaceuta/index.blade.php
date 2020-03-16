@extends('dashboard.layouts.app')

@section('stock','active')
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

@section('title','Lista de Insumos')

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
                                        <th>Nombre</th>
                                        <th>marca</th>
                                        <th>Laboratorio</th>
                                        <th>Presentación</th>
                                        <th>Medida</th>
                                        {{-- <th>Cantidad</th> --}}
                                        <th>Stock</th>
                                        <th class="text-center">Lote</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>marca</th>
                                        <th>Laboratorio</th>
                                        <th>Presentación</th>
                                        <th>Medida</th>
                                        {{-- <th>Cantidad</th> --}}
                                        <th>Stock</th>
                                        <th class="text-center">Lote</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($stock as $item)
                                        <tr>
                                            <td>{{$item->medicine_pharmacy->medicine->name}}</td>
                                            <td>{{$item->medicine_pharmacy->marca}}</td>
                                            <td>{{$item->medicine_pharmacy->laboratory}}</td>
                                            <td>{{$item->medicine_pharmacy->presentation}}</td>
                                            <td>{{$item->medicine_pharmacy->measure}}</td>
                                            {{-- <td>{{$item->medicine_pharmacy->quantity_Unit}}</td> --}}
                                            <td>{{$item->total}}</td>
                                            <td class="d-flex justify-content-center"><a href="{{route('farmaceuta.add',$item->medicine_pharmacy->id)}}" class="btn btn-verdePastel text-white"><i class="fa fa-plus-circle"></i>&nbsp;Agregar</a></td>
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
