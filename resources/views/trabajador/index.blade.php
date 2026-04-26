<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel del Trabajador
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-2">Bienvenido, {{ Auth::user()->name }}</h3>
                <p class="text-gray-600">Desde aquí puedes gestionar tu perfil y tu disponibilidad laboral.</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Mi Disponibilidad</h3>

                @if($disponibilidad)
                    <div class="grid grid-cols-7 gap-2 mb-4">
                        @foreach(['lunes','martes','miercoles','jueves','viernes','sabado','domingo'] as $dia)
                            <div class="text-center p-2 rounded {{ $disponibilidad->$dia ? 'bg-green-200 text-green-800' : 'bg-gray-100 text-gray-400' }}">
                                {{ ucfirst($dia) }}
                            </div>
                        @endforeach
                    </div>
                    @if($disponibilidad->descripcion)
                        <p class="text-gray-600 mb-4">{{ $disponibilidad->descripcion }}</p>
                    @endif
                @else
                    <p class="text-gray-500 mb-4">Aún no has registrado tu disponibilidad.</p>
                @endif

                <a href="{{ route('trabajador.disponibilidad') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ $disponibilidad ? 'Editar disponibilidad' : 'Registrar disponibilidad' }}
                </a>
            </div>

        </div>
    </div>
</x-app-layout>