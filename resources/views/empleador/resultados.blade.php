<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Resultados de búsqueda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-2">
                    Días seleccionados:
                    @foreach($dias as $dia)
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm mr-1">{{ ucfirst($dia) }}</span>
                    @endforeach
                </h3>
            </div>

            @if($trabajadores->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-gray-500">No se encontraron trabajadores disponibles para los días seleccionados.</p>
                    <a href="{{ route('empleador.index') }}"
                       class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Nueva búsqueda
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($trabajadores as $trabajador)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $trabajador->name }}</h4>

                            <div class="mb-3">
                                <p class="text-sm text-gray-500 mb-1">Disponibilidad:</p>
                                <div class="flex flex-wrap gap-1">
                                    @foreach(['lunes','martes','miercoles','jueves','viernes','sabado','domingo'] as $dia)
                                        @if($trabajador->disponibilidad && $trabajador->disponibilidad->$dia)
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">
                                                {{ ucfirst($dia) }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if($trabajador->telefono)
                                <p class="text-sm text-gray-600 mb-1">
                                    📞 {{ $trabajador->telefono }}
                                </p>
                            @endif

                            @if($trabajador->email)
                                <p class="text-sm text-gray-600 mb-1">
                                    ✉️ {{ $trabajador->email }}
                                </p>
                            @endif

                            @if($trabajador->disponibilidad && $trabajador->disponibilidad->descripcion)
                                <p class="text-sm text-gray-500 mt-2 italic">
                                    "{{ $trabajador->disponibilidad->descripcion }}"
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    <a href="{{ route('empleador.index') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Nueva búsqueda
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>