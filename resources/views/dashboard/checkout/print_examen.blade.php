
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

main {
  position: relative;
}


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
  padding: 0px;
  /* border-bottom: 1px solid #a1a1a1; */
  white-space: nowrap;        
  font-weight: normal;
  font-size: 20px;
}

table .service,
table .desc {
  text-align: left;
  color: #000000;
}

table .services,
table .desc {
  text-align: center;
  color: #000000;
}

table td {
  padding-left: 100px;
  padding-top: 10px;
  text-align: center;
  font-size: 16px;
  /* margin-left: 20px;  */
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
  /* padding-top: 8px; */
  padding-left: 50px;
  /* margin: 20px; */
  margin-left:50px;
  margin-right: 20px;
  position: relative;
  opacity: 0.05;
  background-position: center;
  vertical-align: top;
  width: 60%
}

#details{
  text-align: center
}

.encabezado{
  width: 100%;
  /* margin-top: 10px; */
  height: 100px;
}

/* #logo {
  float: left;
  margin-top: 8px;
} */

.logo {
  margin-top: -35px;
  height: 120px;
  width: 590px;
  margin-bottom: -8px;
  margin-left: 40px;
}

.hh{
  border-bottom: 1px solid #00ad88;
}

.indi{
  text-align: center;
  color: #000000;
  padding-top: 30px 
}

.indic{
  text-align: left;
  color: #000000;
  padding-left: 0px;
  padding-top: 10px;
}
</style>
  </head>
  <body>
    <header class="clearfix">
        {{-- <img src="assets/images/Encabezado_Factura.svg" class="encabezado"> --}}
        <div class="hh">
        <img src="assets\images\Encabezado_Factura.svg" class="logo">   
        </div>

    </header>
    <main>
        <img src="assets/images/Isotipo_S&F.svg" class="imgfondo">
    <table>
      <thead>
        <tr>
          <th class="services">Orden de Examen Medico</th>
          {{-- <th class="desc">INDICACIONES</th> --}}
        </tr>
        </thead>
        <tbody>
        @foreach ($examenes as $item)
            <tr>
              <td class="service"><li>{{ $item->name }}</li></td>
              {{-- <td class="desc">Sin indicaciòn</td> --}}
            </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th class="indi" >Indicaciones</th>
          </tr>
          <tr>
            <td class="indic">
              <div style="border-bottom: 1px solid #000;">
                <span>.</span>
              </div>
              <div style="border-bottom: 1px solid #000;">
                <span>.</span>
              </div>
              <div style="border-bottom: 1px solid #000;">
                <span>.</span>
              </div>
              <div style="border-bottom: 1px solid #000;">
                <span>.</span>
              </div>
              <div style="border-bottom: 1px solid #000;">
                <span>.</span>
              </div>
              <div style="border-bottom: 1px solid #000;">
                <span>.</span>
              </div>
            </td>
          </tr>
        </tfoot>
    </table>
    {{-- <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    </div> --}}
    </main>
    {{-- <footer>
    Invoice was created on a computer and is valid without the signature and seal.
    </footer> --}}
</body>
</html>


