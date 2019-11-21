@extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title','Historia Medica')

@section('content')
<div class="container">
    <div class="card p-4 row d-row d-flex justify-content-between">
        <h4 class="col-12">Datos Personales</h4>
        <div class="col-md-6 col-lg-6 sm-6">
            
            <p>DNI: {{ $rs->patient->type_dni }} {{ $rs->patient->dni }}</p>
            <p>Nombre: {{ $rs->patient->name }}</p>
            <p>Apellido: {{ $rs->patient->lastname }}</p>
        </div>
        <div class="col-md-3 col-lg-3 sm-3">
            <img src="{{ Storage::url($rs->patient->image->path) }}" alt="">
        </div>
    </div>

    <div class="card p-4">
        <h4>Datos De la Cita</h4>
        <p>Fecha: {{ $rs->date }}</p>
        <p>Medico Tratante: {{ $rs->patient->history_patient }}</p>
        <p>Razón: {{ $rs->description }}</p>
    </div>
    
    <form action="" class="card p-4">
        <h4> Información Personal del Paciente</h4>
        <div class="col-lg-8">
            
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label">Lugar de Nacimiento</label>
                        <input type="text" class="form-control" disabled="" placeholder="Lugar de Nacimiento" value="{{ $rs->historyPatient->place }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-label">Fecha de Nacimiento</label>
                        <input type="text" class="form-control" placeholder="Fecha de Nacimiento" value="{{ $rs->historyPatient->birthdate }}">
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Peso</label>
                        <input type="text" class="form-control" placeholder="Peso" value="{{ $rs->historyPatient->weight }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Edad</label>
                        <input type="text" class="form-control" placeholder="Edad" value="{{ $rs->historyPatient->age }}">
                    </div>
                </div>
                <div class="form-group mt-3 ml-2">
                    <label>Radio Button</label>
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

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Direccion</label>
                        <input type="text" class="form-control" placeholder="Home Direccion" value="{{ $rs->patient->address }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Email" value="{{ $rs->patient->email }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" placeholder="Teléfono" value="{{ $rs->patient->phone }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Teléfono adicional</label>
                        <input type="text" class="form-control" placeholder="Teléfono adicional" value="{{ $rs->historyPatient->another_phone }}">
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Email adicional</label>
                        <input type="email" class="form-control" placeholder="Email" value="{{ $rs->historyPatient->another_email }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label">Profesión</label>
                        <input type="text" class="form-control" placeholder="Profesión" value="{{ $rs->historyPatient->profession }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label">Ocupación</label>
                        <input type="text" class="form-control" placeholder="Ocupación" value="{{ $rs->historyPatient->occupation }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- <div>
            <input type="text" name="birthdate" value="">
            <input type="text" name="place">
            <input type="text" name="weight">
            <input type="text" name="age">
        </div>
        <div>
            <input type="text" name="address" value="{{ $rs->patient->address }}">
            <input type="text" name="email" value="{{ $rs->patient->email }}">
        </div>
        <div>
            <div>
                <h4>Genero:</h4>
                <input type="radio" name="gender">
                <input type="radio" name="gender">
            </div>
            <div>
                <h4>Telefono:</h4> <input type="text" name="phone" value="{{ $rs->patient->phone }}">
                <h4>Telefono Adicional:</h4> <input type="text" name="another_phone">
                <h4>Email Adicional:</h4> <input type="text" name="another_email">
                <h4>Profesión:</h4> <input type="text" name="profession">
                <h4>Acupación:</h4> <input type="text" name="occupation">
            </div>
        </div>     --}}
    </form>
</div>

{{-- <div class="card  p-4">
    <div class="col-md-5">
        <div class="form-group">
            <label class="form-label">Exámenes</label>
            <input type="file" id=fileupload class="form-control" name="exams[]" multiple="">
        </div>
    </div>
</div> --}}
<div class="card  p-4">
    <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
        <div class="row fileupload-buttonbar">
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
        
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped">
            <tbody class="files"></tbody>
        </table>
    </form>
</div>

<div class="card  p-4">
    <h4>Antecedentes médicos</h4>
    <div class="row mt-2">
        <div class="col-md-8">
            <div class="form-group mb-0">
                <label class="form-label">Padencia de enfermedades</label>
                <textarea rows="5" class="form-control" placeholder="Descripción" value="Mike"></textarea>
            </div>
        </div>
        <div class="col-md-8 mt-2">
                <div class="form-group mb-0">
                    <label class="form-label">Medicamentos que toma actualmente</label>
                    <textarea rows="5" class="form-control" placeholder="Descripción" value="Mike"></textarea>
                </div>
            </div>
        <div class="col-md-8 mt-2">
                <div class="form-group mb-0">
                    <label class="form-label">Alergias</label>
                    <textarea rows="5" class="form-control" placeholder="Descripción" value="Mike"></textarea>
                </div>
            </div>
        <div class="col-md-8 mt-2">
            <div class="form-group">
                <label class="form-label">Cirugias previas</label>
                <input type="text" class="form-control" placeholder="Cirugias anteriores" value="">
            </div>
        </div>
    </div>
</div>

<div class="card  p-4 row">
    <h4>Citas anteriores</h4>
    {{-- @foreach ($cites as $cite) --}}
        <div class="card col-4">
            {{ $cites->employe->person->name }} {{ $cites->employe->person->lastname }} 
            {{-- {{ $cites->person->reservationPatient }} --}}
            {{-- {{$cites->person->reservationPatient->date}} --}}
          
        </div> 
    {{-- @endforeach --}}
</div>

<a href="" class="btn btn-primary">Guardar</a>

@endsection

<script src="node_modules/blueimp-file-upload/js/jquery.fileupload.js"></script>
<script>
    $('#fileupload').fileupload();
</script>
{{-- <script src="js/jquery.fileupload.js" type="text/javascript"></script> --}}