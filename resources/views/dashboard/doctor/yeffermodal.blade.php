<div class="modal fade" id="surgerys" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header p-2" style="background-color: #00506b; color: #fff;">
                <h5 class="col-11 modal-title text-center" id="exampleModalLabel">Cirugias</h5>
                <button type="button" class="btn btn-info" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="posible-surgerys">
                        <div class="modal-body ml-4 pb-0 pt-2 plan">
                            <div class="plan-steps">
                                <!-- Nav tabs -->
                                <ul style="list-style: none !important" class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li role="presentation" class="active nav-item">
                                        <a class="nav-link active" href="#hospitalariaTab" aria-controls="hospitalariaTab" role="tab" data-toggle="tab">Cirugias Hospitalarias</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" href="#ambulatoriaTab" aria-controls="ambulatoriaTab" role="tab" data-toggle="tab">Cirugias Ambulatorias</a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="hospitalariaTab">
                                        <div class="form-group">
                                            <div class="custom-controls-stacked">
                                                @foreach ($surgerys as $surgery)
                                                @if ($surgery->classification->name == 'hospitalaria')
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="radio" class="custom-control-input" name="surgerys" value="{{ $surgery->id }}">
                                                            <span class="custom-control-label">{{ $surgery->name }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="col">
                                                        <span>{{ $surgery->cost }}</span>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="ambulatoriaTab">
                                    <div class="form-group">
                                            <div class="custom-controls-stacked">
                                                @foreach ($surgerys as $surgery)
                                                @if ($surgery->classification->name == 'ambulatoria')
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="custom-control custom-checkbox">
                                                        <input type="radio" class="custom-control-input" name="surgerys" value="{{ $surgery->id }}">
                                                        <span class="custom-control-label">{{ $surgery->name }}</span>
                                                        </label>
                                                </div>
                                                <div class="col">
                                                    <span>{{ $surgery->cost }}</span>
                                                </div>
                                        </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer p-2">
                            <button type="submit" class="btn btn-azuloscuro" data-dismiss="modal" id="guardarC">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>