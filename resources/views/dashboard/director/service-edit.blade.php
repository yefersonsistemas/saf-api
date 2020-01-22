@extends('dashboard.layouts.app')

@section('title','Modiificar Servicio')

@section('content')
@can('modificar servicios')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{ route('servicio.update', $service->id) }}" method='POST' class="row d-flex justify-content-center">
            @method('PUT')
            @csrf

            <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card p-4">
            
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="name" value="{{ $service->name }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label class="form-label">Descripción</label>
                                <input type="text" class="form-control" name="description" value="{{ $service->description }}" required>
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
                    <button  type="submit" class="btn mr-2 pr-4 pl-4 text-white bg-verdePastel" >Guardar</button>
                </div>  
            </div>    
        </form>
    </div>
</div>
@endcan
@endsection
