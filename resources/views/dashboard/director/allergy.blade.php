@extends('dashboard.layouts.app')

@section('cites','active')

@section('title','Registro de Alergias en los Pacientes')

@section('content')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{ route('allergy.store') }}" method='POST' class="row d-flex justify-content-center">
            @csrf

            <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card p-4">
            
                    <div class="col-lg-12 ">
                        <div class="form-group">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required>
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
                    <button type="submit" class="btn mr-2 pr-4 pl-4 text-white bg-verdePastel" >Enviar</button>
                    <button type="reset" class="btn btn-azuloscuro mr-2 pr-4 pl-4">Limpiar</button>
                </div>  
            </div>    
        </form>
    </div>
</div>
@endsection
