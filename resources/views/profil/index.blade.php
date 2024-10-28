@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h2>{{$user->username}} adatlapja</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ asset('img/avatar-3.jpg') }}" alt="User Image" id="userimg" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <h6>Felhasználónév: {{$user->username}}</h6>
                    <h6>Nem: {{$sex}}</h6>
                    <h6>Életkor: {{$age}}</h6>
                    <h6>Születési idő: {{$szuletesiido}}</h6>
                    <h6>VIP: {{$vip}}</h6>
                    <h6>Regisztrált: {{$registered}}</h6>
                    <h6>Utoljára járt itt: {{$lastlogin}}</h6>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Részletes adatok</h4>
                        <button class="btn btn-primary" id="editBtn">Szerkesztés</button>
                    </div>
                    <h6>Házassági állapot: {{$maritalstatus}}</h6>
                    <h6>Magasság: {{$height}}</h6>
                    <h6>Súly: {{$weight}}</h6>
                    <h6>Hajszín: {{$haircolor}}</h6>
                    <h6>Szemszín: {{$eyecolor}}</h6>
                    <h6>Munkahely: {{$work}}</h6>
                    <h6>Háziállat: {{$pet}}</h6>
                </div>
            </div>
        </div>
        <div class="card-footer" id="cardFooter" style="display: none;">
            <form action="{{route('felhasznalo.profil.modositas', $user->id)}}" method="POST"> 
                 {{-- {{ route('user.update', $user->id) }} --}}
                @csrf <!-- CSRF token -->
                <div class="row">
                    <div class="col-md-4">
                        <label for="username">Felhasználónév:</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{$user->username}}">

                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}">
                        
                        <label for="sex">Nem:</label>
                        <select name="sex" id="sex" class="form-control">
                            <option value="">Válasszon...</option>
                            <option value="1" {{ $user->sex == '1' ? 'selected' : '' }}>Férfi</option>
                            <option value="2" {{ $user->sex == '2' ? 'selected' : '' }}>Nő</option>
                            <option value="3" {{ $user->sex == '3' ? 'selected' : '' }}>Egyéb</option>
                        </select>  
                                              
                        <label for="birthdate">Születési dátum:</label>
                        <input type="date" name="birthdate" id="birthdate" class="form-control" 
                        min="1930-01-01" max="2020-12-31" 
                        value="{{ $user->birthdate }}">
                  
                    </div>
                    <div class="col-md-4">
                        <label for="marital_status">Házassági állapot:</label>
                        <select name="marital_status" id="marital_status" class="form-control">
                            <option value="" selected disabled>Válasszon...</option>
                            <option value="1" {{$user->marital_status_id == '1' ? 'selected' : ''}}>Egyedülálló</option>
                            <option value="2" {{$user->marital_status_id == '2' ? 'selected' : ''}}>Házas</option>
                            <option value="3" {{$user->marital_status_id == '3' ? 'selected' : ''}}>Elvált</option>
                            <option value="4" {{$user->marital_status_id == '4' ? 'selected' : ''}}>Özvegy</option>
                        </select>

                        <label for="height">Magasság:</label>
                        <div class="input-group">
                            <input type="text" name="height" id="height" class="form-control" value="{{$user->height}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>

                        <label for="weight">Súly:</label>
                        <div class="input-group">
                            <input type="text" name="weight" id="weight" class="form-control" value="{{$user->weight}}">
                            <div class="input-group-append">
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>                    
                        <label for="haircolor">Hajszín:</label>
                        <input type="text" name="haircolor" id="haircolor" class="form-control" value="{{$user->hairColor}}">
                    </div>

                    <div class="col-md-4">
                        <label for="eyecolor">Szemszín:</label>
                        <input type="text" name="eyecolor" id="eyecolor" class="form-control" value="{{$user->eyeColor}}">

                        <label for="work">Munkahely:</label>
                        <input type="text" name="work" id="work" class="form-control" value="{{$user->work}}">
                        
                        <label for="pet">Háziállat:</label>
                        <input type="text" name="pet" id="pet" class="form-control" value="{{$user->pet}}">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-3">Mentés</button>

                        </div>  
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
;
    const cardFooter = document.getElementById("cardFooter");
    const editBtn = document.getElementById("editBtn");

   

    editBtn.addEventListener('click', () => {
        // Toggle the visibility of the card-footer
        if (cardFooter.style.display === "none") {
            cardFooter.style.display = "block";
        } else {
            cardFooter.style.display = "none";
        }
    });
</script>

@endsection
