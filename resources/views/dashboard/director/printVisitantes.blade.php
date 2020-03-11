
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Lista de Empleados</title>
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
  /* margin-bottom: 20px; */
  border-bottom: 2px solid #00ad88;
  text-align: left;
}

table {
  width: 100%;
  max-width: 100%;
  /* border-collapse: collapse; */
  /* border-spacing: 0; */
  /* margin-top: -15px; */
  color: #000000;
}


table th,
table td {
  padding: 10px;
  background: transparent;
  /* border-left: none; */
}

table th {
    border-bottom: 2px solid #00ad88;
  white-space: nowrap;
  font-weight: normal;
  /* border-left: none; */
  text-align: left;
}

table td {
  text-align: left;
  /* border-left: none; */
}

footer {
  color: #000000;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  /* border-top: 1px solid #000000; */
  padding: 8px 0;
  text-align: left;
}

table .desc {
  text-align: left;
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
  text-align: left;
  /* border-left: none; */
}

table td.unit,
table td.qty,
table td.total {
  font-size: 15px;
}

table tbody tr:last-child td {
  /* border: none; */
  padding-bottom: 15px
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  /* border-bottom: none; */
  font-size: 15px;
  white-space: nowrap;
  /* border-left: none; */
  color: #000000;
}

table tfoot tr:first-child td {
  /* border-top: none; */
}

table tfoot tr:last-child td {
  color: #000000;
  font-size: 15px;
}

table tfoot tr td:first-child {
  /* border: none; */
}

/* .no{
  border:none;
} */

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

/* #company {
  float: right;
  text-align: right;
} */


/* #details {
  margin-bottom: 28px;
} */

/* #client {
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
} */

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

#invoice {
  text-align: center;
}

#invoice h1 {
  color: #000000;
  font-size: 20px;
  /* line-height: 1em; */
  font-weight: normal;
  text-align: center;
  margin-top:-17px;
  padding-bottom:-15px;
}

/* #invoice h2 {
  color: #000000;
  font-size: 17px;
  line-height: 1em;
  font-weight: normal;
  text-align: left;
  margin-top: -5px;
} */

#invoice .date {
  color: #0059b2;
}


/* #thanks{
  font-size: 2em;
  margin-bottom: 50px;
} */

/* #notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;
}

#notices .notice {
  font-size: 1.2em;
} */


/* .proces{
    padding-left: 20px;
    text-align: left;
} */

/* .campo_titulo{
    padding-left: 10px;
} */

/* #doctor {
  margin-left: 150px;
  line-height: 15px;
  color: #000000;
  font-size: 12px;
} */

.fondo{
  position: absolute;
  opacity: .08;
  vertical-align: top;
  width: 400px;
  /* height: 100px; */
  margin-top: 200px;
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
        <h1>Lista de Visitantes</h1>
        <div class="date">
            Lista emitida en la fecha  {{ $fecha }}
        </div>
      </div>
    </header>
    <main>
      <img src="assets/images/Isotipo_S&F.svg" class="fondo">

      <table>
        <thead>
            <tr>
                <th>DOCUMENTO</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>DIRECCION</th>
                <th>TELEFONO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all2 as $item)
                <tr>
                    <td>{{$item->dni}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->lastname}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->phone}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </main>
</body>
</html>
