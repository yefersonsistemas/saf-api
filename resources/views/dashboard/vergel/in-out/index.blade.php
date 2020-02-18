 @extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')
@section('inrol','d-block')
@section('dire','d-none')

@php
    use Carbon\Carbon;
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">

    <!-- estilo para hacer lista scrolleable -->
    <!-- <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}"> -->
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

        img.rounded{
            max-width: 50px;
            width: 50px;
        }
    .img-test{
        height: 100%;
        width: 100%;
        background-position: center;
        background-size: cover;
    }

    .btn-repro{
        background: #ff8000;
        color: #fff;
    }
    .btn-enabled{
        color: #E6E6E6;
    }
</style>

<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            {{-- Contadores --}}
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Total De Citas del año</h6>
                        <h4 class="pt-3"><i class="fa fa-address-book"></i> <span class="counter">   </span></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Total De Citas Del Mes</h6>
                        <h4 class="pt-3"><i class="fa fa-calendar"></i> <span class="counter">  </span></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Citas Para Hoy</h6>
                        <h4 class="pt-3"><i class="fa fa-users"></i> <span class="counter">   </span></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Atendidos Hoy</h6>
                        <h4 class="pt-3"><i class="fa fa-user"></i> <span class="counter">  </span></h4>
                    </div>
                </div>
            </div>

            {{-- Tabs de citas --}}
            <div class="col-lg-12 col-md-12 mt-10">
                <ul class="nav nav-pills mb-3 d-flex justify-content-around" id="pills-tab" role="tablist">
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  pt-0 pb-0 pr-3 pl-3 d-flex flex-row justify-content-center active btn btn-outline-primary m-auto" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Todas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  pt-0 pb-0 pr-3 pl-3 d-flex flex-row justify-content-center btn btn-outline-success" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Aprobadas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  pt-0 pb-0 pr-3 pl-3 d-flex flex-row justify-content-center btn btn-outline-danger" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Canceladas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  pt-0 pb-0 pr-3 pl-3 d-flex flex-row justify-content-center btn btn-outline-warning" id="pills-reprogram-tab" data-toggle="pill" href="#pills-reprogram" role="tab" aria-controls="pills-reprogram" aria-selected="false">Reprogramadas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  pt-0 pb-0 pr-3 pl-3 d-flex flex-row justify-content-center btn btn-outline-secondary" id="pills-suspendidas-tab" data-toggle="pill" href="#pills-suspendidas" role="tab" aria-controls="pills-suspendidas" aria-selected="false">Suspendidas</a>
                    </li>
                </ul>
            </div>

            {{-- lista de todas --}}
            <div class="tab-content container-fluid p-0 m-0" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="col-lg-12 col-md-12 mt-10">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                         <th>Cirugia</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                         <th>Cirugia</th>
                                        <th class="fecha">Fecha</th>
                                        <th>Status</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                               <tbody>
                              
                                        @foreach ($day as $surgeries)
                                                <tr style="height:40px;">

                                                @foreach ($surgeries->patient as $patient)
                                                <td style="text-align: center; font-size:10px; height:40px;">                                               
                                                @if (!empty($patient->person->image->path))
                                                    <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($patient->person->image->path) }}" alt="">
                                                @else
                                                    <img src="" alt=""  width="100%" height="100%">
                                                @endif     
                                            </td>
                                            @endforeach   


                                         @foreach ( $surgeries->patient as $patient ) 
                                            <td>{{ $patient->person->name }} {{$patient->person->lastname }}</td> 
                                         @endforeach
                                            <td class="">{{ $surgeries->employe->person->name }} {{$surgeries->employe->person->lastname }}</td> 
                                            <td class="">{{ $surgeries->typesurgeries->name }} </td> 
                                            <td> {{ $surgeries->date }}  </td>
                                            <td> 
                                            @if ($surgeries->status == 'Aprobada') 
                                                    <span class="badge badge-success">{{ $surgeries->status }}</span> 
                                                @endif
                                                @if ($surgeries->status == 'Cancelada') --}}
                                                    <span class="badge badge-danger">{{ $surgeries->status }}</span> 
                                                @endif 
                                                @if ($surgeries->status == 'Reprogramada') --}}
                                                    <span class="badge badge-secondary">{{ $surgeries->status }}</span> 
                                                @endif 
                                                @if ($surgeries->status == 'Suspendida') --}}
                                                    <span class="badge badge-warning">{{ $surgeries->status }}</span> 
                                                @endif 
                                                @if ($surgeries->status == 'Pendiente') --}}
                                                    <span class="badge badge-azuloscuro">{{ $surgeries->status }}</span> 
                                                @endif 
                                            </td> 

                                             <td style="display:inline-block"> 
                                                {{-- @if ($reservation->status == 'Pendiente') --}}
                                                    {{-- @if(Carbon::now()->format('Y-m-d') == ($reservation->date )) --}}
                                                        <a href="  " class="btn btn-success">A</a>
                                                    {{-- @endif --}}
                                                    {{-- @if ((Carbon::now()->addDay()->format('Y-m-d') == $reservation->date)) --}}
                                                        {{-- <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a> --}}
                                                    {{-- @endif --}}
                                                    {{-- @if ((Carbon::now()->addDay(2)->format('Y-m-d') == $reservation->date)) --}}
                                                        {{-- <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a> --}}
                                                    {{-- @endif --}}
                                                    {{-- @if(($reservation->date > Carbon::now()->addDay(2)->format('Y-m-d'))) --}}
                                                        {{-- <button type="button" href="" disabled class="btn btn-success">A</button> --}}
                                                    {{-- @endif --}}
{{--  --}}
                                            <a href="   " class="btn btn-warning">R</a>
                                            <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever= Suspender cita de: ddata-type= "Suspendida " >S</button> 
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever= Cancelar cita de:  data-type= "Cancelada " >C</button> 
                                                {{-- @endif --}}
                                            
                                                {{-- @if ($reservation->status == 'Aprobada') --}}
                                                    {{-- <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a> --}}
                                                    {{-- <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button> --}}
                                                    {{-- <a type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</a> --}}
                                                {{-- @endif --}}
{{--  --}}
                                                {{-- @if ($reservation->status == 'Cancelada') --}}
                                                    {{-- <button type="button" class="btn btn-secondary" disabled>A</button> --}}
                                                    {{-- <button type="button" class="btn btn-secondary" disabled>R</button> --}}
                                                    {{-- <button type="button" class="btn btn-secondary" disabled>S</button> --}}
                                                    {{-- <button type="button" class="btn btn-secondary" disabled>C</button> --}}
                                                {{-- @endif --}}
                                                {{-- @if ($reservation->status == 'Reprogramada') --}}
                                                    {{-- <a href="{{ route('cita.aprobada', $reservation) }}" class="btn btn-success">A</a> --}}
                                                    {{-- <button type="button" class="btn btn-repro" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button> --}}
                                                    {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button> --}}
                                                {{-- @endif --}}
                                                {{-- @if ($reservation->status == 'Suspendida') --}}
                                                    {{-- <form method="POST" action="{{ route('delete.cite', $reservation->id) }}"> --}}
                                                        {{-- <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a> --}}
                                                        {{-- <button class="btn btn-danger"><i class="fa fa-eraser"></i></button> --}}
                                                        {{-- @method('delete') --}}
                                                        {{-- @csrf --}}
                                                    {{-- </form> --}}
                                                {{-- @endif --}}
                                            </td> 
                                          
                                        </tr>
                                    @endforeach                                  
                                </tbody> 
                            </table>
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
                    <button type="submit" class="btn btn-azuloscuro">Guardar</button>
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
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>

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
