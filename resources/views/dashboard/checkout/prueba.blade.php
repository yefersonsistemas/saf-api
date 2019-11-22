    @extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css">
@endsection

@section('title','Historia Medica')

@section('content')
   
{{-- <div class="col-md-3">
   <label for="" class="control-label">Seleccione Categoria</label>
      <select name="categorias" id="categorias" class="form-control">
         <option value="">Seleccione</option>
            <option value="1">hols</option>
                <option value="1">hols</option>
                    <option value="1">hols</option>
      </select>
</div> --}}


{{-- <form method="GET" action=""> --}}
  {{-- <select  style="width:350px;" multiple="" name="Productos[]" id="categorias">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select> --}}
  {{-- <input type="submit" value="Enviar" id="submit" />
</form> --}}


    <div class="card p-4 d-flex justify-content-between">
            <div class="row">  
  <div class="col-lg-6 col-md-6" id="framework_form">
        <label class="form-label">Enfermedades</label>
        <div class="form-group multiselect_div">
            <select id="select" name="multiselect4[]" class="multiselect multiselect-custom" multiple="multiple">
     
                    <option value="kenwherly" >ken</option> 
                    <option value="ysbelia" >ysbe</option>
                     <option value="hola" >kk</option>

            </select>
        </div>
    </div>

     <div class="card col-6">
<p id="hola"></p>
    </div>
</div>

</div>

@endsection

@section('scripts')
<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js"></script>
<script src="http://labo.tristan-jahier.fr/chosen_order/chosen.order.jquery.min.js"></script>

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
  $(document).ready(function(){
    $("#select").change(function(){
      var categoria = $(this).val();
      console.log(categoria)
       $('#hola').text(categoria); 


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

 <script>

    //   $(document).ready(function(){

    //      }
 
  // enviamos el formulario usando AJAX
//   $.ajax({
//     url: "procesar.php",
//     data: serializedForm
//   });



// $(document).ready(function(){
//       var selected = '';
//         $("#boton").click(function(){
// 		    $("#select option:checked").each(function(){
//                  selected += $(this).val() + ','; 
             
//         	    // alert($(this).text())
//             });
//                 console.log(selected)
//                 // var fin = selected;
//                 console.log(seleccionados)
//     });
    //   var selected = '';
    // $('select option:checked').each(function(){
    // selected += $(this).val() + ','; 
    // console.log(selected)
    // });
    // fin = selected.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
    // selected = selected.substr( 0, fin ); // elimino la coma final
// });

  
 </script>
@endsection


