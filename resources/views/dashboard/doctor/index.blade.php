@extends('dashboard.layouts.app')

@section('doctor','active')
@section('docrol','d-block')
@section('dire','d-none')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
@endsection

@section('title','Doctor')
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

            {{-- Tabs de citas --}}
            <div class="col-md-12 mt-3 doctor-tabs">
                <ul class="nav nav-pills mb-3 d-flex justify-content-around" id="pills-tab" role="tablist">
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex justify-content-center  active btn btn-outline-primary m-auto" id="pills-today-tab" data-toggle="pill" href="#pills-today" role="tab" aria-controls="pills-today" aria-selected="true">Hoy</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex justify-content-center  btn btn-outline-success" id="pills-week-tab" data-toggle="pill" href="#pills-week" role="tab" aria-controls="pills-week" aria-selected="false">Semana</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex justify-content-center  btn btn-outline-danger" id="pills-month-tab" data-toggle="pill" href="#pills-month" role="tab" aria-controls="pills-month" aria-selected="false">Mes</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex justify-content-center  btn btn-outline-warning" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="false">Todas</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mx-auto">
                <div class="tab-pane fade show active" id="pills-today" role="tabpanel" aria-labelledby="pills-today-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Motivo</th>
                                        <th>Status</th>
                                        <th>Historia</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Motivo</th>
                                        <th>Status</th>
                                        <th>Historia</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                        @foreach ($today as $reservation)
                                        {{-- @if($reservation->inputoutput->isEmpty()) <!--esta en espera-->
                                        <tr class="event-click" style="border-radius:3px; border:2px solid  #FACC2E;">
                                        @endif
        
                                        @if(!empty($reservation->inputoutput->first()->inside) && empty($reservation->inputoutput->first()->inside_office) && empty($reservation->inputoutput->first()->outside_office) && empty($reservation->inputoutput->first()->outside))
                                        <!--esta en espera-->
                                        <tr class="event-click" style="border-radius:3px; border:2px solid  #000;">
                                        @endif
    
                                        @if(!empty($reservation->inputoutput->first()->inside_office) && !empty($reservation->inputoutput->first()->inside)  && empty($reservation->inputoutput->first()->outside_office) && empty($reservation->inputoutput->first()->outside))
                                        <!--dentro del consultorio-->
                                        <tr class="event-click" style="border-radius:3px; border:2px solid  #00ad88">
                                        @endif
    
                                        @if(!empty($reservation->inputoutput->first()->outside_office) && !empty($reservation->inputoutput->first()->inside) && !empty($reservation->inputoutput->first()->outside_office) && empty($reservation->inputoutput->first()->outside))
                                        <!--fuera del consultorio-->
                                        <tr class="event-click" style="border-radius:3px; border:2px solid #B40404">
                                        @endif
    
                                        @if(!empty($reservation->inputoutput->first()->outside) && !empty($reservation->inputoutput->first()->inside) && !empty($reservation->inputoutput->first()->outside_office) && !empty($reservation->inputoutput->first()->outside))<!--fuera de las instalaciones-->
                                        <tr class="event-click" style="border-radius:3px; border:2px solid #ccc">
                                        @endif --}}

                                        <tr>
                                            <td scope="row">{{ $loop->iteration}}</td>
                                            <td style="height:40px;">
                                                @if (!empty($reservation->patient->image->path))
                                                    <img class="img-thumbnail" whidth="100%" height="100%" src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                    <img src="" alt="" whidth="100%" height="100%">
                                                @endif
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td> {{ $reservation->description }}</td>

                                            @if($reservation->patient->inputoutput->isEmpty())<!--esta en espera-->
                                            <td><span class="status-icon" style=" padding:5px; animation: pulse 2s infinite; background:#FACC2E;"></span><i class="fa fa-clock-o"></i>No ha llegado a las instalaciones</td>
                                            @endif
                                            {{-- @if(!empty($reservation->inputoutput->first()->inside) && !empty($reservation->inputoutput->first()->inside_office) && !empty($reservation->inputoutput->first()->outside_office) && !empty($reservation->inputoutput->first()->outside))
                                            <!--esta en espera-->
                                                <td><span class="status-icon" style="  padding:5px; animation: pulse 2s infinite; background:#000;"></span><i class="fa fa-hospital-o"></i> Dentro de las instalaciones</td>
                                            @endif --}}

            
                                            @if(!empty($reservation->patient->inputoutput) && !empty($reservation->patient->inputoutput->first()->inside) && empty($reservation->patient->inputoutput->first()->inside_office) && empty($reservation->patient->inputoutput->first()->outside_office) && empty($reservation->patient->inputoutput->first()->outside))
                                            <!--esta en espera-->
                                                <td><span class="status-icon" style="  padding:5px; animation: pulse 2s infinite; background:#000;"></span><i class="fa fa-hospital-o"></i>Sala de espera</td>
                                            @endif
        
                                            @if(!empty($reservation->patient->inputoutput) && !empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->inside)  && empty($reservation->patient->inputoutput->first()->outside_office) && empty($reservation->patient->inputoutput->first()->outside))
                                            <!--dentro del consultorio-->
                                                <td><span class="status-icon" style=" ppadding:5px; animation: pulse 2s infinite; background:#00ad88;"></span><i class="fa fa-user-md"></i> Dentro del consultorio</td>
                                            @endif
        
                                            @if(!empty($reservation->patient->inputoutput) && !empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->inside) && !empty($reservation->patient->inputoutput->first()->outside_office) && empty($reservation->patient->inputoutput->first()->outside))
                                            <!--fuera del consultorio-->
                                            <td><span class="status-icon" style="  padding:5px; animation: pulse 2s infinite; background: #B40404;"></span><i class="fa fa-user-md"></i> Fuera del consultorio</td>
                                            @endif
        
                                            @if(!empty($reservation->patient->inputoutput) && !empty($reservation->patient->inputoutput->first()->inside) && !empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->outside_office) && !empty($reservation->patient->inputoutput->first()->outside))<!--fuera de las instalaciones-->
                                            <td><span class="status-icon" style= " padding:5px; animation: pulse 2s infinite; background:#ccc;"></span><i class="fa fa-hospital-o"></i> Fuera de las instalaciones</td>
                                            @endif

                                            <td> 
                                                @if(!empty($reservation->patient->inputoutput) && !empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->inside)  && empty($reservation->patient->inputoutput->first()->outside_office) && empty($reservation->patient->inputoutput->first()->outside))
                                                  
                                                    @if($reservation->patient->historyPatient->diagnostic->isEmpty())
                                                    <a href="{{ route('doctor.show', $reservation->patient_id) }}" class="badge badge-info btn p-2">
                                                        <i class="fa fa-eye"></i> Realizar consulta
                                                    </a>
                                                    @endif
                                                @endif
                                                @if(!empty($reservation->patient->inputoutput) && !empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->inside) && !empty($reservation->patient->inputoutput->first()->outside_office) && empty($reservation->patient->inputoutput->first()->outside))
                                                    @if(!($reservation->patient->historyPatient->diagnostic->isEmpty()))
                                                        <a href="{{ route('doctor.editar', $reservation->id) }}" class="badge badge-success btn p-2">
                                                            <i class="fa fa-eye"></i> Editar consulta
                                                        </a>
                                                    @endif
                                                @endif
                                                @if(!empty($reservation->patient->inputoutput) && !empty($reservation->patient->inputoutput->first()->inside) && !empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->outside_office) && !empty($reservation->patient->inputoutput->first()->outside))
                                                <button disabled class="badge badge-info btn p-2" style="background: #a1a1a1">
                                                    <i class="fa fa-eye"></i> Consulta realizada
                                                </button>
                                                @endif
                                                @if(!empty($reservation->patient->inputoutput) && !empty($reservation->patient->inputoutput->first()->inside) && empty($reservation->patient->inputoutput->first()->inside_office) && empty($reservation->patient->inputoutput->first()->outside_office) && empty($reservation->patient->inputoutput->first()->outside))
                                                    <button disabled class="badge badge-info btn p-2" style="background: #a1a1a1">
                                                        <i class="fa fa-eye"></i> Realizar consulta
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>                
                </div>
                <div class="tab-pane fade" id="pills-week" role="tabpanel" aria-labelledby="pills-week-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
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
                                        <th>Foto</th>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Motivo</th>
                                        <th>Historia</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($week as $reservation)
                                        <tr class="event-click">
                                            <td scope="row">{{ $loop->iteration}}</td>
                                            <td>
                                                @if (!empty($reservation->patient->image->path))
                                                    <img class="img-thumbnail" src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                    <img src="" alt="" >
                                                @endif
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td> {{ $reservation->description }}</td>
                                            <td> 
                                                <a href="{{ route('doctor.show', $reservation->patient_id) }}" class="badge badge-info btn p-2">
                                                    <i class="fa fa-eye"></i> Ver Historia
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>                
                </div>
                <div class="tab-pane fade" id="pills-month" role="tabpanel" aria-labelledby="pills-month-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
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
                                        <th>Foto</th>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Motivo</th>
                                        <th>Historia</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($month as $reservation)
                                        <tr class="event-click">
                                            <td scope="row">{{ $loop->iteration}}</td>
                                            <td>
                                                @if (!empty($reservation->patient->image->path))
                                                    <img class="img-thumbnail" src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                    <img src="" alt="" >
                                                @endif
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td> {{ $reservation->description }}</td>
                                            <td>
                                                <a href="{{ route('doctor.show', $reservation->patient_id) }}" class="badge badge-info btn p-2">
                                                    <i class="fa fa-eye"></i> Ver Historia
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>                
                </div>
                <div class="tab-pane fade" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Motivo</th>
                                        <th>Status</th>
                                        <th>Historia</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Motivo</th>
                                        <th>Status</th>
                                        <th>Historia</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($all as $reservation)

                                    <tr class="event-click">
                                        <td scope="row">{{ $loop->iteration}}</td>
                                        <td style="height:40px;">
                                            @if (!empty($reservation->patient->image->path))
                                                <img class="img-thumbnail" whidth="100%" height="100%" src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                            @else
                                                <img src="" alt="" whidth="100%" height="100%">
                                            @endif
                                        </td>
                                        <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                        <td>{{ $reservation->patient->name }}</td>
                                        <td>{{ $reservation->patient->lastname }}</td>
                                        <td> {{ $reservation->description }}</td>
                                        @if($reservation->inputoutput->isEmpty()) <!--esta en espera-->
                                        <td><span class="status-icon" style=" padding:5px; animation: pulse 2s infinite; background:#FACC2E;"></span><i class="fa fa-clock-o"></i>No ha llegado a las instalaciones</td>
                                        @endif
        
                                        @if(!empty($reservation->inputoutput->first()->inside) && empty($reservation->inputoutput->first()->inside_office) && empty($reservation->inputoutput->first()->outside_office) && empty($reservation->inputoutput->first()->outside))
                                        <!--esta en espera-->
                                            <td><span class="status-icon" style="  padding:5px; animation: pulse 2s infinite; background:#000;"></span><i class="fa fa-hospital-o"></i>Sala de espera</td>
                                        @endif
    
                                        @if(!empty($reservation->inputoutput->first()->inside_office) && !empty($reservation->inputoutput->first()->inside)  && empty($reservation->inputoutput->first()->outside_office) && empty($reservation->inputoutput->first()->outside))
                                        <!--dentro del consultorio-->
                                            <td><span class="status-icon" style=" ppadding:5px; animation: pulse 2s infinite; background:#00ad88;"></span><i class="fa fa-user-md"></i> Dentro del consultorio</td>
                                        @endif
    
                                        @if(!empty($reservation->inputoutput->first()->outside_office) && !empty($reservation->inputoutput->first()->inside) && !empty($reservation->inputoutput->first()->outside_office) && empty($reservation->inputoutput->first()->outside))
                                        <!--fuera del consultorio-->
                                        <td><span class="status-icon" style="  padding:5px; animation: pulse 2s infinite; background: #B40404;"></span><i class="fa fa-user-md"></i> Fuera del consultorio</td>
                                        @endif
    
                                        @if(!empty($reservation->inputoutput->first()->outside) && !empty($reservation->inputoutput->first()->inside) && !empty($reservation->inputoutput->first()->outside_office) && !empty($reservation->inputoutput->first()->outside))<!--fuera de las instalaciones-->
                                        <td><span class="status-icon" style= " padding:5px; animation: pulse 2s infinite; background:#ccc;"></span><i class="fa fa-hospital-o"></i> Fuera de las instalaciones</td>
                                        @endif
                                        @if(empty($reservation->inputoutput))<!--vacio-->
                                        <td></td>
                                        @endif
                                        <td> 
                                            <a href="{{ route('doctor.show', $reservation->patient_id) }}" class="badge badge-info btn p-2">
                                                <i class="fa fa-eye"></i> Ver Historia
                                            </a>
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