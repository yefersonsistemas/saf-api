@extends('dashboard.layouts.app')

@section('cites','active')
@section('day','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title','Citas para hoy:25 | Atendidos Hoy:5')

@section('content')

<style>
    .dataTables_filter label{
        color: #434a54;
    }
    .dataTables_filter label input:focus{
        border: 2px solid #00506b;
    }
</style>

<style type="text/css">
    .state{
        width: auto; 
        height: auto; 
        border-radius: 5px;}
</style>

<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix ">

            <div class="col-lg-12">
                <div class="table-responsive mb-4">
                    <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Doctor</th>
                                <th>Esepcialidad</th>
                                <th>Acciones</th>
                                <th class="text-center">E/S</th>
                                {{-- <th class="text-center">EC/SC</th> --}}
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto</th>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Doctor</th>
                                <th>Esepcialidad</th>
                                <th>Acciones</th>
                                <th class="text-center">E/S</th>
                                {{-- <th class="text-center">EC/SC</th> --}}
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($day as $reservation)
                                <tr>
                                    <td style="text-align: center; font-size:10px;">
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
                                    <td>{{ $reservation->person->name }} {{ $reservation->person->lastname }}</td>
                                    <td>{{ $reservation->speciality->name }}</td>
                                    
                                    <td style="display: inline-block">
                                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning">R</a>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="Suspender cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Suspendida">S</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar cita de: {{ $reservation->patient->name }} {{ $reservation->patient->lastname }}" data-id="{{ $reservation->id }}" data-type="Cancelada">C</button>
                                    </td>
                                    <td>
                                        <div class="container text-center" id="ID_element_0">
                                            <a class="btn btn-danger state state_0" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')"></a>
                                            <a class="btn btn-danger state state_1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')"></a>
                                            <button class="btn btn-danger state state_2" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            <button class="btn btn-danger state state_3" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                        </div>
                                    <td>  
                                        {{-- <!--Si no a llegado a las instalaciones-->
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
                                                <button href="{{ route ('checkin.insideOffice', $reservation) }}" class="btn btn-outside primero" disabled>E</button>
                                            </div>
                                        @endif    --}}
                                    </td>

                                    {{-- <td>  
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
                                                <button disabled href="{{ route ('checkin.insideOffice', $reservation) }}" class="btn btn-outside primero">E</button>
                                            </div>
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

	<script>
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
			/*
			Resumen de la funcion
			- La funcion obtiene el estado y el id del contenedor de dicho estado
			- La funcion valida que se cumpla un paso a la vez sin que se pueda saltar un paso
			- La funcion remueve la class btn-danger y agrega la funcion btn-success para cambiar el color del objeto
			- La funcion desabilita la funcion cumplida para que no pueda volver a ser ejecutada.
			*/
		};
	</script>
@endsection