@extends('layouts.auth')

@section('content')
<div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">
        <!-- Login v1 -->
        <div class="card mb-0">
            <div class="card-body">
                <a href="javascript:void(0);" class="brand-logo">
                    
                    <h2 class="brand-text text-primary ml-1">PSICOLOGIA FROEBEL</h2>
                </a>

                <h4 class="card-title mb-1 text-center">Bienvenido</h4>
                <p class="card-text mb-2 text-center">Inicie sesión en su cuenta</p>

                <form class="auth-login-form mt-2"  action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="login-email" class="form-label">Email</label>
                        <input class="form-control" id="email" type="email" name="email" aria-describedby="login-email" tabindex="1" autofocus value="{{ old('email') }}" />
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="login-password">Clave</label>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input name="password" type="password" class="form-control form-control-merge" id="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="remember-me" tabindex="3" />
                            <label class="custom-control-label" for="remember-me"> Recordarme </label>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" tabindex="4">Iniciar sesión</button>
                </form>

                
 
            </div>
        </div>
        <!-- /Login v1 -->
    </div>
</div>


@endsection
