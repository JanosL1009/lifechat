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

     <!-- Scripts -->
     @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
   


    <section class="section">
        <div class="container-fluid">
            @yield('content')
        </div>
      </section>


      <section class="footer">
       
      </section>


      
      
      <script src="http://localhost/admintemplate/assets/js/main.js"></script>
</body>
</html>
