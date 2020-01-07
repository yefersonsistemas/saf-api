@extends('dashboard.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">
@endsection

@section('title','Registro de Consultorios')

@section('content')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('area.update', $area->id)}}" method='POST' enctype="multipart/form-data" class="row d-flex justify-content-center">
            @method('PUT')
            @csrf
            <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card p-4">

                    <div class="row d-flex justify-content-start">
                        <div class="form-group col-lg-3 col-md-3">
                            <label class="form-label">Imagen actual</label>
                            <img class="rounded circle col-12 mb-2" width="20%" height="73%" src="{{ Storage::url($area->image->path) }}" alt="">
                        </div>

                        <div class="col-md-4 col-lg-3 ml-3" >
                            <label class="form-label">Cambiar imagen</label>
                            <input id="image" type="file" class="dropify" name="image" data-default-file="">
                        </div>

                        <div class="col-md-5 col-lg-5 ml-4">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ $area->name }}" required>
                                    </div>
                                </div>
    
                                <div class="col-lg-12 col-md-12 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Tipo de area</label>
                                        <select name="type_area_id" id="id" class="custom-select input-group-text bg-white form-control">
                                            <option value="0">Ninguna selección</option>
                                            @foreach ($type as $type)
                                            @if ($area->typearea == $type)
                                            <option selected="selected" value={{$type->id}}>{{$type->name}}</option>
                                            @endif
                                            <option value={{$type->id}}>{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                    <button type="submit" class="btn mr-2 pr-4 pl-4 text-white bg-verdePastel" >Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>

@endsection
