@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
@endsection

@section('title','Facturación')

@section('content')
<div class="section-body py-3">
 

        <div class="section-body py-3">
            <div class="container">
                <div class="tab-content">
               
                     

                    <div class="tab-pane fade active show" id="Invoice-detail" role="tabpanel">
                        <div class="row clearfix">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="col-8 d-flex justify-content-end">hola</div>
                                        <div class="col-3 d-flex justify-content-end">  <h3 class="card-title">#AB0017</h3></div>
                                      
                                    </div>
                                    <div class="card-body">
                                        <div class="row my-8">
                                            <div class="col-6">
                                                <p class="h4">Paciente</p>
                                                <address>
                                                V 26891162<br>
                                                Kenwherly hernandez almario<br>
                                                las velas yaritagua edo. yaracuy<br>
                                                04247734195
                                                </address>
                                            </div>
                                            <div class="col-6 text-right">
                                                <p class="h4">Doctor</p>
                                                <address>
                                                V 18263839<br>
                                                Ysbelia Cariazo Yepez<br>
                                                La moran<br>
                                                04163570943
                                                </address>
                                            </div>
                                        </div>
                                        <div class="table-responsive push">
                                            <table class="table table-bordered table-hover">
                                                <tbody><tr>
                                                    <th class="text-center width35"></th>
                                                    <th>Procedimiento</th>
                                                    <th class="text-center" style="width: 1%">cantidad</th>
                                                    <th class="text-right" style="width: 1%">Unidad</th>
                                                    <th class="text-right" style="width: 1%">Costo total</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>
                                                        <p class="font600 mb-1">Logo Creation</p>
                                                        <div class="text-muted">Logo and business cards design</div>
                                                    </td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-right">$1.800,00</td>
                                                    <td class="text-right">$1.800,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td>
                                                        <p class="font600 mb-1">Online Store Design &amp; Development</p>
                                                        <div class="text-muted">Design/Development for all popular modern browsers</div>
                                                    </td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-right">$20.000,00</td>
                                                    <td class="text-right">$20.000,00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td>
                                                        <p class="font600 mb-1">App Design</p>
                                                        <div class="text-muted">Promotional mobile application</div>
                                                    </td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-right">$3.200,00</td>
                                                    <td class="text-right">$3.200,00</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="font600 text-right">Subtotal</td>
                                                    <td class="text-right">$25.000,00</td>
                                                </tr>
                                                <tr class="bg-info text-light">
                                                    <td colspan="4" class="font700 text-right">Total a cancelar</td>
                                                    <td class="font700 text-right">$30.000,00</td>
                                                </tr>
                                            </tbody></table>
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
    <script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets\js\table\datatable.js') }}"></script>
@endsection