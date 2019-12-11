{{-- @extends('layouts.app')

@section('title', citas de pacientes)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Citas de pacientes</div>

                <div class="card-body">
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
@endsection

@section('title','Citas de pacientes')

@section('content')

<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix justify-content-between">
            {{-- Contadores --}}
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">                                
                        <h6>Reservaciones confirmadas</h6>
                        <h3 class="pt-3"><i class="fa fa-address-book"></i> <span class="counter">2,250</span></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Pacientes por atender</h6>
                        <h3 class="pt-3"><i class="fa fa-calendar"></i> <span class="counter">750</span></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Pacientes atendidos</h6>
                        <h3 class="pt-3"><i class="fa fa-users"></i> <span class="counter">25</span></h3>                             
                    </div>
                </div>
            </div>

            <!--lista de reservaciones confirmadas-->
            <div class="container">

                <ul class="nav nav-pills mb-3 mt-4 d-flex justify-content-end" id="pills-tab" role="tablist">
                    
                    <li class="nav-item">
                        <a class="espera pt-0 pb-0 pr-4 pl-4" id="pills-espera-tab" data-toggle="pill" href="#espera" role="tab" aria-controls="espera" aria-selected="true"> <i class="icon-clock"></i>&nbsp; En espera</a>
                    </li>
                    <li class="nav-item">
                        <a class="dentro pt-0 pb-0 pr-4 pl-4" id="pills-profile-tab" data-toggle="pill" href="#dentro" role="tab" aria-controls="dentro" aria-selected="false"><i class="fa fa-user-md"></i>&nbsp; Dentro del consultorio</a>
                    </li>
                    <li class="nav-item">
                        <a class="fuera pt-0 pb-0 pr-4 pl-4" id="pills-contact-tab" data-toggle="pill" href="#fuera" role="tab" aria-controls="fuera" aria-selected="false">Fuera del consultorio</a>
                    </li>
                    <li class="nav-item">
                        <a class="todos active pt-0 pb-0 pr-4 pl-4"  id="pills-home-tab" data-toggle="pill" href="#todos" role="tab" aria-controls="todos" aria-selected="true">Fuera de las instalaciones</a>
                    </li>
                </ul><br>
                  
                <div class="accordion" id="accordionExample" id="todas" role="tabpanel" aria-labelledby="pills-home-tab">
                    @foreach ($itinerary as $itinerary)

                        @if($itinerary->status == 'dentro') <!--esta en espera-->
                            <div class="card" style="border-radius:3px; border:2px solid  #FACC2E">
                        @endif

                        @if($itinerary->status == 'dentro_office')<!--dentro del consultorio-->
                            <div class="card" style="border-radius:3px; border:2px solid  #00ad88">
                        @endif

                        @if($itinerary->status == 'fuera_office')<!--fuera del consultorio-->
                            <div class="card " style="border-radius:3px; border:2px solid #B40404">
                        @endif

                        @if($itinerary->status == 'fuera')<!--fuera de las instalaciones-->
                            <div class="card " style="border-radius:3px; border:2px solid #ccc">
                        @endif

                        @if($itinerary->status == '')<!--si no ha llegado a las instalaciones-->
                            <div class="card " style="border-radius:3px; border:2px solid #000">
                        @endif

                            <div class="row card-header pl-5 pr-5 heig" id="headingOne" >

                                <div class="col-8">
                                    <div class="row">
                                        <!--Imagen del paciente-->
                                        <div class="col-3">
                                            @if (!empty($itinerary->person->image->path))
                                            <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($itinerary->person->image->path) }}" alt="">
                                            @else
                                            <img src="" alt="">
                                            @endif
                                        </div>
                                        <!--Nombre del paciente-->
                                        <div class="col-7">                                            
                                            <h2 class=" mb-0 p-0" >
                                            <button class="btn botom" type="button" data-toggle="collapse" data-target="#{{ $itinerary->person->type_dni }}{{ $itinerary->person->id }}" aria-expanded="true" aria-controls="{{ $itinerary->person->name }}">
                                                    {{ $itinerary->person->dni }} &nbsp; &nbsp;&nbsp;&nbsp;  {{ $itinerary->person->name }} {{ $itinerary->person->lastname }}  
                                            </button>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            
                                
                                <!--es espera-->
                                @if(empty($itinerary->person->inputoutput->first()->inside)  && empty($itinerary->person->inputoutput->first()->inside_office)  && empty($itinerary->person->inputoutput->first()->outside_office) && empty($itinerary->person->inputoutput->first()->outside))
                                    <div class="col-4 d-flex justify-content-end">
                                        <button disabled href="{{ route('checkout.statusOut', $itinerary->patient_id ) }}" disabled class="btn btn-hecho"><i class="icon-login"></i></button>
                                    </div>
                                @endif

                                 <!--dentro de las instalaciones-->
                                 @if(!empty($itinerary->person->inputoutput->first()->inside)  && empty($itinerary->person->inputoutput->first()->inside_office)  && empty($itinerary->person->inputoutput->first()->outside_office) && empty($itinerary->person->inputoutput->first()->outside))
                                    <div class="col-4 d-flex justify-content-end">
                                        <button disabled href="{{ route('checkout.statusOut', $itinerary->patient_id ) }}" disabled class="btn btn-amarillo"><i class="icon-login"></i></button>
                                    </div>
                                 @endif

                                <!--fuera del consultorio-->
                                @if(!empty($itinerary->person->inputoutput->first()->inside)  && !empty($itinerary->person->inputoutput->first()->inside_office)  && empty($itinerary->person->inputoutput->first()->outside_office) && empty($itinerary->person->inputoutput->first()->outside))
                                    <div class="col-4 d-flex justify-content-end">
                                        <button disabled href="{{ route('checkout.statusOut', $itinerary->patient_id ) }}" class="btn btn-inside-c"><i class="icon-login"></i></button>
                                    </div>
                                @endif

                                <!--fuera del consultorio-->
                                @if(!empty($itinerary->person->inputoutput->first()->inside)  && !empty($itinerary->person->inputoutput->first()->inside_office)  && !empty($itinerary->person->inputoutput->first()->outside_office) && empty($itinerary->person->inputoutput->first()->outside))
                                    <div class="col-4 d-flex justify-content-end">
                                        <a href="{{ route('checkout.statusOut', $itinerary->patient_id ) }}" class="btn btn-outside-c"><i class="icon-login"></i></a>
                                    </div>
                                @endif

                                <!--fuera de las instalaciones-->
                                @if(!empty($itinerary->person->inputoutput->first()->inside)  && !empty($itinerary->person->inputoutput->first()->inside_office)  && !empty($itinerary->person->inputoutput->first()->outside_office) && !empty($itinerary->person->inputoutput->first()->outside))
                                    <div class="col-4 d-flex justify-content-end">
                                        <button disabled href="{{ route('checkout.statusOut', $itinerary->patient_id ) }}" class="btn btn-outside"><i class="icon-login"></i></button>
                                    </div>
                                @endif
                            </div>

                            <!--informacion del paciente reservacion y demas-->
                            <div id="{{ $itinerary->person->type_dni }}{{ $itinerary->person->id }}" class="collapse row" style="border-top:1px solid #EFF2F4" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="col-md-12 col-lg-9 col-sm-12">
                                    <div class="row card-body d-flex justify-content-lg-between">

                                        <!--Medico tratente-->
                                        <div class="col-md-12 col-sm-12 col-lg-12  mb-0 p-0" style="width: 18rem;">
                                            <div class="card-body row">
                                                <div class="col-md-4"><h5 class="card-title color_titulo text-start"><i class="icon-user"></i> Medico tratante</h5></div>
                                                <div class="col-md-8"><span class="text-muted">  {{ $itinerary->employe->person->name }} </span>  <span class=" mb-2 text-muted">{{ $itinerary->employe->person->lastname }}</span> <span class=" mb-2 text-muted"><i class="fe fe-phone"></i> {{ $itinerary->employe->person->phone }}</span></div>
                                            </div>
                                        </div>  
                                            
                                        <!--Posibles cirugias-->
                                        <div class="card col-md-12 col-sm-12 col-lg-5 ml-2" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title color_titulo">Posible cirugia</h5>
                                                @if($itinerary->surgery != null)
                                                <span class="titulos">Nombre:</span> <span class="mb-2 text-muted">{{ $itinerary->surgery->typesurgeries->name }}</span><br>
                                                <span class="titulos">Descripcion: </span><span>{{ $itinerary->surgery->typesurgeries->description }}</span><br>
                                                <span class="titulos">Duracion: </span><span>{{ $itinerary->surgery->typesurgeries->duration }}</span> <br>                                               
                                                <span class="titulos">costo: </span><span>{{ $itinerary->surgery->typesurgeries->cost }}</span>
                                                @else
                                                <span class="mb-2 text-muted">Sin cirugia</span><br>
                                                @endif
                                            </div>                                            
                                        </div> 
                                            
                                        <!--Posibles procedimientos-->
                                        <div class="card col-md-12 col-sm-12 col-lg-5 ml-2" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title color_titulo">Posibles procedimientos</h5>
                                                @if ($itinerary->procedures != null)
                                                <ul>
                                                    @foreach ($itinerary->procedures as $proce)
                                                        <li> <span class="mb-2 text-muted">{{ $proce->name }} {{ $itinerary->surgery->typesurgeries->name }}</span></li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                <span class="mb-2 text-muted">Sin procedimientos</span><br>
                                                @endif
                                            </div>                                                
                                        </div> 
        
                                    </div>
                                </div>

                                <!--Acciones-->
                                <div class="col-md-12 col-lg-3 col-sm-12">
                                    <div class="row d-flex justify-content-end" style="width: 18rem;">
                                        <div class="card-body">
                                            <!--EXAMEN-->
                                            <div class="col-lg-7 col-md-12 col-sm-12 d-flex justify-content-end mb-3 ml-3">
                                                @if($itinerary->exam_id != null)
                                                    <a href="{{ route('checkout.imprimir_examen', $itinerary->exam_id) }}" class="btn btn-boo abarca" type="button" target="_blank">
                                                    <i class="fa fa-print"></i> Examen
                                                    </a>
                                                @else
                                                    <a href="{{ route('checkout.crear_examen', $itinerary->patient_id) }}" class="btn btn-gene abarca" type="button" >
                                                        Generar Examen
                                                    </a>
                                                @endif
                                            </div>

                                            <!--RECETARIO-->
                                            <div class="col-lg-7 col-md-12 col-sm-12 d-flex justify-content-end mb-3 ml-3">
                                                @if($itinerary->recipe_id != null)
                                                    <a href="{{ route('checkout.imprimir_recipe', [$itinerary->recipe_id, $itinerary->patient_id, $itinerary->employe_id]) }}" class="btn btn-boo abarca" type="button" target="_blank">
                                                        <i class="fa fa-print"> </i> Recetario
                                                    </a>
                                                    @else
                                                    <a href="{{ route('doctor.crearRecipe',[$itinerary->patient_id, $itinerary->employe_id]) }}" class="btn btn-gene abarca" type="button">
                                                        Generar Recetario
                                                    </a>
                                                @endif
                                            </div>

                                            <!--CONSTANCIA-->
                                            <div class="col-lg-7 col-md-12 col-sm-12 d-flex justify-content-end mb-3 ml-3">
                                                @if($itinerary->constancy_id != null)
                                                    <a href="{{ route('checkout.imprimir_constancia') }}" class="btn btn-boo abarca" type="button" target="_blank">
                                                        <i class="fa fa-print"> </i>Constancia
                                                    </a>
                                                    {{-- @else
                                                    <a href="" class="btn btn-gene abarca" type="button">
                                                        <i class="fa fa-plus-circle"></i>Constancia
                                                    </a> --}}
                                                @endif
                                            </div>

                                            <!--REFERENCIA-->
                                            <div class="col-lg-7 col-md-12 col-sm-12 d-flex justify-content-end mb-3 ml-3">
                                                @if($itinerary->reference_id != null)
                                                    <a href="{{ route('checkout.imprimir_referencia', $itinerary->id) }}" class="btn btn-boo abarca" type="button" target="_blank">
                                                        <i class="fa fa-print"> </i> Referencia
                                                    </a>
                                                    {{-- @else
                                                    <a href="" class="btn btn-gene abarca" type="button">
                                                        <i class="fa fa-plus-circle"></i> Referencia
                                                    </a> --}}
                                                @endif
                                            </div>

                                            <!--REPOSO-->
                                            <div class="col-lg-7 col-md-12 col-sm-12 justify-content-end mb-3 ml-3">
                                                @if($itinerary->rest_id != null)
                                                    <a href="{{ route('checkout.imprimir_reposo') }}" class="btn btn-boo abarca text-start" type="button" target="_blank">
                                                        <i class="fa fa-print"> </i> Reposo
                                                    </a>
                                                    {{-- @else
                                                    <button href="" class="btn btn-gene abarca text-start" disabled>
                                                        <i class="fa fa-plus-circle"></i> Reposo
                                                    </button> --}}
                                                @endif
                                            </div>

                                            <!--INFORME-->
                                            {{-- <div class="col-lg-7 col-md-12 col-sm-12 justify-content-end mb-3 ml-3">
                                                @if($itinerary->rest_id != null)
                                                    <a href="{{ route('checkout.imprimir_informe') }}" class="btn btn-boo abarca text-start" type="button" target="_blank">
                                                        <i class="fa fa-print"> </i> Informe
                                                    </a>
                                                    @else
                                                    <button href="" class="btn btn-gene abarca text-start" disabled>
                                                        <i class="fa fa-plus-circle"></i> Reposo
                                                    </button>
                                                @endif
                                            </div> --}}

                                            <!--CITA-->
                                            {{-- <div class="col-lg-7 col-md-12 col-sm-12 mb-2 ml-3">
                                                <a  href="" class="btn btn-gene abarca text-start" >
                                                    <i class="fa fa-calendar-plus-o"></i> Cita
                                                </a>
                                            </div> --}}
                                        </div>                                                
                                    </div>
                                </div>
                            </div>

                                {{-- <div class="row card-body d-flex justify-content-between" >
                                    <!--EXAMEN-->
                                    <div class="col-2 d-flex justify-content-end">
                                        @if($itinerary->exam_id != null)
                                            <a href="{{ route('checkout.imprimir_examen', $itinerary->exam_id) }}" class="btn btn-boo" type="button" target="_blank">
                                            <i class="fa fa-print"></i> Examen
                                            </a>
                                        @else
                                            <a href="{{ route('checkout.crear_examen', $itinerary->patient_id) }}" class="btn btn-gene" type="button" >
                                                Generar Examen
                                            </a>
                                        @endif
                                    </div>

                                    <!--RECETARIO-->
                                    <div class="col-2 d-flex justify-content-center">
                                        @if($itinerary->recipe_id != null)
                                            <a href="{{ route('checkout.imprimir_recipe', [$itinerary->recipe_id, $itinerary->patient_id, $itinerary->employe_id]) }}" class="btn btn-boo " type="button" target="_blank">
                                                <i class="fa fa-print"> </i> Recetario
                                            </a>
                                            @else
                                            <a href="{{ route('doctor.crearRecipe',[$itinerary->patient_id, $itinerary->employe_id]) }}" class="btn btn-gene" type="button">
                                                Generar Recetario
                                            </a>
                                        @endif
                                    </div>

                                    <!--CONSTANCIA-->
                                    <div class="col-2 d-flex justify-content-center">
                                        @if($itinerary->constancia_id != null)
                                            <a href="{{ route('checkout.imprimir_constancia') }}" class="btn btn-boo " type="button" target="_blank">
                                                <i class="fa fa-print"> </i> Constancia
                                            </a>
                                            @else
                                            <a href="" class="btn btn-gene" type="button">
                                                <i class="fa fa-plus-circle"></i>  Constancia
                                            </a>
                                        @endif
                                    </div>

                                    <!--REFERENCIA-->
                                    <div class="col-2 d-flex justify-content-center">
                                        @if($itinerary->referencia_id != null)
                                            <a href="{{ route('checkout.imprimir_referencia') }}" class="btn btn-boo " type="button" target="_blank">
                                                <i class="fa fa-print"> </i> Referencia
                                            </a>
                                            @else
                                            <a href="" class="btn btn-gene" type="button">
                                                <i class="fa fa-plus-circle"></i> Referencia
                                            </a>
                                        @endif
                                    </div>

                                    <!--REPOSO-->
                                    <div class="col-2 d-flex justify-content-center">
                                        @if($itinerary->reposo_id != null)
                                            <a href="{{ route('checkout.imprimir_reposo') }}" class="btn btn-boo " type="button" target="_blank">
                                                <i class="fa fa-print"> </i> Reposo
                                            </a>
                                            @else
                                            <a href="" class="btn btn-gene" type="button">
                                                <i class="fa fa-plus-circle"></i> Reposo
                                            </a>
                                        @endif
                                    </div>

                                    <!--CITA-->
                                    <div class="col-2 d-flex justify-content-start">
                                        <a  href="" class="btn btn-gene" >
                                            <i class="fa fa-calendar-plus-o"></i> Cita
                                        </a>
                                    </div>
                                </div> --}}

                            {{-- </div> --}}
                        </div>
                    @endforeach
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