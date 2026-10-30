<footer class="bg-gray-800 text-white py-6 mt-auto w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Parte superior del footer (Tu diseño original) -->
        <div class="mb-4 pb-4 border-b border-gray-600 flex flex-col md:flex-row justify-between items-center text-sm">
            <div class="flex items-center space-x-2 font-bold text-orange-400 mb-2 md:mb-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span>LadrilloWeb</span>
            </div>
            <p class="text-gray-300">Sistema Web para la Gestión de Trabajadores en el Sector Ladrillero</p>
            <p class="text-gray-400 text-xs mt-2 md:mt-0">Patio Bonito, Nemocón — {{ date('Y') }}</p>
        </div>

        <!-- Parte inferior del footer (Enlaces Legales) -->
        <div class="flex flex-col md:flex-row justify-between items-center text-xs text-gray-400">
            <p>&copy; {{ date('Y') }} LadrilloWeb. Todos los derechos reservados.</p>
            <div class="space-x-4 mt-3 md:mt-0">
                <a href="{{ route('terminos') }}" class="hover:text-orange-400 transition">Términos y Condiciones</a>
                <a href="{{ route('seguridad') }}" class="hover:text-orange-400 transition">Políticas de Seguridad</a>
                <a href="{{ route('cookies') }}" class="hover:text-orange-400 transition">Política de Cookies</a>
            </div>
        </div>
    </div>
</footer>