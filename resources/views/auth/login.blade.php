@extends('layouts.main')

@section('title', 'Login')

@section('link')
    <link rel="stylesheet" href="/css/login-circles.css">
@endsection

@section('content')

    <div class='box'>
        <div class='box1'></div>
    </div>

    <div class='box3'>
        <div class='box4'></div>
    </div>

    <div class="center-screen d-flex flex-column justify-content-center align-items-center">
        <div class="auth-logo">
            <a href="/">
                <img src="images/logo.svg" alt="">
            </a>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif


        <div class="form-in">
            <p class="text-center">Preencha os campos abaixo</p>
            @if ($errors->any())
                <div class="p-1 mb-2 bg-danger text-white rounded-top rounded-bottom">
                    <ul class="mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ __($error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <x-jet-label for="email" value="Email"/>
                    <x-jet-input class="form-control mt-1" type="email"
                                 placeholder="Digite o seu email"
                                 name="email" :value="old('email')" required autofocus/>
                </div>


                <div class="form-group mt-2">
                    <x-jet-label for="password" value="Senha"/>
                    <x-jet-input class="form-control mt-1" type="password"
                                 placeholder="Digite a sua senha"
                                 name="password" :value="old('password')" required autocomplete="current-password"/>
                </div>
                <button type="submit" class="mt-4 btn d-btn d-btn-full d-btn-primary">Entrar</button>
            </form>
            <div class="d-flex mt-2">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                       href="{{ route('password.request') }}">
                        Esqueceu sua senha?
                    </a>
                @endif
            </div>
        </div>
    </div>
    <style>
        body {
            overflow: hidden;
        }

        label {
            margin-left: 15px;
        }


    </style>
@endsection

