@extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
@endsection

@section('title','Historia Medica')

@section('content')
<div class="container">
    <div class="card p-4">
        <div class="card p-4">
            <h5 class="text-center">Datos Personales</h5>
            <div class="row">
                <div class="col-3 ml-4 mb-4">
                    <img src="{{ Storage::url($rs->patient->image->path) }}" alt="" class="img-thumbnail" style=" width:140px">
                </div>

                <div class="col-8 mt-4">
                    <div class="row mt-4">
                        <div class="form-group col-4">
                            <label class="m-0 form-label">DNI:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select name="type_dni" class="custom-select input-group-text form-control">
                                        <option value="{{ $rs->patient->type_dni }}">
                                            {{ $rs->patient->type_dni }}</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control" placeholder="Documento de Identidad" name="dni" value=" {{ $rs->patient->dni }}" name="dniP">
                            </div>
                        </div>
                    
                        <div class="col-4">
                            <label class="m-0 form-label">Nombre:</label>
                            <input type="text" class="form-control" placeholder="Lugar de Nacimiento" value="{{ $rs->patient->name }}">
                        </div>

                        <div class="col-4">
                            <label class="m-0 form-label">Apellido:</label>
                            <input type="text" class="form-control" placeholder="Lugar de Nacimiento" value="{{ $rs->patient->lastname }}">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

        <div class="card p-4">
            <div class="card p-4">
                <h5 class="text-center">Datos de la cita</h5>

                <div class="row mt-4 mb-2">
                    <div class="col-4">
                        <label class="m-0 form-label">Fecha:</label>
                        <input type="text" class="form-control" placeholder="Fecha de reservación" value="{{ $rs->date }}">
                    </div>

                    <div class="col-4">
                        <label class="m-0 form-label">Médico tratante:</label>
                        <input type="text" class="form-control" placeholder="Nombre del  doctor" value="{{ $rs->person->name }} {{ $rs->person->lastname }}">
                    </div>

                    <div class="col-4">
                        <label class="m-0 form-label">Razón:</label>
                        <input type="text" class="form-control" placeholder="Motivo de la reservación" value="{{ $rs->description }}">
                    </div>
                </div>
            </div>
        </div>
    
        <form action="{{ route('save.history') }}" method='POST' class="card p-4">
            @csrf
            <div class="card p-4">
                <h5 class="text-center">Información personal</h5>
                <div class="row">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Fecha de Nacimiento</label>
                                    <input type="text" class="form-control" placeholder="Fecha de Nacimiento" value="{{ $rs->historyPatient->birthdate }}">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Lugar de Nacimiento</label>
                                    <input type="text" class="form-control" placeholder="Lugar de Nacimiento" value="{{ $rs->historyPatient->place }}">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label class="form-label">Edad</label>
                                    <input type="text" class="form-control" placeholder="Edad" value="{{ $rs->historyPatient->age }}">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label class="form-label">Peso</label>
                                    <input type="text" class="form-control" placeholder="Peso" value="{{ $rs->historyPatient->weight }}">
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-label">Direccion</label>
                                    <input type="text" name="address" class="form-control" placeholder="Direccion" value="{{ $rs->patient->address }}">
                                </div>
                            </div>
                            
                            <div class="form-group ml-4 col-2">
                                <label>Género</label>
                                <br>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="gender" value="Masculino" {{ ($rs->historyPatient->gender == 'Masculino') ? 'checked' : '' }} required>
                                    <span class="custom-control-label">M</span>
                                </label>

                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="gender" value="Femenino" {{ ($rs->historyPatient->gender == 'Femenino') ? 'checked' : '' }} required>
                                    <span class="custom-control-label">F</span>
                                </label>
                                <p id="error-radio"></p>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email"  name="email" class="form-control" placeholder="Email" value="{{ $rs->patient->email }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text"  name="phone" class="form-control" placeholder="Teléfono" value="{{ $rs->patient->phone }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Teléfono adicional</label>
                                    <input type="text"  name="another_phone" class="form-control" placeholder="Teléfono adicional" value="{{ $rs->historyPatient->another_phone }}">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Email adicional</label>
                                    <input type="email"  name="another_email" class="form-control" placeholder="Email" value="{{ $rs->historyPatient->another_email }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Profesión</label>
                                    <input type="text"  name="profession" class="form-control" placeholder="Profesión" value="{{ $rs->historyPatient->profession }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Ocupación</label>
                                    <input type="text"  name="occupation" class="form-control" placeholder="Ocupación" value="{{ $rs->historyPatient->occupation }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="card p-4">
            <label class="form-label">Exámenes</label>
            <div class="form-control">
                    <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
                        <div class="row fileupload-buttonbar mt-4 ml-2">
                            <div>
                                <span class="btn btn-success fileinput-button">
                                <input type="file" name="files[]" multiple="">
                            </div>

                            <div class="ml-2">
                                <button type="submit" class="btn btn-primary start">
                                    <i class="glyphicon glyphicon-upload"></i>
                                    <span>Subir</span>
                                </button>
                            </div>

                            <div class="ml-2">
                                <button type="reset" class="btn btn-warning cancel">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span>Cancelar</span>
                                </button>
                            </div>

                            <div class="ml-2">
                                <button type="button" class="btn btn-danger delete">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Eliminar</span>
                                </button>
                            </div>
                    
                            <div class="ml-2 mt-2">
                                <input type="checkbox" class="toggle">
                            </div>

                            <div class="col-lg-5 fileupload-progress fade">
                                <!-- The global progress bar -->
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                                <!-- The extended global progress state -->
                                <div class="progress-extended">&nbsp;</div>
                            </div>
                        </div>
                    
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped">
                            <tbody class="files"></tbody>
                        </table>
                    </form>
                </div>
            </div>

            <div class="card p-4 d-flex justify-content-between">
                <div class="row">
                    <div class="col-lg-6 col-md-3" id="framework_form">
                        <label class="form-label">Enfermedades</label>
                        <div class="form-group multiselect_div">
                            <select id="multiselect4-filter" name="disease[]" class="multiselect multiselect-custom" multiple="multiple">
                                @foreach ($disease as $item)
                                    <option value= {{ $item->name }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3" id="framework_form2">
                        <label class="form-label">Medicamentos</label>
                        <div class="form-group multiselect_div">
                            <select id="multiselect4-filter2" name="multiselect2[]" class="multiselect multiselect-custom " multiple="multiple" >
                                @foreach ($medicine as $item)
                                    <option value= {{ $item->name }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="col-lg-6 col-md-3" id="framework_form3">
                        <label class="form-label">Alergias</label>
                        <div class="form-group multiselect_div">
                            <select id="multiselect4-filter3" name="multiselect3[]" class="multiselect multiselect-custom" multiple="multiple" >
                                @foreach ($allergy as $item)
                                    <option value= {{ $item->name }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-md-3">
                        <div class="row">
                            <div class="form-group col-10">
                                <label class="form-label">Cirugias previas</label>
                                <input id="previous_surgery" type="text" class="form-control" placeholder="Cirugias anteriores" value="{{ $rs->patient->historyPatient->previous_surgery  }}" name="previous_surgery" disabled>
                            </div>
                            <div class="col-2">
                            <div class="mt-4">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Agregar</button>
                            </div>
                            </div>
                        </div>
                    
                        <!----------------modal para agregar cirugias------------------>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Agregar Cirugias</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="">
                                        @csrf
                                        <div class="modal-body">
                                            <textarea id="cirugia" name="cirugia" cols="63" rows="5"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                            <button type="button" id="guardar" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        <div class="card p-4 row d-flex d-row justify-content-between">
            <div class="card p-4">
                 <h5 class="text-center">Citas anteriores</h5>
                @foreach ($cites as $reservation)
                    <div class="card col-4 text-justify p-4 form-control mt-2">
                        <div>
                            <label class="m-0 form-label">Doctor:</label>
                            <input type="text" class="form-control border-0 bg-white" placeholder="Lugar de Nacimiento" value=" {{ $reservation->employe->person->name }} {{ $reservation->employe->person->lastname }}">
                        </div>

                        <div>
                            <label class="m-0 form-label">Especialidad:</label>
                            <input type="text" class="form-control border-0 bg-white" placeholder="Lugar de Nacimiento" value=" {{ $reservation->speciality->name }}">
                        </div>

                        <div>
                            <label class="m-0 form-label">Fecha de la reservacion:</label>
                            <input type="text" class="form-control border-0 bg-white" placeholder="Lugar de Nacimiento" value=" {{ $reservation->date }}">
                        </div>

                         <div>
                            <label class="m-0 form-label">Razon de la cita:</label>
                            <input type="text" class="form-control border-0 bg-white" placeholder="Lugar de Nacimiento" value=" {{ $reservation->description }}">
                        </div>
                    </div> 
                @endforeach
            </div>
        </div>

            {{-- <a href="" class="btn btn-primary">Guardar</a> --}}
        <button type="submit" class="btn btn-primary "> Guardar</button>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>

    <script>
    $('#multiselect4-filter').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
    </script>

    <script>
    $('#multiselect4-filter2').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
    </script>

    <script>
    $('#multiselect4-filter3').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
    </script>

    {{-- <script>

    $('#exampleModal').on('show.bs.modal', function (event) {
          

         

        });

    </script> --}}



@endsection

{{-- <script src="node_modules/blueimp-file-upload/js/jquery.fileupload.js"></script>
<script>
    $('#fileupload').fileupload();
</script> --}}
{{-- <script src="js/jquery.fileupload.js" type="text/javascript"></script> --}}
