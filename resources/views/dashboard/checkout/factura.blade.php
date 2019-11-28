@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
@endsection

@section('title','Facturación')

@section('content')
<div class="section-body py-3 row">
 

        <div class="section-body py-3 col-8 ml-4 ">
            <div class="container">
                <div class="tab-content">
               

                    <div class="tab-pane fade active show" id="Invoice-detail" role="tabpanel">
                        <div class="row clearfix">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header row">
                                        <div class="col-8">
                                                <img src="{{ asset('assets\images\logo_factura.png') }}" class="w-100">
                                        </div>
                                        <div class="col-3 text-right"><p class="h66 text-right">#AB0017</p></div>
                                      
                                    </div>

                                    <div class="row my-8 pr4 pl-4 ">
                                        <div class="col-12"> <span class="text"> Rif:</span></div>
                                        <div class="col-12"> <span class="text">Dirección:</span></div>
                                        <div class="col-12"> <span class="text">Telefono:</span></div>

                                     
                                    </div>
                                    <div class="card-body mt-0">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="h6 h66">Paciente</p>
                                                    <span class="text">{{ $itinerary->person->dni }}</span><br>
                                                    <span class="text">{{ $itinerary->person->name }} {{ $itinerary->person->lastname }}</span><br>
                                                    <span class="text">{{ $itinerary->person->phone }}</span><br>
                                            </div>
                                            <div class="col-6 text-right">
                                                <p class="h6 h66">Doctor</p>
                                                <address>
                                                    <span class="text">{{ $itinerary->employe->person->dni }}</span><br>
                                                    <span class="text">{{ $itinerary->employe->person->name }} {{ $itinerary->employe->person->lastname }}</span><br>
                                                    <span class="text">{{ $itinerary->employe->person->phone }}</span><br>
                                                </address>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group multiselect_div">
                                                    <select id="single-selection" name="single_selection" class="multiselect multiselect-custom" style="display: none;">
                                                        {{-- <option value="">moneda</option> --}}
                                                        @foreach ($tipo_moneda as $moneda)
                                                        <option value="{{ $moneda->id }}">{{ $moneda->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                    <div class="form-group multiselect_div">
                                                        <select id="single-selection" name="single_selection" class="multiselect multiselect-custom" style="display: none;">
                                                            {{-- <option value="">moneda</option> --}}
                                                            @foreach ($tipo_pago as $pago)
                                                            <option value="{{ $pago->id }}">{{ $pago->name }}</option>
                                                            @endforeach
                                                        </select>
    
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-4 col-md-4">
                                                    <div class="form-group multiselect_div">
                                                        <select id="single-selection" name="single_selection" class="multiselect multiselect-custom" style="display: none;">
                                                      
                                                            <option id="paciente" value="{{ $itinerary->person->id }}">Paciente</option>
                                                            <option type="button" id="cliente"  data-toggle="modal" data-target="#exampleModal" >Otro cliente</option>
                                                         
                                                        </select>
                                                    </div>
                                                </div> --}}
                                        </div>

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      ...
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                      <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>

                                        <div class="table-responsive push">
                                        <div></div>
                                            <table class="table table-bordered table-hover">
                                                <tbody><tr>
                                                    <th class="text-center width35"></th>
                                                    <th colspan="4">Descripción</th>
                                                    <th class="text-right" style="width: 1%">Costo</th>
                                                </tr> 
                                                @foreach ($procedure as $item)
                                                    
                                               
                                                <tr >
                                                    <td class="text-center width35"></td>
                                                    <td colspan="4">
                                                        <div class="text-muted">{{ $item->name }}</div>
                                                    </td>
                                                   
                                                    <td class="text-right" style="width: 1%">{{ $item->price }}</td>
                                                </tr>
                                                @endforeach
                                           |    <tr>
                                                    <th class="text-center width35"></th>
                                                    <td colspan="4" class="font600 text-right">Subtotal</td>
                                                    <td class="text-right" id="subtotal">0,00</td>
                                                </tr>
                                                <tr class="bg-info text-light">
                                                    <th class="text-center width35"></th>
                                                    <td colspan="4" class="font700 text-right">Total a cancelar</td>
                                                    <td class="font700 text-right" id="costo_total">0,00</td>
                                                </tr>

                                            </tbody></table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                </div>                
            </div>
        </div>

    </div>

@endsection

@section('scripts')
<script src="{{ asset('assets\plugins\bootstrap-colorpicker\js\bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
    <script>
             $('#multiselect1, #multiselect2, #single-selection, #multiselect5, #multiselect6').multiselect({
        maxHeight: 300
    });
        </script>
@endsection