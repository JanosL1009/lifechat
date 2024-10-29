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
                        <i class="fas fa-info-circle"></i> 
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
                        <a href="#" class="ml-15"> <i class="fas fa-cog"></i></a>
                       
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
                <p>Aktív szoba felirat</p>
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

     


      
      
      <script src="http://localhost/admintemplate/assets/js/main.js"></script>
</body>
</html>
