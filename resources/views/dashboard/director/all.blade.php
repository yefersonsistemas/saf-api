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

@section('title','Todas los registros')

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
 
            {{-- Tabs de registros --}}
            <div class="col-md-12 mt-3">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center active btn btn-outline-primary m-auto" id="pills-position-tab" data-toggle="pill" href="#pills-position" role="tab" aria-controls="pills-position" aria-selected="true">Cargos</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-success" id="pills-service-tab" data-toggle="pill" href="#pills-service" role="tab" aria-controls="pills-service" aria-selected="false">Servicios</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-danger" id="pills-speciality-tab" data-toggle="pill" href="#pills-speciality" role="tab" aria-controls="pills-speciality" aria-selected="false">Especialidades</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-warning" id="pills-procedure-tab" data-toggle="pill" href="#pills-procedure" role="tab" aria-controls="pills-procedure" aria-selected="false">Procedimientos</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-secondary" id="pills-surgery-tab" data-toggle="pill" href="#pills-surgery" role="tab" aria-controls="pills-surgery" aria-selected="false">Cirugias</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center active btn btn-outline-primary m-auto" id="pills-allergy-tab" data-toggle="pill" href="#pills-allergy" role="tab" aria-controls="pills-allergy" aria-selected="true">Alergias</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-success" id="pills-disease-tab" data-toggle="pill" href="#pills-disease" role="tab" aria-controls="pills-disease" aria-selected="false">Enfermedades</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-danger" id="pills-medicine-tab" data-toggle="pill" href="#pills-medicine" role="tab" aria-controls="pills-medicine" aria-selected="false">Medicinas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-warning" id="pills-exam-tab" data-toggle="pill" href="#pills-exam" role="tab" aria-controls="pills-exam" aria-selected="false">Examenes</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-secondary" id="pills-type-tab" data-toggle="pill" href="#pills-type" role="tab" aria-controls="pills-type" aria-selected="false">Areas</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-warning" id="pills-area-tab" data-toggle="pill" href="#pills-area" role="tab" aria-controls="pills-area" aria-selected="false">Consultorios</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-position" role="tabpanel" aria-labelledby="pills-position-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acción</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($cargos as $cargo)
                                        <tr>
                                            <td>{{ $cargo->name }}</td>
                                            <td style="display: inline-block">
                                                <a href="{{ route('position.edit', $cargo->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-warning"><i class="fas fa-minus-circle"></i></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
                <div class="tab-pane fade" id="pills-service" role="tabpanel" aria-labelledby="pills-service-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acción</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $service->name }}</td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-warning"><i class="fas fa-minus-circle"></i></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
                <div class="tab-pane fade" id="pills-speciality" role="tabpanel" aria-labelledby="pills-speciality-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Servicio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Servicio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($specialitys as $speciality)
                                        <tr>
                                            <td>{{ $speciality->name }}</td>
                                            <td>{{ $speciality->description }}</td>
                                            <td>{{ $speciality->service->name }}</td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-warning"><i class="fas fa-minus-circle"></i></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>   
                <div class="tab-pane fade" id="pills-procedure" role="tabpanel" aria-labelledby="pills-procedure-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Especialidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Especialidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($procedures as $procedure)
                                        <tr>
                                            <td>{{ $procedure->name }}</td>
                                            <td>{{ $procedure->description }}</td>
                                            <td>{{ $procedure->price }}</td>
                                            <td>{{ $procedure->speciality->name }}</td>
                                            <td><span class="badge badge-warning">{{ $reservation->status }}</span></td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-warning"><i class="fas fa-minus-circle"></i></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>  
                <div class="tab-pane fade" id="pills-surgery" role="tabpanel" aria-labelledby="pills-surgery-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Duración</th>
                                        <th>Precio</th>
                                        <th>Descripción</th>
                                        <th>Clase de cirugía</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Duración</th>
                                        <th>Precio</th>
                                        <th>Descripción</th>
                                        <th>Clase de cirugía</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($types as $type)
                                        <tr>
                                            <td>{{ $type->name }}</td>
                                            <td>{{ $type->duration }}</td>
                                            <td>{{ $type->cost }}</td>
                                            <td>{{ $type->description }}</td>
                                            <td>{{ $type->classiffication->name }}</td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-warning"><i class="fas fa-minus-circle"></i></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
                <div class="tab-pane fade show active" id="pills-allergy" role="tabpanel" aria-labelledby="pills-allergy-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acción</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($allergys as $allergy)
                                        <tr>
                                            <td>{{ $allergy->name }}</td>
                                            <td style="display: inline-block">
                                                <a href="{{ route('position.edit', $cargo->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-warning"><i class="fas fa-minus-circle"></i></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
                <div class="tab-pane fade" id="pills-disease" role="tabpanel" aria-labelledby="pills-disease-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acción</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($diseases as $disease)
                                        <tr>
                                            <td>{{ $disease->name }}</td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-warning"><i class="fas fa-minus-circle"></i></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
                <div class="tab-pane fade" id="pills-medicine" role="tabpanel" aria-labelledby="pills-medicine-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($medicines as $medicine)
                                        <tr>
                                            <td>{{ $medicine->name }}</td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-warning"><i class="fas fa-minus-circle"></i></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>   
                <div class="tab-pane fade" id="pills-exam" role="tabpanel" aria-labelledby="pills-exam-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td>{{ $exam->name }}</td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-warning"><i class="fas fa-minus-circle"></i></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>  
                <div class="tab-pane fade" id="pills-surgery" role="tabpanel" aria-labelledby="pills-surgery-tab">
                    <div class="col-lg-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Duración</th>
                                        <th>Precio</th>
                                        <th>Descripción</th>
                                        <th>Clase de cirugía</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Duración</th>
                                        <th>Precio</th>
                                        <th>Descripción</th>
                                        <th>Clase de cirugía</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($types as $type)
                                        <tr>
                                            <td>{{ $type->name }}</td>
                                            <td>{{ $type->duration }}</td>
                                            <td>{{ $type->cost }}</td>
                                            <td>{{ $type->description }}</td>
                                            <td>{{ $type->classiffication->name }}</td>
                                            <td style="display: inline-block">
                                                <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-warning"><i class="fas fa-minus-circle"></i></i></a>
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

    <script> //script del cambio de estado
        function entradas(value, value2) {
            var state = value; //el estado del objeto
            var stateInt = parseInt(state); //se convierte el valor anterior en integer para posteriores validaciones
            var id= value2; // el ID del contenedor en el que se encuentra el boton
            console.log('click '+state+', '+id); //Se valida que se está alcanzando al objeto que se está haciendo click

            //Se valida primero si se está haciendo click en el primer estado
            if(stateInt<=0){
                $('#'+id+' .state_'+state).addClass('btn-success');
                $('#'+id+' .state_'+state).removeClass('btn-danger');
                $('#'+id+' .state_'+state).prop("disabled", true);
                console.log('Se ha cumplido el estado '+ state+', '+id);
            }else{
                //A partir de estado 1, se valida si el estado anterior se cumplió, para esto se toma la clase btn-danger, si no se ha cumplido, se bloquea la función y se puede mandar una alerta.
                if($('#'+id+' .state_'+[stateInt-1]).hasClass('btn-danger')){
                    console.log('click '+state+', '+id+': No puedes ejecutar esta accion hasta que el paso anterior se halla cumplido');
                //Por el contrario, si el estado anterior se ha cumplido, se procede a ejecutar la función
                }else if($('#'+id+' .state_'+[stateInt-1]).hasClass('btn-success')){
                    $('#'+id+' .state_'+state).addClass('btn-success');
                    $('#'+id+' .state_'+state).removeClass('btn-danger');
                    $('#'+id+' .state_'+state).prop("disabled", true);
                    console.log('Se ha cumplido el estado '+ state+', '+id);
                }
            }
        };
    </script>
@endsection