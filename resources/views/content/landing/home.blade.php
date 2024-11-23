@extends('layout')

@section('title', 'Grilli - Amazing & Delicious Food')

@section('content')


    <main>
        <article>

            <!-- HERO Section -->
            <section class="hero text-center" aria-label="home" id="home">
                <div class="carousel-container">
                    <ul class="hero-slider" data-hero-slider>
                        <li class="slider-item active" data-hero-slider-item>
                            <div class="content-wrapper">
                                <div class="text-content">
                                    <center>
                                        <p class="label-2 section-subtitle slider-reveal">Frescura Marina</p>
                                    </center>
                                    <h2 class="display-1 hero-title slider-reveal">
                                        <b>Ceviche que enamora</b>
                                    </h2><br>
                                    <p class="body-2 hero-text slider-reveal" style="color: black; font-size: 20px;">
                                        Sumérgete en el sabor único de nuestro ceviche, con pescado fresco y un toque de
                                        limón que despierta los sentidos
                                    </p><br>
                                    <a href="" class="btn btn-primary slider-reveal">
                                        <span class="text text-1">Ver Menú</span>
                                        <span class="text text-2" aria-hidden="true">Ver Menú</span>
                                    </a>
                                </div>
                                <div class="image-content">
                                    <img src="{{ asset('images/hero-slider-1.png') }}" alt="" class="img-cover">
                                </div>
                            </div>
                        </li>

                        <li class="slider-item" data-hero-slider-item>
                            <div class="content-wrapper">
                                <div class="text-content">
                                    <center>
                                        <p class="label-2 section-subtitle slider-reveal">Tradición Peruana</p>
                                    </center>
                                    <h2 class="display-1 hero-title slider-reveal">
                                        <b>El auténtico lomo saltado</b>
                                    </h2><br>
                                    <p class="body-2 hero-text slider-reveal" style="color: black; font-size: 20px;">
                                        Disfruta de esta especialidad nacional, un plato jugoso y lleno de sabor, con
                                        carne tierna y vegetales salteados al wok
                                    </p><br>
                                    <a href="#" class="btn btn-primary slider-reveal">
                                        <span class="text text-1">Ver Menú</span>
                                        <span class="text text-2" aria-hidden="true">Ver Menú</span>
                                    </a>
                                </div>
                                <div class="image-content">
                                    <img src="{{ asset('images/hero-slider-2.png') }}" alt="" class="img-cover">
                                </div>
                            </div>
                        </li>

                        <li class="slider-item" data-hero-slider-item>
                            <div class="content-wrapper">
                                <div class="text-content">
                                    <center>
                                        <p class="label-2 section-subtitle slider-reveal">Sazón
                                            Criolla</p>
                                    </center>
                                    <h2 class="display-1 hero-title slider-reveal">
                                        <b>Ají de gallina inolvidable.</b>
                                    </h2><br>
                                    <p class="body-2 hero-text slider-reveal" style="color: black; font-size: 20px;">
                                        Déjate llevar por la cremosidad y el sabor característico <br> de este plato
                                        tradicional, preparado con dedicación y los mejores ingredientes.
                                    </p><br>
                                    <a href="#" class="btn btn-primary slider-reveal">
                                        <span class="text text-1">Ver Menú</span>
                                        <span class="text text-2" aria-hidden="true">Ver Menú</span>
                                    </a>
                                </div>
                                <div class="image-content">
                                    <img src="{{ asset('images/gallina.png') }}" alt="" class="img-cover">
                                </div>
                            </div>
                        </li>

                    </ul>

                    <button class="slider-btn prev" aria-label="slide to previous" data-prev-btn>
                        <ion-icon name="chevron-back"></ion-icon>
                    </button>

                    <button class="slider-btn next" aria-label="slide to next" data-next-btn>
                        <ion-icon name="chevron-forward"></ion-icon>
                    </button>
                </div>
            </section>

            <!-- SERVICE Section -->
            <section class="section service text-center" aria-label="service">
                <div class="container">

                    <p class="section-subtitle label-2">Sabores inolvidables</p>

                    <h2 class="headline-1 section-title">Ofrecemos lo mejor en calidad</h2>

                    <p class="section-text">
                        <b>Cada plato es una experiencia única, preparada con dedicación para brindarte los sabores
                            más exquisitos de nuestra tierra.</b>
                    </p>

                    <br><br><br><br>
                    <!-- Usamos flexbox para la fila -->
                    <ul class="grid-list"
                        style="display: flex; justify-content: space-around; align-items: stretch; list-style: none; padding: 0; margin: 0; gap: 20px;">
                        <li style="flex: 1; max-width: 300px;">
                            <div class="service-card">
                                <a href="#" class="has-before hover:shine">
                                    <figure class="card-banner img-holder" style="--width: 285; --height: 336;">
                                        <img src="{{ asset('images/desayuno.png') }}" width="285" height="336"
                                            loading="lazy" alt="Breakfast" class="img-cover">
                                    </figure>
                                </a>
                                <div class="card-content">
                                    <h3 class="title-4 card-title">
                                        <a href="#">Desayuno</a>
                                    </h3>
                                    <a href="#" class="btn-text hover-underline label-2">Ver Menú</a>
                                </div>
                            </div>
                        </li>

                        <li style="flex: 1; max-width: 300px;">
                            <div class="service-card">
                                <a href="#" class="has-before hover:shine">
                                    <figure class="card-banner img-holder" style="--width: 285; --height: 336;">
                                        <img src="{{ asset('images/almuerzo.png') }}" width="285" height="336"
                                            loading="lazy" alt="Appetizers" class="img-cover">
                                    </figure>
                                </a>
                                <div class="card-content">
                                    <h3 class="title-4 card-title">
                                        <a href="#">Almuerzo</a>
                                    </h3>
                                    <a href="#" class="btn-text hover-underline label-2">Ver Menú</a>
                                </div>
                            </div>
                        </li>

                        <li style="flex: 1; max-width: 300px;">
                            <div class="service-card">
                                <a href="#" class="has-before hover:shine">
                                    <figure class="card-banner img-holder" style="--width: 285; --height: 336;">
                                        <img src="{{ asset('images/cena.png') }}" width="285" height="336"
                                            loading="lazy" alt="Dinner" class="img-cover">
                                    </figure>
                                </a>
                                <div class="card-content">
                                    <h3 class="title-4 card-title">
                                        <a href="#">Cena</a>
                                    </h3>
                                    <a href="#" class="btn-text hover-underline label-2">Ver Menú</a>
                                </div>
                            </div>
                        </li>

                        <li style="flex: 1; max-width: 300px;">
                            <div class="service-card">
                                <a href="#" class="has-before hover:shine">
                                    <figure class="card-banner img-holder" style="--width: 285; --height: 336;">
                                        <img src="{{ asset('images/bebidas2.png') }}" width="285" height="336"
                                            loading="lazy" alt="Drinks" class="img-cover">
                                    </figure>
                                </a>
                                <div class="card-content">
                                    <h3 class="title-4 card-title">
                                        <a href="#">Bebidas</a>
                                    </h3>
                                    <a href="#" class="btn-text hover-underline label-2">Ver Menú</a>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <img src="{{ asset('images/shape-1.png') }}" width="246" height="412" loading="lazy"
                        alt="shape" class="shape shape-1 move-anim">
                    <img src="{{ asset('images/shape-2.png') }}" width="343" height="345" loading="lazy"
                        alt="shape" class="shape shape-2 move-anim">

                </div>
            </section>




            <!-- SPECIAL DISH Section -->
            @if ($platilloDestacado)
                <section class="special-dish text-center" aria-labelledby="dish-label" id="dia">
                    <div class="special-dish-banner">
                        <img src="{{ asset($platilloDestacado->imagen) }}" alt="{{ $platilloDestacado->nombre }}"
                            class="img-cover">
                    </div>
                    <div class="special-dish-content bg-black-10">
                        <div class="container">
                            <img src="{{ asset('images/badge-1.png') }}" alt="badge" class="abs-img">
                            <p class="section-subtitle label-2">RECOMENDACIÓN DEL DÍA DEL CHEF</p>
                            <h2 class="headline-1 section-title">{{ $platilloDestacado->nombre }}</h2>
                            <p class="section-text">{{ $platilloDestacado->descripcion }}</p>
                            <div class="wrapper">
                                @if ($platilloDestacado->precio_anterior)
                                    <del
                                        class="del body-3">S/.{{ number_format($platilloDestacado->precio_anterior, 2) }}</del>
                                @endif
                                <span class="span body-1">S/.{{ number_format($platilloDestacado->precio, 2) }}</span>
                            </div>
                            <a href="{{ route('platillos.verplatillo', $platilloDestacado->id) }}"
                                class="btn btn-primary">
                                <span class="text text-1">Ver Detalles</span>
                                <span class="text text-2" aria-hidden="true">Ver Detalles</span>
                            </a>
                        </div>
                    </div>
                    <img src="{{ asset('images/shape-4.png') }}" alt="" class="shape shape-1">
                    <img src="{{ asset('images/lomito.png') }}" loading="lazy" alt="" class="shape shape-2"
                        style="width: 350px">
                </section>
            @endif

            <!-- MENU Section -->
            <section class="section menu" aria-label="menu-label" id="menu">
                <div class="container">
                    <p class="section-subtitle text-center label-2">Selección Especial</p>
                    <h2 class="headline-1 section-title text-center"><b>Menú del día</b></h2>
                    <ul class="grid-list">
                        @foreach ($platillos->where('estado', true) as $platillo)
                            <li>
                                <div class="menu-card hover:card">
                                    <figure class="card-banner img-holder" style="--width: 100px; --height: 100px;">
                                        <img src="{{ asset($platillo->imagen) }}" alt="{{ $platillo->nombre }}"
                                            class="img-cover"
                                            style="width: 150px; height: 100px; object-fit: cover; border-radius: 8px;">
                                    </figure>
                                    <div>
                                        <div class="title-wrapper">
                                            <h3 class="title-3">
                                                <a href="#" class="card-title">{{ $platillo->nombre }}</a>
                                            </h3>
                                            <span class="span title-2">S/.{{ number_format($platillo->precio, 2) }}</span>
                                        </div>
                                        <p class="card-text label-1" style="color: black">{{ $platillo->descripcion }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <!-- FEATURES Section -->
            <section class="section features text-center" aria-label="features">
                <div class="container">

                    <p class="section-subtitle label-2">Por Qué Elegirnos</p>

                    <h2 class="headline-1 section-title">Échale un ojo</h2>

                    <ul class="grid-list">

                        <li class="feature-item">
                            <div class="feature-card">

                                <div class="card-icon">
                                    <img src="{{ asset('images/features-icon-1.png') }}" width="100" height="80"
                                        loading="lazy" alt="icon">
                                </div>

                                <h3 class="title-2 card-title">Comida Saludable</h3>

                                <p class="label-1 card-text">Ingredientes frescos y de alta calidad en cada plato.</p>

                            </div>
                        </li>

                        <li class="feature-item">
                            <div class="feature-card">

                                <div class="card-icon">
                                    <img src="{{ asset('images/features-icon-2.png') }}" width="100" height="80"
                                        loading="lazy" alt="icon">
                                </div>

                                <h3 class="title-2 card-title">Ambiente Auténtico</h3>

                                <p class="label-1 card-text">Disfruta de un ambiente inspirado en la cultura peruana.
                                </p>

                            </div>
                        </li>

                        <li class="feature-item">
                            <div class="feature-card">

                                <div class="card-icon">
                                    <img src="{{ asset('images/features-icon-3.png') }}" width="100" height="80"
                                        loading="lazy" alt="icon">
                                </div>

                                <h3 class="title-2 card-title">Experiencia</h3>

                                <p class="label-1 card-text">Platos preparados con la receta tradicional de antaño.</p>

                            </div>
                        </li>

                        <li class="feature-item">
                            <div class="feature-card">

                                <div class="card-icon">
                                    <img src="{{ asset('images/features-icon-4.png') }}" width="100" height="80"
                                        loading="lazy" alt="icon">
                                </div>

                                <h3 class="title-2 card-title">Celebraciones</h3>

                                <p class="label-1 card-text">Celebra tus dias especiales con nosotros.</p>

                            </div>
                        </li>

                    </ul>

                    <img src="{{ asset('images/shape-8.png') }}" width="120" height="115" loading="lazy"
                        alt="shape" class="shape shape-2">

                </div>
            </section>
        </article>
    </main>
@endsection
