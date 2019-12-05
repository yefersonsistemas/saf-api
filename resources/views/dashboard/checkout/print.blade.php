
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <link rel="stylesheet" href="style.css" media="all" />
  <style>
    
  @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 100%;  
  height: 100%; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 2px solid #00ad88;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-top: -15px;
  margin-bottom: 20px;
  color: #000000;
}


table th,
table td {
  padding: 5px;
  background: transparent;
  border-left: none;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
  border-left: none;
}

table td {
  text-align: right;
  border-left: none;
}

table td h3{
  color: #000000;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

footer {
  color: #000000;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA; 
  padding: 8px 0;
  text-align: center;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
  color: #000000
}

table .desc {
  text-align: center;
  width: 480px;
  background: transparent;
  border-bottom: :#00ad88 solid 1px;
}

table .desc_titulo {
  padding-left: 10px;
  width: 480px;
  background: transparent;
  font-size:14px;
  font-weight: bold;

}

table .total {
  background: transparent;
  color: #000000;
  width: 100px;
  text-align: center;
  border-left: none;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.0em;
  white-space: nowrap; 
  border-left: none;
  color: #000000; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #000000;
  font-size: 1.2em;
}

table tfoot tr td:first-child {
  border: none;
}

.no{
  border:none;
}

#logo {
  float: left;
  margin-top: 8px;
}

.logo {
  margin-top: -40px;
  height: 120px;
  width: 520px;
  margin-bottom: -20px;
}

#company {
  /* float: right; */
  text-align: right;
}


#details {
  margin-bottom: 28px;
}

#client {
  padding-left: 6px;
  float: left;
  color:#000000;
  font-weight: normal;
  font-size: 13px;
  line-height: 15px
}

#client .to {
  color: #000000;
  font-weight: bold;
  font-size: 16px;
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

#invoice {
  text-align: right;
  margin-bottom: -5px;
}

#invoice h1 {
  color: #000000;
  font-size: 20px;
  line-height: 1em;
  font-weight: normal;
  text-align: center;
  margin-top:-5px 
}

#invoice h2 {
  color: #000000;
  font-size: 20px;
  line-height: 1em;
  font-weight: normal;
  text-align: center;
}

#invoice .date {
  font-size: 25px;
  color: #0059b2;
  margin-bottom: -20px;
}


#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}


.proces{
    padding-left: 20px;
    /* text-align: left; */
}

.campo_titulo{
    padding-left: 10px; 
}

.space{
    margin-left:10px;
}

#doctor {
  margin-left: 250px;
  line-height: 15px;
}
/* 
.titulo{
    font-weight: bold;
} */

.fondo{
  position: absolute;
  opacity: .2;
  vertical-align: top;
  width: 600px;
  margin-top: 200px;
  margin-left: 50px;
}

</style>

    
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="assets\images\Encabezado_Factura.svg" class="logo">    
      </div>

      <div id="invoice">
        <h1>Factura N°</h1>
        <h2 class="nfactura">00000001</h2>
        {{-- <div class="date">Fecha: 01/06/2014</div> --}}
      </div>
    </header>

    <main>
      <img src="assets/images/logo_factura.png" class="fondo">
      <div id="details" class="clearfix">
        <div id="client">
          <div class="name"> 
            <span style="font-weight:bold">Cliente:</span><span class="text" style="margin-left:50px">{{ $todos->person->name }} {{ $todos->person->lastname }}</span>
          </div>
          <div class="dni">
            <span style="font-weight:bold">RNC/Cedula:</span><span class="text" style="margin-left:18px">{{ $todos->person->type_dni }}</span> <span class="text">{{ $todos->person->dni }}</span>
          </div>
          <div class="phone">
            <span style="font-weight:bold">Teléfono:</span><span class="text" style="margin-left:40px">{{ $todos->person->phone }}</span>
          </div>
          <div class="address">
            <span style="font-weight:bold">Dirección:</span><span class="text" style="margin-left:35px">{{ $todos->person->phone }}</span>
          </div>
        </div>
        {{-- <div id="doctor">
            <div class="docname">
              <span>Doctor/a:</span> <span class="text">{{ $todos->employe->person->name }} {{ $todos->employe->person->lastname }}</span>
            </div>
            <div class="docdni">
              <span>Cedula:</span><span class="text"> {{ $todos->employe->person->type_dni }}</span> <span class="text">{{ $todos->employe->person->dni }}</span>
            </div>
            <div class="docphone">
              <span>Telefono:</span><span class="text">{{ $todos->employe->person->phone }}</span>
            </div>
        </div> --}}
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th colaspan="4" class="campo_titulo" style="border-top:#000000 solid 1px; 
              border-bottom:#000000 solid 1px;text-align:left;">
              DESCRIPCIÓN</th>
            <th class="no" style="border-top:#000000 solid 1px; border-bottom:#000000 solid 1px;"></th>
            <th colaspan="4" class="total" style="border-top:#000000 solid 1px;border-bottom:#000000 solid 1px;">TOTAL</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td class="desc_titulo" style="text-align:left">Consulta Medica a Paciente: {{ $todos->patient->name }} {{ $todos->patient->lastname }}
                </td>
                <td class="no"></td>
                <td class="total">{{ $todos->employe->doctor->price }}</td>
            </tr>

        @if($todos->procedure->first() != null)
            <tr>
              <td class="desc_titulo">Procedimientos</td>
              <td class="total"></td>
              <td class="no"></td>
            </tr>
            @foreach ($todos->procedure as $item)
            <tr class="proces">
                <td class="no" ></td>
                <td class="desc">

                    <span colspan="1" class="space"></span>{{ $item->name }}
                </td>
            
                <td class="total">{{ $item->price }}</td>
            </tr>
            @endforeach
            @endif
        

        @if($cirugia->surgery != null)
            <tr>
              <td class="desc_titulo" style="text-align:left">Cirugía</td>
              <td class="total"></td>
              <td class="no"></td>
            </tr>
            <tr>
              <td class="desc" style="text-align:left;padding-left:10px">
                  {{ $cirugia->surgery->typesurgeries->name }}
                </td>
                <td class="no"></td>
                <td class="total" style="border-bottom:#000000 solid 1px;">{{ $cirugia->surgery->typesurgeries->cost }}</td>    
            </tr>
            @endif
            
        </tbody>      
        <tfoot>
        <tr>
          <td colspan="1" style="border-top:#000000 solid 1px;"></td>
          <td colspan="1" style="border-top:#000000 solid 1px">SUBTOTAL</td>
          <td style="text-align:center;">{{ $total_cancelar }}</td>
          </tr>
          <tr>
            <td colspan="1"></td>
            <td colspan="1">TOTAL</td>
            <td style="text-align:center;">{{ $total_cancelar }}</td>
          </tr>
        </tfoot>

      </table>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>

{{-- 

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div id="app">

        <div class="section-body py-3 row">

            <div class="section-body py-3 col-8 ml-4 ">
                <div class="container">
                    <div class="tab-content">

                        <div class="tab-pane fade active show" id="Invoice-detail" role="tabpanel">
                            <div class="row clearfix">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header row">
                                            <div class="col-8">
                                                    <img src="{{ asset('assets\images\logo_factura.png') }}" class="w-100 " style="width:200px">
                                            </div>
                                            <div class="col-3 text-right"><p class="h66 text-right">#AB0017</p></div>
                                        
                                        </div>

                                        <!--Datos de la empresa-->
                                        <div class="row my-8 pr4 pl-4 ">
                                            <div class="col-12"> <span class="text"> Rif:</span></div>
                                            <div class="col-12"> <span class="text">Dirección:</span></div>
                                            <div class="col-12"> <span class="text">Telefono:</span></div>
                                        </div><br>

                                        <div class="card-body mt-0">
                                            <div class="row">
                                                <div class="col-2">
                                                        <span class="h6 h66">Paciente:</span>
                                                </div>
                                                <div class="col-8">
                                                    <span id="dni" class="text">{{ $todos->patient->type_dni }}</span>
                                                    <span id="dni" class="text">{{ $todos->patient->dni }}</span>
                                                    <span id="name" class="text">{{ $todos->patient->name }} {{ $todos->patient->lastname }}</span>
                                                    <span id="phone" class="text">{{ $todos->patient->phone }}</span><br> 
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-2">
                                                    <span class="h6 h66">Doctor:</span>
                                                </div>
                                                <div class="col-10">
                                                    <span class="text">{{ $todos->employe->person->type_dni }}</span>
                                                    <span class="text">{{ $todos->employe->person->dni }}</span>
                                                    <span class="text">{{ $todos->employe->person->name }} {{ $todos->employe->person->lastname }}</span>
                                                    <span class="text">{{ $todos->employe->person->phone }}</span><br>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-4">
                                                    <span class="h6 h66">Cancelado por:</span>
                                                </div>
                                                <div class="col-10">
                                                    <span class="text">{{ $todos->person->type_dni }}</span>
                                                    <span class="text">{{ $todos->person->dni }}</span>
                                                    <span class="text">{{ $todos->person->name }} {{ $todos->person->lastname }}</span>
                                                    <span class="text">{{ $todos->person->phone }}</span><br>
                                                </div>                                                
                                            </div>

                                            <div class="table-responsive push">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <th colspan="12" style="with:40px" class="text-center">Nombre</th>
                                                        <th colspan="12" class="text-center" >Costo</th>
                                                    </thead>       
                                                    <tbody style="border-bottom: 1px solid #000 row ">
                                                        <th class="text-center width35"></th>
                                                        <th colspan="4">Consulta</th>
                                                        <td class="text-right" style="width: 1%">{{ $todos->employe->doctor->price }}</td>
                                                    </tbody>                                                
                                                </table>
                                                <table>
                                                        <tbody style="border-bottom: 1px solid #000 row ">
                                                            <th class="text-center width35"></th>
                                                            <th colspan="4">Consulta</th>
                                                            <td class="text-right" style="width: 1%">{{ $todos->employe->doctor->price }}</td>
                                                        </tbody>

                                                        <tbody style="border-bottom: 1px solid #000">
                                                            <th class="text-center width35"></th>
                                                            <th colspan="4">Procedimiento</th>
                                                            <th class="text-right" style="width: 4%"></th>
                                                        </tbody>
                                                        
                                                        <tbody ><br><br>
                                                            @foreach ($todos->procedure as $item)
                                                            <tr>
                                                                <td class="text-center width35"></td>
                                                                <td colspan="4">
                                                                    <div class="text-muted">{{ $item->name }}</div>
                                                                </td>
                                                            
                                                                <td class="text-right" style="width: 1%">{{ $item->price }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody> 

                                                        <tbody style="border-bottom: 1px solid #000">
                                                            <th class="text-center width35"></th>
                                                            <th colspan="4">Cirugía</th>
                                                            <th class="text-right" style="width: 4%"></th>
                                                        </tbody>
                                                    
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center width35"></td>
                                                                <td colspan="4">
                                                                    <div class="text-muted">{{ $cirugia->surgery->typesurgeries->name }}</div>
                                                                </td>
                                                                <td class="text-right" style="width: 1%">{{ $cirugia->surgery->typesurgeries->cost }}</td>
                                                            </tr>
                                                        </tbody>                                             
                                                        <tr>
                                                            <th class="text-center width35"></th>
                                                            <td colspan="4" class="font600 text-right">Subtotal</td>
                                                            {{-- <td class="text-right" id="subtotal">{{ $total }}</td>  --}}
                                                        {{-- </tr>
                                                        
                                                        <tr class="bg-info text-light">
                                                            <th class="text-center width35"></th>
                                                            <td colspan="4" class="font700 text-right">Total a cancelar</td> --}}
                                                            {{-- <td class="font700 text-right" id="costo_total">{{ $total }}</td> --}}
                                                        {{-- </tr>
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

        </div>

        @section('scripts')
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
@endsection
    </div>
</body>

</html> --}} 


