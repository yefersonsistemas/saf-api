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

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
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
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
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

table td.service,
table td.desc {
  vertical-align: top;
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

#client {
  padding-left: 6px;
  /* border-left: 6px solid #0087C3; */
  float: left;
}

#client .name_titulo{
 font-size:18px;
}

#invoice .name_titulo{
 font-size:18px;
}


#invoice {
  /* float: right; */
  text-align: right;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
    <div id="logo">
      
        <div id="company" class="clearfix">
            <div>Nombre de la Empresa</div>
            <div>Dirección<br /> De la Empresa</div>
            <div>Numéros Telefonicos de la Empresa</div>
            <div>Correo de la Empresa</div>
        </div>
    </div>
        <h1>Recipe Medico</h1>
  
        <div id="details" class="clearfix">
            <div id="client">
                <span class="name_titulo">Paciente:</span><br><br>
                <span class="name">Doc. de identidad:</span> <span>{{ $recipe->patient->type_dni }}</span> <span>{{ $recipe->patient->dni }}</span><br>
                <span class="name">Nombre y Apellido:</span> <span>{{ $recipe->patient->name }} {{ $recipe->patient->lastname }}</span><br>
                <span class="name">Direcciòn:</i></span><span>{{ $recipe->patient->address }}</span><br>
                <span class="name">Telefono:</i></span><span >{{ $recipe->patient->phone }}</span><br> 
            </div>
            <div id="invoice">
                <span class="name_titulo">Medico tratante:</span><br><br>
                <span class="name">Doc. de identidad:</span> <span>{{ $recipe->employe->person->type_dni }}</span> <span>{{ $recipe->employe->person->dni }}</span><br>
                <span class="name">Nombre y Apellido:</span> <span>{{ $recipe->employe->person->name }} {{ $recipe->employe->person->lastname }}</span><br>
                <span class="name">Direcciòn:</i></span><span>{{ $recipe->employe->person->address }}</span><br>
                <span class="name">Telefono:</i></span><span >{{ $recipe->employe->person->phone }}</span><br> 
            </div>
        </div>
    </header>
    <main>
    <table>
        <thead>
        <tr>
            <th class="service">MEDICAMENTOS</th>
            <th class="desc">INDICACIONES</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($recipe->medicine as $item)
            <tr>
              <td class="service">{{ $item->name }}</td>
              <td class="desc">Creating a recognizable design solution based on the company's existing visual identity</td>
            </tr>
        @endforeach  
        </tbody>
    </table>
    </main>
    <footer>
    Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>
</html>

