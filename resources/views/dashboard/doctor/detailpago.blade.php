@extends('dashboard.layouts.app')

@section('doctor','active')
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
                <div class="tab-content mx-auto">
                <div class="col-lg-12">
                    <div class="table-responsive mb-4">
                        <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                            <thead>
                                <tr>
                                    <th style="text-align:center">Fecha</th>
                                    <th style="text-align:center">Paciente</th>
                                    <th style="text-align:center">Total Cobrado</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="text-align:center">Total Acumulado</th>

                                    
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr class="event-click">
                                    <td style="text-align:center">15/12/2019</td>
                                    <td style="text-align:center">Pago de la primera semana de trabajo</td>
                                    <td style="text-align:center"></td>
                                    {{-- <td><a class="btn btn-primary" href="">Ver Detalle</a></td> --}}
                                </tr>
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