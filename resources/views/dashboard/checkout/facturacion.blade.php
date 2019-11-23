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
                            <div class="input-group mt-2 col-5">
                                <input id="dni" type="text" class="form-control" maxlength="8" placeholder="buscar paciente...">
                                <a id="search" class="btn btn-info"><i class="icon-magnifier"></i></a>
                            </div>
                            <div class="form-group multiselect_div col-6 d-flex justify-content-end" >
                                    <select id="select" name="multiselect4[]" class="multiselect multiselect-custom" multiple="multiple">
                                            @foreach ($procedimientos as $procedimiento)
                                            <option value="{{ $procedimiento->id }}" >{{ $procedimiento->name }}</option> 
                                            {{-- <option value="ysbelia" >ysbe</option>
                                             <option value="hola" >kk</option> --}}
                                             @endforeach
                                    </select>
                                </div>
{{--                                 
                            <div class="card-options col-4 d-flex justify-content-end">
                                <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-primary"><i class="fe fe-plus" data-toggle="tooltip" title="" data-original-title="fe fe-plus"></i> agregar procedimiento</button>
                            </div> --}}

          
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Procedimientos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="input-group mt-4 col-12 col-sm-10 mr-4 ml-4">
                            <input id="dni" type="text" class="form-control" maxlength="8" placeholder="buscar paciente...">
                            <a id="search" class="btn btn-info"><i class="icon-magnifier"></i></a>
                        </div>
                        <div class="modal-body">
                                <div class="card">
                                        <div class="card-body scrolll">
                                            <div class="form-group scroll">
                                                <div class="custom-controls-stacked">
                                                    @foreach ($procedimientos as $procedimiento)
                                                        
                                                    {{-- <label class="custom-control custom-checkbox " id="select">
                                                        <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="">
                                                        <span class="custom-control-label">{{ $procedimiento->name }}</span>
                                                    </label> --}}

                                                

                                                    @endforeach
                                                </div>
                                            </div>
                                      
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                    </div>
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
                                            {{-- <a id="generar_factura" class="btn btn-primary"><i class="si si-printer"></i>Generar factura</a> --}}
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
                                                <tbody style="border-bottom: 1px solid #000">
                                                    <th class="text-center width35"></th>
                                                    <th>Procedimiento</th>
                                                    <th class="text-center" style="width: 1%">cantidad</th>
                                                    <th class="text-right" style="width: 1%">Unidad</th>
                                                    <th class="text-right" style="width: 1%">Costo total</th>
                                                </tbody>
                                                <tbody id="columna">
                                                 
                                                </tbody>                                                
                                                <tr>
                                                    <td colspan="4" class="font600 text-right">Subtotal</td>
                                                    <td class="text-right">$25.000,00</td>
                                                </tr>
                                                <tr class="bg-info text-light">
                                                    <td colspan="4" class="font700 text-right">Total a cancelar</td>
                                                    <td class="font700 text-right">$30.000,00</td>
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

@endsection

@section('scripts')
    <script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets\js\table\datatable.js') }}"></script>
    <script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>

    <script>
               //Documento donde se insertara
               $( document ).ready(function() {
             
             //llamando funcion definida en el html (search)
                $("#search").click(function() {
                    var dni = $("#dni").val();  //asignando el valor que se ingresa en el campo
                    console.log(dni);           //mostrando en consola
                    ajax(dni);                  // enviando el valor a la funcion ajax(darle cualquier nombre)
                });

                // $("#generar_factura").click(function(){
                //     var dni = $(#dni).value();
                //     generar(dni);
                // })
            
     

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
                        console.log(data.encontrado[0].person.dni);
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
        }
            });

                    
            //           function generar(dni) {
            //     $.ajax({ 
            //             url: "{{ route('checkout.patient') }}",   //definiendo ruta
            //             type: "POST",                             //definiendo metodo
            //             data: {
            //                 _token: "{{ csrf_token() }}",         //valor que se envia
            //                 dni: dni
            //             }
            //         })
            //         .done(function(data) {                        //recibe lo que retorna el metodo en la ruta definida
            //             console.log(data.encontrado[0].person.dni);

            //             patient_id = data.encontrado[0].person.id;
            //             person_id = data.encontrado[0].person.id;
            //             employe_id = data.encontrado.employe.person.id;
            //             procudure_id = data.encontrado.procedure.id;

            //             console.log('paciente', patient_id, 'person', person_id, 'employe', employe_id, 'procedure', procedure_id);
            //             if (data[0] == 202) {
                         
            //                 // enabled();
            //             }
            //             if (data[0] == 201) {
                         
            //                 disabled(data);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            //             }
            //         })
            //         .fail(function(data) {
            //             console.log(data);
            //         })
            // }

      
            });

        

   
        </script>

<script>
$('#select').multiselect({
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    maxHeight: 200
});
</script>


<script>
        $(document).ready(function(){
          $("#select").change(function(){
            var procedure_id = $(this).val();
            console.log(procedure_id);
            console.log(procedure_id.length);
            console.log(procedure_id[0]);
            //  $('#hola').text(categoria); 
      
      
            $.get('procedimiento/'+procedure_id[procedure_id.length-1], function(data){
      //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
              console.log('datos',data.procedure.name);
                // var producto_select = '<option value="">Seleccione Porducto</option>'
                //   for (var i=0; i<data.length;i++)
                    procedure_select='<tr><td>'+data.procedure.name+'</td>'+'<td>'+2+'</td>'+'<td>'+1+'</td>'+'<td>'+1+'</td>'+'<td>'+data.procedure.price+'</td></tr>';
                console.log('procedimiento seleccionado',procedure_select);
                // array[]= procedure_select;
                // console.log(array);
                  $("#columna").append(procedure_select);
      
            });
          });
        });
      </script>



            {{-- <script>
    $(document).ready(function() {
        $('#create-account-button').on('click', function(e) {
            e.preventDefault();
            var dataString = $('#create-account-form').serializeArray().JSON();
            // alert('Datos serializados: '+dataString);
            console.log(dataString);
        }); 
    });
    </script> --}}
    
@endsection