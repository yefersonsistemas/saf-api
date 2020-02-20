@extends('dashboard.layouts.app')
@section('cites','active')
@section('newCite','active')
@section('title','Agregar informes al paciente')
@section('enrol','d-block')
@section('dire','d-none')
@section('css')
<link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/css/dropzone.css') }}">

@endsection @section('content')

<div class="py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                {{-- <form id="wizard_horizontal" action="{{route('update.lista_cirugias', $paciente->id)}}" method='POST' enctype="multipart/form-data" lass="card pl-4 pr-4"> --}}
                    {{-- @method('PUT') --}}
                    <form id="" action="{{ route('store.lista_cirugias') }}" method='POST' enctype="multipart/form-data" lass="card pl-4 pr-4">
                    @csrf
                    <h2>Informe del Internista</h2>
                    <input type="hidden" name="person_id" id="person_id" value="{{$person->id}}">
                    <div class="card">
                        <input type="file" name="file[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-azuloscuro">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/brandAn.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/js/dropzone.js') }}"></script>

@endsection
