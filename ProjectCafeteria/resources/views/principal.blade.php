@extends('tablar::page')

@section('title', 'Principal')

@section('content')
    <div class="container">
        <div class="left-side">
            <h1>El dia comienza<br><br>
                 con una  <span class="green"> Taza de café </span>
            </h1>
            <p>¿Sabías que…?<br>
                Un buen desayuno ayuda a comer mejor durante el resto del día y mejora la productividad.</p>
                <a href="{{ route('catalogos.index') }}">Pide Aquí!</a>
        </div>
        <div class="right-side">
            <img id="mainImage" src="img/img1.png" alt="" class="starbucks">
            <div class="box">
                <a href="#"> <img class="facebook" src="img/facebook.png" alt=""></a>
                <a href="#"> <img src="img/instagram.png" alt=""></a>
                <a href="#"> <img src="img/twitter.png" alt=""></a>
            </div>
        </div>
    </div>
    <div class="thumb">
        <a href="#bottom"><img id="bottom" src="img/thumb1.png" onclick="imgSlider('img/img1.png');"></a>
        <a href="#bottom"><img src="img/thumb2.png" onclick="imgSlider('img/img2.png');"></a>
        <a href="#bottom"><img src="img/thumb3.png" onclick="imgSlider('img/img3.png');"></a>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/principal.css">
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
@stop

@section('js')
    <script>
        function imgSlider(src) {
            const mainImage = document.getElementById("mainImage");

            // Añadimos la clase para animación de salida
            mainImage.classList.add("slide-out");

            // Esperamos que termine la animación de salida
            mainImage.addEventListener("animationend", function() {
                // Cambiamos la imagen
                mainImage.src = src;
                // Removemos la clase de salida y agregamos la de entrada
                mainImage.classList.remove("slide-out");
                mainImage.classList.add("slide-in");

                // Removemos la clase de entrada después de que termine la animación
                mainImage.addEventListener("animationend", function() {
                    mainImage.classList.remove("slide-in");
                }, { once: true });
            }, { once: true });
        }
    </script>
@stop
