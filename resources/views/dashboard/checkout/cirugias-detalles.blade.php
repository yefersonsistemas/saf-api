@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('cirugias','active')
@section('outrol','d-block')
@section('dire','d-none')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandKen.css') }}">

@endsection

@section('title','Detalles de cirugía')

@section('content')
    <div class="section-body  py-4">
        <div class="container-fluid">
            <div class="row clearfix justify-content-between">
                <div class="container">
                    <div class="card card-detalles">
                        <div class="card-header">
                            <h5 class="card-title">{{ $cirugias->name }}</h5>
                        </div>
                        <div class="card-body row d-flex align-items-center justify-content-between pt-0">
                            <div class="col-md-12 col-lg-3 col-sm-12 mb-4">
                                <img src="{{ asset('assets\images\cirugia.jfif') }}" class="card-img-top img-thumbnail" width="">
                            </div>
                            <div class="col-md-12  col-lg-9 col-sm-12 text-justify">
                                <p class="card-text m-0"><strong>DESCRIPCIÓN: </strong>{{ $cirugias->description }}</p><br>
                                <p class="card-title m-0"><strong>Duracion: </strong> {{ $cirugias->duration }} Horas</p><br>
                                <p class="card-title m-0"><strong>Costo: </strong> {{ number_format($cirugias->cost,2) }} $</p>
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
                        @if($tipo_cirugia == 2)
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-danger" id="pills-contact-tab" data-toggle="pill" href="#hospitalizacion" role="tab" aria-controls="hospitalizacion" aria-selected="false">Hospitalización</a>
                        </li>
                        @endif
                    </ul>

                    <!--Para mostrar procedimientos quwe incluye la cirugia-->
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
                                                                {{-- <th>Precio</th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Descripción</th>
                                                                {{-- <th>Precio</th> --}}
                                                            </tr>
                                                        </tfoot>
                                                        @foreach ($cirugias->procedure as $procedure)
                                                        <tbody>
                                                            <td>{{ $procedure->name }}</td>
                                                            <td>{{ $procedure->description }}</td>
                                                            {{-- <td>{{ $procedure->price }}</td> --}}
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

                        <!--Mostrar equipos que requiere la cirugia-->
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

                        <!--Lo que incluye la hospitalizacion-->
                        @if($tipo_cirugia == 2)
                        <div class=" row tab-pane fade show" id="hospitalizacion" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="mt-2">
                                <div class="row mt-4">                                        
                                    <div class="col-md-12 col-sm-12 col-lg-12 m-2" style="width: 18rem;">
                                        <div class="tab-content" id="pills-tabContent">  
                                            <div class="col-lg-12 card p-5 text-justify" >
                                                {{-- <p>{{ $cirugias->hospitalization->description }}</p> --}}
                                            </div> 
                                        </div>     
                                    </div>                         
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets\js\table\datatable.js') }}"></script>
@endsection