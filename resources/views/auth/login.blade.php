<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta name="description" content="Epic Able The most popular Admin Dashboard template and ui kit">
<meta name="author" content="PuffinTheme the theme designer">

<link rel="icon" href="favicon.ico" type="image/x-icon">

<title>Sinus & Face System | Login</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="..\assets\plugins\bootstrap\css\bootstrap.min.css">

<!-- Core css -->
<link rel="stylesheet" href="..\assets\css\main.css">
<link rel="stylesheet" href="assets\css\default.css">
<link rel="stylesheet" href="..\assets\css\brandMaster.css">

</head>
<body class="font-opensans">

<div class="auth">
    <div class="auth_left">
        <div class="card border-0">
            <div class="text-center mb-3">
                <a class="header-brand" href="https://sinussystem.logotipomiami.com/login">
                    <img src="{{ asset('img/Imagotipo_S&F-NOV_Vertical-01.svg') }}" alt="">
                </a>
            </div>
            <div class="card-body text-center">
                <h5 class="card-title font-weight-bold">System Access</h5>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        {{-- <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label> --}}
                        <input id="email" type="email" class="form-control bg-input-gris border-0 @error('email') is-invalid @enderror"  placeholder="User"name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{-- <label for="password" class="form-label">{{ __('Contraseña') }} --}}
                            @if (Route::has('password.request'))
                                {{-- <a href="{{ route('password.request') }}" class="float-right small">Olvide mi clave</a> --}}
                            @endif
                        </label>
                        <input id="password" type="password" class="form-control bg-input-gris border-0  @error('password') is-invalid @enderror" placeholder="Pass" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                            <span class="custom-control-label">Recordar</span>
                        </label>
                    </div> --}}
                    <div class="form-footer text-center">
                        <button type="submit" class="btn btn-azuloscuro">
                            {{ __('Open System') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>        
    </div>

    <div class="auth_right">
        <div class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000" >
            <div class="carousel-inner">
                <div class="carousel-item active item img-item-1">
                    {{-- <img src="{{ asset('img\auth\black-doctor-9_1023x789.jpg') }}" class="img-fluid item" alt="login page"> --}}
                    {{-- <div class="px-4 mt-4">
                        <h4>Fully Responsive</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div> --}}
                </div>
                <div class="carousel-item item img-item-2">
                    {{-- <img src="{{ asset('img\auth\estetoscopio-doctor_1023x789.jpg') }}" class="img-fluid item" alt="login page"> --}}
                    {{-- <div class="px-4 mt-4">
                        <h4>Quality Code and Easy Customizability</h4>
                        <p>There are many variations of passages of Lorem Ipsum available.</p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="..\assets\bundles\lib.vendor.bundle.js"></script>
<script src="..\assets\js\core.js"></script>
</body>
</html>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

