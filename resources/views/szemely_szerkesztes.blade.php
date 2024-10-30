@extends('layouts.app')
@section('content')

<style>
    #editor-container {
        resize: both;
        overflow: auto;
        border: 1px solid #ccc;
        padding: 10px;
        width: 100%;
        min-height: 20px;
        max-height: 10px;
    }
    .ck-editor__editable {
        min-height: 100px;
    }

    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #1e1e1e;
    color: rgb(255, 255, 255);
    }

    .chat-container {
        display: flex;
        height: 100vh;
    }

    .sidebar {
        width: 20%;
        background-color: #2e2e2e;
        padding: 10px;
    }

    .room {
        display: flex;
        align-items: center;
        background-color: #4C89CD;
        padding: 10px;
        /*margin-bottom: 10px;*/
        border-radius: 5px;
        color: white;
    }

    .room:hover {
        display: flex;
        align-items: center;
        background-color: #8a93a3;
        padding: 10px;
        /*margin-bottom: 10px;*/
        border-radius: 5px;
        color: white;
    }

    .room-icon {
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }

    .room-details {
        display: flex;
        flex-direction: column;
    }

    .room-name {
        font-weight: bold;
    }
    .room-count-icons {
        display: flex;
        align-items: center;
        margin-top: 5px; 
    }
    .room-count-icons i:hover {
        color: #ffdf0d; 
    }
    .room-count-icons i {
        color: white;
        margin-left: 10px; 
        cursor: pointer;
        font-size: 14px;
    }
    .room-count {
        margin-right: 10px;
    }
    .room-number {
        color: #D22326;
        font-weight: bold; 
    }

    .chat-box {
        width: 60%;
        display: flex;
        flex-direction: column;
        background-color: #101010;
        padding: 10px;
        position: relative;
    }

    .chat-header {
        background-color: #2e2e2e;
        padding: 10px;
        border-bottom: 1px solid #39414f;
        text-align: center;
        font-weight: bold;
    }

    .chat-messages {
     /*   flex: 1; */
        height: 400px;
        padding: 10px;
        overflow-y: auto;
        background-color: #000;
    }

    .chat-messages p {
        margin: 5px 0;
    }

    .moderator {
        color: red;
    }

    .user1 {
        color: yellow;
    }

    .user2 {
        color: lime;
    }

    .chat-input {
    width: 80%;
    padding: 10px;
    border-top: 1px solid #39414f;
    color: black;
    }

    .chat-input textarea {
        flex: 1;
        padding: 10px;
        border: none;
        background-color: #2e2e2e;
        color: rgb(0, 0, 0);
        border-radius: 5px;
        margin-right: 10px;
        width: 70%; /* Változtasd meg a kívánt szélességre */
        max-width: 400px; /* Maximális szélesség, ha szeretnéd */
    }

    button#msgSendBtn {
        
        padding: 10px;
        border: none;
        background-color: #39414f;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }


    .user-list {
        max-height: 200px;
        background-color: #2e2e2e;
        padding: 10px;
    }

    .user {
        display: flex;
        align-items: center;
        background-color: #39414f;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .user-avatar {
        width: 50px; 
        height: 50px;
        border-radius: 50%; 
        margin-right: 10px;
    }

    .user-name {
        color: white;
        font-weight: bold;
    }
    .user-icons {
        margin-top: 5px;
    }

    .user-icons i {
        color: white;
        margin-right: 10px;
        font-size: 14px; 
        cursor: pointer;
    }

    .user-icons i:hover {
        color: #00d1b2; 
    }
    .chat-header {
        display: flex;
        justify-content: space-between; 
        align-items: center;
        background-color: #39414f;
        padding: 10px;
        border-bottom: 1px solid #555;
        color: white;
    }
    .chat-header:nth-child(2) {
        justify-content: center; 
    }
    .header-left i, .header-right i {
        font-size: 18px;
        color: white;
        margin-right: 15px; 
        cursor: pointer;
    }

    .header-left i:last-child {
        margin-right: 0; 
    }

    .header-right i {
        margin-left: 15px;
    }

    .header-right i:hover, .header-left i:hover {
        color: #D22326; 
    }
    .active-room-name {
        text-align: center;
        padding: 10px;
        background-color: #2e3b4e;
        color: white;
        font-size: 16px;
        border-bottom: 1px solid #555;
    }
    .userimg{
        width: 300px;
        height: 300px;
    }
</style>
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
                    @if(isset($user) && $user->profilepicture)
                    <img src="{{ asset('profilepicture/' . $user->profilepicture) }}" alt="Profile Picture" class="userimg">
                @else
                    <img src="{{ asset('img/avatar-3.jpg') }}" alt="Profile Picture" class="userimg">
                @endif                </div>
                <div class="col-md-4">
                    <h6>Felhasználónév: {{$user->username}}</h6>
                    <h6>Nem: {{$sex}}</h6>
                    <h6>Életkor: {{$age}}</h6>
                    <h6>Születési idő: {{$szuletesiido}}</h6>
                    <h6>VIP: {{$vip}}</h6>
                    <h6>Regisztrált: {{$registered}}</h6>
                    <h6>Utoljára járt itt: {{$lastlogin}}</h6>
                    <h6>Felhasználói szint: {{$jogosultsag}}</h6>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Részletes adatok</h4>
                        <button class="btn btn-primary" id="editBtn">Szerkesztés</button>
                    </div>
                    <h6>Házassági állapot: {{ $maritalstatus ? $maritalstatus->name : 'Nincs megadva' }}</h6>
                    <h6>Magasság: {{$height}} cm</h6>
                    <h6>Súly: {{$weight}} kg</h6>
                    <h6>Hajszín: {{$haircolor}}</h6>
                    <h6>Szemszín: {{$eyecolor}}</h6>
                    <h6>Munkahely: {{$work}}</h6>
                    <h6>Háziállat: {{$pet}}</h6>
                </div>
            </div>
        </div>
        <div class="card-footer" id="cardFooter" style="display: none;">
            <form action="{{route('admin.szemely.szerkesztes.post', $user->id)}}" method="POST" enctype="multipart/form-data"> 
                @csrf 
                <div class="row">
                    <div class="col-md-4">
                        <label for="username">Felhasználónév:</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{$user->username}}">

                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}">
                        
                        <label for="sex">Nem:</label>
                        <select name="sex" id="sex" class="form-select">
                            <option value="">Válasszon...</option>
                            <option value="1" {{ $user->sex == '1' ? 'selected' : '' }}>Férfi</option>
                            <option value="2" {{ $user->sex == '2' ? 'selected' : '' }}>Nő</option>
                            <option value="3" {{ $user->sex == '3' ? 'selected' : '' }}>Egyéb</option>
                        </select>  
                                              
                        <label for="birthdate">Születési dátum:</label>
                        <input type="date" name="birthdate" id="birthdate" class="form-control" 
                        min="1930-01-01" max="2020-12-31" 
                        value="{{ $user->birthdate }}">
                        
                        <label for="permission">Felhasználó szint:</label>
                        <select name="permission" id="permission" class="form-select">
                            <option value="" selected disabled>Válasszon...</option>
                            <option value="1" {{$permissions->permission_id ?? null == '1' ? 'selected' : ''}}>Adminisztrátor</option>
                            <option value="2" {{$permissions->permission_id ?? null == '2' ? 'selected' : ''}}>Operátor</option>
                            <option value="3" {{$permissions->permission_id ?? null == '3' ? 'selected' : ''}}>Felhasználó</option>
                        </select> 
                    </div>
                    <div class="col-md-4">
                        <label for="marital_status">Házassági állapot:</label>
                        <select name="marital_status" id="marital_status" class="form-select">
                            <option value="" selected disabled>Válasszon...</option>
                            @foreach ($maritalStatuses as $status)
                                <option value="{{ $status->id }}" {{ $user->marital_status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }} 
                                </option>
                            @endforeach
                        </select>

                        <label for="height">Magasság:</label>
                        <div class="input-group">
                            <input type="number" min="0" name="height" id="height" class="form-control" value="{{$user->height}}">
                            <div class="input-group-append">
                                <span class="input-group-text">cm</span>
                            </div>
                        </div>

                        <label for="weight">Súly:</label>
                        <div class="input-group">
                            <input type="number" min="0" name="weight" id="weight" class="form-control" value="{{$user->weight}}">
                            <div class="input-group-append">
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>
                        <label for="haircolor">Hajszín:</label>
                        <input type="text" name="haircolor" id="haircolor" class="form-control" value="{{$user->hairColor}}">
                        
                        <label for="vip">VIP?</label>
                        <select name="vip" id="vip" class="form-select">
                            <option value="" selected disabled>Válasszon...</option>
                            <option value="1" {{ $user->is_vip  == 1 ? 'selected' : '' }}>Igen</option>
                            <option value="2" {{ $user->is_vip  == 2 ? 'selected' : '' }}>Nem</option>
                        </select>                        
                    </div>

                    <div class="col-md-4">
                        <label for="eyecolor">Szemszín:</label>
                        <input type="text" name="eyecolor" id="eyecolor" class="form-control" value="{{$user->eyeColor}}">

                        <label for="work">Munkahely:</label>
                        <input type="text" name="work" id="work" class="form-control" value="{{$user->work}}">
                        
                        <label for="pet">Háziállat:</label>
                        <input type="text" name="pet" id="pet" class="form-control" value="{{$user->pet}}">

                        <label for="profpic">Profilkép</label>
                        <input type="file" id="profilepicture" name="profilepicture" class="form-control">
                        
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
