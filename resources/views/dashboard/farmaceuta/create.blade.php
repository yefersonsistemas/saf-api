@extends('dashboard.layouts.app')

@section('cites','active')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">

@endsection

@section('title','Registro de Insumos')

@section('content')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('farmaceuta.store')}}" method='POST' enctype="multipart/form-data" class="row d-flex justify-content-center">
            @csrf
            <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card p-4">

                    <div class="row d-flex justify-content-between create-employee">
                        <div class="col-lg-12 col-md-12 d-flex justify-content-between">
                            <div class="row">
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <div class="form-group">
                                        <label class="form-label">Marca</label>
                                        <input type="text" class="form-control" placeholder="Marca" name="marca" value="{{ old('marca') }}" required>
                                    </div>
                                </div>
                    
                                    <div class="col-lg-4">
                                        <div class="form-group"> 
                                            <label class="form-label">Laboratorio</label>
                                            <input type="text" class="form-control" placeholder="Laboratorio" name="laboratory" value="{{ old('laboratory') }}" required>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Presentación</label>
                                                <input type="text" name="presentation" id="presentacion" class="form-control" placeholder="presentacion" value="{{ old('presentation') }}" required>
                                            </div>
                                        </div>
                
                                        
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Medida</label>
                                                <input type="text" class="form-control" placeholder="Medida" name="measure" value="{{ old('measure') }}" required>
                                            </div>
                                        </div>
                                        
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Cantidad de unidad</label>
                                            <input type="text" placeholder="Cantidad" class="form-control" name="quantify_Unit" value="{{ old('quantify_Unit') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Cantidad de lote</label>
                                            <input type="text" placeholder="Stock" class="form-control" name="total" value="{{ old('total') }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
        
                    <div class="btn-group-toggle mb-2 mt-3 d-flex justify-content-end" style="text-align:center">    
                        <button type="reset" style="background:#a1a1a1" class="btn mr-2 pr-4 pl-4 text-white">Limpiar</button> 
                        <button type="submit" class="btn mr-2 pr-4 pl-4 text-white bg-azuloscuro">Guardar</button>                      
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
function disableBtn() {
  document.getElementById("boton").disabled = true;
}

function enableBtn() {
  document.getElementById("boton").disabled = false;
}
</script>


@endsection


    