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
                        <div id="wizard_horizontal">
                            <h2>Seleccionar consultorio</h2>
                            <form method="POST" action="{{route('checkin.store')}}">
                                @csrf --}}
                            <section>
                                <div class="card-body">
                                    <div class="row gutters-sm d-row d-flex justify-content-between">
            |                                @foreach ($areas as $area)
                                                @if ($area->typearea->name == 'Consultorio' && $area->status == 'desocupado')
                                                <div class="card card-citas-md col-3 m-4 " style="background:darkturquoise">
                                                    <div class="col-6 col-sm-4 mt-4">
                                                            <label class="imagecheck mb-3" >
                                                                <input name="area_id" type="radio" value=" {{ $area->id}}" class="imagecheck-input">
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
                                                                        <input name="area_id" type="radio" value=" {{ $area->id}}" class="imagecheck-input">
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
                |                                @foreach ($em as $employe)
                                                    <div class="card card-citas-md m-3 col-3">
                                                            <div class="col-6 col-sm-4 mt-4" width="500px" height="auto">
                                                                <label class="imagecheck mb-3" >
                                                                    <input name="employe_id" type="radio" value=" {{ $employe->id}}" class="imagecheck-input">
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
                        {{ --</form>-- }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets\plugins\jquery-steps\jquery.steps.js') }}"></script>
    {{-- <script src="{{ asset('assets\js\form\wizard.js') }}"></script> --}}

    <script>
         $('#wizard_horizontal').steps({
        headerTag: 'h2',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        onInit: function (event, currentIndex) {
            setButtonWavesEffect(event);
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
        },
        onFinished: function (event, currentIndex, priorIndex) {
            $(event.currentTarget).find('[role="menu"] li a').removeClass('');
            $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('');
        }
    });
    </script>
@endsection
