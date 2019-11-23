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
                                            <option value="{{ $procedimiento->name }}" >{{ $procedimiento->name }}</option> 
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
            $('#dnii').text(data.encontrado.person.dni); 
            $('#name').text(data.encontrado.person.name);
            $('#lastname').text(data.encontrado.person.lastname);
            $('#phone').text(data.encontrado.person.phone);
            $('#dniiD').text(data.encontrado.employe.person.dni); 
            $('#nameD').text(data.encontrado.employe.person.name);
            $('#lastnameD').text(data.encontrado.employe.person.lastname);
            $('#phoneD').text(data.encontrado.employe.person.phone);

            $('#procedimiento').text(data.person.name);
            $('#cantidad').text(data.person.dni);
        }
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
            var categoria = $(this).val();
            console.log(categoria)
            //  $('#hola').text(categoria); 
      
      
            $.get('productByCategory/'+categoria, function(data){
      //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
              console.log(data);
                var producto_select = '<option value="">Seleccione Porducto</option>'
                  for (var i=0; i<data.length;i++)
                    producto_select+='<option value="'+data[i].id+'">'+data[i].nombre_producto+'</option>';
      
                  $("#campanas").html(producto_select);
      
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