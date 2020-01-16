@extends('dashboard.layouts.app')

@section('css')

@endsection

@section('title','Registro Precio de Consulta')

@section('content')
@can('modificar precio de consulta')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('precio.update', $precio->id)}}" method='POST' class="row d-flex justify-content-center">
            @method('PUT')
            @csrf
            <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card p-4">
                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Doctor</label>
                                    <input type="text" class="form-control" value="{{$employes->person->name}} {{$employes->person->lastname}}" disabled >
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Clase</label>
                                <select name="type_doctor_id" class="custom-select input-group-text bg-white form-control">
                                    @foreach ($clases as $clase)
                                    @if ($precio->typedoctor->id == $clase->id )
                                    <option selected="selected" value={{$clase->id}}>{{$clase->name}}</option>
                                    @endif
                                    <option value={{$clase->id}}>{{$clase->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group"> 
                                <label class="form-label">Precio de Consulta</label>
                                <input type="text"  class="form-control" placeholder="Precio" name="price" value="{{ $precio->price }}" required>
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
                    <button  type="submit" class="btn mr-2 pr-4 pl-4 text-white bg-verdePastel" >Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endcan
@endsection

@section('scripts')
@endsection