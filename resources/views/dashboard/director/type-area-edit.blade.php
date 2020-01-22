@extends('dashboard.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">

@endsection

@section('title','Modificar Area')

@section('content')
@can('modificar tipo de area')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('tipo-area.update', $type->id)}}" method='POST' enctype="multipart/form-data" class="row d-flex justify-content-center">
            @method('PUT')
            @csrf
                <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                    <div class="card p-4">

                        <div class="row d-flex justify-content-between">
                            <div class="col-6">
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6" style="height:150px">
                                        <label class="form-label">Imagen anterior</label>  
                                        @if($type->image != null)
                                        <div style="height:130px">
                                            <img class="rounded circle col-12 mb-2" width="100%" height="100%" src="{{ Storage::url($type->image->path) }}" alt="">
                                        </div>
                                        @endif
                                        @if($type->image == null)
                                        <img src="" alt="">
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6">
                                        <label class="form-label">Nueva Imagen</label>
                                        <div class=" mb-2">
                                            <input id="image" type="file" class="dropify" name="image" data-default-file="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" class="form-control" name="name" value="{{ $type->name }}" required>
                                        </div>
                                    </div>
                    
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group"> 
                                            <label class="form-label">Descripción</label>
                                            <input type="text" class="form-control" name="description" value="{{ $type->description }}" required>
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
        
                        </div>
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


@section('scripts')
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>


@endsection


    