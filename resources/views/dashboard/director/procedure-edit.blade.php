@extends('dashboard.layouts.app')

@section('cites','active')

@section('title','Editar Procedimiento')

@section('content')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('procedure.update', $procedure->id)}}" method='POST' class="row d-flex justify-content-center">
            @method('PUT')
            @csrf
            <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card p-4">
                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ $procedure->name }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group"> 
                                <label class="form-label">Descripción</label>
                                <input type="text" class="form-control" placeholder="Descripción" name="description" value="{{ $procedure->description }}" required>
                            </div>
                        </div> 

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group"> 
                                <label class="form-label">Precio</label>
                                <input type="text"  class="form-control" placeholder="Precio" name="price" value="{{ $procedure->price }}" required>
                            </div>
                        </div> 

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Especialidad</label>
                                <div class="form-group multiselect_div">
                                    <select id="speciality"  name="speciality[]" class="multiselect multiselect-custom form-control" multiple="multiple" checked="true">
                                        
                                        @foreach ($speciality as $speciality)
                                            @foreach ($procedure->speciality as $item)
                                            @if ($item->id == $speciality->id )
                                            <option selected="selected" value={{$speciality->id}}>{{$speciality->name}}</option>
                                            @endif
                                            @if ($item->id != $speciality->id )
                                            <option value={{$speciality->id}}>{{$speciality->name}}</option>
                                            @endif
                                            @endforeach
                                       
                                         @endforeach
                                    {{-- @foreach ($speciality as $speciality)
                                            @foreach ($employe->speciality as $item)
                                            @if ($item->id == $speciality->id)
                                            <option selected="selected" value= {{ $speciality->id }}>{{ $speciality->name }}</option>
                                            @endif
                                            @endforeach
                                        <option value= {{ $speciality->id }}>{{ $speciality->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                {{-- <select name="speciality_id" id="id" class="custom-select input-group-text bg-white form-control">
                                    <option value="0">Ninguna selección</option>
                                    @foreach ($speciality as $speciality)
                                        @if ($procedure->speciality->id == $speciality->id )
                                        <option selected="selected" value={{$speciality->id}}>{{$speciality->name}}</option>
                                        @endif
                                        @if ($procedure->speciality->id != $speciality->id )
                                        <option value={{$speciality->id}}>{{$speciality->name}}</option>
                                        @endif
                                    @endforeach
                                 
                                </select> --}}
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
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>

<script>
    $('#speciality').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
</script>
@endsection