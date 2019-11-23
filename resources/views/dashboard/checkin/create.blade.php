@extends('dashboard.layouts.app')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets\plugins\jquery-steps\jquery.steps.css') }}">
@endsection


@section('content')
<div class="section-body">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                            <form id="wizard_horizontal" method="POST" action="" class="card">
                                @csrf 
                                <h2>Seleccionar consultorio</h2>
                                <section>
                                    <div class="card-body">
                                        <div class="row gutters-sm d-row d-flex justify-content-between">
                                            @foreach ($areas as $area)
                                                    @if ($area->typearea->name == 'Consultorio' && $area->status == 'desocupado')
                                                        <div class="card card-citas-md col-3 m-4 " style="background:darkturquoise">
                                                            <div class="col-6 col-sm-4 mt-4">
                                                                    <label class="imagecheck mb-3" >
                                                                        <input name="searcharea" id="searcharea" type="radio" value=" {{ $area->id}}" class="imagecheck-input">
                                                                        @if (!empty($area->image->path))
                                                                        <figure class="imagecheck-figure">
                                                                            <img src={{ Storage::url($area->image->path) }} alt="" >
                                                                        </figure>
                                                                        @else
                                                                        <img src="" alt="" >
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            <div class="card-header unborder">
                                                                {{ $area->name}} <br>
                                                                {{ $area->status }} 
                                                            </div>
                                                        </div>
                                                    @else
                                                        @if ($area->typearea->name == 'Consultorio' && $area->status == 'ocupado')
                                                            <div class="card card-citas-md col-3 m-4 " style="background:dimgray">
                                                                    <div class="col-6 col-sm-4 mt-4" width="500px" height="auto">
                                                                        <label class="imagecheck mb-3" >
                                                                            <input name="area" id="area" type="radio" value=" {{ $area->id}}" class="imagecheck-input" disabled>
                                                                            @if (!empty($area->image->path))
                                                                            <figure class="imagecheck-figure">
                                                                                <img src={{ Storage::url($area->image->path) }} alt="" >
                                                                            </figure>
                                                                            @else
                                                                            <img src="" alt="" >
                                                                            @endif
                                                                        </label>
                                                                    </div>
                                                                <div class="card-header unborder">
                                                                    {{ $area->name}} <br>
                                                                    {{ $area->status }} 
                                                                </div>
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
                                                <div class="card card-citas-md m-3 col-3">
                                                        <div class="col-6 col-sm-4 mt-4" width="500px" height="auto">
                                                            <label class="imagecheck mb-3" >
                                                                <input name="searchemploye" id="searchemploye" type="radio" value=" {{ $employe->id}}" class="imagecheck-input">
                                                                @if (!empty($employe->image->path))
                                                                <figure class="imagecheck-figure">
                                                                    <img src={{ Storage::url($employe->image->path) }} alt="" >
                                                                </figure>
                                                                @else
                                                                <img src="" alt="" >
                                                                @endif
                                                            </label>
                                                        </div>
                                                    <div class="card-header bg-turquesa unborder" >
                                                        {{ $employe->person->name}} <br>
                                                        @foreach ($employe->speciality as $item)
                                                        {{ $item->name }} <br>
                                                        @endforeach
                                                    </div>
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
            onInit: function(event, currentIndex) {
                setButtonWavesEffect(event);
                searcharea(); // llamando al metodo para buscar consultorio
            },
            onStepChanged: function(event, currentIndex, priorIndex) {
                setButtonWavesEffect(event);
                searchemploye(); // llamando al metodo para buscar empleado
            },
            onFinished: function(event, currentIndex) {
                asignar(); // llamando al metodo para asignar
            }
        });
    
        function setButtonWavesEffect(event) {
            $(event.currentTarget).find('[role="menu"] li a').removeClass('');
            $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('');
        }
    
     
         //=============================  buscando consultorio ========================
        function searcharea() {
            $("input[name='searcharea']").click(function() {
                var area = $(this).val();

                console.log(area)
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

                console.log(employe)
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
                    title : 'Consultorio ya ha sido asignado ',
                })
             }
             
            })
            .fail(function(data) {
                console.log(data);
            })
    }

    </script>
    
@endsection