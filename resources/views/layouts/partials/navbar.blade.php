<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('news.index') }}" class="nav-link px-2 {{ (request()->is('/')) ? 'text-secondary' : 'text-white' }} ">Home</a></li>
                <li><a href="{{ route('home.info') }}" class="nav-link px-2 {{ (request()->is('info*')) ? 'text-secondary' : 'text-white' }} ">Info</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Documenti</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Link</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Proprietà</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Contatti</a></li>

                @auth
                    {{auth()->user()->name}}
                    <li><a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a></li>
                @endauth

                @guest
                    <li><a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a></li>
                @endguest



            </ul>



        </div>
    </div>
</header>
