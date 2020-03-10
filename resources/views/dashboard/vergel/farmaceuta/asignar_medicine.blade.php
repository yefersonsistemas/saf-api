@extends('dashboard.layouts.app')

@section('doctor','active')
@section('farmarol','d-block')
@section('dire','d-none')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">

    <style>
        /* body {font-family: Arial, Helvetica, sans-serif;} */
    
        #myImg {
          border-radius: 5px;
          cursor: pointer;
          transition: 0.3s;
          opacity: 0.6;
        }
    
        #myImg:hover {opacity: 1;}
    
        /* The Modal (background) */
    
        .modall{
          display: none;
          position: fixed; /* Stay in place */
          /* z-index: 1; Sit on top */
          padding-top: 20px; /* Location of the box */
          left: 0;
          top: 0;
          /* max-width: 1500px; */
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0);
          background-color: rgba(0,0,0,0.8);
    
        }
    
    
        /* Modal Content (image) */
        .modal-content {
          margin: auto;
          display: block;
          width: 85%;
          max-width: 1500px;
        }
    
        /* Caption of Modal Image */
        .caption {
          margin: auto;
          display: block;
          width: 50%;
          /* max-width: 400px; */
          text-align: center;
          color: #ccc;
          padding: 10px 0;
          height: 150px;
        }
        .sombra
        {
            -webkit-box-shadow: 1px 1px 3px #878585; /* Sombra normal */
            border-radius: 2px
            
        }
    
    
        .caption_extra_grande {
          margin: auto;
          display: block;
          width: 130%;
          /* max-width: 1700px; */
          text-align: center;
          color: #ccc;
          padding: 5px 0;
          height: 180px;
        }
    
        img{
            opacity: 1;
        }
    
        /* Add Animation */
        .caption {
          -webkit-animation-name: zoom;
          -webkit-animation-duration: 0.6s;
          animation-name: zoom;
          animation-duration: 0.6s;
        }
    
        @-webkit-keyframes zoom {
          from {-webkit-transform:scale(0)}
          to {-webkit-transform:scale(1)}
        }
    
        @keyframes zoom {
          from {transform:scale(0)}
          to {transform:scale(1)}
        }
    
        /* The Close Button */
        .close1 {
          position: absolute;
          top: 15px;
          right: 35px;
          color: #fff;
          font-size: 40px;
          font-weight: bold;
          transition: 0.3s;
        }
    
        .close1:hover,
        .close1:focus {
          color: #bbb;
          text-decoration: none;
          cursor: pointer;
        }
    
        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
         #caption {
            width: 100%;
          }
        }
    </style>
@endsection


@section('title','Medicamentos')

@section('content')
    <div class="section-body py-0 card-body">
        <div class="container row d-flex justify-content-between" style="height:650px;">
             <div class="col-7" >
                <span class="col-7 card-header px-4">
                    <span class="row pl-4">
                    <span class="col-3 text-start">NOMBRE</span>
                    <span class="col-3">PRESENTACIÓN</span>
                    <span class="col-2">MEDIDA</span>
                    <span class="col-2">UNIDAD</span>
                    <span class="col-2">STOCK</span>
                    </span>
                </span>
                <div class="table-responsive p-2 pt-0" style="height:100%;overflow-y: scroll;">
                    
                    <div id="accordion" style="">

                        @foreach ($stock as $item )
                        <div class="p-0 row card"  style="border:1px solid #000">
                           
                          <div class="card-header col-12 px-2" id="headingOne">
                            <h5 class="mb-0 row ">
                            <a class="btn col-12" data-toggle="collapse" data-target="#id{{$item->id}}{{$item->medicine_pharmacy->medicine->name}}" aria-expanded="false" aria-controls="">
                                  <span class="row">
                                    <span class="col-3 text-start">{{ $item->medicine_pharmacy->medicine->name }}</span>
                                    <span class="col-3">{{ $item->medicine_pharmacy->presentation }}</span>
                                    <span class="col-2">{{ $item->medicine_pharmacy->measure }} </span>
                                    <span class="col-2">{{ $item->medicine_pharmacy->quantity_Unit }}</span>
                                    <span class="col-2">{{$item->total}}</td>  </span>        
                                  </span>                      
                                </a>
                            </h5>
                          </div>                      
                          <div id="id{{$item->id}}{{$item->medicine_pharmacy->medicine->name}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style=" border-top:none">
                            <div class="card-body">
                                
                            <table class="table" cellspacing="0" id="addrowExample">
                                <thead>
                                    <tr>
                                        <th>Fecha de vencimiento</th>
                                        <th>Numero de lote</th>                                        
                                        <th class="text-center">Stock</th>
                                        <th class="text-center">Asignar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->medicine_pharmacy->lot_pharmacy2 as $item2)
                                        <tr>
                                            <td>{{ $item2->date_vence }} </td>
                                            <td>{{ $item2->number_lot }}</td>
                                            <td>{{ $item2->quantity_total }}</td>                                           
                                            <td class="text-center">
                                                <input type="button" style="cursor:pointer" value="asignar" id="modal_asignar" name="{{$item2->id}}" class="text-dark btn"  data-toggle="modal" 
                                            >
                                            {{-- <i class="fe fe-arrow-right"></i> --}}
                                            </td>
                                        </tr>
                                    @endforeach   
                                </tbody>
                            </table>
                            </div>
                          </div>
                         
                        </div>
                        @endforeach                        
                      </div>               
                </div>          
            </div>
  

            <div class="col-5 card p-1">
                <div class="row ">
                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="addrowExample">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>presentatión</th>
                                <th>Medida</th>
                                <th>Cant.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stock as $item )
                                <tr>
                                    <td>{{ $item->medicine_pharmacy->medicine->name }}</td>
                                    <td>{{ $item->medicine_pharmacy->presentation }}</td>
                                    <td>{{ $item->medicine_pharmacy->measure }} </td>
                                    <td>{{ $item->medicine_pharmacy->quantity_Unit }}</td>
                                </tr>
                            @endforeach   
                        </tbody>
                    </table>
                </div>
               

             {{-- <div class="mt-0 card-header text-center">
                <h5>Requisición</h5>
                </div>
                <div class="row d-flex d-row justify-content-column rawp" style="height:550px; overflow: scroll;">
                    @if ($informe->surgery->file_doctor->first() != null)
                    <div class="col-12 mr-2 p-0">
                        @foreach ($informe->surgery->file_doctor as $item)
                            <div class="m-0 mb-4 p-0" style="height:200px;">
                                <img src="{{ Storage::url($item->path) }}" alt="Snow" id="myImg" name="{{ $item->path }}" class="img-thumbnail m-0" style="width:100%; height:100%">; 
                            </div>
                        @endforeach  
                    </div>
                    @endif
                </div> --}}
                
            </div>
        </div>  
    </div>

    <div id="myModall"  data-backdrop="static" class="modal modall">
        <div class="container"> 
        <div class="row"> 
        <button type="button" class=" close1 atras" data-dismiss="modal" aria-label="Close"></button>
        <div class="col-6 align-right"  id="cambiar">
            <a class="btn medio  " style="color:#fff; font-size:20px;"><i class=" sombra fe fe-plus"></i></a>
        </div>  
        <div class="col-6 " id="restaurar">
            <a class="btn atras  " style="color:#fff; font-size:20px;"><i class=" fe fe-minus"></i></a>
        </div>       
        </div>      
        <div class="caption" id="caption">
        </div>
    </div>


    </div>


      <!---------------------- Modal para ingresar cantidad que se desea asignar--------------->
      <div class="modal fade" id="asignar_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Cantidad para asignar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('farmaceuta.asignandoM')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
          
                <div id="agregar">

                </div>
                <div class="form-group">
                  <input type="hidden" name="surgery_id" value="{{$informe->surgery->id}}">
                  <textarea class="form-control" name="cantidad" id="cantidad"></textarea>
                </div>
            
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-azuloscuro text-white">Asignar</button>
              </div>
          </form>
          </div>
        </div>
      </div>

@endsection

@section('scripts')

<script src="{{ asset('assets\bundles\modalSearch.js') }}"></script>

<script>
//===========================mostrar imagen en modal=================================
$('img[id="myImg"]').on('click',function(){
       var modalImg = this.name;

       console.log('aqui va la imagen seleccionada', modalImg);

       concatenar = '/Storage/';
       url = concatenar+modalImg;

   $('#caption').html('<img src="'+url+'" alt="Snow" class=" ml-3 img-thumbnail modal-content" style="  display: block; width: 80%; max-width: 1500px; ">');
   $('#myModall').modal('show');
});
</script>

<script>
    $('.medio').click(function(){
        console.log('zoon_max');
        $("#caption").removeClass("caption");
        $("#caption").addClass("caption_extra_grande");

        $('#cambiar').html('<a class="btn" style="color:#fff; font-size:20px;"><i class="  fe fe-plus"></i></a>');

    });
</script>

<script>
    $('.atras').click(function(){
        console.log('zoon_max_atras');
        $("#caption").removeClass("caption_extra_grande");
        $("#caption").addClass("caption");
        $('#cambiar').html(`<a class="btn extra_grande" id="grande" style="color:#fff; font-size:20px;"><i class="   fe fe-plus"></i></a> ` );
                        //   <a class="btn" id="grande_menor" style="color:#fff; font-size:20px;"><i class="fe fe-minus"></i></a>` );
        //aumentar
        $('#grande').click(function(){
                console.log('zoon_max');
                $("#caption").removeClass("caption_medio");
                $("#caption").addClass("caption_extra_grande");

                $('#cambiar').html(`<a class="btn" id="extra_grande" style="color:#fff; font-size:20px;"><i class=" sombra fe fe-plus"></i></a> `);
     
    });
});
  
  //=================asignacion de medicamento================
$('input[id="modal_asignar"]').on('click',function(){
       var id = this.name;
       console.log('hola',id);

   $('#agregar').html('<input type="hidden" name="lot_id" value="'+id+'"> ');
   $('#asignar_modal').modal('show');
});


</script>

@endsection
