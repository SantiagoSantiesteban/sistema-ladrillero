<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mi Disponibilidad
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('trabajador.disponibilidad.guardar') }}">
                    @csrf

                    <h3 class="text-lg font-semibold mb-4">Selecciona los días que estás disponible</h3>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        @foreach(['lunes','martes','miercoles','jueves','viernes','sabado','domingo'] as $dia)
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox"
                                       name="{{ $dia }}"
                                       value="1"
                                       {{ $disponibilidad && $disponibilidad->$dia ? 'checked' : '' }}
                                       class="w-5 h-5 text-blue-600">
                                <span class="text-gray-700">{{ ucfirst($dia) }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">
                            Descripción adicional (opcional)
                        </label>
                        <textarea name="descripcion"
                                  rows="3"
                                  class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                                  placeholder="Ejemplo: Tengo experiencia en quema de ladrillo, disponible para turnos largos...">{{ $disponibilidad->descripcion ?? '' }}</textarea>
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                            Guardar disponibilidad
                        </button>
                        <a href="{{ route('trabajador.index') }}"
                           class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>