@extends('dashboard.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title','Medicos del dia')

@section('content')
<div class="col-md-12 mt-3">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item col-md-2">
            <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center active btn btn-outline-primary m-auto" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Del dia</a>
        </li>
        <li class="nav-item col-md-2">
            <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-success" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Todos</a>
        </li>
    </ul>
</div>
<div class="tab-content mx-auto" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="col-lg-12">
                <div class="table-responsive mb-4">
                    <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                        <thead>
                            <tr>
                                    <th>Foto</th>
                                    <th>Cedula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Esepcialidad</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                    <th>Foto</th>
                                    <th>Cedula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Esepcialidad</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                @foreach($em as $employe)
                                <tr>
                                    <td>
                                        @if (!empty($employe->image->path))
                                        <img src="{{ Storage::url($employe->image->path) }}" alt="">
                                        @else
                                        <img src="" alt="" >
                                        @endif
                                    </td>
                                    <td>{{ $employe->person->dni }}</td>
                                    <td>{{ $employe->person->name }}</td>
                                    <td>{{ $employe->person->lastname }}</td>
                                    <td>
                                    @foreach ($employe->speciality as $item)
                                        {{ $item->name }} <br>
                                    @endforeach
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>  
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="col-lg-12">
                <div class="table-responsive mb-4">
                    <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Esepcialidad</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto</th>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Esepcialidad</th>
                            </tr>
                        </tfoot>
                        <tbody>
                                @foreach ($e as $employe)
                                <tr>
                                    <td>
                                        @if (!empty($employe->image->path))
                                        <img src="{{ Storage::url($employe->image->path) }}" alt="">
                                        @else
                                        <img src="" alt="" >
                                        @endif
                                    </td>
                                    <td>{{ $employe->person->dni }}</td>
                                    <td>{{ $employe->person->name }}</td>
                                    <td>{{ $employe->person->lastname }}</td>
                                    <td>
                                    @foreach ($employe->speciality as $item)
                                        {{ $item->name }} <br>
                                    @endforeach
                                    </td>
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
@endsection