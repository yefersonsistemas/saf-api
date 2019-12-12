
<style>
    .bg-indigo{
        margin-top: 150px;
    }
</style>

<div id="left-sidebar" class="sidebar">
    <div class="container">
        <h5 class="brand-name">{{ ucfirst(Auth::user()->getRoleNames()[0]) }}<a href="#" class="menu_option float-right"><i class="icon-grid font-16" data-toggle="tooltip" data-placement="left" title="Grid & List Toggle"></i></a></h5>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul class="metismenu">
                @role('recepcion')
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
                @endrole




                @role('IN')
                    <li class="g_heading">Check-IN</li>                      
                    <li class="@yield('cites')">
                        <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="icon-tag"></i><span>Pacientes</span></a>
                        <ul>
                            <li class="@yield('day')"><a href="{{ route('checkin.day') }}">Citas Del Dia</a></li>
                            <li class="@yield('approved')"><a href="{{ route('checkin.approved') }}">Citas Aprobadas</a></li>
                            <li class="@yield('pending')"><a href="{{ route('checkin.pending') }}">Citas Pendientes</a></li>
                            <li class="@yield('all')"><a href="{{ route('checkin.index') }}">Todas Las Citas</a></li>
                            <li class="@yield('newCite')"><a href="{{ route('reservations.create') }}">Nueva Cita</a></li>
                            {{-- <li class="@yield('newCite')"><a href="{{ route('checkin.') }}">Nueva Cita</a></li> --}}
                        </ul>

                        <li>
                            <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="icon-tag"></i><span>Médicos</span></a>
                            <ul>
                                <li>
                                    <a href="{{ route('checkin.doctor') }}">Médicos del día</a>                                   
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
                    <div class="card bg-indigo" style="background-color: #00506b;">
                        <div class="card-body text-center">
                            <div class="inline-datepicker datepicker-reception fill_bg"></div>
                        </div>
                    </div>
                @endrole
                             
                @role('doctor')
                    <li class="g_heading">Doctor</li>
                    <li><a href=" {{route('doctor.index')  }} "><i class="fe fe-calendar"></i><span>Citas de Pacientes</span></a></li>
                    {{-- <li><a href=" {{ route('doctor.recordpago') }}"><i class="fe fe-list"></i><span>Record de Ingresos</span></a></li> --}}
                @endrole
                    {{-- FIN DEL MODULO DE LOS DOCTORES --}}
                     
                @role('OUT')
                    <li class="g_heading">Checkout</li>
                    <li class=""><a href="{{ route('checkout.index') }}"><i class="icon-home"></i><span>Pacientes del dia</span></a></li>                        
                    <li class=""><a href="{{ route('checkout.index_cirugias') }}"><i class="icon-home"></i><span>Cirugias</span></a></li>                        
                
                    <li><a href="{{ route('checkout.facturacion') }}"><i class="icon-calendar"></i><span>Facturación</span></a></li><br><br>
                    <li><a href="app-chat.html"><i class="icon-speech"></i><span>Chat</span></a></li>
                @endrole
            </ul>
        </nav>
    </div>
</div>
