@extends('dashboard.layouts.app')

@section('doctor','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title','Doctor')
@section('content')
<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="table-responsive mb-4">
                    <table class="table table-hover js-basic-example dataTable table_custom spacing5 anniel">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Motivo</th>
                                <th>Historia</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>DNI</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Motivo</th>
                                    <th>Historia</th>
                            </tr>
                        </tfoot>
                        <tbody>
                                @foreach ($patients as $patient)
                                <tr>
                                    <td> {{ $reservation->patient->id }}</td>
                                    <td>  <img class="rounded circle" style="border-radius:50%!important" width="50px" height="50px"  src="{{ Storage::url($patient->image->path) }}" alt=""></td>
                                    <td> {{ $patient->type_dni }} - {{ $patient->dni }}</td>
                                    <td> {{ $patient->name }}</td>
                                    <td> {{ $patient->lastname }}</td>
                                    <td> {{ $patient->motive }}</td>
                                    <td> {{ $patient->history }}</td>s
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