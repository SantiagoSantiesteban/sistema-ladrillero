<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sector Ladrillero - Patio Bonito, Nemocón</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-orange-700 text-white px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold">Sector Ladrillero</h1>
            <p class="text-xs text-orange-200">Patio Bonito, Nemocón</p>
        </div>
        <div class="flex space-x-4 text-sm">
            <a href="{{ route('sector.index') }}" class="hover:underline">Inicio</a>
            <a href="{{ route('sector.productos') }}" class="hover:underline">Productos</a>
            <a href="{{ route('sector.contacto') }}" class="hover:underline">Contacto</a>
            <a href="{{ route('login') }}" class="bg-white text-orange-700 px-3 py-1 rounded font-semibold hover:bg-orange-100">Ingresar</a>
        </div>
    </nav>

    <!-- Hero -->
    <div class="bg-orange-600 text-white py-16 px-6 text-center">
        <h2 class="text-4xl font-bold mb-4">Bienvenido al Sector Ladrillero de Patio Bonito</h2>
        <p class="text-xl text-orange-100 mb-8">Conoce nuestra comunidad, nuestros productos y cómo trabajamos</p>
        <a href="{{ route('sector.productos') }}"
           class="bg-white text-orange-700 px-6 py-3 rounded-lg font-semibold hover:bg-orange-100">
            Ver productos
        </a>
    </div>

    <!-- Información del sector -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">¿Cómo funciona el sector ladrillero?</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-4xl mb-4"></div>
                <h4 class="text-lg font-semibold mb-2">Extracción</h4>
                <p class="text-gray-600">La arcilla es extraída de terrenos cercanos a la vereda Patio Bonito. Es el material principal para la fabricación del ladrillo.</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-4xl mb-4"></div>
                <h4 class="text-lg font-semibold mb-2">Fabricación</h4>
                <p class="text-gray-600">La arcilla se mezcla, moldea y se lleva a hornos donde se cuece a altas temperaturas para obtener el ladrillo resistente.</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-4xl mb-4"></div>
                <h4 class="text-lg font-semibold mb-2">Distribución</h4>
                <p class="text-gray-600">Los ladrillos son distribuidos a constructores y comerciantes de la región, siendo una fuente importante de empleo local.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p>Sistema Web para la Gestión de Trabajadores en el Sector Ladrillero</p>
        <p class="text-gray-400 text-sm mt-1">Vereda Patio Bonito, Nemocón, Cundinamarca</p>
    </footer>

</body>
</html>