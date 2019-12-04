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
                <div class="container">
                    <hr>
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
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-azuloscuro" id="pills-pendientes-tab" data-toggle="pill" href="#pills-pendientes" role="tab" aria-controls="pills-pendientes" aria-selected="false">Pendientes</a>
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
                                        <th>Fecha</th>
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
                                        <th>Fecha</th>
                                        <th>Doctor</th>
                                        <th>Esepcialidad</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                        <th>Historia</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                            <td>
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ ($reservation->patient->image != null) ? Storage::url($reservation->patient->image->path) : '' }}" alt="">
                                            </td>
                                            <td>{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <th>{{ $reservation->date }}</th>
                                            <td>{{ $reservation->person->name }}</td>
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
                                                @if ($reservation->patient->historyPatient == null)
                                                    <a href="{{ route('patients.generate', $reservation->patient) }}" class="btn btn-success">Generar</a>
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
                                    @foreach($aprobadas as $reservation)
                                        <tr>
                                            <td>
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ ($reservation->patient->image != null) ? Storage::url($reservation->patient->image->path) : '' }}" alt="">
                                            </td>
                                            <td>{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td><span class="badge badge-success">{{ $reservation->status }}</span></td>
                                            <td style="display: inline-block">
                                                <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>    
                                            </td>
                                            <td>
                                                @if ($reservation->patient->historyPatient == null)
                                                    <a href="{{ route('patients.generate', $reservation->patient) }}" class="btn btn-success">Generar</a>
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
                                        <th>Historia</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($canceladas as $reservation)
                                        <tr>
                                            <td>
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ ($reservation->patient->image != null) ? Storage::url($reservation->patient->image->path) : '' }}" alt="">
                                            </td>
                                            <td>{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td><span class="badge badge-danger">{{ $reservation->status }}</span></td>
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
                                        <th>Fecha</th>
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
                                        <th>Fecha</th>
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
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ ($reservation->patient->image != null) ? Storage::url($reservation->patient->image->path) : '' }}" alt="">
                                            </td>
                                            <td>{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->date }}</td>
                                            <td>{{ $reservation->person->name }}</td>
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
                                            </td>
                                            <td style="display: inline-block">
                                                <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>    
                                            </td>
                                            <td>
                                                @if ($reservation->patient->historyPatient == null)
                                                    <a href="{{ route('patients.generate', $reservation->patient) }}" class="btn btn-success">Generar</a>
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
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ ($reservation->patient->image != null) ? Storage::url($reservation->patient->image->path) : '' }}" alt="">
                                            </td>
                                            <td>{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td><span class="badge badge-secondary">{{ $reservation->status }}</span></td>
                                            <td style="display: inline-block">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="Aprobar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Aprobada">A</button>
                                                <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>    
                                            </td>
                                            <td>
                                                @if ($reservation->patient->historyPatient == null)
                                                    <a href="{{ route('patients.generate', $reservation->patient) }}" class="btn btn-success">Generar</a>
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
                <div class="tab-pane fade" id="pills-pendientes" role="tabpanel" aria-labelledby="pills-pendientes-tab">
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
                                    @foreach ($pendientes as $reservation)
                                        <tr>
                                            <td>
                                                <img class="rounded circle" width="150px" height="auto"  src="{{ ($reservation->patient->image != null) ? Storage::url($reservation->patient->image->path) : '' }}" alt="">
                                            </td>
                                            <td>{{ $reservation->patient->dni }}</td>
                                            <td>{{ $reservation->patient->name }}</td>
                                            <td>{{ $reservation->patient->lastname }}</td>
                                            <td>{{ $reservation->person->name }}</td>
                                            <td>{{ $reservation->speciality->name }}</td>
                                            <td><span class="badge badge-secondary" style="background-color: #00506b;">{{ $reservation->status }}</span></td>
                                            <td style="display: inline-block">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="Aprobar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Aprobada">A</button>
                                                <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>  
                                            </td>
                                            <td>
                                                @if ($reservation->patient->historyPatient == null)
                                                    <a href="{{ route('patients.generate', $reservation) }}" class="btn btn-success">Generar</a>
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
    <script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>

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