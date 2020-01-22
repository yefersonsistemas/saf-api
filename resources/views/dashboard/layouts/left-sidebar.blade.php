
<style>
    .bg-indigo{
        /* margin-top: 0px; */
    }
</style>

<div id="left-sidebar" class="sidebar">
    <div class="container mt--20">
        <h5 class="brand-name">{{ ucfirst(Auth::user()->getRoleNames()[0]) }}<a href="#" class="menu_option float-right"><i class="icon-grid font-16" data-toggle="tooltip" data-placement="left" title="Grid & List Toggle"></i></a></h5>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul class="metismenu">
                {{-- @role('recepcion')
                    <li class="g_heading">Recepcion</li>
                    <li class=""><a href="index.html"><i class="icon-home"></i><span>Dashboard</span></a></li>                        
                    <li class="@yield('cites')">
                        <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="icon-tag"></i><span>Citas</span></a>
                        <ul>
                            <li class="@yield('all')"><a href="{{ route('citas.index') }}">Citas</a></li>
                            <li class="@yield('newCite')"><a href="{{ route('reservations.create') }}">Nueva Cita</a></li>
                        </ul>
                    </li>
                    <li><a href="app-calendar.html"><i class="icon-calendar"></i><span>Calendar</span></a></li>
                    <li><a href="app-chat.html"><i class="icon-speech"></i><span>Chat</span></a></li>
                    <li><a href="app-contact.html"><i class="icon-notebook"></i><span>Contact</span></a></li>
                    <li><a href="app-blog.html"><i class="icon-globe"></i><span>Blog</span></a></li>

                    <div class="card bg-indigo" style="background-color: #00506b;">
                        <div class="card-header">
                            <h3 class="card-title text-white">Fechas</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="inline-datepicker datepicker-reception fill_bg"></div>
                        </div>
                    </div>
                @endrole --}}


                @role('IN')
                    <div class="">
                        @role('director')
                        <div class="checkIn animated fadeIn d-none">
                        @endrole   
                        <li class="g_heading">Check-IN</li>                      
                        <li class="@yield('cites')">
                            <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="icon-tag"></i><span>Pacientes</span></a>
                            <ul>
                                <li class="@yield('day')"><a href="{{ route('checkin.day') }}">Citas Del Dia</a></li>
                                <li class="@yield('approved')"><a href="{{ route('checkin.approved') }}">Citas Confirmadas</a></li>
                                <li class="@yield('pending')"><a href="{{ route('checkin.pending') }}">Citas Pendientes</a></li>
                                <li class="@yield('all')"><a href="{{ route('checkin.index') }}">Todas Las Citas</a></li>
                                <li class="@yield('newCite')"><a href="{{ route('reservations.create') }}">Nueva Cita</a></li>
                                <li class=""><a href="{{ route('checkin.record') }}">Historial de citas</a></li>
                                {{-- <li class="@yield('newCite')"><a href="{{ route('checkin.') }}">Nueva Cita</a></li> --}}
                            </ul>
    
                            <li>
                                <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="icon-tag"></i><span>Médicos</span></a>
                                <ul>
                                    <li>
                                        {{-- <a href="{{ route('checkin.doctor') }}">Médicos del día</a>                                    --}}
                                    </li>
                                    <li>
                                        <a href="{{ route('checkin.doctor_todos') }}">Todos los médicos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('checkin.create') }}">Asignar Consultorio</a>
                                    </li>
                                </ul>
                            </li>
    
                        </li> 
                        {{-- <div class="card bg-indigo" style="background-color: #00506b;">
                            <div class="card-body text-center">
                                <div class="inline-datepicker datepicker-reception fill_bg"></div>
                            </div>
                        </div> --}}
                    </div> 
                @endrole



                @role('doctor')
                    <div class="">
                        @role('director')
                        <div class="doctor animated fadeIn d-none">
                        @endrole   


                        <li class="g_heading">Doctor</li>
                        <li><a href=" {{route('doctor.index')  }} "><i class="fe fe-calendar"></i><span>Citas de Pacientes</span></a></li>
                        {{-- <li><a href=" {{ route('doctor.recordpago') }}"><i class="fe fe-list"></i><span>Record de Ingresos</span></a></li> --}}
                    </div>
                @endrole
                    {{-- FIN DEL MODULO DE LOS DOCTORES --}}       
                



                @role('OUT')
                <div class="">
                    @role('director')
                    <div class="checkOut animated fadeIn d-none">
                    @endrole   

                    <li class="g_heading">Checkout</li>
                    <li class=""><a href="{{ route('checkout.index') }}"><i class="fa fa-users"></i><span>Citas del día</span></a></li>                                          
                    <li class=""><a href="{{ route('checkout.index_cirugias') }}"><i class="fa fa-hospital-o"></i><span>Cirugías</span></a></li> 
                    <li class=""><a href="{{ route('checkout.programar-cirugia') }}"><i class="fa fa-calendar"></i><span>Agendar Cirugia</span></a></li>                        
                
                    <li><a href="{{ route('checkout.facturacion') }}"><i class="fa fa-money"></i><span>Facturación</span></a></li><br><br>
                    {{-- <li><a href="app-chat.html"><i class="icon-speech"></i><span>Chat</span></a></li> --}}
                </div>
                @endrole




                @role('director')
                <div class="director animated fadeIn">
                    <li class="g_heading">Director</li> 
                    <li><a href="{{ route('employe.index') }}"><i class="fa fa-users"></i>Lista de Empleados</a></li>
                    <li><a href="{{ route('all.register') }}"><i class="fa fa-eye"></i>Lista de Registros</a></li>
                    
                    <li class="@yield('cites')">
                        <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="fa fa-plus-circle"></i><span>Registrar</span></a>
                        <ul>
                            <li><a href="{{ route('position.create') }}"><i class="fa fa-black-tie"></i>Cargo</a></li>
                            <li><a href="{{ route('clase.create') }}"><i class=""></i>Clase del Doctor</a></li>
                            <li><a href="{{ route('service.create') }}"><i class="fa fa-ambulance"></i>Servicio</a></li>
                            <li><a href="{{ route('speciality.create') }}"><i class="fa fa-flask"></i>Especialidad</a></li>
                            <li><a href="{{ route('procedure.create') }}"><i class="fa fa-hotel"></i>Procedimiento</a></li>
                            <li><a href="{{ route('employe.create') }}"><i class="fa fa-user-plus"></i>Empleado</a></li>
                            <li><a href="{{ route('doctores.create') }}"><i class="fa fa-user-md"></i>Doctor</a></li>
                            <li><a href="{{ route('classification.create') }}"><i class=""></i>Tipo de cirugía</a></li>
                            <li><a href="{{ route('surgery.create') }}"><i class="fa fa-medkit"></i>Cirugias</a></li>
                            <li><a href="{{ route('allergy.create') }}"><i class=""></i>Alergias</a></li>
                            <li><a href="{{ route('disease.create') }}"><i class="fa fa-heartbeat"></i>Enfermedades</a></li>
                            <li><a href="{{ route('medicine.create') }}"><i class="fa fa-eyedropper"></i>Medicina</a></li>
                            <li><a href="{{ route('exam.create') }}"><i class="fa fa-file-text"></i>Exámenes</a></li>
                            <li><a href="{{ route('type-area.create') }}"><i class="fe fe-home"></i>Tipo de Area</a></li>
                            <li><a href="{{ route('consultorio.create') }}"><i class="icon-home"></i>Area</a></li>
                            <li><a href="{{ route('payment.create') }}"><i class=""></i>Tipos de pagos</a></li>
                        </ul>
                        
                    </li>
                </div>
                @endrole
                
            </ul>
        </nav>
    </div>
</div>
