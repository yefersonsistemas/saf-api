@extends('dashboard.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">

@endsection

@section('title','Registro de Medicos')

@section('content')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('doctores.update', $employe->id)}}" method='POST' enctype="multipart/form-data" class="row d-flex justify-content-center">
            @method('PUT')
            @csrf
                <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                    <div class="card p-4">

                        <div class="row d-flex justify-content-between">
                            <div class="form-group col-lg-3 col-md-3" style="height:150px">
                                <label class="form-label">Foto</label>  
                                <img class="rounded circle col-12 mb-2" width="100%" height="100%" src="{{ Storage::url($employe->image->path) }}" alt="">
                            </div>

                            <div class="col-lg-9 col-md-7 d-flex justify-content-between">
                               <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label class="form-label">Documento de Identidad</label>
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <select name="type_dni" class="custom-select input-group-text form-control"  required>
                                                    @if ($employe->person->type_dni == 'N' )
                                                    <option value="N">N</option>
                                                    @endif
                                                    @if ($employe->person->type_dni == 'E' )
                                                    <option value="E">E</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Documento de Identidad" value=" {{ $employe->person->dni }}" required name="dni">
                                        </div>
                                    </div>
                                        
                                        <div class="col-lg-4 ">
                                            <div class="form-group">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ $employe->person->name }}" required>
                                            </div>
                                        </div>
                        
                                        <div class="col-lg-4 ">
                                            <div class="form-group"> 
                                                <label class="form-label">Apellido</label>
                                                <input type="text" class="form-control" placeholder="Apellido" name="lastname" value="{{ $employe->person->lastname }}" required>
                                            </div>
                                        </div>
        
                                        <div class="col-lg-4 mt-4">
                                            <div class="form-group">
                                                <label class="form-label">Direccion</label>
                                                <input type="text" name="address" id="address" class="form-control" placeholder="Direccion" value="{{ $employe->person->address }}" required>
                                            </div>
                                        </div>
                    
                                        <div class="col-lg-4 mt-4">
                                            <div class="form-group">
                                                <label class="form-label"> Teléfono </label>
                                                <input type="text" class="form-control" placeholder="Telefono" name="phone" value="{{ $employe->person->phone }}" required>
                                            </div>
                                        </div>
                                            
                                        <div class="col-lg-4 mt-4">
                                            <div class="form-group">
                                                <label class="form-label"> Correo Electronico </label>
                                                <input type="email" placeholder="name@example.com" class="form-control" name="email" value="{{$employe->person->email }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-between">

                                <div class="mb-2 col-lg-3">
                                    <input id="image" type="file" class="dropify" name="image" data-default-file="">
                                </div>
                            
                                <div class="col-lg-3 mt-4">
                                    <div class="form-group">
                                    <label class="form-label">Cargo </label>
                                        <input type="hidden"  name="position_id" value="{{$position->id}}">
                                        <input type="text" class="form-control" name="position_id" value="{{$position->name = 'doctor'}}" disabled>
                                    </div>
                                </div>

                                <div class="col-lg-6 mt-4" id="framework_form">
                                    <label class="form-label">Especialidad</label>
                                    <div class="form-group multiselect_div">
                                        <select id="speciality"  name="speciality[]" class="multiselect multiselect-custom form-control" multiple="multiple" checked="true">
                                            @foreach ($speciality as $speciality)
                                                @foreach ($employe->speciality as $item)
                                                @if ($item->id == $speciality->id)
                                                <option selected="selected" value= {{ $speciality->id }}>{{ $speciality->name }}</option>
                                                @endif
                                                @endforeach
                                            <option value= {{ $speciality->id }}>{{ $speciality->name }}</option>
                                            @endforeach
                                        </select>
                                        
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
        
                    <div class="btn-group-toggle mb-2 mt-3 d-flex justify-content-end" style="text-align:center">
                        <button  type="submit" class="btn mr-2 pr-4 pl-4 text-white bg-verdePastel" >Guardar</button>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection


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
@endsection


    