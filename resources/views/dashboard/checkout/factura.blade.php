@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('facturacion','active')
@section('outrol','d-block')
@section('dire','d-none')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
@endsection

<style>
    .cursor{
        cursor: pointer;
    }
</style>

@section('title','Proceso de facturación')

@section('content')
    <form action="{{ route('checkout.imprimir_factura') }}" method="POST" target="_blank">
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
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body row my-8  pl-4">
                                            <div class="col-lg-4 col-md-4 col-sm-12"><h2>Factura</h2> </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 d-flex justify-content-end pr-3 pt-10" style="color:#000" >
                                                <span class="h6 h66 pt-0 pr-10">Fecha:</span><span class="text col-lg-4 col-md-7 col-sm-12" style="margin-bottom:50px"><i class="fa fa-calendar pl-20"></i> {{ $fecha }}</span><br>
                                            </div>
                                        </div>
                                        <div class="card-body mt-0 " style="top:-50px">
                                        <!--Paciente-->
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 col-sm-12 mb-2">
                                                    <span class="h6 h66"><i class="fa fa-user mr-2" style="font-size:18px"></i>Paciente:</span>
                                                </div>
                                                <input type="hidden" id="paciente_id" name="paciente_id" value="{{ $itinerary->person->id }}">
                                                <div class="col-lg-3 col-md-4 col-sm-12 pr-10 mb-2">
                                                    <span id="dni" class="text form-control p-1 mt-0 text-left"><i class="fa fa-address-card"></i>&nbsp;&nbsp;{{ $itinerary->person->dni }}</span>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12 mb-2">
                                                    <span id="name" class="text form-control p-1 text-left"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $itinerary->person->name }} {{ $itinerary->person->lastname }}</span>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12 mb-2">
                                                    <span id="phone" class="text form-control p-1 text-left"><i class="fa fa-phone"></i>&nbsp;&nbsp;{{ $itinerary->person->phone }}</span><br>
                                                </div>
                                            </div>

                                        <!--Medico tratante-->
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 col-sm-12 mb-2">
                                                    <span class="h6 h66"><i class="fa fa-user-md mr-2" style="font-size:18px"></i>Medico tratante:</span>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12 pr-10 mb-2">
                                                    <span class="text form-control p-1 text-left"><i class="fa fa-address-card"></i>&nbsp;&nbsp;{{ $itinerary->employe->person->dni }}</span>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12 pr-10 mb-2">
                                                    <span class="text form-control p-1 text-left"><i class="fa fa-user-md"></i>&nbsp;&nbsp;{{ $itinerary->employe->person->name }} {{ $itinerary->employe->person->lastname }}</span>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12 pr-10 mb-2">
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
                                                        <a class="btn btn-boo d-block cursor" style="color:#fff" id="paciente" name="paciente">
                                                            <i class="fa fa-user mr-2"></i> Paciente
                                                        </a>
                                                    </div>
                                                    <div class="col-6 d-flex justify-content-start">
                                                        <a  class="btn btn-boo d-block cursor" style="color:#fff" data-toggle="modal" data-target="#otro">
                                                            <i class="fa fa-user-plus"></i> Otro cliente
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <!--Persona a cancelar-->
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 col-sm-12 mb-2 mt-2">
                                                    <span class="h6 h66"><i class="fa fa-shopping-cart mr-1" style="font-size:18px"></i> Pagado por:</span>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12 mb-2 mt-2">
                                                    <input type="hidden" id="dni_C" val="">
                                                    <span class="text form-control p-1"><i class="fa fa-address-card pl-1"></i>&nbsp;<span id="dni_c" class="text text-left"></span></span>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12 mb-2 mt-2">
                                                    <span class="text form-control p-1"><i class="fa fa-user pl-1"></i>&nbsp;<span id="name_c" class="text text-left"></span>&nbsp;<span id="lastname_c" class="text text-left"></span></span>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12 mb-2 mt-2">
                                                    <span class="text form-control p-1"><i class="fa fa-phone pl-1"></i>&nbsp;<span id="phone_c" class="text text-left"></span></span>
                                                </div>
                                            </div>

                                            <!--tipo de moneda-->
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
                                                <!--tipo de pago-->
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

                                            <!--Modal-->
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
                                                <table class="table table-bordered table-hover mt-5">
                                                    <tbody style="border-bottom: 1px solid #000">
                                                        <td colspan="5" class="text-left pl-4" style="font-weight:bold; ">DESCRIPCION</td>
                                                        <td class="text-right" style="width: 4%; font-weight:bold">COSTO</td>
                                                    </tbody>
                                                    {{-- @if($itinerary->employe->doctor != null)
                                                        <tbody style="border-bottom: 1px solid #000">
                                                            <td colspan="5" class="text-left pl-4">Consulta Médica</td>
                                                            <td class="text-right" style="width: 1%">{{ number_format($itinerary->employe->doctor->price,2) }}</td>
                                                        </tbody>
                                                    @endif --}}
                                                    @if($procedure != 0)
                                                    <tbody>
                                                        @foreach ($procedure as $item)
                                                            @if($item->name == 'Consulta médica')
                                                                <tr>
                                                                    <td colspan="5" class="text-left pl-4">
                                                                        <div class="text-muted">{{ $item->name }}</div>
                                                                    </td>
                                                                    <td class="text-right" style="width: 1%">{{ number_format($itinerary->employe->doctor->price,2) }}</td>
                                                                </tr>
                                                            @else
                                                            {{-- @if($item->name == 'Consulta médica') --}}
                                                                <tr>
                                                                    <td colspan="5" class="text-left pl-4">
                                                                        <div class="text-muted">{{ $item->name }}</div>
                                                                    </td>
                                                                    <td class="text-right" style="width: 1%">{{ number_format($item->price,2) }}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                    @endif
                                                    @if($itinerary->surgeryR != null)
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="5" class="text-left pl-4">
                                                                <div class="text-muted">Cirugía {{ $itinerary->surgeryR->name }}</div>
                                                            </td>
                                                            <td class="text-right" style="width: 1%">{{ number_format($itinerary->surgeryR->cost, 2) }}</td>
                                                        </tr>
                                                    </tbody>
                                                    @endif
                                                    <tr>
                                                        <td colspan="5" class="font600 text-right">Subtotal</td>
                                                        <td class="text-right" id="subtotal">{{ number_format($total,2) }}</td>
                                                    </tr>
                                                    <tr class="bg-boo text-light">
                                                        <td colspan="5" class="font700 text-right ">Total a cancelar</td>
                                                        <td class="font700 text-right" id="costo_total">{{ number_format($total,2) }}</td>
                                                    </tr>
                                                </table>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-6 d-flex justify-content-end">
                                                    {{-- <button disabled type="submit" class="btn btn-boo pr-5 pl-5 mr-3" id="deshabilitado"><i class="fa fa-print"> </i> Imprimir</button> --}}
                                                    <input id="deshabilidato" disabled class="btn btn-boo pr-5 pl-5 mr-3" type="submit" value="Imprimir" />
                                                </div>
                                                <div class="col-6 d-flex justify-content-start">
                                                    <a href="{{route('checkout.index')}}" class="btn btn-boo pr-5 pl-5 mr-3">Salir</a>
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
        </div>
    </form>

    <!--modal-->
    <div class="modal fade" id="otro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog rowwww" role="document">
            <div class="modal-content">
                <div class="modal-header p-2" style="background-color: #00506b; color: #fff;">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Registrar cliente</h5>
                    <button type="button" class="btn btn-azuloscuro" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body pr-5 pl-5 pt-4">
                    <form >

                        <div class="form-group d-flex flex-row  align-items-center">
                            <div class="input-group">
                                <div class="input-group-prepend bg-white">
                                    <span class="input-group-text btn-turquesa"><i class="fa fa-id-card"></i></span>
                                </div>
                                <div class="input-group-prepend">
                                    <select name="type_dni" id="type_dni" class="custom-select input-group-text bg-white">
                                        <option value="">...</option>
                                        <option value="N">N</option>
                                        <option value="E">E</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control mr-2" id="buscar_dni" name="dni" maxlength="9" placeholder="Buscar cédula cliente existente" value="">
                                <input type="hidden" name="newPerson" >
                                <a id="buscar" class="btn btn-azuloscuro text-white "><i class="fa fa-search"></i></a>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                </div>
                                <div class="input-group-prepend">
                                    <select id="tipo_dniC" disabled  name="type_dni" type="text" placeholder="Nombre" class="form-control" value="" required>
                                        <option value="N">N</option>
                                        <option value="E">E</option>
                                    </select>
                                </div>
                                <input id="dniC" disabled required value="" type="text" class="form-control mr-2" maxlength="8" minlength="3" placeholder="Documento de Identidad" formControlName="dni" name="dni">
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <div class="col">
                                <input id="nameC" disabled required name="name" type="text" placeholder="Nombre" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <input id="lastnameC" disabled required name="lastname" type="text" placeholder="Apellido" class="form-control input-block" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <input id="phoneC" disabled name="phone" type="text" placeholder="Telefono" class="form-control input-block" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <input id="emailC" disabled pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" formControlName="email" name="email" type="email" placeholder="email" class="form-control input-block" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <textarea id="direccionC" disabled required name="address" type="text" placeholder="direccion" class="form-control input-block" value=""></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="agregar_agregar">
                    <a class="btn btn-secondary text-white" data-dismiss="modal">Cerrar</a>
                    <a class="btn btn-azuloscuro text-white" data-dismiss="modal" id="registrar">Registrar</a>
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

    {{-- SCRIPT PARA MENSAJE CON BOTON HACIA ATRAS DEL NAVEGADOR --}}
<script>
    var submitted = false;

     $(document).ready(function() {
       $("form").submit(function() {
         submitted = true;
       });

       window.onbeforeunload = function () {
         if (!submitted) {
           return 'Do you really want to leave the page?';
         }
       }
     });
    </script>
    {{--FIN SCRIPT PARA MENSAJE CON BOTON HACIA ATRAS DEL NAVEGADOR --}}

    <script>
        $('#multiselect1, #multiselect2, #single-selection, #single-selection2, #multiselect5, #multiselect6').multiselect({
        maxHeight: 300
    });
        </script>
        <script>
//             $(document).ready(function(){
//      $('input[type="submit"]').attr('disabled','disabled');
//      $('input[type="text"]').keypress(function(){
//             if($(this).val() != ''){
//                $('input[type="submit"]').removeAttr('disabled');
//             }
//      });
//  });




    $(document).ready(function(){
        $('input[type="submit"]').attr('disabled','disabled');
        function financial(x) {
            return Number.parseFloat(x).toFixed(2);
        }


        // INICIO DE BUSCAR PACIENTE A FACTURAR
        $("#buscar").click(function() {
            var type_dni = $("#type_dni").val();
            var dni = $("#buscar_dni").val();
            if(type_dni == '' || dni ==  '' || dni.length < 7){
                Swal.fire({
                    title: 'Datos incompletos.!',
                    type:'info',
                    text: 'Click OK para continuar!',
                    allowOutsideClick:false,
                });
            }else{

            buscar(type_dni, dni);
            }
        });

        function buscar(type_dni, dni) {
            $.ajax({
                url: "{{ route('search.patient') }}",
                type: "POST",
                data: {
                _token: "{{ csrf_token() }}",
                type_dni:type_dni,
                dni:dni,
                }
            })
            .done(function(data) {
                console.log('recibido',data);
                if (data[0] == 202) {
                    Swal.fire({
                        title: 'Persona no encontrada.!',
                        type:'info',
                        text: 'Click OK para continuar!',
                        allowOutsideClick:false,
                    })
                    enabled(); //desabllitar inputs
                }
                if (data[0] == 201) {
                    Swal.fire({
                        title: 'Excelente!',
                        text: 'Paciente encontrado',
                        type: 'success',
                        allowOutsideClick:false,
                    })
                    mostrar_persona(data.person);
                }
                                      //recibe lo que retorna el metodo en la ruta definida
            })
            .fail(function(data) {
                console.log(data);
            })
        }

        //===========desabilitando inputs en el modal de registrar otro cliente=========
        function enabled(){
        $('#nameC').val(' ');
        $('#lastnameC').val(' ');
        $('#emailC').val(' ');
        $('#direccionC').val(' ');
        $('#phoneC').val(' ');

        $('#nameC').removeAttr('disabled');
        $('#lastnameC').removeAttr('disabled');
        $('#emailC').removeAttr('disabled');
        $('#direccionC').removeAttr('disabled');
        $('#phoneC').removeAttr('disabled');


        $('#agregar_agregar').html(`<a class="btn btn-secondary text-white" data-dismiss="modal">Cerrar</a>
                                    <a class="btn btn-azuloscuro text-white" data-dismiss="modal" id="registrar">Registrar</a>`);
                                    

        $("#registrar").click(function() {

            console.log('kenwherly')
            var tipo_dni = $("#type_dni").val();
            var dni = $("#buscar_dni").val();
            var name =  $("#nameC").val();
            var lastname = $("#lastnameC").val();
            var phone = $("#phoneC").val();
            var email = $("#emailC").val();
            var address = $("#direccionC").val();

            console.log(name)
            if(phone == ''){ phone = null; }
            if(email == ''){ email=null;   }

            console.log('cedule',dni.length);

            if(tipo_dni == '' || dni == '' || dni.length < 7 || dni.length > 9 ){
                if(tipo_dni == '' || dni == '' || dni.length < 7 || dni.length > 9 || name == '' || lastname == '' || address == ''){

                    Swal.fire({
                    title: 'Datos incompletos',
                    text: "Click OK para continuar!!",
                    type: 'error',
                    allowOutsideClick:false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '<a href="#otro" style="color:#fff" data-toggle="modal">OK</a>'
                    }).then((result) => {
                        if (result.value) {
                        }
                    })
                }else{
                    Swal.fire({
                    title: 'Documento de identidad incompleto',
                    text: "Click OK para continuar!!",
                    type: 'error',
                    allowOutsideClick:false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '<a href="#otro" style="color:#fff" data-toggle="modal">OK</a>'
                    }).then((result) => {
                        if (result.value) {
                        }
                    })
                }
            }else{
                registrar_cliente(tipo_dni, dni, name, lastname, phone, email, address);
            }
        });
        }

        function mostrar_persona(data) {

        $('#agregar_agregar').html(`<a class="btn btn-secondary text-white" data-dismiss="modal">Cerrar</a>
                                    <a class="btn btn-azuloscuro text-white" data-dismiss="modal" id="agregarCliente">Agregar</a>`);

        $('#nameC').val(data.name);
        $('#lastnameC').val(data.lastname);
        $('#emailC').val(data.email);
        $('#direccionC').val(data.address);
        $('#phoneC').val(data.phone);
        $('#person_id').val(data.id);

        $("#agregarCliente").click(function() {

            var dni = $("#buscar_dni").val();
            var name =  $("#nameC").val();
            var lastname = $("#lastnameC").val();
            var phone = $("#phoneC").val();

            $('#dni_c').text(dni);
            $('#name_c').text(name);
            $('#lastname_c').text(lastname);
            $('#phone_c').text(phone)

            $("input[type=submit]").removeAttr("disabled");

        });

    }

        // ==================== ejecuta cuando se clikea el boton de registrar otro =====================
        $("#registrar").click(function() {

            console.log('kenwherly')
            var tipo_dni = $("#type_dni").val();
            var dni = $("#buscar_dni").val();
            var name =  $("#nameC").val();
            var lastname = $("#lastnameC").val();
            var phone = $("#phoneC").val();
            var email = $("#emailC").val();
            var address = $("#direccionC").val();

            console.log(name)
            if(phone == ''){ phone = null; }
            if(email == ''){ email=null;   }

            console.log('cedule',dni.length);

        if(tipo_dni == '' || dni == '' || dni.length < 7 || dni.length > 9 ){
            if(tipo_dni == '' || dni == '' || dni.length < 7 || dni.length > 9 || name == '' || lastname == '' || address == ''){

                Swal.fire({
                title: 'Datos incompletos',
                text: "Click OK para continuar!!",
                type: 'error',
                allowOutsideClick:false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: '<a href="#otro" style="color:#fff" data-toggle="modal">OK</a>'
                }).then((result) => {
                    if (result.value) {
                    }
                })
            }else{
                Swal.fire({
                title: 'Documento de identidad incompleto',
                text: "Click OK para continuar!!",
                type: 'error',
                allowOutsideClick:false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: '<a href="#otro" style="color:#fff" data-toggle="modal">OK</a>'
                }).then((result) => {
                    if (result.value) {
                    }
                })
            }
        }else{
            registrar_cliente(tipo_dni, dni, name, lastname, phone, email, address);
        }
        }); //fin de la funcion clikea

        //=================== funcion para registrar al cliente================
        function registrar_cliente(tipo_dni, dni, name, lastname, phone, email, address) {
            console.log(phone)
            console.log(address)
            console.log(dni)
            console.log(tipo_dni)
            console.log(lastname)
            console.log(name)
            console.log(email)
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
            $("input[type=submit]").removeAttr("disabled");
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
            $("input[type=submit]").removeAttr("disabled");
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

            // $('#deshabilitado').removeAttr("disabled");

            // $( "input:radio" ).on("click",function(){


//   });
            // }
        }); //fin de la funcion clikea
    }); //fin del documento

// abrir un PDF en una pestaña nueva
$("#deshabilitado").click(function() {
// window.open('http://ejemplo.com/archivo.pdf', '_blank');

// redirigir la pestaña actual a otra URL
window.location.href = '/citas/deldia';
});
    </script>
    {{-- <script>
        function redirect() {
            window.location ='{{ route("checkout.index") }}', '_blank';
        };
    </script> --}}
@endsection
