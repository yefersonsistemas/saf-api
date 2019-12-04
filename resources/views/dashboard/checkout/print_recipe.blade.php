<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Recipe Medico</title>
    <style>
    .clearfix:after {
  content: "";
  display: table;
  clear: both;
}



body {
  position: relative;
  width: 100%;  
  height: 100%; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  /* margin-bottom: 10px; */
  margin-top: -25px;
  width: 100%;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
  margin-top: -20px;
  position: absolute;
  left: 0;
}

table tr:nth-child(2n-1) td {
  background: transparent;
}

table th,
table td {
  text-align: justify;
}

table th {
  padding: 5px 20px;
  border-top: 1px solid #248b40;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: justify;
  color: #000000;
}

table td {
  padding: 20px;
  text-align: center;
}

table td.service{
  vertical-align: center;
  text-align: justify;
}
table td.desc {
  vertical-align: center;
  text-align: justify;
  height: 580px;
  border-left: #a1a1a1 dashed 2px;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #000000;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #248b40;
  padding: 8px 0;
  text-align: center;
}

.imgfondo{
  position: relative;
  opacity: .2;
  background-position: center;
  vertical-align: top;
  width: 500px;
  margin-left: -5px;
  margin-top: 60px;
}

.imgfondo2{
  position: relative;
  opacity: .2;
  background-position: center;
  vertical-align: top;
  width: 500px;
  margin-left: 25px;
  margin-top:60px;
}

.encabezado{
  width: 1040px;
  margin-top: 10px;
}

.footer{
margin-left: -550px;
font-size: 15px;
}

.footer2{
margin-left: 550px;
font-size: 15px;
margin-top: -40px
}
</style>
  </head>
  <body>
    <header class="clearfix">
      <img src="assets/images/Encabezado_Recipe.png" class="encabezado">
    </header>
    <main>
      <img src="assets/images/Isotipo_S&F.svg" class="imgfondo">
      <img src="assets/images/Isotipo_S&F.svg" class="imgfondo2">
    <table>
        <thead>
        <tr>
            <th class="service"><h3 style="margin-top:20px;margin-bottom:-5px">MEDICAMENTOS:</h3></th>
            <th class="desc" style="border-left:#a1a1a1 dashed 2px"><h3 style="margin-top:20px;margin-bottom:-5px">INDICACIONES:</h3></th>
        </tr>
        </thead>
        <tbody>
        
            {{-- @foreach ($recipe->medicine as $item)
            <tr>
              <td class="service">{{ $item->name }}</td>
              <td class="desc">Creating a recognizable design solution based on the company's existing visual identity</td>
            </tr>
        @endforeach   --}}
        <tr>
            <td class="service">Creating a recognizable design solution based on the company's existing visual</td>
            <td class="desc">Creating a recognizable design solution based on the company's existing visual </td>
        </tr>
        
        </tbody>
    </table>
    {{-- <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    </div> --}}
    </main>
    <footer>
      <div class="footer">
        <span>PACIENTE:</span><span style="text-decoration:underline">Yefferson</span>
        <span>EDAD:</span><span style="text-decoration:underline">________________</span><br>   
        <span>DOCTOR:</span><span style="text-decoration:underline">________________</span> 
        <span>FECHA:</span><span style="text-decoration:underline">August 17, 2015</span>
      </div>
      <div class="footer2">
        <span>PACIENTE:</span><span style="text-decoration:underline">______________</span>
        <span>EDAD:</span><span style="text-decoration:underline">________________</span><br>   
        <span>DOCTOR:</span><span style="text-decoration:underline">________________</span> 
        <span>FECHA:</span><span style="text-decoration:underline">August 17, 2015</span>
      </div>
    </footer>
</body>
</html>

