@extends('dashboard.layouts.app')
@section('doctor','active')
@section('docrol','d-block')
@section('dire','d-none')
@section('css')
<link rel="stylesheet" href="{{ asset('assets\css\brandAn.css') }}">

<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets\plugins\datatable\fixedeader\dataTables.fixedheader.bootstrap4.min.css') }} ">

@endsection

@section('title','Recipe')

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
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <a href="javascript:history.back(-1);" class="btn btn-sm btn-azuloscuro mr-3 text-white"><i class="icon-action-undo  mx-auto"></i></a>Crear Recipe</h3>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Agregar Medicamento</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Medicamento</label>
                                        <select class="form-control custom-select" name="medicamento">
                                            <option value="0">Seleccione</option>
                                            @foreach ($medicines as $medicine)
                                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Dosis</label>
                                        <input type="text" class="form-control" name="dosis" placeholder="3">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Medida</label>
                                        <select name="medida" class="form-control custom-select">
                                            <option value="0">Seleccione</option>
                                            <option value="CC">CC</option>
                                            <option value="G">G</option>
                                            <option value="ML">ML</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Duracion</label>
                                        <input type="text" class="form-control" placeholder="1 Mes" name="duracion" value="{{ old('duracion') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <label class="form-label">Indicaciones</label>
                                <textarea rows="5" class="form-control" name="indicaciones" placeholder="Tomar 1 diaria" value=""></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-azuloscuro mb-15" id="add" type="button">
                                <i class="fe fe-plus-circle" aria-hidden="true"></i> Agregar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="col-lg-10 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-vcenter table-striped"
                                                cellspacing="0" id="addrowExample">
                                                <thead>
                                                    <tr>
                                                        <th>Medicamento Seleccionado</th>
                                                        <th>Dosis</th>
                                                        <th>Medidas</th>
                                                        <th>Duracion</th>
                                                        <th>Indicaciones</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Medicamento Seleccionado</th>
                                                        <th>Dosis</th>
                                                        <th>Medidas</th>
                                                        <th>Duracion</th>
                                                        <th>Indicaciones</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody id="addRow">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-azuloscuro">Generar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="{{ asset('assets\plugins\bootstrap-multiselect\bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets\plugins\multi-select\js\jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets\js\form\form-advanced.js') }}"></script>

{{-- SCRIPT PARA MENSAJE CON BOTON HACIA ATRAS DEL NAVEGADOR --}}
<script>
// var submitted = false;

//  $(document).ready(function() {
//    $("form").submit(function() {
//      submitted = true;
//    });

//    window.onbeforeunload = function () {
//      if (!submitted) {
//        return 'Do you really want to leave the page?';
//      }
//    }
//  });
// </script>
{{--FIN SCRIPT PARA MENSAJE CON BOTON HACIA ATRAS DEL NAVEGADOR --}}

<script>
    $('#multiselect4-filter').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });
</script>

<script>
    // var medicinas[]= 0;
    $('#add').click(function () {
        medicina        = $("select[name='medicamento']").val();
        dosis           = $("input[name='dosis']").val();
        medida          = $("select[name='medida']").val();
        duracion        = $("input[name='duracion']").val();
        indicaciones    = $("textarea[name='indicaciones']").val();
        console.log(indicaciones)

        ajax(medicina, dosis, medida, duracion, indicaciones);

        validacion(medicina, dosis, medida, duracion);

    });

    function validacion (medicina, dosis, medida, duracion){

    }

    function ajax(medicina, dosis, medida, duracion, indicaciones) {
        $.ajax({
                url: "{{ route('recipe.store', [$paciente, $employe]) }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    medicina : medicina,
                    dosis: dosis,
                    medida : medida,
                    duracion: duracion,
                    indicaciones: indicaciones,
                }
            })
            .done(function(data) {
                console.log(data);
                	// medicinas[]= medicine_id;
                    // console.log(medicinas)
                Swal.fire({
                    title: 'Excelente!',
                    text: 'Medicina agregada',
                    type: 'success',
                })
                addRow(data);
            })
            .fail(function(data) {
                console.log(data);
            })
    }

    function addRow(data) {
        $('#addRow').append('<tr class="gradeA"> <td>'+data.medicine.name+'</td> <td>'+data.doses+'</td> <td>'+data.measure+'</td> <td>'+data.duration+'</td> <td>'+data.indications+'</td> <td class="actions"> <button class="btn btn-sm btn-icon on-editing m-r-5 button-save" data-toggle="tooltip" data-original-title="Save" hidden=""><i class="icon-drawer" aria-hidden="true"></i> </button> <button class="btn btn-sm btn-icon on-editing button-discard" data-toggle="tooltip" data-original-title="Discard" hidden=""><i class="icon-close" aria-hidden="true"></i> </button> <button class="btn btn-sm btn-icon on-default m-r-5 button-edit" data-toggle="tooltip" data-original-title="Edit"><i class="icon-pencil" aria-hidden="true"></i> </button> <button class="btn btn-sm btn-icon on-default button-remove" data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button></td></tr>');
    }

</script>
@endsection
