@extends('dashboard.layouts.app')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\brandMaster.css') }}">
@endsection


@section('content')
<div class="section-body">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form id="wizard_horizontal" method="POST" action="" class="card assigmt">
                            @csrf 
                            <h2>Seleccionar consultorio</h2>
                            <section>
                                <div class="card-body">
                                    <div class="row gutters-sm d-row d-flex">
                                        @foreach ($areas as $area)
                                                @if ($area->typearea->name == 'Consultorio' && $area->status == 'desocupado')
                                                    <div class="col-md-2 mx-3">
                                                        <label class="imagecheck m-0">
                                                        <div class="card assigment">
                                                                <input name="searcharea" id="searcharea" type="radio" value="{{ $area->id}}" class="imagecheck-input">
                                                                @if (!empty($area->image->path))
                                                                <figure class="imagecheck-figure border-0">
                                                                    <img src={{ Storage::url($area->image->path) }} alt="" class="imagecheck-image w-auto">
                                                                </figure>
                                                                @else
                                                                <figure class="imagecheck-figure border-0">
                                                                    <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image w-auto">
                                                                </figure>
                                                                @endif
                                                                <div class="card-body text-center" style="background:darkturquoise">
                                                                    <h5 class="card-title font-weight-bold">{{ $area->name}} </h5>
                                                                    <h5 class="card-subtitle"><span class="badge badge-light text-dark">{{ $area->status }}</span></h5>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                @else
                                                    @if ($area->typearea->name == 'Consultorio' && $area->status == 'ocupado')
                                                        <div class="col-md-2 mx-3">
                                                            <label class="imagecheck m-0 disabled">
                                                            <div class="card assigment">
                                                                    <input name="searcharea" id="searcharea" type="radio" value=" {{ $area->id}}" class="imagecheck-input"  disabled>
                                                                    @if (!empty($area->image->path))
                                                                    <figure class="imagecheck-figure border-0">
                                                                        <img src={{ Storage::url($area->image->path) }} alt="" class="imagecheck-image w-auto">
                                                                    </figure>
                                                                    @else
                                                                    <figure class="imagecheck-figure border-0">
                                                                        <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image w-auto">
                                                                    </figure>
                                                                    @endif
                                                                    <div class="card-body text-center" style="background:dimgray">
                                                                        <h5 class="card-title font-weight-bold">{{ $area->name}} </h5>
                                                                        <h5 class="card-subtitle"><span class="badge badge-light text-dark">{{ $area->status }}</span> </h5>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endif
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                            <h2>Seleccionar médico</h2>
                            <section>
                                <div class="card-body">
                                    <div class="row gutters-sm d-row d-flex justify-content-start">
                                        @foreach ($em as $employe)
                                            {{-- <div class="col-6 col-sm-4">
                                                <div class="card max-card text-center assigment doctor">
                                                    <div class="card-header text-center d-flex flex-row justify-content-center">
                                                        <label class="imagecheck mb-3">
                                                                <input name="searchemploye" id="searchemploye" type="radio" value=" {{ $employe->id}}" class="imagecheck-input">
                                                                @if (!empty($area->image->path))
                                                                <figure class="imagecheck-figure border-0">
                                                                    <img src={{ Storage::url($employe->image->path) }} alt="" class="imagecheck-image max-img">
                                                                </figure>
                                                                @else
                                                                <figure class="imagecheck-figure border-0">
                                                                    <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image max-img">
                                                                </figure>
                                                                @endif
                                                        </label>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title font-weight-bold">{{ $employe->person->name}} {{ $employe->person->lastname}}</h5>
                                                        <div id="accordion">
                                                            <div class="card-header bg-azuloscuro position-relative" id="heading{{ $employe->person->id }}" data-toggle="collapse" data-target="#collapse{{ $employe->person->id }}" aria-expanded="false" aria-controls="collapse{{ $employe->person->id }}">
                                                                    <h6 class="text-white m-0"><i class="fa fa-eye"></i> Detalles...</h6>
                                                            </div>
                                                            <div class="collapse card-body list-group position-absolute py-0" id="collapse{{ $employe->person->id }}" aria-labelledby="heading{{ $employe->person->id }}" data-parent="#accordion">
                                                                <ul class="list-group">
                                                                    @foreach ($employe->speciality as $item)
                                                                    <li class="list-group-item">{{ $item->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-2 mx-3">
                                                <label class="imagecheck m-0">
                                                <div class="card assigment doctor">
                                                    <input name="searchemploye" id="searchemploye" type="radio" value=" {{ $employe->id}}" class="imagecheck-input">
                                                    @if (!empty($area->image->path))
                                                    <figure class="imagecheck-figure border-0">
                                                        <img src={{ Storage::url($employe->image->path) }} alt="" class="imagecheck-image w-auto">
                                                    </figure>
                                                    @else
                                                    <figure class="imagecheck-figure border-0">
                                                        <img src="{{ asset('assets/images/sm/default.jpg') }}" alt="" class="imagecheck-image w-auto">
                                                    </figure>
                                                    @endif
                                                    <div class="card-body text-center" style="background:darkturquoise">
                                                        <h5 class="card-title font-weight-bold">{{ $employe->person->name}} {{ $employe->person->lastname}}</h5>
                                                        <div id="accordion">
                                                            <div class="card-header bg-azuloscuro position-relative" id="heading{{ $employe->person->id }}" data-toggle="collapse" data-target="#collapse{{ $employe->person->id }}" aria-expanded="false" aria-controls="collapse{{ $employe->person->id }}">
                                                                    <h6 class="text-white m-0"><i class="fa fa-eye"></i> Detalles...</h6>
                                                            </div>
                                                            <div class="collapse card-body list-group position-absolute py-0" id="collapse{{ $employe->person->id }}" aria-labelledby="heading{{ $employe->person->id }}" data-parent="#accordion">
                                                                <ul class="list-group">
                                                                    @foreach ($employe->speciality as $item)
                                                                    <li class="list-group-item">{{ $item->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>

    <script>
        function stopDefAction(evt) {
            evt.preventDefault();
        }

        var form = $('#wizard_horizontal').show();
        form.steps({
            headerTag: 'h2',
            bodyTag: 'section',
            transitionEffect: 'slideLeft',
            labels: {
            cancel: "Cancelar",
            current: "Paso actual:",
            pagination: "Paginación",
            finish: "Finalizar",
            next: "Siguiente",
            previous: "Anterior",
            loading: "Cargando ..."
        },
            onInit: function(event, currentIndex) {
                setButtonWavesEffect(event);
                searcharea(); // llamando al metodo para buscar consultorio
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
                setButtonWavesEffect(event);
                searchemploye(); // llamando al metodo para buscar empleado
            },
            // onFinished: function(event, currentIndex) {
            //     var form = $(this);

            // // Submit form input

            // form.submit();
            // }   
            
        });

        function setButtonWavesEffect(event) {
            $(event.currentTarget).find('[role="menu"] li a').removeClass('');
            $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('');
        }

        //=============================  buscando consultorio ========================
        function searcharea() {
            $("input[name='searcharea']").click(function() {
                var area = $(this).val();

                console.log('area paso 1',area)
                $.ajax({
                        url: "{{ route('search.area') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: area
                        }
                    })
                    .done(function(data) {
                        if (data) {
                            console.log(data)
                            Swal.fire({
                                title : 'consultorio seleccionado',
                                text:  data.areas
                            })
                        }
                        if (!data) {
                            Swal.fire({
                                text: 'Consultorio ocupado',
                            })
                        }
                    })
                    .fail(function(data) {
                        console.log(data);
                    })
            });
        }

        //=============================  buscando empleado ========================
        function searchemploye() {
            $("input[name='searchemploye']").click(function() {
                var employe = $(this).val();

                console.log('emp paso 1',employe)
                $.ajax({
                        url: "{{ route('search.medico') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: employe
                        }
                    })
                    .done(function(data) {
                        if (data) {
                            console.log(data)
                            Swal.fire({
                                title : 'Medico  seleccionado',
                                text: data.employes,
                                
                            })
                        }
                        if (!data){
                            Swal.fire({
                                text: 'Medico con consultorio asignado',
                            })
                        }
                    })
                    .fail(function(data) {
                        console.log(data);
                    })
            });
        }

        //=============================  Asignando consultorio ========================
        function asignar() {
            var employe = $("#searchemploye").val();
            var area = $("#searcharea").val();

            console.log('ysbe',employe, area)
            $.ajax({
                    url: "{{ route('checkin.assigment_area') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        employe_id : employe,
                        area_id: area,
                    }
                })
                .done(function(data) {
                    if(data[0] == 201){
                    console.log('asignado',data.asignado.area_id, data.asignado.employe_id) ;
                    Swal.fire({
                        title : 'Consultorio asignado',
                        text: data.areaAssigment.employe_id,
                    })
                }
                if(data[0] == 202){
                    Swal.fire({
                        title : 'Consultorio asignado ',
                    })
                }
                })
                .fail(function(data) {
                    console.log(data);
                })
        }
    </script>
    
@endsection
