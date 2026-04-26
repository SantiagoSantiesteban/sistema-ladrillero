<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Sector Ladrillero</title>
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

    <div class="max-w-4xl mx-auto px-6 py-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Contactos del Sector</h2>

        <p class="text-gray-600 text-center mb-10">
            ¿Interesado en adquirir productos del sector ladrillero de Patio Bonito?
            Aquí encontrarás los contactos de las principales ladrilleras de la zona.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3"> Ladrillera El Progreso</h3>
                <p class="text-gray-600 mb-1"> Vereda Patio Bonito, Nemocón</p>
                <p class="text-gray-600 mb-1"> 310 000 0001</p>
                <p class="text-gray-600 mb-3"> elprogreso@ladrillera.com</p>
                <p class="text-sm text-gray-500">Especialistas en ladrillo tolete y prensado. Despachos a toda la región.</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3"> Ladrillera San José</h3>
                <p class="text-gray-600 mb-1"> Vereda Patio Bonito, Nemocón</p>
                <p class="text-gray-600 mb-1"> 310 000 0002</p>
                <p class="text-gray-600 mb-3"> sanjose@ladrillera.com</p>
                <p class="text-sm text-gray-500">Producción de teja de barro y ladrillo artesanal. Más de 20 años de experiencia.</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3"> Ladrillera La Esperanza</h3>
                <p class="text-gray-600 mb-1"> Vereda Patio Bonito, Nemocón</p>
                <p class="text-gray-600 mb-1"> 310 000 0003</p>
                <p class="text-gray-600 mb-3"> laesperanza@ladrillera.com</p>
                <p class="text-sm text-gray-500">Bloques de arcilla y ladrillo estructural para proyectos de gran escala.</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3"> Ladrillera El Buen Precio</h3>
                <p class="text-gray-600 mb-1"> Vereda Patio Bonito, Nemocón</p>
                <p class="text-gray-600 mb-1">310 000 0004</p>
                <p class="text-gray-600 mb-3"> buenprecio@ladrillera.com</p>
                <p class="text-sm text-gray-500">Precios competitivos en todos los productos. Atención personalizada.</p>
            </div>

        </div>

        <div class="bg-orange-50 border border-orange-200 rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold text-orange-800 mb-2">¿Eres dueño de una ladrillera?</h3>
            <p class="text-orange-700 mb-4">Regístrate en el sistema para gestionar tus trabajadores y encontrar personal disponible.</p>
            <a href="{{ route('register') }}"
               class="bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-700">
                Registrarse como empleador
            </a>
        </div>
    </div>

    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p>Sistema Web para la Gestión de Trabajadores en el Sector Ladrillero</p>
        <p class="text-gray-400 text-sm mt-1">Vereda Patio Bonito, Nemocón, Cundinamarca</p>
    </footer>

</body>
</html>