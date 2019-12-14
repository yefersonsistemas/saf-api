
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Factura</title>
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
  width: 99%;
  max-width: 99%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-top: -15px;
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

footer {
  color: #000000;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #000000; 
  padding: 8px 0;
  text-align: center;
}

table .desc {
  text-align: center;
  width: 480px;
  background: transparent;
  /* border-bottom: :#00ad88 solid 1px; */
}

table .desc_titulo {
  padding-left: 10px;
  width: 480px;
  background: transparent;
  font-size:13px;

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
  font-size: 15px;
}

table tbody tr:last-child td {
  border: none;
  padding-bottom: 15px
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 15px;
  white-space: nowrap; 
  border-left: none;
  color: #000000; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #000000;
  font-size: 15px;
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
  height: 100px;
  width: 480px;
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
  font-size: 12px;
  line-height: 15px;
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
  padding-left: 100px
}

#invoice h1 {
  color: #000000;
  font-size: 17px;
  line-height: 1em;
  font-weight: normal;
  text-align: center;
  margin-top:-17px;
}

#invoice h2 {
  color: #000000;
  font-size: 17px;
  line-height: 1em;
  font-weight: normal;
  text-align: center;
  margin-top: -5px;
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

#doctor {
  margin-left: 150px;
  line-height: 15px;
  color: #000000;
  font-size: 12px;
}

.fondo{
  position: absolute;
  opacity: .08;
  vertical-align: top;
  width: 400px;
  /* height: 100px; */
  margin-top: 5px;
  margin-left: 150px;  
}

</style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="assets/images/Encabezado_Factura.svg" class="logo">    
      </div>

      <div id="invoice">
        <h1>Factura N°</h1>
        <h2 class="nfactura">00000001</h2>
      </div>
    </header>

    <main>
      <img src="assets/images/Isotipo_S&F.svg" class="fondo">
      
      <div id="details" class="clearfix">
        <div id="client">
          <div class="name"> 
            <span style="font-weight:bold">Cliente:</span><span class="text" style="margin-left:48px;text-transform:uppercase">{{ $todos->person->name }} {{ $todos->person->lastname }}.</span>
          </div>
          <div class="dni">
            <span style="font-weight:bold">RNC/Cédula:</span><span class="text" style="margin-left:18px;text-transform:uppercase">{{ $todos->person->type_dni }}</span> <span class="text">{{ $todos->person->dni }}.</span>
          </div>
          <div class="phone">
            <span style="font-weight:bold">Teléfono:</span><span class="text" style="margin-left:40px;text-transform:uppercase">{{ $todos->person->phone }}.</span>
          </div>
          <div class="address">
            <span style="font-weight:bold">Dirección:</span><span class="text" style="margin-left:35px;text-transform:uppercase">{{ $todos->person->address }}.</span>
          </div>
        </div>
        <div id="doctor">
            <div class="date">
              Factura Emitida en la Fecha  {{ $fecha }}<br> 
              En Santo Domnido, Republica Dominicana.<br>
            </div>
        </div> <br><br><br>
        <div class="row">
              <span style="font-weight:bold; font-size:13px; color:#000; margin-left:5px">Forma de Pago:</span><span style="color:#000">{{ $todos->typepayment->name }}. </span>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th colaspan="4" class="campo_titulo" style="border-top:#000000 solid 1px; 
              border-bottom:#000000 solid 1px;text-align:left; padding-right:20px; font-weight:bold">
              Descripción</th>
            <th colaspan="4" class="total" style="border-top:#000000 solid 1px;border-bottom:#000000 solid 1px;  font-weight:bold; text-align:right; padding-right:15px">Total</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td class="desc_titulo" style="text-align:left">Consulta Medica a Paciente <span style="font-weight:bold">
                {{ $todos->patient->name }} {{ $todos->patient->lastname }}</span> <br>
                por el Doctor/a {{ $todos->employe->person->name }} {{ $todos->employe->person->lastname }}.
                </td>
                <td class="total" style=" padding-right:10px; text-align:right;">{{ number_format($todos->employe->doctor->price,2) }}</td>
            </tr>

          @if($todos->procedure->first() != null)
              @foreach ($todos->procedure as $item)
              <tr class="proces">
                  <td class="desc" style="text-align:left; padding-left:10px">
                      <span colspan="1"></span>Procedimiento {{ $item->name }}
                  </td>
              
                  <td class="total" style=" padding-right:10px; text-align:right;">{{ number_format($item->price,2) }}</td>
              </tr>
              @endforeach
              @endif
          
          @if($cirugia->surgery != null)
              <tr>
                <td class="desc" style="text-align:left;padding-left:10px">
                    Cirugía {{ $cirugia->surgery->typesurgeries->name }}
                  </td>
                  <td class="total" style="border-bottom:#000000 solid 1px; padding-right:10px; text-align:right; ">{{ number_format($cirugia->surgery->typesurgeries->cost,2) }}</td>    
              </tr>
              @endif
            
        </tbody>      
        <tfoot>
        <tr>
          <td colspan="1" style="border-top:#000000 solid 1px;  font-weight:bold;">Sub-Total&nbsp;{{ $todos->typecurrency->name }}</td>
          <td style="text-align:right; padding-right:10px">{{ number_format($total_cancelar,2) }}</td>
        </tr>        <tr>
            
            <td colspan="1" style="padding-top:-5px;  font-weight:bold">Total&nbsp;{{ $todos->typecurrency->name }}</td>
            <td style="text-align:right;padding-top:-5px; padding-right:10px">{{ number_format($total_cancelar,2) }}</td>
        </tr>
      </tfoot>
    </table>
  </main>
</body>
</html>



