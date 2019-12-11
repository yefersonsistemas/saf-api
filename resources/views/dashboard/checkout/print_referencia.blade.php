<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Reposo Medico</title>
    <style>
    .clearfix:after {
    content: "";
    display: table;
    clear: both;
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

body {
    position: relative;
    width: 100%;  
    height: 100%; 
    margin: 0 auto; 
    color: #001028;
    background: #FFFFFF; 
    font-family: Arial, sans-serif; 
    /* font-size: 12px;  */
    font-family: Arial;
}

main {
    position: relative;
}


header {
    padding: 10px 0;
    margin-bottom: 30px;
}

span{
    font-weight: bold;
}

.titulo{
    text-align: center;
    color: #000000;
    font-size: 20px;
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin-top:-550px;
    letter-spacing: 1px;
}

.interes {
    text-align: left;
    margin-bottom: 10px;
    margin-left: 20px;
    margin-top:-490px;
    font-size: 18px;
    padding-top: 15px;
    letter-spacing: 1px;
    color: #000000;
    font-weight: bold;
}

.contenido {
    text-align: left;
    font-size: 15px;
    margin-left: 20px;
    margin-top: 20px;
    letter-spacing: 1px;
    line-height: 25px;
    color: #000000;
}

.imgfondo{
    /* padding-top: 8px; */
    padding-left: 50px;
    margin-top: 150px;
    margin-left:10px;
    position: relative;
    opacity: 0.05;
    background-position: center;
    vertical-align: top;
    width: 80%;
}

.encabezado{
    width: 100%;
  /* margin-top: 10px; */
    height: 100px;
}

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

.doctor{
    text-align: center;
    color: #000000;
    font-size: 15px;
    margin-top: 120px;
    line-height: 2px;
    letter-spacing: 1px;
}

.fecha{
    text-align: left;
    color: #000000;
    font-size: 15px;
    margin-left: 20px;
    letter-spacing: 1px;
    margin-top: 20px;
}

.att{
    text-align: left;
    margin-left: 20px;
    font-size: 15px;
    color: #000000;
    letter-spacing: 1px;
    margin-top: 40px;
}

.conte{
margin-top: -15px;
}

</style>
</head>
<body>
    <header class="clearfix">
        <div class="hh">
        <img src="assets/images/Encabezado_Factura.svg" class="logo">   
        </div>
    </header>
    <main>
        <img src="assets/images/Isotipo_S&F.svg" class="imgfondo">

            <div style="text-align:center;">
                <p class="titulo">REFERENCIA MEDICA</p>
            </div>

            <div class="content">
                <div class="interes"> 
                    <p>A quien pueda interesar.</p> 
                </div>
                <div class="contenido">
                    <p>
                        El Paciente <span>{{ $referencia->patient->name }} {{ $referencia->patient->lastname }}</span>, 
                        Portador del documento de identidad:<span>{{$referencia->patient->type_dni}} {{$referencia->patient->dni}}</span>, 
                        manifiesta que presenta: <span>{{$referencia->reason}}.</span> 
                    </p><br>
                    <p class="conte">
                        La presente solicitud, es para recurrir a la atención medica del Doctor/a<span>{{$referencia->doctor}}.</span> 
                    </p> 
                </div>
                <div class="fecha">
                    <p>
                        Constancia que se expide a petición de la persona interesada en Santo Domingo,<span>{{ $fecha }}.</span>
                    </p>
                </div>
                <div class="att">
                    <p>Atentamente.-</p>
                </div>
                <div class="doctor">
                    <p>Dr/a.{{ $referencia->employe->person->name }} {{ $referencia->employe->person->lastname }}.</p><br>
                    <p>Especialista en {{ $referencia->speciality->name }}.</p>
                </div>
            </div>
    </main>
    <footer>
        Dr/ra. {{ $referencia->employe->person->name }} {{ $referencia->employe->person->name }}- 
        Especialista en {{ $referencia->speciality->name }}-Email:{{ $referencia->employe->person->email }}
    </footer>   
    </body>
</html>