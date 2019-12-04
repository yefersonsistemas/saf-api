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
}

#logo img {
  width: 120px;
}

h1 {
  border-top: 1px solid  #000000;
  border-bottom: 1px solid  #000000;
  color: #FFFFFF;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: #00ad88;
}

#project {
  /* float: left; */
}

#project span {
  color: #000000;
  text-align: center;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  /* float: right; */
  /* text-align: center; */
  color: #000000;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
  position: absolute;
  left: 0;
}

table tr:nth-child(2n-1) td {
  background: transparent;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  border-bottom: 1px solid #000000;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: center;
  color: #000000;
}

table td {
  padding: 20px;
  text-align: center;
}

table td.service{
  vertical-align: center;
}
table td.desc {
  vertical-align: center;
  border-left: #a1a1a1 dashed 2px;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
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

.cabecera{
  width: 50%;
  height: 100px;
}

.img{
  width: 200px;
  max-width: 35%;
  float: left;
  margin-left: -15px
}

.sociales{
  width: 200px;
  max-width: 35%;
  float: left;
  margin-left: -15px
}

.sociales ul{
list-style: none;
}

.img img{
  width: 100%;
}

.fila ul{
  list-style: none;
  width: 200px;
  max-width: 35%;
  float: left;
  margin-left: -50px;
  margin-top: 20px;
}

.cabecera2{
  width: 50%;
  height: 100px;
}

.img2{
  width: 200px;
  max-width: 35%;
  float: left;
  /* margin-left: -15px */
}

.sociales2{
  width: 200px;
  max-width: 35%;
  float: left;
  margin-left: -5px
}

.sociales2 ul{
list-style: none;
}

.img2 img{
  width: 100%;
}

.fila2 ul{
  list-style: none;
  width: 200px;
  /* max-width: 35%; */
  float: left;
  margin-left: -10px;
  /* margin-top: 20px; */
}

.logos{
  width: 13%;
  margin-left: -15px;
  margin-top: 5px;
  margin-right: 5px
}

</style>
  </head>
  <body>
    <header class="clearfix">
      
    <div  class="cabecera">
      <div class="img">
        <img src="assets/images/Imagotipo_S&F-NOV_Horizontal.svg" >
      </div>
        <div class="fila">
          <ul>
            <li style="text-align:center;">Consultorio:<br>
              Calle Pdte. Gonzaléz #4
            </li>
            <li style="text-align:center;">Clinica:<br>
              Calle El Vergel #27 C.P. 10107
            </li>
            <li style="text-align:center">Santo Domingo - Rep. Dom.</li>
          </ul>
        </div>
        <div class="sociales">
          <ul>
            <li><img src="assets/images/Internet.svg" class="logos">www.syfdominacana.com</li>
            <li><img src="assets/images/e-mail.svg" class="logos">info@syfdominicana.com</li>
            <li><img src="assets/images/Instagram.svg" class="logos">@syfclinic.dom</li>
            <li><img src="assets/images/Telefono.svg" class="logos">+1(786)544 43 16</li>
          </ul>
        </div>
    </div>
    
    {{-- <div  class="cabecera2">
        <div class="img2">
          <img src="assets/images/Imagotipo_S&F-NOV_Horizontal.svg" >
        </div> --}}
          {{-- <div class="fila2">
            <ul>
              <li style="text-align:center;">Consultorio:<br>
                Calle Pdte. Gonzaléz #4
              </li>
              <li style="text-align:center;">Clinica:<br>
                Calle El Vergel #27 C.P. 10107
              </li>
              <li style="text-align:center">Santo Domingo - Rep. Dom.</li>
            </ul>
          </div> --}}
          {{-- <div class="sociales2">
            <ul>
              <li><img src="assets/images/Internet.svg" class="logos">www.syfdominacana.com</li>
              <li><img src="assets/images/e-mail.svg" class="logos">info@syfdominicana.com</li>
              <li><img src="assets/images/Instagram.svg" class="logos">@syfclinic.dom</li>
              <li><img src="assets/images/Telefono.svg" class="logos">+1(786)544 43 16</li>
            </ul>
          </div> --}}
      {{-- </div> --}}
        {{-- <h1>Recipe Medico</h1> --}}
    {{-- <div id="project">
      <span>PACIENTE:</span><span>Nombre</span> 
      <span>DNI:</span><span>AQUI</span>  
      <span>DIRECCIÓN:</span><span>AQUI</span> 
      <span>EMAI:</span><span>AQUI</span> 
      <span class="fecha">FECHA:</span><span>August 17, 2015</span> 
    </div> --}}
    </header>
    <main>
      <img src="assets/images/Isotipo_S&F.svg" class="imgfondo">
      <img src="assets/images/Isotipo_S&F.svg" class="imgfondo2">
    <table>
        <thead>
        <tr>
            <th class="service">MEDICAMENTOS</th>
            <th class="desc">INDICACIONES</th>
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
    Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>
</html>

