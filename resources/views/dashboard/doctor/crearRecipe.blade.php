@extends('dashboard.layouts.app')
@section('doctor','active')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">

<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }} ">

@endsection

@section('title','Recipe')

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
                    <form class="" method="POST" action="{{ route('recipe.store') }}">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> <a href="javascript:history.back(-1);" class="btn btn-sm btn-azuloscuro mr-3 text-white"><i class="icon-action-undo  mx-auto"></i></a>Crear Recipe</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Agregar Medicamento</h3>
                                        </div>
                                        <div class="card-body">
                                            <button id="addToTable" class="btn btn-azuloscuro mb-15" type="button">
                                                <i class="fe fe-plus-circle" aria-hidden="true"></i> Agregar
                                            </button>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-vcenter table-striped"
                                                    cellspacing="0" id="addrowExample">
                                                    <thead>
                                                        <tr>
                                                            <th>Medicamento Seleccionado</th>
                                                            <th>Medidas</th>
                                                            <th>Dosis</th>
                                                            <th>Duracion</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Medicamento Seleccionado</th>
                                                            <th>Medidas</th>
                                                            <th>Dosis</th>
                                                            <th>Duracion</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        <tr class="gradeA">
                                                            <td>
                                                                <select class="form-control" id="Meicamentos">
                                                                    <option>medicina</option>
                                                                </select>
                                                            </td>
                                                            <td>System Architect</td>
                                                            <td>Edinburgh</td>
                                                            <td class="actions">
                                                                <button
                                                                    class="btn btn-sm btn-icon on-editing m-r-5 button-save"
                                                                    data-toggle="tooltip" data-original-title="Save"
                                                                    hidden=""><i class="icon-drawer" aria-hidden="true"></i>
                                                                </button>
                                                                <button
                                                                    class="btn btn-sm btn-icon on-editing button-discard"
                                                                    data-toggle="tooltip" data-original-title="Discard"
                                                                    hidden=""><i class="icon-close" aria-hidden="true"></i>
                                                                </button>
                                                                <button
                                                                    class="btn btn-sm btn-icon on-default m-r-5 button-edit"
                                                                    data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i>
                                                                </button>
                                                                <button
                                                                    class="btn btn-sm btn-icon on-default button-remove"
                                                                    data-toggle="tooltip"
                                                                    data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
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