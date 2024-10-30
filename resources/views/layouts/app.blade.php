<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

   
   
    <link rel="stylesheet" href=" http://localhost/admintemplate/assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />

     <!-- Scripts -->
     @vite(['resources/sass/app.scss', 'resources/js/app.js'])

     <style>
        .ml-15
        {    margin-left: 15px;}

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
        -max-height: 200px;
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
 

     </style>
</head>
<body>
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
          <a href="/">
            <img src="{{asset('images/lifechat.gif')}}" alt="logo"  style="width: 100%;"/>
          </a>
        </div>
        <nav class="sidebar-nav">
            <div class="room lighter-blue">
                <img src="{{ asset('img/avatar-3.jpg') }}" alt="Room Icon" class="room-icon">
                <div class="room-details">
                    <span class="room-name">15+ korosztály</span>
                    <div class="room-count-icons">
                        <span class="room-count">Létszám: <span class="room-number">23</span></span>
                        <i class="fas fa-info-circle"  data-bs-toggle="modal" data-bs-target="#exampleModal"></i> 
                        <i class="fas fa-star"></i> 
                    </div>
                </div>
            </div>

            <div class="room lighter-blue">
                <img src="{{ asset('img/avatar-3.jpg') }}" alt="Room Icon" class="room-icon">
                <div class="room-details">
                    <span class="room-name">Általános szoba</span>
                    <div class="room-count-icons">
                        <span class="room-count">Létszám: <span class="room-number">19</span></span>
                        <i class="fas fa-info-circle"></i> 
                        <i class="fas fa-star"></i> 
                    </div>
                </div>
            </div>


            <div class="room lighter-blue">
                <img src="{{ asset('img/avatar-3.jpg') }}" alt="Room Icon" class="room-icon">
                <div class="room-details">
                    <span class="room-name">18+ szoba</span>
                    <div class="room-count-icons">
                        <span class="room-count">Létszám: <span class="room-number">21</span></span>
                        <i class="fas fa-info-circle"></i> 
                        <i class="fas fa-star"></i> 
                    </div>
                </div>
            </div>


          
        </nav>
        
    </aside>

      <div class="overlay"></div>

    <div class="main-wrapper">
        <header class="header">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-5 col-md-5 col-6">
                  <div class="header-left d-flex align-items-center">
                    <div class="menu-toggle-btn mr-15">
                      <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                        <i class="fa fa-list" aria-hidden="true"></i>
                      </button>
                    </div>
                    <div class="header-left">
                        <a href="{{route("felhasznalo.profil")}}" class="ml-15"><i class="fas fa-user"></i> </a>
                        <a href="#" class="ml-15"><i class="fas fa-cog"></i></a>
                        <a href="{{route('admin.szemely.kereses')}}" class="ml-15"><i class="fa-solid fa-magnifying-glass"></i></a> 
                        
                        <a href="{{route('admin.roomlist')}}" class="ml-15"><i class="fa fa-building" aria-hidden="true"></i></a> 
                    </div>
                  
                  </div>
                </div>
                <div class="col-lg-7 col-md-7 col-6">
                  <div class="header-right">
                   
                    @auth
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Kijelentkezés
                        </a>
                    @endauth

                  
                    
                    
                  </div>
                </div>
              </div>

              <div class="row lighter-blue">
                <p id="roomName">Szoba neve</p>
              </div>
            </div>
          </header>


          <section class="section">
            <div class="container-fluid">
                @yield('content')
            </div>
          </section>


          <section class="footer">
           
          </section>
    </div>

     

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Szoba neve</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <p>Létszám: <span id="r_numberofusers">0</span></p>
            <p >Téma: </p>
          </div>
          <div>
            <p id="room-theme-describe"></p>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Bezárás</button>
          
        </div>
      </div>
    </div>
  </div>
      
      
      <script src="http://localhost/admintemplate/assets/js/main.js"></script>
      <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        var room_id = 1;
    document.addEventListener("DOMContentLoaded", function() {
        // Lekérdezi az adatokat a getRooms végpontról
        fetch('{{route('getRooms')}}')
            .then(response => response.json())
            .then(data => {
                // Szoba lista hozzáadása a DOM-hoz
                const sidebarNav = document.querySelector('.sidebar-nav');
    
                data.forEach(room => {
                    // Új szoba HTML szerkezete
                    const roomDiv = document.createElement('div');
                    roomDiv.id = `room-${room.id}`;
                    roomDiv.classList.add('room', 'lighter-blue');
    
                    roomDiv.innerHTML = `
                        <img src="/images/${room.picture}" alt="Room Icon" class="room-icon">
                        <div class="room-details">
                            <span class="room-name">${room.name}</span>
                            <div class="room-count-icons">
                                <span class="room-count">Létszám: <span class="room-number">${room.number_of_employees}</span></span>
                                <i class="fas fa-info-circle" data-bs-toggle="modal" data-bs-target="#exampleModal" data-roomid="${room.id}" onclick="getRoomData(${room.id})"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    `;
    
                    // Szoba hozzáadása a sidebarNav konténerhez
                    sidebarNav.appendChild(roomDiv);
                });
            })
            .catch(error => console.error('Error:', error));
    });

    function getRoomData(room_id)
    {
      
      fetch('{{route('getRoomData')}}',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                // Az üzenet küldése paraméterekben
                body: JSON.stringify({
                    room_id: room_id
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('r_numberofusers').innerHTML = data.number_of_employees;
                document.getElementById('exampleModalLabel').innerHTML = data.name;
                document.getElementById('room-theme-describe').innerHTML = data.describe;
                
               
            })
            .catch(error => console.error('Error:', error));
    }
    </script>
</body>
</html>
