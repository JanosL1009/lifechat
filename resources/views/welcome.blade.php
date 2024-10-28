@extends('layouts.login')
@section('content')
<link rel="stylesheet" href="{{ asset('css/welcome-login.css') }}" />

<div class="container">
    <div class="row justify-content-center">
        <div class="container">
           
            <div>
                <div >
                    <img src="{{ asset('images/welcomepage_lifechat.png') }}" alt="" class="welcomepng">
                </div>
                <img src="{{asset('images/lifechat.gif')}}" alt="Lifechat" class="logo">
            </div>
    
            <div class="buttons">
                <a href="{{ route('register') }}" class="button register">Regisztráció</a>
                <a href="{{ route('login') }}" class="button login">Belépés</a>
                <a href="#" class="button guest-login">Vendég belépés</a>
            </div>
    
            <div class="login-form">
                <h2>Bejelentkezés</h2>
                <form method="POST" action="{{ route('login') }}"> 
                    @csrf
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
            
                    <label for="password">Jelszó</label>
                    <input type="password" id="password" name="password" required>
            
                    <p>Elfelejtetted a jelszavad?<br>
                        <a href="#" class="forgot-password">Jelszó emlékeztető kérése</a>
                    </p>
            
                    <button type="submit" class="submit-button">Bejelentkezés</button>
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection
