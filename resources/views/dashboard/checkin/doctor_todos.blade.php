@extends('dashboard.layouts.app')
@section('medicoss','active')
@section('medicos','active')
@section('inrol','d-block')
@section('dire','d-none')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title','Todos los Médicos')

@section('content')
    <div class="section-body py-3">
        <div class="container-fluid p-0 m-0">
            <div class=" p-4">
                <div class="col-lg-12 mt--15">
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
                                    <th>Consultorio</th>
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
                                    <th class="text-center">Consultorio</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($e as $employe)
                                <tr style="height:40px;" >
                                    <td style="height:40px;">
                                        @if (!empty($employe->image->path))
                                        <img style="width:100%; height:100%" src="{{ Storage::url($employe->image->path) }}" alt="">
                                        @else
                                        <img src="" alt="" >
                                        @endif
                                    </td>
                                    <td>{{ $employe->person->dni }}</td>
                                    <td>{{ $employe->person->name }}</td>
                                    <td>{{ $employe->person->lastname }}</td>
                                    <td class="d-flex justify-content-center">     <!--Especialidad-->
                                        <a class="btn btn-verdePastel" style="color:#fff" data-toggle="modal" data-target="#{{ $employe->person->type_dni }}{{ $employe->person->dni }}"><i class="fa fa-stethoscope "></i></a>

                                                                                                                                                                                    {{-- fa-stethoscope fa-user-md  fa-address-card --}}
                                    </td>
                                    <td class="justify-content-center text-center">   <!--Ver horario del medico-->
                                        <input type="hidden" id="id" value="{{ $employe->person->id }}">
                                        <a class="btn btn-info"  style="color:#fff" data-toggle="modal" data-target="#{{ $employe->person->type_dni }}{{ $employe->person->id }}"><i class="fe fe-clock"></i></a>
                                    </td>
                                    @if ($employe->areaassigment != null)
                                        <td>{{$employe->areaassigment->area->name}}</td>
                                    @else
                                        <td>Sin Consultorio</td>    
                                    @endif
                                </tr>                                  
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>

    <!-- Modal para ver especialidades -->
    @foreach ($e as $employe) 
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

    <!--Modal para ver horario-->
    @foreach ($e as $employe) 
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
                            <tr>
                            @foreach ($employe->schedule as $item)
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