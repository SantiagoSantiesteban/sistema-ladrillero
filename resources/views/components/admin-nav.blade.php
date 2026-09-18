<div class="flex items-center space-x-1 bg-white rounded-xl shadow-sm border border-gray-100 p-2 mb-6">
    <a href="{{ route('admin.index') }}"
       class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.index') ? 'bg-blue-600 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
        Resumen
    </a>
    <a href="{{ route('admin.usuarios') }}"
       class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.usuarios') ? 'bg-blue-600 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
        Usuarios
    </a>
    <a href="{{ route('admin.optimizacion') }}"
       class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.optimizacion') ? 'bg-blue-600 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
        Rendimiento
    </a>
</div>