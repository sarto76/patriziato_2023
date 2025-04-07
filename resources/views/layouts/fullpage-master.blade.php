<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patriziato di Bosco Gurin</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">

    <!-- regna core styles and other vendor files -->
    <link href="{!! url('images/favicon.png') !!}" rel="icon">
    <link href="{!! url('images/apple-touch-icon.png') !!}" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <link href="{!! url('assets/regna/aos/aos.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/regna/boxicons/css/boxicons.min.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/regna/glightbox/css/glightbox.min.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/regna/swiper/swiper-bundle.min.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/regna/css/style.css') !!}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">


    <style>
        /* Custom styles */
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

</head>
<body style="width: 100vw; height: 100vh; overflow: auto;">
@auth
    @include('layouts.partials.navbar')
@endauth

<main class="container" style="max-width: 95vw; padding-left: 3px; padding-right: 3px;">
    @yield('content')
</main>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Questo è molto importante -->


<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>



<!-- Bootstrap Bundle -->
<script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
@yield('scripts')


</body>
</html>
