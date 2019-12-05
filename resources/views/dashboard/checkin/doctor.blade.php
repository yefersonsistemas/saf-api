@extends('dashboard.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title','Medicos del dia')

@section('content')
<div class="col-md-12 mt-3">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item col-md-2">
            <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center active btn btn-outline-primary m-auto" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Del dia</a>
        </li>
        <li class="nav-item col-md-2">
            <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-success" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Todos</a>
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
                                    <th>Esepcialidad</th>
                                    <th>Horario</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                    <th>Foto</th>
                                    <th>Cedula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Esepcialidad</th>
                                    <th>Horario</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                @foreach($em as $employe)
                                <tr>
                                    <td>
                                        @if (!empty($employe->image->path))
                                        <img src="{{ Storage::url($employe->image->path) }}" alt="">
                                        @else
                                        <img src="" alt="" >
                                        @endif
                                    </td>
                                    <td>{{ $employe->person->dni }}</td>
                                    <td>{{ $employe->person->name }}</td>
                                    <td>{{ $employe->person->lastname }}</td>
                                    <td>
                                    @foreach ($employe->speciality as $item)
                                        {{ $item->name }} <br>
                                    @endforeach
                                    </td>
                                    <td>
                                    <input type="hidden" id="id" value="{{ $employe->person->id }}">
                                    <a class="btn btn-info"  data-toggle="modal" data-target="#{{ $employe->person->name }}{{ $employe->person->id }}">ver</a>
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
                                <th>Esepcialidad</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto</th>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Esepcialidad</th>
                            </tr>
                        </tfoot>
                        <tbody>
                                @foreach ($e as $employe)
                                <tr>
                                    <td>
                                        @if (!empty($employe->image->path))
                                        <img src="{{ Storage::url($employe->image->path) }}" alt="">
                                        @else
                                        <img src="" alt="" >
                                        @endif
                                    </td>
                                    <td>{{ $employe->person->dni }}</td>
                                    <td>{{ $employe->person->name }}</td>
                                    <td>{{ $employe->person->lastname }}</td>
                                    <td>
                                    @foreach ($employe->speciality as $item)
                                        {{ $item->name }} <br>
                                    @endforeach
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>

      <!-- Modal -->
    @foreach ($em as $employe)

      <div class="modal fade" id="{{ $employe->person->name }}{{ $employe->person->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" style="text-align:center">
              <h5 class="modal-title" id="exampleModalLabel">Horario del Doctor</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    
                    <table class="table table-bordered table-sm">
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
@endsection