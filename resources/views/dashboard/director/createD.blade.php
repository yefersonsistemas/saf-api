@extends('dashboard.layouts.app')

@section('cites','active')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">

@endsection

@section('title','Registro de Medicos')

@section('content')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('doctores.store')}}" method='POST' enctype="multipart/form-data" class="row d-flex justify-content-center">
            @csrf
                <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                    <div class="card p-4">

                        <div class="row d-flex justify-content-between create-employee">
                            <div class="form-group col-lg-3 col-md-3">
                                <label class="form-label">Foto</label>
                                <div class="mb-2">
                                    <input id="image" type="file" class="dropify" name="image" data-default-file="">
                                </div>
                            </div>

                            <div class="col-lg-9 col-md-7 d-flex justify-content-between">
                               <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label class="form-label">Documento de Identidad</label>
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <select name="type_dni" class="custom-select input-group-text form-control" value=" {{ old('type_dni') }}" required>
                                                    <option value="0">...</option>
                                                    <option value="N">N</option>
                                                    <option value="E">E</option>
                                                </select>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Documento de Identidad" value=" {{ old('dni') }}" required name="dni">
                                        </div>
                                    </div>
                                        
                                        <div class="col-lg-4 ">
                                            <div class="form-group">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                        
                                        <div class="col-lg-4">
                                            <div class="form-group"> 
                                                <label class="form-label">Apellido</label>
                                                <input type="text" class="form-control" placeholder="Apellido" name="lastname" value="{{ old('lastname') }}" required>
                                            </div>
                                        </div>
        
                                        <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label">Direccion</label>
                                                    <input type="text" name="address" id="address" class="form-control" placeholder="Direccion" value="{{ old('address') }}" required>
                                                </div>
                                            </div>
                    
                                            
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label"> Teléfono </label>
                                                    <input type="text" class="form-control" placeholder="Telefono" name="phone" value="{{ old('phone') }}" required>
                                                </div>
                                            </div>
                                            
                                        
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"> Correo Electronico </label>
                                                <input type="email" placeholder="name@example.com" class="form-control" name="email" value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-between">

                                <div class="col-lg-6" id="framework_form">
                                    <label class="form-label">Especialidad</label>
                                    <div class="form-group multiselect_div">
                                        <select id="speciality" name="speciality[]" class="multiselect multiselect-custom form-control" multiple="multiple">
                                            @foreach ($speciality as $speciality)
                                                <option value= {{ $speciality->id }}>{{ $speciality->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6" id="framework_form">
                                    <label class="form-label">Procedimientos</label>
                                    <div class="form-group multiselect_div">
                                        <select id="procedure" name="procedure[]" class="multiselect multiselect-custom form-control" multiple="multiple">
                                            @foreach ($procedure as $procedure)
                                                <option value= {{ $procedure->id }}>{{ $procedure->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-between">
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                    <label class="form-label">Cargo </label>
                                        <input type="hidden"  name="position_id" value="{{$position->id}}">
                                        <input type="text" class="form-control" name="position_id" value="{{$position->name = 'doctor'}}" disabled>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Clase</label>
                                        <select name="type_doctor_id" class="custom-select input-group-text bg-white form-control">
                                            <option value="0">Ninguna selección</option>
                                            @foreach ($clases as $clase)
                                            <option value={{$clase->id}}>{{$clase->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group"> 
                                        <label class="form-label">Precio de Consulta</label>
                                        <input type="text"  class="form-control" placeholder="Precio" name="price" value="{{ old('price') }}" required>
                                    </div>
                                </div> 
                            </div> 

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

        
                    <div class="btn-group-toggle mb-2 mt-3 d-flex justify-content-end" style="text-align:center">
                        <a class="btn btn mr-2 pr-4 pl-4 text-white" style="background:#00506b" data-toggle="modal" data-target="#staticBackdrop">Crear usuario</a>
                        <button type="submit" class="btn mr-2 pr-4 pl-4 text-white bg-verdePastel" >Enviar</button>
                        <button type="reset" style="background:#a1a1a1" class="btn mr-2 pr-4 pl-4 text-white">Limpiar</button>
                    </div>
                </div>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Crear Contraseña</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                    <div class="col-12" >
                                        <label class="form-label" style="text-align:left"> Contraseña </label>
                                        <input type="password" placeholder="password" class="form-control" name="password" value="{{ old('password') }}" >
                                    </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                            </div>
                        </div>
                        </div>
                    </div>
        </form>
    </div>
</div>
@endsection

{{-- style="color:#00ad88" turquesa --}}

@section('scripts')
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>

<script>
    $('#speciality').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
</script>

<script>
    // select de las especialidades
    $("#speciality").change(function(){
        var especialidad_id = $(this).val();     // Capta el id de la especialidad
        console.log('especialidad', especialidad_id); 
    });
</script>

<script>
    $('#procedure').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
</script>

<script>
    // select de las especialidades
    $("#procedure").change(function(){
        var procedure_id = $(this).val();     // Capta el id de procedimiento
        console.log('procedure', procedure_id); 
    });
</script>
@endsection


    