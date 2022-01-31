@extends('layouts.main')

@section('title', 'Delta Lab')

@section('content')

    <div
        class="center-screen d-flex flex-column justify-content-center align-items-center text-center   ">

        <img src="images/logo.svg" alt="">

        <p class="welcome">Seja bem vindo ao Delta!</p>
        <p class="welcome-sub">Seu exame nas mãos de ótimos profissionais, com um relatório de outro mundo!</p>

        <div class="bottom">
            <a href="/login" class="d-btn btn btn-outline-primary">Fazer login</a>
            <a href="/register" button class="btn d-btn d-btn-primary">Cadastrar</a>
        </div>
    </div>


@endsection
