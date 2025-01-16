@extends('layouts.app-master')

@section('content')


    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex justify-content-between align-items-center">

            <div id="logo">
                <a class="pt-2" href="index.html"><img src="{!! url('images/stemma.png') !!}" alt=""></a>
                <!-- Uncomment below if you prefer to use a text logo -->
                <!--<h1><a href="index.html">Regna</a></h1>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">Informazioni</a></li>
                    <li><a class="nav-link scrollto" href="#services">News</a></li>
                    <li><a class="nav-link scrollto" href="#documents">Documenti</a></li>
                    <li><a class="nav-link scrollto " href="#portfolio">Proprietà</a></li>
                    {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                         <ul>
                             <li><a href="#">Drop Down 1</a></li>
                             <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                 <ul>
                                     <li><a href="#">Deep Drop Down 1</a></li>
                                     <li><a href="#">Deep Drop Down 2</a></li>
                                     <li><a href="#">Deep Drop Down 3</a></li>
                                     <li><a href="#">Deep Drop Down 4</a></li>
                                     <li><a href="#">Deep Drop Down 5</a></li>
                                 </ul>
                             </li>
                             <li><a href="#">Drop Down 2</a></li>
                             <li><a href="#">Drop Down 3</a></li>
                             <li><a href="#">Drop Down 4</a></li>
                         </ul>
                     </li>--}}
                    <li><a class="nav-link scrollto" href="#contact">Contatto</a></li>

                    @auth
                        {{auth()->user()->name}}
                        <li><a href="{{ route('logout.perform') }}" class="nav-link scrollto">Logout</a></li>
                    @endauth

                    @guest
                        <li><a href="#login" class="nav-link scrollto">Login</a></li>
                    @endguest


                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" style="background: {!! url('images/bg-estate.jpg') !!} top center;">
        <div class="hero-container" style="background: '<?php echo url('images/bg-estate.jpg'); ?>'" data-aos="zoom-in"
             data-aos-delay="100">
            <h1>Benvenuti sul sito del Patriziato di Bosco Gurin</h1>
            <h2>Copyright 2025 MS</h2>
            <a href="#about" class="btn-get-started">Inizio</a>
        </div>
    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" style="background: {!! url('images/about-img.jpg') !!} center top no-repeat;">
            <div class="container" data-aos="fade-up">
                <div class="row about-container">


                    <h2 class="title">Patriziato di Bosco Gurin</h2>
                    <p>
                        {{$info->text}}
                    </p>

                    <h2 class="title">Componenti dell'Ufficio patriziale</h2>
                    @foreach($member as $single)
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <div class="icon"><i class="bi bi-briefcase"></i></div>
                            <h4 class="title"><a href="">{{$single->firstname}} {{$single->lastname}}</a></h4>
                            <p class="description">{{$single->role}}</p>
                        </div>
                    @endforeach


                    <div class="col-lg-6 background order-lg-2 order-1" data-aos="fade-left" data-aos-delay="100"></div>
                </div>

            </div>
        </section><!-- End About Section -->


        <!-- ======= News Section ======= -->
        <section id="services">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3 class="section-title">News</h3>
                    <p class="section-description">Ultimi aggiornamenti dal Patriziato</p>
                </div>
                <div class="row">
                    @foreach ($news as $single)
                        <div class="col-sm-6 mb-1">
                            <div class="card">
                                <h5 class="card-header">{{$single->title}}</h5>
                                <div class="card-body">


                                    <p class="card-text">{{$single->text}}</p>
                                    <p class="card-text"><small class="text-muted">Caricata
                                            il: {{date('d.m.Y', strtotime($single->created_at))}}</small></p>
                                </div>
                                @auth
                                    <div class="m-1">
                                        <form action="{{ route('news.destroy',$single->id) }}" method="Post">
                                            <a class="btn btn-primary"
                                               href="{{ route('news.edit',$single->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                @endauth
                            </div>
                        </div>

                    @endforeach
                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= documenti Section ======= -->
        <section id="documents" class="portfolio">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3 class="section-title">Documenti</h3>
                    <p class="section-description">In questa trovate i dicumenti da scaricare</p>
                </div>


                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    @foreach($documents as $single)
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app card m-2 p-2">
                            <div>
                                <h5 class="card-header">{{$single->title}}</h5>
                                <div class="card-body">
                                    <p>{{$single->description}}</p>
                                    <a href="{{ asset('storage/documents/' . $single->file) }}" download>
                                        Scarica il file
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section><!-- End documenti Section -->

        <!-- ======= proprietà Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h3 class="section-title">Proprietà</h3>
                    <p class="section-description">In questa sezione sono elencate le proprietà del Patriziato</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">App</li>
                            <li data-filter=".filter-card">Card</li>
                            <li data-filter=".filter-web">Web</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    @foreach($estates as $single)
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <img src="{{asset('images/proprieta/').'/'.$single->link}}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>{{$single->title}}</h4>
                                <p>{{$single->description}}</p>
                                <a href="{{asset('images/proprieta/').'/'.$single->link}}"
                                   data-gallery="portfolioGallery"
                                   class="portfolio-lightbox preview-link" title="{{$single->title}}"><i
                                        class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section><!-- End Portfolio Section -->


        <!-- ======= Contact Section ======= -->
        <section id="contact">
            <div class="container">
                <div class="section-header">
                    <h3 class="section-title">Contatto</h3>
                    <p class="section-description">Informazioni di contatto:</p>
                </div>
            </div>


            <div class="container mt-5">
                <div class="row justify-content-center">

                    <div class="col-lg-3 col-md-4">

                        <div class="info">
                            <div>
                                <i class="bi bi-geo-alt"></i>
                                <p>Patriziato<br>6685 Bosco Gurin</p>
                            </div>

                            <div>
                                <i class="bi bi-envelope"></i>
                                <p>patriziato.bosco@gmail.com</p>
                            </div>

                            {{-- <div>
                                 <i class="bi bi-phone"></i>
                                 <p>+1 5589 55488 55s</p>
                             </div>--}}
                        </div>


                    </div>

                    <div class="col-lg-5 col-md-8">
                        <div class="form">
                            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome"
                                           required>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                           required>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="subject" id="subject"
                                           placeholder="Titolo" required>
                                </div>
                                <div class="form-group mt-3">
                                    <textarea class="form-control" name="message" rows="5" placeholder="Messaggio"
                                              required></textarea>
                                </div>
                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Il suo messaggio è stato inviato. Grazie!</div>
                                </div>
                                <div class="text-center">
                                    <button type="submit">Invio messaggio</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

        <!-- ======= login Section ======= -->
        <section id="login" class="login">
            <div class="container" data-aos="fade-up">
                <div class="section-header mt-5">
                    <h3 class="section-title">Login</h3>
                    <p class="section-description">Inserisci i tuoi dati di accesso</p>
                </div>

                <form method="post" action="{{ route('login.perform') }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    @include('layouts.partials.messages')

                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                               placeholder="Username" required="required" autofocus>
                        <label for="floatingName">username</label>
                        @if ($errors->has('username'))
                            <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                        @endif
                    </div>

                    <div class="form-group form-floating mb-3">
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                               placeholder="Password" required="required">
                        <label for="floatingPassword">Password</label>
                        @if ($errors->has('password'))
                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

                    @include('auth.partials.copy')
                </form>

            </div>
        </section><!-- End login Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">

            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>MS</strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
              -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/regna/js/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/regna/js/aos/aos.js"></script>
    <script src="assets/regna/js/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/regna/js/glightbox/js/glightbox.min.js"></script>
    <script src="assets/regna/js/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/regna/js/swiper/swiper-bundle.min.js"></script>
    <script src="assets/regna/js/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets//regna/js/main.js"></script>



