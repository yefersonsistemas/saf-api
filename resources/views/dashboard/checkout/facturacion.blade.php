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
    <form action="{{ route('checkout.guardar_factura') }}" method="POST">
        @csrf 
        <div class="section-body py-3">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body row">
                                <div class="col-12">
                                        <h5>Buscar Paciente </h5>
                                </div>
                                <div class="input-group mt-2 col-5">
                                    <input id="dni" type="text" class="form-control" maxlength="8" placeholder="buscar paciente...">
                                    <a id="search"name="search" class="search btn btn-info"><i class="icon-magnifier"></i></a>
                                </div>
                                <div class="form-group multiselect_div col-6 d-flex justify-content-end" >
                                    <select id="select" name="multiselect4[]" class="multiselect multiselect-custom" multiple="multiple">
                                        @foreach ($procedimientos as $procedimiento)
                                            <option value="{{ $procedimiento->id }}" >{{ $procedimiento->name }}</option>
                                        @endforeach
                                    </select>
                                </div>          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body py-3 text-center">

            <h6>Persona a cancelar</h6>
            <button class="btn btn-primary" id="paciente" name="paciente">
            Paciente
            </button>
            <a  class="btn btn-primary"  data-toggle="modal" data-target="#otro">
                Otro
            </a>
        
        <!-- Modal -->
       
        <!--fin del modal-->
         </div>

        <div class="section-body py-3">
            <div class="container">
                <div class="tab-content">
                
                    <div class="tab-pane fade active show" id="Invoice-detail" role="tabpanel">
                        <div class="row clearfix">
                            <div class="col-12">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <div class="row my-8">
                                            <div class="col-4">
                                                <p class="h6">Paciente</p>
                                                                        
                                                <!-----------------------Campos ocultoss---------------------->
                                                <input id="procedure_id" type="hidden" name="procedure_id" value="" >
                                                <input id="patient_id" type="hidden" name="patient_id" value="" >
                                                <input id="employe_id" type="hidden" name="employe_id" value="" >
                                                <input id="person_id" type="hidden" name="person_id" value="" >
                                                <!-------------------- fin de Campos ocultoss------------------>

                                                <span id="dnii"> Documento de Identidad</span><br>
                                                <span id="name">Nombre</span><br>
                                                <span id="lastname">Apellido</span><br>
                                                <span id="phone"> Telefono</span><br>
                                            </div>
                                            <div class="col-4 text-left">
                                                <p class="h6">Doctor</p>
                                                <span id="dniiD"> Documento de Identidad</span><br>
                                                <span id="nameD">Nombre</span><br>
                                                <span id="lastnameD">Apellido</span><br>
                                                <span id="phoneD"> Telefono</span><br>
                                            </div>

                                            <div class="col-4 text-right">
                                                <p class="h6">Cancelado por:</p>
                                                <span id="dni_c"> Documento de Identidad</span><br>
                                                <span id="name_c">Nombre</span><br>
                                                <span id="lastname_c">Apellido</span><br>
                                                <span id="phone_c"> Telefono</span><br>
                                            </div>
                                        </div>
                                        <div class="table-responsive push">
                                            <table class="table table-bordered table-hover">
                                                <tbody style="border-bottom: 1px solid #000">
                                                    <th class="text-center width35"></th>
                                                    <th colspan="4">Procedimiento</th>
                                                    <th class="text-right" style="width: 4%">Costo</th>
                                                </tbody>
                                                
                                                <tbody id="columna">
                                                    
                                                </tbody>                                                
                                                <tr>
                                                    <th class="text-center width35"></th>
                                                    <td colspan="4" class="font600 text-right">Subtotal</td>
                                                    <td class="text-right" id="subtotal">0,00</td>
                                                </tr>
                                                <tr class="bg-info text-light">
                                                    <th class="text-center width35"></th>
                                                    <td colspan="4" class="font700 text-right">Total a cancelar</td>
                                                    <td class="font700 text-right" id="costo_total">0,00</td>
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
            <div class="card-header">
                <div class="card-options">
                    <button type="submit" class="btn btn-primary"><i class="si si-printer"></i>Generar factura</button>
                </div>
            </div>
        </div>
    <form>

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
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a class="btn btn-primary" id="registrar">Registrar</a>
                        </div>
                    </div>
                    </div>
                </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets\js\table\datatable.js') }}"></script>
    <script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>


    <script>
    $('#select').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
    </script>

    <script>
    //================================ para poder acceder al documento html ===========================
    $(document).ready(function(){

        var id_patient;
        var id_employe;
        var costo_total=0;
        var procedures_id=0;
            
        // ==================== ejecuta cuando se clikea el boton de buscar =====================
        $(".search").click(function() {
            var dni = $("#dni").val();          //asignando el valor que se ingresa en el campo
            console.log(dni);                   //mostrando en consola
            ajax(dni);                          // enviando el valor a la funcion ajax(darle cualquier nombre)
        }); //fin de la funcion clikea



        //=================== funcion que busca al paciente/doctor/procedimientos con el dni ================
          function ajax(dni) {
                $.ajax({ 
                    url: "{{ route('checkout.patient') }}",   //definiendo ruta
                    type: "POST",                             //definiendo metodo
                    data: {
                        _token: "{{ csrf_token() }}",        
                        dni: dni                               //valor que se envia
                    }
                })
                .done(function(data) {                        //recibe lo que retorna el metodo en la ruta definida
                    console.log('esto',data.encontrado[0].person);
                    console.log('arreglo', data.procedureS);

                    if (data[0] == 202) {                    //si no trae valores
                        Swal.fire({
                            title: 'Error!',
                            text: 'Paciente no encontrado',
                            type: 'error',
                        })
                    }
                    if (data[0] == 201) {                       //si no trae valores
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
        } // fin de la funcion que busca datos del paciente/doctor/procedimientos



        //================================== para porder mostrar en el documento html ==========================
        function disabled(data) {

            console.log('ken',data.encontrado[0].person);
            
            // estas variables se usaran mas adelante para mostrar la factura generada
            id_patient = data.encontrado[0].person.id;
            
            id_employe = data.encontrado[0].employe.person.id; 
            console.log('jaja',id_patient, id_employe);
    
            for(var i = 0; i < data.procedureS.length; i++){         // para listar los procedimientos
                costo_total += Number(data.procedureS[i].price);     // suma el precio de cada procedimiento
                procedures_id = procedures_id +','+ (data.procedureS[i].id); // guardarndo ids
                console.log('proceduressss',procedures_id)
                procedure_select='<tr><td></td><td colspan="4">'+data.procedureS[i].name+'<td>'+data.procedureS[i].price+'</td></tr>';
                $("#columna").append(procedure_select);
            }


            // asignando valores a los campos con id en html 
            $('#patient_id').val(id_patient);
            $('#employe_id').val(id_employe);
            $('#procedure_id').val(procedures_id);

            $('#costo_total').text(costo_total);
            $('#subtotal').text(costo_total);
            $('#dnii').text(data.encontrado[0].person.dni); 
            $('#name').text(data.encontrado[0].person.name);
            $('#lastname').text(data.encontrado[0].person.lastname);
            $('#phone').text(data.encontrado[0].person.phone);
            $('#dniiD').text(data.encontrado[0].employe.person.dni); 
            $('#nameD').text(data.encontrado[0].employe.person.name);
            $('#lastnameD').text(data.encontrado[0].employe.person.lastname);
            $('#phoneD').text(data.encontrado[0].employe.person.phone);

            $('#procedimiento').text(data.person.name);
            $('#cantidad').text(data.person.dni);

       
        } // fin de la funcion que muestra datos en el html
    


        //================================== para agregar procedimientos adicionales==========================
          $("#select").change(function(){
            var procedure_id = $(this).val(); // valor que se enviara al metodo de crear factura 
            console.log(procedure_id);
            console.log(procedure_id.length); // el length en este caso permite agarrar el ultimo valor del arreglo
      
            //ruta para buscar los datos segun procedimiento seleccionado
            $.get('procedimiento/'+procedure_id[procedure_id.length-1], function(data){
              //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
              console.log('datos',data.procedure.name);

                    procedure_select='<tr><td></td><td colspan="4">'+data.procedure.name+'</td>'+'<td>'+data.procedure.price+'</td></tr>';
                    console.log('procedimiento seleccionado',procedure_select);
                    costo_total += Number(data.procedure.price);     // suma el precio de cada procedimiento
                    procedures_id = procedures_id +','+ (data.procedure.id); // guardarndo ids
                
                    console.log('ids',procedures_id);
                    console.log(costo_total)
                  $("#columna").append(procedure_select);
                  $('#costo_total').text(costo_total);
      
            });
          }); // fin de la funcion para agregar procedimientos



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

                    // if (data[0] == 202) {                   
                    //     Swal.fire({
                    //         title: 'Error!',
                    //         text: 'No se ha podido registrar',
                    //         type: 'error',
                    //     })
                    // }
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
        } // fin de la funcion que muestra datos en el html


        // ==================== ejecuta el que va a cancelar es el paciente =====================
        // $("#paciente").click(function() {
           
        //     $('#dni_c').$("#dnii").val();
        //     $('#name_c').$("#name").val();
        //     $('#lastname_c').$("#lastname").val();
        //     $('#phone_c').$("#phone").val();  
        //     $('#person_id').$("#patient_id").val();      
        // }); //fin de la funcion clikea


        }); //fin del documento
      </script>

    
@endsection