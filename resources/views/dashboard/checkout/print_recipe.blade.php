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
  font-size: 13px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
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
  padding-left: 20px;
  padding-top: 20px;
  text-align: center;
}


table td.service{
  vertical-align: center;
  text-align: justify;
}
table td.desc {
  vertical-align: center;
  text-align: justify;
  /* height: 2000px; */
  /* border-left: #a1a1a1 dashed 2px; */
}

main .descc{
  height: 1200px;  
  border-left: #a1a1a1 dashed 2px;
  text-align: justify;
  vertical-align: center;
}



#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #000000;
  width: 100%;
  height: 80px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #248b40;
  padding: 8px 0px;
  text-align: center;
}

.imgfondo{
  position: relative;
  opacity: .1;
  background-position: center;
  vertical-align: top;
  width: 500px;
  margin-left: -5px;
  margin-top: 60px;
}

.imgfondo2{
  position: relative;
  opacity: .1;
  background-position: center;
  vertical-align: top;
  width: 500px;
  margin-left: 25px;
  margin-top:60px;
}

.encabezado{
  width: 1000px;
  margin-top: 10px;
}

.footer{
margin-left: 10px;
font-size: 14px;
width: 480px;
float: left;

}

.footer2{
margin-left: 30px;
font-size: 14px;
width: 480px;
float: right;

}

.medicamento{
  width: 480px;
}

.indicacion{
  width: 520px;
}

.indicacion2{
  width: 520px;
  border-left: #a1a1a1 dashed 2px;
}

.text_paciente .datos{
}

.ancho{
  text-align:left;
  border-bottom: 1px solid #000; 
  width: 400px;
  float: right;
  margin-top: 17px;
}

.an{
  width: 480px;
  margin-bottom: 10px; 
}

.an2{
  width: 480px;

}

.an1{
  width: 50px;
  float: left;
  padding-top: 20px; 
  text-align:left;
}

.an11{
  width: 50px;
  float: left;
  padding-top: 2px; 
  text-align:left; 
}

.ancho1{
  text-align:left;
  border-bottom: 1px solid #000;  
  width: 400px;
  float: right;
}

.datos{
  padding-left: 10px; 
}

</style>
  </head>
  <body>
    <header class="clearfix">
      <img src="assets/images/Encabezado_Recipe.png" class="encabezado">
    </header>

    <main class="descc">
      <img src="assets/images/Isotipo_S&F.svg" class="imgfondo">
      <img src="assets/images/Isotipo_S&F.svg" class="imgfondo2">
      <table class="">
          <thead>
          <tr>
              <th class="service"><h3 style="margin-top:20px;margin-bottom:-5px">MEDICAMENTOS:</h3></th>
              <th class="desc" style="border-left:#a1a1a1 dashed 2px"><h3 style="margin-top:20px;margin-bottom:-5px">INDICACIONES:</h3></th>
          </tr>
          </thead>

          <tbody>
            @foreach ($recipe->medicine as $item)
              <tr>
                  <td class="medicamento" style="text-align:left">{{ $item->name}} ({{ $item->treatment->measure }}) </td>
                  <td class="indicacion2" style="text-align:left">{{ $item->name }}  ({{ $item->treatment->measure }}) tomar {{ $item->treatment->doses }} por  {{ $item->treatment->duration }}  {{ $item->treatment->indications }}</td>
              </tr>
            @endforeach  
          </tbody>
      </table>
    </main>

    <footer class="clearfix">
      <div class="footer">
        <div class="an"><div class="an1"><span class="text_paciente">PACIENTE:  </span></div><div class="ancho"> <span class="datos"> {{ $recipe->patient->name }} {{ $recipe->patient->lastname }}</span> </div></div>
        <br><div class="an"><div class="an1"><span class="text_paciente">EDAD:  </span></div><div class="ancho"> <span class="datos"> {{ $paciente->age }} </span> </div></div>
        <br><div class="an"><div class="an1"><span class="text_paciente">DOCTOR:  </span></div><div class="ancho"> <span class="datos"> {{ $recipe->employe->person->name }} {{ $recipe->employe->person->lastname }} </span> </div></div>
        <br><div class="an"><div class="an1"><span class="text_paciente">FECHA:  </span></div><div class="ancho"> <span class="datos"> {{ $fecha }} </span> </div></div>
      </div>

      <div class="footer2">
        <br><div class="an2"><div class="an11"><span class="text_paciente">PACIENTE: </span></div><div class="ancho1"> <span class="datos"> {{ $recipe->patient->name }} {{ $recipe->patient->lastname }}</span> </div></div>
        <br><div class="an2"><div class="an11"><span class="text_paciente">EDAD:  </span></div><div class="ancho1"> <span class="datos"> {{ $paciente->age }} </span> </div></div>
        <br><div class="an2"><div class="an11"><span class="text_paciente">DOCTOR:  </span></div><div class="ancho1"> <span class="datos"> {{ $recipe->employe->person->name }} {{ $recipe->employe->person->lastname }} </span> </div></div>
        <br><div class="an2"><div class="an11"><span class="text_paciente">FECHA:  </span></div><div class="ancho1"> <span class="datos"> {{ $fecha }} </span> </div></div>  
      </div>

    </footer>
</body>
</html>

