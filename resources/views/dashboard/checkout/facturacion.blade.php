@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
@endsection

@section('title','Facturación')

@section('content')

<div class="section-body  py-4">
    <div class="container-fluid">
    
                    
                    <div class="col-lg-12">
                            <form class="row">
                                <div class="card p-4">
                                 <div class="row">
                                        <div class="col-3"> <h3 class="card-title">Datos del paciente</h3></div>
                                        <div class="col-8">
                                                <input type="text" class="form-control" placeholder="Documento de identidad" value="">
                                                <a href="#" type="submit" class="btn btn-primary">Buscar</a>
                                        </div>
                                 </div>
                                    <div class="row ">
                                    
                                        {{-- <div class="col-lg-3 col-md-12">
                                                <div class="form-group multiselect_div">
                                                    <select id="multiselect4-filter" name="multiselect4[]" class="multiselect multiselect-custom" multiple="multiple" style="display: none;">
                                                        <option value="bootstrap">Bootstrap</option>
                                                        <option value="bootstrap-marketplace">Bootstrap Marketplace</option>
                                                        <option value="bootstrap-theme">Bootstrap Theme</option>
                                                        <option value="html">HTML</option>
                                                        <option value="html-template">HTML Template</option>
                                                        <option value="wp-marketplace">WordPress Marketplace</option>
                                                        <option value="wp-plugin">WordPress Plugin</option>
                                                        <option value="wp-theme">WordPress Theme</option>
                                                    </select><div class="btn-group"><button type="button" class="multiselect dropdown-toggle btn btn-default" data-toggle="dropdown" title="None selected" aria-expanded="false"><span class="multiselect-selected-text">Pacientes</span> <b class="caret"></b></button><ul class="multiselect-container dropdown-menu" x-placement="bottom-start" style="max-height: 200px; overflow: hidden auto; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);"><li class="multiselect-item filter mr-3" value="0"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><i class="glyphicon glyphicon-search"></i></span></div><input type="text" class="form-control" placeholder="Search"></div></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="bootstrap"> Bootstrap</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="bootstrap-marketplace"> Bootstrap Marketplace</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="bootstrap-theme"> Bootstrap Theme</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="html"> HTML</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="html-template"> HTML Template</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="wp-marketplace"> WordPress Marketplace</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="wp-plugin"> WordPress Plugin</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="wp-theme"> WordPress Theme</label></a></li></ul></div>
                                                </div>
                                            </div> --}}
                                        
                                        <div class="col-sm-4 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Documento de identidad</font></font></label>
                                                <input type="text" class="form-control" placeholder="Documento de identidad" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nombre</font></font></label>
                                                <input type="text" class="form-control" placeholder="Nombre" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Apellido</font></font></label>
                                                <input type="text" class="form-control" placeholder="Apellido" value="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                         
                        </div>
                

                <div class="col-lg-12">
                        <form class="row">
                            <div class="card p-4">
                                <h3 class="card-title">Datos del doctor</h3>
                                
                                <div class="row ">
                                
                                    {{-- <div class="col-lg-3 col-md-12">
                                            <div class="form-group multiselect_div">
                                                <select id="multiselect4-filter" name="multiselect4[]" class="multiselect multiselect-custom" multiple="multiple" style="display: none;">
                                                    <option value="bootstrap">Bootstrap</option>
                                                    <option value="bootstrap-marketplace">Bootstrap Marketplace</option>
                                                    <option value="bootstrap-theme">Bootstrap Theme</option>
                                                    <option value="html">HTML</option>
                                                    <option value="html-template">HTML Template</option>
                                                    <option value="wp-marketplace">WordPress Marketplace</option>
                                                    <option value="wp-plugin">WordPress Plugin</option>
                                                    <option value="wp-theme">WordPress Theme</option>
                                                </select><div class="btn-group"><button type="button" class="multiselect dropdown-toggle btn btn-default" data-toggle="dropdown" title="None selected" aria-expanded="false"><span class="multiselect-selected-text">Pacientes</span> <b class="caret"></b></button><ul class="multiselect-container dropdown-menu" x-placement="bottom-start" style="max-height: 200px; overflow: hidden auto; position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);"><li class="multiselect-item filter mr-3" value="0"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><i class="glyphicon glyphicon-search"></i></span></div><input type="text" class="form-control" placeholder="Search"></div></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="bootstrap"> Bootstrap</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="bootstrap-marketplace"> Bootstrap Marketplace</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="bootstrap-theme"> Bootstrap Theme</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="html"> HTML</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="html-template"> HTML Template</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="wp-marketplace"> WordPress Marketplace</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="wp-plugin"> WordPress Plugin</label></a></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="wp-theme"> WordPress Theme</label></a></li></ul></div>
                                            </div>
                                        </div> --}}
                                    
                                    <div class="col-sm-4 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Documento de identidad</font></font></label>
                                            <input type="text" class="form-control" placeholder="Documento de identidad" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nombre</font></font></label>
                                            <input type="text" class="form-control" placeholder="Nombre" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Apellido</font></font></label>
                                            <input type="text" class="form-control" placeholder="Apellido" value="">
                                        </div>
                                    </div>



                                  

                    
                                </div>
                            </div>
                            {{-- <div class="card-footer text-right ">
                                <button type="submit" class="btn btn-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Actualización del perfil</font></font></button>
                            </div> --}}
                        </form>
                     
                    </div>
    </div>
            </div>

    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets\js\table\datatable.js') }}"></script>
@endsection