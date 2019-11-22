@extends('dashboard.layouts.app')

@section('cites','active')
@section('all','active')

@section('title','Actualizar cita')

@section('content')

<div class="col-lg-12">
    <form class="card">
        <div class="card-body">
            <h3 class="card-title"><b>Cita de {{ $reservation->patient->name }}</b></h3>
            <div class="row">
                <div class="col-sm-6 col-md-1">
                    <div class="form-group">
                        <label class="form-label">Tipo DNI</label>
                        <select name="type_dni" disabled class="form-control" id="">
                            <option {{ ($reservation->patient->type_dni == 'V' ? 'selected' :'') }} value="V">V</option>
                            <option {{ ($reservation->patient->type_dni == 'E' ? 'selected' :'') }} value="E">E</option>
                            <option {{ ($reservation->patient->type_dni == 'J' ? 'selected' :'') }} value="J">J</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-label">DNI</label>
                        <input type="number" name="dni" disabled class="form-control" value="{{ $reservation->patient->dni }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" disabled="" value="{{ $reservation->patient->name }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Apellido</label>
                        <input type="text" disabled class="form-control" name="lastname" placeholder="Username" value="{{ $reservation->patient->lastname }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" disabled class="form-control" name="email" placeholder="Email" value="{{ $reservation->patient->email }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label class="form-label">Teléfono</label>
                        <input type="text" disabled name="phone" class="form-control" value="{{ $reservation->patient->phone }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-12">
                    <div class="form-group">
                        <label class="form-label">Dirección</label>
                        <input type="text" disabled name="address" class="form-control" value="{{ $reservation->patient->address }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" placeholder="Home Address" value="Melbourne, Australia">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" placeholder="City" value="Melbourne">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-label">Postal Code</label>
                        <input type="number" class="form-control" placeholder="ZIP Code">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <select class="form-control custom-select">
                        <option value="">Germany</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <label class="form-label">About Me</label>
                        <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">Oh so, your weak rhyme
                        You doubt I'll bother, reading into it I'll probably won't, left to my own devicesBut that's the difference in our opinions.</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </div>
    </form>
</div>

@endsection