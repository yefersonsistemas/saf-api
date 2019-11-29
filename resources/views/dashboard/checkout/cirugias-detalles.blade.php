@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
@endsection

@section('title','Detalles de cirugía')

@section('content')

<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix justify-content-between">
            <div class="container">
                <div class="card">
                        
                        <div class="row card-body d-flex justify-content-lg-between mb-4" >
                            <h5 class="col-12 ml-2 ">{{ $cirugias->typeSurgeries->name }}</h5>
                                
                            <div class="col-md-3 col-sm-12 col-lg-3 m-2" style="width: 18rem;">                               
                                <div class="bg-indigo text-white">
                                    <div class="card-body tama">
                                        <img src="assets\images\pricing\plan1.svg" class="width150" >
                                    </div>
                                </div>                                             
                            </div> 
                            <div class="col-md-8 col-sm-12 col-lg-8" style="width: 18rem;">
                                <div class="card-body">
                                    <h6 class="card-title color_titulo">Descripción</h6>
                                    <p class="card-subtitle mb-2 text-muted">{{ $cirugias->typeSurgeries->description }}</p>
                                    <div class="row d-flex justify-content-end">
                                        <h6 class="card-title color_titulo mt-4 ">Costo: {{ $cirugias->typeSurgeries->cost }}</h6>
                                    </div>
                                </div>
                            </div>                           
                        </div>

                    
                </div>

                <ul class="nav nav-pills mb-3 mt-4 d-flex justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active btn btn-outline-primary" id="pills-home-tab" data-toggle="pill" href="#procedimientos" role="tab" aria-controls="procedimientos" aria-selected="true">Procedimientos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-success" id="pills-profile-tab" data-toggle="pill" href="#equipos" role="tab" aria-controls="equipos" aria-selected="false">Equipos quirugícos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger" id="pills-contact-tab" data-toggle="pill" href="#hospitalizacion" role="tab" aria-controls="hospitalizacion" aria-selected="false">Hospitalización</a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent mt-4">
                    <div class=" row tab-pane fade show active" id="procedimientos" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class=" mt-2">
                            <div class="row mt-4">                                            
                                        <div class="col-md-12 col-sm-12 col-lg-12 m-2" style="width: 18rem;">
                                                <div class="tab-content" id="pills-tabContent">                                                                        
                                                                                            
                                                    <div class="col-lg-12">
                                                        <div class="table-responsive mb-4">
                                                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                                                <thead>
                                                                    <tr>
                                                                    
                                                                        <th>Nombre</th>
                                                                        <th>Descripción</th>
                                                                        <th>Precio</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Nombre</th>
                                                                        <th>Descripción</th>
                                                                        <th>Precio</th>
                                                                    </tr>
                                                                </tfoot>
                                                                @foreach ($cirugias->procedure as $procedure)
                                                                <tbody>
                                                             
                                                                        <td>{{ $procedure->name }}</td>
                                                                        <td>{{ $procedure->description }}</td>
                                                                        <td>{{ $procedure->price }}</td>
                                                                
                                                            </tbody> 
                                                            @endforeach
                                                            </table>
                                                        </div>
                                                    </div> 
                                                </div>     
                                        </div>                         
                                </div>
                        </div>
                    </div>



                    <div class=" row tab-pane fade show" id="equipos" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="mt-2">
                            <div class="row mt-4">                                            
                                        <div class="col-md-12 col-sm-12 col-lg-12 m-2" style="width: 18rem;">
                                                <div class="tab-content" id="pills-tabContent">                                                                        
                                                                                            
                                                    <div class="col-lg-12">
                                                        <div class="table-responsive mb-4">
                                                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                                                <thead>
                                                                    <tr>
                                                                    
                                                                        <th>Nombre</th>
                                                                        <th>Descripción</th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Nombre</th>
                                                                        <th>Descripción</th>
                                                                    </tr>
                                                                </tfoot>
                                                                @foreach ($cirugias->equipment as $equipment)
                                                                <tbody>
                                                                    <td>{{ $equipment->name }}</td>
                                                                    <td>{{ $equipment->description }}</td>
                                                                </tbody>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div> 
                                                </div>     
                                        </div>                         
                                </div>
                        </div>
                    </div>

                    <div class=" row tab-pane fade show" id="hospitalizacion" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="mt-2">
                            <div class="row mt-4">                                        
                                    <div class="col-md-12 col-sm-12 col-lg-12 m-2" style="width: 18rem;">
                                            <div class="tab-content" id="pills-tabContent">                                                                        
                                                                                        
                                                <div class="col-lg-12 card p-5 text-justify" >
                                                    <p>{{ $cirugias->hospitalization->description }}</p>
                                                </div> 
                                            </div>     
                                    </div>                         
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>
</div>

@endsection

@section('scripts')
    {{-- <script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script> --}}
    <script src="{{ asset('assets\js\table\datatable.js') }}"></script>
@endsection