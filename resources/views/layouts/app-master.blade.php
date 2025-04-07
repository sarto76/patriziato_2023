<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Patriziato di Bosco Gurin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">


    <!----------------------------------------------------------------------------------- regna core ----------------------------------------------------------------->
    <link href="{!! url('images/favicon.png') !!}" rel="icon">
    <link href="{!! url('images/apple-touch-icon.png') !!}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{!! url('assets/regna/aos/aos.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/regna/boxicons/css/boxicons.min.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/regna/glightbox/css/glightbox.min.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/regna/swiper/swiper-bundle.min.css') !!}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{!! url('assets/regna/css/style.css') !!}" rel="stylesheet">
    <!----------------------------------------------------------------------------------- fine regna core ----------------------------------------------------------------->


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->

</head>
<body>
@auth
    @include('layouts.partials.navbar')
@endauth

<main class="container">
    @yield('content')
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Questo è molto importante -->
<script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>

<!-- Select2 (se usi quello) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


@yield('scripts')
</body>
</html>
