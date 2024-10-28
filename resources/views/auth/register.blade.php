@extends('layouts.login')
@section('content')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />

<div class="container">
    <div class="logo">
        <img src="{{ asset('images/lifechat.gif') }}" alt="Lifechat Logó">
    </div>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="form-container">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h2>Regisztráció</h2>

            <div class="form-group">
                <label for="username">Felhasználónév</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email-cím</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Jelszó</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Jelszó megerősítése</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <button type="submit" class="btn-register">Regisztráció</button>
        </form>
        <a href="{{ route('login') }}" class="link">Már van fiókod? Jelentkezz be!</a>
    </div>
</div>
@endsection
