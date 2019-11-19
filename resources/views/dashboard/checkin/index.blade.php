@extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title','Todas las citas')

@section('content')
<style>
    .dataTables_filter label{
        color: #434a54;
    }
    .dataTables_filter label input:focus{
        border: 2px solid #00506b;
    }
</style>
<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            {{-- Contadores --}}
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body">                                
                            <h6>Total De Citas Agendadas</h6>
                            <h3 class="pt-3"><i class="fa fa-address-book"></i> <span class="counter">2,250</span></h3>
                            {{-- <h5>$1,25,451.23</h5> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body">
                            <h6>Total De Citas Del Mes</h6>
                            <h3 class="pt-3"><i class="fa fa-calendar"></i> <span class="counter">750</span></h3>
                            {{-- <h5>$3,80,451.00</h5> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body">
                            <h6>Citas Para Hoy</h6>
                            <h3 class="pt-3"><i class="fa fa-users"></i> <span class="counter">25</span></h3>
                            {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 65.27%</span> Since last month</span>                                --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body">
                            <h6>Atendidos Hoy</h6>
                            <h3 class="pt-3"><i class="fa fa-user"></i> <span class="counter">5</span></h3>
                            {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 165.27%</span> Since last month</span>                                --}}
                        </div>
                    </div>
                </div>
           
            {{-- Tabs de citas --}}
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active btn btn-outline-primary" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Todas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-success" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Aprobadas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-danger" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Canceladas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-warning" id="pills-reprogram-tab" data-toggle="pill" href="#pills-reprogram" role="tab" aria-controls="pills-contact" aria-selected="false">Reprogramadas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-secondary" id="pills-suspendidas-tab" data-toggle="pill" href="#pills-suspendidas" role="tab" aria-controls="pills-contact" aria-selected="false">Suspendidas</a>
                </li>
            </ul>

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
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Acciones</th>
                                        <th class="text-center">Historia</th>
                                        <th class="text-center">E/S</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Acciones</th>
                                        <th class="text-center">Historia</th>
                                        <th class="text-center">E/S</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                            <td>
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                            </td>
                                            <td>{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning">R</a>
                                                <a href="" class="btn btn-secondary">S</a>
                                                <a href="" class="btn btn-danger">C</a>
                                            </td>
                                            <td class="text-center">
                                                @if ($reservation->patient->historyPatient == null)
                                                    <a href="" class="btn btn-success">Generar</a>
                                                @else
                                                    {{ $reservation->patient->historyPatient->history_number }}
                                                @endif
                                            </td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-secondary">E</a>
                                                <a href="" class="btn btn-secondary">S</a>
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
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                        <th>Historia</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                        <th>Historia</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @forelse ($aprobadas as $reservation)
                                        <tr>
                                            <td>
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                            </td>
                                            <td>{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td><span class="badge badge-success">{{ $reservation->status }}</span></td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning">R</a>
                                                <a href="" class="btn btn-secondary">S</a>
                                                <a href="" class="btn btn-danger">C</a>
                                            </td>
                                            <td>
                                                @if ($reservation->patient->historyPatient == null)
                                                    <a href="" class="btn btn-success">Generar</a>
                                                @else
                                                    {{ $reservation->patient->historyPatient->history_number }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <h2>Sin datos</h2>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                        <th>Historia</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                        <th>Historia</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($canceladas as $reservation)
                                        <tr>
                                            <td>
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                            </td>
                                            <td>{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td><span class="badge badge-danger">{{ $reservation->status }}</span></td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning">R</a>
                                                <a href="" class="btn btn-secondary">S</a>
                                                <a href="" class="btn btn-danger">C</a>
                                            </td>
                                            <td>
                                                @if ($reservation->patient->historyPatient == null)
                                                    <a href="" class="btn btn-success">Generar</a>
                                                @else
                                                    {{ $reservation->patient->historyPatient->history_number }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>   
                <div class="tab-pane fade" id="pills-reprogram" role="tabpanel" aria-labelledby="pills-reprogram-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                        <th>Historia</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                        <th>Historia</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($reprogramadas as $reservation)
                                        <tr>
                                            <td>
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                            </td>
                                            <td>{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td><span class="badge badge-warning">{{ $reservation->status }}</span></td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning">R</a>
                                                <a href="" class="btn btn-secondary">S</a>
                                                <a href="" class="btn btn-danger">C</a>
                                            </td>
                                            <td>
                                                @if ($reservation->patient->historyPatient == null)
                                                    <a href="" class="btn btn-success">Generar</a>
                                                @else
                                                    {{ $reservation->patient->historyPatient->history_number }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>  
                <div class="tab-pane fade" id="pills-suspendidas" role="tabpanel" aria-labelledby="pills-suspendidas-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                        <th>Historia</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                        <th>Historia</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($suspendidas as $reservation)
                                        <tr>
                                            <td>
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                            </td>
                                            <td>{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td><span class="badge badge-secondary">{{ $reservation->status }}</span></td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning">R</a>
                                                <a href="" class="btn btn-secondary">S</a>
                                                <a href="" class="btn btn-danger">C</a>
                                            </td>
                                            <td>
                                                @if ($reservation->patient->historyPatient == null)
                                                    <a href="" class="btn btn-success">Generar</a>
                                                @else
                                                    {{ $reservation->patient->historyPatient->history_number }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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