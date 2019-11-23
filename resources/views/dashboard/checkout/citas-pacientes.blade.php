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
                            {{-- <h5>$1,25,451.23</h5> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body">
                            <h6>Pacientes por atender</h6>
                            <h3 class="pt-3"><i class="fa fa-calendar"></i> <span class="counter">750</span></h3>
                            {{-- <h5>$3,80,451.00</h5> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div class="card">
                        <div class="card-body">
                            <h6>Pacientes atendidos</h6>
                            <h3 class="pt-3"><i class="fa fa-users"></i> <span class="counter">25</span></h3>
                            {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 65.27%</span> Since last month</span>                                --}}
                        </div>
                    </div>
                </div>

            <!--lista de reservaciones confirmadas-->
            <div class="container">
                  
                    <div class="accordion" id="accordionExample">
                            @foreach ($itinerary as $itinerary)
                            <div class="card">
                              <div class="row card-header pl-5 pr-5" id="headingOne" >
                                <div class="col-8">
                                     <div class="row">
                                        <div class="col-3">
                                            @if (!empty($itinerary->person->image->path))
                                            <img class="rounded circle" width="150px" height="auto"  src="{{ Storage::url($itinerary->person->image->path) }}" alt="">
                                            @else
                                            <img src="" alt="" >
                                            @endif
                                        </div>
                                        <div class="col-7">
                                            
                                                <h2 class=" mb-0 p-0" >
                                                <button class="btn botom" type="button" data-toggle="collapse" data-target="#{{ $itinerary->person->name }}" aria-expanded="true" aria-controls="{{ $itinerary->person->name }}">
                                                {{ $itinerary->person->name }}       {{ $itinerary->person->lastname }}
                                                </button>
                                            </h2>
                                        </div>
                                  </div>
                                   
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <a disabled href="" class="btn btn-secondary mr-2">E</a>
                                    <a href="{{ route('checkout.statusOut', $itinerary->patient_id ) }}" class="btn btn-secondary">S</a>
                                </div>
                              </div>
                          
                              <!--informacion del paciente reservacion y demas-->
                              <div id="{{ $itinerary->person->name }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="row card-body d-flex justify-content-lg-between">
                                        <div class="card col-md-3 col-sm-12 col-lg-3 m-2" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title color_titulo">Medico tratante</h5>
                                                <h6 class=" mb-2 text-muted"><span class="titulos">Nombre:<span>  {{ $itinerary->employe->person->name }}</h6> 
                                              
                                                <h6 class=" mb-2 text-muted"><span class="titulos">Apellido:<span> {{ $itinerary->employe->person->lastname }}</h6>
                            
                                                {{-- <h6 class="mb-2 text-muted"><span class="titulos">Especialidad:<span> {{ $itinerary->speciality->name }}</h6> --}}
                                            </div>
                                        
                                        </div> 
                                        <div class="card col-md-3 col-sm-12 col-lg-3 m-2" style="width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title color_titulo">Posible cirugias</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                                    {{-- <p class="card-text">{{ $itinerary->surgery->typesurgeries->name }}</p> --}}
                                              
                                                </div>
                                            
                                            </div> 
                                            <div class="card col-md-3 col-sm-12 col-lg-3 m-2" style="width: 18rem;">
                                                    <div class="card-body">
                                                        <h5 class="card-title color_titulo">Posibles procedimientos</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                                        {{-- <p class="card-text">{{ $itinerary->procedure->name }}</p> --}}
                                                  
                                                    </div>
                                                
                                                </div> 
                                       
                                    


                                </div>

                                <div class="row card-body d-flex justify-content-between">
                                        <div class="col-5 d-flex justify-content-end">
                                            <button class="btn btn-danger" type="button">
                                            Imprimir examen
                                            </button>
                                        </div>
                                        <div class="col-2 d-flex justify-content-center">
                                            <button class="btn btn-danger " type="button">
                                                Imprimir recipe
                                            </button>
                                        </div>
                                        <div class="col-5 d-flex justify-content-start">
                                            <button class="btn btn-info" type="button">
                                                generar cita
                                            </button>
                                        </div>
                                </div>
                              </div>
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