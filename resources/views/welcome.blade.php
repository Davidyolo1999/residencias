<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .swiper {
            width: 100%;
            height: 100%;
            background: #000;
        }

        .swiper-slide {
            font-size: 18px;
            color: #fff;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding: 40px 60px;
        }

        .parallax-bg {
            position: absolute;
            left: 0;
            top: 0;
            width: 130%;
            height: 100%;
            -webkit-background-size: cover;
            background-size: cover;
            background-position: center;
        }

        .swiper-slide .title {
            font-size: 41px;
            font-weight: 300;
        }

        .swiper-slide .subtitle {
            font-size: 21px;
        }

        .swiper-slide .text {
            font-size: 14px;
            max-width: 400px;
            line-height: 1.3;
        }

    </style>
</head>

<body class="antialiased">
    {{-- Header --}}
    <header class="flex min-h-screen bg-indigo-600">
        {{-- Left side --}}
        <div class="w-2/5 p-12 text-white">
            <img src="{{ asset('img/o.jpg') }}" alt="UMB" class="mb-12 rounded-full">
            <h1 class="mb-3 text-8xl font-semibold text-lime-500">UMB</h1>
            <p class="text-2xl">Unidad de Estudios Superiores Villa Victoria</p>



            <div class="text-center">
                <p class="text-4xl" id="copy">Residencias Profesionales</p>
                <a href="{{ route('login') }}"
                    class="mt-6 p-4 inline-block rounded bg-green-500 text-lg font-semibold">
                    <i class="fas fa-user inline-block"></i>
                    Iniciar sesión</a>
            </div>
        </div>

        {{-- Right side --}}
        <div class="w-3/5 p-12">
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                class="swiper mySwiper rounded">
                <div class="parallax-bg" style="background-image: url({{ asset('img/ordenador.jpg') }});"
                    data-swiper-parallax="-23%"></div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="title" data-swiper-parallax="-300"></div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="subtitle" data-swiper-parallax="-200">¿Cuál es la Residencia Profesional?
                        </div>
                        <br>
                        <div class="text" data-swiper-parallax="-100">
                            <p class="text-8x1 text-white no-italic text-justify">
                                <b>
                                    Las Residencias profesionales son una estrategia educativa de carácter curricular,
                                    que permite al estudiante emprender un proyecto teórico-práctico, analítico,
                                    reflexivo, crítico y profesional; para resolver un problema específico de la
                                    realidad social y productiva, para fortalecer y aplicar sus competencias ...
                                </b>



                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="title" data-swiper-parallax="-300"></div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>

                        <div class="subtitle" data-swiper-parallax="-200">Beneficios que obtienen los alumnos con
                            las Residencias Profesionales:</div> <br>
                        <div class="text" data-swiper-parallax="-100">
                            <p class="text-8x1 text-white no-italic text-justify">
                                <b>
                            <ol>
                                <li>1. Retroalimentar y desarrollar conocimientos al participar en un proceso de
                                    aprendizaje/trabajo en que se aplican los conocimientos a la vez que se adquieren
                                    experiencias</li>
                                <li>2. Interactuar con profesionistas experimentados de los que se va a aprender más. </li>
                                <li>3. Conocer y manejar tecnología, métodos, sistemas y procedimientos de trabajos
                                    actualizados y acordes con su profesión.</li>
                                <li>4. Ser un profesionista competitivo, identificado con la realidad y la problemática a
                                    la
                                    que se tendrá que enfrentar.</li>
                                <li>5. Disponer de una alternativa más para obtener el título profesional.</li>
                            </ol></b>
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="title" data-swiper-parallax="-300">Slide 3</div>
                        <div class="subtitle" data-swiper-parallax="-200">Requisitos para realizar las Residencias
                            Profesionales:</div>
                        <div class="text" data-swiper-parallax="-100">
                            <p>
                                1. Haber aprobado el 80% de los créditos de su carrera.
                                2. Estar inscrito actualmente en el Instituto Haber seleccionado su tema de proyecto y
                                que éste debidamente avalado por la academia.
                                3. Disponer de constancia de su situación académica emitida por el Departamento de
                                Control Escolar.
                                4. Haber concluido el servicio social
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </header>

    <main class="py-16 bg-gray-900 text-white">
        <h2 class="mb-10 text-6xl font-semibold text-center">Recuerda Que…</h2>

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


        <h2 class="my-10 text-6xl font-semibold text-center">Available For</h2>

        <div class="container mx-auto">
            <div class="flex justify-between">
                <img src="{{ asset('img/js.svg') }}" alt="" class="h-52 w-52">
                <img src="{{ asset('img/angular.svg') }}" alt="" class="h-52 w-52">
                <img src="{{ asset('img/react.svg') }}" alt="" class="h-52 w-52">
                <img src="{{ asset('img/vue.svg') }}" alt="" class="h-52 w-52">
                <img src="{{ asset('img/svelte.svg') }}" alt="" class="h-52 w-52">
            </div>
        </div>
    </main>

    <footer class="py-12 bg-indigo-600">
        <div class="container mx-auto">
            <div class="flex text-white">
                {{-- Info --}}
                <div class="w-2/5 p-4">
                    <p class="mb-10 text-lg">UMB</p>

                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ratione officia, blanditiis eius ipsa
                        odit deleniti velit, libero animi nulla, a quisquam earum quaerat eum facere laboriosam cumque.
                        Quaerat praesentium nobis voluptatum ex eius dicta animi, fugiat nam hic. Libero tempore illo
                        consectetur animi numquam voluptas hic corrupti nemo nam voluptatem, repudiandae quisquam
                        excepturi earum eum temporibus modi, aliquid illum neque. Repudiandae quas odit perferendis,
                        numquam hic quam doloribus est repellendus eum natus a reiciendis, suscipit quos odio rem nisi!
                        Laboriosam nesciunt sunt, at nisi quod sint nihil ea beatae molestiae voluptatibus. Aut
                        explicabo, dolorum quaerat sequi velit deserunt reiciendis! Reiciendis!</p>
                </div>

                {{-- Socials --}}
                <div class="w-1/5 p-4">
                    <p class="mb-10 text-lg">Redes Sociales</p>

                    <ul class="space-y-4">
                        <li class="flex items-center space-x-4"><i class="fab fa-facebook-square"></i>
                            <span>Facebook</span>
                        </li>
                        <li class="flex items-center space-x-4"><i class="fab fa-twitter"></i> <span>Twitter</span></li>
                        <li class="flex items-center space-x-4"><i class="fab fa-instagram"></i> <span>Instagram</span>
                        </li>
                        <li class="flex items-center space-x-4"><i class="fab fa-youtube"></i> <span>Youtube</span></li>
                    </ul>
                </div>

                {{-- Another info --}}

                <div class="w-1/5 p-4">
                    <p class="mb-10 text-lg">Información</p>

                    <ul class="space-y-4">
                        <li>Politica de Privacidad</li>
                        <li>Trabaja con Nosotros</li>
                    </ul>
                </div>
                {{-- Payment methods --}}
                <div class="w-1/5 p-4">
                    <p class="mb-10 text-lg">Acerca de la UMB</p>

                    <ul class="space-y-4">
                        <li>Ver más</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            speed: 600,
            parallax: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        new Typewriter('#copy', {
            strings: ['Residencias Profesionales'],
            autoStart: true,
            loop: true,
        });
    </script>
</body>

</html>
