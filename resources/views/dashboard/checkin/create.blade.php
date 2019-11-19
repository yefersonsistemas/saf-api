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
                            <section>
                                {{-- <form method="POST" action="{{route('checkin.store')}}"> --}}
                                    @foreach ($types as $type)
                                    <div class="hh col-md-12">
                                            <div class="" id="nav-tabContent">
                                                <div class=" tab-pane fade show active" id="list-home" aria-hidden="true" role="tabpanel" aria-labelledby="list-home-list">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row gutters-sm justify-content-between">
                                 |                               <div>
                                                                    <div class="card card-citas-md">
                                                                        <div class="card-header bg-turquesa unborder" >
                                                                            {{-- <a><input name="consultorio" type="radio" class="imagecheck-input"></a> --}}
                                                                            <p>{{ $type->areas->name }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                 
                                {{-- </form> --}}
                            </section>
                            <h2>Seleccionar médico</h2>
                            <section>
                                
                            </section>
                            <h2>Confirmar asignación</h2>
                            <section>
                               
                            </section>
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
    <script src="{{ asset('assets\js\form\wizard.js') }}"></script>
@endsection
