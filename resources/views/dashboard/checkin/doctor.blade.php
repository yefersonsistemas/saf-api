@extends('dashboard.layouts.app')
@section('inrol','d-block')
@section('dire','d-none')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title','Médicos del dia')

@section('content')
    <div class="section-body py-3">
        <div class="container-fluid">
            <div class=" p-4">
                <div class="tab-content mx-auto" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="col-lg-12 mt--35">
                            <div class="table-responsive mb-4">
                                <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Cédula</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th class="text-center">Especialidad</th>
                                            <th class="text-center">Horario</th>
                                            <th class="text-center">Asistencia</th>
                                            <th class="text-center">Consultorio</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Cédula</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th class="text-center">Especialidad</th>
                                            <th class="text-center">Horario</th>
                                            <th class="text-center">Asistencia</th>
                                            <th class="text-center">Consultorio</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($em as $employe)
                                        <tr style="height:40px;">
                                            <td style="height:40px">
                                                @if (!empty($employe->image->path))
                                                <img style="width:100%; height:100%" src="{{ Storage::url($employe->image->path) }}" alt="">
                                                @else
                                                <img src="" alt="" >
                                                @endif
                                            </td>
                                            <td >{{ $employe->person->dni }}</td>
                                            <td>{{ $employe->person->name }}</td>
                                            <td>{{ $employe->person->lastname }}</td>

                                            <td class="d-flex justify-content-center">     <!--Especialidad-->
                                                <a class="btn btn-info" style="color:#fff" data-toggle="modal" data-target="#{{ $employe->person->type_dni }}{{ $employe->person->dni }}"><i class="fa fa-eye"></i></a>
                                            </td>
                                            <!--Ver horario del medico-->
                                            <td class=" justify-content-center text-center">
                                                <input type="hidden" id="id" value="{{ $employe->person->id }}">
                                                <a href="" class="btn btn-info"  style="color:#fff; font-weight:bold;" data-toggle="modal" data-target="#{{ $employe->person->type_dni }}{{ $employe->person->id }}"><i class="fa fa-eye"></i></a>
                                            </td>
                                            <!--Asistencia del medico-->
                                            <td class=" justify-content-center text-center">
                                                @if($employe->assistance->first() != '')
                                                    <p>Cancelado</p>
                                                @endif

                                                @if($employe->assistance->first() == ''  && empty($employe->areaassigment) )
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="Cancelar asistencia de: {{ $employe->person->name }} {{ $employe->person->lastname }}" data-id="{{ $employe->id }}"><i class="fa fa-close"></i></button>
                                                @endif

                                                @if(!empty($employe->areaassigment))
                                                <p class="mt-2">
                                                    <i class="fe fe-check" style="font-size:25px; font-weight:bold; color: #00ad88"></i>
                                                </p>
                                                @endif

                                            </td>

                                            <!--Nombre del consultorio-->
                                            <td class="text-center">
                                            @if(!empty($employe->areaassigment))
                                            <p class="mt-2">
                                                {{ $employe->areaassigment->area->name }}
                                            </p>
                                            @endif

                                            @if(empty($employe->areaassigment))
                                            <p class="mt-2"> ---------------</p>
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


        <!-- Modal para ver especialidades -->
        @foreach ($em as $employe)
            <div class="modal fade" id="{{ $employe->person->type_dni }}{{ $employe->person->dni }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="text-align:center">
                            <h5 class="modal-title" id="exampleModalLabel">Especialidad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @foreach ($employe->speciality as $item)
                            {{ $item->name }} <br>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal para ver horario-->
        @foreach ($em as $employe)
            <div class="modal fade" id="{{ $employe->person->type_dni }}{{ $employe->person->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="text-align:center">
                        <h5 class="modal-title" id="exampleModalLabel">Horario del Doctor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-sm" style="borde-radious: 5px">
                                <thead class="table-info">
                                    <tr>
                                        <th scope="col" style="text-align:center; color:black">Dias</th>
                                        <th scope="col" style="text-align:center; color:black">Turno</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employe->schedule as $item)
                                        <tr>
                                            @if ($item->day == 'monday')
                                            <td style="text-align:center">Lunes</td>
                                            @endif
                                            @if ($item->day == 'tuesday')
                                            <td style="text-align:center">Martes</td>
                                            @endif
                                            @if ($item->day == 'wednesday')
                                            <td style="text-align:center">Miercoles</td>
                                            @endif
                                            @if ($item->day == 'thursday')
                                            <td style="text-align:center">Jueves</td>
                                            @endif
                                            @if ($item->day == 'friday')
                                            <td style="text-align:center">Viernes</td>
                                            @endif
                                            @if ($item->turn ==  'mañana')
                                            <td style="text-align:center">Mañana</td>
                                            @endif
                                            @if ($item->turn ==  'tarde')
                                            <td style="text-align:center">Tarde</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    <!--Modal de asistencia-->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Doctor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('checkin.asistencia') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="employe_id" class="employe_id">
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
@endsection

@section('scripts')
<script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets\js\table\datatable.js') }}"></script>
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>

{{-- SCRIPT PARA MENSAJE CON BOTON HACIA ATRAS DEL NAVEGADOR --}}
<script>
    var submitted = false;

     $(document).ready(function() {
       $("form").submit(function() {
         submitted = true;
       });

       window.onbeforeunload = function () {
         if (!submitted) {
           return 'Do you really want to leave the page?';
         }
       }
     });
    </script>
    {{--FIN SCRIPT PARA MENSAJE CON BOTON HACIA ATRAS DEL NAVEGADOR --}}

      <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
            var id  = button.data('id');
            console.log('recipiente', recipient)
            console.log('id',id)

            insertDates( id);
            var modal = $(this);
            modal.find('.modal-title').text(recipient);
            $('.employe_id').val(id);

        });

        function insertDates( id){
            $('#employe_id').val(id);
        }
    </script>
@endsection
