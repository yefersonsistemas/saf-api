@extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')

@php
    use Carbon\Carbon;
@endphp

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
            <div class="col-md-12 mt-3">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center active btn btn-outline-primary m-auto" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Todas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-success" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Aprobadas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-danger" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Canceladas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-warning" id="pills-reprogram-tab" data-toggle="pill" href="#pills-reprogram" role="tab" aria-controls="pills-reprogram" aria-selected="false">Reprogramadas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-secondary" id="pills-suspendidas-tab" data-toggle="pill" href="#pills-suspendidas" role="tab" aria-controls="pills-suspendidas" aria-selected="false">Suspendidas</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                        <th class="text-center">E/S</th>
                                        <th class="text-center">EC/SC</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                        <th class="text-center">E/S</th>
                                        <th class="text-center">EC/SC</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                            <td style="text-align: center; font-size:10px">
                                                @if (!empty($reservation->patient->image->path))
                                                    <img class="rounded circle" width="150px" height="auto" src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                    <img src="" alt="" >
                                                @endif
                                                <div class="text-center">
                                                    @if ($reservation->patient->historyPatient == null)
                                                        <a href="{{ route('checkin.history', $reservation->patient_id) }}" class="btn btn-success">Generar</a>
                                                    @else
                                                        <a href="{{ route('checkin.history', $reservation->id) }}">Ver Historia</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }} {{ $reservation->patient->lastname }}</td>
                                            <th>{{ Carbon::parse($reservation->date)->format('d-m-Y') }}</th>
                                            <td>{{ $reservation->person->name }} {{ $reservation->person->lastname }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td>
                                                @if ($reservation->status == 'Aprobada')
                                                    <span class="badge badge-success">{{ $reservation->status }}</span>
                                                @endif
                                                @if ($reservation->status == 'Cancelada')
                                                    <span class="badge badge-danger">{{ $reservation->status }}</span>
                                                @endif
                                                @if ($reservation->status == 'Reprogramada')
                                                    <span class="badge badge-secondary">{{ $reservation->status }}</span>
                                                @endif
                                                @if ($reservation->status == 'Suspendida')
                                                    <span class="badge badge-warning">{{ $reservation->status }}</span>
                                                @endif
                                                @if ($reservation->status == 'Pendiente')
                                                    <span class="badge badge-azuloscuro">{{ $reservation->status }}</span>
                                                @endif
                                            </td>
                                            
                                            <td style="display: inline-block">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="Aprobar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Aprobada">A</button>
                                                <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                            </td>

                                            <td>  
                                                 <!--Si no a llegado a las instalaciones-->
                                                 @if($reservation->patient->inputoutput->isEmpty())
                                                    <div>
                                                        <a href="{{ route ('checkin.statusIn', $reservation->patient_id) }}" class="btn btn-secondary">E</a>
                                                    </div>
                                                @endif

                                                <!--Si esta dentro de las instalaciones-->
                                                @if(!empty($reservation->patient->inputoutput->first()->inside)  && empty($reservation->patient->inputoutput->first()->outside))
                                                    <div>
                                                        <button disabled href="{{ route ('checkin.statusIn', $reservation->patient_id) }}" class="btn btn-success">E</button>
                                                    </div>
                                                @endif

                                                <!--Si ya se fue de las instalaciones-->
                                                @if(!empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->outside))
                                                    <div>
                                                        <button href="{{ route ('checkin.insideOffice', $reservation) }}" class="btn btn-danger primero" disabled>E</button>
                                                    </div>
                                                @endif   
                                            </td>

                                            <td>  
                                                <!--Si no ha llegado a las instalaciones-->
                                                @if(empty($reservation->patient->inputoutput->first()->inside_office) && empty($reservation->patient->inputoutput->first()->inside))
                                                    <div>
                                                        <button href="{{ route ('checkin.insideOffice', $reservation) }}" class="btn btn-secondary primero" disabled>E</button>
                                                    </div>
                                                @endif

                                                <!--Si esta en espera-->
                                                @if(empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->inside))
                                                    <div>
                                                        <a href="{{ route ('checkin.insideOffice', $reservation) }}" class="btn btn-secondary primero">E</a>
                                                    </div>
                                                @endif

                                                <!--Si esta dentro del consultorio-->
                                                @if(!empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->inside) && empty($reservation->patient->inputoutput->first()->outside_office))
                                                    <div>
                                                        <button disabled href="{{ route ('checkin.insideOffice', $reservation) }}" class="btn btn-success primero">E</button>
                                                    </div>
                                                 @endif

                                                 <!--Si salio del consultorio-->
                                                 @if(!empty($reservation->patient->inputoutput->first()->inside) && !empty($reservation->patient->inputoutput->first()->inside_office) && !empty($reservation->patient->inputoutput->first()->outside_office))
                                                    <div>
                                                        <button disabled href="{{ route ('checkin.insideOffice', $reservation) }}" class="btn btn-danger primero">E</button>
                                                    </div>
                                                @endif
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
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @forelse ($aprobadas as $reservation)
                                        <tr>
                                            <td>
                                                @if (!empty($reservation->patient->image->path))
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                <img src="" alt="" >
                                                @endif
                                                <div class="text-center">
                                                    @if ($reservation->patient->historyPatient == null)
                                                        <a href="{{ route('checkin.history', $reservation->patient_id) }}" class="btn btn-success">Generar</a>
                                                    @else
                                                        <a href="{{ route('checkin.history', $reservation->id) }}"> {{ $reservation->patient->historyPatient->history_number }}</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
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
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($canceladas as $reservation)
                                        <tr>
                                            <td style="text-align: center;">
                                                @if (!empty($reservation->patient->image->path))
                                                    <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                    <img src="" alt="" >
                                                @endif
                                                <div class="text-center">
                                                    @if ($reservation->patient->historyPatient == null)
                                                        <a href="{{ route('checkin.history', $reservation->patient_id) }}" class="btn btn-success">Generar</a>
                                                    @else
                                                        <a href="{{ route('checkin.history', $reservation->id) }}">Ver Historia</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
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
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($reprogramadas as $reservation)
                                        <tr>
                                            <td style="text-align: center;">
                                                @if (!empty($reservation->patient->image->path))
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                <img src="" alt="" >
                                                @endif
                                                <div class="text-center">
                                                    @if ($reservation->patient->historyPatient == null)
                                                        <a href="{{ route('checkin.history', $reservation->patient_id) }}" class="btn btn-success">Generar</a>
                                                    @else
                                                        <a href="{{ route('checkin.history', $reservation->id) }}">Ver Historia</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
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
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($suspendidas as $reservation)
                                        <tr>
                                            <td style="text-align: center;">
                                                @if (!empty($reservation->patient->image->path))
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($reservation->patient->image->path) }}" alt="">
                                                @else
                                                <img src="" alt="" >
                                                @endif
                                                <div class="text-center">
                                                    @if ($reservation->patient->historyPatient == null)
                                                        <a href="{{ route('checkin.history', $reservation->patient_id) }}" class="btn btn-success">Generar</a>
                                                    @else
                                                        <a href="{{ route('checkin.history', $reservation->id) }}">Ver Historia</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $reservation->patient->type_dni }}-{{ $reservation->patient->dni }}</td>
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

{{-- modals --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Paciente </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('reservation.status') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="reservation_id" class="reservation_id">
                        <input type="hidden" name="type" class="type">
                        <label for="message-text" class="col-form-label">Motivo:</label>
                        <textarea class="form-control" name="motivo" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
  
{{-- modals --}}
@endsection

@section('scripts')
    <script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets\js\table\datatable.js') }}"></script>

    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
            var id  = button.data('id');
            var type = button.data('type');

            if (type == 'Reprogramada') {
                $('#fecha').html('<label>Seleccionar nueva fecha</label> <div class="input-group"> <input data-provide="datepicker" name="date" data-date-autoclose="true" class="form-control"> </div>');
                $('.reservation_id').val(id);
                $('.type').val(type);
            }
            insertDates(type, id);
            var modal = $(this);
            modal.find('.modal-title').text(recipient);
            $('.reservation_id').val(id);
            $('.type').val(type);

        });

        $('#modalReprogramadas').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
            var id  = button.data('id');
            var type = button.data('type');

            var modal = $(this);
            modal.find('.modal-title').text(recipient);
            insertDates(type, id);
        });

        function insertDates(type, id){
            $('#reservation_id').val(id);
            $('#type').val(type);
        }

    </script>
@endsection