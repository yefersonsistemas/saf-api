@extends('dashboard.layouts.app')

@section('css')
{{-- <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
@endsection

@section('title','Modificar Cirugía')

@section('content')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('cirugia.update', $surgery->id)}}" method='POST' class="row d-flex justify-content-center">
            @method('PUT')
            @csrf
            <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card p-4">

                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ $surgery->name }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group"> 
                                <label class="form-label">Descripción</label>
                                <input type="text" class="form-control" placeholder="Descripción" name="description" value="{{ $surgery->description }}" required>
                            </div>
                        </div> 
                    </div>

                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group"> 
                                    <label class="form-label">Duración</label>
                                    <input type="text" class="form-control" placeholder="Duración" name="duration" value="{{ $surgery->duration }}" required>
                                </div>
                            </div> 

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group"> 
                                    <label class="form-label">Precio</label>
                                    <input type="text" class="form-control" placeholder="Precio" name="cost" value="{{ $surgery->cost }}" required>
                                </div>
                            </div> 

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tipo de cirugía</label>
                                    <select name="classification_surgery_id" id="id" class="custom-select input-group-text bg-white form-control">
                                        @foreach ($classification as $classification)
                                        @if ($surgery->classification->id == $surgery->id)
                                        <option selected="selected" value={{$classification->id}}>{{$classification->name}}</option>
                                        @endif
                                        <option value={{$classification->id}}>{{$classification->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>   

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group"> 
                                    <label class="form-label">Cantidad de días</label>
                                    <input type="text" class="form-control" placeholder="Días" name="day_hospitalization" value="{{ $surgery->day_hospitalization }}" required>
                                </div>
                            </div>  
                        </div>  

                            <div class="col-lg-6 col-md-6" id="framework_form">
                                <label class="form-label">Procedimientos</label>
                                <div class="form-group multiselect_div">
                                    <select id="procedure" name="procedure[]" class="multiselect multiselect-custom form-control" multiple="multiple">
                                        @foreach ($procedure as $procedure)
                                        @if ($procedure->typesurgery->id == $surgery->id)
                                        <option selected="selected" value= {{ $procedure->id }}>{{ $procedure->name }}</option>
                                        @endif
                                        <option value= {{ $procedure->id }}>{{ $procedure->name }}</option>
                                        @endforeach
                                    </select>
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
@endsection

@section('scripts')
{{-- <script src="{{ asset('assets\js\form\form-advanced.js') }}"></script> --}}
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
{{-- <script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script> --}}

<script>
    $('#procedure').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
</script>
@endsection
