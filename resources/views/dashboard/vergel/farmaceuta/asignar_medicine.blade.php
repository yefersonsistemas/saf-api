@extends('dashboard.layouts.app')

@section('doctor','active')
@section('farmarol','d-block')
@section('dire','d-none')
@section('css')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
@endsection


@endsection

@section('title','Insumos')

@section('content')
    <div class="section-body py-3 card-body">
        <div class="container row card d-flex justify-content-between" style="height:650px;">

            <div class="col-7" style="height:100%">

                <div class="card-header">
                    <h5>Medicinas</h5>
                </div>
                    <div class="table-responsive p-2">
                        <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="addrowExample">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Presentación</th>
                                    <th>Medida</th>
                                    <th>Cantidad</th>
                                    <th class="text-center">Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stock as $item )
                                    <tr>
                                        <td>{{ $item->medicine_pharmacy->medicine->name }}</td>
                                        <td>{{ $item->medicine_pharmacy->presentation }}</td>
                                        <td>{{ $item->medicine_pharmacy->measure }} </td>
                                        <td>{{ $item->medicine_pharmacy->quantity_Unit }}</td>
                                        <td class="text-center"><a style="cursor:pointer" name="{{$item->id}}" class="text-dark btn"><i class="icon-trash"></i></a></td>
                                    </tr>
                                @endforeach   
                            </tbody>
                        </table>
                    </div>          
                </div>

            <div class="col-5 card p-3" style="background:#f2f2f2;
            height: 650px;
            overflow: scroll;">
                {{-- <div class="row d-flex d-row justify-content-center rawp" style="height:100%"> --}}
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    @if ($informe->surgery->file_doctor->first() != null)
                          <div class="carousel-inner">
                        @foreach ($informe->surgery->file_doctor as $item)

                       
                            @if ($item->id == 1)
                              <div class="carousel-item active">
                                <img src="{{ Storage::url($item->path) }}" alt="Snow" id="myImg" name="{{ $item->path }}" class="img-thumbnail m-0" style="width:100%; height:100%; border-radius:none;">
                              </div>
                              @else
                              <div class="carousel-item">
                                <img src="{{ Storage::url($item->path) }}" alt="Snow" id="myImg" name="{{ $item->path }}" class="img-thumbnail m-0" style="width:100%; height:100%; border-radius:none;">
                              </div>
                              @endif
                            {{-- <div class="m-0 p-0 col-12" style="height:400px;">
                                <img src="{{ Storage::url($item->path) }}" alt="Snow" id="myImg" name="{{ $item->path }}" class="img-thumbnail m-0" style="width:100%; height:100%; border-radius:none;">
                            </div>    --}}
                           
                        @endforeach     
                         </div>
                    @endif

                </div>

                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
                    @if($informe->surgery->file_doctor->first() == null)
                        <div class="card text-center m-4 p-4">
                            <h5 class="m-4">No tiene exámenes previos</h5>
                        </div>
                    @endif
                </div>

            {{-- </div> --}}
                
        </div>
    </div>  

@endsection

@section('scripts')
@endsection
