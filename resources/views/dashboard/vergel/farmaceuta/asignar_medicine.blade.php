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
    <div class="section-body py-3">
        <div class="container row card-body">

            <div class="col-6 card">

                <div class="card-header">
                    <h5>Medicinas</h5>
                </div>
                {{-- <div class="collapse list-group " id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion" >
                    <div class=" py-1"> --}}
                        <div class="table-responsive m-2">
                            <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="addrowExample">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th class="text-center">Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stock as $item )
                                        <tr>
                                            <td>
                                                <i class="fa fa-check mr-3 text-verdePastel"></i>{{ $item->medicine_pharmacy->medicine->name }}
                                            </td>
                                            <td class="text-center"><a style="cursor:pointer" name="{{$item->id}}" class="text-dark btn"><i class="icon-trash"></i></a></td>
                                        </tr>
                                    @endforeach   
                                </tbody>
                            </table>
                        {{-- </div> --}}
                    </div>                                                     
                {{-- </div> --}}
            </div>

            <div class="col-6">
                <div class="card p-3 mb-0 pr-4">
                    <h5>Requerimientos</h5>
                </div>
                <div class="row d-flex d-row justify-content-between rawp">
                    @if ($informe->surgery->file_doctor->first() != null)
                        @foreach ($informe->surgery->file_doctor as $item)
                            <div class="m-0 p-0" style="height:400px;">
                                <img src="{{ Storage::url($item->path) }}" alt="Snow" id="myImg" name="{{ $item->path }}" class="img-thumbnail m-0" style="width:100%; height:100%; border-radius:none;">
                            </div>   
                        @endforeach     
                    @endif
                    @if($informe->surgery->file_doctor->first() == null)
                        <div class="card text-center m-4 p-4">
                            <h5 class="m-4">No tiene exámenes previos</h5>
                        </div>
                    @endif
                </div>

            </div>
                
        </div>
    </div>  

@endsection

@section('scripts')
@endsection
