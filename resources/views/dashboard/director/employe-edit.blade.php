@extends('dashboard.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
@endsection

@section('title','Modificar Empleado')

@section('content')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('empleado.update', $employe->id)}}" method='POST' enctype="multipart/form-data" class="row d-flex justify-content-center">
            @method('PUT')
            @csrf
            <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card p-4">

                    <div class="row d-flex justify-content-between ">
                        <div class="form-group col-lg-3 col-md-3" style="height:150px">
                            <label class="form-label">Foto</label>  
                            @if($employe->image != null)
                            <img class="rounded circle col-12 mb-2" width="100%" height="100%" src="{{ Storage::url($employe->image->path) }}" alt="">
                            @endif
                            @if($employe->image == null)
                            <img src="" alt="">
                            @endif
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
                                            <input type="text" class="form-control" value=" {{$employe->person->dni }}" required name="dni">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 ">
                                        <div class="form-group">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" class="form-control" name="name" value="{{ $employe->person->name }}" required>
                                        </div>
                                    </div>
                    
                                    <div class="col-lg-4">
                                        <div class="form-group"> 
                                            <label class="form-label">Apellido</label>
                                            <input type="text" class="form-control"  name="lastname" value="{{ $employe->person->lastname }}" required>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-4 mt-4">
                                            <div class="form-group">
                                                <label class="form-label">Direccion</label>
                                                <input type="text" name="address" id="address" class="form-control" value="{{ $employe->person->address }}" required>
                                            </div>
                                        </div>
                
                                        
                                        <div class="col-lg-4 mt-4">
                                            <div class="form-group">
                                                <label class="form-label"> Teléfono </label>
                                                <input type="text" class="form-control validanumericos" name="phone" value="{{ $employe->person->phone }}" required>
                                            </div>
                                        </div>
                                        
                                    
                                    <div class="col-lg-4 mt-4">
                                        <div class="form-group">
                                            <label class="form-label"> Correo Electronico </label>
                                            <input type="email" class="form-control" name="email" value="{{ $employe->person->email }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="mt-3 col-lg-3 create-employee">
                                <input id="image" type="file" class="dropify" name="image" data-default-file="">
                            </div>
                        
                            <div class="col-lg-3 mt-4">
                                <div class="form-group">
                                    <label class="form-label">Cargo</label>
                                    <select name="position_id" id="id" class="custom-select input-group-text bg-white form-control">                                         
                                        <option selected="selected" value={{$buscar_P->id}}>{{$buscar_P->name}}</option>
                                        @foreach ($diff as $demas)
                                            <option value={{$demas->id}}>{{$demas->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 mt-4">
                                <label class="form-label">Modificar Permisos</label>
                                <button type="button" id="boton" class="btn btn-info" style="width: 230px" data-toggle="modal" data-target="#permission"> Seleccionar </button>
                            
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
            </div>


            <!--Modal-->
            <div class="modal fade" id="permission" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Elegir Permisos</h5>
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
                                        @foreach ($perms as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                        <input checked type="checkbox" class="custom-switch-input" name="perms[]" value="{{ $item->id }}" >
                                                        <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @foreach ($permissions as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-switch-input" name="perms[]" value="{{ $item->id }}" >
                                                        <span class="custom-switch-indicator"></span>
                                                </label>
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
@endsection



    