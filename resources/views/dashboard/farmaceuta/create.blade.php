@extends('dashboard.layouts.app')

@section('cites','active')

@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\dropify\css\dropify.min.css') }}">

<style>
    .cursor{
        cursor:pointer;
    }
</style>
@endsection

@section('title','Registro de Insumos')

@section('content')
    <div class="section-body py-4">
        <div class="container-fluid">
            <form action="{{route('farmaceuta.store')}}" method='POST' enctype="multipart/form-data" class="row d-flex justify-content-center">
                @csrf
                <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                    <div class="card p-4">

                        <div class="row d-flex justify-content-between create-employee">
                            <div class="col-lg-12 col-md-12 d-flex justify-content-between">
                                <div class="row">
                                    <div class="col-6 p-0 m-0 mb-3" id="mostrar_medicine">
                                        <div class="form-group">
                                            <label class="form-label">Nombre de Insumo</label>
                                            <div class="row d-flex justify-content-center">
                                                <input type="hidden" name="id" value="">
                                                <a class="btn btn-verdePastel d-flex d-block text-white col-9 cursor text-center" data-toggle="modal" style="width:100%;" data-target="#exampleModal">
                                                    <i class="fa fa-plus-circle p-1"></i>&nbsp;Agregar Medicina
                                                </a>
                                            </div>                                         
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">Marca</label>
                                            <input type="text" class="form-control" placeholder="Marca" name="marca" value="{{ old('marca') }}" required>
                                        </div>
                                    </div>
                        
                                    <div class="col-lg-6">
                                        <div class="form-group"> 
                                            <label class="form-label">Laboratorio</label>
                                            <input type="text" class="form-control" placeholder="Laboratorio" name="laboratory" value="{{ old('laboratory') }}" required>
                                        </div>
                                    </div>
        
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Presentación</label>
                                            <input type="text" name="presentation" id="presentacion" class="form-control" placeholder="presentacion" value="{{ old('presentation') }}" required>
                                        </div>
                                    </div>
            
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Medida</label>
                                            <input type="text" class="form-control" placeholder="Medida" name="measure" value="{{ old('measure') }}" required>
                                        </div>
                                    </div>
                                        
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Cantidad por Unidad</label>
                                            <input type="text" placeholder="Cantidad por unidad" class="form-control" name="quantify_Unit" value="{{ old('quantify_Unit') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Cantidad a Ingresar</label>
                                            <input type="text" placeholder="Stock" class="form-control" name="total" value="{{ old('total') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Numero de Lote</label>
                                            <input type="text" placeholder="Número de lote" class="form-control" name="number_lot" value="{{ old('number_lot') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Fecha de Vencimiento</label>
                                            <input type="text" placeholder="Fecha de Vencimiento" class="form-control" name="date_vence" value="{{ old('date_vence') }}" required>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
            
                    <div class="btn-group-toggle mb-2 mt-3 d-flex justify-content-end" style="text-align:center">    
                        {{-- <button type="reset" style="background:#a1a1a1" class="btn mr-2 pr-4 pl-4 text-white">Limpiar</button>  --}}
                        <button type="submit" class="btn mr-2 pr-4 pl-4 text-white bg-azuloscuro">Guardar</button>                      
                    </div>
                </div>
            </form>
        </div>
    </div>

      <!-- Modal para mostar medicinas-->
      <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable row3 " role="document">
            <div class="modal-content row " style="width: 150%;">
                <div class="modal-header p-2" style="background-color: #00506b; color: #fff;">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Medicinas</h5>
                    <button type="button" class="btn btn-azuloscuro"data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>          
                <form action="" id="medicina">
                    <div class="modal-body ml-4" style="max-height: 415px; ">         
                        <div class="form-group">
                            <div class="custom-controls-stacked">
                                <div class="row">
                                    <label for="" class="col-2 mr-2 ml-2 text-center mt-2" style="font-weight:bold">Buscar:</label><input id="buscar_medicina" type="text" class="form-control p-1 pl-3 mr-2 col-9" placeholder="Buscar medicina..">
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="card-header">
                                                    <h6>Nombre</h6>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal_medicina" class="mt-4"> 
                                            @if($medicine != null)
                                            @foreach ($medicine as $item)
                                                <tr id="{{$item->id}}">
                                                    <td>
                                                        <label class="custom-control custom-checkbox" >
                                                            <input type="radio" class="custom-control-input" name="medicina_id" value="{{ $item->id }}">
                                                            <span class="custom-control-label">{{ $item->name }} </span>
                                                        </label>
                                                    </td>
                                                </tr>                                                
                                            @endforeach
                                        @endif 
                                    </tbody>
                                </table>
                            </div>
                        </div>                             
                   </div>
                    <div class="modal-footer pt-3 row pb-0">  
                        <div class="col-5 d-flex justify-content-start">
                            <a class="btn btn-verdePastel text-white text-start cursor" data-dismiss="modal" data-toggle="modal" style="width:100%; border-radius:5px; " data-target="#crear_medicina">Registrar medicina</a>    
                        </div> 
                        <div class="col-6 d-flex justify-content-end">
                            <a class="btn btn-secondary text-white mr-2 cursor" data-dismiss="modal">Cerrar</a>                   
                            <a class="btn btn-azuloscuro text-white cursor" data-dismiss="modal" id="agregar_medicina">Agregar</a>
                        </div>                        
                     
                    </div>
                </form>
            </div>
        </div>
    </div>


     <!-- Modal para crear medicinas-->
     <div class="modal fade " id="crear_medicina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable row3 " role="document">
            <div class="modal-content row " style="width: 150%;">
                <div class="modal-header p-2" style="background-color: #00506b; color: #fff;">
                    <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Registrar Medicina</h5>
                    <button type="button" class="btn btn-azuloscuro"data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>     
                <div class="modal-body">
                    <input type="text" placeholder="Nombre del Medicamento" name="name" value="{{ old('name') }}" class="form-control" required id="newmedicine">
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="modal-footer py-3 row pb-0"> 
                    <a class="btn btn-secondary text-white mr-2 cursor" data-dismiss="modal">Cerrar</a>                   
                    <a class="btn btn-azuloscuro text-white cursor" data-dismiss="modal" id="guardar_medicina">guardar</a>                    
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\dropify\js\dropify.min.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>

<script>
    //========================buscador en tiempo real de medicinas=======================
    $(document).ready(function(){
      $("#buscar_medicina").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#modal_medicina tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>


<script>
     //=================guardar enfermedades================
     $("#agregar_medicina").click(function() {
        var data = $("#medicina").serialize();          //asignando el valor que se ingresa en el campo
        console.log('data', data);

        $.ajax({
            url: "{{ route('farmaceuta.search_medicine') }}", //definiendo ruta
            type: "POST",
            dataType:'json', //definiendo metodo
            data: {
                _token: "{{ csrf_token() }}",
                data:data,
            }
        })
        .done(function(data) {
            console.log('encontrado',data)         //recibe lo que retorna el metodo en la ruta definida

            // if(data[0] == 201){  
                mostrarMedicine(data.medicine);
            // }

            // if (data[0] == 202) {                       //si no trae valores
            //     Swal.fire({
            //         title: data.medicine,
            //         text:  'Click en OK para continuar',
            //         type:  'error',
            //     })       // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
            // }
        })
        .fail(function(data) {
            console.log(data);
        })
    }); //fin de la funcion clikea

    function mostrarMedicine(data) {
        $('#mostrar_medicine').html(`  <div class="form-group">
                                            <label class="form-label">Nombre de Insumo</label>
                                            <div class="input-group row">
                                                <div class="input-group-prepend bg-white col-9 mr-0" >
                                                    <input type="hidden" name="id" value="${data.id}">
                                                    <input type="text" disabled class="form-control" placeholder="Nombre" name="name" value="${data.name}" required>
                                                </div>                                               
                                                <div class="input-group-prepend col-3 ml-0">
                                                    <a class="btn btn-verdePastel text-white text-center pt-2 cursor d-flex d-block" data-toggle="modal" style="width:100%; border-radius:5px; " data-target="#exampleModal">
                                                        <i class="fa fa-plus-circle p-1"></i> &nbsp;Insumo
                                                    </a>
                                                </div>
                                            </div>
                                        </div>`);                                       
                                        
    }
</script>

<script>
     //===================crear medicina ======================
     $('#guardar_medicina').click(function(){
            var name = $('#newmedicine').val();
            console.log(name);
            nuevaMedicina(name);
        });

        //==================guardar medicina=====================
        function nuevaMedicina(name){
            console.log(name);
            $.ajax({ 
                url: "{{ route('farmaceuta.guardar_medicine') }}",  
                type: "POST",                            
                data: {
                    _token: "{{ csrf_token() }}",        
                    name: name,                         
                }
            })
            .done(function(data) {                        //recibe lo que retorna el metodo en la ruta definida
                console.log('esto',data);
                if (data[1] == 201) {                       
                    Swal.fire({
                        title: 'Excelente!',
                        text:  data.medicine,
                        type:  'success',
                    })
                    agregar_medicines(data[0]);          // llamada de la funcion que asigna los valores obtenidos a input mediante el id definido en el mismo
                }
                if (data[0] == 202) {                       
                    Swal.fire({
                        title: 'Error!',
                        text:  data.medicine,
                        type:  'error',
                    }) 
                }

            })
            .fail(function(data) {
                console.log(data);
            })
        }

        //====================================mostrar medicina creada===============================
        function agregar_medicines(data){

            $('#mostrar_medicine').html(`  <div class="form-group">
                                            <label class="form-label">Nombre de Insumo</label>
                                            <div class="input-group row">
                                                <div class="input-group-prepend bg-white col-9 mr-0" >
                                                    <input type="hidden" name="id" value="${data.id}">
                                                    <input type="text" disabled class="form-control" placeholder="Nombre" name="name" value="${data.name}" required>
                                                </div>                                               
                                                <div class="input-group-prepend col-3 ml-0">
                                                    <a class="btn btn-verdePastel text-white text-center pt-2 cursor d-flex d-block" data-toggle="modal" style="width:100%; border-radius:5px; " data-target="#exampleModal">
                                                        <i class="fa fa-plus-circle p-1"></i> &nbsp;Insumo
                                                    </a>
                                                </div>
                                            </div>
                                        </div>`);    

            

            $('#modal_medicina').append(` <tr id="${data.id}">
                                                <td>
                                                    <label class="custom-control custom-checkbox" >
                                                        <input type="radio" checked class="custom-control-input" name="medicina_id" value="${data.id}">
                                                        <span class="custom-control-label">${data.name}</span>
                                                    </label>
                                                </td>
                                            </tr>  `);  
        }

</script>

<script>
function disableBtn() {
  document.getElementById("boton").disabled = true;
}

function enableBtn() {
  document.getElementById("boton").disabled = false;
}
</script>


@endsection


    