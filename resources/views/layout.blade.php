<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Grilli - Amazing & Delicious Food')</title>
    <meta name="title" content="Grilli - Amazing & Delicious Food">
    <meta name="description" content="This is a Restaurant html template made by codewithsadee">

    <link rel="shortcut icon" href="./favicon.svg') }}" type="image/svg') }}+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preload" as="image" href="{{ asset('images/hero-slider-1.jpg') }}">
</head>

<body id="top">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=51947810132&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20un%20pedido."
        class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>


    <div class="preload" data-preaload>
        <div class="circle"></div>
        <p class="text">San Gregorio</p>
    </div>

    <div class="topbar">
        <div class="container">

            <address class="topbar-item">
                <div class="icon">
                    <ion-icon name="location-outline" aria-hidden="true"></ion-icon>
                </div>

                <span class="span">
                    Calle Proreso #1161, Chepén, La Libertad
                </span>
            </address>

            <div class="separator"></div>

            <div class="topbar-item item-2">
                <div class="icon">
                    <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
                </div>

                <span class="span">L-V : 7.00 am - 9.00 pm</span>
            </div>

            <a href="tel:+11234567890" class="topbar-item link">
                <div class="icon">
                    <ion-icon name="call-outline" aria-hidden="true"></ion-icon>
                </div>

                <span class="span">+51 558 548 551</span>
            </a>

            <div class="separator"></div>

            <a href="mailto:booking@restaurant.com" class="topbar-item link">
                <div class="icon">
                    <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>
                </div>

                <span class="span">diegohuamnjulcaguerrero@gmail.com</span>
            </a>

        </div>
    </div>


    <header class="header" data-header>
        <div class="container">
            <a href="#" class="logo">
                <img src="{{ asset('icon2.png') }}" width="90" height="50" alt="Grilli - Home">
            </a>

            <nav class="navbar" data-navbar>
                <button class="close-btn" aria-label="close menu" data-nav-toggler>
                    <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                </button>

                <a href="#" class="logo">
                    <img src="{{ asset('images/logo.svg') }}" width="150" height="50" alt="Grilli - Home">
                </a>

                <ul class="navbar-list">
                    <li class="navbar-item">
                        <a href="#home" class="navbar-link hover-underline active">
                            <div class="separator"></div>
                            <span class="span">Inicio</span>
                        </a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{ route('catalogos.index') }}" class="navbar-link hover-underline">
                            <div class="separator"></div>
                            <span class="span">Pedir</span>
                        </a>
                    </li>
                    <li class="navbar-item">
                        <a href="#menu" class="navbar-link hover-underline">
                            <div class="separator"></div>
                            <span class="span">Platos de hoy!</span>
                        </a>
                    </li>
                    <li class="navbar-item">
                        <a href="#dia" class="navbar-link hover-underline">
                            <div class="separator"></div>
                            <span class="span">Plato del día</span>
                        </a>
                    </li>
                </ul>

                <div class="text-center">
                    <p class="headline-1 navbar-title">Visit Us</p>
                    <address class="body-4">
                        Restaurant St, Delicious City, <br>
                        London 9578, UK
                    </address>
                    <p class="body-4 navbar-text">Open: 9.30 am - 2.30pm</p>
                    <a href="mailto:booking@grilli.com" class="body-4 sidebar-link">booking@grilli.com</a>

                    <div class="separator"></div>

                    <p class="contact-label">Booking Request</p>
                    <a href="tel:+88123123456" class="body-1 contact-number hover-underline">
                        +88-123-123456
                    </a>
                </div>
            </nav>

            <!-- Bloque para mostrar el icono de usuario y el nombre de la persona autenticada -->
            <div class="user-info" style="display: flex; align-items: center; color: #E4C590;">
                <!-- Si está autenticado, se muestra el nombre del usuario junto al icono -->
                @if (session('userName'))
                    <a href="{{ url('auth/login-basic') }}" class="btn btn-secondary">
                        <span class="text text-1">{{ session('userName') }}</span>
                        <span class="text text-2" aria-hidden="true">Cerrar sesión</span>
                    </a>
                @else
                    <!-- Si no está autenticado, muestra la opción para iniciar sesión -->
                    <a href="{{ url('login') }}" class="btn btn-secondary">
                        <span class="text text-1">Iniciar Sesión</span>
                        <span class="text text-2" aria-hidden="true">Iniciar Sesión</span>
                    </a>
                @endif
            </div>


            <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
                <span class="line line-1"></span>
                <span class="line line-2"></span>
                <span class="line line-3"></span>
            </button>

            <div class="overlay" data-nav-toggler data-overlay></div>
        </div>
    </header>


    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <a href="#top" class="back-top-btn active" aria-label="back to top" data-back-top-btn>
        <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
    </a>

    <script src="{{ asset('js/script.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
