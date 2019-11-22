@extends('dashboard.layouts.app')
@section('doctor','active')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-colorpicker\css\bootstrap-colorpicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
@endsection

@section('title','Referencia')

@section('content')
<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            {{-- Contadores --}}
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Total De Citas Agendadas</h6>
                        <h4 class="pt-2"><i class="fa fa-address-book"></i> <span class="counter">2,250</span></h4>
                        {{--
                        <h5>$1,25,451.23</h5> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Total De Citas Del Mes</h6>
                        <h4 class="pt-2"><i class="fa fa-calendar"></i> <span class="counter">750</span></h4>
                        {{--
                        <h5>$3,80,451.00</h5> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Citas Para Hoy</h6>
                        <h4 class="pt-2"><i class="fa fa-users"></i> <span class="counter">25</span></h4>
                        {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 65.27%</span> Since last month</span> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Atendidos Hoy</h6>
                        <h4 class="pt-2"><i class="fa fa-user"></i> <span class="counter">5</span></h4>
                        {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 165.27%</span> Since last month</span> --}}
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="col-lg-10 mx-auto">
                    <form class="">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> <a href="javascript:history.back(-1);"
                                        class="btn btn-sm btn-azuloscuro mr-3 text-white"><i
                                            class="icon-action-undo  mx-auto"></i></a>Crear Referencia</h3>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Datos del Paciente</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Documento de Identidad</label>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <select name="type_dni" class="custom-select input-group-text"
                                                        disabled="">
                                                        <option value="">
                                                        </option>
                                                    </select>
                                                </div>
                                                <input type="text" class="form-control"
                                                    placeholder="Documento de Identidad" name="dni" disabled="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" class="form-control" disabled="" placeholder="Nombre"
                                                value="" name="lastname">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Apellido</label>
                                            <input type="text" class="form-control" disabled="" placeholder="Apellido"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label>Medico Interno</label>
                                        <select class="form-control custom-select" id="medicoInterno">
                                            <option>Medico Interno</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                    <label class="form-label">Medico Externo</label>
                                                    <input type="text" class="form-control"  placeholder=""
                                                        value="">
                                                </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 mt-2">
                                            <label>Especialidad</label>
                                            <select class="form-control custom-select" id="medicoInterno">
                                                <option>Especialidad</option>
                                            </select>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                    <label class="form-label">Razon</label>
                                                    <textarea name="razon" id="razon" cols="30" rows="10" class="form-control text-razon" placeholder="Razon"></textarea>
                                                </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-azuloscuro">Generar</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets\plugins\bootstrap-colorpicker\js\bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets\js\table\datatable.js') }}"></script>

<script>
    $('#multiselect4-filter').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
</script>
@endsection