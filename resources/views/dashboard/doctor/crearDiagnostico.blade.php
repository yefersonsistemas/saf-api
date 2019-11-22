@extends('dashboard.layouts.app')
 @section('doctor','active') 

 @section('css')
 <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
 <link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
 <link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-colorpicker\css\bootstrap-colorpicker.css') }}">
 <link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
@endsection

@section('title','Diagnostico') 

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
                                <h3 class="card-title"> <a href="javascript:history.back(-1);" class="btn btn-sm btn-azuloscuro mr-3 text-white"><i class="icon-action-undo  mx-auto"></i></a>Crear Diagnostico</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Descripción</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="form-control text-description" placeholder="Descripción"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                         <div class="form-group">
                                            <label class="form-label">Razon</label>
                                            <textarea name="razon" id="razon" cols="30" rows="10" class="form-control text-razon" placeholder="Razon"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                            <label>Examenes</label>
                                            <div class="form-group multiselect_div">
                                                <select id="multiselect4-filter" name="multiselect4[]" class="multiselect multiselect-custom" multiple="multiple">
                                                    <option value="bootstrap">Bootstrap</option>
                                                    <option value="bootstrap-marketplace">Bootstrap Marketplace</option>
                                                    <option value="bootstrap-theme">Bootstrap Theme</option>
                                                    <option value="html">HTML</option>
                                                    <option value="html-template">HTML Template</option>
                                                    <option value="wp-marketplace">WordPress Marketplace</option>
                                                    <option value="wp-plugin">WordPress Plugin</option>
                                                    <option value="wp-theme">WordPress Theme</option>
                                                </select>
                                            </div>
                                        </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Indicaciones</label>
                                            <textarea name="indicaciones" id="indicaciones" cols="30" rows="10" class="form-control text-razon" placeholder="Indicaciones"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Anexos</label>
                                            <textarea name="anexos" id="anexos" cols="30" rows="10" class="form-control text-razon" placeholder="Anexos"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                            <label>Prox. Cita</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Proxima Cita">
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
<script src="{{ asset('assets\plugins\bootstrap-colorpicker\js\bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>

<script>
    $('#multiselect4-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
    });
</script>
@endsection