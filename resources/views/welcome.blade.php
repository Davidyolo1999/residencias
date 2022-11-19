<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio | Residencias Profesionales</title>
    <link rel="icon" type="image/png" href="{{ asset('img/colegio.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html,
        body {
            position: relative;
            height: 100%;
        }

        body {
            background: #eee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .swiper {
            width: 100%;
            height: 100%;
            background: #000;
        }

        .h1 {
            font-family: "robotoregular";
            font-weight: 400;
            text-transform: none;
        }

        .principales {
            float: left;
            text-align: center;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body class="antialiased">
    {{-- Header --}}
    <header class="grid grid-cols-1 lg:grid-cols-2 min-h-screen bg-white">
        {{-- Left side --}}
        <div class="p-12 text-white text-center lg:text-left space-y-4">
            <img src="{{ asset('img/o.jpg') }}" alt="UMB" class="m-auto lg:m-0 mb-12 rounded-full border-black border-4">
            <h2 class="mb-3 text-8xl font-semibold text-lime-500">
                UMB
            </h2>
            <p class="text-xl text-black">
                Unidad de Estudios Superiores Villa Victoria
            </p>
            <div class="text-center">
                <h1 class="text-4xl text-black">
                    Residencias Profesionales
                </h1>
                <br>
                <br>
                <a href="{{ route('login') }}" class="mt-6 p-4 inline-block rounded bg-green-500 text-lg font-semibold">
                    <i class="fas fa-user inline-block"></i>
                    Iniciar sesión
                </a>
            </div>
        </div>

        {{-- Right side --}}
        <div class="p-12">
            <div class="swiper mySwiper rounded">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">

                        <img src="{{ asset('img/inicio.png') }}">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('img/b1.png') }}">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('img/b2.png') }}">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('img/b3.png') }}">
                    </div>

                    <div class="swiper-slide">
                        <img src="{{ asset('img/b4.png') }}">
                    </div>

                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>        
    </header>

    <main class="py-16 bg-gray-900 text-white">
        <h2 class="mb-10 text-2xl lg:text-6xl font-semibold text-center">Recuerda Que…</h2>

        <div class="container mx-auto px-12">
            <p class="mb-6 text-2xl">La residencia profesional solo se puede cursar una sola vez.</p>

            <p class="mb-6 text-2xl text-justify">Debes tener autorizado tu proyecto, estar reinscrito y abrir
                expediente antes de iniciar actividades en la empresa.
            </p>

            <p class="mb-6 text-2xl text-justify">Es importante que registres tu anteproyecto en las fechas
                recomendadas, no importa tu situación académica o los
                pendientes que tengas (por ejemplo, servicio social o
                autorizaciones de comité académico). </p>

            <p class="mb-6 text-2xl text-justify">La validación de los reportes preliminares de residencia
                profesional se realiza en el Departamento de la carrera
                correspondiente.
            </p>
            <p class="mb-6 text-2xl text-justify">El estudiante es el responsable de verificar con tiempo que sus
                asesores interno y externo realicen las evaluaciones de
                seguimiento y del reporte final. Si no la realizan en las fechas
                establecidas, perderás parte de tu calificación final.
            </p>
        </div>


        <h2 class="my-10 text-2xl lg:text-6xl font-semibold text-center">Más Información</h2>

        <div class="container mx-auto text-2xl font-bold">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4">
                <div class="principales">
                    <a class="flex items-center justify-center" href="//umb.edomex.gob.mx/directorio" target="_blank">
                        <img src="{{ asset('img/unidades de estudio superiores 01.png') }}" alt="" class="h-171 w-52">
                    </a>
                    <h3>
                        <a href="//umb.edomex.gob.mx/directorio" target="_blank">
                            Unidades de Estudios Superiores
                        </a>
                    </h3>
                </div>
                <div class="principales">
                    <a class="flex items-center justify-center" href="//umb.edomex.gob.mx/modelo_oferta" target="_blank">
                        <img src="{{ asset('img/modelo y oferta educativa 02.png') }}" alt="" class="h-171 w-52">
                    </a>
                    <h3>
                        <a href="//umb.edomex.gob.mx/modelo_oferta" target="_blank">
                            Modelo y Oferta Educativa
                        </a>
                    </h3>
                </div>
                <div class="principales">
                    <a class="flex items-center justify-center" href="http://sidiumb.umb.edu.mx:8088/" target="_blank">
                        <img src="{{ asset('img/SIDIUMB 03.png') }}" alt="" class="h-171 w-52">
                    </a>
                    <h3>
                        <a href="http://sidiumb.umb.edu.mx:8088/" target="_blank">
                            SIDIUMB
                        </a>
                    </h3>
                </div>
                <div class="center principales">
                    <a class="flex items-center justify-center" href="https://sfpya.edomexico.gob.mx/recaudacion/" target="_blank">
                        <img src="{{ asset('img/tarifas y pagos UMB 04.png') }}" alt="" class="h-171 w-52">
                    </a>
                    <h3>
                        <a href="https://sfpya.edomexico.gob.mx/recaudacion/" target="_blank">
                            Tarifas y Pagos UMB
                        </a>
                    </h3>
                </div>

            </div>
        </div>
    </main>

    <footer class="py-12 bg-white">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 text-white">
                {{-- Info --}}
                <div class="p-4 text-black text-center lg:text-left">
                    <p class="mb-10 text-lg">UMB</p>
                    <p>© 2022, David Florentino Benito | Todos los derechos reservados.</p>
                </div>

                {{-- Socials --}}
                <div class="p-4 text-black text-center lg:text-left">
                    <p class="mb-10 text-lg">Redes Sociales</p>
                    <ul class="space-y-4 text-black">
                        <li class="flex items-center space-x-4 justify-center lg:justify-start">
                            <i class="fab fa-facebook-square"></i>
                            <a href="https://www.facebook.com/UMBVillaVictoria" target="_blank">
                                <span>Facebook</span>
                            </a>
                        </li>
                        <li class="flex items-center space-x-4 justify-center lg:justify-start">
                            <i class="fab fa-twitter"></i> <span>Twitter</span>
                        </li>
                        <li class="flex items-center space-x-4 justify-center lg:justify-start">
                            <i class="fab fa-instagram"></i> <span>Instagram</span>
                        </li>
                        <li class="flex items-center space-x-4 justify-center lg:justify-start">
                            <i class="fab fa-youtube"></i> <span>Youtube</span>
                        </li>
                    </ul>
                </div>

                {{-- Another info --}}

                <div class="p-4 text-black text-center lg:text-left">
                    <p class="mb-10 text-lg">Información</p>
                    <ul class="space-y-4">
                        <li>Politica de Privacidad</li>
                        <li>Trabaja con Nosotros</li>
                    </ul>
                </div>
                {{-- Payment methods --}}
                <div class="p-4 text-black text-center lg:text-left">
                    <p class="mb-10 text-lg">Acerca de la UMB</p>
                    <ul class="space-y-4">
                        <li>
                            <a href="https://umb.edomex.gob.mx/" target="_blank">
                                Ver más
                            </a>                            
                        </li>                        
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 7000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</body>

</html>