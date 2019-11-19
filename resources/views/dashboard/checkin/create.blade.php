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
                                <form method="POST" action="{{route('checkin.assigment')}}">
                                    <div class="hh col-md-12">
                                        <div class="" id="nav-tabContent">
                                            <div class=" tab-pane fade show active" id="list-home" aria-hidden="true" role="tabpanel" aria-labelledby="list-home-list">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row gutters-sm justify-content-between">
                             |                               <div>
                                                                <div class="card card-citas-md">
                                                                    <div class="card-header bg-turquesa unborder" >
                                                                        <a>
                                                                            <input name="consultorio" type="radio" class="imagecheck-input">
                                                                        </a>
                                                                        <figure class="imagecheck-figure">
                                                                            <img src="" alt="">
                                                                        </figure>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div *ngFor="let lista of dataC">
                                                                <div class="card card-citas-md" class="label-disable">
                                                                    <div class="card-header bg-turquesa unborder" class="label-disable">
                                                                        <a>
                                                                            <input type="radio" class="imagecheck-input" disabled>
                                                                        </a>
                                                                        <figure class="imagecheck-figure">
                                                                            <img src="" alt="" class="imagecheck-image">
                                                                        </figure>
                                                                    </div>
                                                                    <div class="card-body">
                                                                    
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </section>
                            <h2>Seleccionar médico</h2>
                            <section>
                                <p>Donec mi sapien, hendrerit nec egestas a, rutrum vitae dolor. Nullam venenatis diam ac ligula elementum pellentesque. In lobortis sollicitudin felis non eleifend. Morbi tristique tellus est, sed tempor elit.
                                    Morbi varius, nulla quis condimentum dictum, nisi elit condimentum magna, nec venenatis urna quam in nisi. Integer hendrerit sapien a diam adipiscing consectetur. In euismod augue ullamcorper leo dignissim
                                    quis elementum arcu porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum leo velit, blandit ac tempor nec, ultrices id diam. Donec metus lacus, rhoncus sagittis iaculis nec, malesuada
                                    a diam. Donec non pulvinar urna. Aliquam id velit lacus. </p>
                            </section>
                            <h2>Confirmar asignación</h2>
                            <section>
                                <p> Morbi ornare tellus at elit ultrices id dignissim lorem elementum. Sed eget nisl at justo condimentum dapibus. Fusce eros justo, pellentesque non euismod ac, rutrum sed quam. Ut non mi tortor. Vestibulum eleifend
                                    varius ullamcorper. Aliquam erat volutpat. Donec diam massa, porta vel dictum sit amet, iaculis ac massa. Sed elementum dui commodo lectus sollicitudin in auctor mauris venenatis. </p>
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
