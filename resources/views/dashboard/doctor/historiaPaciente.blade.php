@extends('dashboard.layouts.app')
 @section('doctor','active') 
 @section('css')
 <link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">
 <link rel="stylesheet" href="{{ asset('assets\plugins\multi-select\css\multi-select.css') }}">
 <link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-colorpicker\css\bootstrap-colorpicker.css') }}">
 <link rel="stylesheet" href="{{ asset('assets\plugins\bootstrap-datepicker\css\bootstrap-datepicker3.min.css') }}">
@endsection
  @section('title','Doctor') 
  @section('content')
<div class="section-body  py-4">
    <div class="container-fluid">
        <div class="row clearfix">
            {{-- Contadores --}}
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Total De Citas Agendadas</h6>
                        <h4 class="pt-2"><i class="fa fa-address-book"></i> <span class="counter">2,250</span></h4>
                        {{--
                        <h5>$1,25,451.23</h5> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Total De Citas Del Mes</h6>
                        <h4 class="pt-2"><i class="fa fa-calendar"></i> <span class="counter">750</span></h4>
                        {{--
                        <h5>$3,80,451.00</h5> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Citas Para Hoy</h6>
                        <h4 class="pt-2"><i class="fa fa-users"></i> <span class="counter">25</span></h4>
                        {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 65.27%</span> Since last month</span> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 ">
                <div class="card">
                    <div class="card-body py-2">
                        <h6>Atendidos Hoy</h6>
                        <h4 class="pt-2"><i class="fa fa-user"></i> <span class="counter">5</span></h4>
                        {{-- <span><span class="text-danger mr-2"><i class="fa fa-long-arrow-up"></i> 165.27%</span> Since last month</span> --}}
                    </div>
                </div>
            </div>
            <div class="container">
                <form class="">
                    @foreach ($history as $number)
                    

                    <div class="card">
                        <div class="card-header">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <h3 class="card-title"> <a href="javascript:history.back(-1);" class="btn btn-sm btn-azuloscuro mr-3 text-white"><i class="icon-action-undo  mx-auto"></i></a>Nro. Historia: <span class="badge badge-info p-2">
                                            {{ $number->patient->historyPatient->history_number }}</span></h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('doctor.crearDiagnostico') }}" class="btn btn-azuloscuro">Diagnostico</a>
                                    <a href="{{ route('doctor.crearRecipe') }}" class="btn btn-azuloscuro">Recipe</a>
                                    <a href="{{ route('doctor.crearReferencia') }}" class="btn btn-azuloscuro">Referecia</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header">
                                    <label class="form-label card-title">Datos de Paciente</label>
                                    </div>
                                    <div class="card-body d-flex flex-row align-items-center justify-content-between">
                                        <div class="text-center">
                                            <img src="{{ Storage::url($number->patient->image->path) }}" alt="" class="img-thumbnail" style=" width:150px">
                                        </div>
                                        <div class="form-group">
                                            <label class="m-0 form-label">Docuemento de identidad:</label>
                                            <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <select name="type_dni" class="custom-select input-group-text border-0 bg-white" disabled="">
                                                            <option value="{{ $number->patient->type_dni }}">
                                                                {{ $number->patient->type_dni }}</option>
                                                        </select>
                                                    </div>
                                                    <input type="text" class="form-control border-0 bg-white" placeholder="Documento de Identidad" name="dni" disabled="" value=" {{ $number->patient->dni }}" name="dniP">
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="m-0 form-label">Nombre:</label>
                                            <input type="text" class="form-control border-0 bg-white" disabled="" value="{{ $number->patient->name }}" name="nameP">

                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="m-0 form-label">Apellido:</label>
                                            <input type="text" class="form-control border-0 bg-white" disabled=""  value="{{ $number->patient->lastname }}" name="lastnameP">
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <label class="form-label card-title">Datos De la Cita</label>
                                    </div>
                                    <div class="card-body d-flex flex-row align-items-center justify-content-between">
                                        <div class="form-group col-md-2">
                                            <label class="m-0 form-label">Fecha:</label>
                                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control border-0 bg-white" placeholder="Proxima Cita" disabled="" value="{{ $number->date }}" name=proxCita>        
                                        </div>
                                        <div class="form-group col-md-3">
                                                <label class="m-0 form-label">Medico Tratante:</label>
                                                <div class="input-group d-flex flex-row align-items-center">
                                                    <label for="" class="m-0">Dr.(a) </label>
                                                    <input type="text" class="form-control border-0 bg-white" disabled="" value="{{ $number->person->name }}" name="nameM">
                                                    <input type="text" class="form-control border-0 bg-white" disabled=""  value="{{ $number->person->lastname }}" name="lastnameM">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                    <label class="m-0 form-label">Razon:</label>
                                                    <input type="text" class="form-control border-0 bg-white" disabled=""  value="{{ $number->description }}" name="razon">
                                                </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Datos del Paciente</h3>

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Dirección:</label>
                                                    <input type="text" class="form-control border-0 bg-white" disabled="" name="addressP" placeholder="dirección" value="{{ $number->patient->address }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Correo:</label>
                                                    <input type="emailP" class="form-control border-0 bg-white" disabled="" placeholder="Email" value="{{ $number->patient->email }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Lugar de nacimiento</label>
                                                    <input type="text" class="form-control border-0 bg-white" disabled="" placeholder="Lugar de Nacimiento" value="{{ $number->patient->historyPatient->place }}" name="place">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 d-flex flex-row ">
                                                    <div class="form-group">
                                                            <label class="m-0 form-label">Fecha de nacimiento:</label>
                                                            <input data-provide="datepicker" data-date-autoclose="true" class="form-control border-0 bg-white" placeholder="Fecha de naciemiento" disabled="" value="{{ $number->patient->historyPatient->birthdate }}" name="birthdate">        
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label class="form-label">Edad:</label>
                                                            <input type="number" class="form-control border-0 bg-white" placeholder="Edad" disabled="" name="age" value="{{ $number->patient->historyPatient->age }}">
                                                        </div>
                                            </div>
                                            <div class="col-md-5">
                                                    <div class="form-group">
                                                            <label class="">Genero <span class=""><i class="fa fa-venus-mars"></i></span></label>
    
                                                            <div class="form-check ladymen p-0">
                                                                <div class="custom-control custom-radio custom-control-inline p-0 mr-1">
                                                                    <input disabled type="radio" id="genero1" name="gender" class="form-check-input" {{ $number->patient->historyPatient->gender == 'Femenino' ? 'checked':'' }} value="Masculino">
                                                                    <label class="form-check-label" for="genero1"><span><i class="fa fa-female"></i></span></label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline p-0 ml-1">
                                                                    <input  disabled type="radio" id="genero2" name="gender" class="form-check-input"  {{ $number->patient->historyPatient->gender == 'Masculino' ? 'checked':'' }} value="Femenino">
                                                                    <label class="form-check-label" for="genero2"><span><i class="fa fa-male"></i></span></label>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="custom-controls-stacked ladymen">
                                                                    <label class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" class="custom-control-input" name="gender" value="option1">
                                                                        <div class="custom-control-label"><span><i class="fa fa-female"></i></span></div>
                                                                    </label>
                                                                    <label class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" class="custom-control-input" name="gender" value="option2">
                                                                        <div class="custom-control-label"><span><i class="fa fa-male"></i></span></div>
                                                                    </label>
                                                                </div> --}}
                                                        </div>
                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets\plugins\bootstrap-colorpicker\js\bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>
<script src="{{ asset('assets\css\brandAn.css') }}"></script>
<script >
</script>
@endsection
