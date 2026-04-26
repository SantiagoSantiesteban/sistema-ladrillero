<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel del Empleador
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-2">Bienvenido, {{ Auth::user()->name }}</h3>
                <p class="text-gray-600">Busca trabajadores disponibles según los días que necesitas.</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Buscar trabajadores por disponibilidad</h3>

                <form method="GET" action="{{ route('empleador.buscar') }}">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        @foreach(['lunes','martes','miercoles','jueves','viernes','sabado','domingo'] as $dia)
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox"
                                       name="dias[]"
                                       value="{{ $dia }}"
                                       class="w-5 h-5 text-blue-600">
                                <span class="text-gray-700">{{ ucfirst($dia) }}</span>
                            </label>
                        @endforeach
                    </div>

                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Buscar trabajadores
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>