@extends('dashboard.layouts.app')

@section('doctor','active')
@section('docrol','d-block')
@section('dire','d-none')
@section('css')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
@endsection


@endsection

@section('title','Lista de Visitantes')

@section('content')
    <div class="section-body  py-4">
        <div class="container-fluid">
            <div class="row clearfix d-flex justify-content-center mb-2">
                {{-- Contadores --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Total De Visitantes</h6>
                            <h4 class="pt-2"><i class="fa fa-address-book"></i> <span class="counter">2,250</span></h4>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Total De Insumos Asignados</h6>
                            <h4 class="pt-2"><i class="fa fa-calendar"></i> <span class="counter">750</span></h4>
                          
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Total De insumos Usados</h6>
                            <h4 class="pt-2"><i class="fa fa-users"></i> <span class="counter">25</span></h4>
                  
                        </div>
                    </div>
                </div> --}}
            </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Documento </th>
                                        <th>Nombre</th>
                                          <th>Apellido</th>
                                          <th>Direccion</th>
                                          <th>Teléfono</th>
                                          <th>Imprimir</th>
                                        {{-- <th>Acompañante de:</th> --}}
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Documento de identidad</th>
                                        <th>Nombre</th>
                                          <th>Apellido</th>
                                          <th>Direccion</th>
                                          <th>Teléfono</th>
                                          <th>Imprimir</th>
                                        {{-- <th>Acompañante de:</th> --}}
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($all2 as $item)
                                        <tr>
                                            <td>{{$item->dni}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->lastname}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->phone}}</td>
                                            <td><a href="" class="btn btn-info text-white"><i class="fa fa-arrow-circle-o-down"></i></a></td>
                                            {{-- {{route('visitantes.print',$item->id)}} --}}
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
