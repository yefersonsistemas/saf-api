
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
  margin-top: 250px;
  margin-left: 150px;
}




div {
  border-radius: 5px;
}

#title {
  margin-left: 3%;
}

.stuff {
  display: inline-block;
  margin-top: 6px;
  margin-left: 55px;
  width: 75%;
}

p,
li {
  font-family: 'Cormorant Garamond';
}

.head {
  font-size: 20px;
}

#name {
  font-family: Sacramento;
  float: right;
  margin-top: 10px;
  margin-right: 4%;
}

a {
  color: black;
  text-decoration: none;
}


</style>
</head>

    <body>

        <header class="clearfix">

            <div id="logo">
                <img src="assets/images/Encabezado_Factura.svg" class="logo">
            </div>

            <div id="invoice">
                <h1>Ficha de empleado</h1>
                <div class="date">
                    Emitido en la fecha  {{ $fecha }}
                </div>
            </div>

        </header>

    <main>
        <img src="assets/images/Isotipo_S&F.svg" class="fondo">

        <div id="header"></div>
            <div class="stuff">
                <h2>{{ $employe->person->name }} {{ $employe->person->lastname }}</h2>
                <p class="head">Datos Personales</p>
                <ul>
                    <li>Documento de identidad: {{ $employe->person->type_dni }} - {{ $employe->person->dni }}</li>
                    <li>Nombre: {{ $employe->person->name }}</li>
                    <li>Apellido: {{ $employe->person->lastname }}</li>
                    <li>Dirección: {{ $employe->person->address }}</li>
                    <li>Teléfono: {{ $employe->person->phone }}</li>
                    <li>Correo electrónico: {{$employe->person->email }}</li>
                </ul>
                <p class="head">Cargo</p>
                <ul>
                    <li style="text-transform: capitalize;">{{$employe->position->name}}</li>
                </ul>
                @if ($employe->position->name == 'doctor' && $employe->person->user->role('doctor'))
                <p class="head">Especialidad</p>
                <ul>
                    @foreach ($employe->speciality as $item)
                    <li>{{$item->name}}</li>
                    @endforeach
                    @foreach ($diff_E as $demas)
                    <li>{{$demas->name}}</li>
                    @endforeach
                </ul>
                <p class="head">Clase</p>
                <ul>
                    <li>{{$buscar_C->name}}</li>
                </ul>
                <p class="head">Precio de consulta</p>
                <ul>
                    <li>{{ $precio->price }}</li>
                </ul>
                @endif
            </div>


      {{-- <div>
        <div>
                    <div>
                        <div>
                            <div>

                                <div>
                                   <div>
                                        <div style="display:inline;">
                                            <div style="display:inline;">Documento de Identidad</div>
                                            <div style="display:inline;">{{ $employe->person->type_dni }} - {{ $employe->person->dni }}</div>
                                        </div>

                                        <div>
                                            <div>
                                                <div>Nombre</div>
                                                <div>{{ $employe->person->name }}</div>
                                            </div>
                                        </div>

                                            <div class="col-lg-4 ">
                                                <div class="form-group">
                                                    <div>Apellido</div>
                                                    <div>{{ $employe->person->lastname }}</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 ">
                                                <div class="form-group">
                                                    <div>Direccion</div>
                                                    <div>{{ $employe->person->address }}</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 ">
                                                <div class="form-group">
                                                    <div>Teléfono</div>
                                                    <div>{{ $employe->person->phone }}</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 ">
                                                <div class="form-group">
                                                    <div>Correo Electronico</div>
                                                    <div>{{$employe->person->email }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    @if ($employe->position->name == 'doctor' && $employe->person->user->role('doctor'))
                                            <div class="col-lg-9 ">
                                                <div class="row">
                                                    <div class="col-lg-12"  id="framework_form">
                                                        <div>Especialidad</div>
                                                        <div class="form-group multiselect_div">
                                                            @foreach ($employe->speciality as $item)
                                                            <div>{{$item->name}}</div>
                                                            @endforeach
                                                            @foreach ($diff_E as $demas)
                                                            <div>{{$demas->name}}</div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                                <div class="col-lg-3 ">
                                                    <div class="form-group">
                                                        <div>Cargo</div>
                                                        <div>{{$employe->position->name}}</div>
                                                    </div>
                                            </div>
                                </div>
                    </div>
        </div>
    </div> --}}
  </main>
</body>
</html>



