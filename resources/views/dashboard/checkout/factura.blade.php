@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
@endsection

@section('title','Proceso de facturación')

@section('content')
    <form action="{{ route('checkout.imprimir_factura') }}" method="POST">
            @csrf 
        <div class="section-body py-3 row">
            <div class="section-body py-3 col-10 ml-5 ">
                <div class="container">
                    <div class="tab-content">
                    <!-----------------------Campos ocultoss---------------------->
                    <input id="person_id" type="hidden" name="person_id" value="" >
                    <input type="hidden" name="factura" value="{{ $crear_factura->id }}" >
                    <!-------------------- fin de Campos ocultoss------------------>
                        <div class="tab-pane fade active show" id="Invoice-detail" role="tabpanel">
                            <div class="row clearfix">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body row my-8  pl-4">
                                            <div class="col-3"><h2>Factura</h2> </div>
                                            <div class="col-9 d-flex justify-content-end pr-3 pt-10" style="color:#000" >
                                                <span class="h6 h66 pt-0 pr-10">Fecha:</span><span class="text col-3" style="margin-bottom:50px"><i class="fa fa-calendar pl-20"></i> {{ $fecha }}</span><br>
                                            </div>                             
                                        </div>
                                        <div class="card-body mt-0 " style="top:-50px">
                                            <div class="row">
                                                <div class="col-3">
                                                    <span class="h6 h66"><i class="fa fa-user mr-2" style="font-size:18px"></i>Paciente:</span>
                                                </div>
                                                <input type="hidden" id="paciente_id" name="paciente_id" value="{{ $itinerary->person->id }}">
                                                <div class="col-3 pr-10">
                                                    <span id="dni" class="text form-control p-1 mt-0 text-left"><i class="fa fa-address-card"></i>&nbsp;&nbsp;{{ $itinerary->person->dni }}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span id="name" class="text form-control p-1 text-left"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $itinerary->person->name }} {{ $itinerary->person->lastname }}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span id="phone" class="text form-control p-1 text-left"><i class="fa fa-phone"></i>&nbsp;&nbsp;{{ $itinerary->person->phone }}</span><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <span class="h6 h66"><i class="fa fa-user-md mr-2" style="font-size:18px"></i>Medico tratante:</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text form-control p-1 text-left"><i class="fa fa-address-card"></i>&nbsp;&nbsp;{{ $itinerary->employe->person->dni }}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text form-control p-1 text-left"><i class="fa fa-user-md"></i>&nbsp;&nbsp;{{ $itinerary->employe->person->name }} {{ $itinerary->employe->person->lastname }}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="text form-control p-1 text-left"><i class="fa fa-phone"></i>&nbsp;&nbsp;{{ $itinerary->employe->person->phone }}</span><br>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-12 mt-2 d-flex justify-content-center">
                                                        <span class="h6 h66">Seleccione persona a pagar</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mt-2 d-flex justify-content-center">
                                                    <div class="col-6 d-flex justify-content-end" >
                                                            <a class="btn btn-boo " title="Paciente" style="color:#fff" id="paciente" name="paciente"> 
                                                                <i class="fa fa-user mr-2"></i> Paciente
                                                            </a>
                                                        </div>
                                                        <div class="col-6">
                                                                <a  class="btn btn-boo " title="Agregar cliente" style="color:#fff" data-toggle="modal" data-target="#otro"> 
                                                                <i class="fa fa-user-plus"></i> Otro cliente
                                                            </a>
                                                        </div>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-3 mt-2">
                                                    <span class="h6 h66"><i class="fa fa-shopping-cart mr-1" style="font-size:18px"></i> Pagado por:</span>
                                                </div>
                                                <div class="col-3 mt-2">
                                                    <span class="text form-control p-1"><i class="fa fa-address-card pl-1"></i>&nbsp;<span id="dni_c" class="text text-left"></span></span>
                                                </div>
                                                <div class="col-3 mt-2">
                                                    <span class="text form-control p-1"><i class="fa fa-user pl-1"></i>&nbsp;<span id="name_c" class="text text-left"></span><span id="lastname_c" class="text text-left"></span></span>
                                                </div>
                                                <div class="col-3 mt-2">
                                                    <span class="text form-control p-1"><i class="fa fa-phone pl-1"></i>&nbsp;<span id="phone_c" class="text text-left"></span></span>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-lg-6 col-md-6">
                                                    <span class="h6 h66">Tipo de moneda:</span>
                                                    <div class="form-group multiselect_div mt-2">
                                                        <select id="single-selection" name="tipo_moneda" class="multiselect multiselect-custom" style="display: none;">
                                                            @foreach ($tipo_moneda as $moneda)
                                                            <option value="{{ $moneda->id }}">{{ $moneda->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <span class="h6 h66">Tipo de pago:</span>
                                                    <div class="form-group multiselect_div mt-2">
                                                        <select id="single-selection2" name="tipo_pago" class="multiselect multiselect-custom" style="display: none;">
                                                            @foreach ($tipo_pago as $pago)
                                                            <option value="{{ $pago->id }}">{{ $pago->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
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
                                                <table class="table table-bordered table-hover mt-5">
                                                    <tbody style="border-bottom: 1px solid #000">
                                                        {{-- <th class="text-center width35"></th> --}}
                                                        <td colspan="5" class="text-left pl-4" style="font-weight:bold; ">DESCRIPCION</td>
                                                        <td class="text-right" style="width: 4%; font-weight:bold">COSTO</td>
                                                    </tbody>
                                                    @if($itinerary->employe->doctor != null)
                                                        <tbody style="border-bottom: 1px solid #000">
                                                            {{-- <td class="text-center width35"></td> --}}
                                                            <td colspan="5" class="text-left pl-4">Consulta Médica</td>
                                                            <td class="text-right" style="width: 1%">{{ $itinerary->employe->doctor->price }}</td>
                                                        </tbody>
                                                    @endif
                                                    @if($procedure != 0)
                                                    {{-- <tbody style="border-bottom: 1px solid #000">
                                                        <td class="text-center width35"></td>
                                                        <td colspan="4">Procedimientos</td>
                                                        <td class="text-right" style="width: 4%"></td>
                                                    </tbody> --}}
                                                    <tbody>
                                                        @foreach ($procedure as $item)
                                                        <tr>
                                                            {{-- <td class="text-center width35"></td> --}}
                                                            <td colspan="5" class="text-left pl-4">
                                                                <div class="text-muted">Procedimiento {{ $item->name }}</div>
                                                            </td>
                                                        
                                                            <td class="text-right" style="width: 1%">{{ $item->price }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody> 
                                                    @endif
                                                    @if($itinerary->surgery != null)
                                                    {{-- <tbody style="border-bottom: 1px solid #000">
                                                        <th class="text-center width35"></th>
                                                        <th colspan="4">Cirugía</th>
                                                        <th class="text-right" style="width: 4%"></th>
                                                    </tbody> --}}
                                                    <tbody>
                                                        <tr>
                                                            {{-- <td class="text-center width35"></td> --}}
                                                            <td colspan="5" class="text-left pl-4">
                                                                <div class="text-muted">Cirugía {{ $itinerary->surgery->typesurgeries->name }}</div>
                                                            </td>
                                                            <td class="text-right" style="width: 1%">{{ $itinerary->surgery->typesurgeries->cost }}</td>
                                                        </tr>
                                                    </tbody> 
                                                    @endif
                                                    <tr>
                                                        {{-- <th class="text-center width35"></th> --}}
                                                        <td colspan="5" class="font600 text-right">Subtotal</td>
                                                        <td class="text-right" id="subtotal">{{ $total }}</td> 
                                                    </tr>
                                                    <tr class="bg-boo text-light">
                                                        {{-- <th class="text-center width35"></th> --}}
                                                        <td colspan="5" class="font700 text-right ">Total a cancelar</td>
                                                        <td class="font700 text-right" id="costo_total">{{ $total }}</td>
                                                    </tr>
                                                </table>
                                            </div><br>
                                            <div class="row d-flex justify-content-end">

                                                <a type="submit" class="btn btn-boo pr-5 pl-5 mr-3" target="_blank"> <i class="fa fa-print"> </i> Imprimir</a>

                                                <button target="_blank"type="submit" class="btn btn-boo pr-5 pl-5 mr-3"> <i class="fa fa-print"> </i> Imprimir</button>

                                                <a type="submit" class="btn btn-boo pr-5 pl-5 mr-3" target="_blank"> <i class="fa fa-print"> </i> Imprimir</a>
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
    </form>
    <!--modal-->
    <div class="modal fade" id="otro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pr-5 pl-5 pt-4">
                    <form>
                        <div class="form-group">
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                </div>
                                <div class="input-group-prepend">
                                    <select id="tipo_dniC"  name="type_dni" type="text" placeholder="Nombre" class="form-control" value="">
                                        <option value="V">V</option>
                                        <option value="E">E</option>
                                        <option value="J">J</option>
                                    </select>
                                </div>
                                <input id="dniC" value="" type="text" class="form-control mr-2" maxlength="8" placeholder="Documento de Identidad" formControlName="dni" name="dni">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <input id="nameC"  name="name" type="text" placeholder="Nombre" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <input id="lastnameC" name="lastname" type="text" placeholder="Apellido" class="form-control input-block" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <input id="phoneC" name="phone" type="text" placeholder="Telefono" class="form-control input-block" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <input id="emailC" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" formControlName="email" name="email" type="email" placeholder="email" class="form-control input-block" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <textarea id="direccionC" name="address" type="text" placeholder="direccion" class="form-control input-block" value=""></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                <a class="btn btn-primary" id="registrar">Registrar</a>
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
        $('#multiselect1, #multiselect2, #single-selection, #single-selection2, #multiselect5, #multiselect6').multiselect({
        maxHeight: 300
    });
        </script>
        <script>
    $(document).ready(function(){
        // ==================== ejecuta cuando se clikea el boton de registrar otro =====================
        $("#registrar").click(function() {
            var tipo_dni = $("#tipo_dniC").val(); 
            var dni = $("#dniC").val(); 
            var name =  $("#nameC").val();
            var lastname = $("#lastnameC").val();
            var phone = $("#phoneC").val();
            var email = $("#emailC").val();
            var address = $("#direccionC").val();
            registrar_cliente(tipo_dni, dni, name, lastname, phone, email, address);                          // enviando el valor a la funcion ajax(darle cualquier nombre)
        }); //fin de la funcion clikea
        //=================== funcion para registrar al cliente================
        function registrar_cliente(tipo_dni, dni, name, lastname, phone, email, address) {
                $.ajax({ 
                    url: "{{ route('checkout.person') }}",  
                    type: "POST",                            
                    data: {
                        _token: "{{ csrf_token() }}",        
                        type_dni: tipo_dni,
                        dni:dni,
                        name:name,
                        lastname:lastname,
                        phone:phone,
                        email:email,
                        address:address,                           
                    }
                })
                .done(function(data) {                        //recibe lo que retorna el metodo en la ruta definida
                    console.log('esto',data);
                    if (data[0] == 201) {                       
                        Swal.fire({
                            title: 'Excelente!',
                            text:  'Registro satisfactorio',
                            type:  'success',
                        })
                        factura_cliente(data);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
                    }
                })
                .fail(function(data) {
                    console.log(data);
                })
        } // fin de la funcion que busca datos del paciente/doctor/procedimientos
        //================================== para porder mostrar en el documento html ==========================
        function factura_cliente(data) {
            console.log('ken',data);
            $('#dni_c').text(data.cliente.dni); 
            $('#name_c').text(data.cliente.name);
            $('#lastname_c').text(data.cliente.lastname);
            $('#phone_c').text(data.cliente.phone)
            $('#person_id').val(data.cliente.id);
            console.log(data.cliente.id)
        } // fin de la funcion que muestra datos en el html
        // ==================== ejecuta el que va a cancelar es el paciente =====================
        $("#paciente").click(function() {
            console.log('hola')
            var dni = $("#dni").text(); 
            var name = $("#name").text(); 
            var phone = $("#phone").text(); 
            console.log(dni, name, phone)
            var person_id = $('#paciente_id').val();
            console.log('hola',person_id)
            $('#person_id').val(person_id);
            $('#dni_c').text(dni);
            $('#name_c').text(name);
            $('#phone_c').text(phone); 
            $('#person_id').val(id); 
            // }
        }); //fin de la funcion clikea
    }); //fin del documento
        </script>
@endsection