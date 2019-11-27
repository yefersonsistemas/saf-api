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
<form action="{{ route('save.history') }}" method='POST' class="card p-4">
@csrf
    <div class="card p-4">
        <div style="margin-bottom:12px">
            <a class="btn btn-primary" id="EditPatient" href="#">Editar datos <i class="fa fa-vcard"></i></a>
        </div>
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
                                    <select name="type_dni" disabled class="custom-select input-group-text form-control">
                                        <option value="{{ $rs->patient->type_dni }}">
                                            {{ $rs->patient->type_dni }}</option>
                                    </select>
                                </div>
                                <input type="hidden" value=" {{ $rs->patient->dni }}" name="dni">
                                <input type="text" disabled class="form-control" placeholder="Documento de Identidad" id="dni" value=" {{ $rs->patient->dni }}" name="dni">
                            </div>
                        </div>
                    
                        <div class="col-4">
                            <label class="m-0 form-label">Nombre:</label>
                            <input type="text" disabled class="form-control" placeholder="Lugar de Nacimiento" value="{{ $rs->patient->name }}">
                        </div>

                        <div class="col-4">
                            <label class="m-0 form-label">Apellido:</label>
                            <input type="text" disabled class="form-control" placeholder="Lugar de Nacimiento" value="{{ $rs->patient->lastname }}">
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
                        <input type="text" disabled class="form-control" placeholder="Fecha de reservación" value="{{ $rs->date }}">
                    </div>

                    <div class="col-4">
                        <label class="m-0 form-label">Médico tratante:</label>
                        <input type="text" disabled class="form-control" placeholder="Nombre del  doctor" value="{{ $rs->person->name }} {{ $rs->person->lastname }}">
                    </div>

                    <div class="col-4">
                        <label class="m-0 form-label">Razón:</label>
                        <input type="text" disabled class="form-control" placeholder="Motivo de la reservación" value="{{ $rs->description }}">
                    </div>
                </div>
            </div>
        </div>
    
        {{-- <form action="{{ route('save.history') }}" method='POST' class="card p-4">
            @csrf --}}
            {{-- @method('PUT') --}}
            <div class="card p-4">
                <h5 class="text-center">Información personal</h5>
                <div class="row">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Fecha de Nacimiento</label>
                                    <input type="text" disabled class="form-control" placeholder="Fecha de Nacimiento" value="{{ $rs->historyPatient->birthdate }}">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Lugar de Nacimiento</label>
                                    <input type="text" disabled class="form-control" placeholder="Lugar de Nacimiento" value="{{ $rs->historyPatient->place }}">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label class="form-label">Edad</label>
                                    <input type="text" disabled id="age" name="age" class="form-control" placeholder="Edad" value="{{ $rs->historyPatient->age }}">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label class="form-label">Peso</label>
                                    <input type="text" disabled id="weight" name="weight" class="form-control" placeholder="Peso" value="{{ $rs->historyPatient->weight }}">
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-label">Direccion</label>
                                    <input type="text" disabled name="address" id="address" class="form-control" placeholder="Direccion" value="{{ $rs->patient->address }}">
                                </div>
                            </div>
                            
                            <div class="form-group ml-4 col-2">
                                <label>Género</label>
                                <br>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" disabled class="custom-control-input" name="gender" value="Masculino" {{ ($rs->historyPatient->gender == 'Masculino') ? 'checked' : '' }} required>
                                    <span class="custom-control-label">M</span>
                                </label>

                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" disabled class="custom-control-input" name="gender" value="Femenino" {{ ($rs->historyPatient->gender == 'Femenino') ? 'checked' : '' }} required>
                                    <span class="custom-control-label">F</span>
                                </label>
                                <p id="error-radio"></p>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" disabled id="email" name="email" class="form-control" placeholder="Email" value="{{ $rs->patient->email }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" disabled id="phone" name="phone" class="form-control" placeholder="Teléfono" value="{{ $rs->patient->phone }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Teléfono adicional</label>
                                    <input type="text" disabled id="another_phone" name="another_phone" class="form-control" placeholder="Teléfono adicional" value="{{ $rs->historyPatient->another_phone }}">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Email adicional</label>
                                    <input type="email" disabled id="another_email" name="another_email" class="form-control" placeholder="Email" value="{{ $rs->historyPatient->another_email }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Profesión</label>
                                    <input type="text" disabled id="profession" name="profession" class="form-control" placeholder="Profesión" value="{{ $rs->historyPatient->profession }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Ocupación</label>
                                    <input type="text" disabled id="occupation" name="occupation" class="form-control" placeholder="Ocupación" value="{{ $rs->historyPatient->occupation }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="card p-4">
            <label class="form-label">Exámenes</label>
            <div class="form-control">
                    {{-- <form id="fileupload" action="" method="POST" enctype="multipart/form-data"> --}}
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
                    {{-- </form> --}}
                </div>
            </div>

            <div class="card p-4 d-flex justify-content-between">
                <div class="row">
                    <div class="col-lg-6 col-md-3" id="framework_form">
                        <label class="form-label">Enfermedades</label>
                        <div class="form-group multiselect_div">
                            <select id="disease" name="disease[]" class="multiselect multiselect-custom" multiple="multiple">
                                @foreach ($disease as $enfermedades)
                                    <option value= {{ $enfermedades->id }}>{{ $enfermedades->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3" id="framework_form2">
                        <label class="form-label">Medicamentos</label>
                        <div class="form-group multiselect_div">
                            <select id="medicine" name="medicine[]" class="multiselect multiselect-custom " multiple="multiple" >
                                @foreach ($medicine as $medicamentos)
                                    <option value= {{ $medicamentos->id }}>{{ $medicamentos->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="col-lg-6 col-md-3" id="framework_form3">
                        <label class="form-label">Alergias</label>
                        <div class="form-group multiselect_div">
                            <select id="allergy" name="allergy[]" class="multiselect multiselect-custom" multiple="multiple" >
                                @foreach ($allergy as $alergias)
                                    <option value= {{ $alergias->id }}>{{ $alergias->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                            <div class="form-group col-12">
                                <label class="form-label">Cirugias previas</label>
                                <input  type="text" disabled id="previous_surgery" class="form-control" placeholder="Cirugias anteriores" value="{{ $rs->patient->historyPatient->previous_surgery  }}" name="previous_surgery" disabled>
                                {{-- <textarea class="form-control" disabled id="previous_surgery" name="cirugia" cols="63" rows="5">{{ $rs->patient->historyPatient->previous_surgery  }}</textarea> --}}
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

        <div>
            <button type="submit" class="btn btn-primary "> Guardar</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>

    <script>
    $('#disease').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
    </script>

    <script>
    $('#medicine').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
    </script>

    <script>
    $('#allergy').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
    </script>

    <script>
    $('#EditPatient').click(function() {
            $('#age').removeAttr('disabled');
            $('#weight').removeAttr('disabled');
            $('#address').removeAttr('disabled');
            $('#phone').removeAttr('disabled');
            $('#profession').removeAttr('disabled');
            $('#occupation').removeAttr('disabled');
            $('#another_phone').removeAttr('disabled');
            $('#another_email').removeAttr('disabled');
            $('#previous_surgery').removeAttr('disabled');
           
    });
    </script>

    <script>
        // para el select de las enfermedades
        $("#disease").change(function(){
            var disease_id = $(this).val();     // Capta el id de la enfermedad 
            console.log('enfermedad', disease_id); 
            console.log(disease_id.length); // el length en este caso permite agarrar el ultimo valor del arreglo
            });
    </script>

    <script>
            // para el select de las alergias
            $("allergy").change(function(){
            var allergy_id = $(this).val();     // Capta el id de la alergia 
            console.log('alergia', allergy_id);
            console.log(allergy_id.length); // el length en este caso permite agarrar el ultimo valor del arreglo
            });
    </script>

    <script>
                // para el select de las medicamentos
        $("#medicine").change(function(){
            var medicine_id = $(this).val(); // Capta el id del medicamento 
            console.log('medicamento', medicine_id);
            console.log(medicine_id.length); // el length en este caso permite agarrar el ultimo valor del arreglo
            });
    </script>

@endsection

{{--   <script src="node_modules/blueimp-file-upload/js/jquery.fileupload.js"></script>
 <script>
     $('#fileupload').fileupload();
 </script>
 <script src="js/jquery.fileupload.js" type="text/javascript"></script>  --}}
