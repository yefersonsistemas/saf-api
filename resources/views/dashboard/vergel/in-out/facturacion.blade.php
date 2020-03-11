@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('facturacion','active')
@section('iorol','d-block')
@section('dire','d-none')

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
<form action="{{ route('in-out.factura') }}" method="POST">
    @csrf 
    <!---busqueda de paciente co cirugia a pagar-->
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
                                       <span class="h6 h66 pt- pr-10">Fecha:</span><i class="fa fa-calendar pt-1"></i>&nbsp;<span class="text pt-0">   </span><br>
                                    </div>                             
                                </div>

                                <div class="card-body">
                                    <div class="row my-8">
                                        <!--Paciente-->
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <p class="h6" style="color:#000; font-weight:bold;"><i class="fa fa-user mr-2" style="font-size:16px;"></i> PACIENTE</p>
                                                                    
                                            <!-----------------------Campos ocultoss---------------------->
                                            <input id="surgery_id" type="hidden" name="surgery_id" value="" > <!--guardar id de la cirugia-->
                                            <input id="patient_id" type="hidden" name="patient_id" value="" > <!--guardar id del paciente-->
                                            <input id="employe_id" type="hidden" name="employe_id" value="" >  <!--guardar id del employe-->
                                            <input id="total" type="hidden" name="total_cancelar" value="" >   <!--guardar id del total a cancelar-->
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
                                                    <span id="name"></span>
                                                    <span></span>
                                                    <span id="lastname"></span>
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
                                                    <span id="nameD"></span>
                                                    <span></span>
                                                    <span id="lastnameD"></span>
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
                                    
                                    <!--Mostrar datos de la cirugia a pagar--->
                                    <div class="table-responsive push mt-3">
                                        <table class="table table-bordered table-hover" >
                                            <tbody style="border-bottom: 1px solid #000">
                                                <td style="font-weight:bold" colspan="5" class="text-left pl-4 tett" >DESCRIPCION</td>
                                                <td class="text-right factura" style="width: 4%; font-weight:bold">COSTO</td>
                                            </tbody>
                                                
                                            <!--para mostrar cirugia-->
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
                                                {{-- <a href="{{ route('in-out.factura') }}" style="color:#000"></i>Generar factura</button>                                         --}}
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
        var costo_cirugia=0;
        var procedures_id=0;
        var data_paciente;
     

        function financial(x) {
            return Number.parseFloat(x).toFixed(2);
        }
            
        // ==================== ejecuta cuando se clikea el boton de buscar =====================
        $(".search").click(function() {
            var dni = $("#dni").val();   
            
            ajax(dni);      
        }); //fin de la funcion clikea


        //=================== funcion que busca al paciente/doctor/procedimientos con el dni ================
        function ajax(dni) {
                $.ajax({ 
                    url: "{{ route('inout.search_patients') }}",   //definiendo ruta
                    type: "POST",                             //definiendo metodo
                    data: {
                        _token: "{{ csrf_token() }}",        
                        dni: dni                               //valor que se envia
                    }
                })
                .done(function(data) {               
                   // console.log('paciente -> -> -> encontrado',data)         //recibe lo que retorna el metodo en la ruta definida

                    if(data[0] == 202){   
                        console.log('si')             
                        Swal.fire({
                            title: 'Error!',
                            text: data.encontrado,
                            type: 'error',
                        });
                    }
                    if (data[0] == 201) {                    
                        Swal.fire({
                            title: 'Excelente!',
                            text:  'Paciente encontrado',
                            type:  'success',
                        })
                        disabled(data);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
                    }

                    if (data[0] == 300) {        
                        Swal.fire({
                        title: 'Factura ya fue emitida',
                        text: "Click OK para cerrar!!",
                        type: 'info',
                        allowOutsideClick:false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '<a href="{{ route('checkout.index') }}" style="color:#fff">OK</a>'
                        })
                        .then(function(){
                            window.location.href = '{{ route('checkout.index') }}'
                        })   
                    }                             
                })
                .fail(function(data) {
                    console.log(data);
                })
        } // fin de la funcion que busca datos del paciente/doctor/procedimientos


        //================================== para porder mostrar en el documento html ==========================
        function disabled(data) {
            // console.log('hola kenwherly', data.encontrado[0].patient[0].person);  enciende para verificar que trae la data

            data_paciente =  data.encontrado[0].patient[0].person;      // console.log('lee aqui para data completa de paciente',data_paciente);   
            id_patient =  data.encontrado[0].patient[0].person.id;      // console.log('lee aqui para verificar id de paciente',id_patient);     
            id_employe = data.encontrado[0].employe.id;                 // console.log('lee aqui para verificar id de empleado',id_employe);  
            id_surgery = data.encontrado[0].id; 

            //-------------------cirugia -----------------
            if(data.encontrado[0].typesurgeries != null){

                nombre_cirugia= data.encontrado[0].typesurgeries.name;
                costo_cirugia= financial(data.encontrado[0].typesurgeries.cost);

                cirugia='<tr><td colspan="5" class="pl-4">'+'Cirugía '+nombre_cirugia+'</td>'+'<td class="text-right">'+costo_cirugia+'</td></tr>';
                $("#cirugia").append(cirugia);
                costo_cirugia = data.encontrado[0].typesurgeries.cost; //costo de la cirugia
            }
            
            ci = parseFloat(costo_cirugia);            
            costo_total = ci ;
            total = costo_total;

            $('#total').val(costo_total);
            $('#patient_id').val(id_patient);
            $('#employe_id').val(id_employe);
            $('#surgery_id').val(id_surgery);

            $('#costo_total').text(financial(costo_total));
            $('#subtotal').text(financial(costo_total));
            //datos del paciente
            $('#dnii').text(data.encontrado[0].patient[0].person.dni); 
            $('#name').text(data.encontrado[0].patient[0].person.name);
            $('#lastname').text(data.encontrado[0].patient[0].person.lastname);
            $('#phone').text(data.encontrado[0].patient[0].person.phone);
            //datos del empleado
            $('#dniiD').text(data.encontrado[0].employe.person.dni); 
            $('#nameD').text(data.encontrado[0].employe.person.name);
            $('#lastnameD').text(data.encontrado[0].employe.person.lastname);
            $('#phoneD').text(data.encontrado[0].employe.person.phone);

        }  
        }); 
    </script>

    
@endsection