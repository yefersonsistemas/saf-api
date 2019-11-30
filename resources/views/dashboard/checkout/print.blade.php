<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}"> --}}
    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}"> --}}
</head>
<body>
    <div id="app">
           

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
                                                    {{-- <img src="{{ asset('assets\images\logo_factura.png') }}" class="w-100 " style="width:200px"> --}}
                                            </div>
                                            <div class="col-3 text-right"><p class="h66 text-right">#AB0017</p></div>
                                        
                                        </div>

                                        <!--Datos de la empresa-->
                                        <div class="row my-8 pr4 pl-4 ">
                                            <div class="col-12"> <span class="text"> Rif:</span></div>
                                            <div class="col-12"> <span class="text">Dirección:</span></div>
                                            <div class="col-12"> <span class="text">Telefono:</span></div>
                                        </div><br>

                                        <div class="card-body mt-0">
                                            <div class="row">
                                                <div class="col-2">
                                                        <span class="h6 h66">Paciente:</span>
                                                </div>
                                                <div class="col-8">
                                                    <span id="dni" class="text">{{ $todos->patient->type_dni }}</span>
                                                    <span id="dni" class="text">{{ $todos->patient->dni }}</span>
                                                    <span id="name" class="text">{{ $todos->patient->name }} {{ $todos->patient->lastname }}</span>
                                                    <span id="phone" class="text">{{ $todos->patient->phone }}</span><br> 
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-2">
                                                    <span class="h6 h66">Doctor:</span>
                                                </div>
                                                <div class="col-10">
                                                    <span class="text">{{ $todos->employe->person->type_dni }}</span>
                                                    <span class="text">{{ $todos->employe->person->dni }}</span>
                                                    <span class="text">{{ $todos->employe->person->name }} {{ $todos->employe->person->lastname }}</span>
                                                    <span class="text">{{ $todos->employe->person->phone }}</span><br>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-4">
                                                    <span class="h6 h66">Cancelado por:</span>
                                                </div>
                                                <div class="col-10">
                                                    <span class="text">{{ $todos->person->type_dni }}</span>
                                                    <span class="text">{{ $todos->person->dni }}</span>
                                                    <span class="text">{{ $todos->person->name }} {{ $todos->person->lastname }}</span>
                                                    <span class="text">{{ $todos->person->phone }}</span><br>
                                                </div>                                                
                                            </div>

                                            <div class="table-responsive push">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <th colspan="12" style="with:40px" class="text-center">Nombre</th>
                                                        <th colspan="12" class="text-center" >Costo</th>
                                                    </thead>       
                                                    <tbody style="border-bottom: 1px solid #000 row ">
                                                        <th class="text-center width35"></th>
                                                        <th colspan="4">Consulta</th>
                                                        <td class="text-right" style="width: 1%">{{ $todos->employe->doctor->price }}</td>
                                                    </tbody>                                                
                                                </table>
                                                <table>
                                                        <tbody style="border-bottom: 1px solid #000 row ">
                                                            <th class="text-center width35"></th>
                                                            <th colspan="4">Consulta</th>
                                                            <td class="text-right" style="width: 1%">{{ $todos->employe->doctor->price }}</td>
                                                        </tbody>

                                                           
                                                        <tbody style="border-bottom: 1px solid #000">
                                                            <th class="text-center width35"></th>
                                                            <th colspan="4">Procedimiento</th>
                                                            <th class="text-right" style="width: 4%"></th>
                                                        </tbody>
                                                        
                                                        <tbody ><br><br>
                                                            @foreach ($todos->procedure as $item)
                                                            <tr>
                                                                <td class="text-center width35"></td>
                                                                <td colspan="4">
                                                                    <div class="text-muted">{{ $item->name }}</div>
                                                                </td>
                                                            
                                                                <td class="text-right" style="width: 1%">{{ $item->price }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody> 

                                                        <tbody style="border-bottom: 1px solid #000">
                                                            <th class="text-center width35"></th>
                                                            <th colspan="4">Cirugía</th>
                                                            <th class="text-right" style="width: 4%"></th>
                                                        </tbody>
                                                    
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center width35"></td>
                                                                <td colspan="4">
                                                                    <div class="text-muted">{{ $cirugia->surgery->typesurgeries->name }}</div>
                                                                </td>
                                                                <td class="text-right" style="width: 1%">{{ $cirugia->surgery->typesurgeries->cost }}</td>
                                                            </tr>
                                                        </tbody>                                             
                                                        <tr>
                                                            <th class="text-center width35"></th>
                                                            <td colspan="4" class="font600 text-right">Subtotal</td>
                                                            {{-- <td class="text-right" id="subtotal">{{ $total }}</td>  --}}
                                                        </tr>
                                                        
                                                        <tr class="bg-info text-light">
                                                            <th class="text-center width35"></th>
                                                            <td colspan="4" class="font700 text-right">Total a cancelar</td>
                                                            {{-- <td class="font700 text-right" id="costo_total">{{ $total }}</td> --}}
                                                        </tr>
                                            </table>

                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>                
                </div>
            </div>

        </div>
 


        {{-- <main class="py-4">
            @yield('content')
        </main> --}}
        @section('scripts')
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
@endsection
    </div>
</body>

</html>


