<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LadrilloWeb — Sector Ladrillero Patio Bonito</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span class="text-xl font-bold text-gray-800" style="font-family: 'Poppins', sans-serif;">LadrilloWeb</span>
                </a>

                <div class="hidden sm:flex items-center space-x-2">
                    <a href="{{ route('sector.index') }}"
                       class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-orange-600 transition">
                        Sector
                    </a>
                    <a href="{{ route('sector.productos') }}"
                       class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-orange-600 transition">
                        Productos
                    </a>
                    <a href="{{ route('sector.contacto') }}"
                       class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-orange-600 transition">
                        Contacto
                    </a>

                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="ml-2 inline-flex items-center space-x-1 bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-orange-700 transition">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>Mi Panel</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-orange-600 transition">
                            Ingresar
                        </a>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-orange-700 transition">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="bg-gradient-to-br from-orange-600 to-orange-700 text-white py-20 px-6">
        <div class="max-w-5xl mx-auto text-center">
            <span class="inline-block bg-orange-500 text-orange-100 text-xs font-semibold px-3 py-1 rounded-full mb-6 uppercase tracking-wide">
                Vereda Patio Bonito — Nemocón, Cundinamarca
            </span>
            <h1 class="text-4xl sm:text-5xl font-bold mb-6 leading-tight">
                Conectamos trabajadores y empleadores del sector ladrillero
            </h1>
            <p class="text-xl text-orange-100 mb-10 max-w-2xl mx-auto">
                Registra tu disponibilidad, encuentra personal cuando lo necesitas y conoce todo sobre el sector ladrillero de Patio Bonito.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center space-x-2 bg-white text-orange-600 px-6 py-3 rounded-xl font-semibold hover:bg-orange-50 transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Ir a mi panel</span>
                    </a>
                @else
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center space-x-2 bg-white text-orange-600 px-6 py-3 rounded-xl font-semibold hover:bg-orange-50 transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span>Registrarse gratis</span>
                    </a>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center space-x-2 bg-orange-500 text-white px-6 py-3 rounded-xl font-semibold hover:bg-orange-400 transition border border-orange-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Ingresar</span>
                    </a>
                @endauth
                <a href="{{ route('sector.index') }}"
                   class="inline-flex items-center space-x-2 bg-orange-500 text-white px-6 py-3 rounded-xl font-semibold hover:bg-orange-400 transition border border-orange-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Conocer el sector</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Cómo funciona -->
    <section class="py-16 px-6 bg-gray-50">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-3">¿Cómo funciona?</h2>
            <p class="text-gray-500 text-center mb-12">Simple, rápido y diseñado para el sector ladrillero</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                    <div class="bg-orange-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">1. Regístrate</h3>
                    <p class="text-gray-500 text-sm">Crea tu cuenta como trabajador, empleador o ambos. Solo necesitas tu nombre, correo y teléfono.</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                    <div class="bg-orange-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">2. Marca tu disponibilidad</h3>
                    <p class="text-gray-500 text-sm">Si eres trabajador, selecciona en el calendario los días que estás disponible para los próximos 15 días.</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                    <div class="bg-orange-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">3. Conéctate</h3>
                    <p class="text-gray-500 text-sm">Si eres empleador, busca trabajadores disponibles para la fecha que necesitas y contáctalos directamente.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Para quién es -->
    <section class="py-16 px-6 bg-white">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">¿Para quién es LadrilloWeb?</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border border-orange-200 rounded-xl p-6 bg-orange-50">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-orange-600 rounded-full p-2">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Para trabajadores</h3>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center space-x-2">
                            <svg class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Registra los días que estás disponible</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Los empleadores te encuentran fácilmente</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>No pierdas oportunidades de trabajo</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Actualiza tu disponibilidad cuando quieras</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center space-x-2 mt-5 bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-orange-700 transition">
                        <span>Registrarse como trabajador</span>
                    </a>
                </div>

                <div class="border border-gray-200 rounded-xl p-6 bg-gray-50">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-gray-700 rounded-full p-2">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Para empleadores</h3>
                    </div>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center space-x-2">
                            <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Busca personal para fechas específicas</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Ve el teléfono y correo de cada trabajador</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Ahorra tiempo en la búsqueda de personal</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Planifica con anticipación hasta 15 días</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center space-x-2 mt-5 bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
                        <span>Registrarse como empleador</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección pública -->
    <section class="py-16 px-6 bg-orange-600 text-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">¿Solo quieres información del sector?</h2>
            <p class="text-orange-100 mb-8 text-lg">Conoce los productos, el proceso de fabricación y los contactos de las ladrilleras sin necesidad de registrarte.</p>
            <a href="{{ route('sector.index') }}"
               class="inline-flex items-center space-x-2 bg-white text-orange-600 px-6 py-3 rounded-xl font-semibold hover:bg-orange-50 transition">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Ver información del sector ladrillero</span>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 px-6">
        <div class="max-w-5xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center space-x-2">
                <svg class="h-6 w-6 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span class="font-semibold">LadrilloWeb</span>
            </div>
            <p class="text-gray-400 text-sm text-center">Sistema Web para la Gestión de Trabajadores en el Sector Ladrillero</p>
            <p class="text-gray-500 text-sm">Patio Bonito, Nemocón — 2026</p>
        </div>
    </footer>

</body>
</html>