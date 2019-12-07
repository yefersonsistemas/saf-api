@extends('dashboard.layouts.app')

@section('content')

<style>
    .home{
        max-width: 1000px;
        width: 600px;
    }
    .title{
        text-align: center;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="mt-3 mb-3 title">
                    <h3>¡Hola <b>{{ Auth::user()->person->name }}</b>! bienvendido/a ¿qué haremos hoy?</h3>
                </div>
                {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div> --}}
            </div>
        </div>
        <div class="col-md-8">
            <figure>
                <img class="home" src="{{ asset('img\auth\S&F_Logo_20_Color.svg') }}" alt="">
            </figure>
        </div>
    </div>
</div>
@endsection
