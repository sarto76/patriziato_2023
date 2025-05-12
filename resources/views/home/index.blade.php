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
                    <li><a class="nav-link scrollto" href="#links">Links</a></li>
                    <li><a class="nav-link scrollto" href="#documents">Documenti</a></li>
                    <li><a class="nav-link scrollto " href="#properties">Proprietà</a></li>
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
    <section id="hero" style="background: url('{{ asset('storage/properties/bg-estate.jpg') }}') top center;">


        <div class="hero-container" style="background: '<?php echo url('images/bg-estate.jpg'); ?>'" data-aos="zoom-in"
             data-aos-delay="100">
            <h1>Benvenuti sul sito del Patriziato di Bosco Gurin</h1>
            <h2>Copyright 2025 MS</h2>
            <a href="#about" class="btn-get-started">Inizio</a>
        </div>
    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="team section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Componenti dell'Ufficio patriziale</h2>
                <p></p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    @foreach($member as $single)
                        <div class="col-lg-6 mt-1" data-aos="fade-up" data-aos-delay="100">
                            <div class="team-member d-flex align-items-start">
                                <div class="pic"><img src="{{ asset('images/' . $single->picture) }}" class="img-fluid"
                                                      alt=""></div>
                                <div class="member-info">
                                    <h4>{{$single->firstname}} {{$single->lastname}}</h4>
                                    <span>{{$single->role}}</span>
                                    <p></p>
                                </div>
                            </div>
                        </div><!-- End Team Member -->
                    @endforeach
                </div>

            </div>

        </section><!-- /Team Section -->

        <!-- services Section -->
        <section id="services" class="about section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 position-relative d-flex align-items-center order-lg-last" data-aos="fade-up"
                         data-aos-delay="200">
                        <img src="{{ asset('images/news.jpg') }}" class="img-fluid flex-shrink-0" alt="">
                    </div>

                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                        <h3>News</h3>
                        <p>
                            Ultimi aggiornamenti dal Patriziato
                        </p>
                        <ul>
                            @foreach ($news as $single)
                                <li>
                                    <i class="bi bi-pin-fill"></i>
                                    <div>
                                        <h5>{{$single->title}}</h5>
                                        <p>{{$single->text}}</p>
                                        <p><small class="text-muted">Caricata
                                                il: {{date('d.m.Y', strtotime($single->created_at))}}</small></p>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                </div>
                <div class="pagination mt-4 d-flex justify-content-center">
                    {{ $news->appends(['scroll' => 'services'])->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>

        </section><!-- /services Section -->

        <!-- links Section -->
        <section id="links" class="about section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 position-relative d-flex align-items-center order-lg-last" data-aos="fade-up"
                         data-aos-delay="200">
                        <img src="{{ asset('images/link.png') }}" class="img-fluid flex-shrink-0" alt="">
                    </div>

                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                        <h3>Link</h3>
                        <p>
                            Link Utili
                        </p>
                        <ul>
                            @foreach ($links as $single)
                                <li>
                                    <i class="bi bi-share-fill"></i>
                                    <div>
                                        <h5>{{$single->name}}</h5>
                                        <p><a href="{{$single->url}}" target="_blank">{{$single->url}}</a></p>

                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                </div>
            </div>

        </section><!-- /link Section -->


        <!-- ======= documenti Section ======= -->
        <section id="documents" class="team section portfolio mt-5">
            <div class="container" data-aos="fade-up">
                <div class="section-header text-center mb-5">
                    <h3 class="section-title">Documenti Scaricabili</h3>
                    <p class="section-description">Trova e scarica i documenti utili del Patriziato.</p>
                </div>

                <div class="container">

                    <div class="row gy-4">
                        @foreach($documents as $single)
                            <div class="col-lg-6 mt-1" data-aos="fade-up" data-aos-delay="100">
                                <div class="team-member d-flex align-items-start">
                                    <div class="pic"><img src="{{ asset('images/documents.jpg') }}" class="img-fluid"
                                                          alt=""></div>
                                    <div class="member-info">
                                        <h4>{{$single->title}}</h4>
                                        <span>{{ Str::limit($single->description, 100) }}</span>
                                        <p><a href="{{ asset('storage/documents/' . $single->file) }}" class="btn btn-outline-primary btn-sm" download>
                                                <i class="bi bi-download me-1"></i> Scarica Documento
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div><!-- End Team Member -->
                        @endforeach
                    </div>

                </div>


            </div>
        </section>
        </section><!-- End documenti Section -->


        <section id="properties" class="portfolio mt-5">
            <div class="container" data-aos="fade-up">
                <div class="section-header text-center mb-5">
                    <h3 class="section-title">Proprietà del Patriziato</h3>
                    <p class="section-description">Esplora le nostre proprietà con documenti dettagliati.</p>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" data-aos="fade-up" data-aos-delay="200">
                    @foreach($properties as $single)
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="bi bi-house-door me-2"></i> {{$single->title}}</h5>
                                    <p class="card-text">{{ Str::limit($single->description, 100) }}</p>
                                    <div class="text-center">
                                        <img src="{{ asset('storage/properties/' . $single->file) }}"
                                             alt="Document image" class="img-fluid rounded mb-3 property-image"
                                             style="max-height: 200px; object-fit: cover; cursor: pointer;"
                                             data-modal-id="propertyModal{{ $single->id }}"
                                             data-image="{{ asset('storage/properties/' . $single->file) }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($properties as $single)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img class="d-block w-100" src="{{ asset('storage/properties/' . $single->file) }}" alt="{{ $single->title }}">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>...</h5>
                            <p>...</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>



        @foreach($properties as $single)
            <div class="modal fade" id="propertyModal{{ $single->id }}" tabindex="-1"
                 aria-labelledby="propertyModalLabel{{ $single->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="propertyModalLabel{{ $single->id }}">{{ $single->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Chiudi"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="" alt="Property Image" class="img-fluid" id="modalImage{{ $single->id }}">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach<!-- End properties Section -->


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

                <div class="card-body">
                    <form method="post" action="{{ route('login.perform') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        @include('layouts.partials.messages')

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
                            <label for="floatingUsername">Username</label>
                            @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                            <label for="floatingPassword">Password</label>
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-lg" type="submit">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    @include('auth.partials.copy')
                </div>

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


    <script>
        window.onload = function() {
            window.scrollTo(0, 0);
            setTimeout(() => {
                document.getElementById('hero').scrollIntoView({behavior: 'smooth'});
            }, 100);
        };

        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('scroll')) {
                const section = document.getElementById(urlParams.get('scroll'));
                if (section) {
                    section.scrollIntoView({behavior: 'smooth'});
                }
            }


            const propertyImages = document.querySelectorAll('.property-image');

            propertyImages.forEach(image => {
                image.addEventListener('click', function () {
                    const modalId = this.dataset.modalId;
                    const modalImage = document.getElementById('modalImage' + modalId.replace('propertyModal', ''));
                    modalImage.src = this.dataset.image;

                    const modal = new bootstrap.Modal(document.getElementById(modalId));
                    modal.show();

                    //riattiva la chiusura del bottone
                    const closeButton = document.querySelector('#' + modalId + ' [data-bs-dismiss="modal"]');
                    if (closeButton) {
                        closeButton.addEventListener('click', function () {
                            modal.hide();
                        })
                    }
                });
            });
        });
    </script>



