@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
@endsection

@section('title','Facturación')

@section('content')
    <form action="{{ route('checkout.imprimir_factura') }}" method="POST">
            @csrf 
        <div class="section-body py-3 row">

            <div class="section-body py-3 col-8 ml-4 ">
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
                                                <div class="col-2">
                                                        <span class="h6 h66">Paciente:</span>
                                                </div>
                                                <div class="col-10">
                                                    <input type="hidden" id="paciente_id" name="paciente_id" value="{{ $itinerary->person->id }}" >

                                                    <span id="dni" class="text">{{ $itinerary->person->dni }}</span>
                                                    <span id="name" class="text">{{ $itinerary->person->name }} {{ $itinerary->person->lastname }}</span>
                                                    <span id="phone" class="text">{{ $itinerary->person->phone }}</span><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <span class="h6 h66">Doctor:</span>
                                                </div>
                                                <div class="col-10">
                                                    
                                                    <span class="text">{{ $itinerary->employe->person->dni }}</span>
                                                    <span class="text">{{ $itinerary->employe->person->name }} {{ $itinerary->employe->person->lastname }}</span>
                                                    <span class="text">{{ $itinerary->employe->person->phone }}</span><br>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                    <div class="col-4">
                                                        <span class="h6 h66">Cancelado por:</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <span id="dni_c" class="text"></span>
                                                        <span id="name_c"></span>
                                                        <span id="lastname_c" class="text"></span>
                                                        <span id="phone_c"></span><br>
                                                    </div>

                                                
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-end">
                                                        <div class="row mt-1">
                                                            <div class="ml-2 col-4"> Paciente</div> <a class="btn btn-primary" id="paciente" name="paciente">
                                                            P
                                                            </a>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="ml-2 col-4"> Otro</div> <a  class="btn btn-primary"  data-toggle="modal" data-target="#otro">
                                                                O
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div><br><br>

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group multiselect_div">
                                                        <select id="single-selection" name="tipo_moneda" class="multiselect multiselect-custom" style="display: none;">
                                                            {{-- <option value="">moneda</option> --}}
                                                            @foreach ($tipo_moneda as $moneda)
                                                            <option value="{{ $moneda->id }}">{{ $moneda->name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                        <div class="form-group multiselect_div">
                                                            <select id="single-selection2" name="tipo_pago" class="multiselect multiselect-custom" style="display: none;">
                                                                {{-- <option value="">moneda</option> --}}
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
                                        <table class="table table-bordered table-hover">
                                                <tbody style="border-bottom: 1px solid #000">
                                                    {{-- <th class="text-center width35"></th> --}}
                                                    <th colspan="5" class="text-center">Nombre</th>
                                                    <th class="text-right" style="width: 4%">Costo</th>
                                                </tbody>

                                                <tbody style="border-bottom: 1px solid #000">
                                                    <th class="text-center width35"></th>
                                                    <th colspan="4">Consulta</th>
                                                    <td class="text-right" style="width: 1%">{{ $itinerary->employe->doctor->price }}</td>
                                                </tbody>
                                                           
                                                <tbody style="border-bottom: 1px solid #000">
                                                    <th class="text-center width35"></th>
                                                    <th colspan="4">Procedimiento</th>
                                                    <th class="text-right" style="width: 4%"></th>
                                                </tbody>
                                                
                                                <tbody >
                                                    @foreach ($procedure as $item)
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
                                                            <div class="text-muted">{{ $itinerary->surgery->typesurgeries->name }}</div>
                                                        </td>
                                                        <td class="text-right" style="width: 1%">{{ $itinerary->surgery->typesurgeries->cost }}</td>
                                                    </tr>
                                                </tbody>                                             
                                                <tr>
                                                    <th class="text-center width35"></th>
                                                    <td colspan="4" class="font600 text-right">Subtotal</td>
                                                    <td class="text-right" id="subtotal">{{ $total }}</td> 
                                                </tr>
                                                <tr class="bg-info text-light">
                                                    <th class="text-center width35"></th>
                                                    <td colspan="4" class="font700 text-right">Total a cancelar</td>
                                                    <td class="font700 text-right" id="costo_total">{{ $total }}</td>
                                                </tr>
                                            </table>

                                                {{-- <table class="table table-bordered table-hover">
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

                                                </tbody></table> --}}
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
            $('#phone_c').text(data.cliente.phone);

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