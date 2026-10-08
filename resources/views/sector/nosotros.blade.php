<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - Sector Ladrillero</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <!-- Navbar Unificado -->
    <nav class="bg-orange-700 text-white px-6 py-4 flex flex-wrap justify-between items-center shadow-md">
        <a href="{{ url('/') }}" class="group flex flex-col">
            <span class="text-xl font-bold group-hover:text-orange-200 transition leading-tight">Sector Ladrillero</span>
            <span class="text-xs text-orange-200">Patio Bonito, Nemocón</span>
        </a>

        <div class="flex items-center gap-6 text-sm mt-2 sm:mt-0">
            <a href="{{ url('/') }}" class="hover:text-orange-200 font-medium transition">Inicio</a>
            <a href="{{ route('sector.productos') }}" class="hover:text-orange-200 font-medium transition">Productos</a>
            <a href="{{ route('sector.nosotros') }}" class="text-orange-200 font-bold transition">Nosotros</a>
            <a href="{{ route('sector.contacto') }}" class="hover:text-orange-200 font-medium transition">Ladrilleras</a>
            <a href="{{ route('contact.create') }}" class="hover:text-orange-200 font-medium transition">Escríbenos</a>
            <a href="{{ route('login') }}" class="bg-white text-orange-800 hover:bg-orange-100 px-4 py-2 rounded-md font-semibold transition shadow-sm">Ingresar</a>
        </div>
    </nav>

    <!-- Encabezado de la Sección-->
    <div class="bg-orange-800 text-white py-12 px-6 text-center shadow-inner">
        <h1 class="text-3xl md:text-4xl font-extrabold mb-2 text-white">Acerca del Sector Ladrillero</h1>
        <p class="text-orange-100 max-w-2xl mx-auto text-sm md:text-base">
            Conoce la historia, misión y valores de la comunidad ladrillera de la vereda Patio Bonito, Nemocón.
        </p>
    </div>

    <!-- Contenido Dinámico de Secciones -->
    <div class="max-w-5xl mx-auto px-6 py-12 space-y-12">
        @if(isset($sections) && $sections->isNotEmpty())
            @foreach($sections as $sec)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row gap-8 items-center">
                    @if($sec->image)
                        <div class="w-full md:w-1/3 flex-shrink-0">
                            <div style="height: 220px;" class="w-full bg-gray-100 rounded-xl overflow-hidden shadow-sm">
                                <img src="{{ asset('storage/' . $sec->image) }}" 
                                     alt="{{ $sec->title }}" 
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                    @endif

                    <div class="flex-1">
                        <span class="inline-block px-3 py-1 bg-orange-100 text-orange-800 text-xs font-bold rounded-full uppercase mb-3">
                            {{ $sec->section_type }}
                        </span>
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $sec->title }}</h2>
                        @if($sec->subtitle)
                            <h3 class="text-sm font-medium text-orange-600 mb-4">{{ $sec->subtitle }}</h3>
                        @endif
                        <p class="text-gray-600 text-base leading-relaxed whitespace-pre-line">
                            {{ $sec->content }}
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white rounded-xl shadow p-8 text-center border border-gray-100">
                <p class="text-gray-600 font-medium">No hay información institucional disponible en este momento.</p>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p class="text-sm">Sistema Web para la Gestión de Trabajadores en el Sector Ladrillero</p>
        <p class="text-gray-400 text-xs mt-1">Vereda Patio Bonito, Nemocón, Cundinamarca</p>
    </footer>

</body>
</html>