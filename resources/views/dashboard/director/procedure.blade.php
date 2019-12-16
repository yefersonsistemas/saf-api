@extends('dashboard.layouts.app')

@section('css')

@endsection

@section('title','Registro de Procedimientos')

@section('content')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('procedure.store')}}" method='POST' class="row d-flex justify-content-center">
            @csrf
            <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card p-4">
                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group"> 
                                <label class="form-label">Descripción</label>
                                <input type="text" class="form-control" placeholder="Descripción" name="description" value="{{ old('description') }}" required>
                            </div>
                        </div> 

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group"> 
                                <label class="form-label">Precio</label>
                                <input type=""  class="form-control" placeholder="Precio" name="price" value="{{ old('price') }}" required>
                            </div>
                        </div> 

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Especialidad</label>
                                <select name="speciality_id" id="id" class="custom-select input-group-text bg-white form-control">
                                    <option value="0">Ninguna selección</option>
                                    @foreach ($speciality as $speciality)
                                    <option value={{$speciality->id}}>{{$speciality->name}}</option>
                                    @endforeach
                                </select>
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
                    <button type="reset" class="btn btn-azuloscuro mr-2 pr-4 pl-4">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@endsection