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
@section('citas','active')

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
                        <h6>Atendidos Hoy</h6>
                        <h3 class="pt-3"><i class="fa fa-user"></i> <span class="counter">{{ $atendidos }}</span></h3>
                        {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 165.27%</span> Since last month</span>                                --}}
                    </div>
                </div>
            </div>

            <!--lista de reservaciones confirmadas-->
            <div class="col-lg-12 col-md-12 mt-10">

                <ul class="nav nav-pills mb-3 mt-4 d-flex justify-content-end "  id="pills-tab" role="tablist">
                    <li class="nav-item mb-1">
                        <a class="nav-link btn-block  btn-outline-dark aprobadas pt-0 pb-0 pr-4 pl-4"  id="pills-aprobadas-tab" data-toggle="pill" href="#aprobadas" role="tab" aria-controls="aprobadas" aria-selected="false">Citas aprobadas</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link btn-block espera pt-0 pb-0 pr-4 pl-4 btn-outline-warning" id="pills-espera-tab" data-toggle="pill" href="#espera" role="tab" aria-controls="espera" aria-selected="false"> <i class="icon-clock"></i>&nbsp; En espera</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link btn-outline-success dentro pt-0 pb-0 pr-4 pl-4" id="pills-dentro-tab" data-toggle="pill" href="#dentro" role="tab" aria-controls="dentro" aria-selected="false"><i class="fa fa-user-md"></i>&nbsp; Dentro del consultorio</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link fuera btn-outline-danger pt-0 pb-0 pr-4 pl-4 active" id="pills-fuera_office-tab" data-toggle="pill" href="#fuera_office" role="tab" aria-controls="fuera_office" aria-selected="true">Fuera del consultorio</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link btn-outline-secondary todos pt-0 pb-0 pr-4 pl-4"  id="pills-fuera-tab" data-toggle="pill" href="#fuera" role="tab" aria-controls="fuera" aria-selected="false">Fuera de las instalaciones</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link btn-outline-secondary todos pt-0 pb-0 pr-4 pl-4"  id="pills-total-tab" data-toggle="pill" href="#total" role="tab" aria-controls="total" aria-selected="false">Todas las citas</a>
                    </li>
                </ul><br>
            </div>

            <div class="tab-content container-fluid" id="pills-tabContent">

                <!---------------------------Citas aprobadas------------------------------->
                <div class="tab-pane fade" id="aprobadas" role="tabpanel" aria-labelledby="pills-aprobadas-tab">
                    <div  class="accordion" id="accordionExample2" id="aprobadas" role="tabpanel" aria-labelledby="pills-aprobadas-tab">
                        @foreach ($confirmadas as $item)
                            <div class="card " style="border-radius:3px; border:2px solid #000">                

                                <div class="row card-header pl-5 pr-5 heig" id="headingOne">
                                    <div class="col-lg-8 col-md-8">
                                        <div class="row">
                                            <!--Imagen del paciente-->
                                            <div class="col-3" style="max-height: 100px; ">
                                                @if (!empty($item->patient->image->path))
                                                <img class="rounded circle" width="100%" height="100%"  src="{{ Storage::url($item->patient->image->path) }}" alt="">
                                                @else
                                                <img src="" alt="">
                                                @endif
                                            </div>
                                            <!--Nombre del paciente-->
                                            <div class="col-7">                                            
                                                <h2 class=" mb-0 p-0">
                                                <button class="btn botom" type="button" data-toggle="collapse" data-target="#aprobadas{{ $item->patient->type_dni }}{{ $item->patient->id }}" aria-expanded="true" aria-controls="{{ $item->patient->name }}">
                                                        {{ $item->patient->dni }} &nbsp; &nbsp;&nbsp;&nbsp;  {{ $item->patient->name }} {{ $item->patient->lastname }}  
                                                </button>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-lg-4 col-md-4 ">
                                        <div class="d-flex justify-content-end container text-center mt-2 pt-1" id="ID_element_0">
                                            @if($item->patient->inputoutput->isEmpty())
                                                <button class="btn btn-danger state state_0 mr-1" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif

                                            @if(!empty($item->patient->inputoutput->first()->inside) && empty($item->patient->inputoutput->first()->inside_office) && empty($item->patient->inputoutput->first()->outside_office) && empty($item->patient->inputoutput->first()->outside))
                                                <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_1 mr-1" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif

                                            @if(!empty($item->patient->inputoutput->first()->inside_office) && !empty($item->patient->inputoutput->first()->inside)  && empty($item->patient->inputoutput->first()->outside_office) && empty($item->patient->inputoutput->first()->outside))
                                                <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif
                                              {{-- El paciente no ha salido de las instalaciones --}}
                                              @if(!empty($item->patient->inputoutput->first()->inside_office) && !empty($item->patient->inputoutput->first()->inside) && !empty($item->patient->inputoutput->first()->outside_office) && empty($item->patient->inputoutput->first()->outside))
                                              <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                  <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                  <button class="btn btn-success state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                  <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                              @endif

                                            @if(!empty($item->patient->inputoutput->first()->inside_office) && !empty($item->patient->inputoutput->first()->inside) && !empty($item->patient->inputoutput->first()->outside_office) && !empty($item->patient->inputoutput->first()->outside))
                                                <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state  mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <!--informacion del paciente reservacion y demas-->
                                <div id="aprobadas{{ $item->patient->type_dni }}{{ $item->patient->id }}" class="collapse row" style="border-top:1px solid #EFF2F4" aria-labelledby="headingOne" data-parent="#accordionExample2">
                                    <div class="col-md-12 col-lg-9 col-sm-12">
                                        <div class="row card-body d-flex justify-content-lg-between">

                                            <!--Medico tratente-->
                                            <div class="col-md-12 col-sm-12 col-lg-12  mb-0 p-0" style="width: 18rem;">
                                                <div class="card-body row">
                                                    <div class="col-md-4"><h5 class="card-title color_titulo text-start"><i class="icon-user"></i> Medico tratante</h5></div>
                                                    <div class="col-md-8"><span class="text-muted">  {{ $item->person->name }} </span>  <span class="text-muted">{{ $item->person->lastname }}</span> <span class="text-muted"><i class="fe fe-phone"></i> {{ $item->person->phone }}</span></div>
                                                </div>
                                            </div>  

                                             <!--Motivo de la cita-->
                                             <div class="col-md-12 col-sm-12 col-lg-12  mb-0 p-0" style="width: 18rem;">
                                                <div class="card-body row">
                                                    <div class="col-md-4"><h5 class="card-title color_titulo text-start">Especialidad</h5></div>
                                                    <div class="col-md-8"><span class="text-muted">  {{ $item->speciality->name }} </span></div>
                                                </div>
                                            </div> 

                                            <!--Motivo de la cita-->
                                            <div class="col-md-12 col-sm-12 col-lg-12  mb-0 p-0" style="width: 18rem;">
                                                <div class="card-body row">
                                                    <div class="col-md-4"><h5 class="card-title color_titulo text-start">Motivo de la cita</h5></div>
                                                    <div class="col-md-8"><span class="text-muted">  {{ $item->description }} </span></div>
                                                </div>
                                            </div> 
            
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!---------------------------Citas en espera------------------------------->
                <div class="tab-pane fade" id="espera" role="tabpanel" aria-labelledby="pills-espera-tab">
                    <div  class="accordion" id="accordionExample3" id="espera" role="tabpanel" aria-labelledby="pills-espera-tab">
                        @foreach ($espera as $es)
                            @if(!empty($es->patient->inputoutput->first()->inside) && empty($es->patient->inputoutput->first()->inside_office) && empty($es->patient->inputoutput->first()->outside_office) && empty($es->patient->inputoutput->first()->outside))
                                {{-- <div class="card " style="border-radius:3px; border:2px solid #000">   --}}
                                    <div class="card" style="border-radius:3px; border:2px solid  #FACC2E">              

                                    <div class="row card-header pl-5 pr-5 heig" id="headingOne">
                                        <div class="col-lg-8 col-md-8">
                                            <div class="row">
                                                <!--Imagen del paciente-->
                                                <div class="col-3" style="max-height: 100px; ">
                                                    @if (!empty($es->patient->image->path))
                                                    <img class="rounded circle" width="100%" height="100%"  src="{{ Storage::url($es->patient->image->path) }}" alt="">
                                                    @else
                                                    <img src="" alt="">
                                                    @endif
                                                </div>
                                                <!--Nombre del paciente-->
                                                <div class="col-7">                                            
                                                    <h2 class=" mb-0 p-0" >
                                                    <button class="btn botom" type="button" data-toggle="collapse" data-target="#espera{{ $es->patient->type_dni }}{{ $es->patient->id }}" aria-expanded="true" aria-controls="{{ $es->patient->name }}">
                                                            {{ $es->patient->dni }} &nbsp; &nbsp;&nbsp;&nbsp;  {{ $es->patient->name }} {{ $es->patient->lastname }}  
                                                    </button>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-lg-4 col-md-4 ">
                                            <div class="d-flex justify-content-end container text-center mt-2 pt-1" id="ID_element_0">
                                                @if($es->patient->inputoutput->isEmpty())
                                                    <button class="btn btn-danger state state_0 mr-1" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                @endif
    
                                                @if(!empty($es->patient->inputoutput->first()->inside) && empty($es->patient->inputoutput->first()->inside_office) && empty($es->patient->inputoutput->first()->outside_office) && empty($es->patient->inputoutput->first()->outside))
                                                    <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_1 mr-1" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                @endif
    
                                                @if(!empty($es->patient->inputoutput->first()->inside_office) && !empty($es->patient->inputoutput->first()->inside)  && empty($es->patient->inputoutput->first()->outside_office) && empty($es->patient->inputoutput->first()->outside))
                                                    <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                @endif
                                                  {{-- El paciente no ha salido de las instalaciones --}}
                                                  @if(!empty($es->patient->inputoutput->first()->inside_office) && !empty($es->patient->inputoutput->first()->inside) && !empty($es->patient->inputoutput->first()->outside_office) && empty($es->patient->inputoutput->first()->outside))
                                                  <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                      <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                      <button class="btn btn-success state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                      <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                  @endif
    
                                                @if(!empty($es->patient->inputoutput->first()->inside_office) && !empty($es->patient->inputoutput->first()->inside) && !empty($es->patient->inputoutput->first()->outside_office) && !empty($es->patient->inputoutput->first()->outside))
                                                    <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-success state  mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-success state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                @endif
    
                                            </div>
                                        </div>
                                    </div>

                                    <!--informacion del paciente reservacion y demas-->
                                    <div id="espera{{ $es->patient->type_dni }}{{ $es->patient->id }}" class="collapse row" style="border-top:1px solid #EFF2F4" aria-labelledby="headingOne" data-parent="#accordionExample3">
                                        <div class="col-md-12 col-lg-9 col-sm-12">
                                            <div class="row card-body d-flex justify-content-lg-between">

                                                <!--Medico tratente-->
                                                <div class="col-md-12 col-sm-12 col-lg-12  mb-0 p-0" style="width: 18rem;">
                                                    <div class="card-body row">
                                                        <div class="col-md-4"><h5 class="card-title color_titulo text-start"><i class="icon-user"></i> Medico tratante</h5></div>
                                                        <div class="col-md-8"><span class="text-muted">  {{ $es->person->name }} </span>  <span class=" mb-2 text-muted">{{ $es->person->lastname }}</span> <span class=" mb-2 text-muted"><i class="fe fe-phone"></i> {{ $es->person->phone }}</span></div>
                                                    </div>
                                                </div>  
                
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif                           
                        @endforeach
                    </div>
                </div>

                 <!---------------------------Dentro del consultorio------------------------------->
                 <div class="tab-pane fade" id="dentro" role="tabpanel" aria-labelledby="pills-dentro-tab">
                    <div  class="accordion" id="accordionExample4" id="espera" role="tabpanel" aria-labelledby="pills-dentro-tab">
                        @foreach ($espera as $dentro)
                            @if(!empty($dentro->patient->inputoutput->first()->inside_office) && !empty($dentro->patient->inputoutput->first()->inside)  && empty($dentro->patient->inputoutput->first()->outside_office) && empty($dentro->patient->inputoutput->first()->outside))
                               <div class="card" style="border-radius:3px; border:2px solid  #00ad88">             

                                    <div class="row card-header pl-5 pr-5 heig" id="headingOne">
                                        <div class="col-lg-8 col-md-8">
                                            <div class="row">
                                                <!--Imagen del paciente-->
                                                <div class="col-3" style="max-height: 100px; ">
                                                    @if (!empty($dentro->patient->image->path))
                                                    <img class="rounded circle" width="100%" height="100%"  src="{{ Storage::url($dentro->patient->image->path) }}" alt="">
                                                    @else
                                                    <img src="" alt="">
                                                    @endif
                                                </div>
                                                <!--Nombre del paciente-->
                                                <div class="col-7">                                            
                                                    <h2 class=" mb-0 p-0" >
                                                    <button class="btn botom" type="button" data-toggle="collapse" data-target="#dentro{{ $dentro->patient->type_dni }}{{ $dentro->patient->id }}" aria-expanded="true" aria-controls="{{ $dentro->patient->name }}">
                                                            {{ $dentro->patient->dni }} &nbsp; &nbsp;&nbsp;&nbsp;  {{ $dentro->patient->name }} {{ $dentro->patient->lastname }}  
                                                    </button>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-lg-4 col-md-4 ">
                                            <div class="d-flex justify-content-end container text-center mt-2 pt-1" id="ID_element_0">
                                                @if($dentro->patient->inputoutput->isEmpty())
                                                    <button class="btn btn-danger state state_0 mr-1" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                @endif
    
                                                @if(!empty($dentro->patient->inputoutput->first()->inside) && empty($dentro->patient->inputoutput->first()->inside_office) && empty($dentro->patient->inputoutput->first()->outside_office) && empty($dentro->patient->inputoutput->first()->outside))
                                                    <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_1 mr-1" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                @endif
    
                                                @if(!empty($dentro->patient->inputoutput->first()->inside_office) && !empty($dentro->patient->inputoutput->first()->inside)  && empty($dentro->patient->inputoutput->first()->outside_office) && empty($dentro->patient->inputoutput->first()->outside))
                                                    <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                @endif
                                                  {{-- El paciente no ha salido de las instalaciones --}}
                                                  @if(!empty($dentro->patient->inputoutput->first()->inside_office) && !empty($dentro->patient->inputoutput->first()->inside) && !empty($dentro->patient->inputoutput->first()->outside_office) && empty($dentro->patient->inputoutput->first()->outside))
                                                  <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                      <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                      <button class="btn btn-success state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                      <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                  @endif
    
                                                @if(!empty($dentro->patient->inputoutput->first()->inside_office) && !empty($dentro->patient->inputoutput->first()->inside) && !empty($dentro->patient->inputoutput->first()->outside_office) && !empty($dentro->patient->inputoutput->first()->outside))
                                                    <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-success state  mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                    <button class="btn btn-success state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                @endif
    
                                            </div>
                                        </div>
                                    </div>

                                    <!--informacion del paciente reservacion y demas-->
                                    <div id="dentro{{ $dentro->patient->type_dni }}{{ $dentro->patient->id }}" class="collapse row" style="border-top:1px solid #EFF2F4" aria-labelledby="headingOne" data-parent="#accordionExample3">
                                        <div class="col-md-12 col-lg-9 col-sm-12">
                                            <div class="row card-body d-flex justify-content-lg-between">

                                                <!--Medico tratente-->
                                                <div class="col-md-12 col-sm-12 col-lg-12  mb-0 p-0" style="width: 18rem;">
                                                    <div class="card-body row">
                                                        <div class="col-md-4"><h5 class="card-title color_titulo text-start"><i class="icon-user"></i> Medico tratante</h5></div>
                                                        <div class="col-md-8"><span class="text-muted">  {{ $dentro->person->name }} </span>  <span class=" mb-2 text-muted">{{ $dentro->person->lastname }}</span> <span class=" mb-2 text-muted"><i class="fe fe-phone"></i> {{ $dentro->person->phone }}</span></div>
                                                    </div>
                                                </div>  
                
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                
                <!----------------------Fuera del consultorio----------------------->
                <div class="tab-pane fade show active" id="fuera_office" role="tabpanel" aria-labelledby="pills-fuera_office-tab">
                    <div  class="accordion" id="accordionExample" id="todas" role="tabpanel" aria-labelledby="pills-home-tab">
                        @foreach ($itinerary as $itinerary)
                        @if(!empty($itinerary->person->inputoutput->first()->inside_office) && !empty($itinerary->person->inputoutput->first()->inside) && !empty($itinerary->person->inputoutput->first()->outside_office) && empty($itinerary->person->inputoutput->first()->outside))
                            {{-- @if($itinerary->status == 'dentro') <!--esta en espera-->
                                <div class="card" style="border-radius:3px; border:2px solid  #FACC2E">
                            @endif

                            @if($itinerary->status == 'dentro_office')<!--dentro del consultorio-->
                                <div class="card" style="border-radius:3px; border:2px solid  #00ad88">
                            @endif --}}

                            {{-- @if($itinerary->status == 'fuera_office')<!--fuera del consultorio--> --}}
                                <div class="card " style="border-radius:3px; border:2px solid #B40404">
                            {{-- @endif --}}

                            {{-- @if($itinerary->status == 'fuera')<!--fuera de las instalaciones-->
                                <div class="card " style="border-radius:3px; border:2px solid #ccc">
                            @endif

                            @if($itinerary->status == '')<!--si no ha llegado a las instalaciones-->
                                <div class="card " style="border-radius:3px; border:2px solid #000">
                            @endif --}}

                                <div class="row card-header pl-5 pr-5 heig" id="headingOne">

                                    <div class="col-lg-8 col-md-8">
                                        <div class="row">
                                            <!--Imagen del paciente-->
                                            <div class="col-3" style="max-height: 100px; ">
                                                @if (!empty($itinerary->person->image->path))
                                                <img class="rounded circle" width="100%" height="100%"  src="{{ Storage::url($itinerary->person->image->path) }}" alt="">
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
                                    <div class=" col-lg-4 col-md-4 ">
                                        <div class="d-flex justify-content-end container text-center mt-2 pt-1" id="ID_element_0">
                                            @if($itinerary->person->inputoutput->isEmpty())
                                                <button class="btn btn-danger state state_0 mr-1" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif

                                            @if(!empty($itinerary->person->inputoutput->first()->inside) && empty($itinerary->person->inputoutput->first()->inside_office) && empty($itinerary->person->inputoutput->first()->outside_office) && empty($itinerary->person->inputoutput->first()->outside))
                                                <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_1 mr-1" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif

                                            @if(!empty($itinerary->person->inputoutput->first()->inside_office) && !empty($itinerary->person->inputoutput->first()->inside)  && empty($itinerary->person->inputoutput->first()->outside_office) && empty($itinerary->person->inputoutput->first()->outside))
                                                <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif

                                            @if(!empty($itinerary->person->inputoutput->first()->inside_office) && !empty($itinerary->person->inputoutput->first()->inside) && !empty($itinerary->person->inputoutput->first()->outside_office) && empty($itinerary->person->inputoutput->first()->outside))
                                                <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <a href="{{ route ('checkout.statusOut', $itinerary->id) }}" data-toggle="tooltip" data-placement="left" title="Marcar cuando el paciente salga de las instalaciones"class="btn btn-danger state state_3 mr-1" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')"></a>
                                            @endif

                                            @if(!empty($itinerary->person->inputoutput->first()->inside_office) && !empty($itinerary->person->inputoutput->first()->inside) && !empty($itinerary->person->inputoutput->first()->outside_office) && !empty($itinerary->person->inputoutput->first()->outside))
                                                <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state  mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif

                                        </div>
                                    </div>
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
                                                    @if($itinerary->typesurgery != null)
                                                    @if($itinerary->typesurgery->classification_surgery_id == 1)
                                                        <span class="titulos">Nombre:</span> <span class="mb-2 text-muted"><a class="enlace_cirugia" href="{{ route('checkout.cirugias_detalles',[$itinerary->typesurgery->id, 1]) }}">{{ $itinerary->typesurgery->name }}</a></span><br>
                                                    @else
                                                    <span class="titulos">Nombre:</span> <span class="mb-2 text-muted"><a class="enlace_cirugia" href="{{ route('checkout.cirugias_detalles',[$itinerary->typesurgery->id, 2]) }}">{{ $itinerary->typesurgery->name }}</a></span><br>
                                                    @endif
                                                        <span class="titulos">Descripcion: </span><span>{{ $itinerary->typesurgery->description }}</span><br>
                                                        <span class="titulos">Duracion: </span><span>{{ $itinerary->typesurgery->duration }}</span> <br>                                               
                                                        <span class="titulos">costo: </span><span>{{ $itinerary->typesurgery->cost }}</span><br>
                                                        <span><a href="{{ route('checkout.programar_cirugia', $itinerary->id)}}" class="btn btn-boo abarca"><i class="fa fa-plus-square mr-1"></i>Agendar Cirugia</a></span>
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
                                                                <li> <span class="mb-2 text-muted">{{ $proce->name }} </span></li>
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
                                                    @endif
                                                </div>

                                                <!--RECETARIO-->
                                                <div class="col-lg-7 col-md-12 col-sm-12 d-flex justify-content-end mb-3 ml-3">
                                                    @if($itinerary->recipe_id != null)
                                                        <a href="{{ route('checkout.imprimir_recipe', $itinerary->recipe_id) }}" class="btn btn-boo abarca" type="button" target="_blank">
                                                            <i class="fa fa-print"> </i> Recetario
                                                        </a>
                                                    @endif
                                                </div>

                                                <!--CONSTANCIA-->
                                                {{-- <div class="col-lg-7 col-md-12 col-sm-12 d-flex justify-content-end mb-3 ml-3">
                                                    @if($itinerary->constancy_id != null)
                                                        <a href="{{ route('checkout.imprimir_constancia') }}" class="btn btn-boo abarca" type="button" target="_blank">
                                                            <i class="fa fa-print"> </i>Constancia
                                                        </a>
                                                    @endif
                                                </div> --}}

                                                <!--REFERENCIA-->
                                                <div class="col-lg-7 col-md-12 col-sm-12 d-flex justify-content-end mb-3 ml-3">
                                                    @if($itinerary->reference_id != null)
                                                        <a href="{{ route('checkout.imprimir_referencia', $itinerary->id) }}" class="btn btn-boo abarca" type="button" target="_blank">
                                                            <i class="fa fa-print"> </i> Referencia
                                                        </a>
                                                    @endif
                                                </div>

                                                <!--REPOSO-->
                                                <div class="col-lg-7 col-md-12 col-sm-12 justify-content-end mb-3 ml-3">
                                                    @if($itinerary->repose_id != null)
                                                        <a href="{{ route('checkout.imprimir_reposo', $itinerary->id) }}" class="btn btn-boo abarca text-start" type="button" target="_blank">
                                                            <i class="fa fa-print"> </i> Reposo
                                                        </a>
                                                    @endif
                                                </div>

                                                <!--INFORME-->
                                                <div class="col-lg-7 col-md-12 col-sm-12 justify-content-end mb-3 ml-3">
                                                    @if($itinerary->report_medico_id != null)
                                                        <a href="{{ route('checkout.imprimir_informe', $itinerary->id) }}" class="btn btn-boo abarca text-start" type="button" target="_blank">
                                                            <i class="fa fa-print"> </i> Informe
                                                        </a>
                                                    @endif
                                                </div>

                                                <!--FACTURAR-->
                                                <div class="col-lg-7 col-md-12 col-sm-12 justify-content-end mb-3 ml-3">
                                                    @if($itinerary->procedureR_id != null)
                                                        @if($itinerary->billing == null)                                                    
                                                            <a href="{{ route('checkout.facturacionLista', $itinerary->id) }}" class="btn btn-boo abarca text-start" type="button">
                                                                <i class="fa fa-print"> </i> Facturar
                                                            </a>
                                                        @else
                                                            @if($itinerary->billing->person_id == null) 
                                                                <a href="{{ route('checkout.facturacionLista', $itinerary->id) }}" class="btn btn-boo abarca text-start" type="button">
                                                                    <i class="fa fa-print"> </i> Facturar
                                                                </a>
                                                            @else
                                                                <a target="_blank" href="{{ route('checkout.imprimir_factura2', $itinerary->id) }}" class="btn btn-boo abarca text-start" type="button">
                                                                    <i class="fa fa-print"> </i> Imprimir factura
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>

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
                            </div>
                        @endif

                        @endforeach
                        </div>
                </div>


                 <!----------------------Fuera de las instalaciones----------------------->
                 <div class="tab-pane fade" id="fuera" role="tabpanel" aria-labelledby="pills-fuera-tab">
                    <div  class="accordion" id="accordionExample5" id="fuera" role="tabpanel" aria-labelledby="pills-fuera-tab">
                        @foreach ($itineraryFuera as $fuera)
                        @if(!empty($fuera->person->inputoutput->first()->inside_office) && !empty($fuera->person->inputoutput->first()->inside) && !empty($fuera->person->inputoutput->first()->outside_office) && !empty($fuera->person->inputoutput->first()->outside))    
            
                            <div class="card " style="border-radius:3px; border:2px solid #ccc">
                                <div class="row card-header pl-5 pr-5 heig" id="headingOne">

                                    <div class="col-lg-8 col-md-8">
                                        <div class="row">
                                            <!--Imagen del paciente-->
                                            <div class="col-3" style="max-height: 100px; ">
                                                @if (!empty($fuera->person->image->path))
                                                <img class="rounded circle" width="100%" height="100%"  src="{{ Storage::url($fuera->person->image->path) }}" alt="">
                                                @else
                                                <img src="" alt="">
                                                @endif
                                            </div>
                                            <!--Nombre del paciente-->
                                            <div class="col-7">                                            
                                                <h2 class=" mb-0 p-0" >
                                                <button class="btn botom" type="button" data-toggle="collapse" data-target="#fuera{{ $fuera->person->type_dni }}{{ $fuera->person->id }}" aria-expanded="true" aria-controls="{{ $fuera->person->name }}">
                                                        {{ $fuera->person->dni }} &nbsp; &nbsp;&nbsp;&nbsp;  {{ $fuera->person->name }} {{ $fuera->person->lastname }}  
                                                </button>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-lg-4 col-md-4 ">
                                        <div class="d-flex justify-content-end container text-center mt-2 pt-1" id="ID_element_0">
                                            @if($fuera->person->inputoutput->isEmpty())
                                                <button class="btn btn-danger state state_0 mr-1" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif

                                            @if(!empty($fuera->person->inputoutput->first()->inside) && empty($fuera->person->inputoutput->first()->inside_office) && empty($fuera->person->inputoutput->first()->outside_office) && empty($fuera->person->inputoutput->first()->outside))
                                                <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_1 mr-1" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif

                                            @if(!empty($fuera->person->inputoutput->first()->inside_office) && !empty($fuera->person->inputoutput->first()->inside)  && empty($fuera->person->inputoutput->first()->outside_office) && empty($fuera->person->inputoutput->first()->outside))
                                                <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-danger state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif

                                            @if(!empty($fuera->person->inputoutput->first()->inside_office) && !empty($fuera->person->inputoutput->first()->inside) && !empty($fuera->person->inputoutput->first()->outside_office) && empty($fuera->person->inputoutput->first()->outside))
                                                <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_2 mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <a href="{{ route ('checkout.statusOut', $itinerary->id) }}" data-toggle="tooltip" data-placement="left" title="Marcar cuando el paciente salga de las instalaciones"class="btn btn-danger state state_3 mr-1" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')"></a>
                                            @endif

                                            @if(!empty($fuera->person->inputoutput->first()->inside_office) && !empty($fuera->person->inputoutput->first()->inside) && !empty($fuera->person->inputoutput->first()->outside_office) && !empty($fuera->person->inputoutput->first()->outside))
                                                <button class="btn btn-success state state_0 mr-1" type="button" state="0" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_1 mr-1" type="button" state="1" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state  mr-1" type="button" state="2" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                                <button class="btn btn-success state state_3 mr-1" type="button" state="3" onclick="entradas($(this).attr('state'), 'ID_element_0')" disabled></button>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <!--informacion del paciente reservacion y demas-->
                                <div id="fuera{{ $fuera->person->type_dni }}{{ $fuera->person->id }}" class="collapse row" style="border-top:1px solid #EFF2F4" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="col-md-12 col-lg-9 col-sm-12">
                                        <div class="row card-body d-flex justify-content-lg-between">

                                            <!--Medico tratente-->
                                            <div class="col-md-12 col-sm-12 col-lg-12  mb-0 p-0" style="width: 18rem;">
                                                <div class="card-body row">
                                                    <div class="col-md-4"><h5 class="card-title color_titulo text-start"><i class="icon-user"></i> Medico tratante</h5></div>
                                                    <div class="col-md-8"><span class="text-muted">  {{ $fuera->employe->person->name }} </span>  <span class=" mb-2 text-muted">{{ $fuera->employe->person->lastname }}</span> <span class=" mb-2 text-muted"><i class="fe fe-phone"></i> {{ $fuera->employe->person->phone }}</span></div>
                                                </div>
                                            </div>  
                                                
                                            <!--Posibles cirugias-->
                                            <div class="card col-md-12 col-sm-12 col-lg-5 ml-2" style="width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title color_titulo">Posible cirugia</h5>
                                                    @if($fuera->typesurgery != null)
                                                    @if($fuera->typesurgery->classification_surgery_id == 1)
                                                        <span class="titulos">Nombre:</span> <span class="mb-2 text-muted"><a class="enlace_cirugia" href="{{ route('checkout.cirugias_detalles',[$fuera->typesurgery->id, 1]) }}">{{ $fuera->typesurgery->name }}</a></span><br>
                                                    @else
                                                    <span class="titulos">Nombre:</span> <span class="mb-2 text-muted"><a class="enlace_cirugia" href="{{ route('checkout.cirugias_detalles',[$fuera->typesurgery->id, 2]) }}">{{ $fuera->typesurgery->name }}</a></span><br>
                                                    @endif
                                                        <span class="titulos">Descripcion: </span><span>{{ $fuera->typesurgery->description }}</span><br>
                                                        <span class="titulos">Duracion: </span><span>{{ $fuera->typesurgery->duration }}</span> <br>                                               
                                                        <span class="titulos">costo: </span><span>{{ $fuera->typesurgery->cost }}</span><br>
                                                        <span><a href="{{ route('checkout.programar_cirugia', $fuera->id)}}" class="btn btn-boo abarca"><i class="fa fa-plus-square mr-1"></i>Agendar Cirugia</a></span>
                                                    @else
                                                        <span class="mb-2 text-muted">Sin cirugia</span><br>
                                                    @endif
                                                </div>                                            
                                            </div> 
                                                
                                            <!--Posibles procedimientos-->
                                            <div class="card col-md-12 col-sm-12 col-lg-5 ml-2" style="width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title color_titulo">Posibles procedimientos</h5>
                                                    @if ($fuera->procedures != null)
                                                        <ul>
                                                            @foreach ($fuera->procedures as $proce)
                                                                <li> <span class="mb-2 text-muted">{{ $proce->name }} </span></li>
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
                                                    @if($fuera->exam_id != null)
                                                        <a href="{{ route('checkout.imprimir_examen', $fuera->exam_id) }}" class="btn btn-boo abarca" type="button" target="_blank">
                                                        <i class="fa fa-print"></i> Examen
                                                        </a>
                                                    @endif
                                                </div>

                                                <!--RECETARIO-->
                                                <div class="col-lg-7 col-md-12 col-sm-12 d-flex justify-content-end mb-3 ml-3">
                                                    @if($fuera->recipe_id != null)
                                                        <a href="{{ route('checkout.imprimir_recipe', $fuera->recipe_id) }}" class="btn btn-boo abarca" type="button" target="_blank">
                                                            <i class="fa fa-print"> </i> Recetario
                                                        </a>
                                                    @endif
                                                </div>

                                                <!--REFERENCIA-->
                                                <div class="col-lg-7 col-md-12 col-sm-12 d-flex justify-content-end mb-3 ml-3">
                                                    @if($fuera->reference_id != null)
                                                        <a href="{{ route('checkout.imprimir_referencia', $fuera->id) }}" class="btn btn-boo abarca" type="button" target="_blank">
                                                            <i class="fa fa-print"> </i> Referencia
                                                        </a>
                                                    @endif
                                                </div>

                                                <!--REPOSO-->
                                                <div class="col-lg-7 col-md-12 col-sm-12 justify-content-end mb-3 ml-3">
                                                    @if($fuera->repose_id != null)
                                                        <a href="{{ route('checkout.imprimir_reposo', $fuera->id) }}" class="btn btn-boo abarca text-start" type="button" target="_blank">
                                                            <i class="fa fa-print"> </i> Reposo
                                                        </a>
                                                    @endif
                                                </div>

                                                <!--INFORME-->
                                                <div class="col-lg-7 col-md-12 col-sm-12 justify-content-end mb-3 ml-3">
                                                    @if($fuera->report_medico_id != null)
                                                        <a href="{{ route('checkout.imprimir_informe', $fuera->id) }}" class="btn btn-boo abarca text-start" type="button" target="_blank">
                                                            <i class="fa fa-print"> </i> Informe
                                                        </a>
                                                    @endif
                                                </div>

                                                <!--FACTURAR-->
                                                <div class="col-lg-7 col-md-12 col-sm-12 justify-content-end mb-3 ml-3">
                                                    @if($fuera->procedureR_id != null)
                                                        @if($fuera->billing == null)                                                    
                                                            <a href="{{ route('checkout.facturacionLista', $fuera->id) }}" class="btn btn-boo abarca text-start" type="button">
                                                                <i class="fa fa-print"> </i> Facturar
                                                            </a>
                                                        @else
                                                            @if($fuera->billing->person_id == null) 
                                                                <a href="{{ route('checkout.facturacionLista', $fuera->id) }}" class="btn btn-boo abarca text-start" type="button">
                                                                    <i class="fa fa-print"> </i> Facturar
                                                                </a>
                                                            @else
                                                                <a target="_blank" href="{{ route('checkout.imprimir_factura2', $fuera->id) }}" class="btn btn-boo abarca text-start" type="button">
                                                                    <i class="fa fa-print"> </i> Imprimir factura
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>                                                
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif 
                         @endforeach
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets\js\table\datatable.js') }}"></script>
    <script>
        function entradas(value, value2) {
            var state = value; //el estado del objeto
            var stateInt = parseInt(state); //se convierte el valor anterior en integer para posteriores validaciones
            var id= value2; // el ID del contenedor en el que se encuentra el boton
            console.log('click '+state+', '+id); //Se valida que se está alcanzando al objeto que se está haciendo click

            //Se valida primero si se está haciendo click en el primer estado
            if(stateInt<=0){
                $('#'+id+' .state_'+state).addClass('btn-success');
                $('#'+id+' .state_'+state).removeClass('btn-danger');
                $('#'+id+' .state_'+state).prop("disabled", true);
                console.log('Se ha cumplido el estado '+ state+', '+id);
            }else{
                //A partir de estado 1, se valida si el estado anterior se cumplió, para esto se toma la clase btn-danger, si no se ha cumplido, se bloquea la función y se puede mandar una alerta.
                if($('#'+id+' .state_'+[stateInt-1]).hasClass('btn-danger')){
                    console.log('click '+state+', '+id+': No puedes ejecutar esta accion hasta que el paso anterior se halla cumplido');
                //Por el contrario, si el estado anterior se ha cumplido, se procede a ejecutar la función
                }else if($('#'+id+' .state_'+[stateInt-1]).hasClass('btn-success')){
                    $('#'+id+' .state_'+state).addClass('btn-success');
                    $('#'+id+' .state_'+state).removeClass('btn-danger');
                    $('#'+id+' .state_'+state).prop("disabled", true);
                    console.log('Se ha cumplido el estado '+ state+', '+id);
                }
            }
        };
    </script>
@endsection