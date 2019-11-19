@extends('dashboard.layouts.app')

@section('cites','active')    
@section('newCite','active')

@section('title','Crear una nueva cita')

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
                            <h2>Buscar Paciente</h2>
                            <section>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Basic Validation</h3>
                                        </div>
                                        <div class="card-body">
                                            <form id="basic-form" method="post" novalidate="">
                                                <div class="form-group">
                                                    <label>Text Input</label>
                                                    <input type="text" class="form-control" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email Input</label>
                                                    <input type="email" class="form-control" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Text Area</label>
                                                    <textarea class="form-control" rows="5" cols="30" required=""></textarea>
                                                </div>
                                                <div class="form-group">                                    
                                                    <label>Checkbox</label>
                                                    <br>
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" name="checkbox" required="" data-parsley-errors-container="#error-checkbox">
                                                        <span class="custom-control-label">Option 1</span>
                                                    </label>                                    
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" name="checkbox">
                                                        <span class="custom-control-label">Option 2</span>
                                                    </label>
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" name="checkbox">
                                                        <span class="custom-control-label">Option 3</span>
                                                    </label>
                                                    <p id="error-checkbox"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Radio Button</label>
                                                    <br>
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" name="gender" value="male" required="" data-parsley-errors-container="#error-radio">
                                                        <span class="custom-control-label">Male</span>
                                                    </label>
            
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" name="gender" value="female">
                                                        <span class="custom-control-label">Female</span>
                                                    </label>
                                                    <p id="error-radio"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="food">Multiselect</label>
                                                    <br>
                                                    <select id="food" name="food[]" class="multiselect multiselect-custom" multiple="multiple" data-parsley-required="" data-parsley-trigger-after-failure="change" data-parsley-errors-container="#error-multiselect">
                                                        <option value="cheese">Cheese</option>
                                                        <option value="tomatoes">Tomatoes</option>
                                                        <option value="mozarella">Mozzarella</option>
                                                        <option value="mushrooms">Mushrooms</option>
                                                        <option value="pepperoni">Pepperoni</option>
                                                        <option value="onions">Onions</option>
                                                    </select>
                                                    <p id="error-multiselect"></p>
                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-primary">Validate</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <h2>Elegir Especialidad</h2>
                            <section>
                                <p>Donec mi sapien, hendrerit nec egestas a, rutrum vitae dolor. Nullam venenatis diam ac ligula elementum pellentesque. In lobortis sollicitudin felis non eleifend. Morbi tristique tellus est, sed tempor elit.
                                    Morbi varius, nulla quis condimentum dictum, nisi elit condimentum magna, nec venenatis urna quam in nisi. Integer hendrerit sapien a diam adipiscing consectetur. In euismod augue ullamcorper leo dignissim
                                    quis elementum arcu porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum leo velit, blandit ac tempor nec, ultrices id diam. Donec metus lacus, rhoncus sagittis iaculis nec, malesuada
                                    a diam. Donec non pulvinar urna. Aliquam id velit lacus. </p>
                            </section>
                            <h2>Elegir Medico</h2>
                            <section>
                                <p> Morbi ornare tellus at elit ultrices id dignissim lorem elementum. Sed eget nisl at justo condimentum dapibus. Fusce eros justo, pellentesque non euismod ac, rutrum sed quam. Ut non mi tortor. Vestibulum eleifend
                                    varius ullamcorper. Aliquam erat volutpat. Donec diam massa, porta vel dictum sit amet, iaculis ac massa. Sed elementum dui commodo lectus sollicitudin in auctor mauris venenatis. </p>
                            </section>
                            <h2>Motivo De La Consulta</h2>
                            <section>
                                <p> Quisque at sem turpis, id sagittis diam. Suspendisse malesuada eros posuere mauris vehicula vulputate. Aliquam sed sem tortor. Quisque sed felis ut mauris feugiat iaculis nec ac lectus. Sed consequat vestibulum
                                    purus, imperdiet varius est pellentesque vitae. Suspendisse consequat cursus eros, vitae tempus enim euismod non. Nullam ut commodo tortor. </p>
                            </section>
                            <h2>Elegir Fecha</h2>
                            <section>
                                <p> Quisque at sem turpis, id sagittis diam. Suspendisse malesuada eros posuere mauris vehicula vulputate. Aliquam sed sem tortor. Quisque sed felis ut mauris feugiat iaculis nec ac lectus. Sed consequat vestibulum
                                    purus, imperdiet varius est pellentesque vitae. Suspendisse consequat cursus eros, vitae tempus enim euismod non. Nullam ut commodo tortor. </p>
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