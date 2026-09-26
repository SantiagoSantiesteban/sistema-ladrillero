<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sector Ladrillero - Patio Bonito, Nemocón</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

   <!-- Navbar Unificado del Sector -->
    <nav class="bg-orange-700 text-white px-6 py-4 flex flex-wrap justify-between items-center shadow-md">
        <!-- Logo / Nombre -->
        <a href="{{ url('/') }}" class="group flex flex-col">
            <span class="text-xl font-bold group-hover:text-orange-200 transition leading-tight">Sector Ladrillero</span>
            <span class="text-xs text-orange-200">Patio Bonito, Nemocón</span>
        </a>

        <!-- Enlaces con espaciado individual (gap) -->
        <div class="flex items-center gap-6 text-sm mt-2 sm:mt-0">
            <a href="{{ url('/') }}" class="hover:text-orange-200 font-medium transition">
                Inicio
            </a>
            <a href="{{ route('sector.productos') }}" class="hover:text-orange-200 font-medium transition">
                Productos
            </a>
            <a href="{{ route('sector.contacto') }}" class="hover:text-orange-200 font-medium transition">
                Ladrilleras
            </a>
            <a href="{{ route('contact.create') }}" class="hover:text-orange-200 font-medium transition">
                Escríbenos
            </a>
            <a href="{{ route('login') }}" class="bg-white text-orange-800 hover:bg-orange-100 px-4 py-2 rounded-md font-semibold transition shadow-sm">
                Ingresar
            </a>
        </div>
    </nav>

    <!-- Hero Original a Pantalla Completa-->
    @if(isset($banners) && $banners->isNotEmpty())
        <div class="relative bg-black text-white overflow-hidden shadow-md">
            @foreach($banners as $banner)
                <!-- Altura controlada mediante CSS directo para no depender del compilador -->
                <div class="relative flex items-center justify-center" style="height: 580px;">
                    
                    <!-- Imagen de fondo real, sin difuminados y con nitidez al 100% -->
                    <img src="{{ asset('storage/' . $banner->image) }}" 
                        alt="{{ $banner->title }}" 
                        class="absolute inset-0 w-full h-full object-cover">
                    
                    <!-- Sombra oscura ligera para contraste del texto -->
                    <div class="absolute inset-0 bg-black/40"></div>

                    <!-- Textos centrados con sombra para máxima legibilidad -->
                    <div class="relative max-w-4xl mx-auto px-6 text-center z-10">
                        <h2 class="text-4xl md:text-5xl font-black tracking-tight mb-3 text-white uppercase" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.9);">
                            {{ $banner->title }}
                        </h2>
                        
                        @if($banner->subtitle)
                            <p class="text-lg md:text-xl text-yellow-300 font-bold mb-6 max-w-2xl mx-auto" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.9);">
                                {{ $banner->subtitle }}
                            </p>
                        @endif

                        @if($banner->button_text && $banner->button_url)
                            <a href="{{ $banner->button_url }}"
                            class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-bold px-8 py-3.5 rounded-lg transition shadow-2xl border border-orange-400">
                                {{ $banner->button_text }}
                            </a>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <!-- Fallback en caso de no tener banners activos -->
        <div class="bg-orange-600 text-white py-16 px-6 text-center shadow-md">
            <h2 class="text-4xl font-bold mb-4">Bienvenido al Sector Ladrillero de Patio Bonito</h2>
            <p class="text-xl text-orange-100 mb-8">Conoce nuestra comunidad, nuestros productos y cómo trabajamos</p>
            <a href="{{ route('sector.productos') }}"
            class="bg-white text-orange-700 px-6 py-3 rounded-lg font-semibold hover:bg-orange-100 transition shadow-sm">
                Ver productos
            </a>
        </div>
    @endif

    <!-- Información del sector -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">¿Cómo funciona el sector ladrillero?</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6 border border-gray-100">
                <h4 class="text-lg font-semibold mb-2 text-gray-800">Extracción</h4>
                <p class="text-gray-600 text-sm">La arcilla es extraída de terrenos cercanos a la vereda Patio Bonito. Es el material principal para la fabricación del ladrillo.</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 border border-gray-100">
                <h4 class="text-lg font-semibold mb-2 text-gray-800">Fabricación</h4>
                <p class="text-gray-600 text-sm">La arcilla se mezcla, moldea y se lleva a hornos donde se cuece a altas temperaturas para obtener el ladrillo resistente.</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 border border-gray-100">
                <h4 class="text-lg font-semibold mb-2 text-gray-800">Distribución</h4>
                <p class="text-gray-600 text-sm">Los ladrillos son distribuidos a constructores y comerciantes de la región, siendo una fuente importante de empleo local.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p class="text-sm">Sistema Web para la Gestión de Trabajadores en el Sector Ladrillero</p>
        <p class="text-gray-400 text-xs mt-1">Vereda Patio Bonito, Nemocón, Cundinamarca</p>
    </footer>

</body>
</html>