<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix justify-content-between">
            {{-- Contadores --}}
            {{-- <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">                                
                        <h6>Cirugías</h6>
                        <h3 class="pt-3"><i class="fa fa-address-book"></i> <span class="counter"></span></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <h6>Procedimiento ambulatorios</h6>
                        <h3 class="pt-3"><i class="fa fa-calendar"></i> <span class="counter"></span></h3>
                    </div>
                </div>
            </div> --}}
           
            <div class="col-lg-12 col-md-12 mt-10">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center active btn btn-outline-primary m-auto" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Hospitalarias</a>
                    </li>
                    <li class="nav-item col-md-2">
                        <a class="nav-link btn-block  p-2 d-flex flex-row justify-content-center btn btn-outline-success" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Ambulatorias</a>
                    </li>
                </ul>
            </div>
            {{-- lista de cirugias --}}
            <div class="tab-content container-fluid" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Fecha</th>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                        <th>Operación</th>
                                        <th>Quirofano</th>
                                        {{-- <th>Acciones</th> --}}
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Fecha</th>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                        <th>Operación</th>
                                        <th>Quirofano</th>
                                        {{-- <th>Acciones</th> --}}
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($surgeries as $surgeries)
                                    <tr style="height:40px;">
                                        @foreach ($surgeries->patient as $patient)
                                        <td style="text-align: center; font-size:10px; height:40px;">
                                            @if (!empty($patient->person->image->path))
                                                <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($patient->person->image->path) }}" alt="">
                                                @else
                                                <img src="" alt="" width="100%" height="100%">
                                                @endif
                                            </td>
                                            @endforeach
                                            <td>{{$surgeries->date}}</td>
                                            @foreach ($surgeries->patient as $patient)
                                                <td>{{$patient->person->name}} {{$patient->person->lastname}}</td>
                                            @endforeach
                                            
                                            <td>{{$surgeries->employe->person->name}} {{$surgeries->employe->person->lastname}}</td>
                                            <td>{{$surgeries->typesurgeries->name}}</td>
                                            <td>{{$surgeries->area->name}}</td>
                                            {{-- <td style="display: inline-block">
                                                <a type="button" href="" disabled class="btn btn-success">A</a>
                                                <a href="" class="btn btn-warning" href="">R</a>
                                                <a type="button" class="btn btn-repro" href="">S</a>
                                                <a type="button" class="btn btn-danger" href="">C</a>
                                            </td> --}}
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- lista procedimientos ambulatorios --}}
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-hover js-basic-example dataTable table_custom spacing5">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Fecha</th>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                        <th>Consultorio</th>
                                        <th>Descripción</th>
                                        {{-- <th>Acciones</th> --}}
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Fecha</th>
                                        <th>Paciente</th>
                                        <th>Doctor</th>
                                        <th>Consultorio</th>
                                        <th>Descripción</th>
                                        {{-- <th>Acciones</th>--}}
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($ambulatorias as $ambulatoria)
                                    <tr style="height:40px;">
                                        <td style="text-align: center; font-size:10px; height:40px;">
                                            @if (!empty($ambulatoria->patient->image->path))
                                                <img class="rounded circle" width="100%" height="100%" src="{{ Storage::url($ambulatoria->patient->image->path) }}" alt="">
                                                @else
                                                <img src="" alt="" width="100%" height="100%">
                                                @endif
                                            </td>
                                            <td>{{$ambulatoria->date}}</td>
                                            <td>{{$ambulatoria->patient->name}} {{$ambulatoria->patient->lastname}}</td>
                                            <td>{{$ambulatoria->employe->person->name}} {{$ambulatoria->employe->person->lastname}}</td>
                                            <td>{{$ambulatoria->employe->areaassigment->area->name}}</td>
                                            <td>{{$ambulatoria->description}}</td>
                                            {{-- <td style="display: inline-block">
                                                <a type="button" href="" disabled class="btn btn-success">A</a>
                                                <a href="" class="btn btn-warning" href="">R</a>
                                                <a type="button" class="btn btn-repro" href="">S</a>
                                                <a type="button" class="btn btn-danger" href="">C</a>
                                            </td> --}}
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets\bundles\dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets\js\table\datatable.js') }}"></script>
@endsection