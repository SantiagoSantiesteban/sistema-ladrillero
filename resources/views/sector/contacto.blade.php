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

        <div class="bg-orange-50 border border-orange-200 rounded-xl p-8 text-center max-w-3xl mx-auto my-8 shadow-sm">
            <h3 class="text-xl font-bold text-orange-900 mb-2">¿Tienes alguna duda o necesitas soporte?</h3>
            <p class="text-orange-700 mb-6 text-sm">
                Tanto si eres dueño de una ladrillera como si deseas consultar información general del sistema, escríbenos directamente a nuestra mesa de ayuda.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}"
                class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2.5 rounded-lg font-semibold transition shadow-sm text-sm">
                    Registrarse como empleador
                </a>
                <a href="{{ route('contact.create') }}"
                class="bg-white hover:bg-orange-100 text-orange-800 border border-orange-300 px-6 py-2.5 rounded-lg font-semibold transition shadow-sm text-sm">
                    Enviar mensaje al administrador
                </a>
            </div>
        </div>

    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p>Sistema Web para la Gestión de Trabajadores en el Sector Ladrillero</p>
        <p class="text-gray-400 text-sm mt-1">Vereda Patio Bonito, Nemocón, Cundinamarca</p>
    </footer>

</body>
</html>