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
    <header class="flex min-h-screen bg-white">
        {{-- Left side --}}
        <div class="w-2/5 p-12 text-white">
            <img src="{{ asset('img/o.jpg') }}" alt="UMB" class="mb-12 rounded-full border-black border-4">
            <h1 class="mb-3 text-8xl font-semibold text-lime-500">UMB</h1>
            <p class="text-xl text-black">Unidad de Estudios Superiores Villa Victoria</p>



            <div class="text-center">
                <p class="text-4xl text-black">Residencias Profesionales</p>
                <br>
                <br>
                <a href="{{ route('login') }}"
                    class="mt-6 p-4 inline-block rounded bg-green-500 text-lg font-semibold">
                    <i class="fas fa-user inline-block"></i>
                    Iniciar sesión</a>
            </div>
        </div>

        {{-- Right side --}}
        <div class="w-3/5 p-12">
            <div style="--swiper-navigation-color: orange; --swiper-pagination-color: orange"
                class="swiper mySwiper rounded">
                <div class="parallax-bg" style="background-image: url({{ asset('img/students.jpg') }});"
                    data-swiper-parallax="-23%"></div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="title" data-swiper-parallax="-300"></div>
                    
                       
                      <br>
                      <br>
                      
                        <div  class="subtitle text-white text-8x1 not-italic font-bold" data-swiper-parallax="-200">¿Cuál es la Residencia Profesional?</div>
                        <br>
                        <div class="text-9x1  text-white font-sans md:font-arial font-bold text-justify" data-swiper-parallax="-100">
                             
                             <br>
                                Las Residencias profesionales son una estrategia educativa de carácter curricular,
                                que permite al estudiante emprender un proyecto teórico-práctico, analítico,
                                reflexivo, crítico y profesional; para resolver un problema específico de la
                                realidad social y productiva, para fortalecer y aplicar sus competencias ...
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

                        <div class="subtitle text-white text-8x1 not-italic font-bold" data-swiper-parallax="-200">Beneficios que obtienen los alumnos con
                            las Residencias Profesionales:</div> <br>
                        <div class="text-9x1  text-white font-sans md:font-arial font-bold text-justify" data-swiper-parallax="-100">
                            
                            
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
                            </ol>
                            
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="subtitle text-white text-8x1 not-italic font-bold" data-swiper-parallax="-200">Requisitos para realizar las Residencias
                            Profesionales:</div>
                        <div class="text-9x1  text-white font-sans md:font-arial font-bold text-justify" data-swiper-parallax="-100">
                            <br>
                            <ol>
                                <li>
                                    1. Haber aprobado el 80% de los créditos de su carrera.
                                </li>
                                <li>   2. Estar inscrito actualmente en el Instituto Haber seleccionado su tema de proyecto y
                                    que éste debidamente avalado por la academia.</li>
                                    <li> 3. Disponer de constancia de su situación académica emitida por el Departamento de
                                        Control Escolar.</li>
                                        <li>         
                                            4. Haber concluido el servicio social</li>
                            </ol>
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


        <h2 class="my-10 text-6xl font-semibold text-center">Enlaces</h2>

        <div class="container mx-auto text-2xl font-bold">
            <div class="flex justify-between">
                <div align="center" >
                    <a href="//umb.edomex.gob.mx/directorio" target="_blank">
                        <img src="{{ asset('img/unidades de estudio superiores 01.png') }}" alt="" class="h-171 w-52">
                    </a>
                    <h1 class="text-center"><a href="//umb.edomex.gob.mx/directorio" target="_blank">Unidades de Estudios Superiores</a></h1>
                </div>
               <div align="center" >
                <a href="//umb.edomex.gob.mx/modelo_oferta" target="_blank">
                    <img src="{{ asset('img/modelo y oferta educativa 02.png') }}" alt="" class="h-171 w-52">
                </a>
                <h1 class="text-center"><a href="//umb.edomex.gob.mx/modelo_oferta" target="_blank">Modelo y Oferta Educativa</a></h1>
            </div>
            <div align="center" >
                <a href="https://sidiumb.umb.mx" target="_blank">
                    <img src="{{ asset('img/SIDIUMB 03.png') }}" alt="" class="h-171 w-52">
                    <h1 class="sub"><a href="https://sidiumb.umb.mx" target="_blank">SIDIUMB</a></h1>
                </a>
            </div>
            <div align="center" >
                <a href="https://sfpya.edomexico.gob.mx/recaudacion/" target="_blank">
                    <img src="{{ asset('img/tarifas y pagos UMB 04.png') }}" alt="" class="h-171 w-52">
                    <h1 class="sub"><a href="https://sidiumb.umb.mx" target="_blank">Tarifas y Pagos UMB</a></h1>
                </a>
            </div>
          
            </div>
        </div>
    </main>

    <footer class="py-12 bg-white">
        <div class="container mx-auto">
            <div class="flex text-white">
                {{-- Info --}}
                <div class="w-2/5 p-4 text-black">
                    <p class="mb-10 text-lg">UMB</p>

                    <p>Copyright 2022 by David.</p>
                </div>

                {{-- Socials --}}
                <div class="w-1/5 p-4 text-black">
                    <p class="mb-10 text-lg">Redes Sociales</p>

                    <ul class="space-y-4 text-black">
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

                <div class="w-1/5 p-4 text-black">
                    <p class="mb-10 text-lg">Información</p>

                    <ul class="space-y-4">
                        <li>Politica de Privacidad</li>
                        <li>Trabaja con Nosotros</li>
                    </ul>
                </div>
                {{-- Payment methods --}}
                <div class="w-1/5 p-4 text-black">
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
    </script>
</body>

</html>
