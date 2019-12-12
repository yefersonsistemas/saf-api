@extends('dashboard.layouts.app')

@section('css')
@endsection

@section('title','Lista de empleados')

@section('content')
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
@endsection