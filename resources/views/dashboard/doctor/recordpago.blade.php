@extends('dashboard.layouts.app')

@section('doctor', 'active')
@section('css')

<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">

@endsection

@section('content')
<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            {{-- Contadores --}}
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">                                
                            <h6>Total De Citas Agendadas</h6>
                            <h4 class="pt-2"><i class="fa fa-address-book"></i> <span class="counter">2,250</span></h4>
                            {{-- <h5>$1,25,451.23</h5> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Total De Citas Del Mes</h6>
                            <h4 class="pt-2"><i class="fa fa-calendar"></i> <span class="counter">750</span></h4>
                            {{-- <h5>$3,80,451.00</h5> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Citas Para Hoy</h6>
                            <h4 class="pt-2"><i class="fa fa-users"></i> <span class="counter">25</span></h4>
                            {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 65.27%</span> Since last month</span>                                --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body py-2">
                            <h6>Atendidos Hoy</h6>
                            <h4 class="pt-2"><i class="fa fa-user"></i> <span class="counter">5</span></h4>
                            {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 165.27%</span> Since last month</span>                                --}}
                        </div>
                    </div>
                </div>
                <div class="tab-content mx-auto">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        {{-- <th>#</th> --}}
                                        <th style="text-align:center">Fecha</th>
                                        <th style="text-align:center">Pago</th>
                                        {{-- <th style="text-align:center">Descripción</th> --}}
                                        <th style="text-align:center">Detalle</th>
                                    </tr>
                                </thead>
                                {{-- <tfoot>
                                    <tr>
                                        <th></th>
                                        <th style="text-align:center">Total</th>
                                        <th></th>
                                        <th>{{ $pago }}</th>
                                        <th></th>
                                    </tr>
                                </tfoot> --}}
                                <tbody>
                                    <tr class="event-click">
                                        {{-- <td>1</td> --}}
                                        <td style="text-align:center">15/12/2019</td>
                                        <td style="text-align:center">{{ $pago }}</td>
                                        {{-- <td style="text-align:center">Pago de la primera semana de trabajo</td> --}}
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailpago">
                                                Detalle
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- <!-- Modal -->
                        <div class="modal fade" id="detailpago" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Detalles del Pago</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Hola Peluca
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    
                                </div>
                                </div>
                        </div> --}}
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