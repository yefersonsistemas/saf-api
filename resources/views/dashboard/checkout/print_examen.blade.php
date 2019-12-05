
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Examenes</title>
    <style>
    .clearfix:after {
  content: "";
  display: table;
  clear: both;
}


a {
  color: #5D6975;
  text-decoration: underline;
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

/* main {
  position: relative;
}

main:before{
  content: "";
  background-image: url("assets/images/Isotipo_S&F.svg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  top: 60px;
  z-index: 0;
  width: 100%;
  height: 75%;
  position: absolute;
  opacity: .5;
} */

header {
  padding: 10px 0;
  margin-bottom: 30px;
  background-image: url("assets/images/Isotipo_S&F.svg");
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  /* border-top: 1px solid  #000000; */
  /* border-bottom: 1px solid  ; */
  color: #FFFFFF;
  font-size: 20px;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: #00ad88;
}

#project {
  /* float: left; */
  /* font-size:20px; */
}

#project span {
  color: #000000;
  text-align: center;
  width: 100px;
  margin-right: 10px;
  display: inline-block;
  font-size: 16px;
}

#company {
  /* float: right; */
  text-align: center;
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
  border-bottom: 1px solid #a1a1a1;
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
  vertical-align: top;
}
table td.desc {
  vertical-align: top;
  border-left: 1px solid #a1a1a1;
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

span .name{
  font-size:14px;
  width: 100px;
  text-align: center;
}

#client {
  padding-left: 6px;
  /* border-left: 6px solid #0087C3; */
}

#client .name_titulo{
  font-size:18px;
  text-align: center;
}

#invoice .name_titulo{
  font-size:18px;
}


#invoice {
  /* float: right; */
  text-align: right;
}
.imgfondo{
  position: relative;
  opacity: .2;
  background-position: center;
  vertical-align: top;
  width: 100%
}

#details{
  text-align: center
}

.encabezado{
  width: 100%;
  margin-top: 10px;
  height: 100px;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
        <img src="assets/images/Encabezado_Factura.svg" class="encabezado">

    {{-- <div id="logo">
        <img src="assets/images/Isotipo_S&F.svg">
        <div id="company" class="clearfix">
            <div>Sinus And Faces</div>
            <div>Dirección</div>
            <div>Numéros Telefonicos de la Empresa</div>
            <div>Correo de la Empresa</div>
        </div>
    </div>
        <h1>Examen a Realizar</h1>

        <div id="details" class="clearfix">
            <div id="client">
                <span class="name_titulo">Paciente:</span><br><br>
                <span class="name">Doc. de identidad:</span> <span>{{ $datos->person->type_dni }}</span> <span>{{ $datos->person->dni }}</span><br>
                <span class="name">Nombre:</span> <span>{{ $datos->person->name }} {{ $datos->person->lastname }}</span><br>
                <span class="name">Direcciòn:</i></span><span>{{ $datos->person->address }}</span><br>
                <span class="name">Telefono:</i></span><span >{{ $datos->person->phone }}</span><br> 
            </div>
        </div> --}}

    </header>
    <main>
        <img src="assets/images/Isotipo_S&F.svg" class="imgfondo">
    <table>
      <thead>
        <tr>
          <th class="service">EXAMEN</th>
          <th class="desc">INDICACIONES</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($examenes as $item)
            <tr>
              <td class="service">{{ $item->name }}</td>
              <td class="desc">Sin indicaciòn</td>
            </tr>
        @endforeach
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


