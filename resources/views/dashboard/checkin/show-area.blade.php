@extends('dashboard.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">
@endsection
@section('title','Ver Consultorio')

@section('content')
<div class="section-body">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row gutters-sm d-row d-flex justify-content-between">
                            @foreach ($areas as $area)
                                    @if ($area->typearea->name == 'Consultorio' && $area->status == null)
                                        <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center" style="">
                                            <label class="imagecheck m-0">
                                            <div class="card assigment">
                                                    <figure class="imagecheck-figure border-0" style="max-height: 100px; width:170px;">
                                                        <img width="100%" height="100%" src="{{ asset('assets/images/consultorio.jpg') }}" alt="" class="imagecheck-image">
                                                    </figure>
                                                    
                                                    <div class="card-body text-center" style="background:#EEEBEB;" style="height:70px; width:170px">
                                                        <h6 class="font-weight-bold">{{ $area->name}} </h6>
                                                        <h6 class="card-subtitle mt-1"><span class="badge badge-light text-white bg-verdePastel pl-3 pr-3 pb-2" style="color:#fff">desocupado</span></h6>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    @else
                                        @if ($area->typearea->name == 'Consultorio' && $area->status == 'ocupado')
                                                <div class="col-lg-2  m-xl-2 m-lg-3 col-md-4 col-sm-6 col-12 mx-sm-0 mx-md-0 d-flex justify-content-center">
                                                    <label class="imagecheck m-0 disabled">
                                                    <div class="card assigment">
                                                            <figure class="imagecheck-figure border-0"  style="max-height: 100px; width:170px;">
                                                                <img width="100%" height="100%" src="{{ asset('assets/images/consultorio.jpg') }}" alt="" class="imagecheck-image">
                                                            </figure>
                                                            
                                                            <div class="card-body text-center bg-grisinus" style="height:70px; width:170px">
                                                                <h6 class=" font-weight-bold">{{ $area->name}} </h6>
                                                                <h6 class="card-subtitle mt-1"><span class="badge badge-light text-danger pl-3 pr-3 pb-1" style="color:red">{{ $area->status }}</span> </h6>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
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
@endsection


