<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Administración
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-4xl font-bold text-blue-600">{{ $totalUsuarios }}</p>
                    <p class="text-gray-600 mt-2">Total usuarios</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-4xl font-bold text-green-600">{{ $totalTrabajadores }}</p>
                    <p class="text-gray-600 mt-2">Trabajadores</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-4xl font-bold text-orange-600">{{ $totalEmpleadores }}</p>
                    <p class="text-gray-600 mt-2">Empleadores</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Acciones rápidas</h3>
                <a href="{{ route('admin.usuarios') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Gestionar usuarios
                </a>
            </div>

        </div>
    </div>
</x-app-layout>