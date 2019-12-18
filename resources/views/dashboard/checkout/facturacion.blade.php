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

@section('title','Proceso de facturación')

@section('content')
    <form action="{{ route('checkout.guardar_factura') }}" method="POST">
        @csrf 
        <div class="section-body py-3">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-10 col-md-10 col-sm-10 ml-5">
                        <div class="card">
                            <div class="card-body row">
                                <div class="col-md-4 col-lg-3 mt-2">
                                        <h6 style="font-weight:bold">Buscar Paciente </h6>
                                </div>
                                <div class="input-group col-lg-9 col-md-8 d-flex justify-content-end" style="border:1px solid #fff">
                                    <input id="dni" type="text" class="form-control" maxlength="8" placeholder="Documento de identidad...">
                                    <a id="search"name="search" class="search btn btn-boo" style="color:#fff"><i class="icon-magnifier"></i></a>
                                </div>

                                <div class="form-group multiselect_div col-4 d-flex justify-content-end" >
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

        <div class="section-body">
            <div class="container">
                <div class="tab-content">
                
                    <div class="tab-pane fade active show" id="Invoice-detail" role="tabpanel">
                        <div class="row clearfix">
                            <div class="col-lg-10  col-md-10 col-sm-10 ml-5">
                                <div class="card">

                                    <div class="card-body row my-8  pl-4">
                                        <div class="col-lg-4 col-md-5 col-sm-12"><h2>Facturación</h2></div>
                                        <div class="col-lg-8 col-md-7 col-sm-12 d-flex justify-content-end pr-3 pt-10" style="color:#000" >
                                            <span class="h6 h66 pt- pr-10">Fecha:</span><i class="fa fa-calendar pt-1"></i>&nbsp;<span class="text pt-0"> {{ $fecha }}</span><br>
                                        </div>                             
                                    </div>

                                    <div class="card-body">
                                        <div class="row my-8">
                                            <!--Paciente-->
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <p class="h6" style="color:#000; font-weight:bold;"><i class="fa fa-user mr-2" style="font-size:16px;"></i> PACIENTE</p>
                                                                        
                                                <!-----------------------Campos ocultoss---------------------->
                                                <input id="procedure_id" type="hidden" name="procedure_id" value="" >
                                                <input id="patient_id" type="hidden" name="patient_id" value="" >
                                                <input id="employe_id" type="hidden" name="employe_id" value="" >
                                                <input id="total" type="hidden" name="total_cancelar" value="" >
                                                <!-------------------- fin de Campos ocultoss------------------>

                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold; ">Doc. de identidad:</span>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span id="dnii"></span>
                                                    </div>
                                                </div>
                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold;">Nombres/Apellidos:</span>
                                                    </div> 
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span id="name"></span><span id="lastname"></span>
                                                    </div>
                                                </div>
                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold; ">Telefono:</span>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span id="phone"></span>
                                                    </div>
                                                </div><br>
                                            </div>

                                            <!--Medico tratante-->
                                            <div class="col-lg-6 col-md-12 col-sm-12 text-left">
                                                <p class="h6" style="color:#000; font-weight:bold;"><i class="fa fa-user-md mr-2" style="font-size:16px"></i> MEDICO TRATANTE</p>
                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold; ">Doc. de identidad:</span>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span id="dniiD"></span>
                                                    </div>
                                                </div>

                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold; ">Nombres/Apellidos:</span>
                                                    </div> 
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span id="nameD"></span><span id="lastnameD"></span>
                                                    </div>

                                                </div>
                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold; ">Telefono:</span>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span id="phoneD"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br><br>
                                        
                                        <div class="table-responsive push mt-3">
                                            <table class="table table-bordered table-hover" >
                                                <tbody style="border-bottom: 1px solid #000">
                                                    <td style="font-weight:bold" colspan="5" class="text-left pl-4 tett" >DESCRIPCION</td>
                                                    <td class="text-right factura" style="width: 4%; font-weight:bold">COSTO</td>
                                                </tbody>

                                                <tbody style="border-bottom: 1px solid #000" id="consulta">
                                                </tbody>

                                                <tbody style="border-bottom: 1px solid #000" id="procedure">
                                                </tbody>
                                                <tbody id="columna">
                                                    
                                                </tbody> 
                                                <tbody style="border-bottom: 1px solid #000" id="cirugia_html">
                                                </tbody>
                                                    
                                                <tbody id="cirugia">
                                                </tbody>                                             
                                                <tr>
                                                    <td colspan="5" class="font600 text-right">Subtotal</td>
                                                    <td class="text-right" id="subtotal">0,00</td>
                                                </tr>
                                                <tr class="bg-boo  text-light">
                                                    <td colspan="5" class="font700 text-right">Total a cancelar</td>
                                                    <td class="font700 text-right" id="costo_total">0,00</td>
                                                </tr>
                                            </table>

                                            <div class="card-header d-flex justify-content-end col-13">
                                                <div class="card-options">
                                                    <button type="submit" class="btn btn-boo" style="margin-right: -16px;"><i class="si si-printer"></i>Generar factura</button>
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
    <form>


    <!--Modal para registrar otro cliente-->
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
        var costo_procedimientos=0;
        var costo_cirugia=0;
        var costo_consulta=0;
        var procedures_id=0;
        var data_paciente;
        var costo =0;
        var total =0;
        var precio=0;
        var process =0;

        function financial(x) {
            return Number.parseFloat(x).toFixed(2);
        }
            
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
                .done(function(data) {               
                    console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida

                    if(data[0] == 202){   
                        console.log('si')                 //si no trae valores
                        Swal.fire({
                            title: 'Error!',
                            text: data.encontrado,
                            type: 'error',
                        });
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
            console.log('hola');

            data_paciente = data.encontrado[0].person; //uasarla mas adelante
            
            // estas variables se usaran mas adelante para mostrar la factura generada
            id_patient = data.encontrado[0].person.id;
            id_employe = data.encontrado[0].employe.person.id; 

            //------------- consulta ---------------------
            if(data.encontrado[0].doctor_id != null){

                console.log('consulta', data.encontrado[0].employe.doctor);
                costo_consulta= financial(data.encontrado[0].employe.doctor.price); //costo de la consulta
                console.log(costo_consulta);
                consulta_html = '<td colspan="5" class="pl-4">Consulta medica</td><td class="text-right">'+costo_consulta+'</td>';
                $("#consulta").append(consulta_html);

            }

            //-------------------cirugia -----------------
            if(data.encontrado[0].surgery != null){
                console.log('cirugia',data.encontrado[0].surgery)
                nombre_cirugia= data.encontrado[0].surgery.typesurgeries.name;
                costo_cirugia= financial(data.encontrado[0].surgery.typesurgeries.cost);


                // console.log('decimales', $data);

                cirugia='<tr><td colspan="5" class="pl-4">'+'Cirugía '+nombre_cirugia+'</td>'+'<td class="text-right">'+costo_cirugia+'</td></tr>';
                $("#cirugia").append(cirugia);
                costo_cirugia = data.encontrado[0].surgery.typesurgeries.cost; //costo de la cirugia
            }

             // --------------------Procedures -------------
            if(data.procedureS != null){
                console.log('procedures', data.procedureS)
                $("#procedure").append(procedure);

                for(var i = 0; i < data.procedureS.length; i++){  // para listar los procedimientos
                    costo = financial(data.procedureS[i].price);
                    costo_procedimientos += Number(costo);     // suma el precio de cada procedimiento
                    procedures_id = procedures_id +','+ (data.procedureS[i].id); // guardarndo ids
                    console.log('proceduressss',procedures_id)
                    procedure_select='<tr><td colspan="5" class="pl-4">'+'Procedimiento '+ data.procedureS[i].name+'<td class="text-right">'+costo+'</td></tr>';
                    $("#columna").append(procedure_select);
                }
            }
            cu = parseFloat(costo_consulta);
            ci = parseFloat(costo_cirugia);
            p = parseFloat(costo_procedimientos);
            
            costo_total = cu + ci + p;
            total = costo_total;

            $('#total').val(costo_total);
            

            // asignando valores a los campos con id en html 
            $('#patient_id').val(id_patient);
            $('#employe_id').val(id_employe);
            $('#procedure_id').val(procedures_id);

            $('#costo_total').text(financial(costo_total));
            $('#subtotal').text(financial(costo_total));
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
            console.log('estos son ',procedure_id);
            console.log(procedure_id.length); // el length en este caso permite agarrar el ultimo valor del arreglo

            //ruta para buscar los datos segun procedimiento seleccionado
            $.get('procedimiento/'+procedure_id[procedure_id.length-1], function(data){
              //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
            console.log('datos',data.procedure.name);

                procedure_select='<tr><td colspan="5" class="pl-4">'+data.procedure.name+'</td>'+'<td class="text-right">'+data.procedure.price+'</td></tr>';
                console.log('procedimiento seleccionado',procedure_select);

                costo_total += Number(data.procedure.price);     // suma el precio de cada procedimiento
                procedures_id = procedures_id +','+ (data.procedure.id); // guardarndo ids
            
                console.log('ids',procedures_id);
                console.log(costo_total)
                $("#columna").append(procedure_select);
                $('#costo_total').text(costo_total);
                $('#subtotal').text(costo_total);
                total = costo_total;
                $('#total').val(costo_total);
            });
          }); // fin de la funcion para agregar procedimientos

        }); //fin del documento
    </script>

    
@endsection