@extends('layouts.app')
@section('content')

<div class="login-page d-flex align-items-center bg-gray-100">
    <div class="container mb-3">
        <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
            <div class="card-body p-5">
                <header class="text-center mb-5">
                <h1 class="text-xxl text-gray-400 text-uppercase">Evaluacion de <strong class="text-primary">Carreras</strong></h1>
                <p class="text-gray-500 fw-light">Este sistema es creado por alumnos de la univerdad de guadalajara para la evaluación de carreras y universidades.</p>
                </header>
                <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="input-material-group mb-4">
                            <input id="login-email" type="email" class="input-material @error('email') is-invalid @enderror" name="email" required autocomplete="current-email">
                            <label class="label-material" style="@error('email') display: none @enderror" for="login-email">Email</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    Error en las Credenciales
                                </span>
                            @enderror
                        </div>
                        <div class="input-material-group mb-4">
                            <input id="login-password" type="password" class="input-material @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <label class="label-material" for="login-password">Contraseña</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    Error en la contraseña
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 text-center">
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">
                        {{ __('Ingresar') }}
                    </button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="text-center position-absolute bottom-0 start-0 w-100 z-index-20">
        <p class="text-gray-500"><a class="external" href=""></a>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)                      -->
        </p>
    </div>
</div>
@endsection

