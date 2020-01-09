@extends('dashboard.layouts.app')

@section('cites','active')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">

@endsection

@section('title','Registro de Empleados')

@section('content')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('employe.store')}}" method='POST' enctype="multipart/form-data" class="row d-flex justify-content-center">
            @csrf
                <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                    <div class="card p-4">

                        <div class="row d-flex justify-content-between create-employee">
                            <div class="form-group col-lg-3 col-md-3" >
                                <label class="form-label">Foto</label>
                                <div class=" mb-2">
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
                                                    <input type="text" class="form-control validanumericos" placeholder="Telefono" name="phone" value="{{ old('phone') }}" required>
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
                    
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Cargo</label>
                                <select name="position_id" id="id" class="custom-select input-group-text bg-white form-control">
                                    <option value="0">Ninguna selección</option>
                                    @foreach ($position as $position)
                                    <option value={{$position->id}}>{{$position->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row ">
                                <div class="col-lg-6 mt-2 d-flex justify-content-center">
                                    <div class="form-group">
                                        <div class="form-label">Usara el Sistema</div>
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-radio custom-control-inline" data-toggle="modal" data-target="#staticBackdrop">
                                                <input type="radio" class="custom-control-input" onclick="enableBtn()"  name="pass" value="option1" >
                                                <span class="custom-control-label">Si</span>
                                            </label>
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" onclick="disableBtn()" name="pass" value="option2">
                                                <span class="custom-control-label">No</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <button disabled type="button" id="boton" class="btn text-white bg-azuloscuro ml-4" data-toggle="modal" data-target="#permission">Agregar Permisos</button><i class=""></i>
                                </div>
                            </div>
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

                    <div class="modal fade" id="permission" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Asignar Permisos</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12" >
                                        <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Seleccionar</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($permissions as $item)
                                        <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div class="custom-controls-stacked">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-switch-input" name="example-checkbox1" value="option1" >
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </div>
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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


@section('scripts')
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>

<script>
onload = function(){ 
  var ele = document.querySelectorAll('.validanumericos')[0];
  ele.onkeypress = function(e) {
     if(isNaN(this.value+String.fromCharCode(e.charCode)))
        return false;
  }
  ele.onpaste = function(e){
     e.preventDefault();
  }
}
</script>

<script>
function disableBtn() {
  document.getElementById("boton").disabled = true;
}

function enableBtn() {
  document.getElementById("boton").disabled = false;
}
</script>

@endsection


    