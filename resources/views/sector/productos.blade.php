<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Sector Ladrillero</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-orange-700 text-white px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold"> Sector Ladrillero</h1>
            <p class="text-xs text-orange-200">Patio Bonito, Nemocón</p>
        </div>
        <div class="flex space-x-4 text-sm">
            <a href="{{ route('sector.index') }}" class="hover:underline">Inicio</a>
            <a href="{{ route('sector.productos') }}" class="hover:underline">Productos</a>
            <a href="{{ route('sector.contacto') }}" class="hover:underline">Contacto</a>
            <a href="{{ route('login') }}" class="bg-white text-orange-700 px-3 py-1 rounded font-semibold hover:bg-orange-100">Ingresar</a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-6 py-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Nuestros Productos</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-semibold mb-2">Ladrillo Tolete</h3>
                <p class="text-gray-600 mb-3">El ladrillo más común, usado en la construcción de muros y paredes. Dimensiones estándar 6x12x24 cm.</p>
                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded text-sm">Construcción general</span>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-semibold mb-2">Ladrillo Prensado</h3>
                <p class="text-gray-600 mb-3">De mayor resistencia y acabado liso. Ideal para fachadas y muros a la vista que requieren mejor presentación.</p>
                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded text-sm">Fachadas</span>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-semibold mb-2">Bloque de Arcilla</h3>
                <p class="text-gray-600 mb-3">Bloque hueco de mayor tamaño, usado para paredes divisorias. Ofrece mejor aislamiento térmico y acústico.</p>
                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded text-sm">Divisiones</span>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-semibold mb-2">Teja de Barro</h3>
                <p class="text-gray-600 mb-3">Fabricada en arcilla cocida, ideal para cubiertas de casas campestres y construcciones tradicionales de la región.</p>
                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded text-sm">Cubiertas</span>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-semibold mb-2">Ladrillo Estructural</h3>
                <p class="text-gray-600 mb-3">De alta resistencia, diseñado para soportar cargas estructurales en edificaciones de varios pisos.</p>
                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded text-sm">Estructuras</span>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-semibold mb-2">Ladrillo Artesanal</h3>
                <p class="text-gray-600 mb-3">Elaborado a mano con técnicas tradicionales. Muy apreciado para proyectos de arquitectura con acabados rústicos.</p>
                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded text-sm">Artesanal</span>
            </div>

        </div>

        <div class="text-center mt-10">
            <a href="{{ route('sector.contacto') }}"
               class="bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-700">
                Contactar para comprar
            </a>
        </div>
    </div>

    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p>Sistema Web para la Gestión de Trabajadores en el Sector Ladrillero</p>
        <p class="text-gray-400 text-sm mt-1">Vereda Patio Bonito, Nemocón, Cundinamarca</p>
    </footer>

</body>
</html>