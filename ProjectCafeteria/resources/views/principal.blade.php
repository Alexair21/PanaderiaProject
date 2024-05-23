@extends('tablar::page')

@section('title', 'Principal')


@section('content')

    <!-- Primer anuncio -->
    <div class="container my-5">
        <div class="row align-items-center anuncio">
            <div class="col-md-7 texto-anuncio d-flex flex-column justify-content-center">
                <center>
                    <h2>Una tarde llena de sabor</h2>
                    <p>El dúo perfecto para disfrutar de una tarde deliciosa. Pídelo en nuestras tiendas.</p>
                    <button class="btn btn-success">Conoce más aquí</button>
                </center>
            </div>
            <div class="col-md-5 imagen-anuncio">
                <img src="/img/NA1.png" alt="Skinny Vanilla Latte Frío y Wrap Napolitano" class="img-fluid">
            </div>
        </div>
    </div>

    <!-- Segundo anuncio -->
    <div class="container my-5">
        <div class="row align-items-center anuncio2">
            <div class="col-md-5 imagen-anuncio">
                <img src="/img/RETRO1.png" alt="Café Americano y Croissant de Jamón y Queso" class="img-fluid">
            </div>
            <div class="col-md-7 texto-anuncio2 d-flex flex-column justify-content-center">
                <center>
                    <h2>Llegó la temporada Retro</h2>
                    <p>Disfruta nuestro delicioso Frappuccino sin café de vainilla con mango dragon fruit.</p>
                    <button class="btn btn-success">Conoce más aquí</button>
                </center>
            </div>
        </div>
    </div>

    <!-- Tercer anuncio -->
    <div class="container my-5">
        <div class="row align-items-center anuncio3">
            <div class="col-md-7 texto-anuncio3 d-flex flex-column justify-content-center">
                <center>
                    <h2>Verano al primer sorbo</h2>
                    <p>Saluda a nuevos y divertidos sabores y a los clásicos favoritos.</p>
                    <button class="btn btn-success">Conoce más aquí</button>
                </center>
            </div>
            <div class="col-md-5 imagen-anuncio3">
                <img src="/img/ANU3.jpg" alt="Skinny Vanilla Latte Frío y Wrap Napolitano" class="img-fluid">
            </div>
        </div>
    </div>


    <!-- seccion del mapa -->
    <div class="container my-5">
        <div class="row align-items-center anuncio4">
            <div class="col-md-5 imagen-anuncio4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6375.252445920179!2d-77.03988650616111!3d-12.055548818132241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c8c6e0cb5ae5%3A0x442d9a96ff2454e0!2sStarbucks%20Centro%20C%C3%ADvico!5e0!3m2!1ses!2spe!4v1715985198135!5m2!1ses!2spe" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-7 texto-anuncio4 d-flex flex-column justify-content-center">
                <center>
                    <h2>Encuéntranos Aquí</h2>
                    <p>Visítanos en nuestra ubicación del Centro Cívico y disfruta de nuestro delicioso Frappuccino.</p>
                    <button class="btn btn-success">Conoce más aquí</button>
                </center>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="/css/principal.css">

@stop
