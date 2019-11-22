@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">
@endsection

@section('title','Facturación')

@section('content')
<div class="section-body py-3">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <form method="POST" action="">
                    <div class="card">
                        <div class="card-body row">
                        <div class="col-12">
                                <h5>Buscar Paciente </h5>
                        </div>
                            <div class="input-group mt-2 col-6">
                                <input id="dni" type="text" class="form-control" maxlength="8" placeholder="buscar paciente...">
                                <a id="search" class="btn btn-info"><i class="icon-magnifier"></i></a>
                            </div>
                            <div class="card-options col-4 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary"><i class="fe fe-plus" data-toggle="tooltip" title="" data-original-title="fe fe-plus"></i> agregar procedimiento</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <div class="section-body py-3">
            <div class="container">
                <div class="tab-content">
               
                     

                    <div class="tab-pane fade active show" id="Invoice-detail" role="tabpanel">
                        <div class="row clearfix">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-options">
                                            <a href="{{ route('checkout.factura') }}" class="btn btn-primary"><i class="si si-printer"></i>Generar factura</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row my-8">
                                            <div class="col-6">
                                                <p class="h4">Paciente</p>
                                                <address>
                                               <span id="dnii"> Documento de Identidad</span><br>
                                                <span id="name">Nombre</span><br>
                                               <span id="lastname">Apellido</span><br>
                                               <span id="phone"> Telefono</span><br>
                                                </address>
                                            </div>
                                            <div class="col-6 text-right">
                                                <p class="h4">Doctor</p>
                                                <address>
                                                    <span id="dniiD"> Documento de Identidad</span><br>
                                                    <span id="nameD">Nombre</span><br>
                                                    <span id="lastnameD">Apellido</span><br>
                                                    <span id="phoneD"> Telefono</span><br>
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
                                                        <p class="font600 mb-1" id="procedimiento">Logo Creation</p>
                                                    </td>
                                                    <td class="text-center">1</td>
                                                    <td class="text-right" id="cantidad"></td>
                                                    <td class="text-right" id="dni"></td>
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
    {{-- <script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>
    <script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
    <script src="{{ asset('assets\js\form\form-advanced.js') }}"></script> --}}

    <script>
               //Documento donde se insertara
               $( document ).ready(function() {
             
             //llamando funcion definida en el html (search)
                $("#search").click(function() {
                    var dni = $("#dni").val();  //asignando el valor que se ingresa en el campo
                    console.log(dni);           //mostrando en consola
                    ajax(dni);                  // enviando el valor a la funcion ajax(darle cualquier nombre)
                });
            
     

            // funcion que mando el valor que recibe a la ruta a la que se desea enviar
            function ajax(dni) {
                $.ajax({ 
                        url: "{{ route('checkout.patient') }}",   //definiendo ruta
                        type: "POST",                             //definiendo metodo
                        data: {
                            _token: "{{ csrf_token() }}",         //valor que se envia
                            dni: dni
                        }
                    })
                    .done(function(data) {                        //recibe lo que retorna el metodo en la ruta definida
                        console.log(data);
                        if (data[0] == 202) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Paciente no encontrado',
                                type: 'error',
                            })
                            // enabled();
                        }
                        if (data[0] == 201) {
                            Swal.fire({
                                title: 'Excelente!',
                                text:  'Paciente encontrado',
                                type:  'success',
                            })
                            disabled(data);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
                        }
                    })
                    .fail(function(data) {
                        console.log(data);
                    })
            }

            function disabled(data) {
            $('#dnii').text(data.person.dni); 
            $('#name').text(data.person.name);
            $('#lastname').text(data.person.lastname);
            $('#phone').text(data.person.phone);
            $('#dniiD').text(data.person.dni); 
            $('#nameD').text(data.person.name);
            $('#lastnameD').text(data.person.lastname);
            $('#phoneD').text(data.person.phone);

            $('#procedimiento').text(data.person.name);
            $('#cantidad').text(data.person.dni);
        }
            });

        

   
        </script>
    
@endsection