@extends('dashboard.layouts.app')

@section('citas de pacientes','active')
@section('facturacion','active')

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

        <div class="section-body mt-4">
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
                                                <input id="patient_id" type="hidden" name="patient_id" value="{{$itinerary->person->id}}" >
                                                <input id="employe_id" type="hidden" name="employe_id" value="{{$itinerary->employe->person->id}}" >
                                                <input id="total" type="hidden" name="total_cancelar" value="{{$total}}" >
                                                <!-------------------- fin de Campos ocultoss------------------>

                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold; ">Doc. de identidad:</span>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                    <span id="dnii">{{$itinerary->person->dni}}</span>
                                                    </div>
                                                </div>
                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold;">Nombres/Apellidos:</span>
                                                    </div> 
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                    <span id="name">{{$itinerary->person->name}}</span><span id="lastname"> {{$itinerary->person->lastname}}</span>
                                                    </div>
                                                </div>
                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold; ">Telefono:</span>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span id="phone">{{$itinerary->person->phone}}</span>
                                                    </div>
                                                </div><br>
                                            </div>

                                            <!-------------------Medico tratante------------------>
                                            <div class="col-lg-6 col-md-12 col-sm-12 text-left">
                                                <p class="h6" style="color:#000; font-weight:bold;"><i class="fa fa-user-md mr-2" style="font-size:16px"></i> MEDICO TRATANTE</p>
                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold; ">Doc. de identidad:</span>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span id="dniiD">{{$itinerary->employe->person->dni}}</span>
                                                    </div>
                                                </div>

                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold; ">Nombres/Apellidos:</span>
                                                    </div> 
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span id="nameD">{{$itinerary->employe->person->name}}</span><span id="lastnameD">{{$itinerary->employe->person->lastname}}</span>
                                                    </div>

                                                </div>
                                                <div class="row ml-3">
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span style="font-weight:bold; ">Telefono:</span>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                        <span id="phoneD">{{$itinerary->employe->person->phone}}</span>
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

                                                    @foreach ($procedureS as $item)
                                                        @if($item->name == 'Consulta médica')
                                                            <tr>
                                                                <td colspan="5" class="pl-4">{{$item->name}}</td>
                                                                <td class="text-right">{{ number_format($itinerary->employe->doctor->price,2) }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>

                                                <tbody style="border-bottom: 1px solid #000" id="procedure">
                                                </tbody>
                                                <tbody id="columna">
                                                    
                                                    @foreach ($procedureS as $item)
                                                        @if($item->name != 'Consulta médica')
                                                            <tr>
                                                                <td colspan="5" class="pl-4">{{$item->name}}</td>
                                                                <td class="text-right">{{number_format($item->price,2)}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    
                                                </tbody> 
                                                <tbody style="border-bottom: 1px solid #000" id="cirugia_html">
                                                </tbody>
                                                   
                                                <tbody id="cirugia">
                                                    @if($itinerary->surgeryR != null)
                                                    <tr>
                                                        <td colspan="5" class="pl-4">{{$itinerary->surgeryR->name}}</td>
                                                        <td class="text-right">{{number_format($itinerary->surgeryR->cost,2)}}</td>
                                                    </tr>
                                                    @endif
                                                </tbody>                                             
                                                <tr>
                                                    <td colspan="5" class="font600 text-right">Subtotal</td>
                                                    <td class="text-right" id="subtotal">{{number_format($total,2)}}</td>
                                                </tr>
                                                <tr class="bg-boo  text-light">
                                                    <td colspan="5" class="font700 text-right">Total a cancelar</td>
                                                    <td class="font700 text-right" id="costo_total">{{number_format($total,2)}}</td>
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
// console.log('holaaaa',data.encontrado[0] );
            //-------------------cirugia -----------------
            if(data.encontrado[0].surgery_r != null){
                console.log('cooo ken')
                console.log('cirugia',data.encontrado[0].surgery_r.name)
                nombre_cirugia= data.encontrado[0].surgery_r.name;
                costo_cirugia= financial(data.encontrado[0].surgery_r.cost);


                // console.log('decimales', $data);

                cirugia='<tr><td colspan="5" class="pl-4">'+'Cirugía '+nombre_cirugia+'</td>'+'<td class="text-right">'+costo_cirugia+'</td></tr>';
                $("#cirugia").append(cirugia);
                costo_cirugia = data.encontrado[0].surgery_r.cost; //costo de la cirugia
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
    

        }); //fin del documento
    </script>

    
@endsection