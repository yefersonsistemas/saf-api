@extends('dashboard.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">

@endsection

@section('title','Lista de empleados')

@section('content')
@can('ver lista de empleados')
<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="tab-content" id="pills-tabContent">
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
                                    <th>Cargo</th>
                                    <th>Acción</th>
                                    {{-- <th>Esepcialidad</th> --}}
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Foto</th>
                                    <th>Cedula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Cargo</th>
                                    <th>Acción</th>
                                    {{-- <th>Esepcialidad</th> --}}
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($employes as $employe)
                                    <tr>
                                        <td>
                                            @if (!empty($employe->image->path))
                                                <img class="rounded circle" width="150px" height="auto" src="{{ Storage::url($employe->image->path) }}" alt="">
                                            @else
                                                <img src="" alt="" >
                                            @endif
                                        </td>
                                        <td>{{ $employe->person->type_dni }} - {{ $employe->person->dni }}</td>
                                        <td>{{ $employe->person->name }}</td>
                                        <td>{{ $employe->person->lastname }}</td>
                                        <td>{{ $employe->position->name }}</td>
                                        <td>
                                            @if ($employe->position->name == 'doctor')
                                            <a href="{{ route('doctores.edit', $employe->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('empleado.delete', $employe) }}" method="POST">
                                                <button title="Eliminar" class=" btn btn-danger" ><i class="fa fa-eraser"></i></i></button>
                                                @method('delete')
                                                @csrf
                                            </form>
                                            @elseif ($employe->position->name != 'doctor')
                                            <a href="{{ route('empleado.edit', $employe->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('empleado.delete', $employe) }}" method="POST">
                                                <button title="Eliminar" class=" btn btn-danger" ><i class="fa fa-eraser"></i></i></button>
                                                @method('delete')
                                                @csrf
                                            </form>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            @if ( $employe->position->name == 'doctor')
                                                @foreach ($employe->speciality as $speciality)
                                                {{ $speciality->name }}
                                                @endforeach
                                            @endif
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    @endcan
@endsection

@section('scripts')
<script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets\js\table\datatable.js') }}"></script>

@endsection