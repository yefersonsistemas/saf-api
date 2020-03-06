@extends('dashboard.layouts.app')
@section('medicoss','active')
@section('all','active')
@section('inrol','d-block')
@section('dire','d-none')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">
@endsection

@php
    use Carbon\Carbon;
@endphp

@section('title','Ver Consultorio')

@section('content')

<style>
    .font-doc{
       font-size: 14px;
        /* color: #fff; */
    }

        
    .btn-azuloscuro {
        color: #fff;
        background: #00506b;
    }

    .btn-azuloscuro:hover {
        color: #fff;
        background-color: #00ba88;
        border-color: #009e74;
    }
</style>

<div class="section-body">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="card mt-4">
                    {{-- <a  href="{{Route('checkin.day')}}" class="btn btn-lg btn-azuloscuro text-white position-absolute mt-2 ml-2  "><i class="icon-action-undo mx-auto"></i></a> --}}
                    <div class="card-body">
                        <div class="p-2">     
                            <a href="{{Route('checkin.day')}}" class="btn btn-lg btn-azuloscuro text-white position-absolute    "><i class="icon-action-undo mx-auto"></i></a>
                              </div> 
                             
                        <div class=" col-lg-12 col-md-10 mt-4">
                            
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item col-md-3">
                                    <a class="nav-link btn-block  p-1 d-flex flex-row justify-content-center active btn btn-outline-azuloscuro m-auto" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Mañana</a>
                                </li>
                                <li class="nav-item col-md-3">
                                    <a class="nav-link btn-block  p-1 d-flex flex-row justify-content-center btn btn-outline-info" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Tarde</a>
                                </li>
                            </ul>
                        </div>

                            {{-- aqui se configuran las MAÑANA de los horarios de medicos --}}

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row gutters-sm d-row d-flex justify-content-between px-4">
                                    @foreach ($areas as $area)
                                            @if ($area->typearea->name == 'Consultorio' && $area->status == null)
                                                @if ($area->areaassigment != null  )  
                                                {{-- si $area->areaassigment == null no mostrara nada en in --}}

                                                @foreach ($area->areaassigment->employe->schedule as $item)
                                                     @if($item->turn == 'mañana' && $item->day == $dia)

                                                    
                                                        <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center" style="">
                                                            <label class="imagecheck m-0">
                                                            <div class="card assigment">
                                                                    <figure class="imagecheck-figure border-0" style="max-height: 100px; width:170px;">
                                                                        <img width="100%" height="100%" src="{{ asset('assets/images/consultorio.jpg') }}" alt="" class="imagecheck-image">
                                                                    </figure>
                                                                    
                                                                    <div class="card-body text-center" style="background:#EEEBEB;" style="max-height: 100px; width:170px;">
                                                                        <h6 class="font-weight-bold">{{ $area->name}} </h6>
                                                                        <h6 class="font-doc">{{$area->areaassigment->employe->person->name}}</h6>
                                                                        <a href="{{route('checkin.cambiar', $area->id)}}" class="badge badge-danger text-white pl-3 pr-3 pb-1" style="animation: pulse 2s infinite">Por llegar</a>
                                                                        {{-- <span class="status-icon" style="padding: 5px; animation: pulse 2s infinite;background: red;margin-top: 10px;"></span> --}}
                                                                        {{-- <h6 class="card-subtitle mt-1"><span class="badge badge-light text-white bg-verdePastel pl-3 pr-3 pb-2" style="color:#fff">desocupado</span></h6> --}}
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach 
                                                @endif
                                            @else
                                                @if ($area->typearea->name == 'Consultorio' && $area->status == 'ocupado')
                                                    @if ($area->areaassigment != null )
                                                        @foreach ($area->areaassigment->employe->schedule as $item)
                                                            @if($item->turn == 'mañana' && $item->day == $dia)
                                                                <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                                                    <label class="imagecheck m-0 disabled">
                                                                    <div class="card assigment">
                                                                            <figure class="imagecheck-figure border-0"  style="max-height: 100px; width:170px;">
                                                                                <img width="100%" height="100%" src="{{ asset('assets/images/consultorio.jpg') }}" alt="" class="imagecheck-image">
                                                                            </figure>
                                                                            
                                                                            <div class="card-body text-center bg-grisinus" style="max-height: 100px; width:170px;">
                                                                                <h6 class=" font-weight-bold">{{ $area->name}} </h6>
                                                                                @if ($area->areaassigment != null)
                                                                                <h6 class="font-doc">{{$area->areaassigment->employe->person->name}}</h6>
                                                                                @endif
                                                                                <h6 class="card-subtitle mt-1"><span class="badge badge-light text-white bg-verdePastel pl-3 pr-3 pb-2" style="animation: pulse 2s infinite">Asistente</h6>
                                                                                {{-- <span class="status-icon" style="padding: 5px; animation: pulse 2s infinite;background: #00ad88;margin-top: 10px;"></span> --}}
                                                                                {{-- <h6 class="card-subtitle mt-1"><span class="badge badge-light text-danger pl-3 pr-3 pb-1" style="color:red">{{ $area->status }}</span> </h6> --}}
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endforeach 
                                                    @endif
                                                @endif
                                            @endif
                                    @endforeach
                                </div>
                            </div>
                            
                            {{-- aqui se configuran las TARDE de los horarios de medicos --}}

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row gutters-sm d-row d-flex justify-content-between">
                                    @foreach ($areas as $area)
                                            @if ($area->typearea->name == 'Consultorio' && $area->status == null)
                                                @if ($area->areaassigment != null  )
                                                @foreach ($area->areaassigment->employe->schedule as $item)
                                                    @if($item->turn == 'tarde' && $item->day == $dia)
                                                        <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center" style="">
                                                            <label class="imagecheck m-0">
                                                            <div class="card assigment">
                                                                    <figure class="imagecheck-figure border-0" style="max-height: 100px; width:170px;">
                                                                        <img width="100%" height="100%" src="{{ asset('assets/images/consultorio.jpg') }}" alt="" class="imagecheck-image">
                                                                    </figure>
                                                                    
                                                                    <div class="card-body text-center" style="background:#EEEBEB;" style="max-height: 100px; width:170px;">
                                                                        <h6 class="font-weight-bold">{{ $area->name}} </h6>
                                                                        <h6 class="font-doc">{{$area->areaassigment->employe->person->name}}</h6>
                                                                        <a href="{{route('checkin.cambiar', $area->id)}}" class="badge badge-danger text-white pl-3 pr-3 pb-1" style="animation: pulse 2s infinite">Por llegar</a>
                                                                        {{-- <span class="status-icon" style="padding: 5px; animation: pulse 2s infinite;background: red;margin-top: 10px;"></span> --}}
                                                                        {{-- <h6 class="card-subtitle mt-1"><span class="badge badge-light text-white bg-verdePastel pl-3 pr-3 pb-2" style="color:#fff">desocupado</span></h6> --}}
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach 
                                                @endif
                                            @else
                                                @if ($area->typearea->name == 'Consultorio' && $area->status == 'ocupado')
                                                    @if ($area->areaassigment != null )
                                                        @foreach ($area->areaassigment->employe->schedule as $item)
                                                            @if($item->turn == 'tarde' && $item->day == $dia)
                                                                <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                                                    <label class="imagecheck m-0 disabled">
                                                                    <div class="card assigment">
                                                                            <figure class="imagecheck-figure border-0"  style="max-height: 100px; width:170px;">
                                                                                <img width="100%" height="100%" src="{{ asset('assets/images/consultorio.jpg') }}" alt="" class="imagecheck-image">
                                                                            </figure>
                                                                            
                                                                            <div class="card-body text-center bg-grisinus" style="max-height: 100px; width:170px;">
                                                                                <h6 class=" font-weight-bold">{{ $area->name}} </h6>
                                                                                @if ($area->areaassigment != null)
                                                                                <h6 class="font-doc">{{$area->areaassigment->employe->person->name}}</h6>
                                                                                @endif
                                                                                {{-- <span class="status-icon" style="padding: 5px; animation: pulse 2s infinite;background: #00ad88;margin-top: 10px;"></span> --}}
                                                                                <h6 class="card-subtitle mt-1"><span class="badge badge-light text-white bg-verdePastel pl-3 pr-3 pb-2" style="color:#fff; animation: pulse 2s infinite">Asistente</h6>
                                                                                {{-- <h6 class="card-subtitle mt-1"><span class="badge badge-light text-danger pl-3 pr-3 pb-1" style="color:red">{{ $area->status }}</span> </h6> --}}
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endforeach 
                                                    @endif
                                                @endif
                                            @endif
                                    @endforeach
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




