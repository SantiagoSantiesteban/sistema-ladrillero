<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos y Servicios - Sector Ladrillero</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <!-- Navbar Unificado del Sector -->
    <nav class="bg-orange-700 text-white px-6 py-4 flex flex-wrap justify-between items-center shadow-md">
        <a href="{{ url('/') }}" class="group flex flex-col">
            <span class="text-xl font-bold group-hover:text-orange-200 transition leading-tight">Sector Ladrillero</span>
            <span class="text-xs text-orange-200">Patio Bonito, Nemocón</span>
        </a>

        <div class="flex items-center gap-6 text-sm mt-2 sm:mt-0">
            <a href="{{ url('/') }}" class="hover:text-orange-200 font-medium transition">Inicio</a>
            <a href="{{ route('sector.productos') }}" class="text-orange-200 font-bold transition">Productos</a>
            <a href="{{ route('sector.contacto') }}" class="hover:text-orange-200 font-medium transition">Ladrilleras</a>
            <a href="{{ route('contact.create') }}" class="hover:text-orange-200 font-medium transition">Escríbenos</a>
            <a href="{{ route('login') }}" class="bg-white text-orange-800 hover:bg-orange-100 px-4 py-2 rounded-md font-semibold transition shadow-sm">Ingresar</a>
        </div>
    </nav>

    <!-- Encabezado de la Sección -->
    <div class="bg-orange-800 text-white py-12 px-6 text-center shadow-inner">
        <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Nuestros Productos y Servicios</h1>
        <p class="text-orange-200 max-w-2xl mx-auto text-sm md:text-base">
            Materiales de construcción elaborados con arcilla de alta calidad en la vereda Patio Bonito, Nemocón.
        </p>
    </div>

    <!-- Contenido Dinámico de Productos -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        
        @if(isset($services) && $services->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 flex flex-col justify-between hover:shadow-lg transition">   
                        <div>
                            <!-- Contenedor con altura CSS directa (style="height: 200px;") para forzar el recorte perfecto -->
                            <div style="height: 200px;" class="w-full bg-gray-100 relative overflow-hidden">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" 
                                         alt="{{ $service->name }}" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm font-medium">
                                        Sin imagen disponible
                                    </div>
                                @endif
                            </div>

                            <!-- Información Principal -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $service->name }}</h3>
                                
                                @if($service->short_description)
                                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                        {{ $service->short_description }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Botón o Enlace de Acción -->
                        @if($service->button_text && $service->button_url)
                            <div class="p-6 pt-0">
                                <a href="{{ $service->button_url }}" 
                                   class="block text-center bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2.5 px-4 rounded-lg transition text-sm shadow-sm">
                                    {{ $service->button_text }}
                                </a>
                            </div>
                        @endif

                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-8 text-center border border-gray-100">
                <p class="text-gray-600 font-medium">No hay productos disponibles en el catálogo en este momento.</p>
            </div>
        @endif

        <!-- Botón de Contacto General -->
        <div class="text-center mt-12">
            <a href="{{ route('sector.contacto') }}"
               class="bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-700 transition shadow-md inline-block">
                Contactar para comprar
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p class="text-sm">Sistema Web para la Gestión de Trabajadores en el Sector Ladrillero</p>
        <p class="text-gray-400 text-xs mt-1">Vereda Patio Bonito, Nemocón, Cundinamarca</p>
    </footer>

</body>
</html>