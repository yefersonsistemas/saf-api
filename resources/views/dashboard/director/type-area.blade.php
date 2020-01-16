@extends('dashboard.layouts.app')

@section('cites','active')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">

@endsection

@section('title','Registro de Areas')

@section('content')
@can('registrar tipo de area')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('type-area.store')}}" method='POST' enctype="multipart/form-data" class="row d-flex justify-content-center">
            @csrf
                <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                    <div class="card p-4">

                        <div class="row d-flex justify-content-between">
                            <div class="form-group col-lg-3 col-md-3">
                                <label class="form-label">Foto</label>
                                <div class=" mb-2">
                                    <input id="image" required type="file" class="dropify" name="image" data-default-file="">
                                </div>
                            </div>

                            <div class="ccol-lg-9 col-md-9 d-flex justify-content-center">
                               <div class="row">
                                        
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                    
                                    <div class="col-lg-12">
                                        <div class="form-group"> 
                                            <label class="form-label">Descripción</label>
                                            <input type="text" class="form-control" placeholder="Descripción" name="description" value="{{ old('description') }}" required>
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
                        <button type="submit" class="btn mr-2 pr-4 pl-4 text-white bg-verdePastel" >Enviar</button>
                        <button type="reset" class="btn btn-azuloscuro mr-2 pr-4 pl-4">Limpiar</button>   
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


    